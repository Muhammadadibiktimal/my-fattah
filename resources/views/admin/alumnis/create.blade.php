@extends('admin.layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-lg mt-10">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">Tambah Alumni</h2>

    <form action="{{ route('admin.alumnis.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Nama Alumni -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Alumni</label>
            <input type="text" name="name" required
                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600
                       focus:ring-2 focus:ring-blue-500 dark:focus:ring-yellow-500
                       focus:outline-none bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
        </div>

        <!-- Angkatan -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Angkatan</label>
            <input type="text" name="angkatan"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600
                       focus:ring-2 focus:ring-blue-500 dark:focus:ring-yellow-500
                       focus:outline-none bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
        </div>

        <!-- Pekerjaan / Prestasi -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pekerjaan / Prestasi</label>
            <input type="text" name="pekerjaan"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600
                       focus:ring-2 focus:ring-blue-500 dark:focus:ring-yellow-500
                       focus:outline-none bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
        </div>

        <!-- Kesan & Pesan -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kesan & Pesan</label>
            <textarea name="kesan_pesan" required rows="4"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600
                       focus:ring-2 focus:ring-blue-500 dark:focus:ring-yellow-500
                       focus:outline-none bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100"></textarea>
        </div>

        <!-- Foto -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Foto</label>
            <input type="file" name="photo"
                class="w-full text-gray-700 dark:text-gray-300
                       file:mr-4 file:py-2 file:px-4
                       file:rounded-lg file:border-0
                       file:text-sm file:font-semibold
                       file:bg-blue-500 file:text-white
                       hover:file:bg-blue-600 cursor-pointer">
        </div>

        <!-- Tombol -->
        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.alumnis.index') }}"
               class="px-5 py-2 rounded-lg bg-gray-300 text-gray-800 hover:bg-gray-400
                      dark:bg-gray-600 dark:text-gray-200 dark:hover:bg-gray-500 transition">
                Batal
            </a>
            <button type="submit"
                class="px-6 py-2 rounded-lg bg-blue-600 text-black font-semibold
                       hover:bg-blue-700 shadow-md transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
