# 🗺️ Destinations & Properties Manager - User Guide

## ✅ What's New

A complete **Destinations & Properties Management System** has been added to your admin panel!

---

## 🎯 Features

### 1. **Visual Destination Management**
- View all destinations (Wayanad, Ooty, Maldives, etc.)
- See destination cards with images and descriptions
- Manage properties within each destination

### 2. **Property Management**
- ✅ Add new properties to any destination
- ✅ Edit existing properties
- ✅ Delete properties
- ✅ Upload multiple images per property
- ✅ Manage all property details

### 3. **Image Upload System**
- Upload property images directly from the form
- Images automatically saved to `assets/images/properties/destinations/`
- Image paths automatically updated in JSON
- Support for multiple images per property

---

## 📁 Folder Structure

```
unseenstay/
├── assets/
│   └── images/
│       └── properties/              ← NEW!
│           └── destinations/        ← Property images stored here
│               ├── property-1.jpg
│               ├── property-2.jpg
│               └── ...
└── cms-app/
    └── client/
        └── src/
            └── components/
                └── DestinationsManager.jsx  ← NEW Component!
```

---

## 🚀 How to Use

### Access the Manager

1. **Login to Admin Panel**: http://localhost:5000/admin
2. **Click "Destinations & Properties"** in the sidebar (📍 icon)

### View Destinations

You'll see all your destinations displayed as cards:
- **Destination Name** (e.g., "Maldives Atoll Retreat")
- **Category** (e.g., "Tropical Island")
- **Description**
- **Thumbnail Image**
- **List of Properties** (subCards)

---

## ➕ Adding a New Property

### Step 1: Click "Add Property"
Click the blue **"Add Property"** button on any destination card.

### Step 2: Fill Basic Information

**Required Fields:**
- **Property Name** - e.g., "Overwater Bungalows"
- **Category** - e.g., "Accommodation", "Experience", "Wellness"

**Optional Fields:**
- **Location** - e.g., "Valliyakolli, Wayanad"
- **Description** - Brief description of the property

### Step 3: Upload Images

1. Click **"Upload Images"** button
2. Select one or multiple images
3. Images will upload automatically
4. Preview thumbnails appear below
5. Remove any image by clicking the ❌ on hover

**Images are saved to:** `assets/images/properties/destinations/`

### Step 4: Add Property Details

Add key-value pairs for property specifications:
- **BHK**: "3 BHK"
- **Resort**: "Luxury Beach Resort"
- **Max Guests**: "6 People"
- **Area**: "2500 sq ft"

Click **+** to add each detail.

### Step 5: Add Inclusions

List what's included with the property:
- Free Wi-Fi
- Breakfast (2 Varieties)
- Swimming Pool
- etc.

Type each item and press **Enter** or click **+**

### Step 6: Add Check-in/Check-out Times

Add timing details:
- **Check-in**: "2:00 PM - 3:00 PM"
- **Check-out**: "11:00 AM - 11:30 AM"

### Step 7: Add-on Experiences

List additional services available:
- Campfire with music (Extra charge)
- Customized BBQ options
- Guided Nature Walk
- etc.

### Step 8: Nearby Attractions

List tourist attractions nearby:
- Banasura Sagar Dam
- Meenmutty Waterfalls
- Chembra Peak
- etc.

### Step 9: Save

Click **"Save Property"** button at the bottom.

---

## ✏️ Editing a Property

1. Find the property card
2. Click the **"Edit"** button (blue)
3. Modify any fields
4. Upload new images or remove existing ones
5. Click **"Save Property"**

---

## 🗑️ Deleting a Property

1. Find the property card
2. Click the **"Delete"** button (red trash icon)
3. Confirm deletion
4. Property is removed from the destination

---

## 📊 Data Structure

### JSON Structure Explained

```json
{
  "destinations": {
    "cards": [
      {
        "id": "dest1",
        "name": "Maldives Atoll Retreat",     ← Destination
        "category": "Tropical Island",
        "image": "assets/images/portfolio-3-sm.jpg",
        "cardHeading": "The Ultimate Ocean Escape",
        "cardParagraph": "Experience paradise...",
        
        "subCards": [                          ← Properties in this destination
          {
            "id": "sub1",
            "name": "Overwater Bungalows",     ← Property
            "category": "Accommodation",
            "location": "Valliyakolli, Wayanad",
            "images": [                        ← Property images
              "assets/images/properties/destinations/bungalow-1.jpg",
              "assets/images/properties/destinations/bungalow-2.jpg"
            ],
            "propertyDetails": {
              "BHK": "3 BHK",
              "Resort": "Luxury Beach Resort",
              "Max Guests": "6 People"
            },
            "inclusions": [
              "Free Wi-Fi",
              "Breakfast",
              "Swimming Pool"
            ],
            "checkInOut": {
              "Check-in": "2:00 PM - 3:00 PM",
              "Check-out": "11:00 AM - 11:30 AM"
            },
            "addOnExperiences": [
              "Campfire with music"
            ],
            "nearbyAttractions": [
              "Banasura Sagar Dam"
            ]
          }
        ]
      }
    ]
  }
}
```

---

## 🎨 UI Features

