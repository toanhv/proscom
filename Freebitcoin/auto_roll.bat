@echo off
taskkill /f /t /im Firefox.exe /im crashreporter.exe >nul 2>&1
timeout 20
start firefox -no-remote imacros://run/?m=recaptcha.iim
timeout 400
taskkill /f /t /im Firefox.exe /im crashreporter.exe >nul 2>&1
start firefox -no-remote imacros://run/?m=captcha.iim
timeout 400
taskkill /f /t /im Firefox.exe /im crashreporter.exe >nul 2>&1
start firefox -no-remote imacros://run/?m=doge.iim
timeout 600
taskkill /f /t /im Firefox.exe /im crashreporter.exe >nul 2>&1
%0