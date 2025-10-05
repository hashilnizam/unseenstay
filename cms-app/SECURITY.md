# Security Policy

## Supported Versions

| Version | Supported          |
| ------- | ------------------ |
| 1.0.x   | :white_check_mark: |

## Reporting a Vulnerability

If you discover a security vulnerability, please email us at security@unseenstay.com or open a private security advisory on GitHub.

**Please do not open public issues for security vulnerabilities.**

### What to Include

- Description of the vulnerability
- Steps to reproduce
- Potential impact
- Suggested fix (if any)

### Response Time

- Initial response: Within 48 hours
- Status update: Within 7 days
- Fix timeline: Depends on severity

## Security Best Practices

### 1. Authentication & Authorization

#### Change Default Credentials
```env
# .env
ADMIN_USERNAME=your-unique-username
ADMIN_PASSWORD=your-strong-password-here
```

**Password Requirements**:
- Minimum 12 characters
- Mix of uppercase, lowercase, numbers, symbols
- No common words or patterns
- Use password manager

#### Secure JWT Secret
```env
# Generate strong secret
JWT_SECRET=your-random-64-character-string-here
```

Generate secure secret:
```bash
# Node.js
node -e "console.log(require('crypto').randomBytes(64).toString('hex'))"

# OpenSSL
openssl rand -hex 64
```

#### Token Expiration
Default: 24 hours. Adjust in `server/routes/auth.js`:
```javascript
const token = jwt.sign(
  { id: user.id, username: user.username },
  process.env.JWT_SECRET,
  { expiresIn: '24h' } // Change as needed
);
```

### 2. Environment Variables

#### Never Commit .env
```bash
# Verify .gitignore includes
cat .gitignore | grep .env
```

#### Use Different Credentials Per Environment
```env
# Development
ADMIN_PASSWORD=dev-password

# Production
ADMIN_PASSWORD=strong-production-password
```

#### Validate Environment Variables
Add to `server/index.js`:
```javascript
const requiredEnvVars = [
  'JWT_SECRET',
  'ADMIN_USERNAME',
  'ADMIN_PASSWORD'
];

requiredEnvVars.forEach(varName => {
  if (!process.env[varName]) {
    console.error(`Missing required environment variable: ${varName}`);
    process.exit(1);
  }
});
```

### 3. GitHub Token Security

#### Minimal Permissions
- Only grant `repo` scope
- Use fine-grained tokens when possible
- Set expiration date

#### Rotate Tokens Regularly
```bash
# Revoke old token on GitHub
# Generate new token
# Update .env
GITHUB_TOKEN=new_token_here

# Restart server
pm2 restart unseenstay-cms
```

#### Never Log Tokens
```javascript
// Bad
console.log(process.env.GITHUB_TOKEN);

// Good
console.log('GitHub token configured:', !!process.env.GITHUB_TOKEN);
```

### 4. File Upload Security

#### Validate File Types
Already implemented in `server/routes/upload.js`:
```javascript
const allowedTypes = /jpeg|jpg|png|gif|webp|mp4|webm|svg/;
```

#### Limit File Size
Default: 50MB. Adjust in `server/routes/upload.js`:
```javascript
const upload = multer({
  limits: {
    fileSize: 50 * 1024 * 1024 // 50MB
  }
});
```

#### Sanitize Filenames
Already implemented with timestamp and random suffix:
```javascript
const uniqueSuffix = Date.now() + '-' + Math.round(Math.random() * 1E9);
```

#### Prevent Path Traversal
Already implemented in delete endpoint:
```javascript
const normalizedPath = path.normalize(fullPath);
if (!normalizedPath.startsWith(normalizedAssets)) {
  return res.status(403).json({ error: 'Invalid file path' });
}
```

### 5. API Security

#### CORS Configuration
Development (allow all):
```javascript
app.use(cors());
```

Production (restrict origins):
```javascript
app.use(cors({
  origin: 'https://your-domain.com',
  credentials: true,
  methods: ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'],
  allowedHeaders: ['Content-Type', 'Authorization']
}));
```

