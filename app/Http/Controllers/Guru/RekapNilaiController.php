<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Santri;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekapNilaiController extends Controller
{
    public function index(Request $request)
    {
        $kelasList = Kelas::all();
        $mapelList = Mapel::all();

        $kelasId = $request->query('kelas_id', $kelasList->first()?->id);
        $mapelId = $request->query('mapel_id', $mapelList->first()?->id);
        $semester = $request->query('semester', 'Ganjil');
        $tahunAjaran = $request->query('tahun_ajaran', '2026/2027');

        $rekapData = collect();
        $avgNilai = 0;
        $maxNilai = 0;
        $minNilai = 0;
        $tuntasCount = 0;
        $belumTuntasCount = 0;

        $selectedKelas = Kelas::find($kelasId);
        $selectedMapel = Mapel::find($mapelId);

        if ($kelasId && $mapelId) {
            $santris = Santri::where('kelas_id', $kelasId)
                ->where('status', 'Aktif')
                ->orderBy('nama_lengkap', 'asc')
                ->get();

            $kkm = $selectedMapel ? $selectedMapel->kkm : 75;

            $totalAkhir = 0;
            $countNilai = 0;
            $allAkhir = [];

            foreach ($santris as $santri) {
                $nilai = Nilai::where('santri_id', $santri->id)
                    ->where('mapel_id', $mapelId)
                    ->where('semester', $semester)
                    ->where('tahun_ajaran', $tahunAjaran)
                    ->first();

                $akhir = $nilai ? $nilai->nilai_akhir : 0;
                $status = ($nilai && $akhir >= $kkm) ? 'Tuntas' : 'Belum Tuntas';

                if ($nilai) {
                    $totalAkhir += $akhir;
                    $allAkhir[] = $akhir;
                    $countNilai++;
                    if ($akhir >= $kkm) {
                        $tuntasCount++;
                    } else {
                        $belumTuntasCount++;
                    }
                } else {
                    $belumTuntasCount++;
                }

                $rekapData->push((object)[
                    'santri' => $santri,
                    'tugas' => $nilai ? $nilai->nilai_tugas : '-',
                    'uts' => $nilai ? $nilai->nilai_uts : '-',
                    'uas' => $nilai ? $nilai->nilai_uas : '-',
                    'akhir' => $nilai ? $nilai->nilai_akhir : 0,
                    'predikat' => $nilai ? $nilai->predikat : '-',
                    'status' => $status,
                ]);
            }

            if ($countNilai > 0) {
                $avgNilai = round($totalAkhir / $countNilai, 2);
                $maxNilai = max($allAkhir);
                $minNilai = min($allAkhir);
            }
        }

        return view('guru.rekap.index', compact(
            'kelasList', 'mapelList', 'kelasId', 'mapelId', 'semester', 'tahunAjaran',
            'rekapData', 'avgNilai', 'maxNilai', 'minNilai', 'tuntasCount', 'belumTuntasCount',
            'selectedKelas', 'selectedMapel'
        ));
    }

    public function cetak(Request $request)
    {
        $kelasId = $request->query('kelas_id');
        $mapelId = $request->query('mapel_id');
        $semester = $request->query('semester', 'Ganjil');
        $tahunAjaran = $request->query('tahun_ajaran', '2026/2027');

        $selectedKelas = Kelas::findOrFail($kelasId);
        $selectedMapel = Mapel::findOrFail($mapelId);
        $guru = Auth::user();

        $santris = Santri::where('kelas_id', $kelasId)
            ->where('status', 'Aktif')
            ->orderBy('nama_lengkap', 'asc')
            ->get();

        $kkm = $selectedMapel->kkm;
        $rekapData = collect();

        foreach ($santris as $santri) {
            $nilai = Nilai::where('santri_id', $santri->id)
                ->where('mapel_id', $mapelId)
                ->where('semester', $semester)
                ->where('tahun_ajaran', $tahunAjaran)
                ->first();

            $akhir = $nilai ? $nilai->nilai_akhir : 0;
            $status = ($nilai && $akhir >= $kkm) ? 'Tuntas' : 'Belum Tuntas';

            $rekapData->push((object)[
                'santri' => $santri,
                'tugas' => $nilai ? $nilai->nilai_tugas : 0,
                'uts' => $nilai ? $nilai->nilai_uts : 0,
                'uas' => $nilai ? $nilai->nilai_uas : 0,
                'akhir' => $akhir,
                'predikat' => $nilai ? $nilai->predikat : 'D',
                'status' => $status,
            ]);
        }

        return view('guru.rekap.cetak', compact(
            'selectedKelas', 'selectedMapel', 'semester', 'tahunAjaran', 'guru', 'rekapData'
        ));
    }
}
