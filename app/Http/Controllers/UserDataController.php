<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataPendaftar;
use App\Models\Santri;
use App\Models\Pendaftar;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class UserDataController extends Controller
{
    /**
     * Helper mengambil data terpadu Santri dan Pendaftar dari Database
     */
    protected function getUnifiedSantriData()
    {
        $user = Auth::user();
        $santri = Santri::with(['kelas'])->where('user_id', $user->id)->first();
        $pendaftar = Pendaftar::where('email', $user->email)
            ->orWhere('id', $santri?->pendaftar_id)
            ->first();
        $dataPendaftarOld = DataPendaftar::where('user_id', $user->id)->first();

        $data = (object) [
            'id' => $santri?->id ?? $pendaftar?->id ?? $dataPendaftarOld?->id ?? $user->id,
            'nama_lengkap' => $santri?->nama_lengkap ?? $pendaftar?->nama ?? $dataPendaftarOld?->nama_lengkap ?? $user->name,
            'nisn' => $santri?->nisn ?? $pendaftar?->nisn ?? '-',
            'nik' => $pendaftar?->nik ?? $dataPendaftarOld?->nik ?? '-',
            'jenis_kelamin' => $santri?->jenis_kelamin ?? $pendaftar?->jenis_kelamin ?? $dataPendaftarOld?->jenis_kelamin ?? 'Laki-laki',
            'tempat_lahir' => $pendaftar?->tempat_lahir ?? $dataPendaftarOld?->tempat_lahir ?? 'Tangerang',
            'tanggal_lahir' => $pendaftar?->tanggal_lahir ?? $dataPendaftarOld?->tanggal_lahir ?? now()->subYears(15)->format('Y-m-d'),
            'alamat' => $santri?->alamat ?? $pendaftar?->alamat ?? $dataPendaftarOld?->alamat ?? '-',
            'nama_ayah' => $pendaftar?->nama_ayah ?? $dataPendaftarOld?->nama_ayah ?? '-',
            'nama_ibu' => $pendaftar?->nama_ibu ?? $dataPendaftarOld?->nama_ibu ?? '-',
            'pekerjaan_ayah' => $pendaftar?->pekerjaan_ayah ?? '-',
            'pekerjaan_ibu' => $pendaftar?->pekerjaan_ibu ?? '-',
            'asal_sekolah' => $pendaftar?->asal_sekolah ?? '-',
            'no_hp' => $santri?->no_hp ?? $pendaftar?->no_hp ?? $user->phone ?? '-',
            'jenjang' => $santri?->jenjang ?? $pendaftar?->jenjang ?? 'SMK Al-Fattah',
            'jurusan' => $santri?->jurusan ?? $pendaftar?->jurusan ?? ($santri?->kelas?->nama_kelas ?? 'Multimedia & DKV'),
            'kelas' => $santri?->kelas ? $santri->kelas->nama_kelas : '10 SMK-MM',
            'status' => $santri?->status ?? ($pendaftar?->status ?? 'Terverifikasi'),
            'status_bayar' => $pendaftar?->status_bayar ?? 'settlement',
            'order_id' => $pendaftar?->order_id ?? ('KTS-' . date('Y') . '-' . str_pad($santri?->id ?? $user->id, 4, '0', STR_PAD_LEFT)),
            'file_foto' => $pendaftar?->file_foto,
            'user' => $user,
        ];

        return [$data, $santri, $pendaftar, $dataPendaftarOld];
    }

    /**
     * Tampilkan form data pendaftar (otomatis terisi dari database santri/pendaftar jika ada)
     */
    public function data()
    {
        [$dataPendaftar, $santri, $pendaftar, $dataPendaftarOld] = $this->getUnifiedSantriData();
        return view('user.data', compact('dataPendaftar', 'santri', 'pendaftar'));
    }

    /**
     * Simpan atau update data pendaftar
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|max:50',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'akta' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'ijazah' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Ambil data lama atau buat baru
        $dataPendaftar = DataPendaftar::firstOrNew([
            'user_id' => Auth::id(),
        ]);

        // Simpan data teks
        $dataPendaftar->nama_lengkap = $request->nama_lengkap;
        $dataPendaftar->nik = $request->nik;
        $dataPendaftar->tempat_lahir = $request->tempat_lahir;
        $dataPendaftar->tanggal_lahir = $request->tanggal_lahir;
        $dataPendaftar->jenis_kelamin = $request->jenis_kelamin;
        $dataPendaftar->alamat = $request->alamat;
        $dataPendaftar->nama_ayah = $request->nama_ayah;
        $dataPendaftar->nama_ibu = $request->nama_ibu;

        // Simpan file jika ada upload baru
        foreach (['kk', 'akta', 'ijazah'] as $field) {
            if ($request->hasFile($field)) {
                $dataPendaftar->$field = $request->file($field)->store("dokumen/{$field}", 'public');
            }
        }

        $dataPendaftar->save();

        // Update juga pada santri jika ada
        $santri = Santri::where('user_id', Auth::id())->first();
        if ($santri) {
            $santri->nama_lengkap = $request->nama_lengkap;
            $santri->jenis_kelamin = $request->jenis_kelamin;
            $santri->alamat = $request->alamat;
            $santri->save();
        }

        return redirect()->route('user.bukti')->with('success', 'Data santri berhasil disimpan dan diperbarui!');
    }

    /**
     * Tampilkan status pendaftaran
     */
    public function status()
    {
        [$dataPendaftar, $santri, $pendaftar] = $this->getUnifiedSantriData();
        return view('user.status', compact('dataPendaftar', 'santri', 'pendaftar'));
    }

    /**
     * Tampilkan halaman kartu santri / bukti pendaftaran (mengambil langsung dari database)
     */
    public function bukti()
    {
        [$dataPendaftar, $santri, $pendaftar] = $this->getUnifiedSantriData();
        return view('user.bukti', compact('dataPendaftar', 'santri', 'pendaftar'));
    }

    /**
     * Preview bukti pendaftaran
     */
    public function previewBukti()
    {
        [$dataPendaftar, $santri, $pendaftar] = $this->getUnifiedSantriData();
        return view('user.bukti', compact('dataPendaftar', 'santri', 'pendaftar'));
    }

    /**
     * Cetak Kartu Tanda Santri (KTS) / Bukti Pendaftaran PDF
     */
    public function cetakBukti()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        [$dataPendaftar, $santri, $pendaftar] = $this->getUnifiedSantriData();

        $pdf = Pdf::loadView('user.bukti_pdf', compact('dataPendaftar', 'santri', 'pendaftar'))
            ->setPaper('a4', 'portrait');

        $fileName = 'kartu-santri-' . Str::slug($dataPendaftar->nama_lengkap) . '.pdf';

        return $pdf->download($fileName);
    }
}
