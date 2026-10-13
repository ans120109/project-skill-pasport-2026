<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProfilSekolah extends Model
{
    protected $table = 'profil_sekolah';

    protected $fillable = [
        'nama_sekolah',
        'visi',
        'misi',
        'foto',
        'alamat',
        'telepon',
        'email',
        'sejarah',
        'tentang',
        'tujuan',
        'npsn',
        'akreditasi',
        'tahun_berdiri',
        'nama_kepsek',
        'sambutan',
        'jumlah_siswa',
        'jumlah_guru',
        'jumlah_ekskul',
        'fasilitas',
        'prestasi',
        'maps_url',
    ];
    public function daftar(string $field): array
    {
        $teks = (string) ($this->{$field} ?? '');

        return array_values(array_filter(
            array_map('trim', preg_split('/\r\n|\r|\n/', $teks)),
            fn ($baris) => $baris !== ''
        ));
    }

    public function getFotoUrlAttribute(): ?string
    {
        $foto = $this->foto;

        if (!$foto) {
            return null;
        }

        if (preg_match('#^https?://#i', $foto)) {
            return $foto;
        }

        $path = ltrim(str_replace('\\', '/', $foto), '/');
        $path = preg_replace('#^(public/|storage/)#', '', $path);

        if (Storage::disk('public')->exists($path)) {
            return asset('storage/' . $path);
        }

        if (file_exists(public_path($path))) {
            return asset($path);
        }

        $asli = ltrim(str_replace('\\', '/', $foto), '/');
        if (file_exists(public_path($asli))) {
            return asset($asli);
        }

        return null;
    }

    public function getDaftarMisiAttribute(): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $this->misi))
            ->map(fn ($m) => trim($m))
            ->filter()
            ->values()
            ->all();
    }
}