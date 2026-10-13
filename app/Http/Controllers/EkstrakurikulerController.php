<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EkstrakurikulerController extends Controller
{
    private function bisaKelola(): bool
    {
        return auth()->check() && in_array(auth()->user()->role, ['admin', 'operator']);
    }

    private function aturan(): array
    {
        return [
            'nama'      => 'required|string|max:255',
            'jadwal'    => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function index()
    {
        $ekstrakurikuler = Ekstrakurikuler::latest()->get();
        $bisaKelola = $this->bisaKelola();

        return view('ekstrakurikuler.index', compact('ekstrakurikuler', 'bisaKelola'));
    }

    public function create()
    {
        abort_unless($this->bisaKelola(), 403);
        return view('ekstrakurikuler.create');
    }

    public function store(Request $request)
    {
        abort_unless($this->bisaKelola(), 403);

        $data = $request->validate($this->aturan());

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('ekstrakurikuler', 'public');
        }

        Ekstrakurikuler::create($data);

        return redirect()->route('ekstrakurikuler.index')
            ->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    public function show(Ekstrakurikuler $ekstrakurikuler)
    {
        return view('ekstrakurikuler.show', compact('ekstrakurikuler'));
    }

    public function edit(Ekstrakurikuler $ekstrakurikuler)
    {
        abort_unless($this->bisaKelola(), 403);
        return view('ekstrakurikuler.edit', compact('ekstrakurikuler'));
    }

    public function update(Request $request, Ekstrakurikuler $ekstrakurikuler)
    {
        abort_unless($this->bisaKelola(), 403);

        $data = $request->validate($this->aturan());

        if ($request->hasFile('gambar')) {
            if ($ekstrakurikuler->gambar) {
                Storage::disk('public')->delete($ekstrakurikuler->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('ekstrakurikuler', 'public');
        } else {
            unset($data['gambar']);
        }

        $ekstrakurikuler->update($data);

        return redirect()->route('ekstrakurikuler.index')
            ->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    public function destroy(Ekstrakurikuler $ekstrakurikuler)
    {
        abort_unless($this->bisaKelola(), 403);

        if ($ekstrakurikuler->gambar) {
            Storage::disk('public')->delete($ekstrakurikuler->gambar);
        }
        $ekstrakurikuler->delete();

        return redirect()->route('ekstrakurikuler.index')
            ->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }
}