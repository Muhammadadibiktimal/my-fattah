<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PendaftarExport;
use App\Models\DataPendaftar;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PendaftarController extends Controller
{
    public function index()
    {
        // Ambil data dari pendaftar online terbaru
        $pendaftar = Pendaftar::latest()->get();
        if ($pendaftar->isEmpty()) {
            $pendaftar = DataPendaftar::latest()->get();
        }
        return view('admin.pendaftar.index', compact('pendaftar'));
    }

    public function verifikasi()
    {
        $pendaftar = Pendaftar::latest()->get();
        if ($pendaftar->isEmpty()) {
            $pendaftar = DataPendaftar::latest()->get();
        }
        return view('admin.pendaftar.verifikasi', compact('pendaftar'));
    }

    public function arsip(Request $request)
    {
        $query = $request->input('search');

        $pendaftar = Pendaftar::query()
            ->when($query, function ($q) use ($query) {
                $q->where('nama', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%")
                    ->orWhere('nik', 'like', "%{$query}%");
            })
            ->latest()
            ->paginate(15);

        return view('admin.pendaftar.arsip', compact('pendaftar', 'query'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pendaftar = Pendaftar::find($id);
        if ($pendaftar) {
            $pendaftar->status = $request->status;
            $pendaftar->save();
        } else {
            $dp = DataPendaftar::findOrFail($id);
            $dp->status = $request->status;
            $dp->save();
        }

        return back()->with('success', "Status pendaftar berhasil diubah menjadi {$request->status}.");
    }

    public function show($id)
    {
        // Ambil data pendaftar berdasarkan ID
        $pendaftar = Pendaftar::find($id);
        if (!$pendaftar) {
            $pendaftar = DataPendaftar::findOrFail($id);
        }

        $email = $pendaftar->email ?? ($pendaftar->user ? $pendaftar->user->email : null);
        $userSantri = $email ? \App\Models\User::where('email', $email)->first() : null;
        $santriData = \App\Models\Santri::where('pendaftar_id', $pendaftar->id)
            ->when($userSantri, fn($q) => $q->orWhere('user_id', $userSantri->id))
            ->first();

        // Kirim data ke view
        return view('admin.pendaftar.show', compact('pendaftar', 'userSantri', 'santriData'));
    }

    public function export()
    {
        $fileName = 'data_pendaftar_' . now()->format('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new PendaftarExport, $fileName);
    }

    public function exportPdf()
    {
        $pendaftar = DataPendaftar::orderBy('nama_lengkap')->get();

        // Generate tanggal
        $tanggal = now()->translatedFormat('d F Y');

        $pdf = Pdf::loadView('admin.pendaftar.export_pdf', compact('pendaftar', 'tanggal'))
                  ->setPaper('A4', 'landscape');

        return $pdf->download('Backup_Data_Pendaftar_'.$tanggal.'.pdf');
    }

    /**
     * 🔹 Membuatkan akun untuk calon siswa/santri baru dan langsung diarahkan ke Fitur Data Santri Aktif
     */
    public function buatAkun(Request $request, $id)
    {
        $pendaftar = Pendaftar::find($id);
        $nama = '';
        $email = '';
        $phone = '';

        if ($pendaftar) {
            $nama = $pendaftar->nama;
            $email = $pendaftar->email;
            $phone = $pendaftar->no_hp;
        } else {
            $dp = DataPendaftar::findOrFail($id);
            $nama = $dp->nama_lengkap;
            $user = $dp->user;
            $email = $user ? $user->email : strtolower(str_replace(' ', '', $dp->nama_lengkap)) . rand(10, 99) . '@santri.alfattah.sch.id';
            $phone = null;
        }

        $passwordPlain = $request->input('password') ?: 'Santri@' . rand(1000, 9999);

        $user = \App\Models\User::where('email', $email)->first();
        if ($user) {
            $user->password = \Illuminate\Support\Facades\Hash::make($passwordPlain);
            $user->role = 'user';
            $user->save();
        } else {
            $user = \App\Models\User::create([
                'name' => $nama,
                'email' => $email,
                'phone' => $phone,
                'password' => \Illuminate\Support\Facades\Hash::make($passwordPlain),
                'role' => 'user',
            ]);
        }

        if ($pendaftar) {
            $pendaftar->status_bayar = 'settlement';
            $pendaftar->status = 'Terverifikasi';
            $pendaftar->save();
        }

        // Otomatis masukkan ke data santri jika belum ada atau update relasinya
        $santri = \App\Models\Santri::where('user_id', $user->id)
            ->orWhere('pendaftar_id', $pendaftar?->id)
            ->first();

        // Tentukan kelas awal berdasarkan jenjang dan jurusan
        $kelasId = null;
        $jenjang = $pendaftar?->jenjang;
        $jurusan = $pendaftar?->jurusan;

        if ($jenjang) {
            if (str_contains($jenjang, 'SMK')) {
                if ($jurusan && str_contains($jurusan, 'TKJ')) {
                    $kelasId = \App\Models\Kelas::where('nama_kelas', 'like', '%10%TKJ%')->value('id');
                } else {
                    $kelasId = \App\Models\Kelas::where('nama_kelas', 'like', '%10%MM%')->value('id')
                            ?: \App\Models\Kelas::where('tingkat', '10')->where('nama_kelas', 'like', '%SMK%')->value('id');
                }
            } elseif (str_contains($jenjang, 'SMA')) {
                if ($jurusan && (str_contains($jurusan, 'IPS') || str_contains($jurusan, 'Sosial'))) {
                    $kelasId = \App\Models\Kelas::where('nama_kelas', 'like', '%10%IPS%')->value('id');
                } else {
                    $kelasId = \App\Models\Kelas::where('nama_kelas', 'like', '%10%IPA%')->value('id')
                            ?: \App\Models\Kelas::where('tingkat', '10')->where('nama_kelas', 'like', '%SMA%')->value('id');
                }
            } elseif (str_contains($jenjang, 'SMP')) {
                $kelasId = \App\Models\Kelas::where('tingkat', '7')->value('id');
            }
        }

        if (!$kelasId) {
            $kelasId = \App\Models\Kelas::where('tingkat', '10')->value('id')
                    ?: \App\Models\Kelas::where('tingkat', '7')->value('id')
                    ?: \App\Models\Kelas::first()?->id;
        }

        $tingkat = \App\Models\Kelas::find($kelasId)?->tingkat ?? '10';

        if (!$santri) {
            $santri = \App\Models\Santri::create([
                'user_id' => $user->id,
                'pendaftar_id' => $pendaftar ? $pendaftar->id : null,
                'nama_lengkap' => $nama,
                'nisn' => $pendaftar?->nisn,
                'kelas_id' => $kelasId,
                'jenjang' => $jenjang,
                'jurusan' => $jurusan,
                'jenis_kelamin' => $pendaftar?->jenis_kelamin ?? 'Laki-laki',
                'no_hp' => $phone,
                'alamat' => $pendaftar?->alamat,
                'status' => 'Aktif',
                'status_kenaikan' => 'Aktif (Tingkat ' . $tingkat . ')',
            ]);
        } else {
            $santri->user_id = $user->id;
            $santri->status = 'Aktif';
            if ($pendaftar?->nisn) $santri->nisn = $pendaftar->nisn;
            if ($pendaftar?->no_hp) $santri->no_hp = $pendaftar->no_hp;
            if ($jenjang) $santri->jenjang = $jenjang;
            if ($jurusan) $santri->jurusan = $jurusan;
            if (!$santri->kelas_id && $kelasId) $santri->kelas_id = $kelasId;
            $santri->save();
        }

        // 🔹 Arahkan langsung ke fitur Data Santri Aktif (/admin/santri) dengan info kredensial
        return redirect()->route('admin.santri.index')->with('akun_created', [
            'nama' => $nama,
            'email' => $email,
            'password' => $passwordPlain,
        ])->with('success', "Akun login santri {$nama} berhasil diterbitkan dan otomatis terdaftar di Data Santri Aktif!");
    }
}