#### Rate Limiting
Add to `server/index.js`:
```javascript
const rateLimit = require('express-rate-limit');

const limiter = rateLimit({
  windowMs: 15 * 60 * 1000, // 15 minutes
  max: 100, // limit each IP to 100 requests per windowMs
  message: 'Too many requests, please try again later.'
});

app.use('/api/', limiter);

// Stricter limit for login
const loginLimiter = rateLimit({
  windowMs: 15 * 60 * 1000,
  max: 5,
  message: 'Too many login attempts, please try again later.'
});

app.use('/api/auth/login', loginLimiter);
```

#### Helmet for Security Headers
```bash
npm install helmet
```

```javascript
const helmet = require('helmet');
app.use(helmet());
```

#### Input Validation
Add validation middleware:
```javascript
const { body, validationResult } = require('express-validator');

app.post('/api/auth/login',
  body('username').trim().isLength({ min: 3 }),
  body('password').isLength({ min: 8 }),
  (req, res) => {
    const errors = validationResult(req);
    if (!errors.isEmpty()) {
      return res.status(400).json({ errors: errors.array() });
    }
    // Continue with login
  }
);
```

### 6. HTTPS/SSL

#### Development
Use self-signed certificate or mkcert:
```bash
# Install mkcert
choco install mkcert

# Create certificate
mkcert localhost
```

#### Production
Use Let's Encrypt:
```bash
sudo certbot --nginx -d your-domain.com
```

#### Force HTTPS
Add to Nginx config:
```nginx
server {
    listen 80;
    server_name your-domain.com;
    return 301 https://$server_name$request_uri;
}
```

### 7. Database/JSON Security

#### Backup Regularly
```bash
# Daily backup script
#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)
cp assets/core/data.json backups/data_$DATE.json

# Keep only last 30 days
find backups/ -name "data_*.json" -mtime +30 -delete
```

#### Validate JSON Before Save
```javascript
const validateJSON = (data) => {
  try {
    JSON.parse(JSON.stringify(data));
    return true;
  } catch (e) {
    return false;
  }
};

// Use before saving
if (!validateJSON(newData)) {
  return res.status(400).json({ error: 'Invalid JSON data' });
}
```

#### File Permissions
```bash
# Restrict access to data.json
chmod 644 assets/core/data.json

# Only owner can write
chown www-data:www-data assets/core/data.json
```

### 8. Git Security

#### Protect Sensitive Files
Ensure `.gitignore` includes:
```
.env
.env.local
.env.production
node_modules/
*.log
```

#### Sign Commits
```bash
# Generate GPG key
gpg --gen-key

# Configure git
git config --global user.signingkey YOUR_KEY_ID
git config --global commit.gpgsign true
```

#### Review Before Push
```bash
# Check what will be pushed
git diff origin/main

# Review staged files
git status
```

### 9. Dependency Security

#### Regular Audits
```bash
# Check for vulnerabilities
npm audit

# Fix automatically
npm audit fix

# Fix with breaking changes
npm audit fix --force
```

#### Update Dependencies
```bash
# Check outdated packages
npm outdated

# Update all
npm update

# Update specific package
npm update package-name
```

#### Use Lock Files
Commit `package-lock.json`:
```bash
git add package-lock.json
git commit -m "chore: update dependencies"
```

### 10. Server Security

#### Firewall Configuration
```bash
# Ubuntu/Debian
sudo ufw allow 22    # SSH
sudo ufw allow 80    # HTTP
sudo ufw allow 443   # HTTPS
sudo ufw enable

# Deny all other ports
sudo ufw default deny incoming
sudo ufw default allow outgoing
```

#### SSH Security
```bash
# Disable password authentication
sudo nano /etc/ssh/sshd_config

# Set these values
PasswordAuthentication no
PermitRootLogin no
PubkeyAuthentication yes

# Restart SSH
sudo systemctl restart sshd
```

#### Keep System Updated
```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Enable automatic security updates
sudo apt install unattended-upgrades
sudo dpkg-reconfigure --priority=low unattended-upgrades
```

### 11. Monitoring & Logging

