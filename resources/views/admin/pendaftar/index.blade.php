@extends('admin.layouts.app')

@section('title', 'Data Pendaftar')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h2 class="text-2xl font-bold text-gray-800">📋 Data Pendaftar</h2>
  <a href="{{ route('admin.pendaftar.create') }}"
     class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 transition-all duration-200 ease-in-out transform hover:scale-105">
     + Tambah Data
  </a>
</div>

@if(session('akun_created'))
  <div class="mb-6 p-5 bg-emerald-50 border-2 border-emerald-500 rounded-2xl shadow-md">
    <div class="flex items-start gap-4">
      <div class="p-2 bg-emerald-500 text-white rounded-xl">
        <span class="iconify text-2xl" data-icon="mdi:check-decagram"></span>
      </div>
      <div>
        <h4 class="text-base font-bold text-emerald-900">🎉 Akun Calon Santri Baru Berhasil Dibuatkan!</h4>
        <p class="text-xs text-emerald-700 mt-0.5">Silakan bagikan kredensial berikut kepada calon santri / orang tua santri:</p>
        <div class="mt-3 bg-white p-4 rounded-xl border border-emerald-200 font-mono text-xs space-y-1.5 max-w-md shadow-sm">
          <div><strong>Nama :</strong> {{ session('akun_created')['nama'] }}</div>
          <div><strong>Email:</strong> <span class="text-blue-600 font-bold select-all">{{ session('akun_created')['email'] }}</span></div>
          <div><strong>Password:</strong> <span class="text-red-600 font-bold select-all">{{ session('akun_created')['password'] }}</span></div>
          <div class="pt-2 text-[11px] text-gray-400 font-sans">Santri dapat langsung login di <a href="{{ route('login') }}" target="_blank" class="text-green-600 underline">Halaman Login</a></div>
        </div>
      </div>
    </div>
  </div>
@endif

@if(session('success'))
  <div class="p-3 bg-green-100 text-green-700 rounded-xl mb-4 border border-green-300 shadow-sm font-medium">
    ✅ {{ session('success') }}
  </div>
@endif

<div class="overflow-x-auto">
  <table class="min-w-full border border-gray-200 rounded-xl overflow-hidden shadow-sm">
    <thead class="bg-green-600 text-white text-sm uppercase">
      <tr>
        <th class="py-3 px-4 text-left font-semibold">Nama Lengkap</th>
        <th class="py-3 px-4 text-left font-semibold">NIK</th>
        <th class="py-3 px-4 text-left font-semibold">Jenis Kelamin</th>
        <th class="py-3 px-4 text-left font-semibold">Status</th>
        <th class="py-3 px-4 text-center font-semibold">Aksi & Akun</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 bg-white text-sm">
      @forelse ($pendaftar as $data)
        <tr class="hover:bg-green-50 transition-colors duration-200">
          <td class="py-3 px-4 font-semibold text-gray-900">{{ $data->nama_lengkap ?? $data->nama }}</td>
          <td class="py-3 px-4 font-mono">{{ $data->nik ?? '-' }}</td>
          <td class="py-3 px-4">{{ $data->jenis_kelamin ?? '-' }}</td>
          <td class="py-3 px-4">
            @php $st = $data->status ?? $data->status_bayar ?? 'Pending'; @endphp
            <span class="px-3 py-1 text-xs font-semibold rounded-full
              {{ $st == 'Pending' || $st == 'pending'
                ? 'bg-yellow-100 text-yellow-700 border border-yellow-300'
                : ($st == 'Terverifikasi' || $st == 'settlement'
                  ? 'bg-green-100 text-green-700 border border-green-300'
                  : 'bg-red-100 text-red-700 border border-red-300') }}">
              {{ ucfirst($st) }}
            </span>
          </td>
          <td class="py-3 px-4 text-center">
            <div class="flex justify-center items-center gap-1.5 flex-wrap">
              <!-- Tombol Detail Lengkap -->
              <a href="{{ route('admin.pendaftar.show', $data->id) }}"
                 class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-gray-800 text-white text-xs font-semibold rounded-lg hover:bg-black transition shadow-sm">
                 <span class="iconify" data-icon="mdi:eye"></span> Detail
              </a>

              <!-- Tombol Buatkan Akun Santri -->
              <form action="{{ route('admin.pendaftar.buatAkun', $data->id) }}" method="POST"
                    onsubmit="return confirm('Buatkan akun login santri baru untuk {{ $data->nama_lengkap ?? $data->nama }}?')">
                @csrf
                <button type="submit"
                        class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-emerald-600 text-white text-xs font-bold rounded-lg hover:bg-emerald-700 transition shadow-sm">
                  <span class="iconify" data-icon="mdi:account-plus"></span>
                  Buatkan Akun
                </button>
              </form>

              <form action="{{ route('admin.pendaftar.destroy', $data->id) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center px-2.5 py-1.5 bg-red-600 text-white text-xs font-semibold rounded-lg hover:bg-red-700 transition shadow-sm">
                        🗑️ Hapus
                </button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5" class="py-4 text-center text-gray-500 italic">
            Belum ada data pendaftar.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
