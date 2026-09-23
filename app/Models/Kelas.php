<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'tingkat',
        'jenjang',
        'jurusan',
        'wali_kelas',
    ];

    public function santri()
    {
        return $this->hasMany(Santri::class, 'kelas_id');
    }

    public function santris()
    {
        return $this->santri();
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'kelas_id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'kelas_id');
    }
}
