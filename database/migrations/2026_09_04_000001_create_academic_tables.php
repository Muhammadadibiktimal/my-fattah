<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Kelas
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas'); // e.g. 7A, 7B, 8A, 8B, 9A, 9B
            $table->string('tingkat')->default('7'); // 7, 8, 9, 10, 11, 12
            $table->string('wali_kelas')->nullable();
            $table->timestamps();
        });

        // 2. Tabel Mata Pelajaran (Mapel)
        Schema::create('mapel', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mapel')->unique(); // e.g. QUR, FIQ, ARB, MTK
            $table->string('nama_mapel'); // e.g. Al-Qur'an Hadits, Fiqih, Bahasa Arab
            $table->integer('kkm')->default(75);
            $table->timestamps();
        });

        // 3. Tabel Santri (Siswa Aktif)
        Schema::create('santri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('pendaftar_id')->nullable()->constrained('pendaftar')->nullOnDelete();
            $table->string('nisn')->nullable()->unique();
            $table->string('nama_lengkap');
            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->nullOnDelete();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->default('Laki-laki');
            $table->string('no_hp')->nullable();
            $table->text('alamat')->nullable();
            $table->enum('status', ['Aktif', 'Alumni', 'Non-Aktif'])->default('Aktif');
            $table->timestamps();
        });

        // 4. Tabel Nilai
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santri')->cascadeOnDelete();
            $table->foreignId('mapel_id')->constrained('mapel')->cascadeOnDelete();
            $table->foreignId('kelas_id')->constrained('kelas')->cascadeOnDelete();
            $table->foreignId('guru_id')->nullable()->constrained('users')->nullOnDelete();
            $table->decimal('nilai_tugas', 5, 2)->default(0);
            $table->decimal('nilai_uts', 5, 2)->default(0);
            $table->decimal('nilai_uas', 5, 2)->default(0);
            $table->decimal('nilai_akhir', 5, 2)->default(0);
            $table->string('predikat', 2)->default('C'); // A, B, C, D
            $table->string('semester')->default('Ganjil'); // Ganjil / Genap
            $table->string('tahun_ajaran')->default('2026/2027');
            $table->timestamps();

            $table->unique(['santri_id', 'mapel_id', 'semester', 'tahun_ajaran']);
        });

        // 5. Tabel Absensi
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santri')->cascadeOnDelete();
            $table->foreignId('kelas_id')->constrained('kelas')->cascadeOnDelete();
            $table->foreignId('guru_id')->nullable()->constrained('users')->nullOnDelete();
            $table->date('tanggal');
            $table->enum('status', ['Hadir', 'Izin', 'Sakit', 'Alpa'])->default('Hadir');
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->unique(['santri_id', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensi');
        Schema::dropIfExists('nilai');
        Schema::dropIfExists('santri');
        Schema::dropIfExists('mapel');
        Schema::dropIfExists('kelas');
    }
};
