<?php

namespace App\Http\Controllers;

use App\Models\DataPendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DataPendaftarController extends Controller
{
    /**
     * Tampilkan daftar semua pendaftar
     */
    public function index()
    {
        $pendaftar = DataPendaftar::with('user')->latest()->get();
        return view('admin.pendaftar.index', compact('pendaftar'));
    }

    /**
     * Form tambah data pendaftar
     */
    public function create()
    {
        return view('admin.pendaftar.create');
    }

    /**
     * Simpan data pendaftar baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|max:255|unique:data_pendaftar',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'nama_ayah' => 'required|string',
            'nama_ibu' => 'required|string',
            'kk' => 'required|string',
            'akta' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'ijazah' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['status'] = 'Pending';

        // Upload file
        if ($request->hasFile('akta')) {
            $data['akta'] = $request->file('akta')->store('pendaftaran', 'public');
        }

        if ($request->hasFile('ijazah')) {
            $data['ijazah'] = $request->file('ijazah')->store('pendaftaran', 'public');
        }

        DataPendaftar::create($data);

        return redirect()->route('admin.pendaftar.index')->with('success', '✅ Data pendaftar berhasil ditambahkan!');
    }

    /**
     * Form edit data pendaftar
     */
    public function edit($id)
    {
        $pendaftar = DataPendaftar::findOrFail($id);
        return view('admin.pendaftar.edit', compact('pendaftar'));
    }

    /**
     * Update data pendaftar
     */
    public function update(Request $request, $id)
    {
        $pendaftar = DataPendaftar::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|max:255|unique:data_pendaftar,nik,' . $id,
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'nama_ayah' => 'required|string',
            'nama_ibu' => 'required|string',
            'kk' => 'required|string',
            'akta' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'ijazah' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $data = $request->all();

        // Upload ulang file jika ada file baru
        if ($request->hasFile('akta')) {
            // Hapus file lama
            if ($pendaftar->akta && Storage::disk('public')->exists($pendaftar->akta)) {
                Storage::disk('public')->delete($pendaftar->akta);
            }
            $data['akta'] = $request->file('akta')->store('pendaftaran', 'public');
        }

        if ($request->hasFile('ijazah')) {
            if ($pendaftar->ijazah && Storage::disk('public')->exists($pendaftar->ijazah)) {
                Storage::disk('public')->delete($pendaftar->ijazah);
            }
            $data['ijazah'] = $request->file('ijazah')->store('pendaftaran', 'public');
        }

        $pendaftar->update($data);

        return redirect()->route('admin.pendaftar.index')->with('success', '✅ Data pendaftar berhasil diperbarui!');
    }

    /**
     * Hapus data pendaftar
     */
    public function destroy($id)
    {
        $pendaftar = DataPendaftar::findOrFail($id);

        // Hapus file dari storage
        if ($pendaftar->akta && Storage::disk('public')->exists($pendaftar->akta)) {
            Storage::disk('public')->delete($pendaftar->akta);
        }
        if ($pendaftar->ijazah && Storage::disk('public')->exists($pendaftar->ijazah)) {
            Storage::disk('public')->delete($pendaftar->ijazah);
        }

        $pendaftar->delete();

        return redirect()->route('admin.pendaftar.index')->with('success', '🗑️ Data pendaftar berhasil dihapus!');
    }

    /**
     * Update status pendaftar (Terverifikasi / Ditolak)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Terverifikasi,Ditolak',
        ]);

        $pendaftar = DataPendaftar::findOrFail($id);
        $pendaftar->update(['status' => $request->status]);

        return back()->with('success', '✅ Status pendaftar berhasil diperbarui!');
    }
}
