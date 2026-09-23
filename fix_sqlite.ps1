$iniPath = "C:\Users\user\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.2_Microsoft.Winget.Source_8wekyb3d8bbwe\php.ini"
$content = Get-Content $iniPath -Raw
$content = $content -replace ';extension=pdo_sqlite', 'extension=pdo_sqlite'
$content = $content -replace ';extension=sqlite3', 'extension=sqlite3'
Set-Content $iniPath $content

$phpExe = "C:\Users\user\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.2_Microsoft.Winget.Source_8wekyb3d8bbwe\php.exe"
& $phpExe artisan migrate --force
