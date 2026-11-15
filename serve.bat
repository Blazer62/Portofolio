@echo off
setlocal
cd /d "%~dp0"

echo ==========================================
echo   Portofolio Gusti - Server Lokal
echo ==========================================
echo.

if not exist "vendor\autoload.php" (
    echo [!] Folder vendor belum ada, menjalankan composer install...
    call composer install
    echo.
)

if not exist "database\database.sqlite" (
    echo [!] Database SQLite belum ada, membuat baru...
    type nul > "database\database.sqlite"
    php artisan migrate --seed --force
    echo.
)

echo Alamat : http://127.0.0.1:8000
echo Stop   : tekan CTRL+C
echo.

php artisan serve --no-reload --host=127.0.0.1 --port=8000

echo.
echo Server berhenti.
pause
endlocal
