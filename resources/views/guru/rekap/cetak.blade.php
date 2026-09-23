<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Nilai - {{ $selectedMapel->nama_mapel }} Kelas {{ $selectedKelas->nama_kelas }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body class="bg-gray-100 p-6 font-sans">

    <!-- Tombol Aksi Print -->
    <div class="max-w-4xl mx-auto mb-4 flex justify-between items-center no-print">
        <a href="javascript:history.back()" class="text-sm text-gray-600 hover:text-black font-semibold">
            ← Kembali
        </a>
        <button onclick="window.print()" class="px-5 py-2 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-lg shadow">
            🖨️ Cetak / Simpan PDF
        </button>
    </div>

    <!-- Halaman Kertas Cetak -->
    <div class="max-w-4xl mx-auto bg-white p-10 shadow-lg rounded-xl border border-gray-200">
        
        <!-- Kop Surat -->
        <div class="flex items-center gap-4 pb-4 border-b-2 border-green-800 mb-6">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Logo Ponpes" class="h-20 w-20 object-contain">
            <div class="flex-1 text-center">
                <h1 class="text-xl font-extrabold uppercase tracking-wide text-green-900">
                    Pondok Pesantren Al-Fattah Tigaraksa
                </h1>
                <p class="text-xs text-gray-600">
                    Jl. KH. Syahroni, Tigaraksa, Kec. Tigaraksa, Kab. Tangerang, Banten 15720
                </p>
                <p class="text-xs text-gray-500">
                    Email: info@alfattah.sch.id • Website: alfattah.sch.id
                </p>
                <div class="text-sm font-bold text-gray-800 mt-2 tracking-wider underline">
                    REKAPITULASI HASIL BELAJAR SANTRI
                </div>
            </div>
        </div>

        <!-- Meta Info Rekap -->
        <div class="grid grid-cols-2 gap-4 text-xs mb-6 bg-gray-50 p-3 rounded-lg border border-gray-200">
            <div>
                <div><strong>Mata Pelajaran:</strong> {{ $selectedMapel->nama_mapel }} ({{ $selectedMapel->kode_mapel }})</div>
                <div><strong>Kelas / Rombel:</strong> Kelas {{ $selectedKelas->nama_kelas }}</div>
                <div><strong>KKM:</strong> {{ $selectedMapel->kkm }}</div>
            </div>
            <div>
                <div><strong>Tahun Ajaran:</strong> {{ $tahunAjaran }}</div>
                <div><strong>Semester:</strong> {{ $semester }}</div>
                <div><strong>Guru Pengampu:</strong> {{ $guru->name }}</div>
            </div>
        </div>

        <!-- Tabel Nilai -->
        <table class="w-full border-collapse border border-gray-300 text-xs mb-8">
            <thead>
                <tr class="bg-green-100 text-green-900 uppercase">
                    <th class="border border-gray-300 p-2 text-center w-10">No</th>
                    <th class="border border-gray-300 p-2 text-left">Nama Santri</th>
                    <th class="border border-gray-300 p-2 text-center w-24">NISN</th>
                    <th class="border border-gray-300 p-2 text-center w-16">Tugas</th>
                    <th class="border border-gray-300 p-2 text-center w-16">UTS</th>
                    <th class="border border-gray-300 p-2 text-center w-16">UAS</th>
                    <th class="border border-gray-300 p-2 text-center w-20">Nilai Akhir</th>
                    <th class="border border-gray-300 p-2 text-center w-16">Predikat</th>
                    <th class="border border-gray-300 p-2 text-center w-24">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rekapData as $index => $row)
                    <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                        <td class="border border-gray-300 p-2 text-center">{{ $index + 1 }}</td>
                        <td class="border border-gray-300 p-2 font-semibold">{{ $row->santri->nama_lengkap }}</td>
                        <td class="border border-gray-300 p-2 text-center font-mono">{{ $row->santri->nisn ?? '-' }}</td>
                        <td class="border border-gray-300 p-2 text-center font-mono">{{ $row->tugas }}</td>
                        <td class="border border-gray-300 p-2 text-center font-mono">{{ $row->uts }}</td>
                        <td class="border border-gray-300 p-2 text-center font-mono">{{ $row->uas }}</td>
                        <td class="border border-gray-300 p-2 text-center font-bold font-mono">{{ $row->akhir }}</td>
                        <td class="border border-gray-300 p-2 text-center font-bold">{{ $row->predikat }}</td>
                        <td class="border border-gray-300 p-2 text-center font-semibold {{ $row->status == 'Tuntas' ? 'text-green-700' : 'text-red-700' }}">
                            {{ $row->status }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tanda Tangan -->
        <div class="grid grid-cols-2 gap-8 text-xs text-center mt-12 pt-6">
            <div>
                <p>Mengetahui,</p>
                <p class="font-bold">Kepala Pondok Pesantren</p>
                <div class="h-20"></div>
                <p class="font-bold underline">KH. Iskandar Zulkarnaen, M.M.Pd.</p>
                <p class="text-gray-500">NIP. 197508122002121001</p>
            </div>
            <div>
                <p>Tigaraksa, {{ date('d F Y') }}</p>
                <p class="font-bold">Guru Mata Pelajaran</p>
                <div class="h-20"></div>
                <p class="font-bold underline">{{ $guru->name }}</p>
                <p class="text-gray-500">NIP/NUPTK: -</p>
            </div>
        </div>

    </div>

</body>
</html>
