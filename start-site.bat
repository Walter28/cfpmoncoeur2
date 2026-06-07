@echo off
setlocal
cd /d "%~dp0"

echo.
echo CFP Mon Coeur est accessible sur http://127.0.0.1:9000
echo Laisse cette fenetre ouverte pendant l'utilisation du site.
echo.

"%~dp0tools\php\php.exe" -S 127.0.0.1:9000 -t public server.php
