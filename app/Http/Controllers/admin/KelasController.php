<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelasList = Kelas::withCount('santri')->get();
        return view('admin.kelas.index', compact('kelasList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:50|unique:kelas,nama_kelas',
            'tingkat' => 'required|string|max:10',
            'jenjang' => 'required|string',
            'jurusan' => 'nullable|string',
            'wali_kelas' => 'nullable|string|max:255',
        ]);

        Kelas::create($request->only(['nama_kelas', 'tingkat', 'jenjang', 'jurusan', 'wali_kelas']));

        return back()->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'required|string|max:50|unique:kelas,nama_kelas,' . $id,
            'tingkat' => 'required|string|max:10',
            'jenjang' => 'required|string',
            'jurusan' => 'nullable|string',
            'wali_kelas' => 'nullable|string|max:255',
        ]);

        $kelas->update($request->only(['nama_kelas', 'tingkat', 'jenjang', 'jurusan', 'wali_kelas']));

        return back()->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return back()->with('success', 'Data kelas berhasil dihapus.');
    }
}
