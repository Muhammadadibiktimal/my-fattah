<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

$req = \Illuminate\Http\Request::create('/');
$app->instance('request', $req);

$yayasan = \App\Models\User::where('email', 'yayasan@gmail.com')->first();
$guru = \App\Models\User::where('role', 'guru')->first();

echo "Testing Yayasan Auth:\n";

// 1. Check password verification
$passCheck = \Illuminate\Support\Facades\Hash::check('yayasan123', $yayasan->password);
echo "Password 'yayasan123' check: " . ($passCheck ? "PASSED" : "FAILED") . "\n";

// 2. Check login redirect determination
$dummyUserYayasan = clone $yayasan;
$redirectTarget = match($dummyUserYayasan->role) {
    'admin' => route('dashboard'),
    'yayasan' => route('yayasan.dashboard'),
    'kepsek' => route('kepsek.dashboard'),
    'guru' => route('guru.jadwal'),
    default => route('santri.dashboard'),
};
echo "Yayasan redirect target: $redirectTarget\n";

// 3. Check RoleMiddleware with Yayasan user
$middleware = new \App\Http\Middleware\RoleMiddleware();
$req = \Illuminate\Http\Request::create('/yayasan/dashboard');
\Illuminate\Support\Facades\Auth::setUser($yayasan);

$passed = false;
$response = $middleware->handle($req, function($r) use (&$passed) {
    $passed = true;
    return new \Illuminate\Http\Response('OK');
}, 'yayasan');

echo "RoleMiddleware Yayasan Access: " . ($passed ? "PASSED (allowed)" : "FAILED") . "\n";

// 4. Check RoleMiddleware blocking unauthorized user (guru)
if ($guru) {
    \Illuminate\Support\Facades\Auth::setUser($guru);
    $blocked = false;
    try {
        $res = $middleware->handle($req, function($r) {
            return new \Illuminate\Http\Response('OK');
        }, 'yayasan');
        if ($res->getStatusCode() !== 200) {
            $blocked = true;
        }
    } catch (\Symfony\Component\HttpKernel\Exception\HttpException $e) {
        if ($e->getStatusCode() === 403) {
            $blocked = true;
        }
    }
    echo "RoleMiddleware Blocks Guru from Yayasan Route: " . ($blocked ? "PASSED (blocked)" : "FAILED") . "\n";
}

echo "Auth & Middleware verification completed successfully!\n";
