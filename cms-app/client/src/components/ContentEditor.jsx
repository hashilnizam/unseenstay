import React, { useState, useEffect } from 'react';
import { Save, Edit, Image as ImageIcon, FileText, Globe, Mail, Phone, Share2, Info, BarChart } from 'lucide-react';
import api from '../utils/api';
import toast from 'react-hot-toast';

function ContentEditor() {
  const [content, setContent] = useState(null);
  const [loading, setLoading] = useState(true);
  const [saving, setSaving] = useState(false);
  const [uploadingImage, setUploadingImage] = useState(false);

  useEffect(() => {
    fetchContent();
  }, []);

  const fetchContent = async () => {
    try {
      setLoading(true);
      const response = await api.get('/content');
      setContent(response.data);
    } catch (error) {
      toast.error('Failed to fetch content');
    } finally {
      setLoading(false);
    }
  };

  const handleSave = async (section, data) => {
    setSaving(true);
    try {
      await api.put(`/content/${section}`, data);
      toast.success(`${section} updated successfully`);
      fetchContent();
    } catch (error) {
      toast.error(`Failed to update ${section}`);
    } finally {
      setSaving(false);
    }
  };

  const handleImageUpload = async (file, section) => {
    if (!file) return null;

    setUploadingImage(true);
    try {
      const formData = new FormData();
      formData.append('file', file);
      // Create folder based on section name
      const folderName = section.toLowerCase().replace(/[^a-z0-9]+/g, '-');
      formData.append('folder', `images/${folderName}`);

      const response = await api.post('/upload', formData, {
        headers: { 'Content-Type': 'multipart/form-data' }
      });

      toast.success('Image uploaded successfully');
      return response.data.path;
    } catch (error) {
      toast.error('Failed to upload image');
      return null;
    } finally {
      setUploadingImage(false);
    }
  };

  const handleFieldChange = (section, field, value) => {
    setContent(prev => ({
      ...prev,
      [section]: {
        ...prev[section],
        [field]: value
      }
    }));
  };

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
        <h1 className="text-2xl sm:text-3xl font-bold text-gray-800">Content Editor</h1>
        <p className="text-gray-600 mt-2">Manage your website content sections</p>
      </div>

      <div className="space-y-6">
        {/* Site Section */}
        {content?.site && (
          <SiteSection
            data={content.site}
            onSave={(data) => handleSave('site', data)}
            onChange={(field, value) => handleFieldChange('site', field, value)}
            saving={saving}
          />
        )}

        {/* Logo Section */}
        {content?.logo && (
          <LogoSection
            data={content.logo}
            onSave={(data) => handleSave('logo', data)}
            onChange={(field, value) => handleFieldChange('logo', field, value)}
            onImageUpload={(file) => handleImageUpload(file, 'logo')}
            saving={saving}
            uploadingImage={uploadingImage}
          />
        )}

        {/* Navbar Section */}
        {content?.navbar && (
          <NavbarSection
            data={content.navbar}
            onSave={(data) => handleSave('navbar', data)}
            saving={saving}
          />
        )}

        {/* Header Section */}
        {content?.header && (
          <HeaderSection
            data={content.header}
            onSave={(data) => handleSave('header', data)}
            onChange={(field, value) => handleFieldChange('header', field, value)}
            onImageUpload={(file) => handleImageUpload(file, 'header')}
            saving={saving}
            uploadingImage={uploadingImage}
          />
        )}

        {/* Features Section */}
        {content?.features && (
          <FeaturesSection
            data={content.features}
            onSave={(data) => handleSave('features', data)}
            saving={saving}
          />
        )}

        {/* Contact Section */}
        {content?.contact && (
          <ContactSection
            data={content.contact}
            onSave={(data) => handleSave('contact', data)}
            saving={saving}
          />
        )}

        {/* Footer Section */}
        {content?.footer && (
          <FooterSection
            data={content.footer}
            onSave={(data) => handleSave('footer', data)}
            saving={saving}
          />
        )}
      </div>
    </div>
  );
}

