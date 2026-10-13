@echo off
setlocal

set "BASH=C:\Program Files\Git\bin\bash.exe"
if not exist "%BASH%" set "BASH=C:\Program Files\Git\usr\bin\bash.exe"
if not exist "%BASH%" set "BASH=C:\Program Files (x86)\Git\bin\bash.exe"
if not exist "%BASH%" set "BASH=%LOCALAPPDATA%\Programs\Git\bin\bash.exe"

if not exist "%BASH%" (
    echo.
    echo [ERROR] Git Bash tidak ditemukan.
    echo         Pasang Git for Windows dari https://git-scm.com/download/win
    echo         lalu jalankan ulang script ini.
    echo.
    exit /b 1
)

cd /d "%~dp0"
"%BASH%" ./smoke-test.sh
set "RC=%ERRORLEVEL%"

echo.
if "%RC%"=="0" (
    echo [HASIL] Semua tes LULUS. Project berjalan normal.
) else (
    echo [HASIL] Ada tes yang GAGAL. Lihat daftar FAIL di atas.
)

endlocal & exit /b %RC%
