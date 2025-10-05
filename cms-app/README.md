# UnseenStay CMS

A powerful Content Management System for managing UnseenStay's JSON data with Git integration, file uploads, and automated deployment.

## Features

✨ **Full CRUD Operations**
- Create, Read, Update, Delete operations on JSON content
- Support for nested objects and arrays
- Visual and JSON editing modes

📁 **File Management**
- Upload images and videos
- Automatic path management in JSON
- File preview and deletion

🔄 **Git Integration**
- Automatic commit message generation
- Push/Pull from GitHub
- Commit history viewer
- Real-time status monitoring

🔐 **Authentication**
- JWT-based authentication
- Protected API endpoints
- Session management

🎨 **Modern UI**
- Built with React and TailwindCSS
- Responsive design
- Real-time notifications

## Tech Stack

### Backend
- **Node.js** with Express
- **simple-git** for Git operations
- **multer** for file uploads
- **JWT** for authentication

### Frontend
- **React 18** with Vite
- **TailwindCSS** for styling
- **Lucide React** for icons
- **Zustand** for state management
- **React Router** for navigation

## Installation

### Prerequisites
- Node.js 16+ and npm
- Git installed and configured
- GitHub repository set up

### Setup Steps

1. **Install Backend Dependencies**
```bash
cd cms-app
npm install
```

2. **Install Frontend Dependencies**
```bash
cd client
npm install
```

3. **Configure Environment**
```bash
# Copy the example env file
cp .env.example .env

# Edit .env with your settings
```

4. **Environment Variables**

Edit `.env` file:

```env
# Server Configuration
PORT=5000
NODE_ENV=development

# Authentication
JWT_SECRET=your-secret-key-change-this-in-production
ADMIN_USERNAME=admin
ADMIN_PASSWORD=admin123

# Git Configuration
GIT_USER_NAME=Your Name
GIT_USER_EMAIL=your-email@example.com
GITHUB_TOKEN=your-github-personal-access-token

# Paths (relative to server directory)
DATA_JSON_PATH=../assets/core/data.json
ASSETS_PATH=../assets
REPO_PATH=../
```

### GitHub Token Setup

1. Go to GitHub Settings → Developer Settings → Personal Access Tokens
2. Generate new token (classic)
3. Select scopes: `repo` (full control)
4. Copy token and add to `.env` as `GITHUB_TOKEN`

## Usage

### Development Mode

Run both backend and frontend concurrently:

```bash
npm run dev
```

Or run separately:

```bash
# Terminal 1 - Backend
npm run server

# Terminal 2 - Frontend
npm run client
```

The application will be available at:
- Frontend: http://localhost:3000
- Backend API: http://localhost:5000

### Production Build

```bash
# Build frontend
npm run build

# Start production server
npm start
```

## Default Credentials

- **Username:** admin
- **Password:** admin123

⚠️ **Important:** Change these credentials in production!

## API Endpoints

### Authentication
- `POST /api/auth/login` - Login
- `GET /api/auth/verify` - Verify token

### Content Management
- `GET /api/content` - Get all content
- `GET /api/content/:section` - Get specific section
- `PUT /api/content/:section` - Update section
- `PATCH /api/content/field` - Update specific field
- `POST /api/content/array/add` - Add item to array
- `POST /api/content/array/remove` - Remove item from array
- `POST /api/content/array/update` - Update array item

### File Upload
- `POST /api/upload/single` - Upload single file
- `POST /api/upload/multiple` - Upload multiple files
- `DELETE /api/upload/file` - Delete file
- `GET /api/upload/list/:type` - List files by type

### Git Operations
- `GET /api/git/status` - Get repository status
- `GET /api/git/log` - Get commit history
- `POST /api/git/commit` - Commit changes
- `POST /api/git/push` - Push to remote
- `POST /api/git/commit-and-push` - Commit and push
- `POST /api/git/pull` - Pull from remote

## Features Guide

### Content Editor

1. **Visual Mode**
   - Edit content using form fields
   - Automatic type detection (text, number, boolean)
   - Nested object support
   - Array management (add/remove items)

2. **JSON Mode**
   - Direct JSON editing
   - Syntax validation
   - Quick bulk updates

### File Manager

1. **Upload Files**
   - Drag and drop support
   - Multiple file upload
   - Automatic categorization (images/videos)

2. **Manage Files**
   - Preview images
   - Copy file paths
   - Delete unused files

### Git Manager

1. **Commit Changes**
   - View modified files
   - Write commit messages
   - Commit to local repository

2. **Sync with Remote**
   - Push changes to GitHub
   - Pull latest changes
   - View commit history

3. **Automated Workflow**
   - Commit and push in one action
   - Auto-generated commit messages
   - Real-time status updates

## Workflow Example

1. **Edit Content**
   - Navigate to Content Editor
   - Select section to edit
   - Make changes in visual or JSON mode
   - Click "Save Changes"

2. **Upload Files**
   - Go to File Manager
   - Select file type (images/videos)
   - Upload files
   - Copy path and use in content

3. **Deploy Changes**
   - Open Git Manager
   - Review modified files
   - Enter commit message
   - Click "Commit & Push"
   - Changes are live!

## Security Best Practices

1. **Change Default Credentials**
   - Update `ADMIN_USERNAME` and `ADMIN_PASSWORD` in `.env`

2. **Secure JWT Secret**
   - Use a strong, random `JWT_SECRET`
   - Never commit `.env` to version control

3. **GitHub Token**
   - Use fine-grained tokens with minimal permissions
   - Rotate tokens regularly

4. **HTTPS in Production**
   - Always use HTTPS in production
   - Configure proper CORS settings

## Troubleshooting

### Git Authentication Issues
- Ensure `GITHUB_TOKEN` has correct permissions
- Check if token is expired
- Verify repository URL in git config

### File Upload Errors
- Check file size limits (default 50MB)
- Verify `ASSETS_PATH` is correct
- Ensure write permissions on assets directory

### Connection Issues
- Verify backend is running on correct port
- Check proxy settings in `client/vite.config.js`
- Ensure no firewall blocking

## Project Structure

```
cms-app/
├── server/                 # Backend
│   ├── routes/            # API routes
│   │   ├── auth.js        # Authentication
│   │   ├── content.js     # Content CRUD
│   │   ├── upload.js      # File uploads
│   │   └── git.js         # Git operations
│   ├── middleware/        # Express middleware
│   │   └── auth.js        # JWT verification
│   └── index.js           # Server entry point
├── client/                # Frontend
│   ├── src/
│   │   ├── components/    # React components
│   │   ├── pages/         # Page components
│   │   ├── store/         # State management
│   │   ├── utils/         # Utilities
│   │   ├── App.jsx        # Main app component
│   │   └── main.jsx       # Entry point
│   ├── index.html
│   └── package.json
├── .env.example           # Environment template
├── .gitignore
├── package.json
└── README.md
```

## Contributing

1. Fork the repository
2. Create feature branch
3. Commit changes
4. Push to branch
5. Open pull request

## License

MIT License - feel free to use for your projects!

## Support

For issues and questions:
- Check troubleshooting section
- Review API documentation
- Check console logs for errors

---

Built with ❤️ for UnseenStay
