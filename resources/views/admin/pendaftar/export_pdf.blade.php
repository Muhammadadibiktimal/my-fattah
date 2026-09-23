<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Backup Data Pendaftar</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 20px;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        p {
            text-align: center;
            margin-bottom: 20px;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 6px 8px;
            text-align: center;
            vertical-align: middle;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        img {
            width: 70px;
            height: auto;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h2>📘 Backup Data Pendaftar</h2>
    <p>Tanggal Cetak: {{ $tanggal }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>NIK</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Nama Ayah</th>
                <th>Nama Ibu</th>
                <th>KK</th>
                <th>Akta</th>
                <th>Ijazah</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendaftar as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nama_lengkap }}</td>
                <td>{{ $item->nik }}</td>
                <td>{{ $item->tempat_lahir }}, {{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d-m-Y') }}</td>
                <td>{{ $item->jenis_kelamin }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->nama_ayah }}</td>
                <td>{{ $item->nama_ibu }}</td>
                <td>
                    @if($item->kk && file_exists(public_path('storage/'.$item->kk)))
                        <img src="{{ public_path('storage/'.$item->kk) }}">
                    @else
                        Tidak Ada
                    @endif
                </td>
                <td>
                    @if($item->akta && file_exists(public_path('storage/'.$item->akta)))
                        <img src="{{ public_path('storage/'.$item->akta) }}">
                    @else
                        Tidak Ada
                    @endif
                </td>
                <td>
                    @if($item->ijazah && file_exists(public_path('storage/'.$item->ijazah)))
                        <img src="{{ public_path('storage/'.$item->ijazah) }}">
                    @else
                        Tidak Ada
                    @endif
                </td>
                <td>{{ $item->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p style="margin-top: 40px; text-align: right; font-size: 12px;">
        Dicetak otomatis oleh sistem PPDB SMK Al-Fattah Tigaraksa
    </p>
</body>
</html>
