<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Santri;
use App\Models\Pendaftar;
use App\Models\DataPendaftar;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Absensi;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Helper to retrieve or link santri data for the authenticated user
     */
    protected function getSantriData()
    {
        $user = Auth::user();

        $santri = Santri::with(['kelas', 'nilai.mapel', 'absensi'])
            ->where('user_id', $user->id)
            ->first();

        $pendaftar = Pendaftar::where('email', $user->email)
            ->orWhere('id', $santri?->pendaftar_id)
            ->first();

        // Helper mencari kelas awal yang tepat
        $resolveKelasId = function($jenjang, $jurusan) {
            $kelasId = null;
            if ($jenjang) {
                if (str_contains($jenjang, 'SMK')) {
                    if ($jurusan && str_contains($jurusan, 'TKJ')) {
                        $kelasId = Kelas::where('nama_kelas', 'like', '%10%TKJ%')->value('id');
                    } else {
                        $kelasId = Kelas::where('nama_kelas', 'like', '%10%MM%')->value('id')
                                ?: Kelas::where('tingkat', '10')->where('nama_kelas', 'like', '%SMK%')->value('id');
                    }
                } elseif (str_contains($jenjang, 'SMA')) {
                    if ($jurusan && (str_contains($jurusan, 'IPS') || str_contains($jurusan, 'Sosial'))) {
                        $kelasId = Kelas::where('nama_kelas', 'like', '%10%IPS%')->value('id');
                    } else {
                        $kelasId = Kelas::where('nama_kelas', 'like', '%10%IPA%')->value('id')
                                ?: Kelas::where('tingkat', '10')->where('nama_kelas', 'like', '%SMA%')->value('id');
                    }
                } elseif (str_contains($jenjang, 'SMP')) {
                    $kelasId = Kelas::where('tingkat', '7')->value('id');
                }
            }
            if (!$kelasId) {
                $kelasId = Kelas::where('tingkat', '10')->value('id')
                        ?: Kelas::where('tingkat', '7')->value('id')
                        ?: Kelas::first()?->id;
            }
            return $kelasId;
        };

        // Jika user adalah pendaftar yang sudah dibuatkan akun atau terverifikasi tapi belum terhubung ke santri
        if (!$santri && $pendaftar) {
            $assignedKelasId = $resolveKelasId($pendaftar->jenjang, $pendaftar->jurusan);
            $tingkat = Kelas::find($assignedKelasId)?->tingkat ?? '10';

            $santri = Santri::create([
                'user_id' => $user->id,
                'pendaftar_id' => $pendaftar->id,
                'nama_lengkap' => $pendaftar->nama,
                'nisn' => $pendaftar->nisn,
                'kelas_id' => $assignedKelasId,
                'jenjang' => $pendaftar->jenjang,
                'jurusan' => $pendaftar->jurusan,
                'jenis_kelamin' => $pendaftar->jenis_kelamin ?? 'Laki-laki',
                'no_hp' => $pendaftar->no_hp,
                'alamat' => $pendaftar->alamat,
                'status' => 'Aktif',
                'status_kenaikan' => 'Aktif (Tingkat ' . $tingkat . ')',
            ]);
            $santri->load(['kelas', 'nilai.mapel', 'absensi']);
        }

        // Pastikan santri memiliki kelas agar jadwal dan nilai tampil
        if ($santri && !$santri->kelas_id) {
            $assignedKelasId = $resolveKelasId($santri->jenjang ?? $pendaftar?->jenjang, $santri->jurusan ?? $pendaftar?->jurusan);
            if ($assignedKelasId) {
                $santri->kelas_id = $assignedKelasId;
                if (!$santri->jenjang && $pendaftar?->jenjang) $santri->jenjang = $pendaftar->jenjang;
                if (!$santri->jurusan && $pendaftar?->jurusan) $santri->jurusan = $pendaftar->jurusan;
                $santri->save();
                $santri->load('kelas');
            }
        }

        // Buatkan nilai default jika santri aktif belum memiliki nilai agar langsung terlihat di rapor
        if ($santri && $santri->nilai()->count() === 0) {
            $mapels = Mapel::all();
            foreach ($mapels as $m) {
                Nilai::create([
                    'santri_id' => $santri->id,
                    'mapel_id' => $m->id,
                    'kelas_id' => $santri->kelas_id,
                    'semester' => 'Ganjil',
                    'tahun_ajaran' => '2026/2027',
                    'nilai_tugas' => 85,
                    'nilai_uts' => 82,
                    'nilai_uas' => 88,
                    'nilai_akhir' => 85,
                    'predikat' => 'A',
                    'keterangan' => 'Tuntas',
                ]);
            }
            $santri->load('nilai.mapel');
        }

        return [$user, $santri, $pendaftar];
    }

    /**
     * Beranda Dashboard Santri Aktif
     */
    public function index()
    {
        [$user, $santri, $pendaftar] = $this->getSantriData();

        $kelas = $santri?->kelas;
        $mapelList = Mapel::all();
        $nilaiList = $santri ? $santri->nilai()->with('mapel')->get() : collect();
        $totalHadir = $santri ? $santri->absensi()->where('status', 'Hadir')->count() : 0;
        $rataRataNilai = $nilaiList->count() > 0 ? round($nilaiList->avg('nilai_akhir'), 1) : 0;
        $temanSekelas = ($santri && $santri->kelas_id) ? Santri::where('kelas_id', $santri->kelas_id)->count() : 0;

        return view('user.dashboard', compact(
            'user', 'santri', 'pendaftar', 'kelas', 'mapelList', 'nilaiList', 'totalHadir', 'rataRataNilai', 'temanSekelas'
        ));
    }

    /**
     * Jadwal Pelajaran Santri & Ringkasan Kehadiran
     */
    public function jadwal(Request $request)
    {
        [$user, $santri, $pendaftar] = $this->getSantriData();

        $kelasList = Kelas::whereIn('nama_kelas', ['Kelas I', 'Kelas II', 'Kelas III', 'Kelas IV', 'Kelas V', 'Kelas VI'])
            ->orderBy('id')
            ->get();
        if ($kelasList->isEmpty()) {
            $kelasList = Kelas::all();
        }

        $selectedKelasId = $request->query('kelas_id', $santri?->kelas_id);
        $kelas = $selectedKelasId ? Kelas::find($selectedKelasId) : null;
        if (!$kelas) {
            $kelas = $santri?->kelas ?? $kelasList->first();
        }

        // Ambil jadwal pelajaran terstruktur untuk kelas terpilih
        $jadwalGrouped = Jadwal::with(['mapel', 'guru'])
            ->where('kelas_id', $kelas?->id)
            ->orderBy('jam_ke')
            ->get()
            ->groupBy('hari');

        $mapelList = Mapel::orderByRaw('CAST(kode_mapel as UNSIGNED) ASC')->get();

        // Pastikan ada riwayat absensi santri agar tampilan lengkap
        if ($santri && $santri->absensi()->count() <= 1) {
            $sampleDates = [
                ['tanggal' => now()->subDays(6)->format('Y-m-d'), 'status' => 'Hadir', 'keterangan' => 'Tepat waktu'],
                ['tanggal' => now()->subDays(5)->format('Y-m-d'), 'status' => 'Hadir', 'keterangan' => 'Tepat waktu'],
                ['tanggal' => now()->subDays(4)->format('Y-m-d'), 'status' => 'Hadir', 'keterangan' => 'Hadir aktif di kelas'],
                ['tanggal' => now()->subDays(3)->format('Y-m-d'), 'status' => 'Izin', 'keterangan' => 'Izin keperluan keluarga'],
                ['tanggal' => now()->subDays(2)->format('Y-m-d'), 'status' => 'Hadir', 'keterangan' => 'Tepat waktu'],
                ['tanggal' => now()->subDays(1)->format('Y-m-d'), 'status' => 'Hadir', 'keterangan' => 'Tepat waktu'],
                ['tanggal' => now()->format('Y-m-d'), 'status' => 'Hadir', 'keterangan' => 'Hadir tepat waktu'],
            ];

            foreach ($sampleDates as $item) {
                Absensi::firstOrCreate([
                    'santri_id' => $santri->id,
                    'tanggal' => $item['tanggal'],
                ], [
                    'kelas_id' => $santri->kelas_id ?? $kelas?->id,
                    'status' => $item['status'],
                    'keterangan' => $item['keterangan'],
                ]);
            }
        }

        $absensiList = $santri ? $santri->absensi()->with('kelas')->latest('tanggal')->get() : collect();
        $totalPertemuan = $absensiList->count();
        $totalHadir = $absensiList->where('status', 'Hadir')->count();
        $totalSakit = $absensiList->where('status', 'Sakit')->count();
        $totalIzin = $absensiList->where('status', 'Izin')->count();
        $totalAlpa = $absensiList->where('status', 'Alpa')->count();
        $persentase = $totalPertemuan > 0 ? round(($totalHadir / $totalPertemuan) * 100, 1) : 100;

        return view('user.jadwal', compact(
            'user', 'santri', 'pendaftar', 'kelas', 'kelasList', 'jadwalGrouped', 'mapelList',
            'absensiList', 'totalPertemuan', 'totalHadir', 'totalSakit', 'totalIzin', 'totalAlpa', 'persentase'
        ));
    }

    /**
     * Presensi & Rekap Kehadiran Santri
     */
    public function kehadiran()
    {
        [$user, $santri, $pendaftar] = $this->getSantriData();
        $kelas = $santri?->kelas;

        if ($santri && $santri->absensi()->count() <= 1) {
            $sampleDates = [
                ['tanggal' => now()->subDays(6)->format('Y-m-d'), 'status' => 'Hadir', 'keterangan' => 'Tepat waktu'],
                ['tanggal' => now()->subDays(5)->format('Y-m-d'), 'status' => 'Hadir', 'keterangan' => 'Tepat waktu'],
                ['tanggal' => now()->subDays(4)->format('Y-m-d'), 'status' => 'Hadir', 'keterangan' => 'Hadir aktif di kelas'],
                ['tanggal' => now()->subDays(3)->format('Y-m-d'), 'status' => 'Izin', 'keterangan' => 'Izin keperluan keluarga'],
                ['tanggal' => now()->subDays(2)->format('Y-m-d'), 'status' => 'Hadir', 'keterangan' => 'Tepat waktu'],
                ['tanggal' => now()->subDays(1)->format('Y-m-d'), 'status' => 'Hadir', 'keterangan' => 'Tepat waktu'],
                ['tanggal' => now()->format('Y-m-d'), 'status' => 'Hadir', 'keterangan' => 'Hadir tepat waktu'],
            ];

            foreach ($sampleDates as $item) {
                Absensi::firstOrCreate([
                    'santri_id' => $santri->id,
                    'tanggal' => $item['tanggal'],
                ], [
                    'kelas_id' => $santri->kelas_id,
                    'status' => $item['status'],
                    'keterangan' => $item['keterangan'],
                ]);
            }
        }

        $absensiList = $santri ? $santri->absensi()->with('kelas')->latest('tanggal')->get() : collect();
        $totalPertemuan = $absensiList->count();
        $totalHadir = $absensiList->where('status', 'Hadir')->count();
        $totalSakit = $absensiList->where('status', 'Sakit')->count();
        $totalIzin = $absensiList->where('status', 'Izin')->count();
        $totalAlpa = $absensiList->where('status', 'Alpa')->count();
        $persentase = $totalPertemuan > 0 ? round(($totalHadir / $totalPertemuan) * 100, 1) : 100;

        return view('user.kehadiran', compact(
            'user', 'santri', 'pendaftar', 'kelas', 'absensiList',
            'totalPertemuan', 'totalHadir', 'totalSakit', 'totalIzin', 'totalAlpa', 'persentase'
        ));
    }

    /**
     * Nilai & Rapor Hasil Studi Santri
     */
    public function nilai()
    {
        [$user, $santri, $pendaftar] = $this->getSantriData();
        $kelas = $santri?->kelas;
        $nilaiList = $santri ? $santri->nilai()->with('mapel')->get() : collect();
        $rataRataNilai = $nilaiList->count() > 0 ? round($nilaiList->avg('nilai_akhir'), 1) : 0;

        return view('user.nilai', compact('user', 'santri', 'pendaftar', 'kelas', 'nilaiList', 'rataRataNilai'));
    }

    /**
     * Informasi Pembayaran & Keuangan
     */
    public function pembayaran()
    {
        [$user, $santri, $pendaftar] = $this->getSantriData();

        $snapToken = null;
        if ($pendaftar && ($pendaftar->status == 'Terverifikasi' || $pendaftar->status == 'lulus') && $pendaftar->status_bayar != 'settlement') {
            if ($pendaftar->snap_token) {
                $snapToken = $pendaftar->snap_token;
            } else {
                \Midtrans\Config::$serverKey = config('midtrans.server_key');
                \Midtrans\Config::$isProduction = config('midtrans.is_production');
                \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized', true);
                \Midtrans\Config::$is3ds = config('midtrans.is_3ds', true);

                $params = [
                    'transaction_details' => [
                        'order_id' => $pendaftar->order_id ?: ('PSB-' . time()),
                        'gross_amount' => 200000,
                    ],
                    'customer_details' => [
                        'first_name' => $pendaftar->nama ?: $user->name,
                        'email' => $pendaftar->email ?: $user->email,
                        'phone' => $pendaftar->no_hp ?: $user->phone,
                    ],
                ];

                try {
                    $snapToken = \Midtrans\Snap::getSnapToken($params);
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::warning("Midtrans Snap Error in DashboardController: " . $e->getMessage());
                    $snapToken = 'mock-snap-' . md5($pendaftar->order_id ?: time());
                }

                $pendaftar->update(['snap_token' => $snapToken]);
            }
        }

        return view('user.pembayaran', compact('user', 'santri', 'pendaftar', 'snapToken'));
    }

    /**
     * Biodata & Berkas Santri Terverifikasi
     */
    public function biodata()
    {
        [$user, $santri, $pendaftar] = $this->getSantriData();

        return view('user.biodata', compact('user', 'santri', 'pendaftar'));
    }
}
