@extends('admin.layouts.app')


@section('title', 'Tambah Pendaftar')

@section('content')
<div class="bg-white p-6 rounded-xl shadow border border-gray-200">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Tambah Data Pendaftar</h2>

    <form action="{{ route('admin.pendaftar.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="w-full p-2 border rounded-lg" required>
            </div>
            <div>
                <label class="block font-medium text-gray-700">NIK</label>
                <input type="text" name="nik" class="w-full p-2 border rounded-lg" required>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="w-full p-2 border rounded-lg">
            </div>
            <div>
                <label class="block font-medium text-gray-700">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="w-full p-2 border rounded-lg">
            </div>
            <div>
                <label class="block font-medium text-gray-700">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="w-full p-2 border rounded-lg">
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Alamat</label>
                <textarea name="alamat" class="w-full p-2 border rounded-lg"></textarea>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Nama Ayah</label>
                <input type="text" name="nama_ayah" class="w-full p-2 border rounded-lg">
            </div>
            <div>
                <label class="block font-medium text-gray-700">Nama Ibu</label>
                <input type="text" name="nama_ibu" class="w-full p-2 border rounded-lg">
            </div>
            <div>
                <label class="block font-medium text-gray-700">Upload Akta</label>
                <input type="file" name="akta" accept=".pdf,.jpg,.png" class="w-full p-2 border rounded-lg">
            </div>
            <div>
                <label class="block font-medium text-gray-700">Upload Ijazah</label>
                <input type="file" name="ijazah" accept=".pdf,.jpg,.png" class="w-full p-2 border rounded-lg">
            </div>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
            Simpan Data
        </button>
    </form>
</div>
@endsection
