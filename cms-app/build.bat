@echo off
echo ========================================
echo UnseenStay CMS - Build Script
echo ========================================
echo.

:: Check if Node.js is installed
node --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ERROR: Node.js is not installed or not in PATH
    echo Please install Node.js from https://nodejs.org/
    pause
    exit /b 1
)

:: Check if npm is available
npm --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ERROR: npm is not available
    pause
    exit /b 1
)

echo Node.js and npm are available
echo.

:: Set the current directory to the CMS app root
cd /d "%~dp0"

echo Current directory: %cd%
echo.

:: Install root dependencies if node_modules doesn't exist
if not exist "node_modules" (
    echo Installing root dependencies...
    npm install
    if %errorlevel% neq 0 (
        echo ERROR: Failed to install root dependencies
        pause
        exit /b 1
    )
    echo Root dependencies installed successfully
    echo.
)

:: Build the client
echo ========================================
echo Building Client Application...
echo ========================================
cd client

:: Install client dependencies if node_modules doesn't exist
if not exist "node_modules" (
    echo Installing client dependencies...
    npm install
    if %errorlevel% neq 0 (
        echo ERROR: Failed to install client dependencies
        pause
        exit /b 1
    )
    echo Client dependencies installed successfully
    echo.
)

:: Build the client
echo Building client for production...
npm run build
if %errorlevel% neq 0 (
    echo ERROR: Client build failed
    pause
    exit /b 1
)

echo Client build completed successfully!
echo.

:: Go back to root directory
cd ..

:: Check if server has dependencies and install if needed
echo ========================================
echo Checking Server Dependencies...
echo ========================================
cd server

if not exist "node_modules" (
    echo Installing server dependencies...
    npm install
    if %errorlevel% neq 0 (
        echo ERROR: Failed to install server dependencies
        pause
        exit /b 1
    )
    echo Server dependencies installed successfully
    echo.
)

:: Go back to root
cd ..

echo ========================================
echo Build Process Completed Successfully!
echo ========================================
echo.
echo Client build output: client/dist/
echo Server files: server/
echo.
echo To start the application:
echo 1. Run: npm start (from root directory)
echo 2. Or run: node server/index.js
echo.
echo Press any key to exit...
pause >nul
