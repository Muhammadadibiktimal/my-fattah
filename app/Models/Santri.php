<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

    protected $table = 'santri';

    protected $fillable = [
        'user_id',
        'pendaftar_id',
        'nisn',
        'nama_lengkap',
        'kelas_id',
        'jenjang',
        'jurusan',
        'jenis_kelamin',
        'no_hp',
        'alamat',
        'status',
        'status_kenaikan',
        'catatan_kenaikan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'santri_id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'santri_id');
    }
}
