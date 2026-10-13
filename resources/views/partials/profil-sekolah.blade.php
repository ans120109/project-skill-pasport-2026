@php
    $profil  = $profil ?? \App\Models\ProfilSekolah::first();
    $isAdmin = auth()->check() && auth()->user()->role === 'admin';
@endphp

@if(!$profil)
    <div class="card">
        <p class="muted">Profil sekolah belum diisi.</p>
        @if($isAdmin)
            <a href="{{ route('profile-sekolah.edit') }}" class="btn-action">✏️ Isi Profil Sekolah</a>
        @endif
    </div>
@else
<style>
    .ps-hero{display:flex;gap:24px;align-items:center;background:#0f1f4b;color:#fff;border-radius:16px;padding:28px;flex-wrap:wrap;margin-bottom:20px}
    .ps-hero img{width:200px;height:140px;object-fit:cover;border-radius:12px;background:#1d2f66}
    .ps-hero h2{margin:0 0 6px;font-size:24px;color:#fff}
    .ps-hero p{margin:2px 0;opacity:.85;font-size:14px;color:#fff}
    .ps-badges{display:flex;gap:8px;flex-wrap:wrap;margin-top:10px}
    .ps-badge{background:rgba(255,255,255,.15);padding:4px 12px;border-radius:999px;font-size:12px}
    .ps-stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:14px;margin-bottom:20px}
    .ps-stat{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:16px;text-align:center}
    .ps-stat b{display:block;font-size:24px;color:#0f1f4b}
    .ps-stat span{font-size:13px;color:#6b7280}
    .ps-section{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:20px;margin-bottom:16px}
    .ps-section h3{margin:0 0 12px;font-size:18px;color:#0f1f4b;border-left:4px solid #d99a22;padding-left:10px}
    .ps-section ol,.ps-section ul{margin:0;padding-left:22px;line-height:1.7;font-size:14px}
    .ps-section li{margin-bottom:6px}
    .ps-section p{margin:0;line-height:1.7;white-space:pre-line;font-size:14px}
    .ps-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;align-items:start}
    @media(max-width:700px){.ps-grid{grid-template-columns:1fr}.ps-hero img{width:100%}}
    .ps-btn{display:inline-block;background:#d99a22;color:#fff;padding:8px 16px;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px}
</style>

<div class="ps-hero">
    @if($profil->foto_url)
        <img src="{{ $profil->foto_url }}" alt="Foto {{ $profil->nama_sekolah }}">
    @endif
    <div style="flex:1;min-width:220px">
        <h2>{{ $profil->nama_sekolah }}</h2>
        @if($profil->alamat)<p>📍 {{ $profil->alamat }}</p>@endif
        @if($profil->telepon)<p>📞 {{ $profil->telepon }}</p>@endif
        @if($profil->email)<p>✉️ {{ $profil->email }}</p>@endif
        <div class="ps-badges">
            @if($profil->npsn)<span class="ps-badge">NPSN: {{ $profil->npsn }}</span>@endif
            @if($profil->akreditasi)<span class="ps-badge">Akreditasi {{ $profil->akreditasi }}</span>@endif
            @if($profil->tahun_berdiri)<span class="ps-badge">Berdiri {{ $profil->tahun_berdiri }}</span>@endif
        </div>
    </div>

    @if($isAdmin)
        <a href="{{ route('profile-sekolah.edit') }}" class="ps-btn">✏️ Edit Profil</a>
    @endif
</div>

<div class="ps-stats">
    <div class="ps-stat"><b>{{ number_format($profil->jumlah_siswa ?? 0) }}</b><span>Siswa</span></div>
    <div class="ps-stat"><b>{{ number_format($profil->jumlah_guru ?? 0) }}</b><span>Guru</span></div>
    <div class="ps-stat"><b>{{ number_format($profil->jumlah_ekskul ?? 0) }}</b><span>Ekstrakurikuler</span></div>
</div>

@if($profil->sambutan)
<div class="ps-section">
    <h3>Sambutan Kepala Sekolah</h3>
    <p>{{ $profil->sambutan }}</p>
    @if($profil->nama_kepsek)
        <p style="margin-top:10px"><b>— {{ $profil->nama_kepsek }}</b></p>
    @endif
</div>
@endif

@if($profil->tentang)
<div class="ps-section">
    <h3>Tentang Sekolah</h3>
    <p>{{ $profil->tentang }}</p>
</div>
@endif

<div class="ps-grid">
    <div class="ps-section">
        <h3>Visi</h3>
        <p>{{ $profil->visi ?: 'Belum diisi.' }}</p>
    </div>
    <div class="ps-section">
        <h3>Misi</h3>
        @if(count($profil->daftar_misi))
            <ol>@foreach($profil->daftar_misi as $m)<li>{{ $m }}</li>@endforeach</ol>
        @else
            <p>Belum diisi.</p>
        @endif
    </div>
</div>

@if(count($profil->daftar('tujuan')))
<div class="ps-section">
    <h3>Tujuan</h3>
    <ol>@foreach($profil->daftar('tujuan') as $t)<li>{{ $t }}</li>@endforeach</ol>
</div>
@endif

@if($profil->sejarah)
<div class="ps-section">
    <h3>Sejarah</h3>
    <p>{{ $profil->sejarah }}</p>
</div>
@endif

<div class="ps-grid">
    <div class="ps-section">
        <h3>Fasilitas</h3>
        @if(count($profil->daftar('fasilitas')))
            <ul>@foreach($profil->daftar('fasilitas') as $f)<li>{{ $f }}</li>@endforeach</ul>
        @else
            <p>Belum diisi.</p>
        @endif
    </div>
    <div class="ps-section">
        <h3>Prestasi</h3>
        @if(count($profil->daftar('prestasi')))
            <ul>@foreach($profil->daftar('prestasi') as $p)<li>🏆 {{ $p }}</li>@endforeach</ul>
        @else
            <p>Belum diisi.</p>
        @endif
    </div>
</div>

@if($profil->maps_url)
<div class="ps-section">
    <h3>Lokasi</h3>
    <a href="{{ $profil->maps_url }}" target="_blank" rel="noopener" class="ps-btn">📍 Buka di Google Maps</a>
</div>
@endif
@endif