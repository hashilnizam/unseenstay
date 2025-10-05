# UnseenStay - Setup Guide

## Project Structure

```
unseenstay/                          # Main Git Repository (Public Website)
├── index.html                       # Main website homepage
├── assets/                          # Website assets
│   ├── images/                      # Images
│   ├── css/                         # Stylesheets
│   ├── js/                          # JavaScript files
│   ├── core/                        # Core JS (deprecated - use data/)
│   └── data/
│       └── content.json            # ⭐ MAIN DATA FILE (shared between website & CMS)
├── cms-app/                         # ⚠️ CMS Admin Panel (LOCAL ONLY - NOT PUSHED TO GIT)
│   ├── server/                      # Backend API
│   ├── client/                      # React Admin Panel
│   ├── .env                         # ⚠️ Environment config (NOT PUSHED)
│   └── package.json
├── .gitignore                       # Excludes cms-app/ and .env files
└── README.md
```

## Architecture

### Separation of Concerns

1. **Public Website** (`index.html` + `assets/`)
   - Static HTML/CSS/JS website
   - Reads data from `assets/data/content.json`
   - Pushed to Git repository
   - Can be deployed to any static hosting

2. **CMS Admin Panel** (`cms-app/`)
   - Node.js + Express backend
   - React frontend
   - **NOT pushed to Git** (local development only)
   - Edits the same `content.json` file
   - Runs locally on `http://localhost:5000`

### Data Flow

```
┌─────────────────┐
│  content.json   │  ← Single source of truth
└────────┬────────┘
         │
    ┌────┴────┐
    │         │
    ▼         ▼
┌─────┐   ┌─────┐
│ Web │   │ CMS │
└─────┘   └─────┘
```

## Setup Instructions

### 1. Clone Repository (Website Only)

```bash
git clone <your-repo-url> unseenstay
cd unseenstay
```

### 2. CMS Setup (Local Development Only)

The CMS is already in the `cms-app/` folder but **NOT tracked by Git**.

#### Install Dependencies:

```bash
cd cms-app
npm install
cd client
npm install
cd ../..
```

#### Configure Environment:

The `.env` file is already configured at `cms-app/.env`:

```env
# Authentication
ADMIN_USERNAME=your_admin_username
ADMIN_PASSWORD=your_secure_password

# Paths (points to main website data)
DATA_JSON_PATH=../assets/data/content.json
ASSETS_PATH=../assets
```

### 3. Running the Project

#### Option A: Run Everything Together (Recommended)

```bash
cd cms-app
npm run dev
```

This starts:
- **Website**: `http://localhost:5000/`
- **Admin Panel**: `http://localhost:5000/admin`
- **API**: `http://localhost:5000/api/*`

#### Option B: Development Mode (Separate Ports)

```bash
# Terminal 1 - Backend
cd cms-app
npm run server

# Terminal 2 - Frontend
cd cms-app/client
### 4. Access Admin Panel

1. Go to `http://localhost:5000/admin`
2. Login with credentials from `.env` file

## Important Notes

### ⚠️ What Gets Pushed to Git
- `index.html`
- `assets/` (including `content.json`)
- `README.md`
- `.gitignore`

❌ **NOT Pushed:**
- `cms-app/` (entire CMS folder)
- `.env` files
- `node_modules/`

### 🔒 Security

- The `.env` file contains sensitive credentials
- CMS is for local development only
- Never commit `.env` or `cms-app/` to Git
- For production CMS, deploy separately with proper authentication

### 📝 Editing Content

1. **Via CMS** (Recommended):
   - Login to admin panel
   - Edit content visually
   - Changes save to `assets/data/content.json`
   - Commit and push `content.json` to update website

2. **Manually**:
   - Edit `assets/data/content.json` directly
   - Refresh website to see changes

## Deployment

### Deploy Website Only

```bash
# Build static site (if needed)
# Upload these files to your hosting:
- index.html
- assets/
```

### Deploy to GitHub Pages / Netlify / Vercel

Just push the repository - the CMS won't be included!

```bash
git add .
git commit -m "Update content"
git push origin main
```

## Troubleshooting

### "Failed to fetch content" in Admin Panel

1. Make sure server is running: `cd cms-app && npm run server`
2. Check `.env` file exists with correct paths
3. Login first at `/admin`

### Content not updating on website

1. Clear browser cache
2. Check `assets/data/content.json` was actually updated
3. Verify path in `assets/core/core.js` points to `assets/data/content.json`

### CMS showing in Git

1. Check `.gitignore` includes `cms-app/`
2. If already tracked: `git rm -r --cached cms-app/`

## Contact

For issues or questions, contact: hashilnizam@gmail.com
