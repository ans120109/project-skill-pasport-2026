<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Galeri;
use App\Models\NilaiUjikom;
use App\Models\ProfilSekolah;

class DashboardController extends Controller
{
    public function index()
    {
        $nilai = NilaiUjikom::all();

        return view('user.dashboard', [
            'profil'          => ProfilSekolah::first(),
            'totalPeserta'    => $nilai->count(),
            'totalLulus'      => $nilai->where('lulus', true)->count(),
            'beritaTerbaru'   => Berita::latest()->take(3)->get(),
            'ekstrakurikuler' => Ekstrakurikuler::latest()->take(4)->get(),
            'galeriTerbaru'   => Galeri::latest()->take(4)->get(),
        ]);
    }
}
