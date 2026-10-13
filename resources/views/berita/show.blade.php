@extends('layout.app')

@section('title', $berita->judul)

@push('styles')
@include('partials.ui-styles')
<style>
    .detail-top { margin: 14px 0 16px; }
    .detail-card {
        background: #fff; border: 1px solid #e5e7eb; border-radius: 12px;
        overflow: hidden; max-width: 820px;
    }
    .detail-card img {
        width: 100%; max-height: 380px; object-fit: cover; display: block; background: #e9e6df;
    }
    .detail-body { padding: 22px 24px 24px; }
    .detail-body h1 { margin: 0 0 10px; font-size: 26px; line-height: 1.3; color: #0f1f4b; }
    .meta { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 18px; }
    .meta span {
        background: #fdf3dc; color: #8a5a00; padding: 5px 12px;
        border-radius: 999px; font-size: 12px; font-weight: 600;
    }
    .isi { line-height: 1.9; font-size: 15px; color: #374151; white-space: pre-line; }
    .detail-actions {
        display: flex; gap: 8px; margin-top: 22px; padding-top: 16px;
        border-top: 1px solid #eee; max-width: 320px;
    }
    .detail-actions form { margin: 0; flex: 1; display: flex; }
    .detail-actions .btn { flex: 1; width: 100%; }
</style>
@endpush

@section('content')
@php
    $bisaKelola = auth()->check() && in_array(auth()->user()->role, ['admin', 'operator']);
    $tgl = $berita->tanggal ?? $berita->created_at;
@endphp

<div class="container">
    <div class="detail-top">
        <a href="{{ route('berita.index') }}" class="btn-back">Kembali</a>
    </div>

    <div class="detail-card">
        @if ($berita->gambar_url)
            <img src="{{ $berita->gambar_url }}" alt="{{ $berita->judul }}">
        @endif

        <div class="detail-body">
            <h1>{{ $berita->judul }}</h1>

            <div class="meta">
                @if ($tgl)<span>🗓️ {{ $tgl->translatedFormat('d F Y') }}</span>@endif
                @if ($berita->penulis)<span>✍️ {{ $berita->penulis }}</span>@endif
            </div>

            <div class="isi">{{ trim(str_replace('**', '', $berita->isi)) }}</div>

            @if ($bisaKelola)
                <div class="detail-actions">
                    <a href="{{ route('berita.edit', $berita->getKey()) }}" class="btn btn-edit">Edit</a>
                    <form action="{{ route('berita.destroy', $berita->getKey()) }}" method="POST"
                          onsubmit="return confirm('Hapus berita ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-hapus">Hapus</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection