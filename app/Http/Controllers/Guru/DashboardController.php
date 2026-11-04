<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Santri;
use App\Models\Nilai;
use App\Models\Absensi;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $guru = Auth::user();

        $totalKelas = Kelas::where('nama_kelas', 'like', 'Kelas%')->count() ?: Kelas::count();
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

        // Jadwal mengajar guru yang sedang login
        $jadwalGuru = Jadwal::with(['kelas', 'mapel'])
            ->where('guru_id', $guru->id)
            ->orderBy('jam_ke')
            ->get()
            ->groupBy('hari');

        // Kelas di mana guru ini menjadi Wali Kelas
        $kelasWali = Kelas::where('wali_kelas', 'like', '%' . $guru->name . '%')->get();

        // Daftar rombel resmi (Kelas I s/d VI)
        $kelasList = Kelas::whereIn('nama_kelas', ['Kelas I', 'Kelas II', 'Kelas III', 'Kelas IV', 'Kelas V', 'Kelas VI'])
            ->withCount('santri')
            ->orderBy('id')
            ->get();
        if ($kelasList->isEmpty()) {
            $kelasList = Kelas::withCount('santri')->get();
        }

        return view('guru.dashboard', compact(
            'guru', 'totalKelas', 'totalMapel', 'totalSantri', 'totalNilaiDiinput', 'absensiHariIni', 'nilaiTerbaru',
            'jadwalGuru', 'kelasWali', 'kelasList'
        ));
    }
}