### Destination Card
- **Header**: Gradient background with destination info
- **Thumbnail**: Destination main image
- **Add Property Button**: Quick access to add properties

### Property Card
- **Image Preview**: First uploaded image shown
- **Property Name & Category**
- **Location** with map pin icon
- **Property Details Preview**: Shows first 3 details
- **Edit/Delete Buttons**: Quick actions

### Property Form Modal
- **Full-screen modal** with scrollable content
- **Organized sections** for different property aspects
- **Real-time image preview**
- **Easy-to-use array inputs** for lists
- **Key-value inputs** for property details

---

## 💡 Tips & Best Practices

### Image Guidelines
- **Format**: JPG, PNG, WebP
- **Size**: Recommended max 2MB per image
- **Dimensions**: 1200x800px or similar aspect ratio
- **Naming**: Use descriptive names (e.g., "wayanad-villa-exterior.jpg")

### Property Naming
- Be descriptive: "Luxury Overwater Bungalow" vs "Room 1"
- Include key features: "3BHK Villa with Private Pool"
- Keep it concise: 3-6 words ideal

### Categories
Common categories:
- **Accommodation**: Rooms, villas, bungalows, tents
- **Experience**: Tours, activities, adventures
- **Wellness**: Spa, yoga, meditation
- **Culinary**: Dining, cooking classes
- **Adventure**: Safaris, expeditions, sports

### Organizing Properties
- Group similar properties together
- Use consistent naming conventions
- Keep property details updated
- Remove outdated properties

---

## 🔧 Technical Details

### API Endpoints Used
- `GET /api/content` - Fetch all destinations
- `PUT /api/content` - Update destinations/properties
- `POST /api/upload` - Upload property images

### Image Upload Process
1. User selects images
2. Images uploaded to `/api/upload` with `folder: 'properties/destinations'`
3. Server saves to `assets/images/properties/destinations/`
4. Returns relative path: `assets/images/properties/destinations/filename.jpg`
5. Path added to property's `images` array
6. JSON updated and saved

### Auto-Generated IDs
- Destinations: `dest1`, `dest2`, etc.
- Properties: `sub1`, `sub2`, etc.
- New properties: `sub{timestamp}` (e.g., `sub1728123456789`)

---

## 🐛 Troubleshooting

### Images Not Uploading
**Problem**: Upload fails or images don't appear

**Solutions**:
1. Check file size (max 50MB)
2. Verify file format (JPG, PNG, WebP)
3. Check server is running
4. Verify you're logged in
5. Check browser console for errors

### Property Not Saving
**Problem**: Save button doesn't work

**Solutions**:
1. Fill required fields (Name, Category)
2. Check browser console for errors
3. Verify API connection
4. Try refreshing the page

### Images Not Displaying
**Problem**: Uploaded images show broken

**Solutions**:
1. Check image path in JSON
2. Verify image exists in `assets/images/properties/destinations/`
3. Check file permissions
4. Clear browser cache

### Can't Delete Property
**Problem**: Delete button doesn't work

**Solutions**:
1. Confirm deletion dialog appears
2. Check you have proper permissions
3. Verify property ID exists
4. Check browser console for errors

---

## 📱 Mobile Responsive

The Destinations Manager is fully responsive:
- **Desktop**: 3-column property grid
- **Tablet**: 2-column property grid
- **Mobile**: 1-column property grid
- **Modal**: Scrollable on all devices

---

## 🔐 Security

- ✅ Authentication required
- ✅ File type validation
- ✅ File size limits (50MB)
- ✅ Path traversal protection
- ✅ Secure file storage

---

## 📈 Future Enhancements

Potential features for future updates:
- Drag-and-drop image reordering
- Bulk property import/export
- Property duplication
- Advanced search/filter
- Property analytics
- Booking integration
- Price management
- Availability calendar

---

## 🎓 Example Workflow

### Adding a New Wayanad Villa

1. **Navigate** to Destinations & Properties
2. **Find** "Wayanad" destination card
3. **Click** "Add Property"
4. **Enter Details**:
   - Name: "Luxury 3BHK Villa with Pool"
   - Category: "Accommodation"
   - Location: "Vythiri, Wayanad"
   - Description: "Spacious villa with private pool..."
5. **Upload Images**: Select 5 villa photos
6. **Add Property Details**:
   - BHK: "3 BHK"
   - Max Guests: "8 People"
   - Area: "3000 sq ft"
7. **Add Inclusions**: Wi-Fi, Pool, Breakfast, etc.
8. **Set Check-in/out**: 2 PM / 11 AM
9. **Add Experiences**: Campfire, BBQ, Nature Walk
10. **Add Attractions**: Nearby waterfalls, dams
11. **Click** "Save Property"
12. **Done!** Property appears in Wayanad card

---

## ✅ Summary

You now have a complete property management system that allows you to:

✅ Manage all destinations visually  
✅ Add/edit/delete properties easily  
✅ Upload images with automatic path management  
✅ Organize property details systematically  
✅ Update content without touching JSON directly  

**Access it now at:** http://localhost:5000/admin → Destinations & Properties

---

*Last Updated: 2025-10-05*  
*Version: 1.0*
