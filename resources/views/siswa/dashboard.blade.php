@extends('layout.app')

@section('title', 'Dashboard Siswa')

@push('styles')
<style>
    .btn {
        display: inline-flex; align-items: center; justify-content: center; gap: 6px;
        padding: 9px 18px; border: 1px solid transparent; border-radius: 8px;
        font-family: inherit; font-size: 13px; font-weight: 600; line-height: 1.2;
        text-decoration: none; cursor: pointer;
        transition: background .2s, color .2s, transform .1s, box-shadow .2s;
    }
    .btn:hover { transform: translateY(-1px); box-shadow: 0 4px 10px rgba(0,0,0,.15); }
    .btn-gold { background: #d99a22; color: #fff; border-color: #d99a22; }
    .btn-gold:hover { background: #c28a1c; border-color: #c28a1c; }
    .btn-outline { background: #fff; color: #0f1f4b; border-color: #0f1f4b; }
    .btn-outline:hover { background: #0f1f4b; color: #fff; }

    .welcome {
        display: flex; align-items: center; justify-content: space-between;
        gap: 16px; flex-wrap: wrap;
        background: #0f1f4b; color: #fff;
        border-radius: 14px; padding: 22px 26px; margin: 16px 0 24px;
    }
    .welcome h2 { margin: 0 0 4px; font-size: 20px; color: #fff; }
    .welcome p { margin: 0; font-size: 14px; opacity: .85; color: #fff; }
    .welcome .role-badge {
        background: #d99a22; color: #fff; padding: 4px 14px;
        border-radius: 999px; font-size: 12px; font-weight: 600;
    }

    .section-head {
        display: flex; align-items: center; justify-content: space-between;
        margin: 8px 0 12px;
    }
    .section-head h3 {
        margin: 0; font-size: 18px; color: #0f1f4b;
        border-left: 4px solid #d99a22; padding-left: 10px;
    }
    .section-head a { font-size: 13px; font-weight: 600; color: #d99a22; text-decoration: none; }
    .section-head a:hover { text-decoration: underline; }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 16px;
        margin-bottom: 28px;
    }
    .info-card {
        background: #fff; border: 1px solid #e5e7eb; border-radius: 12px;
        overflow: hidden; display: flex; flex-direction: column;
        text-decoration: none; color: inherit;
        transition: box-shadow .2s, transform .2s;
    }
    .info-card:hover { box-shadow: 0 6px 16px rgba(0,0,0,.08); transform: translateY(-2px); }
    .info-card img {
        width: 100%; height: 140px; object-fit: cover; display: block; background: #e9e6df;
    }
    .info-card .noimg {
        height: 140px; background: #e9e6df; display: flex;
        align-items: center; justify-content: center; font-size: 32px;
    }
    .info-body { padding: 14px 16px 16px; display: flex; flex-direction: column; flex: 1; }
    .info-body h4 { margin: 0 0 6px; font-size: 15px; color: #0f1f4b; line-height: 1.4; }
    .info-meta { font-size: 12px; color: #6b7280; margin-bottom: 8px; }
    .info-body p { margin: 0 0 10px; font-size: 13px; line-height: 1.6; color: #4b5563; }
    .info-more { margin-top: auto; font-size: 12px; font-weight: 600; color: #d99a22; }

    .badge-jadwal {
        display: inline-block; background: #fdf3dc; color: #8a5a00;
        padding: 3px 10px; border-radius: 999px; font-size: 11px;
        font-weight: 600; margin-bottom: 8px; align-self: flex-start;
    }

    .empty-box {
        grid-column: 1 / -1; background: #fff; border: 1px dashed #d1d5db;
        border-radius: 12px; padding: 24px; text-align: center; color: #6b7280; font-size: 14px;
    }
</style>
@endpush

@section('content')
<div class="container">
    <h1 class="page-title">Portal Siswa</h1>
    <p class="page-subtitle">Informasi akademik dan kegiatan sekolah Anda.</p>
    <hr class="divider">

    <div class="welcome">
        <div>
            <h2>Halo, {{ auth()->user()->name }} 👋</h2>
            <p>Selamat datang di portal siswa SMA Cendikia Nusantara.</p>
        </div>
        <span class="role-badge">Siswa</span>
    </div>

    <div class="section-head">
        <h3>📰 Berita &amp; Pengumuman Terbaru</h3>
        <a href="{{ route('berita.index') }}">Lihat semua →</a>
    </div>

    <div class="info-grid">
        @forelse ($beritaTerbaru as $berita)
            <a href="{{ route('berita.show', $berita->getKey()) }}" class="info-card">
                @if ($berita->gambar_url)
                    <img src="{{ $berita->gambar_url }}" alt="{{ $berita->judul }}">
                @else
                    <div class="noimg">📰</div>
                @endif
                <div class="info-body">
                    <h4>{{ $berita->judul }}</h4>
                    <div class="info-meta">
                        🗓️ {{ ($berita->tanggal ?? $berita->created_at)->translatedFormat('d F Y') }}
                        @if ($berita->penulis) · {{ $berita->penulis }} @endif
                    </div>
                    <p>{{ \Illuminate\Support\Str::limit(trim(str_replace(['**', '*', '#'], '', strip_tags($berita->isi ?? ''))), 90) }}</p>
                    <span class="info-more">Baca selengkapnya →</span>
                </div>
            </a>
        @empty
            <div class="empty-box">Belum ada berita atau pengumuman.</div>
        @endforelse
    </div>

    <div class="section-head">
        <h3>⚽ Informasi Ekstrakurikuler</h3>
        <a href="{{ route('ekstrakurikuler.index') }}">Lihat semua →</a>
    </div>

    <div class="info-grid">
        @forelse ($ekstrakurikuler as $ekskul)
            <a href="{{ route('ekstrakurikuler.show', $ekskul->getKey()) }}" class="info-card">
                @if ($ekskul->gambar)
                    <img src="{{ asset('storage/' . $ekskul->gambar) }}" alt="{{ $ekskul->nama }}">
                @else
                    <div class="noimg">⚽</div>
                @endif
                <div class="info-body">
                    <h4>{{ $ekskul->nama }}</h4>
                    @if ($ekskul->jadwal)
                        <span class="badge-jadwal">🕒 {{ $ekskul->jadwal }}</span>
                    @endif
                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($ekskul->deskripsi ?? ''), 90) }}</p>
                    <span class="info-more">Lihat detail →</span>
                </div>
            </a>
        @empty
            <div class="empty-box">Belum ada data ekstrakurikuler.</div>
        @endforelse
    </div>
</div>
@endsection