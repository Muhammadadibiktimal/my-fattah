<?php

namespace App\Http\Controllers\Yayasan;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\Santri;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanYayasanController extends Controller
{
    /**
     * Dashboard Eksekutif Ketua Yayasan (KPI & Ringkasan Seluruh Lembaga)
     */
    public function index()
    {
        $totalSantri = Santri::where('status', 'Aktif')->count();
        $totalAlumni = Santri::where('status', 'Alumni')->count();
        $totalPendaftar = Pendaftar::count();
        $totalPendaftarLunas = Pendaftar::where('status_bayar', 'settlement')->count();
        $totalPendaftarTerverifikasi = Pendaftar::where('status', 'Terverifikasi')->count();
        
        // Pemasukan Midtrans (Infaq PSB @ Rp 200.000)
        $totalPemasukan = $totalPendaftarLunas * 200000;
        
        $totalGuru = User::where('role', 'guru')->count();
        $totalKelas = Kelas::count();

        // Rata-rata Nilai Akademik
        $rataRataNilai = round(Nilai::avg('nilai_akhir') ?: 85.0, 1);

        // Persentase Kehadiran Santri
        $totalAbsensi = Absensi::count();
        $totalHadir = Absensi::where('status', 'Hadir')->count();
        $persentaseKehadiran = $totalAbsensi > 0 ? round(($totalHadir / $totalAbsensi) * 100, 1) : 98.5;

        // Distribusi Santri per Jenjang
        $santriSMP = Santri::where('jenjang', 'like', '%SMP%')->count();
        $santriSMA = Santri::where('jenjang', 'like', '%SMA%')->count();
        $santriSMK = Santri::where('jenjang', 'like', '%SMK%')->count();

        // Riwayat pendaftar & transaksi terbaru
        $pendaftarTerbaru = Pendaftar::latest()->take(6)->get();
        $santriTerbaru = Santri::with('kelas')->latest()->take(6)->get();

        return view('yayasan.dashboard', compact(
            'totalSantri', 'totalAlumni', 'totalPendaftar', 'totalPendaftarLunas', 'totalPendaftarTerverifikasi',
            'totalPemasukan', 'totalGuru', 'totalKelas', 'rataRataNilai', 'persentaseKehadiran',
            'santriSMP', 'santriSMA', 'santriSMK', 'pendaftarTerbaru', 'santriTerbaru'
        ));
    }

