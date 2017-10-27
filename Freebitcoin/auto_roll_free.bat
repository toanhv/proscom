@echo off
timeout 20
taskkill /f /t /im firefox.exe /im crashreporter.exe >nul 2>&1
start firefox -no-remote -P "toanhv26" https://freebitco.in/
timeout 20
taskkill /f /t /im firefox.exe /im crashreporter.exe >nul 2>&1
start firefox -no-remote -P "toanhv26" https://freebitco.in/
timeout 20
%0