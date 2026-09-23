@extends('admin.layouts.app')

@section('title', 'Kelola Data Kelas')

@section('content')
<div class="space-y-6" x-data="{ activeTab: 'smp' }">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <span class="iconify text-green-600 text-3xl" data-icon="mdi:google-classroom"></span>
                <span>Data Rombongan Belajar (Kelas)</span>
            </h2>
            <p class="text-sm text-gray-500 mt-1">Daftar kelas santri terpisah per jenjang (SMP, SMA, dan SMK) untuk pembagian rombel.</p>
        </div>

        <button onclick="document.getElementById('modalTambahKelas').classList.remove('hidden')"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-xl text-sm font-bold shadow-md shadow-green-600/20 transition">
            <span class="iconify text-lg" data-icon="mdi:plus-circle"></span>
            <span>+ Tambah Kelas Baru</span>
        </button>
    </div>

    @if(session('success'))
        <div class="p-3 bg-green-100 text-green-800 rounded-xl border border-green-200 text-sm font-medium">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- 3 TAB MENU KELAS (SMP, SMA, SMK) -->
    <div class="flex border-b border-gray-200 space-x-2 bg-gray-100/60 p-1.5 rounded-2xl">
        <button @click="activeTab = 'smp'"
                :class="activeTab === 'smp' ? 'bg-white text-green-800 shadow font-bold' : 'text-gray-500 hover:text-gray-800 font-medium'"
                class="flex-1 py-3 px-4 rounded-xl text-sm transition flex items-center justify-center gap-2">
            <span class="iconify text-xl text-blue-600" data-icon="mdi:school-outline"></span>
            <span>1. Kelas SMP</span>
        </button>

        <button @click="activeTab = 'sma'"
                :class="activeTab === 'sma' ? 'bg-white text-green-800 shadow font-bold' : 'text-gray-500 hover:text-gray-800 font-medium'"
                class="flex-1 py-3 px-4 rounded-xl text-sm transition flex items-center justify-center gap-2">
            <span class="iconify text-xl text-amber-600" data-icon="mdi:school"></span>
            <span>2. Kelas SMA</span>
        </button>

        <button @click="activeTab = 'smk'"
                :class="activeTab === 'smk' ? 'bg-white text-green-800 shadow font-bold' : 'text-gray-500 hover:text-gray-800 font-medium'"
                class="flex-1 py-3 px-4 rounded-xl text-sm transition flex items-center justify-center gap-2">
            <span class="iconify text-xl text-purple-600" data-icon="mdi:laptop"></span>
            <span>3. Kelas SMK (Kejuruan)</span>
        </button>
    </div>

    <!-- TAB 1: KELAS SMP -->
    <div x-show="activeTab === 'smp'" class="space-y-4">
        <div class="bg-blue-50/60 border border-blue-200 p-4 rounded-2xl flex items-center justify-between">
            <div class="flex items-center gap-2 text-xs font-bold text-blue-900">
                <span class="iconify text-lg text-blue-600" data-icon="mdi:information-outline"></span>
                <span>Daftar Rombongan Belajar Tingkat SMP (Tingkat 7, 8, 9)</span>
            </div>
            <span class="px-2.5 py-0.5 bg-blue-200 text-blue-800 rounded-full text-xs font-black">
                {{ $kelasList->where('jenjang', 'SMP')->count() }} Rombel
            </span>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50 text-gray-700 font-semibold uppercase text-xs">
                        <tr>
                            <th class="py-3.5 px-4 text-left">Nama Kelas</th>
                            <th class="py-3.5 px-4 text-left">Tingkat</th>
                            <th class="py-3.5 px-4 text-left">Wali Kelas</th>
                            <th class="py-3.5 px-4 text-center">Jumlah Santri</th>
                            <th class="py-3.5 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($kelasList->where('jenjang', 'SMP') as $kelas)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3.5 px-4 font-bold text-gray-900">Kelas {{ $kelas->nama_kelas }}</td>
                                <td class="py-3.5 px-4 text-gray-600">Tingkat {{ $kelas->tingkat }}</td>
                                <td class="py-3.5 px-4 text-gray-700">{{ $kelas->wali_kelas ?? '-' }}</td>
                                <td class="py-3.5 px-4 text-center">
                                    <span class="px-3 py-1 bg-blue-50 text-blue-700 font-bold rounded-full text-xs">
                                        {{ $kelas->santri_count ?? $kelas->santri()->count() }} Santri
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <form action="{{ route('admin.kelas.destroy', $kelas->id) }}" method="POST" onsubmit="return confirm('Hapus kelas ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-xs font-bold transition">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center py-8 text-gray-400 italic">Belum ada data kelas SMP.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- TAB 2: KELAS SMA -->
    <div x-show="activeTab === 'sma'" class="space-y-4" style="display: none;">
        <div class="bg-amber-50/60 border border-amber-200 p-4 rounded-2xl flex items-center justify-between">
            <div class="flex items-center gap-2 text-xs font-bold text-amber-900">
                <span class="iconify text-lg text-amber-600" data-icon="mdi:information-outline"></span>
                <span>Daftar Rombongan Belajar Tingkat SMA (Tingkat 10, 11, 12)</span>
            </div>
            <span class="px-2.5 py-0.5 bg-amber-200 text-amber-800 rounded-full text-xs font-black">
                {{ $kelasList->where('jenjang', 'SMA')->count() }} Rombel
            </span>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50 text-gray-700 font-semibold uppercase text-xs">
                        <tr>
                            <th class="py-3.5 px-4 text-left">Nama Kelas</th>
                            <th class="py-3.5 px-4 text-left">Tingkat</th>
                            <th class="py-3.5 px-4 text-left">Wali Kelas</th>
                            <th class="py-3.5 px-4 text-center">Jumlah Santri</th>
                            <th class="py-3.5 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($kelasList->where('jenjang', 'SMA') as $kelas)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3.5 px-4 font-bold text-gray-900">Kelas {{ $kelas->nama_kelas }}</td>
                                <td class="py-3.5 px-4 text-gray-600">Tingkat {{ $kelas->tingkat }}</td>
                                <td class="py-3.5 px-4 text-gray-700">{{ $kelas->wali_kelas ?? '-' }}</td>
                                <td class="py-3.5 px-4 text-center">
                                    <span class="px-3 py-1 bg-amber-50 text-amber-700 font-bold rounded-full text-xs">
                                        {{ $kelas->santri_count ?? $kelas->santri()->count() }} Santri
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <form action="{{ route('admin.kelas.destroy', $kelas->id) }}" method="POST" onsubmit="return confirm('Hapus kelas ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-xs font-bold transition">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center py-8 text-gray-400 italic">Belum ada data kelas SMA.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- TAB 3: KELAS SMK -->
    <div x-show="activeTab === 'smk'" class="space-y-4" style="display: none;">
        <div class="bg-purple-50/60 border border-purple-200 p-4 rounded-2xl flex items-center justify-between">
            <div class="flex items-center gap-2 text-xs font-bold text-purple-900">
                <span class="iconify text-lg text-purple-600" data-icon="mdi:information-outline"></span>
                <span>Daftar Rombongan Belajar Tingkat SMK (RPL, TKJ, dll)</span>
            </div>
            <span class="px-2.5 py-0.5 bg-purple-200 text-purple-800 rounded-full text-xs font-black">
                {{ $kelasList->where('jenjang', 'SMK')->count() }} Rombel
            </span>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50 text-gray-700 font-semibold uppercase text-xs">
                        <tr>
                            <th class="py-3.5 px-4 text-left">Nama Kelas</th>
                            <th class="py-3.5 px-4 text-left">Konsentrasi Jurusan</th>
                            <th class="py-3.5 px-4 text-left">Wali Kelas</th>
                            <th class="py-3.5 px-4 text-center">Jumlah Santri</th>
                            <th class="py-3.5 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($kelasList->where('jenjang', 'SMK') as $kelas)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3.5 px-4 font-bold text-gray-900">Kelas {{ $kelas->nama_kelas }}</td>
                                <td class="py-3.5 px-4 font-bold text-purple-800">
                                    <span class="px-2.5 py-1 bg-purple-100 text-purple-800 rounded-full text-xs">
                                        {{ $kelas->jurusan ?? 'Umum SMK' }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-gray-700">{{ $kelas->wali_kelas ?? '-' }}</td>
                                <td class="py-3.5 px-4 text-center">
                                    <span class="px-3 py-1 bg-purple-50 text-purple-700 font-bold rounded-full text-xs">
                                        {{ $kelas->santri_count ?? $kelas->santri()->count() }} Santri
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <form action="{{ route('admin.kelas.destroy', $kelas->id) }}" method="POST" onsubmit="return confirm('Hapus kelas ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-xs font-bold transition">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center py-8 text-gray-400 italic">Belum ada data kelas SMK.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Modal Tambah Kelas -->
<div id="modalTambahKelas" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-gray-100">
        <div class="flex justify-between items-center mb-4 pb-3 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-800">Tambah Kelas Baru</h3>
            <button onclick="document.getElementById('modalTambahKelas').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <span class="iconify text-2xl" data-icon="mdi:close"></span>
            </button>
        </div>

        <form action="{{ route('admin.kelas.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Nama Rombel / Kelas</label>
                <input type="text" name="nama_kelas" placeholder="contoh: 7A, 10-IPA, 10-RPL" required class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Jenjang</label>
                    <select name="jenjang" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-green-500">
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                        <option value="SMK">SMK</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Tingkat (7 - 12)</label>
                    <input type="text" name="tingkat" placeholder="contoh: 7, 10, 11" required class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-green-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Jurusan (Khusus SMK)</label>
                <input type="text" name="jurusan" placeholder="contoh: RPL, TKJ (Kosongkan jika SMP/SMA)" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Nama Wali Kelas (Opsional)</label>
                <input type="text" name="wali_kelas" placeholder="contoh: Ustadz Ahmad, S.Pd.I" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('modalTambahKelas').classList.add('hidden')"
                        class="px-4 py-2 border border-gray-300 text-gray-600 rounded-xl text-xs font-semibold hover:bg-gray-50">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 bg-green-600 text-white rounded-xl text-xs font-bold hover:bg-green-700 transition">
                    Simpan Kelas
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
