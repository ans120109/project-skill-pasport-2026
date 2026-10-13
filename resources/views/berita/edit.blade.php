@extends('layout.app')

@section('title', 'Edit Berita')

@push('styles')
@include('partials.ui-styles')
@include('partials.form-styles')
@endpush

@section('content')
<div class="container">
    <h1 class="page-title">Edit Berita</h1>
    <p class="page-subtitle">Perbarui berita atau pengumuman.</p>
    <hr class="divider">

    <form action="{{ route('berita.update', $berita->getKey()) }}" method="POST"
          enctype="multipart/form-data" class="form-card">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="judul">Judul <span class="req">*</span></label>
            <input type="text" id="judul" name="judul" value="{{ old('judul', $berita->judul) }}" required>
            @error('judul')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="isi">Isi Berita <span class="req">*</span></label>
            <textarea id="isi" name="isi" class="tall" required>{{ old('isi', $berita->isi) }}</textarea>
            @error('isi')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="penulis">Penulis</label>
                <input type="text" id="penulis" name="penulis" value="{{ old('penulis', $berita->penulis) }}">
                @error('penulis')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal"
                       value="{{ old('tanggal', optional($berita->tanggal)->format('Y-m-d')) }}">
                @error('tanggal')<div class="form-error">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-group">
            <label for="foto">Foto <span class="hint">(kosongkan jika tidak ingin mengganti, maks. 2 MB)</span></label>
            @if ($berita->gambar_url)
                <img src="{{ $berita->gambar_url }}" alt="Foto saat ini" class="foto-lama">
            @endif
            <input type="file" id="foto" name="foto" accept="image/*" data-preview>
            <img id="preview" class="img-preview" alt="Preview foto baru">
            @error('foto')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-simpan">Simpan Perubahan</button>
            <a href="{{ route('berita.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection