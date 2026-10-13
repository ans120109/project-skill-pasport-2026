@extends('layout.app')

@section('title', 'Dashboard User')

@push('styles')
@include('partials.ui-styles')
<style>
    .welcome {
        display: flex; align-items: center; justify-content: space-between;
        gap: 16px; flex-wrap: wrap;
        background: #0f1f4b; color: #fff;
        border-radius: 14px; padding: 22px 26px; margin: 16px 0 20px;
    }
    .welcome h2 { margin: 0 0 4px; font-size: 20px; color: #fff; }
    .welcome p { margin: 0; font-size: 14px; opacity: .85; color: #fff; }
    .welcome .role-badge {
        background: #d99a22; color: #fff; padding: 4px 14px;
        border-radius: 999px; font-size: 12px; font-weight: 600; text-transform: capitalize;
    }

    .stat-row {
        display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 14px; margin-bottom: 26px;
    }
    .stat-box {
        background: #fff; border: 1px solid #e5e7eb; border-radius: 12px;
        padding: 16px; text-align: center;
    }
    .stat-box b { display: block; font-size: 24px; color: #0f1f4b; }
    .stat-box span { font-size: 13px; color: #6b7280; }

    .nilai-panel {
        display: flex; align-items: center; justify-content: space-between;
        gap: 16px; flex-wrap: wrap;
        background: #fff; border: 1px solid #e5e7eb; border-radius: 12px;
        padding: 20px 24px; margin-bottom: 28px;
        border-left: 5px solid #d99a22;
    }
    .nilai-panel h3 { margin: 0 0 4px; font-size: 17px; color: #0f1f4b; }
    .nilai-panel p { margin: 0; font-size: 13px; color: #6b7280; }
    .nilai-panel .angka-row { display: flex; gap: 22px; margin-top: 8px; }
    .nilai-panel .angka-row b { font-size: 20px; color: #0f1f4b; }
    .nilai-panel .angka-row .lulus b { color: #16a34a; }
    .nilai-panel .angka-row .tidak b { color: #dc2626; }
    .nilai-panel .angka-row span { display: block; font-size: 12px; color: #6b7280; }

    .section-head {
        display: flex; align-items: center; justify-content: space-between; margin: 8px 0 12px;
    }
    .section-head h3 {
        margin: 0; font-size: 18px; color: #0f1f4b;
        border-left: 4px solid #d99a22; padding-left: 10px;
    }
    .section-head a { font-size: 13px; font-weight: 600; color: #d99a22; text-decoration: none; }
    .section-head a:hover { text-decoration: underline; }

    .info-grid {
        display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 16px; margin-bottom: 28px;
    }
    .info-card {
        background: #fff; border: 1px solid #e5e7eb; border-radius: 12px;
        overflow: hidden; display: flex; flex-direction: column;
        text-decoration: none; color: inherit;
        transition: box-shadow .2s, transform .2s;
    }
    .info-card:hover { box-shadow: 0 6px 16px rgba(0,0,0,.08); transform: translateY(-2px); }
    .info-card img, .info-card .noimg {
        width: 100%; height: 140px; object-fit: cover; display: block; background: #e9e6df;
    }
    .info-card .noimg { display: flex; align-items: center; justify-content: center; font-size: 32px; }
    .info-card.galeri img { height: 200px; object-position: top center; }
    .info-body { padding: 14px 16px 16px; display: flex; flex-direction: column; flex: 1; }
    .info-body h4 { margin: 0 0 6px; font-size: 15px; color: #0f1f4b; line-height: 1.4; }
    .info-meta { font-size: 12px; color: #6b7280; margin-bottom: 8px; }
    .info-body p { margin: 0 0 10px; font-size: 13px; line-height: 1.6; color: #4b5563; }
    .info-more { margin-top: auto; font-size: 12px; font-weight: 600; color: #d99a22; }
    .badge-jadwal {
        display: inline-block; background: #fdf3dc; color: #8a5a00; padding: 3px 10px;
        border-radius: 999px; font-size: 11px; font-weight: 600; margin-bottom: 8px; align-self: flex-start;
    }
    .empty-box {
        grid-column: 1 / -1; background: #fff; border: 1px dashed #d1d5db;
        border-radius: 12px; padding: 24px; text-align: center; color: #6b7280; font-size: 14px;
    }
</style>
@endpush

@section('content')
<div class="container">
    <h1 class="page-title">Dashboard User</h1>
    <p class="page-subtitle">Informasi dan kegiatan terbaru SMA Cendikia Nusantara.</p>
    <hr class="divider">

    <div class="welcome">
        <div>
            <h2>Halo, {{ auth()->user()->name }} 👋</h2>
            <p>Selamat datang di halaman pengguna SMA Cendikia Nusantara.</p>
        </div>
        <span class="role-badge">{{ auth()->user()->role }}</span>
    </div>

    @if ($profil)
    <div class="stat-row">
        <div class="stat-box"><b>{{ number_format($profil->jumlah_siswa ?? 0) }}</b><span>Siswa</span></div>
        <div class="stat-box"><b>{{ number_format($profil->jumlah_guru ?? 0) }}</b><span>Guru</span></div>
        <div class="stat-box"><b>{{ number_format($profil->jumlah_ekskul ?? 0) }}</b><span>Ekstrakurikuler</span></div>
    </div>
    @endif

    <div class="nilai-panel">
        <div>
            <h3>🎓 Hasil Ujikom</h3>
            <p>Nilai akhir = jumlah nilai Penguji 1, Penguji 2 dan Penguji 3 dibagi 3. 75 ke atas dinyatakan <b>Lulus</b>, di bawah 75 <b>Tidak Lulus</b>.</p>
            <div class="angka-row">
                <div><b>{{ $totalPeserta }}</b><span>Peserta</span></div>
                <div class="lulus"><b>{{ $totalLulus }}</b><span>Lulus</span></div>
                <div class="tidak"><b>{{ $totalPeserta - $totalLulus }}</b><span>Tidak Lulus</span></div>
            </div>
        </div>
        <a href="{{ route('nilai-ujikom.index') }}" class="btn btn-gold">Lihat Nilai Ujikom</a>
    </div>

    <div class="section-head">
        <h3>📰 Berita &amp; Pengumuman Terbaru</h3>
        <a href="{{ route('berita.index') }}">Lihat semua →</a>
    </div>
    <div class="info-grid">
        @forelse ($beritaTerbaru as $berita)
            @php $tgl = $berita->tanggal ?? $berita->created_at; @endphp
            <a href="{{ route('berita.show', $berita->getKey()) }}" class="info-card">
                @if ($berita->gambar_url)
                    <img src="{{ $berita->gambar_url }}" alt="{{ $berita->judul }}">
                @else
                    <div class="noimg">📰</div>
                @endif
                <div class="info-body">
                    <h4>{{ $berita->judul }}</h4>
                    @if ($tgl)<div class="info-meta">🗓️ {{ $tgl->translatedFormat('d F Y') }}</div>@endif
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
                    @if ($ekskul->jadwal)<span class="badge-jadwal">🕒 {{ $ekskul->jadwal }}</span>@endif
                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($ekskul->deskripsi ?? ''), 90) }}</p>
                    <span class="info-more">Lihat detail →</span>
                </div>
            </a>
        @empty
            <div class="empty-box">Belum ada data ekstrakurikuler.</div>
        @endforelse
    </div>

    <div class="section-head">
        <h3>🖼️ Galeri Terbaru</h3>
        <a href="{{ route('galeri.index') }}">Lihat semua →</a>
    </div>
    <div class="info-grid">
        @forelse ($galeriTerbaru as $foto)
            <a href="{{ route('galeri.show', $foto->getKey()) }}" class="info-card galeri">
                @if ($foto->foto)
                    <img src="{{ asset('storage/' . $foto->foto) }}" alt="{{ $foto->judul }}">
                @else
                    <div class="noimg">🖼️</div>
                @endif
                <div class="info-body">
                    <h4>{{ $foto->judul }}</h4>
                </div>
            </a>
        @empty
            <div class="empty-box">Belum ada foto di galeri.</div>
        @endforelse
    </div>
</div>
@endsection