#### Log Security Events
Add to `server/index.js`:
```javascript
const winston = require('winston');

const logger = winston.createLogger({
  level: 'info',
  format: winston.format.json(),
  transports: [
    new winston.transports.File({ filename: 'error.log', level: 'error' }),
    new winston.transports.File({ filename: 'combined.log' })
  ]
});

// Log authentication attempts
app.post('/api/auth/login', (req, res) => {
  logger.info('Login attempt', {
    username: req.body.username,
    ip: req.ip,
    timestamp: new Date()
  });
});
```

#### Monitor Failed Logins
```javascript
const failedLogins = new Map();

app.post('/api/auth/login', (req, res) => {
  const ip = req.ip;
  const attempts = failedLogins.get(ip) || 0;
  
  if (attempts >= 5) {
    return res.status(429).json({ error: 'Too many failed attempts' });
  }
  
  // On failed login
  failedLogins.set(ip, attempts + 1);
  
  // Clear after 15 minutes
  setTimeout(() => failedLogins.delete(ip), 15 * 60 * 1000);
});
```

### 12. Error Handling

#### Don't Expose Stack Traces
```javascript
app.use((err, req, res, next) => {
  // Log full error
  console.error(err.stack);
  
  // Send generic message to client
  res.status(500).json({
    error: 'Internal server error',
    // Don't include: message: err.message
  });
});
```

#### Sanitize Error Messages
```javascript
// Bad
res.status(500).json({ error: err.message });

// Good
res.status(500).json({ error: 'Operation failed' });
```

## Security Checklist

### Before Deployment

- [ ] Change default admin credentials
- [ ] Set strong JWT_SECRET (64+ characters)
- [ ] Configure CORS for production domain
- [ ] Enable HTTPS/SSL
- [ ] Set up firewall rules
- [ ] Configure rate limiting
- [ ] Add security headers (Helmet)
- [ ] Validate all user inputs
- [ ] Set proper file permissions
- [ ] Remove development dependencies
- [ ] Enable error logging
- [ ] Set up monitoring
- [ ] Configure backups
- [ ] Review .gitignore
- [ ] Rotate GitHub token
- [ ] Test authentication flow
- [ ] Verify file upload restrictions
- [ ] Check for exposed secrets
- [ ] Update all dependencies
- [ ] Run security audit

### Regular Maintenance

- [ ] Weekly: Review logs for suspicious activity
- [ ] Monthly: Update dependencies
- [ ] Monthly: Rotate GitHub tokens
- [ ] Quarterly: Security audit
- [ ] Quarterly: Review access permissions
- [ ] Annually: Change admin password

## Common Vulnerabilities

### 1. SQL Injection
**Status**: Not applicable (using JSON, not SQL)

### 2. XSS (Cross-Site Scripting)
**Mitigation**: React escapes output by default

### 3. CSRF (Cross-Site Request Forgery)
**Mitigation**: JWT tokens in headers (not cookies)

### 4. Path Traversal
**Mitigation**: Path validation in file operations

### 5. Arbitrary File Upload
**Mitigation**: File type and size validation

### 6. Brute Force
**Mitigation**: Implement rate limiting

### 7. Session Hijacking
**Mitigation**: Short token expiration, HTTPS only

### 8. Information Disclosure
**Mitigation**: Generic error messages

## Incident Response

### If Compromised

1. **Immediate Actions**
   - Change all passwords
   - Rotate all tokens
   - Review access logs
   - Disable compromised accounts

2. **Investigation**
   - Check git history
   - Review file modifications
   - Analyze server logs
   - Identify entry point

3. **Recovery**
   - Restore from backup
   - Patch vulnerability
   - Update dependencies
   - Strengthen security

4. **Prevention**
   - Document incident
   - Update security policies
   - Implement additional monitoring
   - Train team members

## Resources

- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [Node.js Security Best Practices](https://nodejs.org/en/docs/guides/security/)
- [Express Security Best Practices](https://expressjs.com/en/advanced/best-practice-security.html)
- [JWT Best Practices](https://tools.ietf.org/html/rfc8725)

## Contact

For security concerns: security@unseenstay.com

---

**Remember**: Security is an ongoing process, not a one-time setup.
