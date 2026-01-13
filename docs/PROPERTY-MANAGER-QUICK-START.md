# 🚀 Property Manager - Quick Start

## Access
**URL**: http://localhost:5000/admin  
**Menu**: Click "Destinations & Properties" (📍 icon)

## Add Property - 3 Steps

### 1️⃣ Click "Add Property" on any destination

### 2️⃣ Fill Required Fields
- **Name**: e.g., "Luxury Villa"
- **Category**: e.g., "Accommodation"

### 3️⃣ Upload Images & Save
- Click "Upload Images"
- Select files
- Click "Save Property"

## Property Fields

| Field | Example | Required |
|-------|---------|----------|
| Name | Overwater Bungalows | ✅ Yes |
| Category | Accommodation | ✅ Yes |
| Location | Wayanad, Kerala | ⭕ Optional |
| Description | Luxury villa with... | ⭕ Optional |
| Images | Upload JPG/PNG | ⭕ Optional |
| Property Details | BHK: 3 BHK | ⭕ Optional |
| Inclusions | Free Wi-Fi, Pool | ⭕ Optional |
| Check-in/out | 2 PM / 11 AM | ⭕ Optional |
| Add-ons | Campfire, BBQ | ⭕ Optional |
| Attractions | Nearby places | ⭕ Optional |

## Image Upload

**Location**: `assets/images/properties/destinations/`  
**Formats**: JPG, PNG, WebP  
**Max Size**: 50MB per file  
**Multiple**: Yes, upload as many as needed

## Quick Actions

| Action | Button | Location |
|--------|--------|----------|
| Add Property | Blue "Add Property" | Destination card header |
| Edit Property | Blue "Edit" | Property card |
| Delete Property | Red trash icon | Property card |
| Upload Images | "Upload Images" | Property form |
| Remove Image | ❌ on hover | Image thumbnail |

## Data Structure

```
Destination (e.g., Wayanad)
  └── Property 1 (e.g., Villa)
      ├── Images []
      ├── Details {}
      ├── Inclusions []
      └── ...
  └── Property 2 (e.g., Resort)
      └── ...
```

## Tips

✅ **Use descriptive names**: "3BHK Villa with Pool" not "Property 1"  
✅ **Upload quality images**: 1200x800px recommended  
✅ **Fill all sections**: More details = better presentation  
✅ **Save often**: Click save after making changes  
✅ **Test on website**: Check how it looks on the frontend  

## Troubleshooting

| Problem | Solution |
|---------|----------|
| Can't save | Fill Name & Category (required) |
| Images not uploading | Check file size < 50MB |
| Property not showing | Refresh page, check JSON saved |
| Delete not working | Confirm deletion dialog |

## Need Help?

📖 **Full Guide**: See `DESTINATIONS-MANAGER-GUIDE.md`  
🆘 **Support**: Check browser console for errors  
🔄 **Refresh**: Try F5 if something doesn't update  

---

**Happy Property Managing! 🏡**
