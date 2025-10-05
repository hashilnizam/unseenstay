const express = require('express');
const multer = require('multer');
const path = require('path');
const fs = require('fs').promises;
const authMiddleware = require('../middleware/auth');
const router = express.Router();

const ASSETS_PATH = path.join(__dirname, process.env.ASSETS_PATH || '../../../assets');

// Configure multer for file uploads
const storage = multer.diskStorage({
  destination: async (req, file, cb) => {
    // Always save to assets/images folder only
    const uploadPath = path.join(ASSETS_PATH, 'images');
    
    try {
      await fs.mkdir(uploadPath, { recursive: true });
      cb(null, uploadPath);
    } catch (error) {
      cb(error);
    }
  },
  filename: (req, file, cb) => {
    const uniqueSuffix = Date.now() + '-' + Math.round(Math.random() * 1E9);
    const ext = path.extname(file.originalname);
    const name = path.basename(file.originalname, ext).replace(/\s+/g, '-');
    cb(null, `${name}-${uniqueSuffix}${ext}`);
  }
});

const upload = multer({
  storage: storage,
  limits: {
    fileSize: 50 * 1024 * 1024 // 50MB limit
  },
  fileFilter: (req, file, cb) => {
    const allowedTypes = /jpeg|jpg|png|gif|webp|mp4|webm|svg/;
    const extname = allowedTypes.test(path.extname(file.originalname).toLowerCase());
    const mimetype = allowedTypes.test(file.mimetype);
    
    if (mimetype && extname) {
      return cb(null, true);
    } else {
      cb(new Error('Invalid file type. Only images and videos are allowed.'));
    }
  }
});

// Upload single file (default endpoint)
router.post('/', authMiddleware, upload.single('file'), async (req, res) => {
  try {
    if (!req.file) {
      return res.status(400).json({ error: 'No file uploaded' });
    }

    const relativePath = `assets/images/${req.file.filename}`;

    res.json({
      success: true,
      message: 'File uploaded successfully',
      path: relativePath,
      file: {
        filename: req.file.filename,
        originalName: req.file.originalname,
        path: relativePath,
        size: req.file.size,
        mimetype: req.file.mimetype
      }
    });
  } catch (error) {
    res.status(500).json({ error: 'Upload failed', message: error.message });
  }
});

// Upload single file (legacy endpoint)
router.post('/single', authMiddleware, upload.single('file'), async (req, res) => {
  try {
    if (!req.file) {
      return res.status(400).json({ error: 'No file uploaded' });
    }

    const relativePath = `assets/images/${req.file.filename}`;

    res.json({
      success: true,
      message: 'File uploaded successfully',
      path: relativePath,
      file: {
        filename: req.file.filename,
        originalName: req.file.originalname,
        path: relativePath,
        size: req.file.size,
        mimetype: req.file.mimetype
      }
    });
  } catch (error) {
    res.status(500).json({ error: 'Upload failed', message: error.message });
  }
});

// Upload multiple files
router.post('/multiple', authMiddleware, upload.array('files', 10), async (req, res) => {
  try {
    if (!req.files || req.files.length === 0) {
      return res.status(400).json({ error: 'No files uploaded' });
    }

    const files = req.files.map(file => ({
      filename: file.filename,
      originalName: file.originalname,
      path: `assets/images/${file.filename}`,
      size: file.size,
      mimetype: file.mimetype
    }));

    res.json({
      success: true,
      message: 'Files uploaded successfully',
      files: files
    });
  } catch (error) {
    res.status(500).json({ error: 'Upload failed', message: error.message });
  }
});

// Delete file
router.delete('/file', authMiddleware, async (req, res) => {
  try {
    const { filePath } = req.body;
    
    if (!filePath) {
      return res.status(400).json({ error: 'File path is required' });
    }

    // Security: ensure path is within assets directory
    const fullPath = path.join(__dirname, '../../..', filePath);
    const normalizedPath = path.normalize(fullPath);
    const normalizedAssets = path.normalize(ASSETS_PATH);

    if (!normalizedPath.startsWith(normalizedAssets)) {
      return res.status(403).json({ error: 'Invalid file path' });
    }

    await fs.unlink(normalizedPath);
    res.json({ success: true, message: 'File deleted successfully' });
  } catch (error) {
    res.status(500).json({ error: 'Delete failed', message: error.message });
  }
});

// List files in directory
router.get('/list/:type', authMiddleware, async (req, res) => {
  try {
    const type = req.params.type;
    const dirPath = path.join(ASSETS_PATH, type);
    
    const files = await fs.readdir(dirPath);
    const fileDetails = await Promise.all(
      files.map(async (file) => {
        const filePath = path.join(dirPath, file);
        const stats = await fs.stat(filePath);
        return {
          name: file,
          path: `assets/${type}/${file}`,
          size: stats.size,
          modified: stats.mtime
        };
      })
    );

    res.json({ success: true, files: fileDetails });
  } catch (error) {
    res.status(500).json({ error: 'Failed to list files', message: error.message });
  }
});

module.exports = router;
