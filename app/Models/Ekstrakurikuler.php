<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ekstrakurikuler extends Model
{
    use HasUuids;

    protected $table = 'ekstrakurikulers';
    protected $primaryKey = 'id_ekstrakurikuler';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_user', 'nama', 'jadwal', 'deskripsi', 'gambar'];

    
    public function getGambarUrlAttribute(): ?string
    {
        if (!$this->gambar) {
            return null;
        }

        return Storage::disk('public')->exists($this->gambar)
            ? asset('storage/' . $this->gambar)
            : null;
    }
}