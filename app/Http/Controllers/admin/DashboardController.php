<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataPendaftar;
use App\Models\Post;
use App\Models\Hero;
use App\Models\Video;
use App\Models\Alumni;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total pendaftar gabungan (Pendaftar online utama)
        $totalPendaftar = \App\Models\Pendaftar::count();
        if ($totalPendaftar === 0) {
            $totalPendaftar = DataPendaftar::count();
        }

        $totalBerita = Post::count();
        $totalHero = Hero::count();
        $totalVideo = Video::count();
        $totalAlumni = Alumni::count();
        $totalUser = User::count();

        // Ambil pendaftar terbaru yang tersinkron penuh
        $pendaftarTerbaru = \App\Models\Pendaftar::latest()->take(5)->get();
        if ($pendaftarTerbaru->isEmpty()) {
            $pendaftarTerbaru = DataPendaftar::latest()->take(5)->get();
        }

        return view('admin.dashboard', compact(
            'totalPendaftar',
            'totalBerita',
            'totalHero',
            'totalVideo',
            'totalAlumni',
            'totalUser',
            'pendaftarTerbaru'
        ));
    }
}
