# Contributing to UnseenStay CMS

Thank you for your interest in contributing to UnseenStay CMS! This document provides guidelines and instructions for contributing.

## Code of Conduct

- Be respectful and inclusive
- Welcome newcomers and help them learn
- Focus on constructive feedback
- Respect differing viewpoints and experiences

## How to Contribute

### Reporting Bugs

Before creating a bug report:
1. Check if the bug has already been reported
2. Verify you're using the latest version
3. Test with a clean installation

When creating a bug report, include:
- **Description**: Clear description of the bug
- **Steps to Reproduce**: Detailed steps to reproduce the issue
- **Expected Behavior**: What you expected to happen
- **Actual Behavior**: What actually happened
- **Environment**: OS, Node version, browser
- **Screenshots**: If applicable
- **Error Messages**: Full error messages and stack traces

### Suggesting Features

Feature suggestions are welcome! Please include:
- **Use Case**: Why is this feature needed?
- **Proposed Solution**: How should it work?
- **Alternatives**: Other solutions you've considered
- **Impact**: Who will benefit from this feature?

### Pull Requests

#### Before Submitting

1. **Fork the Repository**
   ```bash
   git clone https://github.com/yourusername/unseenstay.git
   cd unseenstay/cms-app
   ```

2. **Create a Branch**
   ```bash
   git checkout -b feature/your-feature-name
   ```

3. **Set Up Development Environment**
   ```bash
   npm install
   cd client && npm install && cd ..
   cp .env.example .env
   ```

#### Development Guidelines

**Code Style**
- Use consistent indentation (2 spaces)
- Follow existing code patterns
- Use meaningful variable names
- Add comments for complex logic
- Keep functions small and focused

**Backend (Node.js)**
```javascript
// Good
const getUserById = async (userId) => {
  try {
    const user = await User.findById(userId);
    return user;
  } catch (error) {
    throw new Error(`Failed to fetch user: ${error.message}`);
  }
};

// Bad
const getUser = async (id) => {
  return await User.findById(id);
};
```

**Frontend (React)**
```javascript
// Good
const ContentEditor = () => {
  const [content, setContent] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetchContent();
  }, []);

  const fetchContent = async () => {
    try {
      const response = await api.get('/content');
      setContent(response.data);
    } catch (error) {
      toast.error('Failed to fetch content');
    } finally {
      setLoading(false);
    }
  };

  if (loading) return <Spinner />;
  
  return <div>{/* content */}</div>;
};

// Bad
const ContentEditor = () => {
  const [content, setContent] = useState(null);
  useEffect(() => {
    api.get('/content').then(res => setContent(res.data));
  }, []);
  return <div>{/* content */}</div>;
};
```

**Commit Messages**
Follow conventional commits:
```
feat: add user profile page
fix: resolve login authentication issue
docs: update API documentation
style: format code with prettier
refactor: simplify content editor logic
test: add unit tests for auth middleware
chore: update dependencies
```

#### Testing

Before submitting:
1. **Test Your Changes**
   ```bash
   npm run dev
   # Test all affected features
   ```

2. **Check for Errors**
   - No console errors
   - No broken functionality
   - Responsive design works
   - All API endpoints functional

3. **Test Edge Cases**
   - Empty states
   - Error conditions
   - Large datasets
   - Network failures

#### Submitting Pull Request

1. **Update Documentation**
   - Update README.md if needed
   - Add to CHANGELOG.md
   - Update API docs if applicable

2. **Push Changes**
   ```bash
   git add .
   git commit -m "feat: add your feature"
   git push origin feature/your-feature-name
   ```

3. **Create Pull Request**
   - Use a clear title
   - Describe what changed and why
   - Reference related issues
   - Add screenshots if UI changes
   - List breaking changes if any

4. **PR Template**
   ```markdown
   ## Description
   Brief description of changes

   ## Type of Change
   - [ ] Bug fix
   - [ ] New feature
   - [ ] Breaking change
   - [ ] Documentation update

   ## Testing
   - [ ] Tested locally
   - [ ] All features work
   - [ ] No console errors
   - [ ] Responsive design verified

   ## Screenshots
   (if applicable)

   ## Related Issues
   Closes #123
   ```

## Development Setup

### Prerequisites
- Node.js 16+
- npm or yarn
- Git
- Code editor (VS Code recommended)

### Recommended VS Code Extensions
- ESLint
- Prettier
- Tailwind CSS IntelliSense
- ES7+ React/Redux/React-Native snippets
- GitLens

### Project Structure
```
cms-app/
├── server/           # Backend code
│   ├── routes/       # API routes
│   ├── middleware/   # Express middleware
│   └── index.js      # Entry point
├── client/           # Frontend code
│   └── src/
│       ├── components/  # React components
│       ├── pages/       # Page components
│       ├── store/       # State management
│       └── utils/       # Utilities
```

### Running Tests

```bash
# Backend tests (when implemented)
npm test

# Frontend tests (when implemented)
cd client && npm test
```

### Debugging

**Backend**
```bash
# Run with debugging
node --inspect server/index.js

# Or use VS Code debugger
# Add to .vscode/launch.json
```

**Frontend**
```bash
# React DevTools in browser
# Redux DevTools (if using Redux)
```

## Areas for Contribution

### High Priority
- [ ] Unit tests for backend routes
- [ ] Integration tests
- [ ] Error boundary components
- [ ] Loading states improvements
- [ ] Accessibility improvements
- [ ] Performance optimization

### Medium Priority
- [ ] Multi-user support
- [ ] Activity logging
- [ ] Content versioning
- [ ] Search functionality
- [ ] Bulk operations
- [ ] Export/Import features

### Low Priority
- [ ] Dark mode
- [ ] Keyboard shortcuts
- [ ] Advanced Git features
- [ ] Custom themes
- [ ] Plugin system

## Questions?

- Open an issue for questions
- Check existing documentation
- Review closed issues and PRs

## Recognition

Contributors will be:
- Listed in CONTRIBUTORS.md
- Mentioned in release notes
- Credited in documentation

## License

By contributing, you agree that your contributions will be licensed under the same license as the project (MIT License).

---

Thank you for contributing to UnseenStay CMS! 🎉
