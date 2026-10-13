<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Ekstrakurikuler;

class DashboardController extends Controller
{
    public function index()
    {
        $beritaTerbaru = Berita::latest()->take(3)->get();
        $ekstrakurikuler = Ekstrakurikuler::latest()->take(4)->get();

        return view('siswa.dashboard', compact('beritaTerbaru', 'ekstrakurikuler'));
    }
}