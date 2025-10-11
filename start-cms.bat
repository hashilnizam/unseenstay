@echo off
cls
echo ========================================
echo   UnseenStay CMS - Starting Server
echo ========================================
echo.
echo Starting server on http://localhost:5000
echo.
echo 🌐 Website:      http://localhost:5000/
echo 🔐 Admin Panel:  http://localhost:5000/admin
echo.
echo 📋 Login Credentials:
echo    Check .env file for credentials
echo.
echo 📁 Data File: assets/data/content.json
echo.
echo Press Ctrl+C to stop the server
echo ========================================
echo.

cd cms-app
if exist server\index.js (
    node server/index.js
) else (
    echo Error: Could not find server/index.js
    echo Current directory: %cd%
    echo.
    pause
)
