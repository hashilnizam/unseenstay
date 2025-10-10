import React, { useState, useEffect } from 'react';
import { Routes, Route } from 'react-router-dom';
import Sidebar from '../components/Sidebar';
import Header from '../components/Header';
import ContentEditor from '../components/ContentEditor';
import FileManager from '../components/FileManager';
import GitManager from '../components/GitManager';
import Overview from '../components/Overview';
import DestinationsManager from '../components/DestinationsManager';

function Dashboard() {
  const [sidebarOpen, setSidebarOpen] = useState(false); // Default closed on mobile

  return (
    <div className="flex h-screen bg-gray-50">
      <Sidebar isOpen={sidebarOpen} setIsOpen={setSidebarOpen} />
      
      <div className="flex-1 flex flex-col overflow-hidden min-w-0">
        <Header toggleSidebar={() => setSidebarOpen(!sidebarOpen)} />
        
        <main className="flex-1 overflow-y-auto p-3 sm:p-6">
          <Routes>
            <Route path="/" element={<Overview />} />
            <Route path="/content" element={<ContentEditor />} />
            <Route path="/destinations" element={<DestinationsManager />} />
            <Route path="/files" element={<FileManager />} />
            <Route path="/git" element={<GitManager />} />
          </Routes>
        </main>
      </div>
    </div>
  );
}

export default Dashboard;
