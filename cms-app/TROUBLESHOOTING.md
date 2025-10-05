# Troubleshooting Guide

Common issues and their solutions for UnseenStay CMS.

## Installation Issues

### npm install fails

**Problem**: Dependencies fail to install

**Solutions**:
```bash
# Clear npm cache
npm cache clean --force

# Delete node_modules and package-lock.json
rm -rf node_modules package-lock.json
npm install

# Try with legacy peer deps
npm install --legacy-peer-deps

# Update npm
npm install -g npm@latest
```

### Port already in use

**Problem**: `Error: listen EADDRINUSE: address already in use :::5000`

**Solutions**:
```bash
# Find process using port 5000
netstat -ano | findstr :5000

# Kill the process (Windows)
taskkill /PID <PID> /F

# Or change port in .env
PORT=5001
```

## Authentication Issues

### Login fails with "Invalid credentials"

**Checklist**:
- [ ] Check username/password in .env
- [ ] Verify JWT_SECRET is set
- [ ] Clear browser cache/cookies
- [ ] Check browser console for errors
- [ ] Verify backend is running

**Solution**:
```bash
# Check .env file
cat .env | grep ADMIN

# Restart server
npm run server
```

### Token expired error

**Problem**: "Invalid or expired token"

**Solutions**:
- Logout and login again
- Clear localStorage: `localStorage.clear()`
- Check JWT_SECRET hasn't changed
- Verify token expiration time (default 24h)

### Can't stay logged in

**Problem**: Logged out after refresh

**Solutions**:
- Check browser localStorage
- Verify Zustand persist is working
- Check for console errors
- Try incognito mode to test

## Content Editor Issues

### Changes not saving

**Checklist**:
- [ ] Check network tab for API errors
- [ ] Verify data.json file permissions
- [ ] Check backend logs for errors
- [ ] Ensure DATA_JSON_PATH is correct

**Solution**:
```bash
# Check file permissions
ls -la ../assets/core/data.json

# Make writable
chmod 644 ../assets/core/data.json

# Check path in .env
echo $DATA_JSON_PATH
```

### JSON syntax error

**Problem**: "Invalid JSON format"

**Solutions**:
- Use JSON validator: https://jsonlint.com/
- Check for trailing commas
- Verify quotes are correct
- Use Visual mode instead of JSON mode

### Nested data not updating

**Problem**: Changes to nested objects don't save

**Solutions**:
- Use dot notation: `header.subtitle`
- Check array indices are correct
- Verify object structure matches
- Try JSON mode for complex updates

## File Upload Issues

### Upload fails

**Checklist**:
- [ ] Check file size (max 50MB)
- [ ] Verify file type is allowed
- [ ] Check ASSETS_PATH in .env
- [ ] Verify folder permissions
- [ ] Check disk space

**Solutions**:
```bash
# Check disk space
df -h

# Create assets directory
mkdir -p ../assets/images ../assets/videos

# Set permissions
chmod 755 ../assets
chmod 755 ../assets/images
chmod 755 ../assets/videos

# Check .env
echo $ASSETS_PATH
```

### File path not updating in JSON

**Problem**: Uploaded file path not saved

**Solutions**:
- Copy path from File Manager
- Manually update in Content Editor
- Check API response for file path
- Verify relative path is correct

### Images not displaying

**Problem**: Uploaded images show broken icon

**Solutions**:
- Check file path is correct
- Verify assets folder is accessible
- Check browser console for 404 errors
- Ensure static middleware is configured
- Try absolute path: `/assets/images/file.jpg`

## Git Integration Issues

### Push fails with authentication error

**Problem**: "Authentication failed" or "Permission denied"

**Solutions**:
```bash
# Verify GitHub token
echo $GITHUB_TOKEN

# Check token permissions (needs 'repo' scope)
# Generate new token: https://github.com/settings/tokens

# Test git manually
cd ..
git push origin main

# Check remote URL
git remote -v
```

### Commit fails

**Problem**: "Commit failed" error

**Checklist**:
- [ ] Git user.name configured
- [ ] Git user.email configured
- [ ] Files are modified
- [ ] Commit message provided

**Solutions**:
```bash
# Configure git
git config user.name "Your Name"
git config user.email "your@email.com"

# Or set in .env
GIT_USER_NAME=Your Name
GIT_USER_EMAIL=your@email.com

# Check git status
git status
```

### No changes detected

**Problem**: Git shows no changes but files were modified

**Solutions**:
```bash
# Check git status
git status

# Check if files are gitignored
cat .gitignore

# Force add files
git add -f path/to/file

# Check if in correct directory
pwd
```

### Push to wrong branch

**Problem**: Pushed to wrong branch

**Solutions**:
```bash
# Check current branch
git branch

# Switch branch
git checkout main

# Or specify branch in CMS
# Use branch selector in Git Manager
```

## API Issues

### CORS errors

**Problem**: "CORS policy blocked" in browser console

**Solutions**:
```javascript
// Update server/index.js
app.use(cors({
  origin: 'http://localhost:3000',
  credentials: true
}));
```

### 404 errors

**Problem**: API endpoints return 404

**Checklist**:
- [ ] Backend server is running
- [ ] Correct port (default 5000)
- [ ] Proxy configured in vite.config.js
- [ ] Route exists in server

