@echo off
setlocal

if "%~1"=="" (
    echo.
    echo  Pemakaian:  buat-database.bat NAMA_DATABASE
    echo  Contoh:     buat-database.bat db_profil_sekolah_baru
    echo.
    exit /b 1
)

php -r "$d=new PDO('mysql:host=127.0.0.1;port=3306','root',''); $d->exec('CREATE DATABASE IF NOT EXISTS `%~1` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci'); echo 'Database %~1 siap dipakai.'.PHP_EOL;"
if errorlevel 1 (
    echo.
    echo [ERROR] Gagal membuat database. Pastikan MySQL/MariaDB Laragon sudah jalan.
    echo         Buka Laragon lalu klik Start All, lalu ulangi perintah ini.
    echo.
    exit /b 1
)

echo.
echo Langkah berikutnya: isi DB_DATABASE=%~1 di file .env
echo lalu jalankan:  php artisan migrate:fresh --seed
echo.

endlocal