// Site Section Component
function SiteSection({ data, onSave, onChange, saving }) {
  const [localData, setLocalData] = useState(data);
  const [uploadingFavicon, setUploadingFavicon] = useState(false);

  const handleSave = () => {
    onSave(localData);
  };

  const handleKeywordsChange = (e) => {
    const keywords = e.target.value.split(',').map(k => k.trim());
    setLocalData({ ...localData, keywords });
  };

  const handleFaviconUpload = async (e) => {
    const file = e.target.files[0];
    if (!file) return;

    // Validate file type
    if (!file.type.startsWith('image/')) {
      toast.error('Please upload an image file');
      return;
    }

    setUploadingFavicon(true);
    try {
      const formData = new FormData();
      formData.append('file', file);

      const response = await api.post('/upload/favicon', formData, {
        headers: { 'Content-Type': 'multipart/form-data' }
      });

      if (response.data.warning) {
        toast.warning(response.data.warning);
      } else {
        toast.success('Favicon uploaded and resized successfully!');
      }

      setLocalData({ ...localData, favicon: response.data.path });
    } catch (error) {
      toast.error('Failed to upload favicon: ' + (error.response?.data?.message || error.message));
    } finally {
      setUploadingFavicon(false);
    }
  };

  return (
    <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
      <div className="flex flex-col sm:flex-row sm:items-center justify-between mb-6 gap-4">
        <div className="flex items-center gap-3">
          <div className="p-2 bg-blue-100 rounded-lg">
            <Globe className="w-6 h-6 text-blue-600" />
          </div>
          <div>
            <h2 className="text-lg sm:text-xl font-bold text-gray-800">SEO & Site Configuration</h2>
            <p className="text-sm text-gray-600">Optimize your website for search engines</p>
          </div>
        </div>
        <button
          onClick={handleSave}
          disabled={saving}
          className="flex items-center justify-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition disabled:opacity-50 w-full sm:w-auto"
        >
          <Save className="w-4 h-4" />
          Save
        </button>
      </div>

      <div className="space-y-4">
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">Site Title *</label>
          <input
            type="text"
            value={localData.title || ''}
            onChange={(e) => setLocalData({ ...localData, title: e.target.value })}
            className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            placeholder="UnseenStay - Luxury Resort Destinations"
          />
          <p className="text-xs text-gray-500 mt-1">Shown in browser tab and search results (50-60 characters recommended)</p>
        </div>

        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">Meta Description *</label>
          <textarea
            value={localData.description || ''}
            onChange={(e) => setLocalData({ ...localData, description: e.target.value })}
            rows={3}
            className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            placeholder="Discover luxury resort destinations worldwide. Book exclusive stays, villas, and unique travel experiences."
          />
          <p className="text-xs text-gray-500 mt-1">Shown in search results (150-160 characters recommended)</p>
        </div>

        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">Keywords</label>
          <input
            type="text"
            value={(localData.keywords || []).join(', ')}
            onChange={handleKeywordsChange}
            className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            placeholder="luxury resorts, vacation rentals, travel destinations, villas"
          />
          <p className="text-xs text-gray-500 mt-1">Separate keywords with commas (5-10 keywords recommended)</p>
        </div>

        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">Site URL</label>
          <input
            type="url"
            value={localData.url || ''}
            onChange={(e) => setLocalData({ ...localData, url: e.target.value })}
            className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            placeholder="https://unseenstay.com"
          />
        </div>

        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">Author</label>
          <input
            type="text"
            value={localData.author || ''}
            onChange={(e) => setLocalData({ ...localData, author: e.target.value })}
            className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            placeholder="UnseenStay Team"
          />
        </div>

        <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-2">Language</label>
            <input
              type="text"
              value={localData.language || 'en'}
              onChange={(e) => setLocalData({ ...localData, language: e.target.value })}
              className="w-full px-3 sm:px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              placeholder="en"
            />
          </div>

          <div>
            <label className="block text-sm font-medium text-gray-700 mb-2">Region</label>
            <input
              type="text"
              value={localData.region || ''}
              onChange={(e) => setLocalData({ ...localData, region: e.target.value })}
              className="w-full px-3 sm:px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              placeholder="IN"
            />
          </div>
        </div>

        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">OG Image (Social Media)</label>
          <input
            type="text"
            value={localData.ogImage || ''}
            onChange={(e) => setLocalData({ ...localData, ogImage: e.target.value })}
            className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            placeholder="assets/images/og-image.jpg"
          />
          <p className="text-xs text-gray-500 mt-1">Image shown when sharing on Facebook, Twitter, etc. (1200x630px recommended)</p>
        </div>

        <div className="border-t pt-4">
          <label className="block text-sm font-medium text-gray-700 mb-2">
            <span className="flex items-center gap-2">
              Favicon (Browser Tab Icon)
              <span className="px-2 py-0.5 text-xs bg-green-100 text-green-700 rounded">Auto-Resize</span>
            </span>
          </label>
          <div className="space-y-3">
            <div className="flex items-start gap-3">
              <div className="flex-1">
                <input
                  type="file"
                  accept="image/*"
                  onChange={handleFaviconUpload}
                  disabled={uploadingFavicon || saving}
                  className="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 disabled:opacity-50"
                />
                <p className="text-xs text-gray-500 mt-2">
                  Upload any image - it will be automatically resized to 32x32px PNG
                </p>
              </div>
              {localData.favicon && (
                <div className="flex flex-col items-center gap-1">
                  <div className="p-3 bg-green-50 rounded border border-green-300 flex flex-col items-center">
                    <svg className="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 13l4 4L19 7" />
                    </svg>
                    <span className="text-xs text-green-700 mt-1 font-medium">Uploaded</span>
                  </div>
                  <span className="text-xs text-gray-500">favicon.png</span>
                </div>
              )}
            </div>
            <div className="bg-blue-50 border border-blue-200 rounded-lg p-3">
              <div className="flex items-start gap-2">
                <Info className="w-4 h-4 text-blue-600 mt-0.5 flex-shrink-0" />
                <div className="text-xs text-blue-800">
                  <p className="font-medium mb-1">Automatic Processing:</p>
                  <ul className="list-disc list-inside space-y-0.5">
                    <li>Uploaded image is auto-resized to 32x32px</li>
                    <li>Additional sizes (16x16, 192x192) are generated</li>
                    <li>Converted to PNG format for best compatibility</li>
                    <li>Centered and cropped to fit square dimensions</li>
                  </ul>
                </div>
              </div>
            </div>
            <input
              type="text"
              value={localData.favicon || ''}
              onChange={(e) => setLocalData({ ...localData, favicon: e.target.value })}
              className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
              placeholder="assets/images/favicon.png"
              disabled={uploadingFavicon}
            />
            {uploadingFavicon && (
              <div className="flex items-center gap-2 text-sm text-blue-600">
                <div className="animate-spin rounded-full h-4 w-4 border-b-2 border-blue-600"></div>
                <span>Processing favicon...</span>
              </div>
            )}
          </div>
        </div>
      </div>
    </div>
  );
}

