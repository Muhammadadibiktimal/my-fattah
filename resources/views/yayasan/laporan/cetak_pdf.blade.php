<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 10px; color: #1f2937; margin: 0; padding: 0; }
        .header { text-align: center; border-bottom: 3px double #065f46; padding-bottom: 10px; margin-bottom: 15px; }
        .header img { float: left; width: 60px; height: auto; margin-right: 15px; }
        .header h1 { margin: 0; font-size: 16px; color: #065f46; text-transform: uppercase; font-weight: bold; }
        .header h2 { margin: 2px 0 0 0; font-size: 12px; color: #374151; }
        .header p { margin: 2px 0 0 0; font-size: 9px; color: #6b7280; }
        .report-title { text-align: center; margin-bottom: 15px; }
        .report-title h3 { margin: 0; font-size: 13px; text-transform: uppercase; color: #111827; }
        .report-title span { font-size: 10px; color: #4b5563; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #9ca3af; padding: 5px 8px; text-align: left; }
        th { background: #f3f4f6; color: #111827; font-weight: bold; font-size: 9px; text-transform: uppercase; }
        .footer-sig { margin-top: 30px; width: 100%; }
        .footer-sig td { border: none; padding: 0; }
        .clearfix { clear: both; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .badge-success { color: #065f46; font-weight: bold; }
    </style>
</head>
<body>
    <!-- KOP RESMI YAYASAN -->
    <div class="header">
        @if(file_exists(public_path('images/logo/logo.png')))
            <img src="{{ public_path('images/logo/logo.png') }}" alt="Logo">
        @endif
        <div>
            <h1>YAYASAN PONDOK PESANTREN AL-FATTAH</h1>
            <h2>SMP • SMA • SMK AL-FATTAH TIGARAKSA</h2>
            <p>Jl. Raya Tigaraksa No. 1, Kab. Tangerang, Banten • Telp: (021) 599-0000 • Email: yayasan@alfattah.sch.id</p>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="report-title">
        <h3>{{ $title }}</h3>
        <span>Dicetak Resmi untuk Arsip Pengawasan Ketua Yayasan • Per Tanggal: {{ $tanggal }}</span>
    </div>

    <!-- TABEL KONTEN SESUAI KATEGORI -->
    <table>
        @if($kategori == 'pendaftar')
            <thead>
                <tr>
                    <th class="text-center" style="width: 25px;">No</th>
                    <th>Order ID</th>
                    <th>Nama Santri</th>
                    <th>Jenjang & Jurusan</th>
                    <th>Asal Sekolah</th>
                    <th>No. Handphone</th>
                    <th class="text-center">Status Bayar</th>
                    <th class="text-center">Status Berkas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $i => $item)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $item->order_id }}</td>
                    <td><strong>{{ $item->nama }}</strong></td>
                    <td>{{ $item->jenjang }} ({{ $item->jurusan ?? 'Reguler' }})</td>
                    <td>{{ $item->asal_sekolah ?? '-' }}</td>
                    <td>{{ $item->no_hp }}</td>
                    <td class="text-center">{{ strtoupper($item->status_bayar) }}</td>
                    <td class="text-center">{{ $item->status }}</td>
                </tr>
                @endforeach
            </tbody>

        @elseif($kategori == 'keuangan')
            <thead>
                <tr>
                    <th class="text-center" style="width: 25px;">No</th>
                    <th>Order ID</th>
                    <th>Waktu Pembayaran</th>
                    <th>Nama Santri</th>
                    <th>Jenjang Sekolah</th>
                    <th class="text-right">Nominal (IDR)</th>
                    <th class="text-center">Metode / Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $i => $item)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $item->order_id }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}</td>
                    <td><strong>{{ $item->nama }}</strong></td>
                    <td>{{ $item->jenjang }}</td>
                    <td class="text-right">Rp 200.000</td>
                    <td class="text-center badge-success">Midtrans (Settlement)</td>
                </tr>
                @endforeach
            </tbody>

        @elseif($kategori == 'santri')
            <thead>
                <tr>
                    <th class="text-center" style="width: 25px;">No</th>
                    <th>NISN</th>
                    <th>Nama Lengkap Santri</th>
                    <th>Jenjang & Jurusan</th>
                    <th>Kelas Rombel</th>
                    <th>Gender</th>
                    <th class="text-center">Status Kenaikan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $i => $item)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $item->nisn ?? '-' }}</td>
                    <td><strong>{{ $item->nama_lengkap }}</strong></td>
                    <td>{{ $item->jenjang ?? '-' }} • {{ $item->jurusan ?? '-' }}</td>
                    <td>{{ $item->kelas ? 'Kelas ' . $item->kelas->nama_kelas : '-' }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td class="text-center badge-success">{{ $item->status_kenaikan ?: $item->status }}</td>
                </tr>
                @endforeach
            </tbody>

        @elseif($kategori == 'nilai')
            <thead>
                <tr>
                    <th class="text-center" style="width: 25px;">No</th>
                    <th>Nama Santri</th>
                    <th>Kelas</th>
                    <th>Mata Pelajaran</th>
                    <th class="text-center">Tugas</th>
                    <th class="text-center">UTS</th>
                    <th class="text-center">UAS</th>
                    <th class="text-center">Nilai Akhir</th>
                    <th class="text-center">Predikat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $i => $item)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $item->santri->nama_lengkap ?? '-' }}</td>
                    <td>{{ $item->santri?->kelas ? 'Kelas ' . $item->santri->kelas->nama_kelas : '-' }}</td>
                    <td>{{ $item->mapel->nama_mapel ?? '-' }}</td>
                    <td class="text-center">{{ $item->nilai_tugas }}</td>
                    <td class="text-center">{{ $item->nilai_uts }}</td>
                    <td class="text-center">{{ $item->nilai_uas }}</td>
                    <td class="text-center"><strong>{{ $item->nilai_akhir }}</strong></td>
                    <td class="text-center badge-success">{{ $item->predikat }}</td>
                </tr>
                @endforeach
            </tbody>

        @elseif($kategori == 'absensi')
            <thead>
                <tr>
                    <th class="text-center" style="width: 25px;">No</th>
                    <th>Tanggal Presensi</th>
                    <th>Nama Santri</th>
                    <th>Kelas Rombel</th>
                    <th class="text-center">Status Kehadiran</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $i => $item)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                    <td><strong>{{ $item->santri->nama_lengkap ?? '-' }}</strong></td>
                    <td>{{ $item->kelas ? 'Kelas ' . $item->kelas->nama_kelas : '-' }}</td>
                    <td class="text-center">{{ $item->status }}</td>
                    <td>{{ $item->keterangan ?: 'Tepat waktu' }}</td>
                </tr>
                @endforeach
            </tbody>

        @elseif($kategori == 'guru')
            <thead>
                <tr>
                    <th class="text-center" style="width: 25px;">No</th>
                    <th>Nama Dewan Guru / Ustadz</th>
                    <th>Email</th>
                    <th>No. Handphone</th>
                    <th class="text-center">Status Penugasan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $i => $item)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td><strong>{{ $item->name }}</strong></td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone ?? '-' }}</td>
                    <td class="text-center badge-success">Guru Aktif</td>
                </tr>
                @endforeach
            </tbody>
        @endif
    </table>

    <!-- TANDA TANGAN PENGESAHAN KETUA YAYASAN -->
    <table class="footer-sig">
        <tr>
            <td style="width: 60%;">
                <p style="font-size: 8px; color: #6b7280;">
                    Dokumen ini digenerate secara resmi melalui Sistem Informasi Manajemen Terpadu<br>
                    Pondok Pesantren Al-Fattah Tigaraksa.
                </p>
            </td>
            <td style="width: 40%; text-align: center;">
                Tangerang, {{ $tanggal }}<br>
                <strong>Ketua Yayasan Pondok Pesantren Al-Fattah,</strong>
                <br><br><br><br>
                <strong><u>K.H. Ketua Yayasan Al-Fattah</u></strong>
            </td>
        </tr>
    </table>
</body>
</html>
