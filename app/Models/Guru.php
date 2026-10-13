<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus';

    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'tipe',
        'foto',
        'urutan',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    public function getInisialAttribute(): string
    {
        $kata = preg_split('/\s+/', preg_replace('/^(Drs?\.|Dra\.|Hj\.|H\.)\s*/i', '', trim($this->nama)));

        return Str::upper(Str::substr($kata[0] ?? '', 0, 1) . Str::substr($kata[1] ?? '', 0, 1));
    }
}