// Logo Section Component
function LogoSection({ data, onSave, onChange, onImageUpload, saving, uploadingImage }) {
  const [localData, setLocalData] = useState(data);

  const handleImageChange = async (e, type) => {
    const file = e.target.files[0];
    if (file) {
      const path = await onImageUpload(file);
      if (path) {
        setLocalData({ ...localData, [type]: path });
      }
    }
  };

  const handleSave = () => {
    onSave(localData);
  };

  return (
    <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
      <div className="flex items-center justify-between mb-6">
        <div className="flex items-center gap-3">
          <div className="p-2 bg-purple-100 rounded-lg">
            <ImageIcon className="w-6 h-6 text-purple-600" />
          </div>
          <div>
            <h2 className="text-xl font-bold text-gray-800">Logo Settings</h2>
            <p className="text-sm text-gray-600">Upload and configure your logos</p>
          </div>
        </div>
        <button
          onClick={handleSave}
          disabled={saving}
          className="flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition disabled:opacity-50"
        >
          <Save className="w-4 h-4" />
          Save
        </button>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">Light Logo</label>
          <input
            type="file"
            accept="image/*"
            onChange={(e) => handleImageChange(e, 'light')}
            className="w-full px-4 py-2 border border-gray-300 rounded-lg mb-2"
            disabled={uploadingImage}
          />
          {localData.light && (
            <img src={`/${localData.light}`} alt="Light Logo" className="h-16 object-contain bg-gray-800 p-2 rounded" />
          )}
        </div>

        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">Dark Logo</label>
          <input
            type="file"
            accept="image/*"
            onChange={(e) => handleImageChange(e, 'dark')}
            className="w-full px-4 py-2 border border-gray-300 rounded-lg mb-2"
            disabled={uploadingImage}
          />
          {localData.dark && (
            <img src={`/${localData.dark}`} alt="Dark Logo" className="h-16 object-contain bg-white p-2 rounded border" />
          )}
        </div>

        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">Logo Width (px)</label>
          <input
            type="number"
            value={localData.width}
            onChange={(e) => setLocalData({ ...localData, width: parseInt(e.target.value) })}
            className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
          />
        </div>

        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">Alt Text</label>
          <input
            type="text"
            value={localData.alt}
            onChange={(e) => setLocalData({ ...localData, alt: e.target.value })}
            className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
          />
        </div>
      </div>
    </div>
  );
}

