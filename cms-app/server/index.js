const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');
const dotenv = require('dotenv');
const path = require('path');

dotenv.config();

// Debug: Log environment variables
console.log('📋 Environment Variables Loaded:');
console.log('DATA_JSON_PATH:', process.env.DATA_JSON_PATH);
console.log('ASSETS_PATH:', process.env.ASSETS_PATH);

const app = express();
const PORT = process.env.PORT || 5000;

// Middleware
app.use(cors());
app.use(bodyParser.json({ limit: '50mb' }));
app.use(bodyParser.urlencoded({ extended: true, limit: '50mb' }));

// Serve static files from main website root (includes assets folder)
app.use(express.static(path.join(__dirname, '../..')));

// Serve CMS client build (production)
const clientDistPath = path.join(__dirname, '../client/dist');
app.use('/admin', express.static(clientDistPath));

// Routes
app.use('/api/auth', require('./routes/auth'));
app.use('/api/content', require('./routes/content'));
app.use('/api/upload', require('./routes/upload'));
app.use('/api/git', require('./routes/git'));

// Redirect /login to /admin
app.get('/login', (req, res) => {
  res.redirect('/admin');
});

// Serve admin panel (React app with client-side routing)
// This must handle all admin routes for React Router
app.get('/admin*', (req, res) => {
  const indexPath = path.join(clientDistPath, 'index.html');
  const fs = require('fs');
  if (fs.existsSync(indexPath)) {
    res.sendFile(indexPath);
  } else {
    res.status(503).send(`
      <h1>Admin Panel Not Built</h1>
      <p>Please build the admin panel first:</p>
      <pre>cd cms-app && npm run build</pre>
      <p>Or run in development mode on port 3000:</p>
      <pre>cd cms-app && npm run dev</pre>
    `);
  }
});

// Serve the main index.html at root
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, '../../index.html'));
});

// Health check
app.get('/api/health', (req, res) => {
  res.json({ status: 'ok', message: 'UnseenStay CMS API is running' });
});

// Error handling middleware
app.use((err, req, res, next) => {
  console.error(err.stack);
  res.status(500).json({ 
    error: 'Something went wrong!', 
    message: err.message 
  });
});

app.listen(PORT, () => {
  console.log(`🚀 CMS Server running on http://localhost:${PORT}`);
});
