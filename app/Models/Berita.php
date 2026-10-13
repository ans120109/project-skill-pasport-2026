<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = ['judul', 'isi', 'penulis', 'tanggal', 'foto'];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function getGambarUrlAttribute(): ?string
    {
        $foto = $this->foto;

        if (!$foto) {
            return null;
        }

        if (Str::startsWith($foto, ['http://', 'https://'])) {
            return $foto;
        }

        $asli = ltrim(str_replace('\\', '/', $foto), '/');
        $path = preg_replace('#^(public/|storage/)#', '', $asli);

        if (Storage::disk('public')->exists($path)) {
            return asset('storage/' . $path);
        }

        foreach (['', 'storage/', 'uploads/', 'asset/image/', 'asset/', 'images/'] as $folder) {
            if (file_exists(public_path($folder . $path))) {
                return asset($folder . $path);
            }
        }

        if (file_exists(public_path($asli))) {
            return asset($asli);
        }

        return null;
    }
}