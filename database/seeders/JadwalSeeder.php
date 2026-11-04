<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\User;
use App\Models\Jadwal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds according to JADWAL PELAJARAN 2026/2027 PDF.
     */
    public function run(): void
    {
        // -------------------------------------------------------------
        // 1. DATA GURU (Kode A s/d U + Guru Piket)
        // -------------------------------------------------------------
        $guruDefinitions = [
            'A' => ['name' => 'Abah KH. Iskandar Zulkarnaen, M.M.Pd', 'email' => 'iskandar@alfattah.sch.id', 'role' => 'kepsek'],
            'B' => ['name' => 'Ummah Hj. Neneng Amalia, M.Pd', 'email' => 'neneng@alfattah.sch.id', 'role' => 'guru'],
            'C' => ['name' => 'Ust Jabal Hakim Abdullah, S.Pd', 'email' => 'jabal.hakim@alfattah.sch.id', 'role' => 'guru'],
            'D' => ['name' => 'Ustzh Priyandani Turyuni K, M.M', 'email' => 'priyandani@alfattah.sch.id', 'role' => 'guru'],
            'E' => ['name' => 'Ust M Soleh Fajar Sodik, S.Pd', 'email' => 'fajar.sodik@alfattah.sch.id', 'role' => 'guru'],
            'F' => ['name' => 'Ust Syaukani, L.c', 'email' => 'syaukani@alfattah.sch.id', 'role' => 'guru'],
            'G' => ['name' => 'Ust Luqman Hakim, M.Hum', 'email' => 'luqman.hakim@alfattah.sch.id', 'role' => 'guru'],
            'H' => ['name' => 'Ustdzh Enden Novi K, S.Pd', 'email' => 'enden.novi@alfattah.sch.id', 'role' => 'guru'],
            'I' => ['name' => 'Ustdzh Amrin Fahroyati, S.Pd', 'email' => 'amrin.fahroyati@alfattah.sch.id', 'role' => 'guru'],
            'J' => ['name' => 'Ustdzh Rizka Yasintia, S.E', 'email' => 'rizka.yasintia@alfattah.sch.id', 'role' => 'guru'],
            'K' => ['name' => 'Ustdzh Wulan Rahmawati, S.E', 'email' => 'wulan.rahmawati@alfattah.sch.id', 'role' => 'guru'],
            'L' => ['name' => 'Ustdzh Eliyana, S.Pd', 'email' => 'eliyana@alfattah.sch.id', 'role' => 'guru'],
            'M' => ['name' => 'Ustdzh Rizka Dwi Pertiwi, S.Pd', 'email' => 'rizka.dwi@alfattah.sch.id', 'role' => 'guru'],
            'N' => ['name' => 'Ust Rizqi Ardimansyah', 'email' => 'rizqi.ardimansyah@alfattah.sch.id', 'role' => 'guru'],
            'O' => ['name' => 'Ustdzh Windry Wiryasari', 'email' => 'windry.w@alfattah.sch.id', 'role' => 'guru'],
            'P' => ['name' => 'Ustzh Delhayati Amila, S.Pd', 'email' => 'delhayati@alfattah.sch.id', 'role' => 'guru'],
            'Q' => ['name' => 'Ustdzh Putri Handayani, S.Pd', 'email' => 'putri.handayani@alfattah.sch.id', 'role' => 'guru'],
            'R' => ['name' => 'Ustdzh. Hj. Hanny Miftahul Falah, S.S., M.Pd', 'email' => 'hanny.miftahul@alfattah.sch.id', 'role' => 'guru'],
            'S' => ['name' => 'Ust Mohamad Paisal', 'email' => 'guru@gmail.com', 'role' => 'guru'], // Demo login guru@gmail.com
            'T' => ['name' => 'Ustdz Ummi Nur Syarifah, L.c', 'email' => 'ummi.nur@alfattah.sch.id', 'role' => 'guru'],
            'U' => ['name' => 'Ust Roy Rahman Barus, A.Md., CPSM., CIHC', 'email' => 'roy.rahman@alfattah.sch.id', 'role' => 'guru'],
        ];

        $guruModels = [];
        foreach ($guruDefinitions as $code => $info) {
            $user = User::updateOrCreate(
                ['email' => $info['email']],
                [
                    'name' => $info['name'],
                    'password' => Hash::make('password123'),
                    'role' => $info['role'],
                ]
            );
            $guruModels[$code] = $user;
        }

        // Guru Piket
        User::firstOrCreate(
            ['email' => 'rizka.amanda@alfattah.sch.id'],
            [
                'name' => 'Ustdzh Rizka Amanda',
                'password' => Hash::make('password123'),
                'role' => 'guru',
            ]
        );

        // -------------------------------------------------------------
        // 2. DATA KELAS (Kelas I s/d Kelas VI beserta Wali Kelas Resmi)
        // -------------------------------------------------------------
        $kelasDefinitions = [
            'Kelas I'   => ['tingkat' => '7',  'jenjang' => 'SMP', 'jurusan' => null, 'wali' => 'Ust Mohamad Paisal'],
            'Kelas II'  => ['tingkat' => '8',  'jenjang' => 'SMP', 'jurusan' => null, 'wali' => 'Ust Rizqi Ardimansyah'],
            'Kelas III' => ['tingkat' => '9',  'jenjang' => 'SMP', 'jurusan' => null, 'wali' => 'Ust Syaukani, L.c'],
            'Kelas IV'  => ['tingkat' => '10', 'jenjang' => 'SMA', 'jurusan' => 'IPA', 'wali' => 'Ustdz Ummi Nur Syarifah, L.c'],
            'Kelas V'   => ['tingkat' => '11', 'jenjang' => 'SMA', 'jurusan' => 'IPA', 'wali' => 'Ust Rizqi Ardimansyah'],
            'Kelas VI'  => ['tingkat' => '12', 'jenjang' => 'SMA', 'jurusan' => 'IPA', 'wali' => 'Ummah Hj. Neneng Amalia, M.Pd'],
        ];

        $kelasModels = [];
        foreach ($kelasDefinitions as $namaKelas => $info) {
            $kelas = Kelas::updateOrCreate(
                ['nama_kelas' => $namaKelas],
                [
                    'tingkat' => $info['tingkat'],
                    'jenjang' => $info['jenjang'],
                    'jurusan' => $info['jurusan'],
                    'wali_kelas' => $info['wali'],
                ]
            );
            $kelasModels[$namaKelas] = $kelas;
        }

        // Hubungkan juga santri dummy yang sudah ada ke Kelas I dan Kelas II
        \App\Models\Santri::whereNull('kelas_id')
            ->orWhereNotIn('kelas_id', collect($kelasModels)->pluck('id'))
            ->update(['kelas_id' => $kelasModels['Kelas I']->id]);

        // -------------------------------------------------------------
        // 3. DATA MATA PELAJARAN (Kode 1 s/d 42)
        // -------------------------------------------------------------
        $mapelDefinitions = [
            1  => ['nama' => 'Bahasa Indonesia', 'jenjang' => 'Semua', 'kkm' => 75],
            2  => ['nama' => 'IPA', 'jenjang' => 'Semua', 'kkm' => 75],
            3  => ['nama' => 'Matematika', 'jenjang' => 'Semua', 'kkm' => 75],
            4  => ['nama' => 'Bahasa Inggris', 'jenjang' => 'Semua', 'kkm' => 75],
            5  => ['nama' => 'PKN', 'jenjang' => 'Semua', 'kkm' => 75],
            6  => ['nama' => 'IPS', 'jenjang' => 'Semua', 'kkm' => 75],
            7  => ['nama' => 'TIK', 'jenjang' => 'Semua', 'kkm' => 75],
            8  => ['nama' => 'PAI', 'jenjang' => 'Semua', 'kkm' => 75],
            9  => ['nama' => 'Prakarya', 'jenjang' => 'Semua', 'kkm' => 75],
            10 => ['nama' => 'Fisika', 'jenjang' => 'SMA', 'kkm' => 75],
            11 => ['nama' => 'Biologi', 'jenjang' => 'SMA', 'kkm' => 75],
            12 => ['nama' => 'Kimia', 'jenjang' => 'SMA', 'kkm' => 75],
            13 => ['nama' => 'Sejarah Indonesia', 'jenjang' => 'Semua', 'kkm' => 75],
            14 => ['nama' => 'SPI', 'jenjang' => 'Semua', 'kkm' => 75],
            15 => ['nama' => 'Sirah Nabawiyah', 'jenjang' => 'Semua', 'kkm' => 75],
            16 => ['nama' => 'English Lesson', 'jenjang' => 'Semua', 'kkm' => 75],
            17 => ['nama' => 'Literasi bhs Indonesia', 'jenjang' => 'Semua', 'kkm' => 75],
            18 => ['nama' => 'Akhlak', 'jenjang' => 'Semua', 'kkm' => 75],
            19 => ['nama' => 'Aqidah', 'jenjang' => 'Semua', 'kkm' => 75],
            20 => ['nama' => 'Bahasa Arab', 'jenjang' => 'Semua', 'kkm' => 75],
            21 => ['nama' => 'Fiqh', 'jenjang' => 'Semua', 'kkm' => 75],
            22 => ['nama' => 'Hadits', 'jenjang' => 'Semua', 'kkm' => 75],
            23 => ['nama' => 'Khot', 'jenjang' => 'Semua', 'kkm' => 75],
            24 => ['nama' => 'Mahfudzot', 'jenjang' => 'Semua', 'kkm' => 75],
            25 => ['nama' => 'Mutholaah', 'jenjang' => 'Semua', 'kkm' => 75],
            26 => ['nama' => 'Nahwu', 'jenjang' => 'Semua', 'kkm' => 75],
            27 => ['nama' => 'Shorof', 'jenjang' => 'Semua', 'kkm' => 75],
            28 => ['nama' => 'Tafsir', 'jenjang' => 'Semua', 'kkm' => 75],
            29 => ['nama' => 'Tajwid', 'jenjang' => 'Semua', 'kkm' => 75],
            30 => ['nama' => 'Imla', 'jenjang' => 'Semua', 'kkm' => 75],
            31 => ['nama' => 'Insya', 'jenjang' => 'Semua', 'kkm' => 75],
            32 => ['nama' => 'Ayatul Ahkam', 'jenjang' => 'SMA', 'kkm' => 75],
            33 => ['nama' => 'Mustholah Hadits', 'jenjang' => 'SMA', 'kkm' => 75],
            34 => ['nama' => 'Ushul Fiqh', 'jenjang' => 'SMA', 'kkm' => 75],
            35 => ['nama' => 'Ulumul Qur\'an', 'jenjang' => 'SMA', 'kkm' => 75],
            36 => ['nama' => 'Dzahirah', 'jenjang' => 'SMA', 'kkm' => 75],
            37 => ['nama' => 'Bayan', 'jenjang' => 'SMA', 'kkm' => 75],
            38 => ['nama' => 'Maani', 'jenjang' => 'SMA', 'kkm' => 75],
            39 => ['nama' => 'Badi', 'jenjang' => 'SMA', 'kkm' => 75],
            40 => ['nama' => 'Kitabah', 'jenjang' => 'Semua', 'kkm' => 75],
            41 => ['nama' => 'Tarbiyah', 'jenjang' => 'SMA', 'kkm' => 75],
            42 => ['nama' => 'PE', 'jenjang' => 'Semua', 'kkm' => 75],
        ];

        $mapelModels = [];
        foreach ($mapelDefinitions as $code => $info) {
            $mapel = Mapel::updateOrCreate(
                ['kode_mapel' => (string) $code],
                [
                    'nama_mapel' => $info['nama'],
                    'jenjang' => $info['jenjang'],
                    'jurusan' => null,
                    'kkm' => $info['kkm'],
                ]
            );
            $mapelModels[$code] = $mapel;
        }

        // -------------------------------------------------------------
        // 4. MATRIKS JADWAL PELAJARAN (Senin s/d Sabtu)
        // -------------------------------------------------------------
        // Urutan kolom kelas: [Kelas I, Kelas II, Kelas III, Kelas IV, Kelas V, Kelas VI]
        $kelasKeys = ['Kelas I', 'Kelas II', 'Kelas III', 'Kelas IV', 'Kelas V', 'Kelas VI'];

        $schedule = [
            'Senin' => [
                ['jam_ke' => 1, 'waktu' => '08.00 - 08.35', 'cells' => ['H8',  'M20', 'S21', 'H5',  'O18', 'N26']],
                ['jam_ke' => 2, 'waktu' => '08.35 - 09.10', 'cells' => ['O18', 'M20', 'S21', 'F19', 'H5',  'N26']],
                ['jam_ke' => 3, 'waktu' => '09.10 - 09.45', 'cells' => ['O18', 'H8',  'K7',  'B17', 'C7',  'G13']],
                ['jam_ke' => 4, 'waktu' => '10.30 - 11.05', 'cells' => ['B17', 'B17', 'B17', 'N22', 'G13', 'H5']],
                ['jam_ke' => 5, 'waktu' => '11.05 - 11.40', 'cells' => ['M20', 'S21', 'H5',  'C23', 'G1',  'F32']],
                ['jam_ke' => 6, 'waktu' => '11.40 - 12.15', 'cells' => ['M20', 'S21', 'J6',  'C42', 'G1',  'N22']],
            ],
            'Selasa' => [
                ['jam_ke' => 1, 'waktu' => '07.30 - 08.05', 'cells' => ['S22', 'C42', 'E19', 'O18', 'T4',  'F20']],
                ['jam_ke' => 2, 'waktu' => '08.05 - 08.40', 'cells' => ['S22', 'O18', 'E19', 'F20', 'T4',  'G1']],
                ['jam_ke' => 3, 'waktu' => '08.40 - 09.15', 'cells' => ['C42', 'O18', 'T30', 'F20', 'E28', 'G1']],
                ['jam_ke' => 4, 'waktu' => '09.15 - 09.50', 'cells' => ['T29', 'E19', 'S22', 'S21', 'G14', 'O18']],
                ['jam_ke' => 5, 'waktu' => '10.35 - 11.10', 'cells' => ['T29', 'E19', 'O18', 'S21', 'G14', 'F31']],
                ['jam_ke' => 6, 'waktu' => '11.10 - 11.45', 'cells' => ['M25', 'S22', 'O18', 'T4',  'N26', 'G14']],
                ['jam_ke' => 7, 'waktu' => '11.45 - 12.20', 'cells' => ['M25', 'S22', 'C23', 'T4',  'N26', 'E35']],
            ],
            'Rabu' => [
                ['jam_ke' => 1, 'waktu' => '07.30 - 08.05', 'cells' => ['R1',  'P3',  'M20', 'G1',  'S21', 'T4']],
                ['jam_ke' => 2, 'waktu' => '08.05 - 08.40', 'cells' => ['R1',  'P3',  'M20', 'G1',  'S21', 'T4']],
                ['jam_ke' => 3, 'waktu' => '08.40 - 09.15', 'cells' => ['L16', 'J9',  'R1',  'G14', 'T16', 'S21']],
                ['jam_ke' => 4, 'waktu' => '09.15 - 09.50', 'cells' => ['P3',  'J6',  'R1',  'G14', 'T30', 'S21']],
                ['jam_ke' => 5, 'waktu' => '10.35 - 11.10', 'cells' => ['P3',  'R1',  'L16', 'G13', 'B17', 'B17']],
                ['jam_ke' => 6, 'waktu' => '11.10 - 11.45', 'cells' => ['S21', 'R1',  'P2',  'Q3',  'N41', 'F19']],
                ['jam_ke' => 7, 'waktu' => '11.45 - 12.20', 'cells' => ['S21', 'L16', 'P2',  'Q3',  'F20', 'N41']],
            ],
            'Kamis' => [
                ['jam_ke' => 1, 'waktu' => '07.30 - 08.05', 'cells' => ['L4',  'F27', 'E28', 'Q10', 'P11', 'N34']],
                ['jam_ke' => 2, 'waktu' => '08.05 - 08.40', 'cells' => ['L4',  'F24', 'J9',  'Q10', 'P11', 'N39']],
                ['jam_ke' => 3, 'waktu' => '08.40 - 09.15', 'cells' => ['O24', 'S15', 'L4',  'P11', 'F27', 'C42']],
                ['jam_ke' => 4, 'waktu' => '09.15 - 09.50', 'cells' => ['O24', 'S15', 'L4',  'P11', 'F27', 'C7']],
                ['jam_ke' => 5, 'waktu' => '10.35 - 11.10', 'cells' => ['D5',  'L4',  'S15', 'Q12', 'C42', 'P11']],
                ['jam_ke' => 6, 'waktu' => '11.10 - 11.45', 'cells' => ['J9',  'L4',  'D5',  'Q12', 'C23', 'P11']],
                ['jam_ke' => 7, 'waktu' => '11.45 - 12.20', 'cells' => ['J6',  'D5',  'C42', 'N37', 'F31', 'E28']],
            ],
            'Jumat' => [
                ['jam_ke' => 1, 'waktu' => '07.30 - 08.05', 'cells' => ['P2',  'C25', 'Q3',  'N34', 'D9',  'F27']],
                ['jam_ke' => 2, 'waktu' => '08.05 - 08.40', 'cells' => ['P2',  'C25', 'Q3',  'N26', 'N22', 'F27']],
                ['jam_ke' => 3, 'waktu' => '08.40 - 09.15', 'cells' => ['M20', 'P2',  'O24', 'E31', 'N34', 'Q10']],
                ['jam_ke' => 4, 'waktu' => '09.15 - 09.50', 'cells' => ['M20', 'P2',  'O24', 'E28', 'N38', 'Q10']],
            ],
            'Sabtu' => [
                ['jam_ke' => 1, 'waktu' => '07.30 - 08.05', 'cells' => ['S15', 'N26', 'C25', 'T30', 'Q12', 'E33']],
                ['jam_ke' => 2, 'waktu' => '08.05 - 08.40', 'cells' => ['S15', 'N26', 'C25', 'T16', 'Q12', 'D9']],
                ['jam_ke' => 3, 'waktu' => '08.40 - 09.15', 'cells' => ['E19', 'T29', 'N26', 'D9',  'F19', 'Q12']],
                ['jam_ke' => 4, 'waktu' => '09.15 - 09.50', 'cells' => ['E19', 'S40', 'N26', 'F27', 'I3',  'Q12']],
                ['jam_ke' => 5, 'waktu' => '10.35 - 11.10', 'cells' => ['S40', 'K7',  'E31', 'F27', 'I3',  'T16']],
                ['jam_ke' => 6, 'waktu' => '11.10 - 11.45', 'cells' => ['S36', 'O24', 'F27', 'K7',  'Q10', 'I3']],
                ['jam_ke' => 7, 'waktu' => '11.45 - 12.20', 'cells' => ['K7',  'O24', 'F27', 'N26', 'Q10', 'I3']],
            ],
        ];

        // Kosongkan dan masukkan data jadwal
        Jadwal::truncate();

        foreach ($schedule as $hari => $slots) {
            foreach ($slots as $slot) {
                $jamKe = $slot['jam_ke'];
                $waktu = $slot['waktu'];

                foreach ($slot['cells'] as $idx => $cellCode) {
                    $namaKelas = $kelasKeys[$idx];
                    $kelasId = $kelasModels[$namaKelas]->id;

                    if (preg_match('/^([A-Z])([0-9]+)$/', $cellCode, $matches)) {
                        $kodeGuru = $matches[1];
                        $kodeMapelNum = (int) $matches[2];

                        $guruModel = $guruModels[$kodeGuru] ?? null;
                        $mapelModel = $mapelModels[$kodeMapelNum] ?? null;

                        Jadwal::create([
                            'hari' => $hari,
                            'jam_ke' => $jamKe,
                            'waktu' => $waktu,
                            'kelas_id' => $kelasId,
                            'mapel_id' => $mapelModel?->id,
                            'guru_id' => $guruModel?->id,
                            'kode_guru' => $kodeGuru,
                            'kode_mapel' => (string) $kodeMapelNum,
                            'kode_gabungan' => $cellCode,
                            'ruang' => $namaKelas,
                        ]);
                    }
                }
            }
        }
    }
}