// Navbar Section Component
function NavbarSection({ data, onSave, saving }) {
  const [localData, setLocalData] = useState(data);

  const handleMenuItemChange = (index, field, value) => {
    const newMenu = [...localData.menu];
    newMenu[index] = { ...newMenu[index], [field]: value };
    setLocalData({ ...localData, menu: newMenu });
  };

  const addMenuItem = () => {
    setLocalData({
      ...localData,
      menu: [...localData.menu, { name: '', link: '' }]
    });
  };

  const removeMenuItem = (index) => {
    const newMenu = localData.menu.filter((_, i) => i !== index);
    setLocalData({ ...localData, menu: newMenu });
  };

  return (
    <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
      <div className="flex items-center justify-between mb-6">
        <div className="flex items-center gap-3">
          <div className="p-2 bg-green-100 rounded-lg">
            <FileText className="w-6 h-6 text-green-600" />
          </div>
          <div>
            <h2 className="text-xl font-bold text-gray-800">Navigation Menu</h2>
            <p className="text-sm text-gray-600">Configure menu items</p>
          </div>
        </div>
        <button
          onClick={() => onSave(localData)}
          disabled={saving}
          className="flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition disabled:opacity-50"
        >
          <Save className="w-4 h-4" />
          Save
        </button>
      </div>

      <div className="space-y-4">
        {localData.menu.map((item, index) => (
          <div key={index} className="flex gap-4 items-start p-4 bg-gray-50 rounded-lg">
            <div className="flex-1">
              <input
                type="text"
                value={item.name}
                onChange={(e) => handleMenuItemChange(index, 'name', e.target.value)}
                placeholder="Menu Name"
                className="w-full px-4 py-2 border border-gray-300 rounded-lg mb-2"
              />
              <input
                type="text"
                value={item.link}
                onChange={(e) => handleMenuItemChange(index, 'link', e.target.value)}
                placeholder="Link URL"
                className="w-full px-4 py-2 border border-gray-300 rounded-lg"
              />
            </div>
            <button
              onClick={() => removeMenuItem(index)}
              className="p-2 text-red-500 hover:bg-red-50 rounded-lg"
            >
              <Edit className="w-5 h-5" />
            </button>
          </div>
        ))}
        <button
          onClick={addMenuItem}
          className="w-full py-2 border-2 border-dashed border-gray-300 rounded-lg text-gray-600 hover:border-blue-500 hover:text-blue-500 transition"
        >
          + Add Menu Item
        </button>
      </div>
    </div>
  );
}

// Header Section Component
function HeaderSection({ data, onSave, onChange, onImageUpload, saving, uploadingImage }) {
  const [localData, setLocalData] = useState(data);

  const handleVideoChange = async (e) => {
    const file = e.target.files[0];
    if (file) {
      const path = await onImageUpload(file);
      if (path) {
        setLocalData({ ...localData, backgroundVideo: path });
      }
    }
  };

  return (
    <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
      <div className="flex items-center justify-between mb-6">
        <div className="flex items-center gap-3">
          <div className="p-2 bg-indigo-100 rounded-lg">
            <ImageIcon className="w-6 h-6 text-indigo-600" />
          </div>
          <div>
            <h2 className="text-xl font-bold text-gray-800">Hero Section</h2>
            <p className="text-sm text-gray-600">Main banner content</p>
          </div>
        </div>
        <button
          onClick={() => onSave(localData)}
          disabled={saving}
          className="flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition disabled:opacity-50"
        >
          <Save className="w-4 h-4" />
          Save
        </button>
      </div>

      <div className="space-y-4">
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">Background Video</label>
          <input
            type="file"
            accept="video/*"
            onChange={handleVideoChange}
            className="w-full px-4 py-2 border border-gray-300 rounded-lg"
            disabled={uploadingImage}
          />
          {localData.backgroundVideo && (
            <p className="text-sm text-gray-600 mt-2">Current: {localData.backgroundVideo}</p>
          )}
        </div>

        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
          <input
            type="text"
            value={localData.subtitle}
            onChange={(e) => setLocalData({ ...localData, subtitle: e.target.value })}
            className="w-full px-4 py-2 border border-gray-300 rounded-lg"
          />
        </div>

        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">Title (HTML allowed)</label>
          <textarea
            value={localData.title}
            onChange={(e) => setLocalData({ ...localData, title: e.target.value })}
            rows={3}
            className="w-full px-4 py-2 border border-gray-300 rounded-lg"
          />
        </div>

        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">Paragraph</label>
          <textarea
            value={localData.paragraph}
            onChange={(e) => setLocalData({ ...localData, paragraph: e.target.value })}
            rows={3}
            className="w-full px-4 py-2 border border-gray-300 rounded-lg"
          />
        </div>
      </div>
    </div>
  );
}


// Contact Section Component
function ContactSection({ data, onSave, saving }) {
  const [localData, setLocalData] = useState(data);

  const handlePhoneChange = (index, value) => {
    const newPhones = [...localData.phone];
    newPhones[index] = value;
    setLocalData({ ...localData, phone: newPhones });
  };

  const addPhone = () => {
    setLocalData({ ...localData, phone: [...localData.phone, ''] });
  };

  const removePhone = (index) => {
    const newPhones = localData.phone.filter((_, i) => i !== index);
    setLocalData({ ...localData, phone: newPhones });
  };

  return (
    <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
      <div className="flex items-center justify-between mb-6">
        <div className="flex items-center gap-3">
          <div className="p-2 bg-pink-100 rounded-lg">
            <Phone className="w-6 h-6 text-pink-600" />
          </div>
          <div>
            <h2 className="text-xl font-bold text-gray-800">Contact Information</h2>
            <p className="text-sm text-gray-600">Contact details</p>
          </div>
        </div>
        <button
          onClick={() => onSave(localData)}
          disabled={saving}
          className="flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition disabled:opacity-50"
        >
          <Save className="w-4 h-4" />
          Save
        </button>
      </div>

      <div className="space-y-4">
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">Heading</label>
          <input
            type="text"
            value={localData.heading}
            onChange={(e) => setLocalData({ ...localData, heading: e.target.value })}
            className="w-full px-4 py-2 border border-gray-300 rounded-lg"
          />
        </div>

        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">Info Text</label>
          <textarea
            value={localData.info}
            onChange={(e) => setLocalData({ ...localData, info: e.target.value })}
            rows={3}
            className="w-full px-4 py-2 border border-gray-300 rounded-lg"
          />
        </div>

        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">Phone Numbers</label>
          {localData.phone.map((phone, index) => (
            <div key={index} className="flex gap-2 mb-2">
              <input
                type="text"
                value={phone}
                onChange={(e) => handlePhoneChange(index, e.target.value)}
                className="flex-1 px-4 py-2 border border-gray-300 rounded-lg"
                placeholder="+91XXXXXXXXXX"
              />
              <button
                onClick={() => removePhone(index)}
                className="px-4 py-2 text-red-500 hover:bg-red-50 rounded-lg"
              >
                Remove
              </button>
            </div>
          ))}
          <button
            onClick={addPhone}
            className="w-full py-2 border-2 border-dashed border-gray-300 rounded-lg text-gray-600 hover:border-blue-500 hover:text-blue-500"
          >
            + Add Phone
          </button>
        </div>

        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">Email</label>
          <input
            type="email"
            value={localData.email}
            onChange={(e) => setLocalData({ ...localData, email: e.target.value })}
            className="w-full px-4 py-2 border border-gray-300 rounded-lg"
          />
        </div>
      </div>
    </div>
  );
}

