import React, { useState, useEffect } from 'react';
import { MapPin, Plus, Edit, Trash2, Image as ImageIcon, Save, X, Upload, Building2 } from 'lucide-react';
import api from '../utils/api';
import toast from 'react-hot-toast';

function DestinationsManager() {
  const [destinations, setDestinations] = useState([]);
  const [selectedDestination, setSelectedDestination] = useState(null);
  const [showDestinationForm, setShowDestinationForm] = useState(false);
  const [showPropertyForm, setShowPropertyForm] = useState(false);
  const [editingDestination, setEditingDestination] = useState(null);
  const [editingProperty, setEditingProperty] = useState(null);
  const [loading, setLoading] = useState(true);
  const [uploadingImages, setUploadingImages] = useState(false);

  // Destination form state
  const [destinationForm, setDestinationForm] = useState({
    id: '',
    name: '',
    category: '',
    image: '',
    cardHeading: '',
    cardParagraph: '',
    subCards: []
  });

  // Property form state
  const [propertyForm, setPropertyForm] = useState({
    id: '',
    name: '',
    category: '',
    location: '',
    description: '',
    images: [],
    propertyDetails: {},
    inclusions: [],
    checkInOut: {},
    addOnExperiences: [],
    nearbyAttractions: []
  });

  useEffect(() => {
    fetchDestinations();
  }, []);

  const fetchDestinations = async () => {
    try {
      setLoading(true);
      const response = await api.get('/content');
      setDestinations(response.data.destinations?.cards || []);
    } catch (error) {
      toast.error('Failed to load destinations');
      console.error(error);
    } finally {
      setLoading(false);
    }
  };

  const handleImageUpload = async (files, propertyName = null, isDestination = false) => {
    if (!files || files.length === 0) return [];

    setUploadingImages(true);
    const uploadedPaths = [];

    try {
      for (const file of files) {
        const formData = new FormData();
        formData.append('file', file);
        
        // Create folder based on context
        if (isDestination) {
          // Destination main images go to images folder
          formData.append('folder', 'images');
        } else if (propertyName) {
          // Property images go to property-specific folder
          const folderName = propertyName.toLowerCase().replace(/[^a-z0-9]+/g, '-');
          formData.append('folder', `images/properties/${folderName}`);
        } else {
          // Default to images folder
          formData.append('folder', 'images');
        }

        const response = await api.post('/upload', formData, {
          headers: { 'Content-Type': 'multipart/form-data' }
        });

        uploadedPaths.push(response.data.path);
      }

      toast.success(`${uploadedPaths.length} image(s) uploaded successfully`);
      return uploadedPaths;
    } catch (error) {
      toast.error('Failed to upload images');
      console.error(error);
      return [];
    } finally {
      setUploadingImages(false);
    }
  };

  // ==================== DESTINATION CRUD ====================

  const handleAddDestination = () => {
    setEditingDestination(null);
    setDestinationForm({
      id: `dest${Date.now()}`,
      name: '',
      category: '',
      image: '',
      cardHeading: '',
      cardParagraph: '',
      subCards: []
    });
    setShowDestinationForm(true);
  };

  const handleEditDestination = (destination) => {
    setEditingDestination(destination);
    setDestinationForm({ ...destination });
    setShowDestinationForm(true);
  };

  const handleSaveDestination = async () => {
    if (!destinationForm.name || !destinationForm.category) {
      toast.error('Please fill in required fields (Name & Category)');
      return;
    }

    try {
      const response = await api.get('/content');
      const content = response.data;

      if (!content.destinations) {
        content.destinations = { intro: {}, cards: [] };
      }
      if (!content.destinations.cards) {
        content.destinations.cards = [];
      }

      if (editingDestination) {
        // Update existing destination
        const destIndex = content.destinations.cards.findIndex(d => d.id === editingDestination.id);
        if (destIndex !== -1) {
          content.destinations.cards[destIndex] = destinationForm;
        }
      } else {
        // Add new destination
        content.destinations.cards.push(destinationForm);
      }

      await api.put('/content', content);
      toast.success(editingDestination ? 'Destination updated!' : 'Destination added!');
      
      setShowDestinationForm(false);
      fetchDestinations();
    } catch (error) {
      toast.error('Failed to save destination');
      console.error(error);
    }
  };

  const handleDeleteDestination = async (destinationId) => {
    if (!confirm('Are you sure you want to delete this destination and all its properties?')) return;

    try {
      const response = await api.get('/content');
      const content = response.data;
      
      content.destinations.cards = content.destinations.cards.filter(d => d.id !== destinationId);
      
      await api.put('/content', content);
      toast.success('Destination deleted!');
      fetchDestinations();
    } catch (error) {
      toast.error('Failed to delete destination');
      console.error(error);
    }
  };

  // ==================== PROPERTY CRUD ====================

  const handleAddProperty = (destination) => {
    setSelectedDestination(destination);
    setEditingProperty(null);
    setPropertyForm({
      id: `sub${Date.now()}`,
      name: '',
      category: '',
      location: '',
      description: '',
      images: [],
      propertyDetails: {},
      inclusions: [],
      checkInOut: {},
      addOnExperiences: [],
      nearbyAttractions: []
    });
    setShowPropertyForm(true);
  };

  const handleEditProperty = (destination, property) => {
    setSelectedDestination(destination);
    setEditingProperty(property);
    setPropertyForm({ ...property });
    setShowPropertyForm(true);
  };

  const handleSaveProperty = async () => {
    if (!propertyForm.name || !propertyForm.category) {
      toast.error('Please fill in required fields');
      return;
    }

    try {
      const response = await api.get('/content');
      const content = response.data;
      
      const destIndex = content.destinations.cards.findIndex(d => d.id === selectedDestination.id);
      
      if (destIndex === -1) {
        toast.error('Destination not found');
        return;
      }

      if (!content.destinations.cards[destIndex].subCards) {
        content.destinations.cards[destIndex].subCards = [];
      }

      if (editingProperty) {
        // Update existing property
        const propIndex = content.destinations.cards[destIndex].subCards.findIndex(p => p.id === editingProperty.id);
        if (propIndex !== -1) {
          content.destinations.cards[destIndex].subCards[propIndex] = propertyForm;
        }
      } else {
        // Add new property
        content.destinations.cards[destIndex].subCards.push(propertyForm);
      }

      await api.put('/content', content);
      toast.success(editingProperty ? 'Property updated!' : 'Property added!');
      
      setShowPropertyForm(false);
      fetchDestinations();
    } catch (error) {
      toast.error('Failed to save property');
      console.error(error);
    }
  };

  const handleDeleteProperty = async (destination, propertyId) => {
    if (!confirm('Are you sure you want to delete this property?')) return;

    try {
      const response = await api.get('/content');
      const content = response.data;
      
      const destIndex = content.destinations.cards.findIndex(d => d.id === destination.id);
      
      if (destIndex !== -1 && content.destinations.cards[destIndex].subCards) {
        content.destinations.cards[destIndex].subCards = 
          content.destinations.cards[destIndex].subCards.filter(p => p.id !== propertyId);
        
        await api.put('/content', content);
        toast.success('Property deleted!');
        fetchDestinations();
      }
    } catch (error) {
      toast.error('Failed to delete property');
      console.error(error);
    }
  };

  // ==================== FORM HANDLERS ====================

  const handleDestinationFormChange = (field, value) => {
    setDestinationForm(prev => ({ ...prev, [field]: value }));
  };

  const handlePropertyFormChange = (field, value) => {
    setPropertyForm(prev => ({ ...prev, [field]: value }));
  };

  const handleArrayFieldAdd = (field, value) => {
    if (!value.trim()) return;
    setPropertyForm(prev => ({
      ...prev,
      [field]: [...(prev[field] || []), value.trim()]
    }));
  };

  const handleArrayFieldRemove = (field, index) => {
    setPropertyForm(prev => ({
      ...prev,
      [field]: prev[field].filter((_, i) => i !== index)
    }));
  };

  const handleObjectFieldChange = (objectField, key, value) => {
    setPropertyForm(prev => ({
      ...prev,
      [objectField]: {
        ...(prev[objectField] || {}),
        [key]: value
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
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <div>
          <h1 className="text-3xl font-bold text-gray-800">Destinations & Properties</h1>
          <p className="text-gray-600 mt-2">Manage your destinations and their properties</p>
        </div>
        <button
          onClick={handleAddDestination}
          className="flex items-center gap-2 px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition shadow-md"
        >
          <Plus className="w-5 h-5" />
          Add Destination
        </button>
      </div>

      {/* Destinations List */}
      <div className="space-y-6">
        {destinations.map((destination) => (
          <div key={`${destination.id}-${destination.image}`} className="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            {/* Destination Header */}
            <div className="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 border-b border-gray-200">
              <div className="flex items-start justify-between">
                <div className="flex items-start gap-4 flex-1">
                  {destination.image && (
                    <img 
                      src={`/${destination.image}`} 
                      alt={destination.name}
                      className="w-24 h-24 object-cover rounded-lg shadow-sm"
                    />
                  )}
                  <div className="flex-1">
                    <h2 className="text-2xl font-bold text-gray-800 flex items-center gap-2">
                      <MapPin className="w-6 h-6 text-blue-500" />
                      {destination.name}
                    </h2>
                    <p className="text-sm text-gray-600 mt-1">{destination.category}</p>
                    {destination.cardHeading && (
                      <p className="text-md font-semibold text-gray-700 mt-2">{destination.cardHeading}</p>
                    )}
                    {destination.cardParagraph && (
                      <p className="text-gray-600 mt-2">{destination.cardParagraph}</p>
                    )}
                  </div>
                </div>
                <div className="flex gap-2">
                  <button
                    onClick={() => handleEditDestination(destination)}
                    className="flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition"
                  >
                    <Edit className="w-4 h-4" />
                    Edit
                  </button>
                  <button
                    onClick={() => handleAddProperty(destination)}
                    className="flex items-center gap-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition"
                  >
                    <Plus className="w-4 h-4" />
                    Add Property
                  </button>
                  <button
                    onClick={() => handleDeleteDestination(destination.id)}
                    className="flex items-center gap-2 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition"
                  >
                    <Trash2 className="w-4 h-4" />
                  </button>
                </div>
              </div>
            </div>

            {/* Properties Grid */}
            <div className="p-6">
              {destination.subCards && destination.subCards.length > 0 ? (
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                  {destination.subCards.map((property) => (
                    <div key={property.id} className="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                      {/* Property Images */}
                      {property.images && property.images.length > 0 && (
                        <img 
                          src={`/${property.images[0]}`} 
                          alt={property.name}
                          className="w-full h-40 object-cover rounded-lg mb-3"
                        />
                      )}
                      
                      {/* Property Info */}
                      <div className="flex items-start justify-between mb-2">
                        <div className="flex-1">
                          <h3 className="font-semibold text-gray-800">{property.name}</h3>
                          <p className="text-sm text-gray-600">{property.category}</p>
                          {property.location && (
                            <p className="text-xs text-gray-500 mt-1 flex items-center gap-1">
                              <MapPin className="w-3 h-3" />
                              {property.location}
                            </p>
                          )}
                        </div>
                      </div>

                      {/* Property Details Preview */}
                      {property.propertyDetails && (
                        <div className="text-xs text-gray-600 mb-3 space-y-1">
                          {Object.entries(property.propertyDetails).slice(0, 3).map(([key, value]) => (
                            <div key={key} className="flex justify-between">
                              <span className="font-medium">{key}:</span>
                              <span>{value}</span>
                            </div>
                          ))}
                        </div>
                      )}

                      {/* Actions */}
                      <div className="flex gap-2 mt-3">
                        <button
                          onClick={() => handleEditProperty(destination, property)}
                          className="flex-1 flex items-center justify-center gap-1 px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition text-sm"
                        >
                          <Edit className="w-4 h-4" />
                          Edit
                        </button>
                        <button
                          onClick={() => handleDeleteProperty(destination, property.id)}
                          className="flex items-center justify-center gap-1 px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition text-sm"
                        >
                          <Trash2 className="w-4 h-4" />
                        </button>
                      </div>
                    </div>
                  ))}
                </div>
              ) : (
                <div className="text-center py-12 text-gray-500">
                  <Building2 className="w-12 h-12 mx-auto mb-3 opacity-50" />
                  <p>No properties added yet</p>
                  <button
                    onClick={() => handleAddProperty(destination)}
                    className="mt-4 text-blue-500 hover:text-blue-600"
                  >
                    Add your first property
                  </button>
                </div>
              )}
            </div>
          </div>
        ))}

        {destinations.length === 0 && (
          <div className="text-center py-20 bg-white rounded-xl border border-gray-200">
            <MapPin className="w-16 h-16 mx-auto mb-4 text-gray-400" />
            <h3 className="text-xl font-semibold text-gray-700 mb-2">No Destinations Yet</h3>
            <p className="text-gray-500 mb-6">Start by adding your first destination</p>
            <button
              onClick={handleAddDestination}
              className="inline-flex items-center gap-2 px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition"
            >
              <Plus className="w-5 h-5" />
              Add First Destination
            </button>
          </div>
        )}
      </div>

      {/* Destination Form Modal */}
      {showDestinationForm && (
        <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 overflow-y-auto">
          <div className="bg-white rounded-xl shadow-2xl max-w-2xl w-full my-8">
            {/* Modal Header */}
            <div className="flex items-center justify-between p-6 border-b border-gray-200">
              <h2 className="text-2xl font-bold text-gray-800">
                {editingDestination ? 'Edit Destination' : 'Add New Destination'}
              </h2>
              <button
                onClick={() => setShowDestinationForm(false)}
                className="text-gray-500 hover:text-gray-700"
              >
                <X className="w-6 h-6" />
              </button>
            </div>

            {/* Modal Body */}
            <div className="p-6 max-h-[60vh] overflow-y-auto space-y-4">
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-2">
                  Destination Name *
                </label>
                <input
                  type="text"
                  value={destinationForm.name}
                  onChange={(e) => handleDestinationFormChange('name', e.target.value)}
                  className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="e.g., Maldives Atoll Retreat"
                />
              </div>

              <div>
                <label className="block text-sm font-medium text-gray-700 mb-2">
                  Category *
                </label>
                <input
                  type="text"
                  value={destinationForm.category}
                  onChange={(e) => handleDestinationFormChange('category', e.target.value)}
                  className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="e.g., Tropical Island, Mountain Retreat"
                />
              </div>

              <div>
                <label className="block text-sm font-medium text-gray-700 mb-2">
                  Card Heading
                </label>
                <input
                  type="text"
                  value={destinationForm.cardHeading}
                  onChange={(e) => handleDestinationFormChange('cardHeading', e.target.value)}
                  className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="e.g., The Ultimate Ocean Escape"
                />
              </div>

              <div>
                <label className="block text-sm font-medium text-gray-700 mb-2">
                  Description
                </label>
                <textarea
                  value={destinationForm.cardParagraph}
                  onChange={(e) => handleDestinationFormChange('cardParagraph', e.target.value)}
                  rows={3}
                  className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Brief description of the destination"
                />
              </div>

              <div>
                <label className="block text-sm font-medium text-gray-700 mb-2">
                  Destination Image
                </label>
                <input
                  type="file"
                  accept="image/*"
                  onChange={async (e) => {
                    const file = e.target.files[0];
                    if (file) {
                      const paths = await handleImageUpload([file], null, true);
                      if (paths.length > 0) {
                        setDestinationForm(prev => ({ ...prev, image: paths[0] }));
                      }
                    }
                    e.target.value = ''; // Reset input
                  }}
                  className="w-full px-4 py-2 border border-gray-300 rounded-lg"
                  disabled={uploadingImages}
                />
                {uploadingImages && (
                  <p className="text-sm text-blue-500 mt-2">Uploading image...</p>
                )}
                {destinationForm.image && (
                  <div className="mt-3 relative">
                    <img 
                      src={`/${destinationForm.image}`} 
                      alt="Preview"
                      className="w-full h-48 object-cover rounded-lg border border-gray-200"
                      onError={(e) => {
                        console.error('Image failed to load:', destinationForm.image);
                        e.target.src = 'data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="400" height="300"><rect fill="%23f3f4f6" width="400" height="300"/><text x="50%" y="50%" text-anchor="middle" fill="%239ca3af">Image Preview</text></svg>';
                      }}
                    />
                    <button
                      type="button"
                      onClick={() => setDestinationForm(prev => ({ ...prev, image: '' }))}
                      className="absolute top-2 right-2 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 shadow-lg"
                    >
                      <X className="w-4 h-4" />
                    </button>
                  </div>
                )}
              </div>
            </div>

            {/* Modal Footer */}
            <div className="flex items-center justify-end gap-3 p-6 border-t border-gray-200">
              <button
                onClick={() => setShowDestinationForm(false)}
                className="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition"
              >
                Cancel
              </button>
              <button
                onClick={handleSaveDestination}
                className="flex items-center gap-2 px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition"
              >
                <Save className="w-4 h-4" />
                Save Destination
              </button>
            </div>
          </div>
        </div>
      )}

      {/* Property Form Modal - (Same as before, keeping it compact) */}
      {showPropertyForm && (
        <PropertyFormModal
          propertyForm={propertyForm}
          editingProperty={editingProperty}
          uploadingImages={uploadingImages}
          onClose={() => setShowPropertyForm(false)}
          onSave={handleSaveProperty}
          onFormChange={handlePropertyFormChange}
          onImageUpload={handleImageUpload}
          onArrayFieldAdd={handleArrayFieldAdd}
          onArrayFieldRemove={handleArrayFieldRemove}
          onObjectFieldChange={handleObjectFieldChange}
        />
      )}
    </div>
  );
}

// Separate Property Form Modal Component (keeping code organized)
function PropertyFormModal({ 
  propertyForm, 
  editingProperty, 
  uploadingImages,
  onClose, 
  onSave, 
  onFormChange,
  onImageUpload,
  onArrayFieldAdd,
  onArrayFieldRemove,
  onObjectFieldChange
}) {
  return (
    <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 overflow-y-auto">
      <div className="bg-white rounded-xl shadow-2xl max-w-4xl w-full my-8">
        {/* Header */}
        <div className="flex items-center justify-between p-6 border-b border-gray-200">
          <h2 className="text-2xl font-bold text-gray-800">
            {editingProperty ? 'Edit Property' : 'Add New Property'}
          </h2>
          <button onClick={onClose} className="text-gray-500 hover:text-gray-700">
            <X className="w-6 h-6" />
          </button>
        </div>

        {/* Body */}
        <div className="p-6 max-h-[70vh] overflow-y-auto space-y-6">
          {/* Basic Info */}
          <div className="space-y-4">
            <h3 className="text-lg font-semibold text-gray-800">Basic Information</h3>
            
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-2">Property Name *</label>
                <input
                  type="text"
                  value={propertyForm.name}
                  onChange={(e) => onFormChange('name', e.target.value)}
                  className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="e.g., Overwater Bungalows"
                />
              </div>

              <div>
                <label className="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                <input
                  type="text"
                  value={propertyForm.category}
                  onChange={(e) => onFormChange('category', e.target.value)}
                  className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="e.g., Accommodation, Experience"
                />
              </div>

              <div>
                <label className="block text-sm font-medium text-gray-700 mb-2">Location</label>
                <input
                  type="text"
                  value={propertyForm.location}
                  onChange={(e) => onFormChange('location', e.target.value)}
                  className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="e.g., Valliyakolli, Wayanad"
                />
              </div>
            </div>

            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">Description</label>
              <textarea
                value={propertyForm.description}
                onChange={(e) => onFormChange('description', e.target.value)}
                rows={3}
                className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Brief description of the property"
              />
            </div>
          </div>

          {/* Images */}
          <div className="space-y-4">
            <h3 className="text-lg font-semibold text-gray-800">Images</h3>
            
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">Upload Images</label>
              <input
                type="file"
                multiple
                accept="image/*"
                onChange={async (e) => {
                  const files = Array.from(e.target.files);
                  // Use property name for folder if available
                  const propertyName = propertyForm.name || 'temp';
                  const paths = await onImageUpload(files, propertyName);
                  if (paths.length > 0) {
                    onFormChange('images', [...propertyForm.images, ...paths]);
                  }
                  e.target.value = ''; // Reset input
                }}
                className="w-full px-4 py-2 border border-gray-300 rounded-lg"
                disabled={uploadingImages}
              />
              {uploadingImages && <p className="text-sm text-blue-500 mt-2">Uploading images...</p>}
            </div>

            {propertyForm.images.length > 0 && (
              <div className="grid grid-cols-4 gap-4">
                {propertyForm.images.map((img, index) => (
                  <div key={index} className="relative group">
                    <img 
                      src={`/${img}`} 
                      alt={`Property ${index + 1}`}
                      className="w-full h-24 object-cover rounded-lg"
                    />
                    <button
                      onClick={() => {
                        const newImages = propertyForm.images.filter((_, i) => i !== index);
                        onFormChange('images', newImages);
                      }}
                      className="absolute top-1 right-1 bg-red-500 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition"
                    >
                      <X className="w-4 h-4" />
                    </button>
                  </div>
                ))}
              </div>
            )}
          </div>

          {/* Property Details, Inclusions, etc. - Simplified for space */}
          <PropertyDetailsSection 
            details={propertyForm.propertyDetails}
            onChange={onObjectFieldChange}
          />

          <ArrayFieldSection
            title="Inclusions"
            items={propertyForm.inclusions}
            onAdd={(value) => onArrayFieldAdd('inclusions', value)}
            onRemove={(index) => onArrayFieldRemove('inclusions', index)}
            placeholder="e.g., Free Wi-Fi, Breakfast"
          />

          <PropertyDetailsSection 
            title="Check-in / Check-out"
            details={propertyForm.checkInOut}
            onChange={(key, value) => onObjectFieldChange('checkInOut', key, value)}
          />

          <ArrayFieldSection
            title="Add-on Experiences"
            items={propertyForm.addOnExperiences}
            onAdd={(value) => onArrayFieldAdd('addOnExperiences', value)}
            onRemove={(index) => onArrayFieldRemove('addOnExperiences', index)}
            placeholder="e.g., Campfire with music"
          />

          <ArrayFieldSection
            title="Nearby Attractions"
            items={propertyForm.nearbyAttractions}
            onAdd={(value) => onArrayFieldAdd('nearbyAttractions', value)}
            onRemove={(index) => onArrayFieldRemove('nearbyAttractions', index)}
            placeholder="e.g., Banasura Sagar Dam"
          />
        </div>

        {/* Footer */}
        <div className="flex items-center justify-end gap-3 p-6 border-t border-gray-200">
          <button
            onClick={onClose}
            className="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition"
          >
            Cancel
          </button>
          <button
            onClick={onSave}
            className="flex items-center gap-2 px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition"
          >
            <Save className="w-4 h-4" />
            Save Property
          </button>
        </div>
      </div>
    </div>
  );
}

// Helper Components
function PropertyDetailsSection({ title = "Property Details", details, onChange }) {
  const [newKey, setNewKey] = useState('');
  const [newValue, setNewValue] = useState('');

  const handleAdd = () => {
    if (newKey && newValue) {
      onChange(newKey, newValue);
      setNewKey('');
      setNewValue('');
    }
  };

  return (
    <div className="space-y-4">
      <h3 className="text-lg font-semibold text-gray-800">{title}</h3>
      
      {Object.entries(details || {}).map(([key, value]) => (
        <div key={key} className="flex items-center gap-2">
          <input
            type="text"
            value={key}
            readOnly
            className="flex-1 px-4 py-2 border border-gray-300 rounded-lg bg-gray-50"
          />
          <input
            type="text"
            value={value}
            onChange={(e) => onChange(key, e.target.value)}
            className="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
          />
        </div>
      ))}

      <div className="flex items-center gap-2">
        <input
          type="text"
          value={newKey}
          onChange={(e) => setNewKey(e.target.value)}
          placeholder="Key (e.g., BHK)"
          className="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
        />
        <input
          type="text"
          value={newValue}
          onChange={(e) => setNewValue(e.target.value)}
          placeholder="Value (e.g., 3 BHK)"
          className="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
        />
        <button
          onClick={handleAdd}
          className="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition"
        >
          <Plus className="w-4 h-4" />
        </button>
      </div>
    </div>
  );
}

function ArrayFieldSection({ title, items, onAdd, onRemove, placeholder }) {
  const [newItem, setNewItem] = useState('');

  const handleAdd = () => {
    if (newItem.trim()) {
      onAdd(newItem);
      setNewItem('');
    }
  };

  return (
    <div className="space-y-4">
      <h3 className="text-lg font-semibold text-gray-800">{title}</h3>
      
      {items && items.length > 0 && (
        <div className="space-y-2">
          {items.map((item, index) => (
            <div key={index} className="flex items-center gap-2">
              <input
                type="text"
                value={item}
                readOnly
                className="flex-1 px-4 py-2 border border-gray-300 rounded-lg bg-gray-50"
              />
              <button
                onClick={() => onRemove(index)}
                className="p-2 text-red-500 hover:bg-red-50 rounded-lg"
              >
                <Trash2 className="w-4 h-4" />
              </button>
            </div>
          ))}
        </div>
      )}

      <div className="flex items-center gap-2">
        <input
          type="text"
          value={newItem}
          onChange={(e) => setNewItem(e.target.value)}
          onKeyPress={(e) => e.key === 'Enter' && handleAdd()}
          placeholder={placeholder}
          className="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
        />
        <button
          onClick={handleAdd}
          className="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition"
        >
          <Plus className="w-4 h-4" />
        </button>
      </div>
    </div>
  );
}

export default DestinationsManager;
