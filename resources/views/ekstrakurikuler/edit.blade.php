@extends('layout.app')

@section('title', 'Edit Ekstrakurikuler')

@push('styles')
@include('partials.ui-styles')
@include('partials.form-styles')
@endpush

@section('content')
<div class="container">
    <h1 class="page-title">Edit Ekstrakurikuler</h1>
    <p class="page-subtitle">Perbarui data ekstrakurikuler.</p>
    <hr class="divider">

    <form action="{{ route('ekstrakurikuler.update', $ekstrakurikuler->getKey()) }}" method="POST"
          enctype="multipart/form-data" class="form-card">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama">Nama Ekstrakurikuler <span class="req">*</span></label>
            <input type="text" id="nama" name="nama" value="{{ old('nama', $ekstrakurikuler->nama) }}" required>
            @error('nama')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="jadwal">Jadwal</label>
            <input type="text" id="jadwal" name="jadwal" value="{{ old('jadwal', $ekstrakurikuler->jadwal) }}"
                   placeholder="Contoh: Senin dan Jumat, 15.00">
            @error('jadwal')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi">{{ old('deskripsi', $ekstrakurikuler->deskripsi) }}</textarea>
            @error('deskripsi')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="gambar">Gambar <span class="hint">(kosongkan jika tidak ingin mengganti, maks. 2 MB)</span></label>
            @if ($ekstrakurikuler->gambar)
                <img src="{{ asset('storage/' . $ekstrakurikuler->gambar) }}" alt="Gambar saat ini" class="foto-lama">
            @endif
            <input type="file" id="gambar" name="gambar" accept="image/*" data-preview>
            <img id="preview" class="img-preview" alt="Preview gambar baru">
            @error('gambar')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-simpan">Simpan Perubahan</button>
            <a href="{{ route('ekstrakurikuler.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection