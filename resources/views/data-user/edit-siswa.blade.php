@extends('layout.app')

@section('title', 'Edit Siswa')

@push('styles')
@include('partials.ui-styles')
@include('partials.form-styles')
<style>
    .edit-head {
        display: flex; justify-content: space-between; align-items: flex-start;
        gap: 16px; flex-wrap: wrap;
    }
    .form-group select {
        width: 100%; padding: 10px 12px; border: 1px solid #d1d5db;
        border-radius: 8px; font: inherit; font-size: 14px; background: #fff;
        box-sizing: border-box; transition: border-color .2s, box-shadow .2s;
    }
    .form-group select:focus {
        outline: none; border-color: #d99a22; box-shadow: 0 0 0 3px rgba(217,154,34,.2);
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="edit-head">
        <div>
            <h1 class="page-title">Edit Siswa</h1>
            <p class="page-subtitle">Perbarui data siswa.</p>
        </div>
        <a href="{{ route('siswa-guru.create') }}?tab=siswa" class="btn-back">Kembali</a>
    </div>
    <hr class="divider">

    <form action="{{ route('siswa-guru.siswa.update', $siswa->id) }}" method="POST" class="form-card">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group">
                <label for="nis">NIS <span class="req">*</span></label>
                <input type="text" id="nis" name="nis" value="{{ old('nis', $siswa->nis) }}" required>
                @error('nis')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="nama">Nama <span class="req">*</span></label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $siswa->nama) }}" required>
                @error('nama')<div class="form-error">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin <span class="req">*</span></label>
                <select id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="L" @selected(old('jenis_kelamin', $siswa->jenis_kelamin) === 'L')>Laki-laki</option>
                    <option value="P" @selected(old('jenis_kelamin', $siswa->jenis_kelamin) === 'P')>Perempuan</option>
                </select>
                @error('jenis_kelamin')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="kelas">Kelas <span class="req">*</span></label>
                <input type="text" id="kelas" name="kelas" value="{{ old('kelas', $siswa->kelas) }}" required>
                @error('kelas')<div class="form-error">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="sekolah_asal">Sekolah Asal</label>
                <input type="text" id="sekolah_asal" name="sekolah_asal"
                       value="{{ old('sekolah_asal', $siswa->sekolah_asal) }}">
                @error('sekolah_asal')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                       value="{{ old('tanggal_lahir', optional($siswa->tanggal_lahir)->format('Y-m-d')) }}">
                @error('tanggal_lahir')<div class="form-error">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-group">
            <label for="no_hp">No. HP</label>
            <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $siswa->no_hp) }}">
            @error('no_hp')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat">{{ old('alamat', $siswa->alamat) }}</textarea>
            @error('alamat')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-simpan">Simpan Perubahan</button>
            <a href="{{ route('siswa-guru.create') }}?tab=siswa" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection
