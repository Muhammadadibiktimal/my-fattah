<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Santri;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $kelasList = Kelas::all();
        $kelasId = $request->query('kelas_id', $kelasList->first()?->id);
        $selectedKelas = Kelas::find($kelasId);

        // Filter Mapel berdasarkan jenjang & jurusan kelas yang dipilih
        if ($selectedKelas) {
            $mapelList = Mapel::where(function ($q) use ($selectedKelas) {
                $q->where('jenjang', 'Semua')
                  ->orWhere('jenjang', $selectedKelas->jenjang);
            })->where(function ($q) use ($selectedKelas) {
                if ($selectedKelas->jurusan) {
                    $q->whereNull('jurusan')
                      ->orWhere('jurusan', 'Semua')
                      ->orWhere('jurusan', $selectedKelas->jurusan);
                }
            })->get();
        } else {
            $mapelList = Mapel::all();
        }

        $mapelId = $request->query('mapel_id', $mapelList->first()?->id);
        $semester = $request->query('semester', 'Ganjil');
        $tahunAjaran = $request->query('tahun_ajaran', '2026/2027');

        $santris = collect();
        $existingNilai = [];

        if ($kelasId) {
            $santris = Santri::where('kelas_id', $kelasId)
                ->where('status', 'Aktif')
                ->orderBy('nama_lengkap', 'asc')
                ->get();

            if ($mapelId) {
                $nilaiRecords = Nilai::where('kelas_id', $kelasId)
                    ->where('mapel_id', $mapelId)
                    ->where('semester', $semester)
                    ->where('tahun_ajaran', $tahunAjaran)
                    ->get();

                foreach ($nilaiRecords as $nr) {
                    $existingNilai[$nr->santri_id] = $nr;
                }
            }
        }

        $selectedKelas = Kelas::find($kelasId);
        $selectedMapel = Mapel::find($mapelId);

        return view('guru.nilai.index', compact(
            'kelasList', 'mapelList', 'kelasId', 'mapelId', 'semester', 'tahunAjaran',
            'santris', 'existingNilai', 'selectedKelas', 'selectedMapel'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapel,id',
            'semester' => 'required|string',
            'tahun_ajaran' => 'required|string',
            'nilai' => 'required|array',
        ]);

        $guruId = Auth::id();
        $kelasId = $request->kelas_id;
        $mapelId = $request->mapel_id;
        $semester = $request->semester;
        $tahunAjaran = $request->tahun_ajaran;

        foreach ($request->nilai as $santriId => $data) {
            $tugas = floatval($data['tugas'] ?? 0);
            $uts = floatval($data['uts'] ?? 0);
            $uas = floatval($data['uas'] ?? 0);

            $nilaiAkhir = Nilai::hitungNilaiAkhir($tugas, $uts, $uas);
            $predikat = Nilai::hitungPredikat($nilaiAkhir);

            Nilai::updateOrCreate(
                [
                    'santri_id' => $santriId,
                    'mapel_id' => $mapelId,
                    'semester' => $semester,
                    'tahun_ajaran' => $tahunAjaran,
                ],
                [
                    'kelas_id' => $kelasId,
                    'guru_id' => $guruId,
                    'nilai_tugas' => $tugas,
                    'nilai_uts' => $uts,
                    'nilai_uas' => $uas,
                    'nilai_akhir' => $nilaiAkhir,
                    'predikat' => $predikat,
                ]
            );
        }

        return back()->with('success', 'Data nilai santri berhasil disimpan!');
    }
}
