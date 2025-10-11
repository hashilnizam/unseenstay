import React, { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import {
  FileText,
  GitBranch,
  Clock,
  MapPin,
  Home,
  Building,
} from "lucide-react";
import api from "../utils/api";
import toast from "react-hot-toast";

function Overview() {
  const [stats, setStats] = useState({
    sections: 0,
    lastModified: null,
    gitStatus: null,
    totalDestinations: 0,
    totalProperties: 0,
  });
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetchStats();
  }, []);

  const fetchStats = async () => {
    try {
      setLoading(true);

      const [contentRes, gitRes] = await Promise.all([
        api.get("/content"),
        api.get("/git/status"),
      ]);

      const content = contentRes.data;
      const destinations = content?.destinations?.cards || [];

      // Debug: Log the first destination to check its structure
      console.log("First destination:", destinations[0]);

      // Calculate total properties from subCards array
      const totalProperties = destinations.reduce((sum, dest) => {
        const count = Array.isArray(dest.subCards) ? dest.subCards.length : 0;
        console.log(`Destination ${dest.name} has ${count} subCards`);
        return sum + count;
      }, 0);

      console.log("Total properties calculated:", totalProperties);

      setStats((prev) => ({
        ...prev,
        sections: Object.keys(content).length,
        lastModified: new Date().toLocaleString(),
        gitStatus: gitRes.data.status,
        totalDestinations: destinations.length,
        totalProperties,
        destinations,
      }));
    } catch (error) {
      console.error("Error fetching stats:", error);
      toast.error("Failed to fetch dashboard data");
    } finally {
      setLoading(false);
    }
  };
  // Refresh data periodically (every 5 minutes)
  useEffect(() => {
    fetchStats();
    const interval = setInterval(fetchStats, 5 * 60 * 1000);
    return () => clearInterval(interval);
  }, []);

  const statCards = [
    {
      icon: MapPin,
      label: "Total Destinations",
      value: stats.totalDestinations,
      color: "bg-indigo-500",
      link: "/destinations",
    },
    {
      icon: Home,
      label: "Total Properties",
      value: stats.totalProperties,
      color: "bg-amber-500",
      link: "/destinations",
    },
    {
      icon: FileText,
      label: "Content Sections",
      value: stats.sections,
      color: "bg-blue-500",
    },
    {
      icon: GitBranch,
      label: "Modified Files",
      value: stats.gitStatus?.modified?.length || 0,
      color: "bg-green-500",
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
    <div>
      <div>
        <h1 className="text-2xl sm:text-3xl font-bold text-gray-800">
          Dashboard Overview
        </h1>
        <p className="text-gray-600 mt-2">
          Welcome to UnseenStay Content Management System
        </p>
      </div>

      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        {statCards.map((card, index) => {
          const content = (
            <div className="flex items-center gap-3 sm:gap-4">
              <div className={`${card.color} p-2 sm:p-3 rounded-lg`}>
                <card.icon className="w-5 h-5 sm:w-6 sm:h-6 text-white" />
              </div>
              <div className="min-w-0 flex-1">
                <p className="text-sm text-gray-600">{card.label}</p>
                <p className="text-xl sm:text-2xl font-bold text-gray-800 break-words">
                  {typeof card.value === "string" && card.value.length > 15
                    ? card.value.substring(0, 15) + "..."
                    : card.value}
                </p>
              </div>
            </div>
          );

          return (
            <div
              key={index}
              className={`bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 hover:shadow-md transition ${
                card.link ? "group cursor-pointer" : ""
              }`}
            >
              {card.link ? (
                <Link to={card.link} className="block">
                  {content}
                </Link>
              ) : (
                content
              )}
            </div>
          );
        })}
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
          <h2 className="text-lg sm:text-xl font-bold text-gray-800 mb-4">
            Content Management
          </h2>
          <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <Link
              to="/content"
              className="flex items-center gap-3 p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition border border-gray-200"
            >
              <div className="p-2 bg-blue-100 rounded-lg">
                <FileText className="w-5 h-5 text-blue-600" />
              </div>
              <div>
                <h3 className="font-medium text-gray-800">Edit Content</h3>
                <p className="text-sm text-gray-500">Manage website content</p>
              </div>
            </Link>
            <Link
              to="/destinations"
              className="flex items-center gap-3 p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition border border-gray-200"
            >
              <div className="p-2 bg-green-100 rounded-lg">
                <MapPin className="w-5 h-5 text-green-600" />
              </div>
              <div>
                <h3 className="font-medium text-gray-800">Destinations</h3>
                <p className="text-sm text-gray-500">
                  Manage {stats.totalDestinations} destinations
                </p>
              </div>
            </Link>
            <Link
              to="/files"
              className="flex items-center gap-3 p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition border border-gray-200"
            >
              <div className="p-2 bg-purple-100 rounded-lg">
                <FileText className="w-5 h-5 text-purple-600" />
              </div>
              <div>
                <h3 className="font-medium text-gray-800">File Manager</h3>
                <p className="text-sm text-gray-500">Manage media and assets</p>
              </div>
            </Link>
            <Link
              to="/git"
              className="flex items-center gap-3 p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition border border-gray-200"
            >
              <div className="p-2 bg-orange-100 rounded-lg">
                <GitBranch className="w-5 h-5 text-orange-600" />
              </div>
              <div>
                <h3 className="font-medium text-gray-800">Git Operations</h3>
                <p className="text-sm text-gray-500">Manage version control</p>
              </div>
            </Link>
          </div>
        </div>

        <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
          <h2 className="text-lg sm:text-xl font-bold text-gray-800 mb-4">
            Recent Activity
          </h2>
          <div className="space-y-4">
            <div className="flex items-start gap-3">
              <div className="p-2 bg-blue-100 rounded-full">
                <Clock className="w-4 h-4 text-blue-600" />
              </div>
              <div>
                <p className="text-sm text-gray-800">
                  Last updated: {stats.lastModified || "N/A"}
                </p>
                <p className="text-xs text-gray-500">Content last modified</p>
              </div>
            </div>
            {stats.gitStatus?.modified?.length > 0 && (
              <div>
                <div className="flex items-center gap-2 mb-2">
                  <GitBranch className="w-4 h-4 text-green-600" />
                  <h3 className="text-sm font-medium text-gray-800">
                    Modified Files
                  </h3>
                  <span className="text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded-full">
                    {stats.gitStatus.modified.length} files
                  </span>
                </div>
                <ul className="text-sm text-gray-600 space-y-1 max-h-40 overflow-y-auto pr-2">
                  {stats.gitStatus.modified.slice(0, 5).map((file, i) => (
                    <li key={i} className="truncate">
                      {file}
                    </li>
                  ))}
                  {stats.gitStatus.modified.length > 5 && (
                    <li className="text-xs text-gray-500">
                      +{stats.gitStatus.modified.length - 5} more
                    </li>
                  )}
                </ul>
              </div>
            )}
            {stats.gitStatus?.ahead > 0 && (
              <div className="text-sm text-amber-700 bg-amber-50 p-3 rounded-lg">
                You have {stats.gitStatus.ahead} uncommitted change
                {stats.gitStatus.ahead > 1 ? "s" : ""}.{" "}
                <Link
                  to="/git"
                  className="text-amber-700 font-medium hover:underline"
                >
                  Commit changes
                </Link>
              </div>
            )}
          </div>
        </div>
      </div>
    </div>
  );
}

export default Overview;
