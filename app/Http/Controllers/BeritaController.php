<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::latest('tanggal')->latest('id')->paginate(10);
        return view('berita', compact('berita'));
    }

    public function create()
    {
        return view('berita.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'   => 'required|string|max:255',
            'isi'     => 'required|string',
            'penulis' => 'nullable|string|max:100',
            'tanggal' => 'nullable|date',
            'foto'    => 'nullable|image|max:2048',
        ]);

        $data['penulis'] = $data['penulis'] ?? auth()->user()->name;
        $data['tanggal'] = $data['tanggal'] ?? now()->toDateString();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show(Berita $berita)
    {
        return view('berita.show', compact('berita'));
    }

    public function edit(Berita $berita)
    {
        return view('berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $data = $request->validate([
            'judul'   => 'required|string|max:255',
            'isi'     => 'required|string',
            'penulis' => 'nullable|string|max:100',
            'tanggal' => 'nullable|date',
            'foto'    => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($berita->foto) {
                Storage::disk('public')->delete($berita->foto);
            }
            $data['foto'] = $request->file('foto')->store('berita', 'public');
        }

        $berita->update($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->foto) {
            Storage::disk('public')->delete($berita->foto);
        }
        $berita->delete();

        return back()->with('success', 'Berita dihapus.');
    }
}