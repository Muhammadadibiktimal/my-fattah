<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        $mapelList = Mapel::all();
        return view('admin.mapel.index', compact('mapelList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mapel' => 'required|string|max:10|unique:mapel,kode_mapel',
            'nama_mapel' => 'required|string|max:100',
            'jenjang' => 'required|string',
            'jurusan' => 'nullable|string',
            'kkm' => 'required|numeric|min:0|max:100',
        ]);

        Mapel::create($request->only(['kode_mapel', 'nama_mapel', 'jenjang', 'jurusan', 'kkm']));

        return back()->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $mapel = Mapel::findOrFail($id);

        $request->validate([
            'kode_mapel' => 'required|string|max:10|unique:mapel,kode_mapel,' . $id,
            'nama_mapel' => 'required|string|max:100',
            'jenjang' => 'required|string',
            'jurusan' => 'nullable|string',
            'kkm' => 'required|numeric|min:0|max:100',
        ]);

        $mapel->update($request->only(['kode_mapel', 'nama_mapel', 'jenjang', 'jurusan', 'kkm']));

        return back()->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mapel = Mapel::findOrFail($id);
        $mapel->delete();

        return back()->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}
