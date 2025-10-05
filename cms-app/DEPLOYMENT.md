# Deployment Guide

## Local Development

### Quick Setup

1. **Run the setup script (Windows)**
```bash
setup.bat
```

Or manually:

```bash
# Install dependencies
npm install
cd client && npm install && cd ..

# Create .env file
copy .env.example .env
```

2. **Configure .env**
```env
JWT_SECRET=your-super-secret-key-change-this
ADMIN_USERNAME=admin
ADMIN_PASSWORD=your-secure-password
GIT_USER_NAME=Your Name
GIT_USER_EMAIL=your@email.com
GITHUB_TOKEN=your_github_token_here
{{ ... }}
```

## Production Deployment

### Option 1: Deploy on VPS (DigitalOcean, AWS, etc.)

#### 1. Server Setup
```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install Node.js 18+
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install -y nodejs

# Install PM2 for process management
sudo npm install -g pm2

# Install Git
sudo apt install git
```

#### 2. Clone and Setup
```bash
# Clone your repository
git clone https://github.com/yourusername/unseenstay.git
cd unseenstay/cms-app

# Install dependencies
npm install
cd client && npm install && npm run build && cd ..

# Create .env file
nano .env
# Add your production configuration
```

#### 3. Start with PM2
```bash
# Start the server
pm2 start server/index.js --name unseenstay-cms

# Save PM2 configuration
pm2 save

# Setup PM2 to start on boot
pm2 startup
```

#### 4. Setup Nginx Reverse Proxy
```bash
sudo apt install nginx

# Create Nginx configuration
sudo nano /etc/nginx/sites-available/unseenstay-cms
```

Add this configuration:
```nginx
server {
    listen 80;
    server_name your-domain.com;

    location / {
        proxy_pass http://localhost:5000;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection 'upgrade';
        proxy_set_header Host $host;
        proxy_cache_bypass $http_upgrade;
    }
}
```

```bash
# Enable site
sudo ln -s /etc/nginx/sites-available/unseenstay-cms /etc/nginx/sites-enabled/

# Test and restart Nginx
sudo nginx -t
sudo systemctl restart nginx
```

#### 5. Setup SSL with Let's Encrypt
```bash
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d your-domain.com
```

### Option 2: Deploy on Heroku

#### 1. Prepare for Heroku
Create `Procfile` in cms-app directory:
```
web: node server/index.js
```

Update `package.json`:
```json
{
  "scripts": {
    "start": "node server/index.js",
    "heroku-postbuild": "cd client && npm install && npm run build"
  }
}
```

Update `server/index.js` to serve static files:
```javascript
// Add after other middleware
if (process.env.NODE_ENV === 'production') {
  app.use(express.static(path.join(__dirname, '../client/dist')));
  app.get('*', (req, res) => {
    res.sendFile(path.join(__dirname, '../client/dist/index.html'));
  });
}
```

#### 2. Deploy to Heroku
```bash
# Login to Heroku
heroku login

# Create app
heroku create unseenstay-cms

# Set environment variables
heroku config:set JWT_SECRET=your-secret
heroku config:set ADMIN_USERNAME=admin
heroku config:set ADMIN_PASSWORD=your-password
heroku config:set GIT_USER_NAME="Your Name"
heroku config:set GIT_USER_EMAIL=your@email.com
heroku config:set GITHUB_TOKEN=your-token
heroku config:set NODE_ENV=production

# Deploy
git push heroku main
```

### Option 3: Deploy on Railway

