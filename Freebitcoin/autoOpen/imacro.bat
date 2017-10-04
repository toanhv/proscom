@echo off

start firefox -no-remote -private-window imacros://run/?m=prosharers.com.iim
timeout 10
taskkill /f /t /im Firefox.exe /im crashreporter.exe >nul 2>&1
%0