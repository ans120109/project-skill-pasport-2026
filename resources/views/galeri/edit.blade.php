@extends('layout.app')

@section('title', 'Edit Foto')

@push('styles')
@include('partials.ui-styles')
@include('partials.form-styles')
@endpush

@section('content')
<div class="container">
    <h1 class="page-title">Edit Foto</h1>
    <p class="page-subtitle">Perbarui data foto galeri.</p>
    <hr class="divider">

    <form action="{{ route('galeri.update', $galeri->getKey()) }}" method="POST"
          enctype="multipart/form-data" class="form-card">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="judul">Judul <span class="req">*</span></label>
            <input type="text" id="judul" name="judul" value="{{ old('judul', $galeri->judul) }}" required>
            @error('judul')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
            @error('deskripsi')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="foto">Foto <span class="hint">(kosongkan jika tidak ingin mengganti, maks. 2 MB)</span></label>
            @if ($galeri->foto)
                <img src="{{ asset('storage/' . $galeri->foto) }}" alt="Foto saat ini" class="foto-lama">
            @endif
            <input type="file" id="foto" name="foto" accept="image/*" data-preview>
            <img id="preview" class="img-preview" alt="Preview foto baru">
            @error('foto')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-simpan">Simpan Perubahan</button>
            <a href="{{ route('galeri.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection