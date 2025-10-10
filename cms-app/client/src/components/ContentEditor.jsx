import React, { useState, useEffect } from 'react';
import { Save, Edit, Image as ImageIcon, FileText, Globe, Mail, Phone, Share2, Info } from 'lucide-react';
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

  const handleSave = () => {
    onSave(localData);
  };

  const handleKeywordsChange = (e) => {
    const keywords = e.target.value.split(',').map(k => k.trim());
    setLocalData({ ...localData, keywords });
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

export default ContentEditor;
