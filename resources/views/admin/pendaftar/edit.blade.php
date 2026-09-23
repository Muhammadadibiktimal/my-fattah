@extends('admin.layouts.app')

@section('title', 'Edit Data Pendaftar')

@section('content')
<div class="max-w-5xl mx-auto bg-white shadow-sm rounded-xl p-8 border border-gray-200">
  <h2 class="text-2xl font-bold text-gray-800 mb-6">✏️ Edit Data Pendaftar</h2>

  <form action="{{ route('admin.pendaftar.update', $pendaftar->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="grid md:grid-cols-2 gap-6">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" value="{{ $pendaftar->nama_lengkap }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
        <input type="text" name="nik" value="{{ $pendaftar->nik }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
        <input type="text" name="tempat_lahir" value="{{ $pendaftar->tempat_lahir }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" value="{{ $pendaftar->tanggal_lahir }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
        <select name="jenis_kelamin" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
          <option value="Laki-laki" {{ $pendaftar->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
          <option value="Perempuan" {{ $pendaftar->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
      </div>

      <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
        <textarea name="alamat" rows="2" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">{{ $pendaftar->alamat }}</textarea>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ayah</label>
        <input type="text" name="nama_ayah" value="{{ $pendaftar->nama_ayah }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ibu</label>
        <input type="text" name="nama_ibu" value="{{ $pendaftar->nama_ibu }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
      </div>

      <!-- Nomor KK -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor KK</label>
        <input type="file" name="kk" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
        @if($pendaftar->kk)
          <div class="mt-2">
            <p class="text-xs text-gray-500">Preview:</p>
            <img src="{{ asset('storage/' . $pendaftar->kk) }}" alt="KK" class="h-32 rounded-lg border mt-1">
          </div>
        @endif
      </div>

      <!-- Nomor Akta -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Akta</label>
        <input type="file" name="akta" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
        @if($pendaftar->akta)
          <div class="mt-2">
            <p class="text-xs text-gray-500">Preview:</p>
            <img src="{{ asset('storage/' . $pendaftar->akta) }}" alt="Akta" class="h-32 rounded-lg border mt-1">
          </div>
        @endif
      </div>

      <!-- Nomor Ijazah -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Ijazah</label>
        <input type="file" name="ijazah" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
        @if($pendaftar->ijazah)
          <div class="mt-2">
            <p class="text-xs text-gray-500">Preview:</p>
            <img src="{{ asset('storage/' . $pendaftar->ijazah) }}" alt="Ijazah" class="h-32 rounded-lg border mt-1">
          </div>
        @endif
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
        <select name="status" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
          <option value="Pending" {{ $pendaftar->status == 'Pending' ? 'selected' : '' }}>Pending</option>
          <option value="Terverifikasi" {{ $pendaftar->status == 'Terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
          <option value="Ditolak" {{ $pendaftar->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
        </select>
      </div>
    </div>

    <div class="flex justify-end space-x-3">
      <a href="{{ route('admin.pendaftar.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100">Batal</a>
      <button type="submit" class="px-5 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 shadow">Perbarui</button>
    </div>
  </form>
</div>
@endsection
