<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftar', function (Blueprint $table) {
            $table->string('nik')->nullable();
            $table->string('nisn')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin')->nullable()->default('Laki-laki');
            $table->string('jenjang')->nullable()->default('SMP');
            $table->string('asal_sekolah')->nullable();
            $table->string('alamat_sekolah')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('no_hp_ortu')->nullable();
            $table->text('alamat')->nullable();
            $table->string('file_kk')->nullable();
            $table->string('file_akta')->nullable();
            $table->string('file_ijazah')->nullable();
            $table->string('file_foto')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pendaftar', function (Blueprint $table) {
            $table->dropColumn([
                'nik', 'nisn', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'jenjang',
                'asal_sekolah', 'alamat_sekolah', 'nama_ayah', 'pekerjaan_ayah', 'nama_ibu',
                'pekerjaan_ibu', 'no_hp_ortu', 'alamat', 'file_kk', 'file_akta', 'file_ijazah', 'file_foto'
            ]);
        });
    }
};
