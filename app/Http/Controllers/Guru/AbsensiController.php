<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Santri;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $kelasList = Kelas::all();
        $kelasId = $request->query('kelas_id', $kelasList->first()?->id);
        $tanggal = $request->query('tanggal', date('Y-m-d'));

        $santris = collect();
        $existingAbsensi = [];

        if ($kelasId) {
            $santris = Santri::where('kelas_id', $kelasId)
                ->where('status', 'Aktif')
                ->orderBy('nama_lengkap', 'asc')
                ->get();

            $absensiRecords = Absensi::where('kelas_id', $kelasId)
                ->where('tanggal', $tanggal)
                ->get();

            foreach ($absensiRecords as $ar) {
                $existingAbsensi[$ar->santri_id] = $ar;
            }
        }

        $selectedKelas = Kelas::find($kelasId);

        return view('guru.absensi.index', compact(
            'kelasList', 'kelasId', 'tanggal', 'santris', 'existingAbsensi', 'selectedKelas'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal' => 'required|date',
            'absensi' => 'required|array',
        ]);

        $guruId = Auth::id();
        $kelasId = $request->kelas_id;
        $tanggal = $request->tanggal;

        foreach ($request->absensi as $santriId => $data) {
            $status = $data['status'] ?? 'Hadir';
            $keterangan = $data['keterangan'] ?? null;

            Absensi::updateOrCreate(
                [
                    'santri_id' => $santriId,
                    'tanggal' => $tanggal,
                ],
                [
                    'kelas_id' => $kelasId,
                    'guru_id' => $guruId,
                    'status' => $status,
                    'keterangan' => $keterangan,
                ]
            );
        }

        return back()->with('success', 'Data absensi santri tanggal ' . date('d-m-Y', strtotime($tanggal)) . ' berhasil disimpan!');
    }
}
