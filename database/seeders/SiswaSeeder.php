<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nis' => '2026001', 'nama' => 'Andi Pratama',   'jenis_kelamin' => 'L', 'kelas' => 'XII RPL 1', 'sekolah_asal' => 'SMP Negeri 1 Tasikmalaya'],
            ['nis' => '2026002', 'nama' => 'Bunga Lestari',  'jenis_kelamin' => 'P', 'kelas' => 'XII RPL 1', 'sekolah_asal' => 'SMP Negeri 2 Tasikmalaya'],
            ['nis' => '2026003', 'nama' => 'Citra Ayu',      'jenis_kelamin' => 'P', 'kelas' => 'XII RPL 1', 'sekolah_asal' => 'SMP Negeri 3 Tasikmalaya'],
            ['nis' => '2026004', 'nama' => 'Dimas Saputra',  'jenis_kelamin' => 'L', 'kelas' => 'XII RPL 2', 'sekolah_asal' => 'SMP Negeri 1 Tasikmalaya'],
            ['nis' => '2026005', 'nama' => 'Eka Ramadhan',   'jenis_kelamin' => 'L', 'kelas' => 'XII RPL 2', 'sekolah_asal' => 'SMP Negeri 5 Tasikmalaya'],
            ['nis' => '2026006', 'nama' => 'Farah Nabila',   'jenis_kelamin' => 'P', 'kelas' => 'XII RPL 2', 'sekolah_asal' => 'SMP Negeri 2 Tasikmalaya'],
            ['nis' => '2026007', 'nama' => 'Gilang Permana', 'jenis_kelamin' => 'L', 'kelas' => 'XII TKJ 1', 'sekolah_asal' => 'SMP Negeri 4 Tasikmalaya'],
            ['nis' => '2026008', 'nama' => 'Hana Safira',    'jenis_kelamin' => 'P', 'kelas' => 'XII TKJ 1', 'sekolah_asal' => 'SMP Negeri 1 Tasikmalaya'],
            ['nis' => '2026009', 'nama' => 'Irfan Maulana',  'jenis_kelamin' => 'L', 'kelas' => 'XII TKJ 1', 'sekolah_asal' => 'SMP Negeri 6 Tasikmalaya'],
            ['nis' => '2026010', 'nama' => 'Jihan Amelia',   'jenis_kelamin' => 'P', 'kelas' => 'XII TKJ 2', 'sekolah_asal' => 'SMP Negeri 3 Tasikmalaya'],
        ];

        foreach ($data as $item) {
            Siswa::updateOrCreate(['nis' => $item['nis']], $item);
        }
    }
}
