<?php

namespace App\Exports;

use App\Models\DataPendaftar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PendaftarExport implements FromCollection, WithHeadings, WithMapping, WithDrawings, WithStyles
{
    private $data = [];

    public function collection()
    {
        $this->data = DataPendaftar::select(
            'nama_lengkap',
            'nik',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'alamat',
            'nama_ayah',
            'nama_ibu',
            'kk',
            'akta',
            'ijazah',
            'status'
        )->get();

        return $this->data;
    }

    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'NIK',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Alamat',
            'Nama Ayah',
            'Nama Ibu',
            'KK',
            'Akta',
            'Ijazah',
            'Status',
        ];
    }

    public function map($data): array
    {
        return [
            $data->nama_lengkap,
            $data->nik,
            $data->tempat_lahir,
            $data->tanggal_lahir,
            $data->jenis_kelamin,
            $data->alamat,
            $data->nama_ayah,
            $data->nama_ibu,
            '', // Gambar KK
            '', // Gambar Akta
            '', // Gambar Ijazah
            $data->status,
        ];
    }

    public function drawings()
    {
        $drawings = [];
        $basePath = storage_path('app/public/');

        foreach ($this->data as $index => $item) {
            $row = $index + 2; // data mulai dari baris ke-2

            $createDrawing = function ($filePath, $cell, $name) use ($basePath) {
                if (!empty($filePath) && file_exists($basePath . $filePath)) {
                    $drawing = new Drawing();
                    $drawing->setName($name);
                    $drawing->setPath($basePath . $filePath);
                    $drawing->setHeight(80);
                    $drawing->setCoordinates($cell);
                    $drawing->setOffsetX(10);
                    $drawing->setOffsetY(5);
                    return $drawing;
                }
                return null;
            };

            if ($kk = $createDrawing($item->kk, 'I' . $row, 'KK')) {
                $drawings[] = $kk;
            }
            if ($akta = $createDrawing($item->akta, 'J' . $row, 'Akta')) {
                $drawings[] = $akta;
            }
            if ($ijazah = $createDrawing($item->ijazah, 'K' . $row, 'Ijazah')) {
                $drawings[] = $ijazah;
            }
        }

        return $drawings;
    }

    public function styles(Worksheet $sheet)
    {
        // 🧱 Style Header
        $headerRange = 'A1:L1';
        $sheet->getStyle($headerRange)->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => '4472C4'], // biru lembut
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'AAAAAA'],
                ],
            ],
        ]);

        // 🧾 Style Isi Tabel
        $lastRow = count($this->data) + 1;
        $contentRange = 'A2:L' . $lastRow;

        $sheet->getStyle($contentRange)->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'CCCCCC'],
                ],
            ],
        ]);

        // ✨ Atur lebar kolom (biar gak mepet)
        $columnWidths = [
            'A' => 25,
            'B' => 18,
            'C' => 18,
            'D' => 15,
            'E' => 15,
            'F' => 25,
            'G' => 20,
            'H' => 20,
            'I' => 15,
            'J' => 15,
            'K' => 15,
            'L' => 15,
        ];

        foreach ($columnWidths as $col => $width) {
            $sheet->getColumnDimension($col)->setWidth($width);
        }

        // 📏 Atur tinggi baris biar gambar muat
        foreach (range(2, $lastRow) as $row) {
            $sheet->getRowDimension($row)->setRowHeight(85);
        }

        // 🧩 Border luar tebal (frame tabel)
        $sheet->getStyle('A1:L' . $lastRow)->applyFromArray([
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_MEDIUM,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // 🔲 Auto filter di header
        $sheet->setAutoFilter($headerRange);

        return [];
    }
}
