@echo off
echo ========================================
echo UnseenStay CMS - Production Start
echo ========================================
echo.

:: Set the current directory to the CMS app root
cd /d "%~dp0"

:: Check if Node.js is available
node --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ERROR: Node.js is not installed or not in PATH
    pause
    exit /b 1
)

:: Check if client build exists
if not exist "client\dist" (
    echo ERROR: Client build not found!
    echo Please run build.bat first to build the client application
    echo.
    pause
    exit /b 1
)

:: Check if server dependencies exist
if not exist "server\node_modules" (
    echo Installing server dependencies...
    cd server
    npm install
    if %errorlevel% neq 0 (
        echo ERROR: Failed to install server dependencies
        pause
        exit /b 1
    )
    cd ..
)

echo.
echo ========================================
echo Starting Production Server...
echo ========================================
echo.
echo Server will be available at: http://localhost:3001
echo Admin panel: http://localhost:3001/admin
echo.
echo Press Ctrl+C to stop the server
echo.

:: Start the production server
npm start