// Footer Section Component  
function FooterSection({ data, onSave, saving }) {
  const [localData, setLocalData] = useState(data);
  const [uploadingIcon, setUploadingIcon] = useState(false);

  const handleSocialChange = (index, field, value) => {
    const newSocial = [...localData.social];
    newSocial[index] = { ...newSocial[index], [field]: value };
    setLocalData({ ...localData, social: newSocial });
  };

  const handleIconUpload = async (index, file) => {
    if (!file) return;

    setUploadingIcon(true);
    try {
      const formData = new FormData();
      formData.append('file', file);
      formData.append('folder', 'images/footer/icons');

      const response = await api.post('/upload', formData, {
        headers: { 'Content-Type': 'multipart/form-data' }
      });

      const newSocial = [...localData.social];
      newSocial[index] = { ...newSocial[index], icon: response.data.path };
      setLocalData({ ...localData, social: newSocial });
      toast.success('Icon uploaded successfully');
    } catch (error) {
      toast.error('Failed to upload icon');
    } finally {
      setUploadingIcon(false);
    }
  };

  const addSocial = () => {
    setLocalData({
      ...localData,
      social: [...localData.social, { platform: '', url: '', icon: '' }]
    });
  };

  const removeSocial = (index) => {
    const newSocial = localData.social.filter((_, i) => i !== index);
    setLocalData({ ...localData, social: newSocial });
  };

  return (
    <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
      <div className="flex items-center justify-between mb-6">
        <div className="flex items-center gap-3">
          <div className="p-2 bg-teal-100 rounded-lg">
            <Share2 className="w-6 h-6 text-teal-600" />
          </div>
          <div>
            <h2 className="text-xl font-bold text-gray-800">Footer & Social</h2>
            <p className="text-sm text-gray-600">Footer content and social links</p>
          </div>
        </div>
        <button
          onClick={() => onSave(localData)}
          disabled={saving}
          className="flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition disabled:opacity-50"
        >
          <Save className="w-4 h-4" />
          Save
        </button>
      </div>

      <div className="space-y-4">
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">Footer Text</label>
          <input
            type="text"
            value={localData.text}
            onChange={(e) => setLocalData({ ...localData, text: e.target.value })}
            className="w-full px-4 py-2 border border-gray-300 rounded-lg"
            placeholder="© {year} Your Company. All rights reserved."
          />
          <p className="text-xs text-gray-500 mt-1">Use {'{year}'} for auto-updating year</p>
        </div>

        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">Social Media Links & Icons</label>
          {localData.social.map((item, index) => (
            <div key={index} className="p-4 bg-gray-50 rounded-lg mb-3">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
                <input
                  type="text"
                  value={item.platform}
                  onChange={(e) => handleSocialChange(index, 'platform', e.target.value)}
                  placeholder="Platform (e.g., facebook)"
                  className="px-4 py-2 border border-gray-300 rounded-lg"
                />
                <input
                  type="text"
                  value={item.url}
                  onChange={(e) => handleSocialChange(index, 'url', e.target.value)}
                  placeholder="https://facebook.com/yourpage"
                  className="px-4 py-2 border border-gray-300 rounded-lg"
                />
              </div>
              
              <div className="flex items-center gap-3">
                <div className="flex-1">
                  <label className="block text-xs text-gray-600 mb-1">Icon Image</label>
                  <input
                    type="file"
                    accept="image/*"
                    onChange={(e) => handleIconUpload(index, e.target.files[0])}
                    className="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg"
                    disabled={uploadingIcon}
                  />
                </div>
                {item.icon && (
                  <div className="flex items-center gap-2">
                    <img src={`/${item.icon}`} alt={item.platform} className="w-8 h-8 object-contain" />
                  </div>
                )}
                <button
                  onClick={() => removeSocial(index)}
                  className="px-3 py-2 text-red-500 hover:bg-red-50 rounded-lg"
                >
                  Remove
                </button>
              </div>
            </div>
          ))}
          <button
            onClick={addSocial}
            className="w-full py-2 border-2 border-dashed border-gray-300 rounded-lg text-gray-600 hover:border-blue-500 hover:text-blue-500"
          >
            + Add Social Link
          </button>
        </div>
      </div>
    </div>
  );
}

