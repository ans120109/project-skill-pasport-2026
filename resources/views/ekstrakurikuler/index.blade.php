@extends('layout.app')

@section('title', 'Ekstrakurikuler')

@push('styles')
@include('partials.ui-styles')
<style>
    .page-header {
        display: flex; justify-content: space-between; align-items: flex-start;
        gap: 16px; flex-wrap: wrap;
    }
    .ekskul-grid {
        display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 16px; margin-top: 16px;
    }
    .ekskul-card {
        background: #fff; border: 1px solid #e5e7eb; border-radius: 12px;
        overflow: hidden; display: flex; flex-direction: column;
    }
    .ekskul-card img, .ekskul-noimg {
        width: 100%; height: 160px; object-fit: cover; display: block; background: #e9e6df;
    }
    .ekskul-noimg { display: flex; align-items: center; justify-content: center; font-size: 36px; }
    .ekskul-body { padding: 14px 16px 16px; display: flex; flex-direction: column; flex: 1; }
    .ekskul-body h3 { margin: 0 0 8px; font-size: 16px; color: #0f1f4b; }
    .badge-jadwal {
        display: inline-block; background: #fdf3dc; color: #8a5a00; padding: 3px 10px;
        border-radius: 999px; font-size: 11px; font-weight: 600; margin-bottom: 8px; align-self: flex-start;
    }
    .ekskul-body p { margin: 0 0 10px; font-size: 13px; line-height: 1.6; color: #4b5563; }
    .ekskul-link { margin-top: auto; font-size: 12px; font-weight: 600; color: #d99a22; text-decoration: none; }
    .ekskul-link:hover { text-decoration: underline; }
    .ekskul-body .aksi { margin-top: 12px; }
</style>
@endpush

@section('content')
@php
    $bisaKelola = auth()->check() && in_array(auth()->user()->role, ['admin', 'operator']);
    $daftar = $ekstrakurikuler ?? $ekstrakurikulers ?? $data ?? collect();
@endphp

<div class="container">
    <div class="page-header">
        <div>
            <h1 class="page-title">Ekstrakurikuler</h1>
            <p class="page-subtitle">Kegiatan pengembangan bakat dan minat siswa.</p>
        </div>
        @if ($bisaKelola)
            <a href="{{ route('ekstrakurikuler.create') }}" class="btn btn-tambah">Tambah Ekstrakurikuler</a>
        @endif
    </div>
    <hr class="divider">

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="ekskul-grid">
        @forelse ($daftar as $item)
            <div class="ekskul-card">
                @if ($item->gambar)
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}">
                @else
                    <div class="ekskul-noimg">⚽</div>
                @endif

                <div class="ekskul-body">
                    <h3>{{ $item->nama }}</h3>
                    @if ($item->jadwal)
                        <span class="badge-jadwal">🕒 {{ $item->jadwal }}</span>
                    @endif
                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi ?? ''), 90) }}</p>

                    <a href="{{ route('ekstrakurikuler.show', $item->getKey()) }}" class="ekskul-link">Lihat detail →</a>

                    @if ($bisaKelola)
                        <div class="aksi">
                            <a href="{{ route('ekstrakurikuler.edit', $item->getKey()) }}" class="btn btn-edit btn-sm">Edit</a>
                            <form action="{{ route('ekstrakurikuler.destroy', $item->getKey()) }}" method="POST"
                                  onsubmit="return confirm('Hapus ekstrakurikuler ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-hapus btn-sm">Hapus</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="empty" style="grid-column: 1 / -1;">Belum ada data ekstrakurikuler.</div>
        @endforelse
    </div>
</div>
@endsection