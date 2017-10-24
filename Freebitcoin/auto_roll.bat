@echo off
taskkill /f /t /im Firefox.exe /im crashreporter.exe >nul 2>&1
timeout 20
start firefox -no-remote -P "toanhv18" imacros://run/?m=recaptcha.iim
timeout 600
taskkill /f /t /im Firefox.exe /im crashreporter.exe >nul 2>&1
start firefox -no-remote -P "toanhv18" imacros://run/?m=captcha.iim
timeout 600
taskkill /f /t /im Firefox.exe /im crashreporter.exe >nul 2>&1
start firefox -no-remote -P "doge.toanhv10" imacros://run/?m=doge.iim
timeout 600
taskkill /f /t /im Firefox.exe /im crashreporter.exe >nul 2>&1
%0