// Features Section Component
function FeaturesSection({ data, onSave, saving }) {
  const [localData, setLocalData] = useState(data);

  const handleBoxChange = (index, field, value) => {
    const newBoxes = [...localData.boxes];
    newBoxes[index] = { ...newBoxes[index], [field]: value };
    setLocalData({ ...localData, boxes: newBoxes });
  };

  const addBox = () => {
    setLocalData({
      ...localData,
      boxes: [...localData.boxes, { icon: 'pe-7s-star', value: '0', label: 'New Feature' }]
    });
  };

  const removeBox = (index) => {
    const newBoxes = localData.boxes.filter((_, i) => i !== index);
    setLocalData({ ...localData, boxes: newBoxes });
  };

  return (
    <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
      <div className="flex items-center justify-between mb-6">
        <div className="flex items-center gap-3">
          <div className="p-2 bg-orange-100 rounded-lg">
            <BarChart className="w-6 h-6 text-orange-600" />
          </div>
          <div>
            <h2 className="text-xl font-bold text-gray-800">Features & Statistics</h2>
            <p className="text-sm text-gray-600">Showcase your key statistics</p>
          </div>
        </div>
        <button
          onClick={() => onSave(localData)}
          disabled={saving}
          className="flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition disabled:opacity-50"
        >
          <Save className="w-4 h-4" />
          Save
        </button>
      </div>

      <div className="space-y-4">
        <div className="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
          <div className="flex items-start gap-2">
            <Info className="w-5 h-5 text-blue-600 mt-0.5" />
            <div>
              <p className="text-sm text-blue-800 font-medium">Available Icons:</p>
              <p className="text-xs text-blue-700 mt-1">
                pe-7s-home, pe-7s-map, pe-7s-map-2, pe-7s-pin, pe-7s-star, pe-7s-like, pe-7s-portfolio, pe-7s-clock, pe-7s-users, pe-7s-graph2, pe-7s-trophy, pe-7s-medal
              </p>
              <p className="text-xs text-blue-600 mt-1">
                View all icons at: <a href="https://themes-pixeden.com/font-demos/7-stroke/" target="_blank" rel="noopener noreferrer" className="underline">PE Icon 7 Stroke</a>
              </p>
            </div>
          </div>
        </div>

        {localData.boxes.map((box, index) => (
          <div key={index} className="p-4 bg-gray-50 rounded-lg">
            <div className="grid grid-cols-1 md:grid-cols-3 gap-3">
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-2">Icon Class</label>
                <input
                  type="text"
                  value={box.icon}
                  onChange={(e) => handleBoxChange(index, 'icon', e.target.value)}
                  placeholder="pe-7s-home"
                  className="w-full px-4 py-2 border border-gray-300 rounded-lg"
                />
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-2">Value</label>
                <input
                  type="text"
                  value={box.value}
                  onChange={(e) => handleBoxChange(index, 'value', e.target.value)}
                  placeholder="25"
                  className="w-full px-4 py-2 border border-gray-300 rounded-lg"
                />
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-2">Label</label>
                <input
                  type="text"
                  value={box.label}
                  onChange={(e) => handleBoxChange(index, 'label', e.target.value)}
                  placeholder="Our Properties"
                  className="w-full px-4 py-2 border border-gray-300 rounded-lg"
                />
              </div>
            </div>
            <div className="mt-3 flex items-center justify-between">
              <div className="flex items-center gap-2 text-sm text-gray-600">
                <span className={box.icon} style={{fontSize: '24px'}}></span>
                <span>Preview Icon</span>
              </div>
              <button
                onClick={() => removeBox(index)}
                className="px-3 py-1 text-red-500 hover:bg-red-50 rounded-lg text-sm"
              >
                Remove
              </button>
            </div>
          </div>
        ))}

        <button
          onClick={addBox}
          className="w-full py-2 border-2 border-dashed border-gray-300 rounded-lg text-gray-600 hover:border-blue-500 hover:text-blue-500"
        >
          + Add Feature Box
        </button>
      </div>
    </div>
  );
}

export default ContentEditor;
