<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mapel', function (Blueprint $table) {
            if (!Schema::hasColumn('mapel', 'jenjang')) {
                $table->string('jenjang')->default('Semua')->after('nama_mapel'); // SMP, SMK, Semua
            }
            if (!Schema::hasColumn('mapel', 'jurusan')) {
                $table->string('jurusan')->nullable()->after('jenjang'); // RPL, TKJ, dll (khusus SMK)
            }
        });

        Schema::table('kelas', function (Blueprint $table) {
            if (!Schema::hasColumn('kelas', 'jenjang')) {
                $table->string('jenjang')->default('SMP')->after('nama_kelas'); // SMP, SMK
            }
            if (!Schema::hasColumn('kelas', 'jurusan')) {
                $table->string('jurusan')->nullable()->after('jenjang'); // RPL, TKJ, dll
            }
        });
    }

    public function down(): void
    {
        Schema::table('mapel', function (Blueprint $table) {
            $table->dropColumn(['jenjang', 'jurusan']);
        });

        Schema::table('kelas', function (Blueprint $table) {
            $table->dropColumn(['jenjang', 'jurusan']);
        });
    }
};
