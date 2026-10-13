<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiUjikom extends Model
{
    protected $fillable = [
        'nama',
        'kelas',
        'nilai_penguji1',
        'nilai_penguji2',
        'nilai_penguji3',
    ];

    public function getNilaiAkhirAttribute(): int
    {
        return (int) round(($this->nilai_penguji1 + $this->nilai_penguji2 + $this->nilai_penguji3) / 3);
    }

    public function getLulusAttribute(): bool
    {
        return $this->nilai_akhir >= 75;
    }

    public function getStatusAttribute(): string
    {
        return $this->lulus ? 'Lulus' : 'Tidak Lulus';
    }
}
