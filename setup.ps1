$phpDir = "C:\Users\user\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.2_Microsoft.Winget.Source_8wekyb3d8bbwe"
Copy-Item "$phpDir\php.ini-development" "$phpDir\php.ini" -Force

$ini = Get-Content "$phpDir\php.ini"
$ini = $ini -replace ';extension=openssl', 'extension=openssl'
$ini = $ini -replace ';extension_dir = "ext"', 'extension_dir = "ext"'
$ini = $ini -replace ';extension=pdo_mysql', 'extension=pdo_mysql'
$ini = $ini -replace ';extension=curl', 'extension=curl'
$ini = $ini -replace ';extension=fileinfo', 'extension=fileinfo'
$ini = $ini -replace ';extension=mbstring', 'extension=mbstring'
$ini | Set-Content "$phpDir\php.ini"

# Set path for this session
$env:PATH += ";C:\Program Files\nodejs"

# Download Composer
Invoke-WebRequest -Uri "https://getcomposer.org/download/latest-stable/composer.phar" -OutFile "composer.phar"

# Install PHP dependencies
& "$phpDir\php.exe" composer.phar install

# Generate application key
& "$phpDir\php.exe" artisan key:generate

# Install Node dependencies
npm install
