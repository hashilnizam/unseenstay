# Frequently Asked Questions (FAQ)

## General Questions

### What is UnseenStay CMS?

UnseenStay CMS is a custom Content Management System designed specifically for managing the UnseenStay website's JSON data. It provides a user-friendly interface for editing content, uploading files, and deploying changes via Git integration.

### Who is this for?

- Content editors who need to update website content
- Developers managing the UnseenStay project
- Anyone who needs to manage JSON-based content with Git workflow

### Do I need coding knowledge?

No! The visual editor allows you to edit content without touching code. However, a JSON editor is available for advanced users.

### Is it free?

Yes, this CMS is open-source and free to use.

---

## Installation & Setup

### What are the system requirements?

- **Node.js**: Version 16 or higher
- **npm**: Comes with Node.js
- **Git**: For version control features
- **Modern browser**: Chrome, Firefox, Safari, or Edge

### How do I install it?

```bash
cd cms-app
npm install
cd client && npm install && cd ..
copy .env.example .env
npm run dev
```

See [QUICKSTART.md](QUICKSTART.md) for detailed instructions.

### What are the default login credentials?

- **Username**: admin
- **Password**: admin123

⚠️ **Important**: Change these immediately after first login!

### How do I change the admin password?

Edit the `.env` file:
```env
ADMIN_USERNAME=your-username
ADMIN_PASSWORD=your-secure-password
```

Then restart the server.

### Can I have multiple users?

Currently, the system supports a single admin user. Multi-user support is planned for future versions.

---

## Content Management

### How do I edit content?

1. Login to the CMS
2. Navigate to "Content Editor"
3. Select the section you want to edit
4. Make your changes in Visual or JSON mode
5. Click "Save Changes"

### What's the difference between Visual and JSON mode?

- **Visual Mode**: User-friendly form fields for editing
- **JSON Mode**: Direct JSON editing for advanced users

### Can I undo changes?

Yes! Use Git to revert changes:
1. Go to Git Manager
2. View commit history
3. Use git commands to revert if needed

Or restore from backup if you have one.

### How do I add a new destination?

1. Go to Content Editor
2. Select "destinations" section
3. In Visual mode, scroll to the array
4. Click "Add Item" (or use JSON mode to add manually)
5. Fill in the details
6. Save changes

### Can I edit nested data?

Yes! The visual editor supports nested objects and arrays. Use dot notation in JSON mode: `header.subtitle`

---

## File Management

### What file types can I upload?

- **Images**: JPG, PNG, GIF, WebP, SVG
- **Videos**: MP4, WebM

### What's the maximum file size?

50MB per file by default. This can be changed in the server configuration.

### Where are uploaded files stored?

Files are stored in:
- Images: `assets/images/`
- Videos: `assets/videos/`

### How do I use uploaded files in content?

1. Upload file in File Manager
2. Click "Copy Path" to copy the file path
3. Go to Content Editor
4. Paste the path in the appropriate field
5. Save changes

### Can I delete uploaded files?

Yes! In File Manager, click the delete button on any file. This only removes the file from storage, not from your content references.

### Why aren't my images showing?

- Verify the file path is correct
- Check if file exists in assets folder
- Ensure path starts with `assets/`
- Check browser console for 404 errors

---

## Git Integration

### Do I need a GitHub account?

Yes, if you want to push changes to GitHub. You can use the CMS without Git features for local editing only.

### How do I get a GitHub token?

1. Go to https://github.com/settings/tokens
2. Click "Generate new token (classic)"
3. Select scope: `repo`
4. Generate and copy the token
5. Add to `.env` as `GITHUB_TOKEN`

### What does "Commit and Push" do?

It saves your changes to Git (commit) and uploads them to GitHub (push) in one action. This triggers your website to update if you have auto-deployment configured.

### How do I write good commit messages?

Be descriptive and specific:
- ✅ Good: "Updated header subtitle and added new destination"
- ❌ Bad: "Changes" or "Update"

### Can I see what changed before committing?

Yes! The Git Manager shows all modified files before you commit.

### What if push fails?

Common causes:
- Invalid GitHub token
- Token expired
- No internet connection
- Merge conflicts

Check TROUBLESHOOTING.md for solutions.

---

## Deployment

### How do I deploy my changes?

1. Make changes in Content Editor
2. Go to Git Manager
3. Enter commit message
4. Click "Commit & Push"
5. Your site updates automatically (if configured)

### How long does deployment take?

Depends on your hosting:
- **Netlify**: 1-2 minutes
- **Vercel**: 1-2 minutes
- **GitHub Pages**: 2-5 minutes

### Can I preview changes before deploying?

Currently no. This feature is planned for future versions. For now, test locally before pushing.

### What if I deployed wrong content?

1. Go to Git Manager
2. Note the commit hash of the good version
3. Use git to revert:
```bash
git revert <commit-hash>
git push
```

Or restore from backup.

---

## Troubleshooting

### The CMS won't start

Check:
- Node.js is installed: `node --version`
- Dependencies installed: `npm install`
- Port 5000 is available
- `.env` file exists

### I can't login

