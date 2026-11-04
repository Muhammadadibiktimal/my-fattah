<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapel';

    protected $fillable = [
        'kode_mapel',
        'nama_mapel',
        'jenjang',
        'jurusan',
        'kkm',
    ];

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'mapel_id');
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'mapel_id');
    }
}
