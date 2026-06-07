@echo off
setlocal
cd /d "%~dp0"

for /f "tokens=5" %%p in ('netstat -ano ^| findstr ":9000" ^| findstr "LISTENING"') do (
    taskkill /PID %%p /F >nul 2>&1
)

echo Serveur local sur le port 9000 arrete.
