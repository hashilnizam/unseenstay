@echo off
echo ========================================
echo UnseenStay CMS - Client Build Only
echo ========================================
echo.

:: Set the current directory to the CMS app root
cd /d "%~dp0"

:: Go to client directory
cd client

:: Check if Node.js and npm are available
node --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ERROR: Node.js is not installed or not in PATH
    pause
    exit /b 1
)

:: Install dependencies if needed
if not exist "node_modules" (
    echo Installing client dependencies...
    npm install
    if %errorlevel% neq 0 (
        echo ERROR: Failed to install dependencies
        pause
        exit /b 1
    )
)

:: Build the client
echo Building client for production...
npm run build
if %errorlevel% neq 0 (
    echo ERROR: Build failed
    pause
    exit /b 1
)

echo.
echo ========================================
echo Client Build Completed Successfully!
echo ========================================
echo Build output: client/dist/
echo.
pause
