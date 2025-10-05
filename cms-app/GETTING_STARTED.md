# Getting Started with UnseenStay CMS

Welcome! This guide will get you up and running in minutes.

## 🚀 Quick Start (5 Minutes)

### 1️⃣ Install Dependencies

```bash
# Navigate to cms-app folder
cd cms-app

# Install backend
npm install

# Install frontend
cd client
npm install
cd ..
```

### 2️⃣ Configure

```bash
# Copy environment file
copy .env.example .env

# Edit .env and change:
# - JWT_SECRET (generate random string)
# - ADMIN_PASSWORD (your secure password)
```

### 3️⃣ Run

```bash
npm run dev
```

### 4️⃣ Login

Open http://localhost:3000 and login with:
- Username: `admin`
- Password: (what you set in .env)

**That's it! You're ready to go! 🎉**

---

## 📚 What Can You Do?

### ✏️ Edit Content

1. Click **"Content Editor"** in sidebar
2. Select a section (e.g., "header")
3. Edit fields in **Visual Mode** or **JSON Mode**
4. Click **"Save Changes"**

**Visual Mode**: Easy form fields  
**JSON Mode**: Direct JSON editing for advanced users

### 📁 Manage Files

1. Click **"File Manager"** in sidebar
2. Click **"Upload Files"**
3. Select images or videos
4. Click **"Copy Path"** to use in content

**Supported formats**:
- Images: JPG, PNG, GIF, WebP, SVG
- Videos: MP4, WebM

### 🔄 Deploy Changes

1. Click **"Git Manager"** in sidebar
2. Review modified files
3. Enter commit message
4. Click **"Commit & Push"**

Your changes are now live! (if auto-deploy is configured)

---

## 🎯 Common Tasks

### Task 1: Update Homepage Header

```
1. Go to Content Editor
2. Select "header" section
3. Change "title" field
4. Change "subtitle" field
5. Save Changes
6. Go to Git Manager
7. Commit & Push
```

### Task 2: Add New Destination

```
1. Go to Content Editor
2. Select "destinations" section
3. Scroll to destinations array
4. Click "Add Item" (or use JSON mode)
5. Fill in:
   - id: "unique-id"
   - name: "Destination Name"
   - description: "Description"
   - image: "assets/images/your-image.jpg"
6. Save Changes
7. Commit & Push
```

### Task 3: Upload and Use Image

```
1. Go to File Manager
2. Click "Upload Files"
3. Select your image
4. Click "Copy Path" on uploaded image
5. Go to Content Editor
6. Paste path in appropriate field
7. Save Changes
8. Commit & Push
```

### Task 4: Change Background Video

```
1. Go to File Manager
2. Select "Videos" tab
3. Upload your video
4. Copy the path
5. Go to Content Editor
6. Select "header" section
7. Update "backgroundVideo" field with path
8. Save Changes
9. Commit & Push
```

---

## 🎨 Interface Overview

### Dashboard
- **Overview**: Statistics and quick actions
- **Content Sections**: Number of sections
- **Git Status**: Modified files count
- **Quick Links**: Jump to any section

### Content Editor
- **Section List**: All available sections
- **Visual/JSON Toggle**: Switch editing modes
- **Save Button**: Save your changes
- **Refresh**: Reload from file

### File Manager
- **Images/Videos Tabs**: Switch file types
- **Upload Button**: Add new files
- **Grid View**: Preview all files
- **Copy Path**: Get file path for content
- **Delete**: Remove unused files

### Git Manager
- **Status**: Current branch and changes
- **Commit Form**: Enter commit message
- **Commit Button**: Save to git
- **Push Button**: Upload to GitHub
- **Commit & Push**: Do both at once
- **History**: View recent commits

---

## 💡 Tips & Tricks

### Content Editing

**Tip 1**: Use Visual Mode for simple edits, JSON Mode for complex changes

**Tip 2**: Save frequently - changes only persist after clicking "Save"

**Tip 3**: Use descriptive field names to stay organized

**Tip 4**: Test locally before pushing to production

### File Management

**Tip 1**: Organize files with descriptive names

**Tip 2**: Compress images before uploading for better performance

**Tip 3**: Delete unused files to save space

**Tip 4**: Use WebP format for smaller file sizes

### Git Workflow

**Tip 1**: Write clear commit messages
- ✅ "Updated header subtitle and hero image"
- ❌ "Changes"

**Tip 2**: Commit related changes together

**Tip 3**: Pull before starting work if multiple people use the CMS

**Tip 4**: Review changes in Git Manager before pushing

### Performance

**Tip 1**: Keep JSON file under 1MB for best performance

**Tip 2**: Use CDN for large images/videos

**Tip 3**: Optimize images (compress, resize)

**Tip 4**: Clear browser cache if UI seems slow

---

## 🔒 Security Best Practices

### ✅ Do This

- Change default admin password immediately
- Use strong, unique passwords (12+ characters)
- Generate random JWT_SECRET (64+ characters)
- Enable HTTPS in production
- Keep dependencies updated
- Backup data.json regularly
- Use GitHub token with minimal permissions

### ❌ Don't Do This

- Don't use "admin/admin123" in production
- Don't commit .env file to git
- Don't share your GitHub token
- Don't skip backups
- Don't ignore security updates
- Don't use HTTP in production

