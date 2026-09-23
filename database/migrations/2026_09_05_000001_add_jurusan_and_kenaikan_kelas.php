<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tambah jurusan ke pendaftar
        Schema::table('pendaftar', function (Blueprint $table) {
            if (!Schema::hasColumn('pendaftar', 'jurusan')) {
                $table->string('jurusan')->nullable()->after('jenjang');
            }
        });

        // 2. Tambah kontrol kenaikan kelas & jenjang/jurusan ke santri
        Schema::table('santri', function (Blueprint $table) {
            if (!Schema::hasColumn('santri', 'jenjang')) {
                $table->string('jenjang')->nullable()->after('kelas_id');
            }
            if (!Schema::hasColumn('santri', 'jurusan')) {
                $table->string('jurusan')->nullable()->after('jenjang');
            }
            if (!Schema::hasColumn('santri', 'status_kenaikan')) {
                $table->string('status_kenaikan')->nullable()->default('Aktif')->after('status');
            }
            if (!Schema::hasColumn('santri', 'catatan_kenaikan')) {
                $table->text('catatan_kenaikan')->nullable()->after('status_kenaikan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pendaftar', function (Blueprint $table) {
            if (Schema::hasColumn('pendaftar', 'jurusan')) {
                $table->dropColumn('jurusan');
            }
        });

        Schema::table('santri', function (Blueprint $table) {
            $table->dropColumn(['jenjang', 'jurusan', 'status_kenaikan', 'catatan_kenaikan']);
        });
    }
};