Check:
- Username/password in `.env` are correct
- JWT_SECRET is set in `.env`
- Backend server is running
- Browser console for errors

### Changes aren't saving

Check:
- You're logged in
- Backend is running
- File permissions on data.json
- Network tab for API errors

### Files won't upload

Check:
- File size under 50MB
- File type is supported
- Assets folder exists
- Folder has write permissions

### Git push fails

Check:
- GitHub token is valid
- Token has `repo` permission
- Internet connection
- Remote repository exists

See [TROUBLESHOOTING.md](TROUBLESHOOTING.md) for more solutions.

---

## Features

### Can I use this for other projects?

Yes! The CMS can be adapted for any JSON-based project. You'll need to:
1. Update the data.json path
2. Adjust the content structure
3. Customize the UI if needed

### Does it work offline?

Partially. You can edit content offline, but Git operations require internet connection.

### Can I customize the UI?

Yes! The frontend is built with React and TailwindCSS. Modify the components in `client/src/components/`.

### Is there a mobile app?

Not yet, but the web interface is mobile-responsive.

### Can I add custom fields?

Yes! Edit the JSON structure and the CMS will automatically adapt in visual mode.

---

## Performance

### Is it fast?

Yes! Built with modern technologies:
- Vite for fast development
- React for efficient rendering
- Minimal API calls

### Can it handle large files?

Files up to 50MB are supported. For larger files, consider using a CDN.

### How many destinations can I add?

No hard limit. Performance depends on your JSON file size and browser.

### Does it cache data?

Yes, authentication tokens are cached. Content is fetched fresh on each load.

---

## Security

### Is my data secure?

Yes, if you follow security best practices:
- Use strong passwords
- Enable HTTPS in production
- Keep dependencies updated
- Secure your GitHub token

See [SECURITY.md](SECURITY.md) for details.

### Can others access my CMS?

Only if they have:
- The URL
- Valid login credentials

Always use strong passwords and HTTPS.

### Should I backup my data?

Yes! Regular backups are recommended:
```bash
cp assets/core/data.json backups/data-$(date +%Y%m%d).json
```

### What about GDPR compliance?

This CMS doesn't collect user data. However, ensure your website content complies with GDPR.

---

## Advanced Usage

### Can I run multiple instances?

Yes, but use different ports:
```env
# Instance 1
PORT=5000

# Instance 2
PORT=5001
```

### Can I use a database instead of JSON?

Not currently, but you can modify the backend to use MongoDB, PostgreSQL, etc.

### How do I add custom API endpoints?

Create new route files in `server/routes/` and register them in `server/index.js`.

### Can I integrate with other services?

Yes! Add integrations in the backend:
- Cloudinary for images
- SendGrid for emails
- Analytics services
- Webhooks

### How do I add authentication providers?

Modify `server/routes/auth.js` to add:
- OAuth (Google, GitHub)
- LDAP
- Active Directory
- Custom providers

---

## Support & Community

### Where can I get help?

1. Check [README.md](README.md)
2. Read [TROUBLESHOOTING.md](TROUBLESHOOTING.md)
3. Review [API_REFERENCE.md](API_REFERENCE.md)
4. Open an issue on GitHub

### How do I report bugs?

Open an issue on GitHub with:
- Description of the bug
- Steps to reproduce
- Expected vs actual behavior
- Screenshots if applicable

### Can I contribute?

Yes! See [CONTRIBUTING.md](CONTRIBUTING.md) for guidelines.

### Is there a roadmap?

Yes! Check [CHANGELOG.md](CHANGELOG.md) for planned features.

---

## Pricing & Licensing

### Is it really free?

Yes! Licensed under MIT License. Use it for personal or commercial projects.

### Can I sell websites built with this?

Yes! The MIT license allows commercial use.

### Do I need to credit you?

Not required, but appreciated! A link back is nice.

### Can I modify the code?

Yes! Fork it, modify it, make it yours.

---

## Comparison

### How is this different from WordPress?

- **Lighter**: No database required
- **Faster**: Static JSON files
- **Simpler**: Purpose-built for one site
- **Git-based**: Version control built-in

### How is this different from Contentful?

- **Self-hosted**: You own your data
- **Free**: No subscription fees
- **Customizable**: Full control over code
- **Simpler**: No learning curve

### How is this different from Strapi?

- **Lighter**: Smaller footprint
- **Simpler**: Less configuration
- **Focused**: Built for JSON content
- **Git-integrated**: Deploy workflow included

---

## Future Plans

### What features are coming?

See [CHANGELOG.md](CHANGELOG.md) for the roadmap:
- Multi-user support
- Content versioning
- Search functionality
- Dark mode
- Mobile app
- And more!

### When will feature X be added?

Check the roadmap in CHANGELOG.md. Contribute to speed up development!

### Can I request features?

Yes! Open an issue on GitHub with your feature request.

---

## Still have questions?

- 📖 Read the [full documentation](README.md)
- 🐛 Check [troubleshooting guide](TROUBLESHOOTING.md)
- 🔒 Review [security practices](SECURITY.md)
- 💬 Open an issue on GitHub
- 📧 Contact: support@unseenstay.com

---

**Last Updated**: 2025-10-05
