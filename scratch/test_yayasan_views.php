<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

$user = \App\Models\User::where('email', 'yayasan@gmail.com')->first();
echo "User yayasan found: ID={$user->id}, Name={$user->name}, Role={$user->role}\n";

$controller = $app->make(\App\Http\Controllers\Yayasan\LaporanYayasanController::class);

$methods = [
    'index' => [],
    'laporanPendaftar' => [new \Illuminate\Http\Request()],
    'laporanKeuangan' => [new \Illuminate\Http\Request()],
    'laporanSantri' => [new \Illuminate\Http\Request()],
    'laporanNilai' => [new \Illuminate\Http\Request()],
    'laporanAbsensi' => [new \Illuminate\Http\Request()],
    'laporanGuru' => [new \Illuminate\Http\Request()],
    'cetakPdf:pendaftar' => ['pendaftar', new \Illuminate\Http\Request()],
    'cetakPdf:keuangan' => ['keuangan', new \Illuminate\Http\Request()],
    'cetakPdf:santri' => ['santri', new \Illuminate\Http\Request()],
    'cetakPdf:nilai' => ['nilai', new \Illuminate\Http\Request()],
    'cetakPdf:absensi' => ['absensi', new \Illuminate\Http\Request()],
    'cetakPdf:guru' => ['guru', new \Illuminate\Http\Request()],
];

$allSuccess = true;

// Set current request and authenticated user
$req = \Illuminate\Http\Request::create('/yayasan/dashboard');
$app->instance('request', $req);
\Illuminate\Support\Facades\Auth::setUser($user);

foreach ($methods as $name => $args) {
    try {
        if (str_starts_with($name, 'cetakPdf:')) {
            $view = call_user_func_array([$controller, 'cetakPdf'], $args);
        } else {
            $view = call_user_func_array([$controller, $name], $args);
        }

        if ($view instanceof \Illuminate\View\View) {
            $html = $view->render();
            echo "[OK] Method $name -> View [{$view->name()}] rendered (" . strlen($html) . " bytes)\n";
        } else {
            echo "[OK] Method $name returned non-view response\n";
        }
    } catch (\Throwable $e) {
        echo "[ERROR] Method $name failed: " . $e->getMessage() . " in " . $e->getFile() . ":" . $e->getLine() . "\n";
        $allSuccess = false;
    }
}

if ($allSuccess) {
    echo "\n>>> ALL YAYASAN CONTROLLER METHODS AND VIEWS RENDERED 100% SUCCESSFULLY! <<<\n";
} else {
    echo "\n>>> SOME VIEWS OR QUERIES ENCOUNTERED ERRORS <<<\n";
}
