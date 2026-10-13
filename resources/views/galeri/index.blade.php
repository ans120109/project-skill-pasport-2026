@extends('layout.app')

@section('title', 'Galeri')

@push('styles')
@include('partials.ui-styles')
<style>
    .page-header {
        display: flex; justify-content: space-between; align-items: flex-start;
        gap: 16px; flex-wrap: wrap;
    }

    .galeri-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 16px;
    }
    .galeri-card {
        background: #fff; border-radius: 10px; overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, .08);
        display: flex; flex-direction: column;
    }
    .galeri-card img {
        width: 100%; aspect-ratio: 3 / 4; object-fit: cover;
        object-position: top center; display: block; background: #e9e6df;
    }
    .galeri-body { padding: 12px 14px 14px; display: flex; flex-direction: column; flex: 1; }
    .galeri-body h3 { margin: 0 0 4px; font-size: 15px; }
    .galeri-body p { margin: 0 0 8px; color: var(--muted); font-size: 12px; }
    .galeri-body .galeri-link {
        margin-top: auto; color: var(--gold); font-size: 12px; font-weight: 600;
    }
    .galeri-body .galeri-link:hover { text-decoration: underline; }
    .galeri-body .aksi { margin-top: 12px; }
</style>
@endpush

@section('content')
@php
    $bisaKelola = auth()->check() && in_array(auth()->user()->role, ['admin', 'operator']);
@endphp

<div class="container">
    <div class="page-header">
        <div>
            <h1 class="page-title">Galeri</h1>
            <p class="page-subtitle">Dokumentasi kegiatan sekolah.</p>
        </div>

        @if ($bisaKelola)
            <a href="{{ route('galeri.create') }}" class="btn btn-tambah">Tambah Foto</a>
        @endif
    </div>
    <hr class="divider">

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="galeri-grid">
        @forelse ($galeri as $item)
            <div class="galeri-card">
                @if ($item->foto)
                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}">
                @else
                    <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='300' height='400'><rect width='100%' height='100%' fill='%23e9e6df'/></svg>" alt="Tanpa foto">
                @endif

                <div class="galeri-body">
                    <h3>{{ $item->judul }}</h3>

                    @if ($item->deskripsi)
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 80) }}</p>
                    @endif

                    <a href="{{ route('galeri.show', $item->getKey()) }}" class="galeri-link">Lihat deskripsi lengkap →</a>

                    @if ($bisaKelola)
                        <div class="aksi">
                            <a href="{{ route('galeri.edit', $item->getKey()) }}" class="btn btn-edit btn-sm">Edit</a>
                            <form action="{{ route('galeri.destroy', $item->getKey()) }}" method="POST"
                                  onsubmit="return confirm('Hapus foto ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-hapus btn-sm">Hapus</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="empty" style="grid-column: 1 / -1;">Belum ada foto di galeri.</div>
        @endforelse
    </div>
</div>
@endsection