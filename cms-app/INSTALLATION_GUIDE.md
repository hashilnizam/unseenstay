# Complete Installation Guide

Step-by-step guide to install and configure UnseenStay CMS.

## Table of Contents

1. [Prerequisites](#prerequisites)
2. [Installation Steps](#installation-steps)
3. [Configuration](#configuration)
4. [First Run](#first-run)
5. [Verification](#verification)
6. [Next Steps](#next-steps)
7. [Troubleshooting](#troubleshooting)

---

## Prerequisites

### Required Software

#### 1. Node.js (v16 or higher)

**Windows:**
- Download from https://nodejs.org/
- Run installer
- Verify installation:
```bash
node --version
npm --version
```

**macOS:**
```bash
# Using Homebrew
brew install node

# Verify
node --version
```

**Linux:**
```bash
# Ubuntu/Debian
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt-get install -y nodejs

# Verify
node --version
```

#### 2. Git

**Windows:**
- Download from https://git-scm.com/
- Run installer with default settings

**macOS:**
```bash
# Using Homebrew
brew install git
```

**Linux:**
```bash
# Ubuntu/Debian
sudo apt-get install git
```

Verify:
```bash
git --version
```

#### 3. Text Editor

Recommended: [Visual Studio Code](https://code.visualstudio.com/)

### Optional (for Git features)

- GitHub account
- GitHub Personal Access Token

---

## Installation Steps

### Step 1: Navigate to Project

```bash
cd c:\projects\unseenstay\cms-app
```

Or if starting fresh:
```bash
cd c:\projects\unseenstay
mkdir cms-app
cd cms-app
```

### Step 2: Install Backend Dependencies

```bash
# Install backend packages
npm install
```

This installs:
- express
- cors
- dotenv
- multer
- simple-git
- bcryptjs
- jsonwebtoken
- body-parser
- nodemon
- concurrently

**Expected output:**
```
added 150 packages in 30s
```

### Step 3: Install Frontend Dependencies

```bash
# Navigate to client folder
cd client

# Install frontend packages
npm install

# Return to root
cd ..
```

This installs:
- react
- react-dom
- react-router-dom
- axios
- lucide-react
- react-hot-toast
- zustand
- vite
- tailwindcss
- And more...

**Expected output:**
```
added 200 packages in 45s
```

### Step 4: Create Environment File

```bash
# Windows
copy .env.example .env

# macOS/Linux
cp .env.example .env
```

---

## Configuration

### Step 1: Edit .env File

Open `.env` in your text editor:

```bash
# Windows
notepad .env

# macOS
open -e .env

# Linux
nano .env

# VS Code
code .env
```

### Step 2: Configure Basic Settings

```env
# Server Configuration
PORT=5000
NODE_ENV=development

# Authentication (CHANGE THESE!)
JWT_SECRET=your-random-64-character-secret-key-here
ADMIN_USERNAME=admin
ADMIN_PASSWORD=your-secure-password-here

# Git Configuration
GIT_USER_NAME=Your Name
GIT_USER_EMAIL=your-email@example.com

# Paths (usually don't need to change)
DATA_JSON_PATH=../assets/core/data.json
ASSETS_PATH=../assets
REPO_PATH=../
```

### Step 3: Generate Secure JWT Secret

**Option 1: Using Node.js**
```bash
node -e "console.log(require('crypto').randomBytes(64).toString('hex'))"
```

**Option 2: Using OpenSSL**
```bash
openssl rand -hex 64
```

**Option 3: Online Generator**
- Visit https://www.grc.com/passwords.htm
- Copy the "63 random alpha-numeric characters" string

Copy the generated string and paste it as `JWT_SECRET` in `.env`.

### Step 4: Set Admin Credentials

Replace default credentials:
```env
ADMIN_USERNAME=your_username
ADMIN_PASSWORD=your_strong_password
```

**Password Requirements:**
- Minimum 8 characters (12+ recommended)
- Mix of uppercase and lowercase
- Include numbers and symbols
- Avoid common words

### Step 5: Configure Git (Optional)

If you want Git integration:

```env
GIT_USER_NAME=John Doe
GIT_USER_EMAIL=john@example.com
```

### Step 6: Get GitHub Token (Optional)

For push/pull functionality:

1. **Go to GitHub Settings**
   - Visit https://github.com/settings/tokens
   - Click "Generate new token (classic)"

2. **Configure Token**
   - Note: "UnseenStay CMS"
   - Expiration: 90 days (or custom)
   - Select scopes: ✅ `repo` (Full control of private repositories)

3. **Generate and Copy**
   - Click "Generate token"
   - Copy the token (it will start with "ghp_")
   - Save it now - you won't see it again!

4. **Add to .env**
   ```env
   GITHUB_TOKEN=your_github_token_here
   ```

---

## First Run
{{ ... }}

### Step 1: Start the Application

**Option 1: Run Both (Recommended)**
```bash
npm run dev
```

This starts:
- Backend server on http://localhost:5000
- Frontend app on http://localhost:3000

**Option 2: Run Separately**

Terminal 1 (Backend):
```bash
npm run server
```

Terminal 2 (Frontend):
```bash
npm run client
```

### Step 2: Wait for Startup

You should see:
```
🚀 CMS Server running on http://localhost:5000
```

And:
```
VITE v5.0.8  ready in 1234 ms

➜  Local:   http://localhost:3000/
➜  Network: use --host to expose
```

### Step 3: Open in Browser

Navigate to: http://localhost:3000

---

## Verification

### 1. Check Backend Health

Open in browser or use curl:
```bash
curl http://localhost:5000/api/health
```

Expected response:
```json
{
  "status": "ok",
  "message": "UnseenStay CMS API is running"
}
```

### 2. Test Login

1. Open http://localhost:3000
2. Enter your credentials
3. Click "Sign In"
4. Should redirect to dashboard

### 3. Verify Content Loading

1. Click "Content Editor" in sidebar
2. Should see list of sections
3. Click any section
4. Should see content fields

### 4. Test File Upload

1. Click "File Manager"
2. Click "Upload Files"
3. Select an image
4. Should see upload progress
5. Image should appear in grid

### 5. Check Git Status

1. Click "Git Manager"
2. Should see current branch
3. Should see repository status

---

## Next Steps

### 1. Customize Content

1. Go to Content Editor
2. Select a section
3. Make changes
4. Click "Save Changes"

### 2. Upload Assets

1. Go to File Manager
2. Upload images/videos
3. Copy file paths
4. Use in content

### 3. Deploy Changes

1. Go to Git Manager
2. Review modified files
3. Enter commit message
4. Click "Commit & Push"

### 4. Explore Features

- Try both Visual and JSON editing modes
- Test array operations (add/remove items)
- Browse commit history
- Test file deletion

### 5. Read Documentation

- [README.md](README.md) - Full documentation
- [FEATURES.md](FEATURES.md) - Feature list
- [API_REFERENCE.md](API_REFERENCE.md) - API docs
- [FAQ.md](FAQ.md) - Common questions

---

## Troubleshooting

### Installation Issues

#### npm install fails

**Error:** `EACCES: permission denied`

**Solution:**
```bash
# Windows (Run as Administrator)
npm install

# macOS/Linux
sudo npm install
```

#### Port already in use

**Error:** `EADDRINUSE: address already in use :::5000`

**Solution:**
```bash
# Change port in .env
PORT=5001

# Or kill process on port 5000
# Windows
netstat -ano | findstr :5000
taskkill /PID <PID> /F

# macOS/Linux
lsof -ti:5000 | xargs kill -9
```

#### Module not found

**Error:** `Cannot find module 'express'`

**Solution:**
```bash
# Delete and reinstall
rm -rf node_modules package-lock.json
npm install
```

### Configuration Issues

#### .env file not found

**Error:** `Cannot find .env file`

**Solution:**
```bash
# Create from example
copy .env.example .env  # Windows
cp .env.example .env    # macOS/Linux
```

#### JWT_SECRET not set

**Error:** `JWT_SECRET is required`

**Solution:**
```bash
# Generate and add to .env
node -e "console.log(require('crypto').randomBytes(64).toString('hex'))"
```

### Runtime Issues

#### Cannot connect to backend

**Check:**
1. Backend is running: `curl http://localhost:5000/api/health`
2. Port is correct in .env
3. No firewall blocking

**Solution:**
```bash
# Restart backend
npm run server
```

#### Login fails

**Check:**
1. Username/password in .env are correct
2. JWT_SECRET is set
3. Browser console for errors

**Solution:**
```bash
# Verify .env settings
cat .env | grep ADMIN
cat .env | grep JWT_SECRET
```

#### Changes not saving

**Check:**
1. File permissions on data.json
2. Path in .env is correct
3. Backend logs for errors

**Solution:**
```bash
# Check file exists
ls -la ../assets/core/data.json

# Make writable
chmod 644 ../assets/core/data.json
```

### Git Issues

#### Push fails

**Error:** `Authentication failed`

**Check:**
1. GITHUB_TOKEN is set
2. Token has `repo` permission
3. Token hasn't expired

**Solution:**
```bash
# Generate new token
# Update .env
GITHUB_TOKEN=new_token_here

# Restart server
```

---

## Advanced Setup

### Custom Port

Edit `.env`:
```env
PORT=8080
```

Update `client/vite.config.js`:
```javascript
proxy: {
  '/api': {
    target: 'http://localhost:8080',
    changeOrigin: true
  }
}
```

### Custom Paths

Edit `.env`:
```env
DATA_JSON_PATH=../../custom/path/data.json
ASSETS_PATH=../../custom/assets
```

### Multiple Environments

Create environment-specific files:
```bash
.env.development
.env.production
.env.staging
```

Load with:
```bash
NODE_ENV=production npm start
```

---

## Production Setup

See [DEPLOYMENT.md](DEPLOYMENT.md) for production deployment instructions.

Quick checklist:
- [ ] Change default credentials
- [ ] Set strong JWT_SECRET
- [ ] Configure CORS
- [ ] Enable HTTPS
- [ ] Set up firewall
- [ ] Configure backups
- [ ] Set up monitoring

---

## Getting Help

If you're stuck:

1. **Check Documentation**
   - [README.md](README.md)
   - [TROUBLESHOOTING.md](TROUBLESHOOTING.md)
   - [FAQ.md](FAQ.md)

2. **Check Logs**
   - Backend: Terminal running server
   - Frontend: Browser console (F12)

3. **Search Issues**
   - GitHub Issues
   - Stack Overflow

4. **Ask for Help**
   - Open GitHub issue
   - Email: support@unseenstay.com

---

## Success!

If you've completed all steps, you should now have:

✅ Backend server running on port 5000  
✅ Frontend app running on port 3000  
✅ Ability to login with your credentials  
✅ Content editor working  
✅ File upload working  
✅ Git integration configured  

**Congratulations! You're ready to start managing content!** 🎉

---

**Next:** Read [README.md](README.md) for full feature documentation.
