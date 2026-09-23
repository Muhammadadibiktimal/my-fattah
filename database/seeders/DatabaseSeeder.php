<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Hero;
use App\Models\Post;
use App\Models\Video;
use App\Models\Alumni;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Al-Fattah',
                'password' => bcrypt('password'),
                'role' => 'admin'
            ]
        );

        // 2. Ketua Yayasan User
        $yayasan = User::firstOrCreate(
            ['email' => 'yayasan@gmail.com'],
            [
                'name' => 'Ketua Yayasan Al-Fattah',
                'password' => bcrypt('password'),
                'role' => 'yayasan'
            ]
        );

        // 3. Kepala Sekolah User
        $kepsek = User::firstOrCreate(
            ['email' => 'kepsek@gmail.com'],
            [
                'name' => 'KH. Iskandar Zulkarnaen, M.M.Pd.',
                'password' => bcrypt('password'),
                'role' => 'kepsek'
            ]
        );

        // 3. Guru User
        $guru = User::firstOrCreate(
            ['email' => 'guru@gmail.com'],
            [
                'name' => 'Ustadz Ahmad Fauzi, S.Pd.I',
                'password' => bcrypt('password123'),
                'role' => 'guru'
            ]
        );

        // 4. User Pendaftar Dummy
        $userPendaftar = User::firstOrCreate(
            ['email' => 'pendaftar@gmail.com'],
            [
                'name' => 'Ahmad Santri Calon',
                'password' => bcrypt('password'),
                'role' => 'user'
            ]
        );

        // 5. Data Kelas
        $kelas7A = \App\Models\Kelas::firstOrCreate(
            ['nama_kelas' => '7A'],
            ['tingkat' => '7', 'wali_kelas' => 'Ustadz Ahmad Fauzi, S.Pd.I']
        );
        $kelas7B = \App\Models\Kelas::firstOrCreate(
            ['nama_kelas' => '7B'],
            ['tingkat' => '7', 'wali_kelas' => 'Ustadzah Siti Aminah, S.Pd.']
        );
        $kelas8A = \App\Models\Kelas::firstOrCreate(
            ['nama_kelas' => '8A'],
            ['tingkat' => '8', 'wali_kelas' => 'Ustadz Hasan Basri, Lc.']
        );

        // 6. Data Mata Pelajaran
        $mapelQuran = \App\Models\Mapel::firstOrCreate(
            ['kode_mapel' => 'QUR'],
            ['nama_mapel' => "Al-Qur'an Hadits", 'kkm' => 75]
        );
        $mapelFiqih = \App\Models\Mapel::firstOrCreate(
            ['kode_mapel' => 'FIQ'],
            ['nama_mapel' => 'Fiqih Ibadah', 'kkm' => 75]
        );
        $mapelArab = \App\Models\Mapel::firstOrCreate(
            ['kode_mapel' => 'ARB'],
            ['nama_mapel' => 'Bahasa Arab', 'kkm' => 70]
        );
        $mapelMtk = \App\Models\Mapel::firstOrCreate(
            ['kode_mapel' => 'MTK'],
            ['nama_mapel' => 'Matematika', 'kkm' => 70]
        );

        // 7. Data Santri Aktif
        $santri1 = \App\Models\Santri::firstOrCreate(
            ['nisn' => '0091234501'],
            [
                'user_id' => $userPendaftar->id,
                'nama_lengkap' => 'Ahmad Santri Calon',
                'kelas_id' => $kelas7A->id,
                'jenis_kelamin' => 'Laki-laki',
                'no_hp' => '081234567890',
                'alamat' => 'Tigaraksa, Tangerang',
                'status' => 'Aktif',
            ]
        );

        $santri2 = \App\Models\Santri::firstOrCreate(
            ['nisn' => '0091234502'],
            [
                'nama_lengkap' => 'Muhammad Bilal Al-Ghifari',
                'kelas_id' => $kelas7A->id,
                'jenis_kelamin' => 'Laki-laki',
                'no_hp' => '081298765432',
                'alamat' => 'Balaraja, Tangerang',
                'status' => 'Aktif',
            ]
        );

        $santri3 = \App\Models\Santri::firstOrCreate(
            ['nisn' => '0091234503'],
            [
                'nama_lengkap' => 'Fatimah Az-Zahra',
                'kelas_id' => $kelas7A->id,
                'jenis_kelamin' => 'Perempuan',
                'no_hp' => '081377889900',
                'alamat' => 'Cikupa, Tangerang',
                'status' => 'Aktif',
            ]
        );

        $santri4 = \App\Models\Santri::firstOrCreate(
            ['nisn' => '0091234504'],
            [
                'nama_lengkap' => 'Zaid bin Tsabit',
                'kelas_id' => $kelas7B->id,
                'jenis_kelamin' => 'Laki-laki',
                'no_hp' => '081512348899',
                'alamat' => 'Panongan, Tangerang',
                'status' => 'Aktif',
            ]
        );

        // 8. Sample Nilai
        \App\Models\Nilai::updateOrCreate(
            ['santri_id' => $santri1->id, 'mapel_id' => $mapelQuran->id, 'semester' => 'Ganjil', 'tahun_ajaran' => '2026/2027'],
            [
                'kelas_id' => $kelas7A->id,
                'guru_id' => $guru->id,
                'nilai_tugas' => 88,
                'nilai_uts' => 85,
                'nilai_uas' => 90,
                'nilai_akhir' => 87.9,
                'predikat' => 'A'
            ]
        );

        \App\Models\Nilai::updateOrCreate(
            ['santri_id' => $santri2->id, 'mapel_id' => $mapelQuran->id, 'semester' => 'Ganjil', 'tahun_ajaran' => '2026/2027'],
            [
                'kelas_id' => $kelas7A->id,
                'guru_id' => $guru->id,
                'nilai_tugas' => 80,
                'nilai_uts' => 78,
                'nilai_uas' => 82,
                'nilai_akhir' => 80.2,
                'predikat' => 'B'
            ]
        );

        \App\Models\Nilai::updateOrCreate(
            ['santri_id' => $santri3->id, 'mapel_id' => $mapelQuran->id, 'semester' => 'Ganjil', 'tahun_ajaran' => '2026/2027'],
            [
                'kelas_id' => $kelas7A->id,
                'guru_id' => $guru->id,
                'nilai_tugas' => 92,
                'nilai_uts' => 90,
                'nilai_uas' => 95,
                'nilai_akhir' => 92.6,
                'predikat' => 'A'
            ]
        );

        // 9. Sample Absensi
        $today = date('Y-m-d');
        \App\Models\Absensi::updateOrCreate(
            ['santri_id' => $santri1->id, 'tanggal' => $today],
            ['kelas_id' => $kelas7A->id, 'guru_id' => $guru->id, 'status' => 'Hadir', 'keterangan' => 'Tepat waktu']
        );
        \App\Models\Absensi::updateOrCreate(
            ['santri_id' => $santri2->id, 'tanggal' => $today],
            ['kelas_id' => $kelas7A->id, 'guru_id' => $guru->id, 'status' => 'Hadir', 'keterangan' => 'Tepat waktu']
        );
        \App\Models\Absensi::updateOrCreate(
            ['santri_id' => $santri3->id, 'tanggal' => $today],
            ['kelas_id' => $kelas7A->id, 'guru_id' => $guru->id, 'status' => 'Izin', 'keterangan' => 'Urusan keluarga']
        );

        // 10. Sample Data Pendaftar & Midtrans
        $p1 = \App\Models\Pendaftar::firstOrCreate(
            ['email' => 'calon.santri1@example.com'],
            [
                'nama' => 'Reyhan Pratama',
                'no_hp' => '081288990011',
                'order_id' => 'PSB-1725500001',
                'snap_token' => 'dummy-snap-token-1',
                'status_bayar' => 'settlement'
            ]
        );

        $p2 = \App\Models\Pendaftar::firstOrCreate(
            ['email' => 'calon.santri2@example.com'],
            [
                'nama' => 'Nabila Azzahra',
                'no_hp' => '081288990022',
                'order_id' => 'PSB-1725500002',
                'snap_token' => 'dummy-snap-token-2',
                'status_bayar' => 'pending'
            ]
        );

        // 4. Hero Banners
        Hero::truncate();
        Hero::create([
            'title' => 'Pondok Pesantren Al-Fattah Tigaraksa',
            'subtitle' => 'Mencetak Generasi Unggul, Berkarakter Islami, Berakhlak Qur’ani, dan Berdaya Saing Global.',
            'button_text' => 'Daftar Sekarang',
            'button_link' => '#pendaftaran-cta',
            'image' => 'https://images.unsplash.com/photo-1541829070764-84a7d30dd3f3?q=80&w=1200&auto=format&fit=crop'
        ]);

        Hero::create([
            'title' => 'Pendidikan Integratif & Modern',
            'subtitle' => 'Perpaduan Kurikulum Pesantren Klasik dan Sains Modern dengan Sistem Boarding School Terpadu.',
            'button_text' => 'Lihat Program Unggulan',
            'button_link' => '#program',
            'image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=1200&auto=format&fit=crop'
        ]);

        // 5. Posts (Berita Terbaru)
        Post::truncate();
        Post::create([
            'author_id' => $admin->id,
            'title' => 'Penerimaan Santri Baru (PSB) Tahun Ajaran 2026/2027 Resmi Dibuka',
            'slug' => 'penerimaan-santri-baru-2026-2027',
            'content' => 'Pondok Pesantren Al-Fattah Tigaraksa kembali membuka pendaftaran santri baru untuk jenjang SMP, SMA (IPA), dan SMK (Multimedia). Daftarkan putra-putri Anda secara online melalui website resmi kami.',
            'image' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?q=80&w=800&auto=format&fit=crop'
        ]);

        Post::create([
            'author_id' => $admin->id,
            'title' => 'Santri Al-Fattah Raih Juara 1 Lomba Tahfidz Qur’an Tingkat Kabupaten',
            'slug' => 'santri-al-fattah-raih-juara-1-tahfidz',
            'content' => 'Prestasi membanggakan kembali diraih oleh santri Ponpes Al-Fattah dalam ajang Musabaqah Tilawatil Qur’an (MTQ) tingkat kabupaten. Selamat dan sukses untuk para pembimbing!',
            'image' => 'https://images.unsplash.com/photo-1577896851231-70ef18881754?q=80&w=800&auto=format&fit=crop'
        ]);

        Post::create([
            'author_id' => $admin->id,
            'title' => 'Kegiatan Ziarah Religi dan Napak Tilas Perjuangan Para Wali',
            'slug' => 'kegiatan-ziarah-religi-santri-2026',
            'content' => 'Dalam rangka memperkuat spiritualitas dan menambah wawasan sejarah keislaman, santri tingkat akhir melaksanakan agenda tahunan Ziarah Religi ke maqam ulama nusantara.',
            'image' => 'https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=800&auto=format&fit=crop'
        ]);

        // 6. Testimoni Alumni
        Alumni::truncate();
        Alumni::create([
            'name' => 'Ahmad Fauzi, S.T.',
            'angkatan' => 'Angkatan 2018',
            'pekerjaan' => 'Software Engineer di BUMN',
            'kesan_pesan' => 'Belajar di Al-Fattah membentuk disiplin dan ketahanan mental luar biasa. Tidak hanya ilmu umum dan coding yang didapat, tapi fondasi agama yang kuat.',
            'photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=400&auto=format&fit=crop'
        ]);

        Alumni::create([
            'name' => 'Siti Nur Aisyah, S.Ked.',
            'angkatan' => 'Angkatan 2019',
            'pekerjaan' => 'Dokter Muda / Mahasiswa Profesi',
            'kesan_pesan' => 'Bimbingan para Ustadz dan Ustadzah memberikan suasana hafalan Al-Qur\'an yang nyaman. Bismillah, ilmunya sangat bermanfaat hingga saat ini.',
            'photo' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=400&auto=format&fit=crop'
        ]);

        Alumni::create([
            'name' => 'Muhammad Rizky',
            'angkatan' => 'Angkatan 2021',
            'pekerjaan' => 'Mahasiswa Universitas Al-Azhar Kairo',
            'kesan_pesan' => 'Program Bilingual dan kajian kitab kuning di Al-Fattah memudahkan langkah saya menembus universitas impian di Timur Tengah.',
            'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=400&auto=format&fit=crop'
        ]);

        // 7. Video Kegiatan (Youtube ID)
        Video::truncate();
        Video::create([
            'title' => 'Profil Pondok Pesantren Al-Fattah Tigaraksa',
            'link' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'description' => 'Mengenal lebih dekat lingkungan, fasilitas, serta aktivitas santri di Pondok Pesantren Al-Fattah.'
        ]);

        Video::create([
            'title' => 'Kegiatan Ekstrakurikuler Hadrah & Marcing Band Santri',
            'link' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'description' => 'Aksi kreasi santri dalam menyalurkan bakat seni musik islami dan marcing band.'
        ]);

        Video::create([
            'title' => 'Dokumentasi Wisuda Tahfidz & Imtihan Santri',
            'link' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'description' => 'Momen keharuan dan kebanggaan pada prosesi wisuda tahfidz Al-Qur’an.'
        ]);
    }
}
