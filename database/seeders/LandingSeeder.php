<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\ProfilSekolah;
use Illuminate\Database\Seeder;

class LandingSeeder extends Seeder
{
    public function run(): void
    {
        ProfilSekolah::updateOrCreate(['id' => 1], [
            'nama_sekolah'  => 'SMA Cendikia Nusantara',
            'npsn'          => '20212345',
            'akreditasi'    => 'A',
            'tahun_berdiri' => 2005,
            'tentang'       => 'SMA Cendikia Nusantara adalah sekolah menengah atas yang berkomitmen mencetak lulusan berprestasi, berkarakter, dan siap melanjutkan ke perguruan tinggi maupun dunia kerja.',
            'visi'          => 'Menjadi sekolah unggul yang melahirkan generasi cerdas, berakhlak mulia, dan berwawasan global.',
            'misi'          => "Menyelenggarakan pembelajaran aktif, kreatif, dan menyenangkan.\nMenanamkan nilai karakter dan budaya disiplin.\nMengembangkan prestasi akademik dan nonakademik siswa.\nMenjalin kerja sama dengan orang tua, masyarakat, dan dunia usaha.",
            'alamat'        => 'Jl. Pendidikan No. 1, Tasikmalaya, Jawa Barat',
            'telepon'       => '(0265) 123456',
            'email'         => 'info@sma-cendikia.sch.id',
        ]);

        $data = [
            ['Drs. Ahmad Fauzi, M.Pd.', 'Kepala Sekolah',       'guru',  1],
            ['Siti Nurhaliza, S.Pd.',   'Guru Matematika',      'guru',  2],
            ['Budi Santoso, S.Si.',     'Guru Fisika',          'guru',  3],
            ['Rina Kartika, S.Pd.',     'Guru Bahasa Indonesia','guru',  4],
            ['Dedi Hermawan, S.Pd.',    'Guru Bahasa Inggris',  'guru',  5],
            ['Alfa Nur Shidiq, S.Kom.', 'Kepala Tata Usaha',    'staff', 1],
            ['Wati Susilawati',         'Staf Administrasi',    'staff', 2],
            ['Asep Saepudin',           'Petugas Perpustakaan', 'staff', 3],
        ];

        foreach ($data as [$nama, $jabatan, $tipe, $urutan]) {
            Guru::updateOrCreate(
                ['nama' => $nama],
                ['jabatan' => $jabatan, 'tipe' => $tipe, 'urutan' => $urutan, 'aktif' => true]
            );
        }
    }
}