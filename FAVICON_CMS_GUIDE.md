# Favicon Upload & Auto-Resize - CMS Guide

## Overview
Added dynamic favicon management with automatic image resizing to the CMS. Upload any image and it's automatically converted to the correct favicon format and sizes.

## Features

✅ **Upload Any Image** - Works with JPG, PNG, GIF, WebP  
✅ **Auto-Resize** - Automatically resized to 32x32px, 16x16px, and 192x192px  
✅ **Auto-Convert** - Converted to PNG format for best browser compatibility  
✅ **Smart Cropping** - Centered and cropped to fit square dimensions  
✅ **Live Preview** - See your favicon in the CMS before saving  
✅ **Dynamic Updates** - Favicon updates instantly on the website  

## Installation Requirements

### Install Sharp (Image Processing Library)

The favicon upload requires the `sharp` library for image processing. Install it:

```bash
cd cms-app
npm install sharp
```

**Without Sharp:** The upload will still work, but images won't be resized automatically. You'll get a warning message.

## Changes Made

### 1. **Backend** (`cms-app/server/routes/upload.js`)
Added new `/upload/favicon` endpoint that:
- Accepts any image file
- Resizes to multiple sizes: 32x32, 16x16, 192x192
- Converts to PNG format
- Saves as `favicon.png` and size variants
- Returns path to use in content.json

### 2. **Content Structure** (`assets/data/content.json`)
Added `favicon` field to site section:

```json
{
  "site": {
    "title": "UnseenStay - Luxury Resort Destinations",
    "description": "...",
    "favicon": "assets/images/favicon.png",
    ...
  }
}
```

### 3. **CMS Frontend** (`cms-app/client/src/components/ContentEditor.jsx`)
Enhanced **SEO & Site Configuration** section with:
- File upload input for favicon
- Real-time upload with progress indicator
- Live preview of uploaded favicon (32x32)
- Automatic processing notifications
- Manual path input as fallback
- Helpful tips and instructions

**UI Features:**
```
✓ Drag & drop or browse file
✓ Auto-resize badge indicator
✓ Processing spinner during upload
✓ Success/error toast notifications
✓ Preview with actual size display
✓ Manual path editing option
```

### 4. **Frontend Rendering** (`assets/core/core.js`)
Enhanced `renderTitle()` function (now handles all SEO) to:
- Dynamically create/update favicon link tag
- Update meta description
- Update meta keywords
- Update meta author
- Update OG image
- All changes apply without page reload

## How to Use

### In CMS:

1. **Login to CMS** at `/cms-app`
2. **Go to Content Editor**
3. **Find "SEO & Site Configuration"** section
4. **Scroll to "Favicon (Browser Tab Icon)"**
5. **Click "Choose File"** and select any image:
   - Logo
   - Icon
   - Brand mark
   - Any square or rectangular image
6. **Upload** - Processing happens automatically
7. **Preview** - See the 32x32 result
8. **Click "Save"** at the top of the section

### What Happens:

1. ✅ Image uploads to server
2. ✅ Sharp processes and resizes:
   - `favicon.png` (32x32) - Main favicon
   - `favicon-16x16.png` (16x16) - Legacy browsers
   - `favicon-192x192.png` (192x192) - Mobile/PWA
3. ✅ Path saved to content.json
4. ✅ Frontend automatically updates
5. ✅ Browser tab shows new icon

## Generated Files

After upload, these files are created in `assets/images/`:

- `favicon.png` - 32x32px (main)
- `favicon-16x16.png` - 16x16px (legacy)
- `favicon-192x192.png` - 192x192px (mobile)

## Technical Details

### Image Processing
```javascript
// Resize to 32x32 with smart cropping
await sharp(inputFile)
  .resize(32, 32, {
    fit: 'cover',         // Crop to fill
    position: 'center'    // Center the crop
  })
  .png()                  // Convert to PNG
  .toFile('favicon.png');
```

