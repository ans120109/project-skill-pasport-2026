<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
        'status',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password'       => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function isInactive(): bool
    {
        return ! in_array(strtolower((string) $this->status), ['aktif', 'active', '1'], true);
    }

    public function canManageBerita(): bool
    {
        return in_array($this->role, ['admin', 'operator']);
    }

    public function dashboardUrl(): string
    {
        return match ($this->role){
            'admin', 'operator' => route('admin.dashboard'),
            'guru' => route('guru.dashboard'),
            'siswa' => route('siswa.dashboard'),
            'user' => route('user.dashboard'),
            default => url('/'),
        };
    }
}
