@echo off
echo Stopping all Node.js servers...
taskkill /F /IM node.exe >nul 2>&1
if %ERRORLEVEL% EQU 0 (
    echo Successfully stopped all Node.js servers
) else (
    echo No Node.js servers were running
)
pause
