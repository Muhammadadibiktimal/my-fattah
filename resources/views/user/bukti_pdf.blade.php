<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kartu Tanda Santri & Bukti Pendaftaran</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #1f2937; line-height: 1.4; }
        .header { text-align: center; border-bottom: 2px solid #065f46; padding-bottom: 12px; margin-bottom: 15px; position: relative; }
        .header img { float: left; width: 65px; height: auto; margin-right: 15px; }
        .header h2 { margin: 0; font-size: 18px; color: #065f46; text-transform: uppercase; font-weight: bold; }
        .header h3 { margin: 2px 0 0 0; font-size: 13px; color: #374151; }
        .header p { margin: 2px 0 0 0; font-size: 10px; color: #6b7280; }
        .badge { display: inline-block; background: #ecfdf5; border: 1px solid #10b981; color: #047857; padding: 3px 10px; border-radius: 12px; font-weight: bold; font-size: 10px; margin-top: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #d1d5db; padding: 7px 10px; text-align: left; }
        th { width: 32%; background: #f3f4f6; color: #374151; font-weight: bold; }
        .footer { margin-top: 25px; text-align: right; }
        .note { margin-top: 15px; font-style: italic; color: #4b5563; font-size: 10px; background: #f9fafb; border-left: 3px solid #065f46; padding: 8px; }
        .clearfix { clear: both; }
        .info-box { background: #f0fdf4; border: 1px solid #bbf7d0; padding: 8px; border-radius: 6px; margin-top: 10px; text-align: center; font-weight: bold; color: #166534; }
    </style>
</head>
<body>
    <div class="header">
        @if(file_exists(public_path('images/logo/logo.png')))
            <img src="{{ public_path('images/logo/logo.png') }}" alt="Logo">
        @endif
        <div>
            <h2>Pondok Pesantren Al-Fattah</h2>
            <h3>Kartu Tanda Santri (KTS) & Bukti Pendaftaran Resmi</h3>
            <p>Jl. Raya Tigaraksa No. 1, Kab. Tangerang, Banten • Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}</p>
            <div class="badge">No. Registrasi / KTS: {{ $dataPendaftar->order_id }}</div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="info-box">
        KARTU IDENTITAS SANTRI AKTIF & TERVERIFIKASI
    </div>

    <table>
        <tr>
            <th>Nama Lengkap Santri</th>
            <td><strong>{{ $dataPendaftar->nama_lengkap }}</strong></td>
        </tr>
        <tr>
            <th>NISN</th>
            <td>{{ $dataPendaftar->nisn }}</td>
        </tr>
        <tr>
            <th>NIK</th>
            <td>{{ $dataPendaftar->nik }}</td>
        </tr>
        <tr>
            <th>Jenjang Sekolah</th>
            <td><strong>{{ $dataPendaftar->jenjang }}</strong></td>
        </tr>
        <tr>
            <th>Peminatan / Jurusan</th>
            <td><strong>{{ $dataPendaftar->jurusan }}</strong></td>
        </tr>
        <tr>
            <th>Kelas Santri</th>
            <td><strong>Kelas {{ $dataPendaftar->kelas }}</strong></td>
        </tr>
        <tr>
            <th>Tempat, Tanggal Lahir</th>
            <td>{{ $dataPendaftar->tempat_lahir }}, {{ \Carbon\Carbon::parse($dataPendaftar->tanggal_lahir)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>{{ $dataPendaftar->jenis_kelamin }}</td>
        </tr>
        <tr>
            <th>Asal Sekolah</th>
            <td>{{ $dataPendaftar->asal_sekolah }}</td>
        </tr>
        <tr>
            <th>Alamat Domisili</th>
            <td>{{ $dataPendaftar->alamat }}</td>
        </tr>
        <tr>
            <th>Nama Orang Tua (Ayah / Ibu)</th>
            <td>{{ $dataPendaftar->nama_ayah }} / {{ $dataPendaftar->nama_ibu }}</td>
        </tr>
        <tr>
            <th>Status Santri</th>
            <td><strong style="color: #059669;">{{ $dataPendaftar->status }} (Lunas PSB)</strong></td>
        </tr>
    </table>

    <div class="note">
        Kartu ini merupakan bukti identitas resmi santri Pondok Pesantren Al-Fattah. Simpan dokumen ini dengan baik sebagai syarat kelengkapan administrasi dan kegiatan akademik.
    </div>

    <table style="border: none; margin-top: 25px;">
        <tr style="border: none;">
            <td style="border: none; width: 60%; vertical-align: top;">
                <p style="margin: 0; font-size: 10px; color: #6b7280;">
                    Dicetak secara elektronik pada: {{ now()->translatedFormat('d F Y, H:i') }} WIB<br>
                    Sistem Informasi Akademik Pesantren Al-Fattah
                </p>
            </td>
            <td style="border: none; width: 40%; text-align: center; vertical-align: top;">
                Tangerang, {{ now()->translatedFormat('d F Y') }}<br>
                <strong>Kepala Bagian Kesiswaan & PSB,</strong>
                <br><br><br><br>
                <strong><u>Ustadz H. Ahmad Fauzi, M.Pd.</u></strong>
            </td>
        </tr>
    </table>
</body>
</html>
