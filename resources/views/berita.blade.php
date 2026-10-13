@extends('layout.app')

@section('title', 'Berita & Pengumuman')

@push('styles')
@include('partials.ui-styles')
<style>
    .page-header {
        display: flex; justify-content: space-between; align-items: flex-start;
        gap: 16px; flex-wrap: wrap;
    }
    .berita-list { display: flex; flex-direction: column; gap: 16px; margin-top: 16px; }
    .berita-card {
        display: flex; gap: 18px; background: #fff; border: 1px solid #e5e7eb;
        border-radius: 12px; padding: 14px; align-items: stretch;
    }
    .berita-thumb {
        flex: 0 0 200px; width: 200px; height: 140px; border-radius: 10px;
        object-fit: cover; background: #e9e6df; display: block;
    }
    .berita-noimg {
        flex: 0 0 200px; width: 200px; height: 140px; border-radius: 10px;
        background: #e9e6df; display: flex; align-items: center; justify-content: center; font-size: 32px;
    }
    .berita-body { flex: 1; min-width: 0; display: flex; flex-direction: column; }
    .berita-body h3 { margin: 0 0 6px; font-size: 18px; color: #0f1f4b; }
    .berita-meta { font-size: 12px; color: #6b7280; margin-bottom: 8px; }
    .berita-body p { margin: 0 0 10px; font-size: 14px; line-height: 1.7; color: #4b5563; }
    .berita-link { margin-top: auto; font-size: 13px; font-weight: 600; color: #d99a22; text-decoration: none; }
    .berita-link:hover { text-decoration: underline; }
    .berita-body .aksi { margin-top: 12px; max-width: 220px; }
    @media (max-width: 640px) {
        .berita-card { flex-direction: column; }
        .berita-thumb, .berita-noimg { width: 100%; flex: none; height: 180px; }
    }
</style>
@endpush

@section('content')
@php
    $bisaKelola = auth()->check() && in_array(auth()->user()->role, ['admin', 'operator']);
    $daftar = $beritas ?? $berita ?? collect();
@endphp

<div class="container">
    <div class="page-header">
        <div>
            <h1 class="page-title">Berita &amp; Pengumuman</h1>
            <p class="page-subtitle">Informasi terbaru dari sekolah.</p>
        </div>
        @if ($bisaKelola)
            <a href="{{ route('berita.create') }}" class="btn btn-tambah">Tambah Berita</a>
        @endif
    </div>
    <hr class="divider">

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="berita-list">
        @forelse ($daftar as $item)
            @php $tgl = $item->tanggal ?? $item->created_at; @endphp
            <div class="berita-card">
                @if ($item->gambar_url)
                    <img src="{{ $item->gambar_url }}" alt="{{ $item->judul }}" class="berita-thumb">
                @else
                    <div class="berita-noimg">📰</div>
                @endif

                <div class="berita-body">
                    <h3>{{ $item->judul }}</h3>
                    <div class="berita-meta">
                        @if ($tgl) 🗓️ {{ $tgl->translatedFormat('d F Y') }} @endif
                        @if ($item->penulis) · ✍️ {{ $item->penulis }} @endif
                    </div>
                    <p>{{ \Illuminate\Support\Str::limit(trim(str_replace(['**', '*', '#'], '', strip_tags($item->isi ?? ''))), 160) }}</p>

                    <a href="{{ route('berita.show', $item->getKey()) }}" class="berita-link">Baca selengkapnya →</a>

                    @if ($bisaKelola)
                        <div class="aksi">
                            <a href="{{ route('berita.edit', $item->getKey()) }}" class="btn btn-edit btn-sm">Edit</a>
                            <form action="{{ route('berita.destroy', $item->getKey()) }}" method="POST"
                                  onsubmit="return confirm('Hapus berita ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-hapus btn-sm">Hapus</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="empty">Belum ada berita atau pengumuman.</div>
        @endforelse
    </div>

    @if (is_object($daftar) && method_exists($daftar, 'links'))
        <div style="margin-top:20px;">{{ $daftar->links() }}</div>
    @endif
</div>
@endsection