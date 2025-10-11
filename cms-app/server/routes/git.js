const express = require('express');
const simpleGit = require('simple-git');
const path = require('path');
const authMiddleware = require('../middleware/auth');
const router = express.Router();

const REPO_PATH = path.join(__dirname, process.env.REPO_PATH || '../../../');
const git = simpleGit(REPO_PATH);

// Configure git user
const configureGit = async () => {
  try {
    await git.addConfig('user.name', process.env.GIT_USER_NAME || 'CMS Admin');
    await git.addConfig('user.email', process.env.GIT_USER_EMAIL || 'admin@unseenstay.com');
  } catch (error) {
    console.error('Git config error:', error);
  }
};

// Generate commit message based on changes
const generateCommitMessage = (changes) => {
  if (changes.customMessage) {
    return changes.customMessage;
  }

  const { section, action, field } = changes;
  let message = 'CMS Update: ';

  if (section && field) {
    message += `Updated ${section}.${field}`;
  } else if (section && action) {
    message += `${action} in ${section}`;
  } else if (section) {
    message += `Modified ${section}`;
  } else {
    message += 'Updated content';
  }

  return message;
};

// Get current status
router.get('/status', authMiddleware, async (req, res) => {
  try {
    await configureGit();
    const status = await git.status();
    res.json({ 
      success: true, 
      status: {
        modified: status.modified,
        created: status.created,
        deleted: status.deleted,
        staged: status.staged,
        current: status.current,
        tracking: status.tracking
      }
    });
  } catch (error) {
    res.status(500).json({ error: 'Failed to get git status', message: error.message });
  }
});

// Get commit history
router.get('/log', authMiddleware, async (req, res) => {
  try {
    const limit = parseInt(req.query.limit) || 10;
    const log = await git.log({ maxCount: limit });
    res.json({ success: true, commits: log.all });
  } catch (error) {
    res.status(500).json({ error: 'Failed to get git log', message: error.message });
  }
});

// Commit changes
router.post('/commit', authMiddleware, async (req, res) => {
  try {
    await configureGit();
    const { files, changes } = req.body;
    
    // Add files
    if (files && files.length > 0) {
      await git.add(files);
    } else {
      // Add all changes if no specific files provided
      await git.add('.');
    }

    // Generate commit message
    const message = generateCommitMessage(changes || {});
    
    // Commit
    const result = await git.commit(message);
    
    res.json({ 
      success: true, 
      message: 'Changes committed successfully',
      commit: result.commit,
      summary: result.summary
    });
  } catch (error) {
    res.status(500).json({ error: 'Commit failed', message: error.message });
  }
});

// Push to remote
router.post('/push', authMiddleware, async (req, res) => {
  try {
    await configureGit();
    const { remote, branch } = req.body;
    
    // Set up authentication if GitHub token is provided
    if (process.env.GITHUB_TOKEN) {
      const remoteUrl = await git.getRemotes(true);
      if (remoteUrl.length > 0) {
        let url = remoteUrl[0].refs.push;
        // Clean up any existing tokens in the URL
        url = url.replace(/https?:\/\/[^@]+@/, 'https://');
        // Add the token
        const authenticatedUrl = url.replace(
          'https://',
          `https://${process.env.GITHUB_TOKEN}@`
        );
        await git.remote(['set-url', remote || 'origin', authenticatedUrl]);
      }
    }
    
    const result = await git.push(remote || 'origin', branch || 'main');
    
    res.json({ 
      success: true, 
      message: 'Changes pushed successfully',
      result: result
    });
  } catch (error) {
    res.status(500).json({ error: 'Push failed', message: error.message });
  }
});

// Commit and push in one operation
router.post('/commit-and-push', authMiddleware, async (req, res) => {
  try {
    await configureGit();
    const { files, changes, remote, branch } = req.body;
    
    // Add files
    if (files && files.length > 0) {
      await git.add(files);
    } else {
      await git.add('.');
    }

    // Generate commit message
    const message = generateCommitMessage(changes || {});
    
    // Commit
    const commitResult = await git.commit(message);
    
    // Set up authentication if GitHub token is provided
    if (process.env.GITHUB_TOKEN) {
      const remoteUrl = await git.getRemotes(true);
      if (remoteUrl.length > 0) {
        let url = remoteUrl[0].refs.push;
        if (url && url.includes('github.com')) {
          // Clean up any existing tokens in the URL
          url = url.replace(/https?:\/\/[^@]+@/, 'https://');
          // Add the token
          const authenticatedUrl = url.replace(
            'https://',
            `https://${process.env.GITHUB_TOKEN}@`
          );
          await git.remote(['set-url', remote || 'origin', authenticatedUrl]);
        }
      }
    }
    
    // Push
    const pushResult = await git.push(remote || 'origin', branch || 'main');
    
    res.json({ 
      success: true, 
      message: 'Changes committed and pushed successfully',
      commit: commitResult.commit,
      summary: commitResult.summary,
      push: pushResult
    });
  } catch (error) {
    res.status(500).json({ error: 'Commit and push failed', message: error.message });
  }
});

// Pull from remote
router.post('/pull', authMiddleware, async (req, res) => {
  try {
    await configureGit();
    const { remote, branch } = req.body;
    const result = await git.pull(remote || 'origin', branch || 'main');
    
    res.json({ 
      success: true, 
      message: 'Changes pulled successfully',
      result: result
    });
  } catch (error) {
    res.status(500).json({ error: 'Pull failed', message: error.message });
  }
});

module.exports = router;
