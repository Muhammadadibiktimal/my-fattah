<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Santri;
use App\Models\Nilai;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $guru = Auth::user();

        $totalKelas = Kelas::count();
        $totalMapel = Mapel::count();
        $totalSantri = Santri::where('status', 'Aktif')->count();
        $totalNilaiDiinput = Nilai::where('guru_id', $guru->id)->count();

        $today = date('Y-m-d');
        $absensiHariIni = Absensi::where('tanggal', $today)->count();

        // 5 Nilai terbaru yang diinput guru
        $nilaiTerbaru = Nilai::with(['santri', 'mapel', 'kelas'])
            ->where('guru_id', $guru->id)
            ->latest()
            ->take(5)
            ->get();

        return view('guru.dashboard', compact(
            'guru', 'totalKelas', 'totalMapel', 'totalSantri', 'totalNilaiDiinput', 'absensiHariIni', 'nilaiTerbaru'
        ));
    }
}