### Dynamic Favicon Update
```javascript
// Create or update favicon link tag
let faviconLink = document.querySelector('link[rel="icon"]');
if (!faviconLink) {
    faviconLink = document.createElement('link');
    faviconLink.rel = 'icon';
    faviconLink.type = 'image/png';
    document.head.appendChild(faviconLink);
}
faviconLink.href = data.site.favicon;
```

## Browser Compatibility

| Browser | Size Used | Format |
|---------|-----------|--------|
| Chrome | 32x32 | PNG ✅ |
| Firefox | 32x32 | PNG ✅ |
| Safari | 32x32 | PNG ✅ |
| Edge | 32x32 | PNG ✅ |
| IE11 | 16x16 | PNG ✅ |
| Mobile | 192x192 | PNG ✅ |

## File Structure

```
unseenstay/
├── assets/
│   ├── core/
│   │   └── core.js              ← Updated: Dynamic favicon rendering
│   ├── data/
│   │   └── content.json         ← Updated: Added favicon field
│   └── images/
│       ├── favicon.png          ← Generated: 32x32
│       ├── favicon-16x16.png    ← Generated: 16x16
│       └── favicon-192x192.png  ← Generated: 192x192
└── cms-app/
    ├── package.json              ← Needs: npm install sharp
    ├── client/src/components/
    │   └── ContentEditor.jsx     ← Updated: Favicon upload UI
    └── server/routes/
        └── upload.js             ← Updated: /favicon endpoint
```

## Best Practices

### Image Requirements
- **Format:** Any (JPG, PNG, GIF, WebP)
- **Size:** Any size (will be resized)
- **Aspect Ratio:** Square works best
- **Content:** Simple, recognizable icon
- **Colors:** High contrast for visibility

### Design Tips
✅ **Use simple designs** - Complex images don't work at 32x32  
✅ **High contrast** - Stands out in browser tabs  
✅ **Brand colors** - Matches your brand identity  
✅ **Test dark/light modes** - Works on both browser themes  
✅ **Avoid text** - Usually unreadable at small sizes  

## Troubleshooting

### Issue: "Sharp not installed" warning

**Solution:**
```bash
cd cms-app
npm install sharp
npm restart
```

### Issue: Favicon doesn't update in browser

**Solution:**
1. Hard refresh: `Ctrl+F5` or `Cmd+Shift+R`
2. Clear browser cache
3. Try incognito/private mode

### Issue: Upload fails

**Check:**
- File is an image format
- File size < 50MB
- Server has write permissions to `assets/images/`
- CMS server is running

### Issue: Image looks distorted

**Cause:** Non-square image being cropped to square

**Solution:**
- Upload a square image
- OR pre-crop your image to square before upload
- OR use an image with centered subject

## API Reference

### Upload Endpoint

**POST** `/api/upload/favicon`

**Headers:**
```
Authorization: Bearer <token>
Content-Type: multipart/form-data
```

**Body:**
```
file: <image file>
```

**Response:**
```json
{
  "success": true,
  "message": "Favicon processed successfully",
  "path": "assets/images/favicon.png",
  "sizes": {
    "32x32": "assets/images/favicon.png",
    "16x16": "assets/images/favicon-16x16.png",
    "192x192": "assets/images/favicon-192x192.png"
  }
}
```

## Security

✅ **Authentication required** - Only logged-in admins can upload  
✅ **File type validation** - Only image files accepted  
✅ **Size limits** - 50MB maximum  
✅ **Path sanitization** - Prevents directory traversal  
✅ **Secure storage** - Files stored in designated folder  

## Future Enhancements

- [ ] Support .ico format for maximum compatibility
- [ ] Apple touch icon generation (180x180)
- [ ] PWA manifest icons (512x512)
- [ ] SVG favicon support for modern browsers
- [ ] Batch icon generation for all platforms
- [ ] Icon preview in multiple sizes
- [ ] Drag & drop interface
- [ ] Crop tool before upload

---

**Date:** October 28, 2025  
**Issue:** Favicon was hardcoded in HTML  
**Solution:** CMS-managed with auto-resize  
**Status:** ✅ Complete
