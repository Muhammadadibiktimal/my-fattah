<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Santri;
use App\Models\Pendaftar;

class PesantrenFullstackTest extends TestCase
{
    public function test_home_page_contains_login_and_daftar_santri_baru()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Login');
        $response->assertSee('Daftar Santri Baru');
    }

    public function test_pendaftaran_page_is_accessible()
    {
        $response = $this->get('/pendaftaran');

        $response->assertStatus(200);
        $response->assertSee('Formulir Pendaftaran Santri');
        $response->assertSee('Lanjut ke Pembayaran');
    }

    public function test_login_page_has_portal_options()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Portal Masuk Santri, Guru & Administrator');
        $response->assertSee('admin@gmail.com');
        $response->assertSee('guru@gmail.com');
        $response->assertSee('pendaftar@gmail.com');
    }

    public function test_guru_can_access_guru_portal_and_only_guru_features()
    {
        $guru = User::where('email', 'guru@gmail.com')->first();
        if (!$guru) {
            $guru = User::create([
                'name' => 'Ustadz Ahmad Fauzi',
                'email' => 'guru@gmail.com',
                'password' => bcrypt('password123'),
                'role' => 'guru',
            ]);
        }

        // 1. Guru Dashboard
        $response = $this->actingAs($guru)->get('/guru/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Portal Guru');

        // 2. Input Nilai
        $response = $this->actingAs($guru)->get('/guru/nilai');
        $response->assertStatus(200);
        $response->assertSee('Input Nilai Santri');

        // 3. Input Absensi
        $response = $this->actingAs($guru)->get('/guru/absensi');
        $response->assertStatus(200);
        $response->assertSee('Input Absensi Harian Santri');

        // 4. Rekap Nilai
        $response = $this->actingAs($guru)->get('/guru/rekap');
        $response->assertStatus(200);
        $response->assertSee('Rekapitulasi Nilai');

        // 5. Guru cannot access Admin Dashboard (redirected to guru dashboard)
        $response = $this->actingAs($guru)->get('/admin/dashboard');
        $response->assertRedirect('/guru/dashboard');
    }

    public function test_admin_can_access_all_data_and_midtrans_transactions()
    {
        $admin = User::where('email', 'admin@gmail.com')->first();
        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin Al-Fattah',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]);
        }

        // 1. Admin Dashboard
        $response = $this->actingAs($admin)->get('/admin/dashboard');
        $response->assertStatus(200);

        // 2. Transaksi Midtrans
        $response = $this->actingAs($admin)->get('/admin/transaksi');
        $response->assertStatus(200);
        $response->assertSee('Data Pembayaran Midtrans');

        // 3. Data Santri Aktif
        $response = $this->actingAs($admin)->get('/admin/santri');
        $response->assertStatus(200);
        $response->assertSee('Data Santri & Siswa Aktif');

        // 4. Data Guru
        $response = $this->actingAs($admin)->get('/admin/guru');
        $response->assertStatus(200);
        $response->assertSee('Data Guru & Pengajar');

        // 5. Data Kelas
        $response = $this->actingAs($admin)->get('/admin/kelas');
        $response->assertStatus(200);
        $response->assertSee('Data Rombongan Belajar');

        // 6. Data Mapel
        $response = $this->actingAs($admin)->get('/admin/mapel');
        $response->assertStatus(200);
        $response->assertSee('Data Mata Pelajaran');
    }

    public function test_admin_can_create_account_for_calon_santri()
    {
        $admin = User::where('email', 'admin@gmail.com')->first();

        $pendaftar = Pendaftar::create([
            'nama' => 'Test Calon Santri Baru',
            'email' => 'calon.test.' . time() . '@example.com',
            'no_hp' => '081233445566',
            'order_id' => 'PSB-' . time(),
            'status_bayar' => 'settlement',
        ]);

        $response = $this->actingAs($admin)->post("/admin/pendaftar/{$pendaftar->id}/buat-akun", [
            'password' => 'PasswordSantri123',
        ]);

        $response->assertSessionHas('akun_created');
        $this->assertDatabaseHas('users', [
            'email' => $pendaftar->email,
            'role' => 'user',
        ]);
    }
}
