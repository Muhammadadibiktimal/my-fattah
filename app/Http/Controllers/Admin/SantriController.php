<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Santri;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SantriController extends Controller
{
    public function index(Request $request)
    {
        $kelasId = $request->query('kelas_id');
        $search = $request->query('search');

        $query = Santri::with(['kelas', 'user'])->latest();

        if ($kelasId) {
            $query->where('kelas_id', $kelasId);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%");
            });
        }

        $santris = $query->paginate(15);
        $kelasList = Kelas::all();

        return view('admin.santri.index', compact('santris', 'kelasList', 'kelasId', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nisn' => 'nullable|string|unique:santri,nisn',
            'kelas_id' => 'nullable|exists:kelas,id',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'email' => 'nullable|email|unique:users,email',
            'no_hp' => 'nullable|string|max:20',
        ]);

        $userId = null;
        $passwordPlain = null;

        if ($request->filled('email')) {
            $passwordPlain = $request->password ?: 'Santri@' . rand(1000, 9999);
            $user = User::create([
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'phone' => $request->no_hp,
                'password' => Hash::make($passwordPlain),
                'role' => 'user',
            ]);
            $userId = $user->id;
        }

        $santri = Santri::create([
            'user_id' => $userId,
            'nisn' => $request->nisn ?: ('NISN-' . rand(100000, 999999)),
            'nama_lengkap' => $request->nama_lengkap,
            'kelas_id' => $request->kelas_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'status' => 'Aktif',
        ]);

        if ($passwordPlain) {
            return back()->with('akun_created', [
                'nama' => $santri->nama_lengkap,
                'email' => $request->email,
                'password' => $passwordPlain,
            ])->with('success', 'Data santri berhasil ditambahkan dan akun login dibuat.');
        }

        return back()->with('success', 'Data santri berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $santri = Santri::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'kelas_id' => 'nullable|exists:kelas,id',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        $santri->update($request->only([
            'nama_lengkap', 'nisn', 'kelas_id', 'jenis_kelamin', 'no_hp', 'alamat', 'status'
        ]));

        return back()->with('success', 'Data santri berhasil diperbarui.');
    }

    public function setAccount(Request $request, $id)
    {
        $santri = Santri::findOrFail($id);

        $request->validate([
            'email' => 'required|email',
            'password' => 'nullable|string|min:6',
        ]);

        $passwordPlain = $request->password ?: 'Santri@' . rand(1000, 9999);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->password = Hash::make($passwordPlain);
            $user->role = 'user';
            $user->name = $santri->nama_lengkap;
            $user->save();
        } else {
            $user = User::create([
                'name' => $santri->nama_lengkap,
                'email' => $request->email,
                'phone' => $santri->no_hp,
                'password' => Hash::make($passwordPlain),
                'role' => 'user',
            ]);
        }

        $santri->user_id = $user->id;
        $santri->save();

        return back()->with('akun_created', [
            'nama' => $santri->nama_lengkap,
            'email' => $user->email,
            'password' => $passwordPlain,
        ])->with('success', "Akun login santri {$santri->nama_lengkap} berhasil diatur!");
    }

    /**
     * 🎓 Kontrol Kenaikan Kelas, Tinggal Kelas, atau Kelulusan Santri oleh Admin
     */
    public function kenaikanKelas(Request $request, $id)
    {
        $santri = Santri::findOrFail($id);

        $request->validate([
            'status_kenaikan' => 'required|string|in:Naik Kelas,Tinggal Kelas,Lulus',
            'kelas_id' => 'nullable|exists:kelas,id',
            'catatan_kenaikan' => 'nullable|string|max:500',
        ]);

        $statusKenaikan = $request->status_kenaikan;
        $santri->status_kenaikan = $statusKenaikan;
        $santri->catatan_kenaikan = $request->catatan_kenaikan;

        if ($statusKenaikan === 'Lulus') {
            $santri->status = 'Alumni';
        } else {
            $santri->status = 'Aktif';
            if ($request->filled('kelas_id')) {
                $santri->kelas_id = $request->kelas_id;
            }
        }

        $santri->save();

        $kelasNama = $santri->kelas ? 'Kelas ' . $santri->kelas->nama_kelas : 'Alumni';

        return back()->with('success', "Status kenaikan santri {$santri->nama_lengkap} berhasil diubah menjadi [{$statusKenaikan}] - {$kelasNama}!");
    }

    public function destroy($id)
    {
        $santri = Santri::findOrFail($id);
        $santri->delete();

        return back()->with('success', 'Data santri berhasil dihapus.');
    }
}
