# Quick Start Guide

Get your CMS up and running in 5 minutes!

## Step 1: Install Dependencies

```bash
# Install backend dependencies
cd cms-app
npm install

# Install frontend dependencies
cd client
npm install
cd ..
```

## Step 2: Configure Environment

```bash
# Copy environment template
copy .env.example .env
```

Edit `.env` file with your details:
- Change `JWT_SECRET` to a random string
- Update `GIT_USER_NAME` and `GIT_USER_EMAIL`
- Add your `GITHUB_TOKEN` (optional, for push/pull)

## Step 3: Run the Application

```bash
# From cms-app directory
npm run dev
```

This will start:
- Backend server on http://localhost:5000
- Frontend app on http://localhost:3000

## Step 4: Login

1. Open http://localhost:3000 in your browser
2. Login with default credentials:
   - Username: `admin`
   - Password: `admin123`

## Step 5: Start Managing Content!

You're all set! You can now:
- ✏️ Edit content in the Content Editor
- 📁 Upload files in File Manager
- 🔄 Commit and push changes in Git Manager

## Getting GitHub Token (Optional)

For Git push/pull functionality:

1. Go to https://github.com/settings/tokens
2. Click "Generate new token (classic)"
3. Select scope: `repo` (Full control of private repositories)
4. Generate token and copy it
5. Add to `.env` as `GITHUB_TOKEN=your_token_here`

## Troubleshooting

**Port already in use?**
```bash
# Change PORT in .env file
PORT=5001
```

**Can't connect to backend?**
- Make sure backend is running
- Check if port 5000 is accessible
- Look for errors in terminal

**Login not working?**
- Check if JWT_SECRET is set in .env
- Clear browser cache/cookies
- Check browser console for errors

## Next Steps

- Read the full [README.md](README.md) for detailed documentation
- Customize authentication credentials
- Set up GitHub integration for automated deployments
- Explore all features in the dashboard

Happy content managing! 🚀
