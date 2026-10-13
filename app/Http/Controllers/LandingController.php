<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\ProfilSekolah;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing', [
            'beritas' => Berita::latest()->take(6)->get(),
            'ekskuls' => Ekstrakurikuler::latest()->take(3)->get(),
            'galeris' => Galeri::latest()->take(3)->get(),
            'profil'  => ProfilSekolah::first(),
            'gurus'   => $this->daftarGuru(),
            'staffs'  => $this->daftarStaff(),
        ]);
    }

    public function profil()
    {
        return view('halaman.profil', [
            'profil' => ProfilSekolah::first(),
        ]);
    }

    public function guruStaff()
    {
        return view('halaman.guru-staff', [
            'gurus'  => $this->daftarGuru(),
            'staffs' => $this->daftarStaff(),
        ]);
    }

    private function daftarGuru()
    {
        return Guru::where('tipe', 'guru')
            ->where('aktif', true)
            ->orderBy('urutan')
            ->orderBy('nama')
            ->get();
    }

    private function daftarStaff()
    {
        return Guru::where('tipe', 'staff')
            ->where('aktif', true)
            ->orderBy('urutan')
            ->orderBy('nama')
            ->get();
    }
}
