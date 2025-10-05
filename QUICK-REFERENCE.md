# 🚀 UnseenStay - Quick Reference

## ⚡ Quick Start

```bash
# Start server
start-cms.bat

# Or manually
cd cms-app
## 🔗 URLs

- **Website**: http://localhost:5000/
-### **Admin Access:**
- URL: `http://localhost:5000/admin`
- **Credentials**: Check `.env` file

## 📁 Important Files

- **Data**: `assets/data/content.json`
- **Config**: `cms-app/.env`
- **Website CSS**: `assets/core/core.css`

## 🎯 Common Tasks

### Edit Content
1. Go to http://localhost:5000/admin
2. Login
3. Edit content
4. Save

### Deploy Website
```bash
git add assets/data/content.json
git commit -m "Update content"
git push origin main
```

### Stop Server
Press `Ctrl+C` in terminal

### Restart Server
```bash
taskkill /F /IM node.exe
cd cms-app
node server/index.js
```

## 🔧 Troubleshooting

| Issue | Solution |
|-------|----------|
| Failed to fetch | Restart server, check login |
| Port in use | `taskkill /F /IM node.exe` |
| Content not updating | Clear cache (Ctrl+F5) |
| CMS in Git | Check `.gitignore` includes `cms-app/` |

## 📋 File Structure

```
unseenstay/
├── index.html              ← Website
├── assets/data/
│   └── content.json       ← Your data
└── cms-app/               ← Admin (not in Git)
    └── .env               ← Credentials
```

## ✅ What's in Git

✅ Website files  
✅ `content.json`  
❌ `cms-app/`  
❌ `.env`  

---

**Need more help?** See `FINAL-SETUP.md` for complete documentation.
