# API Reference

Complete API documentation for UnseenStay CMS.

## Base URL

```
Development: http://localhost:5000/api
Production: https://your-domain.com/api
```

## Authentication

All endpoints except `/auth/login` require JWT authentication.

### Headers

```http
Authorization: Bearer <jwt_token>
Content-Type: application/json
```

---

## Authentication Endpoints

### Login

Authenticate user and receive JWT token.

**Endpoint**: `POST /api/auth/login`

**Request Body**:
```json
{
  "username": "admin",
  "password": "admin123"
}
```

**Response** (200 OK):
```json
{
  "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
  "user": {
    "id": 1,
    "username": "admin"
  }
}
```

**Errors**:
- `401 Unauthorized`: Invalid credentials

---

### Verify Token

Verify if JWT token is valid.

**Endpoint**: `GET /api/auth/verify`

**Headers**:
```http
Authorization: Bearer <token>
```

**Response** (200 OK):
```json
{
  "valid": true,
  "user": {
    "id": 1,
    "username": "admin"
  }
}
```

**Errors**:
- `401 Unauthorized`: Invalid or expired token

---

## Content Management Endpoints

### Get All Content

Retrieve entire JSON data.

**Endpoint**: `GET /api/content`

**Response** (200 OK):
```json
{
  "siteInfo": { ... },
  "logo": { ... },
  "header": { ... },
  "destinations": [ ... ],
  "contact": { ... }
}
```

---

### Get Section

Retrieve specific section of JSON data.

**Endpoint**: `GET /api/content/:section`

**Parameters**:
- `section` (string): Section name (e.g., "header", "destinations")

**Example**: `GET /api/content/header`

**Response** (200 OK):
```json
{
  "title": "Discover Hidden Gems",
  "subtitle": "Explore unseen destinations",
  "backgroundVideo": "assets/videos/hero.mp4"
}
```

**Errors**:
- `404 Not Found`: Section doesn't exist

---

### Update Entire Content

Replace entire JSON data.

**Endpoint**: `PUT /api/content`

**Request Body**:
```json
{
  "siteInfo": { ... },
  "logo": { ... },
  "header": { ... }
}
```

**Response** (200 OK):
```json
{
  "success": true,
  "message": "Content updated successfully"
}
```

---

### Update Section

Update specific section.

**Endpoint**: `PUT /api/content/:section`

**Parameters**:
- `section` (string): Section name

**Request Body**:
```json
{
  "title": "New Title",
  "subtitle": "New Subtitle"
}
```

**Response** (200 OK):
```json
{
  "success": true,
  "message": "Section updated successfully"
}
```

---

### Update Field

Update specific field using dot notation.

**Endpoint**: `PATCH /api/content/field`

**Request Body**:
```json
{
  "path": "header.title",
  "value": "New Title"
}
```

**Examples**:
```json
// Update nested field
{
  "path": "header.subtitle",
  "value": "Explore the world"
}

// Update array item
{
  "path": "destinations.0.name",
  "value": "New Destination"
}
```

**Response** (200 OK):
```json
{
  "success": true,
  "message": "Field updated successfully",
  "data": { ... }
}
```

---

### Add Item to Array

Add new item to an array.

**Endpoint**: `POST /api/content/array/add`

**Request Body**:
```json
{
  "path": "destinations",
  "item": {
    "id": "new-dest",
    "name": "New Destination",
    "description": "Amazing place"
  }
}
```

**Response** (200 OK):
```json
{
  "success": true,
  "message": "Item added successfully",
  "data": { ... }
}
```

**Errors**:
- `400 Bad Request`: Path doesn't point to an array

---

### Remove Item from Array

Remove item from array by index.

**Endpoint**: `POST /api/content/array/remove`

**Request Body**:
```json
{
  "path": "destinations",
  "index": 2
}
```

**Response** (200 OK):
```json
{
  "success": true,
  "message": "Item removed successfully",
  "data": { ... }
}
```

---

### Update Array Item

Update specific item in array.

**Endpoint**: `POST /api/content/array/update`

**Request Body**:
```json
{
  "path": "destinations",
  "index": 1,
  "item": {
    "id": "updated-dest",
    "name": "Updated Destination",
    "description": "New description"
  }
}
```

**Response** (200 OK):
```json
{
  "success": true,
  "message": "Item updated successfully",
  "data": { ... }
}
```

---

## File Upload Endpoints

### Upload Single File

Upload a single file.

**Endpoint**: `POST /api/upload/single`

**Content-Type**: `multipart/form-data`

**Form Data**:
- `file` (file): File to upload
- `uploadType` (string): "images" or "videos" (optional, default: "images")

**Example**:
```javascript
const formData = new FormData();
formData.append('file', fileInput.files[0]);
formData.append('uploadType', 'images');

fetch('/api/upload/single', {
  method: 'POST',
  headers: {
    'Authorization': `Bearer ${token}`
  },
  body: formData
});
```

