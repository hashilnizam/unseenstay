import React, { useState, useEffect } from 'react';
import { GitBranch, GitCommit, Upload as PushIcon, Download, RefreshCw, Check } from 'lucide-react';
import api from '../utils/api';
import toast from 'react-hot-toast';

function GitManager() {
  const [status, setStatus] = useState(null);
  const [commits, setCommits] = useState([]);
  const [commitMessage, setCommitMessage] = useState('');
  const [loading, setLoading] = useState(true);
  const [processing, setProcessing] = useState(false);

  useEffect(() => {
    fetchGitData();
  }, []);

  const fetchGitData = async () => {
    setLoading(true);
    try {
      const [statusRes, logRes] = await Promise.all([
        api.get('/git/status'),
        api.get('/git/log?limit=10'),
      ]);
      setStatus(statusRes.data.status);
      setCommits(logRes.data.commits);
    } catch (error) {
      toast.error('Failed to fetch git data');
    } finally {
      setLoading(false);
    }
  };

  const handleCommit = async () => {
    if (!commitMessage.trim()) {
      toast.error('Please enter a commit message');
      return;
    }

    setProcessing(true);
    try {
      await api.post('/git/commit', {
        changes: { customMessage: commitMessage },
      });
      toast.success('Changes committed successfully');
      setCommitMessage('');
      fetchGitData();
    } catch (error) {
      toast.error('Commit failed: ' + (error.response?.data?.message || error.message));
    } finally {
      setProcessing(false);
    }
  };

  const handlePush = async () => {
    setProcessing(true);
    try {
      await api.post('/git/push', {
        remote: 'origin',
        branch: status?.current || 'main',
      });
      toast.success('Changes pushed successfully');
      fetchGitData();
    } catch (error) {
      toast.error('Push failed: ' + (error.response?.data?.message || error.message));
    } finally {
      setProcessing(false);
    }
  };

  const handleCommitAndPush = async () => {
    if (!commitMessage.trim()) {
      toast.error('Please enter a commit message');
      return;
    }

    setProcessing(true);
    try {
      await api.post('/git/commit-and-push', {
        changes: { customMessage: commitMessage },
        remote: 'origin',
        branch: status?.current || 'main',
      });
      toast.success('Changes committed and pushed successfully');
      setCommitMessage('');
      fetchGitData();
    } catch (error) {
      toast.error('Operation failed: ' + (error.response?.data?.message || error.message));
    } finally {
      setProcessing(false);
    }
  };

  const handlePull = async () => {
    setProcessing(true);
    try {
      await api.post('/git/pull', {
        remote: 'origin',
        branch: status?.current || 'main',
      });
      toast.success('Changes pulled successfully');
      fetchGitData();
    } catch (error) {
      toast.error('Pull failed: ' + (error.response?.data?.message || error.message));
    } finally {
      setProcessing(false);
    }
  };

  if (loading) {
    return (
      <div className="flex items-center justify-center h-64">
        <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-primary-500"></div>
      </div>
    );
  }

  const hasChanges = status?.modified?.length > 0 || status?.created?.length > 0 || status?.deleted?.length > 0;

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-3xl font-bold text-gray-800">Git Manager</h1>
        <button
          onClick={fetchGitData}
          className="flex items-center gap-2 px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition"
        >
          <RefreshCw className="w-4 h-4" />
          Refresh
        </button>
      </div>

      {/* Status */}
      <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div className="flex items-center gap-3 mb-4">
          <GitBranch className="w-5 h-5 text-primary-500" />
          <h2 className="text-xl font-semibold text-gray-800">Repository Status</h2>
        </div>

        <div className="space-y-4">
          <div className="flex items-center gap-2">
            <span className="text-sm font-medium text-gray-600">Current Branch:</span>
            <span className="px-3 py-1 bg-primary-50 text-primary-700 rounded-full text-sm font-medium">
              {status?.current || 'N/A'}
            </span>
          </div>

          {hasChanges ? (
            <div className="space-y-3">
              {status.modified?.length > 0 && (
                <div>
                  <p className="text-sm font-medium text-yellow-600 mb-2">
                    Modified Files ({status.modified.length})
                  </p>
                  <ul className="space-y-1">
                    {status.modified.map((file, index) => (
                      <li key={index} className="text-sm text-gray-600 pl-4">
                        • {file}
                      </li>
                    ))}
                  </ul>
                </div>
              )}

              {status.created?.length > 0 && (
                <div>
                  <p className="text-sm font-medium text-green-600 mb-2">
                    New Files ({status.created.length})
                  </p>
                  <ul className="space-y-1">
                    {status.created.map((file, index) => (
                      <li key={index} className="text-sm text-gray-600 pl-4">
                        • {file}
                      </li>
                    ))}
                  </ul>
                </div>
              )}

              {status.deleted?.length > 0 && (
                <div>
                  <p className="text-sm font-medium text-red-600 mb-2">
                    Deleted Files ({status.deleted.length})
                  </p>
                  <ul className="space-y-1">
                    {status.deleted.map((file, index) => (
                      <li key={index} className="text-sm text-gray-600 pl-4">
                        • {file}
                      </li>
                    ))}
                  </ul>
                </div>
              )}
            </div>
          ) : (
            <div className="flex items-center gap-2 text-green-600">
              <Check className="w-5 h-5" />
              <span className="text-sm font-medium">Working tree clean</span>
            </div>
          )}
        </div>
      </div>

      {/* Commit */}
      {hasChanges && (
        <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
          <div className="flex items-center gap-3 mb-4">
            <GitCommit className="w-5 h-5 text-primary-500" />
            <h2 className="text-xl font-semibold text-gray-800">Commit Changes</h2>
          </div>

          <div className="space-y-4">
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">
                Commit Message
              </label>
              <textarea
                value={commitMessage}
                onChange={(e) => setCommitMessage(e.target.value)}
                placeholder="Enter commit message..."
                rows={3}
                className="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none"
              />
            </div>

            <div className="flex gap-3">
              <button
                onClick={handleCommit}
                disabled={processing || !commitMessage.trim()}
                className="flex items-center gap-2 px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition disabled:opacity-50 disabled:cursor-not-allowed"
              >
                <GitCommit className="w-4 h-4" />
                {processing ? 'Processing...' : 'Commit'}
              </button>

              <button
                onClick={handleCommitAndPush}
                disabled={processing || !commitMessage.trim()}
                className="flex items-center gap-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition disabled:opacity-50 disabled:cursor-not-allowed"
              >
                <PushIcon className="w-4 h-4" />
                {processing ? 'Processing...' : 'Commit & Push'}
              </button>
            </div>
          </div>
        </div>
      )}

      {/* Push/Pull */}
      <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h2 className="text-xl font-semibold text-gray-800 mb-4">Sync with Remote</h2>
        <div className="flex gap-3">
          <button
            onClick={handlePush}
            disabled={processing}
            className="flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition disabled:opacity-50"
          >
            <PushIcon className="w-4 h-4" />
            {processing ? 'Processing...' : 'Push'}
          </button>

          <button
            onClick={handlePull}
            disabled={processing}
            className="flex items-center gap-2 px-4 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition disabled:opacity-50"
          >
            <Download className="w-4 h-4" />
            {processing ? 'Processing...' : 'Pull'}
          </button>
        </div>
      </div>

      {/* Commit History */}
      <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h2 className="text-xl font-semibold text-gray-800 mb-4">Recent Commits</h2>
        <div className="space-y-3">
          {commits.length === 0 ? (
            <p className="text-gray-500 text-sm">No commits found</p>
          ) : (
            commits.map((commit, index) => (
              <div
                key={index}
                className="border-l-4 border-primary-500 pl-4 py-2 hover:bg-gray-50 transition"
              >
                <p className="text-sm font-medium text-gray-800">{commit.message}</p>
                <div className="flex items-center gap-4 mt-1 text-xs text-gray-500">
                  <span>{commit.author_name}</span>
                  <span>•</span>
                  <span>{new Date(commit.date).toLocaleString()}</span>
                  <span>•</span>
                  <span className="font-mono">{commit.hash.substring(0, 7)}</span>
                </div>
              </div>
            ))
          )}
        </div>
      </div>
    </div>
  );
}

export default GitManager;
