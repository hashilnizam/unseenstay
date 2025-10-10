@echo off
echo ========================================
echo UnseenStay CMS - Development Server
echo ========================================
echo.

:: Set the current directory to the CMS app root
cd /d "%~dp0"

:: Check if Node.js and npm are available
node --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ERROR: Node.js is not installed or not in PATH
    pause
    exit /b 1
)

:: Install root dependencies if needed
if not exist "node_modules" (
    echo Installing root dependencies...
    npm install
    if %errorlevel% neq 0 (
        echo ERROR: Failed to install root dependencies
        pause
        exit /b 1
    )
)

:: Install client dependencies if needed
cd client
if not exist "node_modules" (
    echo Installing client dependencies...
    npm install
    if %errorlevel% neq 0 (
        echo ERROR: Failed to install client dependencies
        pause
        exit /b 1
    )
)

:: Go back to root
cd ..

:: Install server dependencies if needed
cd server
if not exist "node_modules" (
    echo Installing server dependencies...
    npm install
    if %errorlevel% neq 0 (
        echo ERROR: Failed to install server dependencies
        pause
        exit /b 1
    )
)

:: Go back to root
cd ..

echo.
echo ========================================
echo Starting Development Servers...
echo ========================================
echo.
echo This will start both client and server in development mode
echo Client will be available at: http://localhost:5173
echo Server will be available at: http://localhost:3001
echo.
echo Press Ctrl+C to stop the servers
echo.

:: Start development servers (both client and server)
npm run dev
