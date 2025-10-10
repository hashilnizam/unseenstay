import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { FileText, Image, GitBranch, Clock, MapPin } from 'lucide-react';
import api from '../utils/api';
import toast from 'react-hot-toast';

function Overview() {
  const [stats, setStats] = useState({
    sections: 0,
    lastModified: null,
    gitStatus: null,
  });
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetchStats();
  }, []);

  const fetchStats = async () => {
    try {
      const [contentRes, gitRes] = await Promise.all([
        api.get('/content'),
        api.get('/git/status'),
      ]);

      setStats({
        sections: Object.keys(contentRes.data).length,
        lastModified: new Date().toLocaleString(),
        gitStatus: gitRes.data.status,
      });
    } catch (error) {
      toast.error('Failed to fetch stats');
    } finally {
      setLoading(false);
    }
  };

  const statCards = [
    {
      icon: FileText,
      label: 'Content Sections',
      value: stats.sections,
      color: 'bg-blue-500',
    },
    {
      icon: GitBranch,
      label: 'Modified Files',
      value: stats.gitStatus?.modified?.length || 0,
      color: 'bg-green-500',
    },
    {
      icon: Clock,
      label: 'Last Updated',
      value: stats.lastModified || 'N/A',
      color: 'bg-purple-500',
    },
  ];

  if (loading) {
    return (
      <div className="flex items-center justify-center h-64">
        <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-primary-500"></div>
      </div>
    );
  }

  return (
    <div className="space-y-4 sm:space-y-6">
      <div>
        <h1 className="text-2xl sm:text-3xl font-bold text-gray-800">Dashboard Overview</h1>
        <p className="text-gray-600 mt-2">Welcome to UnseenStay Content Management System</p>
      </div>

      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
        {statCards.map((card, index) => (
          <div
            key={index}
            className="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 hover:shadow-md transition"
          >
            <div className="flex items-center gap-3 sm:gap-4">
              <div className={`${card.color} p-2 sm:p-3 rounded-lg`}>
                <card.icon className="w-5 h-5 sm:w-6 sm:h-6 text-white" />
              </div>
              <div className="min-w-0 flex-1">
                <p className="text-sm text-gray-600">{card.label}</p>
                <p className="text-xl sm:text-2xl font-bold text-gray-800 break-words">
                  {typeof card.value === 'string' && card.value.length > 15
                    ? card.value.substring(0, 15) + '...'
                    : card.value}
                </p>
              </div>
            </div>
          </div>
        ))}
      </div>

      <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
        <h2 className="text-lg sm:text-xl font-bold text-gray-800 mb-4">Quick Actions</h2>
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
          <Link
            to="/content"
            className="flex items-center gap-3 p-3 sm:p-4 border-2 border-gray-200 rounded-lg hover:border-primary-500 hover:bg-primary-50 transition"
          >
            <FileText className="w-5 h-5 text-primary-500 flex-shrink-0" />
            <span className="font-medium text-gray-700">Edit Content</span>
          </Link>
          <Link
            to="/destinations"
            className="flex items-center gap-3 p-3 sm:p-4 border-2 border-gray-200 rounded-lg hover:border-primary-500 hover:bg-primary-50 transition"
          >
            <MapPin className="w-5 h-5 text-primary-500 flex-shrink-0" />
            <span className="font-medium text-gray-700">Destinations</span>
          </Link>
          <Link
            to="/files"
            className="flex items-center gap-3 p-3 sm:p-4 border-2 border-gray-200 rounded-lg hover:border-primary-500 hover:bg-primary-50 transition"
          >
            <Image className="w-5 h-5 text-primary-500 flex-shrink-0" />
            <span className="font-medium text-gray-700">Manage Files</span>
          </Link>
          <Link
            to="/git"
            className="flex items-center gap-3 p-3 sm:p-4 border-2 border-gray-200 rounded-lg hover:border-primary-500 hover:bg-primary-50 transition"
          >
            <GitBranch className="w-5 h-5 text-primary-500 flex-shrink-0" />
            <span className="font-medium text-gray-700">Git Operations</span>
          </Link>
        </div>
      </div>

      {stats.gitStatus && (
        <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
          <h2 className="text-lg sm:text-xl font-bold text-gray-800 mb-4">Git Status</h2>
          <div className="space-y-2">
            <p className="text-sm text-gray-600">
              <span className="font-medium">Current Branch:</span> {stats.gitStatus.current}
            </p>
            {stats.gitStatus.modified?.length > 0 && (
              <div>
                <p className="text-sm font-medium text-gray-700 mb-1">Modified Files:</p>
                <ul className="list-disc list-inside text-sm text-gray-600 space-y-1">
                  {stats.gitStatus.modified.map((file, index) => (
                    <li key={index} className="break-words">{file}</li>
                  ))}
                </ul>
              </div>
            )}
          </div>
        </div>
      )}
    </div>
  );
}

export default Overview;