**Solutions**:
```bash
# Check if server is running
curl http://localhost:5000/api/health

# Check vite proxy config
cat client/vite.config.js

# Restart both servers
npm run dev
```

### 500 Internal Server Error

**Problem**: API returns 500 error

**Solutions**:
- Check backend console logs
- Verify .env variables are set
- Check file paths are correct
- Look for stack trace in terminal
- Verify JSON file is valid

## Frontend Issues

### Blank page after login

**Problem**: White screen after successful login

**Solutions**:
- Check browser console for errors
- Verify React Router is configured
- Check if token is stored
- Try clearing cache
- Rebuild frontend: `cd client && npm run build`

### Components not rendering

**Problem**: UI components missing or broken

**Solutions**:
```bash
# Reinstall dependencies
cd client
rm -rf node_modules package-lock.json
npm install

# Clear Vite cache
rm -rf node_modules/.vite

# Restart dev server
npm run dev
```

### Styling issues

**Problem**: TailwindCSS styles not working

**Solutions**:
```bash
# Check tailwind.config.js
cat client/tailwind.config.js

# Verify postcss.config.js exists
cat client/postcss.config.js

# Rebuild
cd client
npm run build
```

## Performance Issues

### Slow loading

**Solutions**:
- Enable production build
- Optimize images before upload
- Use CDN for assets
- Enable gzip compression
- Check network tab for slow requests

### High memory usage

**Solutions**:
- Restart Node.js server
- Clear browser cache
- Reduce file upload sizes
- Check for memory leaks in code
- Use production build

## Database/JSON Issues

### data.json corrupted

**Problem**: JSON file is invalid or corrupted

**Solutions**:
```bash
# Validate JSON
cat ../assets/core/data.json | python -m json.tool

# Restore from backup
cp ../assets/core/data.json.backup ../assets/core/data.json

# Or restore from git
git checkout ../assets/core/data.json
```

### Large JSON file slow

**Problem**: Performance issues with large data.json

**Solutions**:
- Split into multiple files
- Implement pagination
- Use database instead of JSON
- Optimize data structure
- Enable compression

## Network Issues

### Cannot connect to backend

**Problem**: Frontend can't reach backend API

**Checklist**:
- [ ] Backend is running on port 5000
- [ ] Frontend proxy is configured
- [ ] No firewall blocking
- [ ] Correct API base URL

**Solutions**:
```bash
# Test backend directly
curl http://localhost:5000/api/health

# Check proxy in vite.config.js
cat client/vite.config.js

# Check API base URL
cat client/src/utils/api.js
```

### Timeout errors

**Problem**: Requests timeout

**Solutions**:
- Increase timeout in axios config
- Check server response time
- Verify network connection
- Check for infinite loops in code

## Deployment Issues

### Build fails

**Problem**: `npm run build` fails

**Solutions**:
```bash
# Clear cache
rm -rf client/node_modules/.vite
rm -rf client/dist

# Reinstall
cd client
npm install

# Build with verbose
npm run build -- --debug
```

### Environment variables not working

**Problem**: .env variables not loaded in production

**Solutions**:
- Set environment variables in hosting platform
- Don't commit .env to git
- Use platform-specific env config
- Verify variable names match

### Git push fails in production

**Problem**: Git operations fail on server

**Solutions**:
- Check git is installed: `git --version`
- Configure git user on server
- Verify GitHub token is set
- Check file permissions
- Ensure .git directory exists

## Common Error Messages

### "Cannot find module"

**Solution**:
```bash
npm install
cd client && npm install
```

### "ENOENT: no such file or directory"

**Solution**:
- Check file paths in .env
- Create missing directories
- Verify relative paths are correct

### "Port 3000 is already in use"

**Solution**:
```bash
# Kill process on port 3000
npx kill-port 3000

# Or use different port
# Edit client/vite.config.js
```

### "Module not found: Can't resolve"

**Solution**:
```bash
cd client
npm install <missing-package>
```

## Getting Help

If you're still stuck:

1. **Check Logs**
   - Backend: Terminal running `npm run server`
   - Frontend: Browser console (F12)
   - Git: `.git/logs/`

2. **Enable Debug Mode**
   ```bash
   NODE_ENV=development
   DEBUG=*
   ```

3. **Test Components Individually**
   - Test backend: `curl http://localhost:5000/api/health`
   - Test frontend: Open in incognito mode
   - Test git: Run commands manually

4. **Search Issues**
   - Check GitHub issues
   - Search error message
   - Check Stack Overflow

5. **Create Issue**
   - Provide error messages
   - Include steps to reproduce
   - Share environment details
   - Add screenshots

## Preventive Measures

### Regular Maintenance

```bash
# Update dependencies monthly
npm update
cd client && npm update

# Backup data.json daily
cp ../assets/core/data.json ../assets/core/data.json.backup

# Clean up old files
npm run clean (if script exists)

# Check for security issues
npm audit
npm audit fix
```

### Best Practices

- ✅ Commit frequently
- ✅ Test before deploying
- ✅ Keep backups
- ✅ Monitor logs
- ✅ Update dependencies
- ✅ Use version control
- ✅ Document changes
- ✅ Test in staging first

---

**Still having issues?** Open an issue on GitHub with:
- Error message
- Steps to reproduce
- Environment details (OS, Node version)
- Screenshots
- What you've tried
