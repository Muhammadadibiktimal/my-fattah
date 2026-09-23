@extends('layouts.user')

@section('title', 'Lengkapi Data Pendaftar')

@section('content')
<div class="bg-white shadow-lg rounded-xl p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-2">Lengkapi Data Pendaftar</h1>
    <p class="text-gray-600 mb-6">Silakan isi formulir berikut untuk melengkapi data pendaftaran Anda.</p>

    <!-- Form -->
    <form action="{{ route('user.data.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Nama Lengkap -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
            <input type="text" name="nama_lengkap"
                   value="{{ old('nama_lengkap', $dataPendaftar->nama_lengkap ?? '') }}"
                   class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-500"
                   required>
            @error('nama_lengkap') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- NIK -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">NIK</label>
            <input type="text" name="nik"
                   value="{{ old('nik', $dataPendaftar->nik ?? '') }}"
                   class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-500"
                   required>
            @error('nik') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Tempat, Tanggal Lahir -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Tempat Lahir</label>
                <input type="text" name="tempat_lahir"
                       value="{{ old('tempat_lahir', $dataPendaftar->tempat_lahir ?? '') }}"
                       class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-500"
                       required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir"
                       value="{{ old('tanggal_lahir', $dataPendaftar->tanggal_lahir ?? '') }}"
                       class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-500"
                       required>
            </div>
        </div>

        <!-- Jenis Kelamin -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Jenis Kelamin</label>
            <select name="jenis_kelamin"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-500"
                    required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="Laki-laki" {{ old('jenis_kelamin', $dataPendaftar->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $dataPendaftar->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Alamat -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Alamat Lengkap</label>
            <textarea name="alamat" rows="3"
                      class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-500"
                      required>{{ old('alamat', $dataPendaftar->alamat ?? '') }}</textarea>
            @error('alamat') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Orang Tua -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Nama Ayah</label>
                <input type="text" name="nama_ayah"
                       value="{{ old('nama_ayah', $dataPendaftar->nama_ayah ?? '') }}"
                       class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-500"
                       required>
                @error('nama_ayah') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Nama Ibu</label>
                <input type="text" name="nama_ibu"
                       value="{{ old('nama_ibu', $dataPendaftar->nama_ibu ?? '') }}"
                       class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-500"
                       required>
                @error('nama_ibu') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Upload Dokumen -->
        @foreach (['kk' => 'Kartu Keluarga', 'akta' => 'Akta Kelahiran', 'ijazah' => 'Ijazah Terakhir'] as $field => $label)
            <div>
                <label class="block text-gray-700 font-medium mb-2">Upload {{ $label }}</label>
                <input type="file" name="{{ $field }}"
                       class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-200 focus:border-green-500"
                       accept="image/*,.pdf">
                @php
                    $filePath = $dataPendaftar?->$field ?? $dataPendaftar?->{'file_'.$field} ?? null;
                @endphp
                @if(!empty($filePath))
                    <p class="text-sm text-green-600 mt-1">File sudah ada:
                        <a href="{{ asset('storage/'.$filePath) }}" target="_blank" class="underline hover:text-green-700">Lihat {{ $label }}</a>
                    </p>
                @endif
                @error($field) <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        @endforeach

        <!-- Tombol Submit -->
        <div class="pt-4">
            <button type="submit"
                    class="bg-green-600 text-white px-6 py-2 rounded-lg shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400 transition">
                Simpan Data
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#16a34a'
    });
</script>
@endif
@endsection
