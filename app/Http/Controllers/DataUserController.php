<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Http\Request;

class DataUserController extends Controller
{
    public function create()
    {
        $siswas = Siswa::latest()->get();
        $gurus  = Guru::latest()->get();

        return view('data-user.create', compact('siswas', 'gurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis'            => 'required|string|max:20|unique:siswa,nis',
            'nama'           => 'required|string|max:100',
            'jenis_kelamin'  => 'required|in:L,P',
            'kelas'          => 'required|string|max:20',
            'sekolah_asal'   => 'nullable|string|max:100',
            'tanggal_lahir'  => 'nullable|date',
            'alamat'         => 'nullable|string',
            'no_hp'          => 'nullable|string|max:20',
        ]);

        Siswa::create($request->only([
            'nis', 'nama', 'jenis_kelamin', 'kelas',
            'sekolah_asal',
            'jurusan', 'tanggal_lahir', 'alamat', 'no_hp'
        ]));

        return redirect()->route('siswa-guru.create')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function editSiswa(Siswa $siswa)
    {
        return view('data-user.edit-siswa', compact('siswa'));
    }

    public function updateSiswa(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nis'            => 'required|string|max:20|unique:siswa,nis,' . $siswa->id,
            'nama'           => 'required|string|max:100',
            'jenis_kelamin'  => 'required|in:L,P',
            'kelas'          => 'required|string|max:20',
            'sekolah_asal'   => 'nullable|string|max:100',
            'tanggal_lahir'  => 'nullable|date',
            'alamat'         => 'nullable|string',
            'no_hp'          => 'nullable|string|max:20',
        ]);

        $siswa->update($request->only([
            'nis', 'nama', 'jenis_kelamin', 'kelas',
            'sekolah_asal',
            'jurusan', 'tanggal_lahir', 'alamat', 'no_hp'
        ]));

        return redirect()->route('siswa-guru.create')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroySiswa(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('siswa-guru.create')
            ->with('success', 'Data siswa berhasil dihapus.');
    }

    public function storeGuru(Request $request)
    {
        $request->validate([
            'nip'     => 'nullable|string|max:30|unique:gurus,nip',
            'nama'    => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tipe'    => 'required|in:guru,staff',
        ]);

        Guru::create($request->only(['nip', 'nama', 'jabatan', 'tipe']));

        return redirect()->route('siswa-guru.create')
            ->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function editGuru(Guru $guru)
    {
        return view('data-user.edit-guru', compact('guru'));
    }

    public function updateGuru(Request $request, Guru $guru)
    {
        $request->validate([
            'nip'     => 'nullable|string|max:30|unique:gurus,nip,' . $guru->id,
            'nama'    => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tipe'    => 'required|in:guru,staff',
        ]);

        $guru->update($request->only(['nip', 'nama', 'jabatan', 'tipe']));

        return redirect()->route('siswa-guru.create')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroyGuru(Guru $guru)
    {
        $guru->delete();

        return redirect()->route('siswa-guru.create')
            ->with('success', 'Data guru berhasil dihapus.');
    }
}
