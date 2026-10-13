@extends('layout.app')

@section('title', 'Beranda')

@section('content')

@php
    use Illuminate\Support\Str;

    $gambar = fn ($m) => $m->gambar ?? $m->foto ?? $m->image ?? $m->thumbnail ?? null;
@endphp


<section class="hero">
    <div class="container">
        <h1>{{ $profil->nama_sekolah ?? $profil->nama ?? 'SMA Cendikia Nusantara' }}</h1>
        <p>
            {{ Str::limit($profil->deskripsi ?? 'Selamat datang di website resmi sekolah kami. Temukan berita, galeri, ekstrakurikuler, dan informasi akademik terbaru.', 180) }}
        </p>
        <div class="hero-actions">
            <a href="#profil" class="btn btn-primary">Kenali sekolah kami</a>
            <a href="{{ route('berita.index') }}" class="btn btn-ghost">Baca berita terbaru</a>
        </div>
    </div>
</section>


@include('landing.profil-sekolah')
@include('landing.guru-staff')

<section class="section" id="berita">
    <div class="container">
        <div class="section-head">
            <h2>Berita &amp; Pengumuman</h2>
            <a href="{{ route('berita.index') }}">Lihat semua</a>
        </div>

        @if($beritas->isNotEmpty())
            <div class="grid-3">
                @foreach($beritas as $b)
                    <a href="{{ route('berita.show', $b) }}" class="media-card">
                        @if($gambar($b))
                            <img src="{{ asset('storage/' . $gambar($b)) }}" alt="{{ $b->judul ?? '' }}">
                        @else
                            <div class="noimg"></div>
                        @endif
                        <div class="media-body">
                            <h3>{{ $b->judul ?? $b->title ?? 'Tanpa judul' }}</h3>
                            <div class="media-meta">{{ optional($b->created_at)->translatedFormat('d M Y') }}</div>
                            <p>{{ Str::limit(strip_tags(Str::markdown($b->isi ?? $b->konten ?? '')), 100) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="card muted">Belum ada berita.</div>
        @endif
    </div>
</section>


<section class="section" id="ekskul">
    <div class="container">
        <div class="section-head">
            <h2>Ekstrakurikuler</h2>
            <a href="{{ route('ekstrakurikuler.index') }}">Lihat semua</a>
        </div>

        @if($ekskuls->isNotEmpty())
            <div class="grid-3">
                @foreach($ekskuls as $e)
                    <a href="{{ route('ekstrakurikuler.show', $e) }}" class="media-card">
                        @if($gambar($e))
                            <img src="{{ asset('storage/' . $gambar($e)) }}" alt="{{ $e->nama ?? '' }}">
                        @else
                            <div class="noimg"></div>
                        @endif
                        <div class="media-body">
                            <h3>{{ $e->nama ?? $e->judul ?? 'Ekstrakurikuler' }}</h3>
                            <p>{{ Str::limit(strip_tags(Str::markdown($e->deskripsi ?? '')), 90) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="card muted">Belum ada data ekstrakurikuler.</div>
        @endif
    </div>
</section>


<section class="section" id="galeri">
    <div class="container">
        <div class="section-head">
            <h2>Galeri</h2>
            <a href="{{ route('galeri.index') }}">Lihat semua</a>
        </div>

        @if($galeris->isNotEmpty())
            <div class="grid-3">
                @foreach($galeris as $g)
                    <a href="{{ route('galeri.show', $g) }}" class="media-card">
                        @if($gambar($g))
                            <img src="{{ asset('storage/' . $gambar($g)) }}" alt="{{ $g->judul ?? '' }}">
                        @else
                            <div class="noimg"></div>
                        @endif
                        <div class="media-body">
                            <h3>{{ $g->judul ?? $g->title ?? 'Galeri' }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="card muted">Belum ada foto di galeri.</div>
        @endif
    </div>
</section>

@endsection