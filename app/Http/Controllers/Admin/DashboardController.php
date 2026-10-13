<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\ProfilSekolah;
use App\Models\Siswa;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        if (!in_array(auth()->user()->role, ['admin', 'operator'])) {
            return view('dashboard-pengguna', [
                'profil'          => ProfilSekolah::first(),
                'beritaTerbaru'   => Berita::latest()->take(3)->get(),
                'ekstrakurikuler' => Ekstrakurikuler::latest()->take(4)->get(),
                'galeriTerbaru'   => Galeri::latest()->take(4)->get(),
            ]);
        }

        $profil = ProfilSekolah::first();

        
        $totalSiswa  = $profil?->jumlah_siswa  ?? Siswa::count();
        $totalGuru   = $profil?->jumlah_guru   ?? Guru::count();
        $totalEkskul = $profil?->jumlah_ekskul ?? Ekstrakurikuler::count();

        
        $totalBerita = Berita::count();
        $totalGaleri = Galeri::count();
        $akunPerRole = User::selectRaw('role, count(*) as total')->groupBy('role')->pluck('total', 'role');


        $daftarSiswa = Siswa::orderBy('nama')->get();
        $guruBaru   = Guru::latest()->take(5)->get();
        $beritaBaru = Berita::latest()->take(4)->get();

        return view('admin.dashboard', compact(
            'profil', 'totalSiswa', 'totalGuru', 'totalEkskul',
            'totalBerita', 'totalGaleri', 'akunPerRole',
            'daftarSiswa', 'guruBaru', 'beritaBaru'
        ));
    }
}