@extends('layout.app')

@section('title', 'Tambah Foto')

@push('styles')
@include('partials.ui-styles')
@include('partials.form-styles')
@endpush

@section('content')
<div class="container">
    <h1 class="page-title">Tambah Foto</h1>
    <p class="page-subtitle">Unggah foto kegiatan ke galeri.</p>
    <hr class="divider">

    <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data" class="form-card">
        @csrf

        <div class="form-group">
            <label for="judul">Judul <span class="req">*</span></label>
            <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required>
            @error('judul')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="foto">Foto <span class="req">*</span> <span class="hint">(maks. 2 MB)</span></label>
            <input type="file" id="foto" name="foto" accept="image/*" data-preview required>
            <img id="preview" class="img-preview" alt="Preview">
            @error('foto')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-simpan">Simpan</button>
            <a href="{{ route('galeri.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection