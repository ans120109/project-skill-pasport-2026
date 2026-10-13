<?php

namespace Database\Seeders;

use App\Models\NilaiUjikom;
use Illuminate\Database\Seeder;

class NilaiUjikomSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Andi Pratama',   'kelas' => 'XII RPL 1', 'nilai_penguji1' => 85, 'nilai_penguji2' => 90, 'nilai_penguji3' => 77],
            ['nama' => 'Bunga Lestari',  'kelas' => 'XII RPL 1', 'nilai_penguji1' => 65, 'nilai_penguji2' => 70, 'nilai_penguji3' => 75],
            ['nama' => 'Citra Ayu',      'kelas' => 'XII RPL 1', 'nilai_penguji1' => 75, 'nilai_penguji2' => 73, 'nilai_penguji3' => 88],
            ['nama' => 'Dimas Saputra',  'kelas' => 'XII RPL 2', 'nilai_penguji1' => 72, 'nilai_penguji2' => 68, 'nilai_penguji3' => 80],
            ['nama' => 'Eka Ramadhan',   'kelas' => 'XII RPL 2', 'nilai_penguji1' => 55, 'nilai_penguji2' => 50, 'nilai_penguji3' => 60],
            ['nama' => 'Farah Nabila',   'kelas' => 'XII RPL 2', 'nilai_penguji1' => 92, 'nilai_penguji2' => 95, 'nilai_penguji3' => 79],
            ['nama' => 'Gilang Permana', 'kelas' => 'XII TKJ 1', 'nilai_penguji1' => 60, 'nilai_penguji2' => 65, 'nilai_penguji3' => 70],
            ['nama' => 'Hana Safira',    'kelas' => 'XII TKJ 1', 'nilai_penguji1' => 88, 'nilai_penguji2' => 90, 'nilai_penguji3' => 75],
            ['nama' => 'Irfan Maulana',  'kelas' => 'XII TKJ 1', 'nilai_penguji1' => 70, 'nilai_penguji2' => 74, 'nilai_penguji3' => 70],
            ['nama' => 'Jihan Amelia',   'kelas' => 'XII TKJ 2', 'nilai_penguji1' => 45, 'nilai_penguji2' => 50, 'nilai_penguji3' => 90],
        ];

        foreach ($data as $item) {
            NilaiUjikom::updateOrCreate(['nama' => $item['nama']], $item);
        }
    }
}
