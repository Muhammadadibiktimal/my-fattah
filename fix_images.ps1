$phpExe = "C:\Users\user\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.2_Microsoft.Winget.Source_8wekyb3d8bbwe\php.exe"

# Create heroes directory in storage
$heroesDir = "storage\app\public\heroes"
if (-not (Test-Path $heroesDir)) {
    New-Item -ItemType Directory -Path $heroesDir -Force
}

# Download hero images
Write-Host "Downloading hero image 1..."
Invoke-WebRequest -Uri "https://picsum.photos/1920/1080?random=1" -OutFile "$heroesDir\hero1.jpg"
Write-Host "Downloading hero image 2..."
Invoke-WebRequest -Uri "https://picsum.photos/1920/1080?random=2" -OutFile "$heroesDir\hero2.jpg"

# Create posts directory
$postsDir = "storage\app\public\posts"
if (-not (Test-Path $postsDir)) {
    New-Item -ItemType Directory -Path $postsDir -Force
}

# Download post images
Write-Host "Downloading post images..."
Invoke-WebRequest -Uri "https://picsum.photos/800/500?random=3" -OutFile "$postsDir\post1.jpg"
Invoke-WebRequest -Uri "https://picsum.photos/800/500?random=4" -OutFile "$postsDir\post2.jpg"
Invoke-WebRequest -Uri "https://picsum.photos/800/500?random=5" -OutFile "$postsDir\post3.jpg"

# Create alumni directory
$alumniDir = "storage\app\public\alumni"
if (-not (Test-Path $alumniDir)) {
    New-Item -ItemType Directory -Path $alumniDir -Force
}

# Download alumni photos
Write-Host "Downloading alumni photos..."
Invoke-WebRequest -Uri "https://picsum.photos/400/400?random=6" -OutFile "$alumniDir\alumni1.jpg"
Invoke-WebRequest -Uri "https://picsum.photos/400/400?random=7" -OutFile "$alumniDir\alumni2.jpg"
Invoke-WebRequest -Uri "https://picsum.photos/400/400?random=8" -OutFile "$alumniDir\alumni3.jpg"

Write-Host "All images downloaded! Updating database..."

# Update database records using PHP/Artisan tinker
$tinkerScript = @"
use App\Models\Hero;
use App\Models\Post;
use App\Models\Alumni;

`$heroes = Hero::all();
if (`$heroes->count() >= 1) { `$heroes[0]->update(['image' => 'heroes/hero1.jpg']); }
if (`$heroes->count() >= 2) { `$heroes[1]->update(['image' => 'heroes/hero2.jpg']); }

`$posts = Post::all();
if (`$posts->count() >= 1) { `$posts[0]->update(['image' => 'posts/post1.jpg']); }
if (`$posts->count() >= 2) { `$posts[1]->update(['image' => 'posts/post2.jpg']); }
if (`$posts->count() >= 3) { `$posts[2]->update(['image' => 'posts/post3.jpg']); }

`$alumnis = Alumni::all();
if (`$alumnis->count() >= 1) { `$alumnis[0]->update(['photo' => 'alumni/alumni1.jpg']); }
if (`$alumnis->count() >= 2) { `$alumnis[1]->update(['photo' => 'alumni/alumni2.jpg']); }
if (`$alumnis->count() >= 3) { `$alumnis[2]->update(['photo' => 'alumni/alumni3.jpg']); }

echo 'Database updated!';
"@

$tinkerScript | & $phpExe artisan tinker

Write-Host "Done!"
