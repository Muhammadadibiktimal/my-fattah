$phpDir = "C:\Users\user\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.2_Microsoft.Winget.Source_8wekyb3d8bbwe"

$ini = Get-Content "$phpDir\php.ini"
$ini = $ini -replace ';extension=gd', 'extension=gd'
$ini = $ini -replace ';extension=zip', 'extension=zip'
$ini | Set-Content "$phpDir\php.ini"

& "$phpDir\php.exe" composer.phar install --ignore-platform-reqs
& "$phpDir\php.exe" artisan key:generate