1. Go to [Railway.app](https://railway.app)
2. Click "New Project" → "Deploy from GitHub repo"
3. Select your repository
4. Set root directory to `cms-app`
5. Add environment variables in Railway dashboard
6. Deploy!

### Option 4: Docker Deployment

Create `Dockerfile` in cms-app:
```dockerfile
FROM node:18-alpine

WORKDIR /app

# Copy package files
COPY package*.json ./
COPY client/package*.json ./client/

# Install dependencies
RUN npm install
RUN cd client && npm install

# Copy source code
COPY . .

# Build frontend
RUN cd client && npm run build

# Expose port
EXPOSE 5000

# Start server
CMD ["node", "server/index.js"]
```

Create `docker-compose.yml`:
```yaml
version: '3.8'

services:
  cms:
    build: .
    ports:
      - "5000:5000"
    environment:
      - NODE_ENV=production
      - PORT=5000
      - JWT_SECRET=${JWT_SECRET}
      - ADMIN_USERNAME=${ADMIN_USERNAME}
      - ADMIN_PASSWORD=${ADMIN_PASSWORD}
      - GIT_USER_NAME=${GIT_USER_NAME}
      - GIT_USER_EMAIL=${GIT_USER_EMAIL}
      - GITHUB_TOKEN=${GITHUB_TOKEN}
    volumes:
      - ../assets:/app/assets
    restart: unless-stopped
```

Deploy:
```bash
docker-compose up -d
```

## Environment Variables Reference

| Variable | Description | Required | Example |
|----------|-------------|----------|---------|
| PORT | Server port | No | 5000 |
| NODE_ENV | Environment | No | production |
| JWT_SECRET | Secret for JWT tokens | Yes | random-string-here |
| ADMIN_USERNAME | Admin username | Yes | admin |
| ADMIN_PASSWORD | Admin password | Yes | secure-password |
| GIT_USER_NAME | Git commit author | Yes | John Doe |
| GIT_USER_EMAIL | Git commit email | Yes | john@example.com |
| GITHUB_TOKEN | GitHub personal access token | No* | your_github_token_here |
| DATA_JSON_PATH | Path to data.json | No | ../assets/core/data.json |
| ASSETS_PATH | Path to assets folder | No | ../assets |
| REPO_PATH | Path to git repository | No | ../ |

*Required for Git push/pull functionality

## Post-Deployment Checklist

- [ ] Change default admin credentials
- [ ] Set strong JWT_SECRET
- [ ] Configure GitHub token with minimal permissions
- [ ] Enable HTTPS/SSL
- [ ] Set up firewall rules
- [ ] Configure CORS for production domain
- [ ] Set up monitoring (PM2, New Relic, etc.)
- [ ] Configure automated backups
- [ ] Test all features in production
- [ ] Set up error logging (Sentry, LogRocket, etc.)

## Monitoring & Maintenance

### PM2 Commands
```bash
# View logs
pm2 logs unseenstay-cms

# Restart
pm2 restart unseenstay-cms

# Stop
pm2 stop unseenstay-cms

# Monitor
pm2 monit
```

### Nginx Commands
```bash
# Test configuration
sudo nginx -t

# Reload
sudo systemctl reload nginx

# View logs
sudo tail -f /var/log/nginx/error.log
```

### Updates
```bash
# Pull latest changes
git pull origin main

# Install dependencies
npm install
cd client && npm install && npm run build && cd ..

# Restart
pm2 restart unseenstay-cms
```

## Troubleshooting

### Port Already in Use
```bash
# Find process using port 5000
lsof -i :5000

# Kill process
kill -9 <PID>
```

### Git Authentication Issues
- Verify GITHUB_TOKEN has correct permissions
- Check token hasn't expired
- Ensure token has `repo` scope

### File Upload Issues
- Check disk space: `df -h`
- Verify write permissions: `ls -la assets/`
- Check file size limits in code

### Database/JSON Issues
- Backup data.json regularly
- Validate JSON syntax
- Check file permissions

## Security Recommendations

1. **Use Environment Variables**
   - Never commit .env to git
   - Use different credentials for production

2. **Enable HTTPS**
   - Use Let's Encrypt for free SSL
   - Force HTTPS redirects

3. **Firewall Configuration**
   ```bash
   sudo ufw allow 22
   sudo ufw allow 80
   sudo ufw allow 443
   sudo ufw enable
   ```

4. **Regular Updates**
   ```bash
   npm audit
   npm audit fix
   ```

5. **Backup Strategy**
   - Daily backups of data.json
   - Weekly full backups
   - Test restore procedures

## Performance Optimization

1. **Enable Gzip in Nginx**
```nginx
gzip on;
gzip_vary on;
gzip_types text/plain text/css application/json application/javascript;
```

2. **Use CDN for Assets**
- Upload images/videos to Cloudinary or AWS S3
- Update paths in JSON

3. **Enable Caching**
```nginx
location ~* \.(jpg|jpeg|png|gif|ico|css|js)$ {
    expires 1y;
    add_header Cache-Control "public, immutable";
}
```

## Support & Resources

- [Node.js Documentation](https://nodejs.org/docs/)
- [Express.js Guide](https://expressjs.com/guide/)
- [React Documentation](https://react.dev/)
- [PM2 Documentation](https://pm2.keymetrics.io/docs/)
- [Nginx Documentation](https://nginx.org/en/docs/)

---

For additional help, refer to README.md or open an issue on GitHub.
