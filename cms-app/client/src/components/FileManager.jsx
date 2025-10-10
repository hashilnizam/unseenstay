import React, { useState, useRef } from 'react';
import { Upload, Trash2, Image as ImageIcon, Video, RefreshCw } from 'lucide-react';
import api from '../utils/api';
import toast from 'react-hot-toast';

function FileManager() {
  const [files, setFiles] = useState([]);
  const [uploadType, setUploadType] = useState('images');
  const [uploading, setUploading] = useState(false);
  const [loading, setLoading] = useState(false);
  const fileInputRef = useRef(null);

  const fetchFiles = async () => {
    setLoading(true);
    try {
      const response = await api.get(`/upload/list/${uploadType}`);
      setFiles(response.data.files || []);
    } catch (error) {
      toast.error('Failed to fetch files');
    } finally {
      setLoading(false);
    }
  };

  React.useEffect(() => {
    fetchFiles();
  }, [uploadType]);

  const handleFileUpload = async (e) => {
    const selectedFiles = Array.from(e.target.files);
    if (selectedFiles.length === 0) return;

    setUploading(true);
    const formData = new FormData();
    
    if (selectedFiles.length === 1) {
      formData.append('file', selectedFiles[0]);
      formData.append('uploadType', uploadType);
      
      try {
        await api.post('/upload/single', formData, {
          headers: { 'Content-Type': 'multipart/form-data' },
        });
        toast.success('File uploaded successfully');
        fetchFiles();
      } catch (error) {
        toast.error('Upload failed');
      }
    } else {
      selectedFiles.forEach((file) => {
        formData.append('files', file);
      });
      formData.append('uploadType', uploadType);
      
      try {
        await api.post('/upload/multiple', formData, {
          headers: { 'Content-Type': 'multipart/form-data' },
        });
        toast.success('Files uploaded successfully');
        fetchFiles();
      } catch (error) {
        toast.error('Upload failed');
      }
    }
    
    setUploading(false);
    if (fileInputRef.current) {
      fileInputRef.current.value = '';
    }
  };

  const handleDelete = async (filePath) => {
    if (!confirm('Are you sure you want to delete this file?')) return;

    try {
      await api.delete('/upload/file', { data: { filePath } });
      toast.success('File deleted successfully');
      fetchFiles();
    } catch (error) {
      toast.error('Delete failed');
    }
  };

  const copyToClipboard = (path) => {
    navigator.clipboard.writeText(path);
    toast.success('Path copied to clipboard');
  };

  const formatFileSize = (bytes) => {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
  };

  return (
    <div className="space-y-4 sm:space-y-6">
      <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <h1 className="text-2xl sm:text-3xl font-bold text-gray-800">File Manager</h1>
        <div className="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
          <button
            onClick={fetchFiles}
            className="flex items-center justify-center gap-2 px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition"
          >
            <RefreshCw className="w-4 h-4" />
            Refresh
          </button>
          <button
            onClick={() => fileInputRef.current?.click()}
            disabled={uploading}
            className="flex items-center justify-center gap-2 px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition disabled:opacity-50"
          >
            <Upload className="w-4 h-4" />
            {uploading ? 'Uploading...' : 'Upload Files'}
          </button>
        </div>
      </div>

      <input
        ref={fileInputRef}
        type="file"
        multiple
        accept="image/*,video/*"
        onChange={handleFileUpload}
        className="hidden"
      />

      {/* Type selector */}
      <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
        <div className="flex flex-col sm:flex-row gap-2">
          <button
            onClick={() => setUploadType('images')}
            className={`flex items-center justify-center gap-2 px-4 py-2 rounded-lg transition ${
              uploadType === 'images'
                ? 'bg-primary-500 text-white'
                : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
            }`}
          >
            <ImageIcon className="w-4 h-4" />
            Images
          </button>
          <button
            onClick={() => setUploadType('videos')}
            className={`flex items-center justify-center gap-2 px-4 py-2 rounded-lg transition ${
              uploadType === 'videos'
                ? 'bg-primary-500 text-white'
                : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
            }`}
          >
            <Video className="w-4 h-4" />
            Videos
          </button>
        </div>
      </div>

      {/* Files grid */}
      {loading ? (
        <div className="flex items-center justify-center h-64">
          <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-primary-500"></div>
        </div>
      ) : files.length === 0 ? (
        <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
          <div className="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
            {uploadType === 'images' ? (
              <ImageIcon className="w-8 h-8 text-gray-400" />
            ) : (
              <Video className="w-8 h-8 text-gray-400" />
            )}
          </div>
          <h3 className="text-lg font-medium text-gray-800 mb-2">No files found</h3>
          <p className="text-gray-600">Upload some files to get started</p>
        </div>
      ) : (
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
          {files.map((file, index) => (
            <div
              key={index}
              className="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition group"
            >
              <div className="aspect-video bg-gray-100 flex items-center justify-center overflow-hidden">
                {uploadType === 'images' ? (
                  <img
                    src={`/${file.path}`}
                    alt={file.name}
                    className="w-full h-full object-cover"
                    onError={(e) => {
                      e.target.style.display = 'none';
                      e.target.parentElement.innerHTML = '<div class="text-gray-400"><svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>';
                    }}
                  />
                ) : (
                  <Video className="w-12 h-12 text-gray-400" />
                )}
              </div>
              <div className="p-3 sm:p-4">
                <p className="text-sm font-medium text-gray-800 truncate mb-1">
                  {file.name}
                </p>
                <p className="text-xs text-gray-500 mb-3">{formatFileSize(file.size)}</p>
                <div className="flex flex-col sm:flex-row gap-2">
                  <button
                    onClick={() => copyToClipboard(file.path)}
                    className="flex-1 px-3 py-1.5 text-xs font-medium text-primary-600 bg-primary-50 rounded hover:bg-primary-100 transition text-center"
                  >
                    Copy Path
                  </button>
                  <button
                    onClick={() => handleDelete(file.path)}
                    className="px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50 rounded hover:bg-red-100 transition flex items-center justify-center sm:w-auto w-full"
                  >
                    <Trash2 className="w-4 h-4" />
                    <span className="ml-1 sm:hidden">Delete</span>
                  </button>
                </div>
              </div>
            </div>
          ))}
        </div>
      )}
    </div>
  );
}

export default FileManager;
