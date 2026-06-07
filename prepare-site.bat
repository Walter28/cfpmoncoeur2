@echo off
setlocal
cd /d "%~dp0"

echo Nettoyage Laravel...
"%~dp0tools\php\php.exe" artisan optimize:clear

echo Verification base SQLite...
"%~dp0tools\php\php.exe" artisan migrate --seed --force

if not exist "%~dp0node_modules" (
    echo Installation des dependances front...
    npm install
)

echo Build des assets...
npm run build

echo.
echo Preparation terminee.
echo Lance ensuite start-site.bat