---

## 🆘 Need Help?

### Quick Fixes

**Can't login?**
- Check username/password in .env
- Verify JWT_SECRET is set
- Clear browser cache

**Changes not saving?**
- Check backend is running
- Verify file permissions
- Look for errors in console

**Upload fails?**
- Check file size (max 50MB)
- Verify file type is supported
- Check disk space

**Git push fails?**
- Verify GitHub token
- Check internet connection
- Ensure token has `repo` permission

### Documentation

- 📖 [README.md](README.md) - Full documentation
- 🚀 [QUICKSTART.md](QUICKSTART.md) - 5-minute setup
- 🔧 [INSTALLATION_GUIDE.md](INSTALLATION_GUIDE.md) - Detailed installation
- ❓ [FAQ.md](FAQ.md) - Common questions
- 🐛 [TROUBLESHOOTING.md](TROUBLESHOOTING.md) - Problem solving
- 🔒 [SECURITY.md](SECURITY.md) - Security guide
- 🚀 [DEPLOYMENT.md](DEPLOYMENT.md) - Production deployment
- 📚 [API_REFERENCE.md](API_REFERENCE.md) - API documentation
- ✨ [FEATURES.md](FEATURES.md) - Feature list

### Get Support

1. Check documentation above
2. Search GitHub issues
3. Open new issue with details
4. Email: support@unseenstay.com

---

## 🎓 Learning Path

### Beginner (Day 1)
- [ ] Install and configure CMS
- [ ] Login and explore interface
- [ ] Edit simple text fields
- [ ] Upload an image
- [ ] Save changes

### Intermediate (Week 1)
- [ ] Use both Visual and JSON modes
- [ ] Add/remove array items
- [ ] Upload and use multiple files
- [ ] Commit changes to git
- [ ] Push to GitHub

### Advanced (Month 1)
- [ ] Edit complex nested structures
- [ ] Manage large content sets
- [ ] Optimize workflow
- [ ] Customize configuration
- [ ] Set up automated backups

### Expert (Month 3+)
- [ ] Customize UI components
- [ ] Add custom API endpoints
- [ ] Integrate external services
- [ ] Contribute to project
- [ ] Deploy to production

---

## 🎯 Your First 10 Minutes

Let's accomplish something real:

### Minute 1-2: Setup
```bash
npm install
cd client && npm install && cd ..
copy .env.example .env
```

### Minute 3-4: Configure
Edit .env:
- Set JWT_SECRET
- Set ADMIN_PASSWORD

### Minute 5-6: Run
```bash
npm run dev
```
Wait for servers to start

### Minute 7: Login
- Open http://localhost:3000
- Login with credentials

### Minute 8: Edit Content
- Go to Content Editor
- Select "header"
- Change title
- Save

### Minute 9: Upload Image
- Go to File Manager
- Upload an image
- Copy path

### Minute 10: Deploy
- Go to Git Manager
- Enter "My first CMS update"
- Click Commit (or Commit & Push if configured)

**Congratulations! You've completed your first CMS workflow! 🎉**

---

## 🌟 What's Next?

### Explore Features
- Try all editing modes
- Upload different file types
- Browse commit history
- Test all sections

### Customize
- Update your profile info
- Organize your content
- Set up your workflow
- Configure Git integration

### Learn More
- Read full documentation
- Watch for updates
- Join community
- Contribute improvements

### Go Live
- Set up production environment
- Configure auto-deployment
- Enable HTTPS
- Set up monitoring

---

## 📊 Feature Checklist

Mark what you've tried:

### Content Management
- [ ] Edit text fields
- [ ] Edit numbers
- [ ] Toggle booleans
- [ ] Edit nested objects
- [ ] Add array items
- [ ] Remove array items
- [ ] Update array items
- [ ] Use Visual mode
- [ ] Use JSON mode
- [ ] Save changes

### File Management
- [ ] Upload image
- [ ] Upload video
- [ ] Upload multiple files
- [ ] Preview images
- [ ] Copy file path
- [ ] Delete file
- [ ] List all files

### Git Operations
- [ ] View status
- [ ] View commit history
- [ ] Write commit message
- [ ] Commit changes
- [ ] Push to GitHub
- [ ] Pull from GitHub
- [ ] Commit & Push together

### General
- [ ] Login/Logout
- [ ] Navigate all pages
- [ ] View dashboard stats
- [ ] Use quick actions
- [ ] Read documentation

---

## 🎊 Success Criteria

You're successfully using the CMS when you can:

✅ Login without issues  
✅ Edit content confidently  
✅ Upload and manage files  
✅ Commit and push changes  
✅ See updates on your website  
✅ Troubleshoot common issues  
✅ Follow security best practices  

---

## 🚀 Ready to Start?

```bash
cd cms-app
npm run dev
```

Open http://localhost:3000 and let's go! 🎉

---

**Questions?** Check [FAQ.md](FAQ.md) or open an issue on GitHub.

**Need help?** See [TROUBLESHOOTING.md](TROUBLESHOOTING.md) for solutions.

**Going live?** Read [DEPLOYMENT.md](DEPLOYMENT.md) for production setup.

---

**Welcome to UnseenStay CMS! Happy content managing! 🌟**
