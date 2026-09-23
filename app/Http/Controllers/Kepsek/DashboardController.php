<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use App\Models\DataPendaftar;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Pendaftaran untuk Laporan Kepsek
        $totalPendaftar = DataPendaftar::count();
        $pendaftarLulus = DataPendaftar::where('status', 'lulus')->count();
        $pendaftarProses = DataPendaftar::where('status', 'proses')->count();
        $pendaftarGagal = DataPendaftar::where('status', 'gagal')->count();
        
        $pendaftarTerbaru = DataPendaftar::latest()->take(5)->get();

        return view('kepsek.dashboard', compact(
            'totalPendaftar',
            'pendaftarLulus',
            'pendaftarProses',
            'pendaftarGagal',
            'pendaftarTerbaru'
        ));
    }
}
