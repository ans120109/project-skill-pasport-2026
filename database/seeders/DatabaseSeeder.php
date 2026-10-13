<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {

       User::create([
        'name' => 'Alfa Nur Shidiq',
        'username' => 'babeh12',
        'password' => '12345678',
        'role' => 'admin',
       ]);

       $this->call(NilaiUjikomSeeder::class);
       $this->call(SiswaSeeder::class);
       $this->call(LandingSeeder::class);
    }
}
