@extends('guru.layouts.app')

@section('title', 'Input Absensi Siswa/Santri')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <span class="iconify text-emerald-600 text-3xl" data-icon="mdi:calendar-check"></span>
                <span>Input Absensi Harian Santri</span>
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Catat presensi kehadiran santri (Hadir, Izin, Sakit, Alpa). Gunakan tombol cepat "Set Semua Hadir" untuk efisiensi.
            </p>
        </div>

        @if($santris->isNotEmpty())
            <button type="button" onclick="setSemuaHadir()"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-100 hover:bg-emerald-200 text-emerald-800 font-bold text-xs rounded-xl transition shadow-sm">
                <span class="iconify text-lg" data-icon="mdi:check-all"></span>
                <span>Set Semua Hadir (Otomatis)</span>
            </button>
        @endif
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-300 text-emerald-800 rounded-2xl flex items-center gap-2 font-medium">
            <span class="iconify text-xl" data-icon="mdi:check-circle"></span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Filter Form -->
    <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
        <form method="GET" action="{{ route('guru.absensi.index') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end">
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

            <!-- Pilih Tanggal -->
            <div>
                <label class="block text-xs font-bold uppercase text-gray-500 mb-1.5">Tanggal Presensi</label>
                <input type="date" name="tanggal" value="{{ $tanggal }}"
                       class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-emerald-500">
            </div>

            <div>
                <button type="submit"
                        class="w-full py-2.5 bg-gray-800 hover:bg-gray-900 text-white font-bold text-xs rounded-xl transition flex items-center justify-center gap-1">
                    <span class="iconify text-base" data-icon="mdi:calendar-search"></span>
                    <span>Tampilkan Absensi</span>
                </button>
            </div>
        </form>
    </div>

    @if($selectedKelas)
        <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-4 flex items-center justify-between">
            <span class="font-bold text-emerald-950 text-sm">
                Presensi Kelas {{ $selectedKelas->nama_kelas }} • Tanggal: {{ date('d F Y', strtotime($tanggal)) }}
            </span>
            <span class="text-xs text-emerald-800 font-semibold">{{ $santris->count() }} Santri</span>
        </div>
    @endif

    <!-- Form Absensi Santri -->
    @if($santris->isNotEmpty())
        <form action="{{ route('guru.absensi.store') }}" method="POST">
            @csrf
            <input type="hidden" name="kelas_id" value="{{ $kelasId }}">
            <input type="hidden" name="tanggal" value="{{ $tanggal }}">

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50 text-gray-700 font-semibold uppercase text-xs">
                            <tr>
                                <th class="py-3 px-4 text-center w-12">#</th>
                                <th class="py-3 px-4 text-left">Nama Santri</th>
                                <th class="py-3 px-4 text-center">Status Kehadiran</th>
                                <th class="py-3 px-4 text-left w-64">Catatan / Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @foreach($santris as $index => $santri)
                                @php
                                    $rec = $existingAbsensi[$santri->id] ?? null;
                                    $currentStatus = $rec ? $rec->status : 'Hadir';
                                    $currentKet = $rec ? $rec->keterangan : '';
                                @endphp
                                <tr class="hover:bg-gray-50/80 transition">
                                    <td class="py-3.5 px-4 text-center text-gray-400 font-mono">{{ $index + 1 }}</td>
                                    <td class="py-3.5 px-4">
                                        <span class="font-semibold text-gray-800">{{ $santri->nama_lengkap }}</span>
                                        <div class="text-[11px] text-gray-400 font-mono">NISN: {{ $santri->nisn ?? '-' }}</div>
                                    </td>
                                    <td class="py-3.5 px-4 text-center">
                                        <div class="inline-flex items-center gap-3">
                                            <!-- Hadir -->
                                            <label class="flex items-center gap-1 cursor-pointer">
                                                <input type="radio" name="absensi[{{ $santri->id }}][status]" value="Hadir"
                                                       {{ $currentStatus == 'Hadir' ? 'checked' : '' }}
                                                       class="radio-hadir text-green-600 focus:ring-green-500 w-4 h-4">
                                                <span class="text-xs font-bold text-green-700">Hadir</span>
                                            </label>

                                            <!-- Izin -->
                                            <label class="flex items-center gap-1 cursor-pointer">
                                                <input type="radio" name="absensi[{{ $santri->id }}][status]" value="Izin"
                                                       {{ $currentStatus == 'Izin' ? 'checked' : '' }}
                                                       class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                                                <span class="text-xs font-bold text-blue-700">Izin</span>
                                            </label>

                                            <!-- Sakit -->
                                            <label class="flex items-center gap-1 cursor-pointer">
                                                <input type="radio" name="absensi[{{ $santri->id }}][status]" value="Sakit"
                                                       {{ $currentStatus == 'Sakit' ? 'checked' : '' }}
                                                       class="text-yellow-600 focus:ring-yellow-500 w-4 h-4">
                                                <span class="text-xs font-bold text-yellow-700">Sakit</span>
                                            </label>

                                            <!-- Alpa -->
                                            <label class="flex items-center gap-1 cursor-pointer">
                                                <input type="radio" name="absensi[{{ $santri->id }}][status]" value="Alpa"
                                                       {{ $currentStatus == 'Alpa' ? 'checked' : '' }}
                                                       class="text-red-600 focus:ring-red-500 w-4 h-4">
                                                <span class="text-xs font-bold text-red-700">Alpa</span>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <input type="text" name="absensi[{{ $santri->id }}][keterangan]"
                                               value="{{ $currentKet }}"
                                               placeholder="Contoh: Sakit demam, Izin ada acara..."
                                               class="w-full border border-gray-300 rounded-xl px-3 py-1.5 text-xs outline-none focus:ring-2 focus:ring-emerald-500">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Footer Simpan -->
                <div class="p-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                    <span class="text-xs text-gray-500">Simpan absensi untuk mencatat presensi harian pada tanggal ini.</span>
                    <button type="submit"
                            class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm rounded-xl shadow-md shadow-emerald-600/20 transition flex items-center gap-2">
                        <span class="iconify text-xl" data-icon="mdi:content-save"></span>
                        <span>Simpan Absensi Harian</span>
                    </button>
                </div>
            </div>
        </form>
    @else
        <div class="bg-white rounded-2xl border border-gray-200 p-12 text-center text-gray-400 shadow-sm">
            <span class="iconify text-5xl mx-auto mb-2 text-gray-300" data-icon="mdi:account-off-outline"></span>
            <p class="text-base font-semibold">Tidak ada santri di kelas ini.</p>
        </div>
    @endif

</div>

<script>
    function setSemuaHadir() {
        document.querySelectorAll('.radio-hadir').forEach(radio => {
            radio.checked = true;
        });
    }
</script>
@endsection
