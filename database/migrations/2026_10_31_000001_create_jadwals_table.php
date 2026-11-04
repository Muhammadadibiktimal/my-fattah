<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('jadwals')) {
            Schema::create('jadwals', function (Blueprint $table) {
                $table->id();
                $table->string('hari'); // Senin, Selasa, Rabu, Kamis, Jumat, Sabtu
                $table->integer('jam_ke'); // 1, 2, 3, 4, 5, 6, 7
                $table->string('waktu'); // e.g. "07.30 - 08.05", "08.00 - 08.35"
                $table->foreignId('kelas_id')->constrained('kelas')->cascadeOnDelete();
                $table->foreignId('mapel_id')->nullable()->constrained('mapel')->nullOnDelete();
                $table->foreignId('guru_id')->nullable()->constrained('users')->nullOnDelete();
                $table->string('kode_guru')->nullable(); // e.g. "H", "M", "S"
                $table->string('kode_mapel')->nullable(); // e.g. "8", "20", "21"
                $table->string('kode_gabungan')->nullable(); // e.g. "H8", "M20"
                $table->string('ruang')->nullable();
                $table->string('keterangan')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};

