<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$users = \App\Models\User::all();

echo "DAFTAR SELURUH PENGGUNA DI DATABASE:\n";
echo str_repeat("=", 70) . "\n";

$testPasswords = ['password', 'password123', 'admin', 'admin123', 'yayasan123', 'saepudin', 'saepudin123', '12345678', 'santri123', 'santri'];

foreach ($users as $u) {
    $matched = [];
    foreach ($testPasswords as $p) {
        if (\Illuminate\Support\Facades\Hash::check($p, $u->password)) {
            $matched[] = $p;
        }
    }
    $pwStatus = count($matched) > 0 ? implode(', ', $matched) : "Unknown/Lainnya";
    echo "ID: {$u->id} | Role: {$u->role} | Email: {$u->email} | Nama: {$u->name} | Password Cocok: [{$pwStatus}]\n";
}
echo str_repeat("=", 70) . "\n";
