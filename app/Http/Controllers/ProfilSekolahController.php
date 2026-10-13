<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilSekolahController extends Controller
{
    private function ambilProfil(): ProfilSekolah
    {
        return ProfilSekolah::first() ?? ProfilSekolah::create([
            'nama_sekolah' => 'SMA Cendikia Nusantara',
        ]);
    }

    private function hanyaAdmin(): void
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403, 'Hanya admin yang boleh mengubah profil sekolah.');
    }

    public function index()
    {
        $profil = $this->ambilProfil();

        return view('profile-sekolah.index', compact('profil'));
    }

    public function edit()
    {
        $this->hanyaAdmin();

        $profil = $this->ambilProfil();

        return view('profile-sekolah.edit', compact('profil'));
    }

    public function update(Request $request)
    {
        $this->hanyaAdmin();

        $profil = $this->ambilProfil();

        $data = $request->validate([
            'nama_sekolah'  => 'required|string|max:255',
            'tentang'       => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'visi'          => 'nullable|string',
            'misi'          => 'nullable|string',
            'tujuan'        => 'nullable|string',
            'sejarah'       => 'nullable|string',
            'npsn'          => 'nullable|string|max:20',
            'akreditasi'    => 'nullable|string|max:10',
            'tahun_berdiri' => 'nullable|digits:4',
            'alamat'        => 'nullable|string|max:255',
            'telepon'       => 'nullable|string|max:30',
            'email'         => 'nullable|email|max:255',
            'nama_kepsek'   => 'nullable|string|max:255',
            'sambutan'      => 'nullable|string',
            'jumlah_siswa'  => 'nullable|integer|min:0',
            'jumlah_guru'   => 'nullable|integer|min:0',
            'jumlah_ekskul' => 'nullable|integer|min:0',
            'fasilitas'     => 'nullable|string',
            'prestasi'      => 'nullable|string',
            'maps_url'      => 'nullable|url',
        ]);

        if ($request->hasFile('foto')) {
            if ($profil->foto && Storage::disk('public')->exists($profil->foto)) {
                Storage::disk('public')->delete($profil->foto);
            }
            $data['foto'] = $request->file('foto')->store('profil', 'public');
        } else {
            unset($data['foto']);
        }

        $profil->update($data);

        return redirect()->route('profile-sekolah.index')
            ->with('success', 'Profil sekolah berhasil diperbarui.');
    }
}