**Response** (200 OK):
```json
{
  "success": true,
  "message": "File uploaded successfully",
  "file": {
    "filename": "image-1234567890.jpg",
    "originalName": "photo.jpg",
    "path": "assets/images/image-1234567890.jpg",
    "size": 1024000,
    "mimetype": "image/jpeg"
  }
}
```

**Errors**:
- `400 Bad Request`: No file uploaded
- `400 Bad Request`: Invalid file type

---

### Upload Multiple Files

Upload multiple files at once.

**Endpoint**: `POST /api/upload/multiple`

**Content-Type**: `multipart/form-data`

**Form Data**:
- `files` (files): Multiple files (max 10)
- `uploadType` (string): "images" or "videos"

**Response** (200 OK):
```json
{
  "success": true,
  "message": "Files uploaded successfully",
  "files": [
    {
      "filename": "image-1.jpg",
      "originalName": "photo1.jpg",
      "path": "assets/images/image-1.jpg",
      "size": 1024000,
      "mimetype": "image/jpeg"
    },
    {
      "filename": "image-2.jpg",
      "originalName": "photo2.jpg",
      "path": "assets/images/image-2.jpg",
      "size": 2048000,
      "mimetype": "image/jpeg"
    }
  ]
}
```

---

### Delete File

Delete uploaded file.

**Endpoint**: `DELETE /api/upload/file`

**Request Body**:
```json
{
  "filePath": "assets/images/image-1234567890.jpg"
}
```

**Response** (200 OK):
```json
{
  "success": true,
  "message": "File deleted successfully"
}
```

**Errors**:
- `400 Bad Request`: File path required
- `403 Forbidden`: Invalid file path (security)

---

### List Files

List all files in a directory.

**Endpoint**: `GET /api/upload/list/:type`

**Parameters**:
- `type` (string): "images" or "videos"

**Example**: `GET /api/upload/list/images`

**Response** (200 OK):
```json
{
  "success": true,
  "files": [
    {
      "name": "image-1.jpg",
      "path": "assets/images/image-1.jpg",
      "size": 1024000,
      "modified": "2025-10-05T06:20:37.000Z"
    },
    {
      "name": "image-2.jpg",
      "path": "assets/images/image-2.jpg",
      "size": 2048000,
      "modified": "2025-10-05T06:21:15.000Z"
    }
  ]
}
```

---

## Git Operations Endpoints

### Get Repository Status

Get current git repository status.

**Endpoint**: `GET /api/git/status`

**Response** (200 OK):
```json
{
  "success": true,
  "status": {
    "modified": ["assets/core/data.json"],
    "created": ["assets/images/new-image.jpg"],
    "deleted": [],
    "staged": [],
    "current": "main",
    "tracking": "origin/main"
  }
}
```

---

### Get Commit History

Get recent commit history.

**Endpoint**: `GET /api/git/log`

**Query Parameters**:
- `limit` (number): Number of commits (default: 10)

**Example**: `GET /api/git/log?limit=5`

**Response** (200 OK):
```json
{
  "success": true,
  "commits": [
    {
      "hash": "a1b2c3d4e5f6",
      "date": "2025-10-05T06:20:37.000Z",
      "message": "Updated header content",
      "author_name": "John Doe",
      "author_email": "john@example.com"
    }
  ]
}
```

---

### Commit Changes

Commit changes to local repository.

**Endpoint**: `POST /api/git/commit`

**Request Body**:
```json
{
  "files": ["assets/core/data.json"],
  "changes": {
    "customMessage": "Updated header subtitle",
    "section": "header",
    "action": "update",
    "field": "subtitle"
  }
}
```

**Fields**:
- `files` (array): Specific files to commit (optional, commits all if empty)
- `changes.customMessage` (string): Custom commit message
- `changes.section` (string): Section modified (for auto-message)
- `changes.action` (string): Action performed (for auto-message)
- `changes.field` (string): Field modified (for auto-message)

**Response** (200 OK):
```json
{
  "success": true,
  "message": "Changes committed successfully",
  "commit": "a1b2c3d4e5f6",
  "summary": {
    "changes": 1,
    "insertions": 5,
    "deletions": 2
  }
}
```

---

### Push to Remote

Push commits to remote repository.

**Endpoint**: `POST /api/git/push`

**Request Body**:
```json
{
  "remote": "origin",
  "branch": "main"
}
```

**Response** (200 OK):
```json
{
  "success": true,
  "message": "Changes pushed successfully",
  "result": { ... }
}
```

**Errors**:
- `500 Internal Server Error`: Push failed (check token/permissions)

---

### Commit and Push

Commit and push in one operation.

**Endpoint**: `POST /api/git/commit-and-push`

**Request Body**:
```json
{
  "files": ["assets/core/data.json"],
  "changes": {
    "customMessage": "Updated content and added images"
  },
  "remote": "origin",
  "branch": "main"
}
```

