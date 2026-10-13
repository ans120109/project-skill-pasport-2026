@extends('layout.app')

@section('title', $ekstrakurikuler->nama)

@push('styles')
@include('partials.ui-styles')
<style>
    .detail-top { margin: 14px 0 16px; }
    .detail-card {
        background: #fff; border: 1px solid #e5e7eb; border-radius: 12px;
        overflow: hidden; max-width: 760px;
    }
    .detail-card img {
        width: 100%; max-height: 380px; object-fit: cover; display: block; background: #e9e6df;
    }
    .detail-body { padding: 20px 22px 22px; }
    .detail-body h1 { margin: 0 0 10px; font-size: 24px; color: #0f1f4b; }
    .badge-jadwal {
        display: inline-flex; align-items: center; gap: 6px;
        background: #fdf3dc; color: #8a5a00; padding: 5px 12px;
        border-radius: 999px; font-size: 12px; font-weight: 600; margin-bottom: 14px;
    }
    .detail-body p { margin: 0; line-height: 1.8; font-size: 14px; color: #374151; white-space: pre-line; }
    .detail-actions {
        display: flex; gap: 8px; margin-top: 20px; padding-top: 16px;
        border-top: 1px solid #eee; max-width: 320px;
    }
    .detail-actions form { margin: 0; flex: 1; display: flex; }
    .detail-actions .btn { flex: 1; width: 100%; }
</style>
@endpush

@section('content')
@php
    $bisaKelola = auth()->check() && in_array(auth()->user()->role, ['admin', 'operator']);
@endphp

<div class="container">
    <div class="detail-top">
        <a href="{{ route('ekstrakurikuler.index') }}" class="btn-back">Kembali</a>
    </div>

    <div class="detail-card">
        @if ($ekstrakurikuler->gambar)
            <img src="{{ asset('storage/' . $ekstrakurikuler->gambar) }}" alt="{{ $ekstrakurikuler->nama }}">
        @endif

        <div class="detail-body">
            <h1>{{ $ekstrakurikuler->nama }}</h1>

            @if ($ekstrakurikuler->jadwal)
                <div class="badge-jadwal">🕒 {{ $ekstrakurikuler->jadwal }}</div>
            @endif

            <p>{{ $ekstrakurikuler->deskripsi ?: 'Belum ada deskripsi.' }}</p>

            @if ($bisaKelola)
                <div class="detail-actions">
                    <a href="{{ route('ekstrakurikuler.edit', $ekstrakurikuler->getKey()) }}" class="btn btn-edit">Edit</a>
                    <form action="{{ route('ekstrakurikuler.destroy', $ekstrakurikuler->getKey()) }}" method="POST"
                          onsubmit="return confirm('Hapus ekstrakurikuler ini?')">
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