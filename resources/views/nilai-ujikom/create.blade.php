@extends('layout.app')

@section('title', 'Tambah Nilai Ujikom')

@push('styles')
@include('partials.ui-styles')
@include('partials.form-styles')
<style>
    .form-group input[type="number"] {
        width: 100%; padding: 10px 12px; border: 1px solid #d1d5db;
        border-radius: 8px; font: inherit; font-size: 14px; background: #fff;
        box-sizing: border-box; transition: border-color .2s, box-shadow .2s;
    }
    .form-row.tiga { grid-template-columns: repeat(3, 1fr); }
    @media (max-width: 700px) { .form-row.tiga { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="container">
    <h1 class="page-title">Tambah Nilai Ujikom</h1>
    <p class="page-subtitle">Masukkan data hasil uji kompetensi siswa.</p>
    <hr class="divider">

    <form action="{{ route('nilai-ujikom.store') }}" method="POST" class="form-card">
        @csrf

        <div class="form-group">
            <label for="nama">Nama Siswa <span class="req">*</span></label>
            <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                   placeholder="Contoh: Andi Pratama" required>
            @error('nama')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="kelas">Kelas <span class="req">*</span></label>
            <input type="text" id="kelas" name="kelas" value="{{ old('kelas') }}"
                   placeholder="Contoh: XII RPL 1" required>
            @error('kelas')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-row tiga">
            <div class="form-group">
                <label for="nilai_penguji1">Nilai Penguji 1 <span class="req">*</span> <span class="hint">(0 - 100)</span></label>
                <input type="number" id="nilai_penguji1" name="nilai_penguji1" value="{{ old('nilai_penguji1') }}"
                       min="0" max="100" placeholder="Contoh: 85" required>
                @error('nilai_penguji1')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="nilai_penguji2">Nilai Penguji 2 <span class="req">*</span> <span class="hint">(0 - 100)</span></label>
                <input type="number" id="nilai_penguji2" name="nilai_penguji2" value="{{ old('nilai_penguji2') }}"
                       min="0" max="100" placeholder="Contoh: 90" required>
                @error('nilai_penguji2')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="nilai_penguji3">Nilai Penguji 3 <span class="req">*</span> <span class="hint">(0 - 100)</span></label>
                <input type="number" id="nilai_penguji3" name="nilai_penguji3" value="{{ old('nilai_penguji3') }}"
                       min="0" max="100" placeholder="Contoh: 79" required>
                @error('nilai_penguji3')<div class="form-error">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-simpan">Simpan</button>
            <a href="{{ route('nilai-ujikom.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>

    <p class="muted" style="margin-top: 12px;">Nilai akhir dihitung otomatis dari <b>jumlah nilai Penguji 1, Penguji 2 dan Penguji 3 dibagi 3 (dibulatkan)</b>. Siswa dinyatakan <b>Lulus</b> jika nilai akhir 75 atau lebih, dan <b>Tidak Lulus</b> jika kurang dari 75.</p>
</div>
@endsection