**Response** (200 OK):
```json
{
  "success": true,
  "message": "Changes committed and pushed successfully",
  "commit": "a1b2c3d4e5f6",
  "summary": { ... },
  "push": { ... }
}
```

---

### Pull from Remote

Pull latest changes from remote.

**Endpoint**: `POST /api/git/pull`

**Request Body**:
```json
{
  "remote": "origin",
  "branch": "main"
}
```

**Response** (200 OK):
```json
{
  "success": true,
  "message": "Changes pulled successfully",
  "result": { ... }
}
```

---

## Error Responses

All endpoints may return these error responses:

### 400 Bad Request
```json
{
  "error": "Error message",
  "message": "Detailed error description"
}
```

### 401 Unauthorized
```json
{
  "error": "Authentication required"
}
```

### 403 Forbidden
```json
{
  "error": "Access denied",
  "message": "Insufficient permissions"
}
```

### 404 Not Found
```json
{
  "error": "Resource not found",
  "message": "The requested resource does not exist"
}
```

### 500 Internal Server Error
```json
{
  "error": "Something went wrong!",
  "message": "Detailed error message"
}
```

---

## Rate Limiting

Currently no rate limiting is implemented. Consider adding in production:

```javascript
// Example with express-rate-limit
const rateLimit = require('express-rate-limit');

const limiter = rateLimit({
  windowMs: 15 * 60 * 1000, // 15 minutes
  max: 100 // limit each IP to 100 requests per windowMs
});

app.use('/api/', limiter);
```

---

## CORS Configuration

Default CORS settings allow all origins in development:

```javascript
app.use(cors());
```

For production, configure specific origins:

```javascript
app.use(cors({
  origin: 'https://your-domain.com',
  credentials: true
}));
```

---

## File Upload Limits

- **Max file size**: 50MB per file
- **Max files**: 10 files per request (multiple upload)
- **Allowed types**: 
  - Images: jpg, jpeg, png, gif, webp, svg
  - Videos: mp4, webm

---

## Usage Examples

### JavaScript (Fetch)

```javascript
// Login
const login = async (username, password) => {
  const response = await fetch('/api/auth/login', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ username, password })
  });
  return response.json();
};

// Get content
const getContent = async (token) => {
  const response = await fetch('/api/content', {
    headers: { 'Authorization': `Bearer ${token}` }
  });
  return response.json();
};

// Update section
const updateSection = async (token, section, data) => {
  const response = await fetch(`/api/content/${section}`, {
    method: 'PUT',
    headers: {
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
  });
  return response.json();
};

// Upload file
const uploadFile = async (token, file, type) => {
  const formData = new FormData();
  formData.append('file', file);
  formData.append('uploadType', type);
  
  const response = await fetch('/api/upload/single', {
    method: 'POST',
    headers: { 'Authorization': `Bearer ${token}` },
    body: formData
  });
  return response.json();
};

// Commit and push
const commitAndPush = async (token, message) => {
  const response = await fetch('/api/git/commit-and-push', {
    method: 'POST',
    headers: {
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      changes: { customMessage: message },
      remote: 'origin',
      branch: 'main'
    })
  });
  return response.json();
};
```

### Axios

```javascript
import axios from 'axios';

const api = axios.create({
  baseURL: '/api',
  headers: { 'Authorization': `Bearer ${token}` }
});

// Get content
const content = await api.get('/content');

// Update field
await api.patch('/content/field', {
  path: 'header.title',
  value: 'New Title'
});

// Upload file
const formData = new FormData();
formData.append('file', file);
const result = await api.post('/upload/single', formData);

// Commit and push
await api.post('/git/commit-and-push', {
  changes: { customMessage: 'Updated content' }
});
```

---

## Testing with cURL

```bash
# Login
curl -X POST http://localhost:5000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"username":"admin","password":"admin123"}'

# Get content (with token)
curl http://localhost:5000/api/content \
  -H "Authorization: Bearer YOUR_TOKEN"

# Update section
curl -X PUT http://localhost:5000/api/content/header \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"title":"New Title"}'

# Upload file
curl -X POST http://localhost:5000/api/upload/single \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -F "file=@/path/to/image.jpg" \
  -F "uploadType=images"

# Commit and push
curl -X POST http://localhost:5000/api/git/commit-and-push \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"changes":{"customMessage":"Updated via API"}}'
```

---

## Postman Collection

Import this JSON to test all endpoints in Postman:

```json
{
  "info": {
    "name": "UnseenStay CMS API",
    "schema": "https://schema.getpostman.com/json/collection/v2.1.0/collection.json"
  },
  "variable": [
    {
      "key": "baseUrl",
      "value": "http://localhost:5000/api"
    },
    {
      "key": "token",
      "value": ""
    }
  ]
}
```

---

For more information, see [README.md](README.md) and [TROUBLESHOOTING.md](TROUBLESHOOTING.md).
