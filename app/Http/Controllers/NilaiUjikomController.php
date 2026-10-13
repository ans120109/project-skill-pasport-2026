<?php

namespace App\Http\Controllers;

use App\Models\NilaiUjikom;
use Illuminate\Http\Request;

class NilaiUjikomController extends Controller
{
    public function index()
    {
        $nilai = NilaiUjikom::orderBy('nama')->get();

        $totalPeserta     = $nilai->count();
        $totalLulus       = $nilai->where('lulus', true)->count();
        $totalTidakLulus  = $totalPeserta - $totalLulus;

        return view('nilai-ujikom.index', compact(
            'nilai', 'totalPeserta', 'totalLulus', 'totalTidakLulus'
        ));
    }

    public function create()
    {
        return view('nilai-ujikom.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'           => 'required|string|max:100',
            'kelas'          => 'required|string|max:20',
            'nilai_penguji1' => 'required|integer|min:0|max:100',
            'nilai_penguji2' => 'required|integer|min:0|max:100',
            'nilai_penguji3' => 'required|integer|min:0|max:100',
        ]);

        NilaiUjikom::create($data);

        return redirect()->route('nilai-ujikom.index')
            ->with('success', 'Data nilai ujikom berhasil ditambahkan.');
    }

    public function edit(NilaiUjikom $nilai)
    {
        return view('nilai-ujikom.edit', compact('nilai'));
    }

    public function update(Request $request, NilaiUjikom $nilai)
    {
        $data = $request->validate([
            'nama'           => 'required|string|max:100',
            'kelas'          => 'required|string|max:20',
            'nilai_penguji1' => 'required|integer|min:0|max:100',
            'nilai_penguji2' => 'required|integer|min:0|max:100',
            'nilai_penguji3' => 'required|integer|min:0|max:100',
        ]);

        $nilai->update($data);

        return redirect()->route('nilai-ujikom.index')
            ->with('success', 'Data nilai ujikom berhasil diperbarui.');
    }

    public function destroy(NilaiUjikom $nilai)
    {
        $nilai->delete();

        return redirect()->route('nilai-ujikom.index')
            ->with('success', 'Data nilai ujikom berhasil dihapus.');
    }
}
