@extends('guru.layouts.app')

@section('title', 'Input Nilai Siswa/Santri')

@section('content')
<div class="space-y-6">

    <!-- Header & Deskripsi -->
    <div>
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <span class="iconify text-emerald-600 text-3xl" data-icon="mdi:pencil-ruler"></span>
            <span>Input Nilai Santri</span>
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Pilih kelas dan mata pelajaran untuk menginput nilai harian/tugas, UTS, dan UAS. Nilai Akhir dan Predikat akan otomatis dihitung.
        </p>
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-300 text-emerald-800 rounded-2xl flex items-center gap-2 font-medium">
            <span class="iconify text-xl" data-icon="mdi:check-circle"></span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Filter Form -->
    <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
        <form method="GET" action="{{ route('guru.nilai.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 items-end">
            <!-- Pilih Kelas -->
            <div>
                <label class="block text-xs font-bold uppercase text-gray-500 mb-1.5">Kelas / Rombel</label>
                <select name="kelas_id" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-emerald-500">
                    @foreach($kelasList as $k)
                        <option value="{{ $k->id }}" {{ $kelasId == $k->id ? 'selected' : '' }}>
                            Kelas {{ $k->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Pilih Mapel -->
            <div>
                <label class="block text-xs font-bold uppercase text-gray-500 mb-1.5">Mata Pelajaran</label>
                <select name="mapel_id" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-emerald-500">
                    @foreach($mapelList as $m)
                        <option value="{{ $m->id }}" {{ $mapelId == $m->id ? 'selected' : '' }}>
                            {{ $m->nama_mapel }} (KKM: {{ $m->kkm }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Semester -->
            <div>
                <label class="block text-xs font-bold uppercase text-gray-500 mb-1.5">Semester</label>
                <select name="semester" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-emerald-500">
                    <option value="Ganjil" {{ $semester == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                    <option value="Genap" {{ $semester == 'Genap' ? 'selected' : '' }}>Genap</option>
                </select>
            </div>

            <!-- Tahun Ajaran -->
            <div>
                <label class="block text-xs font-bold uppercase text-gray-500 mb-1.5">Tahun Ajaran</label>
                <select name="tahun_ajaran" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-emerald-500">
                    <option value="2026/2027" {{ $tahunAjaran == '2026/2027' ? 'selected' : '' }}>2026/2027</option>
                    <option value="2025/2026" {{ $tahunAjaran == '2025/2026' ? 'selected' : '' }}>2025/2026</option>
                </select>
            </div>

            <div>
                <button type="submit"
                        class="w-full py-2.5 bg-gray-800 hover:bg-gray-900 text-white font-bold text-xs rounded-xl transition flex items-center justify-center gap-1">
                    <span class="iconify text-base" data-icon="mdi:filter-variant"></span>
                    <span>Tampilkan Santri</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Info Kelas & Mapel Aktif -->
    @if($selectedKelas && $selectedMapel)
        <div class="bg-emerald-50/80 border border-emerald-200 rounded-2xl p-4 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-emerald-600 text-white rounded-xl">
                    <span class="iconify text-2xl" data-icon="mdi:school"></span>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">
                        Kelas {{ $selectedKelas->nama_kelas }} • Mata Pelajaran: {{ $selectedMapel->nama_mapel }}
                    </h3>
                    <span class="text-xs text-gray-600">
                        Bobot: Tugas (30%) + UTS (30%) + UAS (40%) • Standar KKM: <strong class="text-emerald-800">{{ $selectedMapel->kkm }}</strong>
                    </span>
                </div>
            </div>

            <div class="text-xs font-bold text-gray-600">
                Total: {{ $santris->count() }} Santri
            </div>
        </div>
    @endif

    <!-- Form Input Nilai Santri -->
    @if($santris->isNotEmpty())
        <form action="{{ route('guru.nilai.store') }}" method="POST" id="formNilai">
            @csrf
            <input type="hidden" name="kelas_id" value="{{ $kelasId }}">
            <input type="hidden" name="mapel_id" value="{{ $mapelId }}">
            <input type="hidden" name="semester" value="{{ $semester }}">
            <input type="hidden" name="tahun_ajaran" value="{{ $tahunAjaran }}">

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50 text-gray-700 font-semibold uppercase text-xs">
                            <tr>
                                <th class="py-3 px-4 text-center w-12">#</th>
                                <th class="py-3 px-4 text-left">Nama Santri</th>
                                <th class="py-3 px-4 text-center w-28">Nilai Tugas (30%)</th>
                                <th class="py-3 px-4 text-center w-28">Nilai UTS (30%)</th>
                                <th class="py-3 px-4 text-center w-28">Nilai UAS (40%)</th>
                                <th class="py-3 px-4 text-center w-28">Nilai Akhir</th>
                                <th class="py-3 px-4 text-center w-24">Predikat</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @foreach($santris as $index => $santri)
                                @php
                                    $val = $existingNilai[$santri->id] ?? null;
                                    $tugas = $val ? $val->nilai_tugas : 0;
                                    $uts = $val ? $val->nilai_uts : 0;
                                    $uas = $val ? $val->nilai_uas : 0;
                                    $akhir = $val ? $val->nilai_akhir : 0;
                                    $predikat = $val ? $val->predikat : 'D';
                                @endphp
                                <tr class="hover:bg-gray-50/80 transition" data-row-id="{{ $santri->id }}">
                                    <td class="py-3 px-4 text-center text-gray-400 font-mono">{{ $index + 1 }}</td>
                                    <td class="py-3 px-4">
                                        <span class="font-semibold text-gray-800">{{ $santri->nama_lengkap }}</span>
                                        <div class="text-[11px] text-gray-400 font-mono">NISN: {{ $santri->nisn ?? '-' }}</div>
                                    </td>
                                    <td class="py-3 px-4">
                                        <input type="number" step="0.1" min="0" max="100"
                                               name="nilai[{{ $santri->id }}][tugas]"
                                               value="{{ $tugas }}"
                                               class="w-full text-center font-mono font-bold border border-gray-300 rounded-xl px-2 py-1.5 text-sm focus:ring-2 focus:ring-emerald-500 outline-none input-tugas"
                                               oninput="calcRow('{{ $santri->id }}')">
                                    </td>
                                    <td class="py-3 px-4">
                                        <input type="number" step="0.1" min="0" max="100"
                                               name="nilai[{{ $santri->id }}][uts]"
                                               value="{{ $uts }}"
                                               class="w-full text-center font-mono font-bold border border-gray-300 rounded-xl px-2 py-1.5 text-sm focus:ring-2 focus:ring-emerald-500 outline-none input-uts"
                                               oninput="calcRow('{{ $santri->id }}')">
                                    </td>
                                    <td class="py-3 px-4">
                                        <input type="number" step="0.1" min="0" max="100"
                                               name="nilai[{{ $santri->id }}][uas]"
                                               value="{{ $uas }}"
                                               class="w-full text-center font-mono font-bold border border-gray-300 rounded-xl px-2 py-1.5 text-sm focus:ring-2 focus:ring-emerald-500 outline-none input-uas"
                                               oninput="calcRow('{{ $santri->id }}')">
                                    </td>
                                    <td class="py-3 px-4 text-center font-mono font-bold text-base text-emerald-700 label-akhir">
                                        {{ $akhir }}
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <span class="px-3 py-1 font-bold text-xs rounded-lg label-predikat
                                            {{ $predikat == 'A' ? 'bg-green-100 text-green-800' : ($predikat == 'B' ? 'bg-blue-100 text-blue-800' : ($predikat == 'C' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800')) }}">
                                            {{ $predikat }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Footer Simpan -->
                <div class="p-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                    <span class="text-xs text-gray-500">Pastikan seluruh nilai telah dimasukkan dengan benar sebelum menyimpan.</span>
                    <button type="submit"
                            class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm rounded-xl shadow-md shadow-emerald-600/20 transition flex items-center gap-2">
                        <span class="iconify text-xl" data-icon="mdi:content-save"></span>
                        <span>Simpan Seluruh Nilai</span>
                    </button>
                </div>
            </div>
        </form>
    @else
        <div class="bg-white rounded-2xl border border-gray-200 p-12 text-center text-gray-400 shadow-sm">
            <span class="iconify text-5xl mx-auto mb-2 text-gray-300" data-icon="mdi:account-off-outline"></span>
            <p class="text-base font-semibold">Tidak ada santri di kelas ini.</p>
            <p class="text-xs text-gray-400 mt-1">Silakan pilih kelas lain atau hubungi administrator untuk penempatan rombel santri.</p>
        </div>
    @endif

</div>

<script>
    function calcRow(santriId) {
        const row = document.querySelector(`tr[data-row-id="${santriId}"]`);
        if (!row) return;

        const tugas = parseFloat(row.querySelector('.input-tugas').value) || 0;
        const uts = parseFloat(row.querySelector('.input-uts').value) || 0;
        const uas = parseFloat(row.querySelector('.input-uas').value) || 0;

        const akhir = (tugas * 0.3) + (uts * 0.3) + (uas * 0.4);
        const fixedAkhir = akhir.toFixed(1);

        let predikat = 'D';
        let badgeClass = 'bg-red-100 text-red-800';

        if (akhir >= 85) {
            predikat = 'A';
            badgeClass = 'bg-green-100 text-green-800';
        } else if (akhir >= 75) {
            predikat = 'B';
            badgeClass = 'bg-blue-100 text-blue-800';
        } else if (akhir >= 60) {
            predikat = 'C';
            badgeClass = 'bg-yellow-100 text-yellow-800';
        }

        row.querySelector('.label-akhir').innerText = fixedAkhir;

        const predLabel = row.querySelector('.label-predikat');
        predLabel.innerText = predikat;
        predLabel.className = `px-3 py-1 font-bold text-xs rounded-lg label-predikat ${badgeClass}`;
    }
</script>
@endsection
