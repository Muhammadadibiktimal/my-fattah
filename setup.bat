@echo off
set PHP_PATH=C:\Users\user\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.2_Microsoft.Winget.Source_8wekyb3d8bbwe\php.exe

%PHP_PATH% -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
%PHP_PATH% composer-setup.php
%PHP_PATH% -r "unlink('composer-setup.php');"
%PHP_PATH% composer.phar install
%PHP_PATH% artisan key:generate

set NPM_PATH="C:\Program Files\nodejs\npm.cmd"
if exist %NPM_PATH% (
    %NPM_PATH% install
) else (
    echo "npm not found at C:\Program Files\nodejs\npm.cmd"
)
