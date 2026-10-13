<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::orderBy('nama')->get();

        $totalSiswa    = $siswa->count();
        $totalLaki     = $siswa->where('jenis_kelamin', 'L')->count();
        $totalPerempuan = $siswa->where('jenis_kelamin', 'P')->count();

        return view('data-siswa.index', compact(
            'siswa', 'totalSiswa', 'totalLaki', 'totalPerempuan'
        ));
    }
}