    /**
     * 1. Laporan PPDB & Calon Santri Baru
     */
    public function laporanPendaftar(Request $request)
    {
        $jenjang = $request->query('jenjang');
        $statusBayar = $request->query('status_bayar');
        $status = $request->query('status');
        $search = $request->query('search');

        $query = Pendaftar::latest();

        if ($jenjang) {
            $query->where('jenjang', 'like', "%{$jenjang}%");
        }
        if ($statusBayar) {
            $query->where('status_bayar', $statusBayar);
        }
        if ($status) {
            $query->where('status', $status);
        }
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%")
                  ->orWhere('order_id', 'like', "%{$search}%");
            });
        }

        $pendaftars = $query->paginate(20);
        $totalSemua = Pendaftar::count();
        $totalLunas = Pendaftar::where('status_bayar', 'settlement')->count();
        $totalVerif = Pendaftar::where('status', 'Terverifikasi')->count();

        return view('yayasan.laporan.pendaftar', compact(
            'pendaftars', 'jenjang', 'statusBayar', 'status', 'search', 'totalSemua', 'totalLunas', 'totalVerif'
        ));
    }

    /**
     * 2. Laporan Keuangan & Transaksi Midtrans
     */
    public function laporanKeuangan(Request $request)
    {
        $statusBayar = $request->query('status_bayar');
        $search = $request->query('search');

        $query = Pendaftar::latest();

        if ($statusBayar) {
            $query->where('status_bayar', $statusBayar);
        }
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('order_id', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $transaksiList = $query->paginate(20);
        $totalLunas = Pendaftar::where('status_bayar', 'settlement')->count();
        $totalDanaMasuk = $totalLunas * 200000;
        $totalPending = Pendaftar::where('status_bayar', 'pending')->count();
        $totalPotensiPending = $totalPending * 200000;

        return view('yayasan.laporan.keuangan', compact(
            'transaksiList', 'statusBayar', 'search', 'totalLunas', 'totalDanaMasuk', 'totalPending', 'totalPotensiPending'
        ));
    }

    /**
     * 3. Laporan Data Santri Aktif & Kenaikan Kelas
     */
    public function laporanSantri(Request $request)
    {
        $kelasId = $request->query('kelas_id');
        $statusKenaikan = $request->query('status_kenaikan');
        $jenjang = $request->query('jenjang');
        $search = $request->query('search');

        $query = Santri::with(['kelas', 'user'])->latest();

        if ($kelasId) {
            $query->where('kelas_id', $kelasId);
        }
        if ($statusKenaikan) {
            $query->where('status_kenaikan', $statusKenaikan);
        }
        if ($jenjang) {
            $query->where('jenjang', 'like', "%{$jenjang}%");
        }
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%");
            });
        }

        $santris = $query->paginate(20);
        $kelasList = Kelas::all();
        $totalSantri = Santri::where('status', 'Aktif')->count();
        $totalNaik = Santri::where('status_kenaikan', 'Naik Kelas')->count();
        $totalTinggal = Santri::where('status_kenaikan', 'Tinggal Kelas')->count();
        $totalLulus = Santri::where('status_kenaikan', 'Lulus')->orWhere('status', 'Alumni')->count();

        return view('yayasan.laporan.santri', compact(
            'santris', 'kelasList', 'kelasId', 'statusKenaikan', 'jenjang', 'search',
            'totalSantri', 'totalNaik', 'totalTinggal', 'totalLulus'
        ));
    }

    /**
     * 4. Laporan Akademik & Rekap Nilai Rapor
     */
    public function laporanNilai(Request $request)
    {
        $kelasId = $request->query('kelas_id');
        $mapelId = $request->query('mapel_id');

        $query = Nilai::with(['santri.kelas', 'mapel'])->latest();

        if ($kelasId) {
            $query->where('kelas_id', $kelasId);
        }
        if ($mapelId) {
            $query->where('mapel_id', $mapelId);
        }

        $nilaiList = $query->paginate(25);
        $kelasList = Kelas::all();
        $mapelList = Mapel::all();

        $rataRata = round(Nilai::when($kelasId, fn($q) => $q->where('kelas_id', $kelasId))
            ->when($mapelId, fn($q) => $q->where('mapel_id', $mapelId))
            ->avg('nilai_akhir') ?: 85.0, 1);

        $totalTuntas = Nilai::when($kelasId, fn($q) => $q->where('kelas_id', $kelasId))
            ->when($mapelId, fn($q) => $q->where('mapel_id', $mapelId))
            ->where('nilai_akhir', '>=', 75)->count();

        $totalRekap = Nilai::when($kelasId, fn($q) => $q->where('kelas_id', $kelasId))
            ->when($mapelId, fn($q) => $q->where('mapel_id', $mapelId))->count();

        $persenTuntas = $totalRekap > 0 ? round(($totalTuntas / $totalRekap) * 100, 1) : 100;

        return view('yayasan.laporan.nilai', compact(
            'nilaiList', 'kelasList', 'mapelList', 'kelasId', 'mapelId', 'rataRata', 'totalTuntas', 'totalRekap', 'persenTuntas'
        ));
    }

    /**
     * 5. Laporan Presensi & Kehadiran Santri
     */
    public function laporanAbsensi(Request $request)
    {
        $kelasId = $request->query('kelas_id');
        $status = $request->query('status');

        $query = Absensi::with(['santri', 'kelas'])->latest('tanggal');

        if ($kelasId) {
            $query->where('kelas_id', $kelasId);
        }
        if ($status) {
            $query->where('status', $status);
        }

        $absensiList = $query->paginate(25);
        $kelasList = Kelas::all();

        $totalRecord = Absensi::count();
        $hadir = Absensi::where('status', 'Hadir')->count();
        $sakit = Absensi::where('status', 'Sakit')->count();
        $izin = Absensi::where('status', 'Izin')->count();
        $alpa = Absensi::where('status', 'Alpa')->count();
        $persenHadir = $totalRecord > 0 ? round(($hadir / $totalRecord) * 100, 1) : 98;

        return view('yayasan.laporan.absensi', compact(
            'absensiList', 'kelasList', 'kelasId', 'status', 'totalRecord', 'hadir', 'sakit', 'izin', 'alpa', 'persenHadir'
        ));
    }

    /**
     * 6. Laporan Dewan Guru & Rombongan Belajar
     */
    public function laporanGuru()
    {
        $gurus = User::where('role', 'guru')->latest()->get();
        $kelasList = Kelas::withCount('santris')->get();
        $mapelList = Mapel::all();

        return view('yayasan.laporan.guru', compact('gurus', 'kelasList', 'mapelList'));
    }

    /**
     * 7. Cetak PDF Resmi Laporan Yayasan
     */
    public function cetakPdf($kategori, Request $request = null)
    {
        $tanggal = now()->translatedFormat('d F Y');

        switch ($kategori) {
            case 'pendaftar':
                $data = Pendaftar::latest()->get();
                $title = "Laporan Penerimaan Santri Baru (PSB)";
                break;
            case 'keuangan':
                $data = Pendaftar::where('status_bayar', 'settlement')->latest()->get();
                $title = "Laporan Rekapitulasi Keuangan Pembayaran Midtrans";
                break;
            case 'santri':
                $data = Santri::with('kelas')->latest()->get();
                $title = "Laporan Data Induk Santri Aktif & Kenaikan Kelas";
                break;
            case 'nilai':
                $data = Nilai::with(['santri.kelas', 'mapel'])->latest()->take(50)->get();
                $title = "Laporan Rekapitulasi Nilai Akademik Santri";
                break;
            case 'absensi':
                $data = Absensi::with(['santri', 'kelas'])->latest('tanggal')->take(50)->get();
                $title = "Laporan Rekapitulasi Presensi & Kehadiran Santri";
                break;
            case 'guru':
                $data = User::where('role', 'guru')->latest()->get();
                $title = "Laporan Data Dewan Guru & Tenaga Pendidik";
                break;
            default:
                return redirect()->route('yayasan.dashboard')->with('error', 'Kategori laporan tidak valid.');
        }

        $pdf = Pdf::loadView('yayasan.laporan.cetak_pdf', compact('data', 'kategori', 'title', 'tanggal'))
            ->setPaper('a4', 'landscape');

        return $pdf->download("Laporan_Yayasan_{$kategori}_{$tanggal}.pdf");
    }
}
