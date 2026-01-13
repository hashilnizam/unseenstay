# Install Sharp for Favicon Processing

## Quick Setup

Run this command in your terminal:

```bash
cd cms-app
npm install
```

This will install Sharp (v0.33.0) which is now included in `package.json`.

## Manual Installation (if needed)

If the above doesn't work, install Sharp manually:

```bash
cd cms-app
npm install sharp
```

## Restart Server

After installing, restart your CMS server:

```bash
# Stop the server (Ctrl+C)
# Then start again:
npm run dev
# OR
npm start
```

## Verify Installation

1. Go to CMS → Content Editor → SEO & Site Configuration
2. Try uploading a favicon
3. You should see: "Favicon processed successfully!"
4. If you see a warning about Sharp, the installation didn't work

## Without Sharp

The favicon upload **will still work** without Sharp, but:
- ❌ No automatic resizing
- ❌ Original image uploaded as-is
- ⚠️ You'll get a warning message
- 📝 You'll need to manually resize images to 32x32px before upload

## System Requirements

Sharp requires:
- **Node.js:** 14.15.0 or higher ✅
- **Windows:** Works out of the box ✅
- **Linux:** May need build tools
- **macOS:** Works out of the box ✅

## Troubleshooting

### Issue: Installation fails on Windows

**Solution:**
```bash
npm install --ignore-scripts=false --foreground-scripts --verbose sharp
```

### Issue: "Node version not supported"

**Solution:** Update Node.js to 14.15.0 or higher

### Issue: Still getting warnings after install

**Solution:**
1. Delete `node_modules` folder
2. Run `npm install` again
3. Restart server

---

**Status:** Ready to use after running `npm install`!
