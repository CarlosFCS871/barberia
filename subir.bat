@echo off
echo Limpiando conexiones viejas...
git remote remove origin
echo.
echo Conectando a GitHub...
git remote add origin https://github.com
echo.
echo Subiendo proyecto de Barberia...
git push -u origin main
echo.
echo Proceso terminado!
pause
