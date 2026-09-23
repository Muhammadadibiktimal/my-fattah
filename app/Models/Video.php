<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['title', 'description', 'link'];

    // Ambil ID YouTube dari URL yang disimpan di kolom "link"
    public function getYoutubeIdAttribute()
    {
        // contoh: https://www.youtube.com/watch?v=abc123xyz
        parse_str(parse_url($this->link, PHP_URL_QUERY), $params);
        return $params['v'] ?? null;
    }
}
