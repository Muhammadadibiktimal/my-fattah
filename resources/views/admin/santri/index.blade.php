@extends('admin.layouts.app')

@section('title', 'Kelola Data Santri Aktif')

@section('content')
<div class="space-y-6" x-data="{ activeTab: 'smp' }">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <span class="iconify text-green-600 text-3xl" data-icon="mdi:account-school-outline"></span>
                <span>Data Santri & Siswa Aktif</span>
            </h2>
            <p class="text-sm text-gray-500 mt-1">Data seluruh santri terpisah per jenjang (SMP, SMA, dan SMK).</p>
        </div>

        <button onclick="document.getElementById('modalTambahSantri').classList.remove('hidden')"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-xl text-sm font-bold shadow-md shadow-green-600/20 transition">
            <span class="iconify text-lg" data-icon="mdi:plus-circle"></span>
            <span>+ Tambah Santri Baru</span>
        </button>
    </div>

    <!-- Alert Kredensial Akun -->
    @if(session('akun_created'))
        <div class="bg-emerald-50 border-2 border-emerald-500 rounded-2xl p-5 shadow-md">
            <div class="flex items-start gap-4">
                <div class="p-2 bg-emerald-500 text-white rounded-xl">
                    <span class="iconify text-2xl" data-icon="mdi:key-variant"></span>
                </div>
                <div>
                    <h4 class="text-base font-bold text-emerald-900">🎉 Akun Login Santri Berhasil Disimpan!</h4>
                    <p class="text-xs text-emerald-700 mt-0.5">Kredensial login berikut dapat langsung diberikan kepada santri/wali santri:</p>
                    <div class="mt-2 bg-white p-3 rounded-lg border border-emerald-200 font-mono text-xs space-y-1">
                        <div><strong>Nama :</strong> {{ session('akun_created')['nama'] }}</div>
                        <div><strong>Email:</strong> <span class="text-blue-600 font-bold select-all">{{ session('akun_created')['email'] }}</span></div>
                        <div><strong>Password:</strong> <span class="text-red-600 font-bold select-all">{{ session('akun_created')['password'] }}</span></div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="p-3 bg-green-100 text-green-800 rounded-xl border border-green-200 text-sm font-medium">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- 3 TAB MENU SANTRI (SMP, SMA, SMK) -->
    <div class="flex border-b border-gray-200 space-x-2 bg-gray-100/60 p-1.5 rounded-2xl">
        <button @click="activeTab = 'smp'"
                :class="activeTab === 'smp' ? 'bg-white text-green-800 shadow font-bold' : 'text-gray-500 hover:text-gray-800 font-medium'"
                class="flex-1 py-3 px-4 rounded-xl text-sm transition flex items-center justify-center gap-2">
            <span class="iconify text-xl text-blue-600" data-icon="mdi:account-school"></span>
            <span>1. Santri SMP</span>
        </button>

        <button @click="activeTab = 'sma'"
                :class="activeTab === 'sma' ? 'bg-white text-green-800 shadow font-bold' : 'text-gray-500 hover:text-gray-800 font-medium'"
                class="flex-1 py-3 px-4 rounded-xl text-sm transition flex items-center justify-center gap-2">
            <span class="iconify text-xl text-amber-600" data-icon="mdi:school"></span>
            <span>2. Santri SMA</span>
        </button>

        <button @click="activeTab = 'smk'"
                :class="activeTab === 'smk' ? 'bg-white text-green-800 shadow font-bold' : 'text-gray-500 hover:text-gray-800 font-medium'"
                class="flex-1 py-3 px-4 rounded-xl text-sm transition flex items-center justify-center gap-2">
            <span class="iconify text-xl text-purple-600" data-icon="mdi:laptop"></span>
            <span>3. Santri SMK (Jurusan)</span>
        </button>
    </div>

    <!-- TAB 1: SANTRI SMP -->
    <div x-show="activeTab === 'smp'" class="space-y-4">
        <div class="bg-blue-50/60 border border-blue-200 p-4 rounded-2xl flex items-center justify-between">
            <div class="flex items-center gap-2 text-xs font-bold text-blue-900">
                <span class="iconify text-lg text-blue-600" data-icon="mdi:information-outline"></span>
                <span>Daftar Santri Aktif Jenjang SMP (Tingkat 7, 8, 9)</span>
            </div>
            <span class="px-2.5 py-0.5 bg-blue-200 text-blue-800 rounded-full text-xs font-black">
                {{ $santris->filter(fn($s) => ($s->kelas && $s->kelas->jenjang == 'SMP') || $s->jenjang == 'SMP')->count() }} Santri
            </span>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200 text-gray-600 font-bold uppercase text-xs">
                        <tr>
                            <th class="py-3.5 px-4">NISN</th>
                            <th class="py-3.5 px-4">Nama Lengkap</th>
                            <th class="py-3.5 px-4">Kelas</th>
                            <th class="py-3.5 px-4">Gender</th>
                            <th class="py-3.5 px-4 text-center">Akun Portal</th>
                            <th class="py-3.5 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($santris->filter(fn($s) => ($s->kelas && $s->kelas->jenjang == 'SMP') || $s->jenjang == 'SMP') as $s)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4 font-mono font-semibold text-gray-700">{{ $s->nisn ?? '-' }}</td>
                                <td class="py-3 px-4 font-semibold text-gray-900">
                                    <div class="font-bold text-sm text-gray-900">{{ $s->nama_lengkap }}</div>
                                    @if($s->user)
                                        <div class="text-[11px] text-emerald-700 font-normal flex items-center gap-1 mt-0.5">
                                            <span class="iconify text-xs" data-icon="mdi:email"></span>
                                            <span class="font-mono">{{ $s->user->email }}</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <span class="px-2.5 py-1 bg-blue-50 text-blue-800 font-bold rounded-lg text-xs border border-blue-200">
                                        {{ $s->kelas ? 'Kelas ' . $s->kelas->nama_kelas : 'Belum Ditentukan' }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-gray-600">{{ $s->jenis_kelamin }}</td>
                                <td class="py-3 px-4 text-center">
                                    @if($s->user)
                                        <button type="button" onclick="openModalSetPassword('{{ $s->id }}', '{{ addslashes($s->nama_lengkap) }}', '{{ $s->user->email }}')"
                                                class="px-2 py-0.5 bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-300 rounded-lg text-[11px] font-bold transition">
                                            Reset Password
                                        </button>
                                    @else
                                        <button type="button" onclick="openModalSetPassword('{{ $s->id }}', '{{ addslashes($s->nama_lengkap) }}', '')"
                                                class="px-2.5 py-1 bg-emerald-50 text-emerald-800 border border-emerald-300 rounded-lg text-xs font-bold transition">
                                            + Akun
                                        </button>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <form action="{{ route('admin.santri.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Hapus data santri?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-xs font-bold transition">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center py-8 text-gray-400 italic">Belum ada data santri SMP.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- TAB 2: SANTRI SMA -->
    <div x-show="activeTab === 'sma'" class="space-y-4" style="display: none;">
        <div class="bg-amber-50/60 border border-amber-200 p-4 rounded-2xl flex items-center justify-between">
            <div class="flex items-center gap-2 text-xs font-bold text-amber-900">
                <span class="iconify text-lg text-amber-600" data-icon="mdi:information-outline"></span>
                <span>Daftar Santri Aktif Jenjang SMA (Tingkat 10, 11, 12)</span>
            </div>
            <span class="px-2.5 py-0.5 bg-amber-200 text-amber-800 rounded-full text-xs font-black">
                {{ $santris->filter(fn($s) => ($s->kelas && $s->kelas->jenjang == 'SMA') || $s->jenjang == 'SMA')->count() }} Santri
            </span>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200 text-gray-600 font-bold uppercase text-xs">
                        <tr>
                            <th class="py-3.5 px-4">NISN</th>
                            <th class="py-3.5 px-4">Nama Lengkap</th>
                            <th class="py-3.5 px-4">Kelas</th>
                            <th class="py-3.5 px-4">Gender</th>
                            <th class="py-3.5 px-4 text-center">Akun Portal</th>
                            <th class="py-3.5 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($santris->filter(fn($s) => ($s->kelas && $s->kelas->jenjang == 'SMA') || $s->jenjang == 'SMA') as $s)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4 font-mono font-semibold text-gray-700">{{ $s->nisn ?? '-' }}</td>
                                <td class="py-3 px-4 font-semibold text-gray-900">
                                    <div class="font-bold text-sm text-gray-900">{{ $s->nama_lengkap }}</div>
                                    @if($s->user)
                                        <div class="text-[11px] text-emerald-700 font-normal flex items-center gap-1 mt-0.5">
                                            <span class="iconify text-xs" data-icon="mdi:email"></span>
                                            <span class="font-mono">{{ $s->user->email }}</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <span class="px-2.5 py-1 bg-amber-50 text-amber-800 font-bold rounded-lg text-xs border border-amber-200">
                                        {{ $s->kelas ? 'Kelas ' . $s->kelas->nama_kelas : 'Belum Ditentukan' }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-gray-600">{{ $s->jenis_kelamin }}</td>
                                <td class="py-3 px-4 text-center">
                                    @if($s->user)
                                        <button type="button" onclick="openModalSetPassword('{{ $s->id }}', '{{ addslashes($s->nama_lengkap) }}', '{{ $s->user->email }}')"
                                                class="px-2 py-0.5 bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-300 rounded-lg text-[11px] font-bold transition">
                                            Reset Password
                                        </button>
                                    @else
                                        <button type="button" onclick="openModalSetPassword('{{ $s->id }}', '{{ addslashes($s->nama_lengkap) }}', '')"
                                                class="px-2.5 py-1 bg-emerald-50 text-emerald-800 border border-emerald-300 rounded-lg text-xs font-bold transition">
                                            + Akun
                                        </button>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <form action="{{ route('admin.santri.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Hapus data santri?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-xs font-bold transition">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center py-8 text-gray-400 italic">Belum ada data santri SMA.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- TAB 3: SANTRI SMK -->
    <div x-show="activeTab === 'smk'" class="space-y-4" style="display: none;">
        <div class="bg-purple-50/60 border border-purple-200 p-4 rounded-2xl flex items-center justify-between">
            <div class="flex items-center gap-2 text-xs font-bold text-purple-900">
                <span class="iconify text-lg text-purple-600" data-icon="mdi:information-outline"></span>
                <span>Daftar Santri Aktif Jenjang SMK (Jurusan RPL, TKJ, dll)</span>
            </div>
            <span class="px-2.5 py-0.5 bg-purple-200 text-purple-800 rounded-full text-xs font-black">
                {{ $santris->filter(fn($s) => ($s->kelas && $s->kelas->jenjang == 'SMK') || $s->jenjang == 'SMK')->count() }} Santri
            </span>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200 text-gray-600 font-bold uppercase text-xs">
                        <tr>
                            <th class="py-3.5 px-4">NISN</th>
                            <th class="py-3.5 px-4">Nama Lengkap</th>
                            <th class="py-3.5 px-4">Kelas & Jurusan</th>
                            <th class="py-3.5 px-4">Gender</th>
                            <th class="py-3.5 px-4 text-center">Akun Portal</th>
                            <th class="py-3.5 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($santris->filter(fn($s) => ($s->kelas && $s->kelas->jenjang == 'SMK') || $s->jenjang == 'SMK') as $s)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4 font-mono font-semibold text-gray-700">{{ $s->nisn ?? '-' }}</td>
                                <td class="py-3 px-4 font-semibold text-gray-900">
                                    <div class="font-bold text-sm text-gray-900">{{ $s->nama_lengkap }}</div>
                                    @if($s->user)
                                        <div class="text-[11px] text-emerald-700 font-normal flex items-center gap-1 mt-0.5">
                                            <span class="iconify text-xs" data-icon="mdi:email"></span>
                                            <span class="font-mono">{{ $s->user->email }}</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <span class="px-2.5 py-1 bg-purple-50 text-purple-800 font-bold rounded-lg text-xs border border-purple-200">
                                        {{ $s->kelas ? 'Kelas ' . $s->kelas->nama_kelas : 'Belum Ditentukan' }}
                                    </span>
                                    <span class="ml-1 text-xs font-bold text-purple-900">
                                        ({{ $s->jurusan ?? $s->kelas?->jurusan ?? 'SMK' }})
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-gray-600">{{ $s->jenis_kelamin }}</td>
                                <td class="py-3 px-4 text-center">
                                    @if($s->user)
                                        <button type="button" onclick="openModalSetPassword('{{ $s->id }}', '{{ addslashes($s->nama_lengkap) }}', '{{ $s->user->email }}')"
                                                class="px-2 py-0.5 bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-300 rounded-lg text-[11px] font-bold transition">
                                            Reset Password
                                        </button>
                                    @else
                                        <button type="button" onclick="openModalSetPassword('{{ $s->id }}', '{{ addslashes($s->nama_lengkap) }}', '')"
                                                class="px-2.5 py-1 bg-emerald-50 text-emerald-800 border border-emerald-300 rounded-lg text-xs font-bold transition">
                                            + Akun
                                        </button>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <form action="{{ route('admin.santri.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Hapus data santri?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-xs font-bold transition">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center py-8 text-gray-400 italic">Belum ada data santri SMK.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- 1. Modal Tambah Santri Baru -->
<div id="modalTambahSantri" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-gray-100 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4 pb-3 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-800">Tambah Data Santri Baru</h3>
            <button onclick="document.getElementById('modalTambahSantri').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <span class="iconify text-2xl" data-icon="mdi:close"></span>
            </button>
        </div>

        <form action="{{ route('admin.santri.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Nama Lengkap Santri</label>
                <input type="text" name="nama_lengkap" required class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-green-500" placeholder="Nama lengkap siswa/santri">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-600 mb-1">NISN (Opsional)</label>
                    <input type="text" name="nisn" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-green-500" placeholder="Nomor Induk Siswa">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Kelas / Rombel</label>
                    <select name="kelas_id" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">Pilih Kelas</option>
                        @foreach($kelasList as $k)
                            <option value="{{ $k->id }}">Kelas {{ $k->nama_kelas }} ({{ $k->jenjang }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-green-500">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-600 mb-1">No. HP / WA</label>
                    <input type="text" name="no_hp" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-green-500" placeholder="08xxxxxxxx">
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('modalTambahSantri').classList.add('hidden')"
                        class="px-4 py-2 border border-gray-300 text-gray-600 rounded-xl text-xs font-semibold hover:bg-gray-50">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 bg-green-600 text-white rounded-xl text-xs font-bold hover:bg-green-700 transition shadow-sm">
                    Simpan Santri
                </button>
            </div>
        </form>
    </div>
</div>

<!-- 2. Modal Atur / Reset Password Santri -->
<div id="modalSetPasswordSantri" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-gray-100">
        <div class="flex justify-between items-center mb-4 pb-3 border-b border-gray-100">
            <h3 class="text-base font-bold text-gray-800 flex items-center gap-2">
                <span class="iconify text-emerald-600 text-xl" data-icon="mdi:key-outline"></span>
                <span>Atur Akun & Password Santri</span>
            </h3>
            <button onclick="document.getElementById('modalSetPasswordSantri').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <span class="iconify text-2xl" data-icon="mdi:close"></span>
            </button>
        </div>

        <form id="formSetPasswordSantri" method="POST" action="" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Nama Santri</label>
                <input type="text" id="setSantriNama" readonly class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 text-xs font-bold text-gray-700 outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Alamat Email Login</label>
                <input type="email" name="email" id="setSantriEmail" required class="w-full border border-gray-300 rounded-xl px-3 py-2 text-xs outline-none focus:ring-2 focus:ring-emerald-500" placeholder="email@gmail.com">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Password Baru</label>
                <input type="text" name="password" id="setSantriPassword" required class="w-full border border-gray-300 rounded-xl px-3 py-2 text-xs font-mono outline-none focus:ring-2 focus:ring-emerald-500" placeholder="Masukkan password baru">
            </div>

            <div class="flex justify-end gap-2 pt-2 border-t border-gray-100">
                <button type="button" onclick="document.getElementById('modalSetPasswordSantri').classList.add('hidden')"
                        class="px-4 py-2 border border-gray-300 text-gray-600 rounded-xl text-xs font-semibold hover:bg-gray-50">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 bg-emerald-600 text-white rounded-xl text-xs font-bold hover:bg-emerald-700 transition shadow-sm">
                    Simpan Password
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModalSetPassword(santriId, santriNama, email) {
        document.getElementById('setSantriNama').value = santriNama;
        document.getElementById('setSantriEmail').value = email || (santriNama.toLowerCase().replace(/\s+/g, '') + '@santri.alfattah.sch.id');
        document.getElementById('setSantriPassword').value = 'Santri@1234';
        
        const form = document.getElementById('formSetPasswordSantri');
        form.action = "{{ url('admin/santri') }}/" + santriId + "/account";
        
        document.getElementById('modalSetPasswordSantri').classList.remove('hidden');
    }
</script>
@endsection
