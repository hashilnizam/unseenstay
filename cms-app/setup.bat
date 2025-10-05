@echo off
echo ========================================
echo UnseenStay CMS - Setup Script
echo ========================================
echo.

echo [1/4] Installing backend dependencies...
call npm install
if %errorlevel% neq 0 (
    echo Error: Failed to install backend dependencies
    pause
    exit /b 1
)
echo ✓ Backend dependencies installed
echo.

echo [2/4] Installing frontend dependencies...
cd client
call npm install
if %errorlevel% neq 0 (
    echo Error: Failed to install frontend dependencies
    pause
    exit /b 1
)
cd ..
echo ✓ Frontend dependencies installed
echo.

echo [3/4] Setting up environment file...
if not exist .env (
    copy .env.example .env
    echo ✓ Created .env file from template
    echo.
    echo IMPORTANT: Please edit .env file with your settings:
    echo   - Change JWT_SECRET to a random string
    echo   - Update GIT_USER_NAME and GIT_USER_EMAIL
    echo   - Add GITHUB_TOKEN for Git integration
    echo.
) else (
    echo ✓ .env file already exists
    echo.
)

echo [4/4] Setup complete!
echo.
echo ========================================
echo Next Steps:
echo ========================================
echo 1. Edit .env file with your configuration
echo 2. Run: npm run dev
echo 3. Open: http://localhost:3000
echo 4. Login with: admin / admin123
echo.
echo For detailed instructions, see README.md
echo ========================================
pause
