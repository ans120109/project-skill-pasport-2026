@extends('layout.app')

@section('title', 'Edit Profil Sekolah')

@section('content')
@php
    $teks = [
        'tentang'   => 'Tentang Sekolah',
        'visi'      => 'Visi',
        'misi'      => 'Misi (satu poin per baris)',
        'tujuan'    => 'Tujuan (satu poin per baris)',
        'sejarah'   => 'Sejarah',
        'sambutan'  => 'Sambutan Kepala Sekolah',
        'fasilitas' => 'Fasilitas (satu per baris)',
        'prestasi'  => 'Prestasi (satu per baris)',
    ];
    $kecil = [
        'nama_sekolah'  => ['Nama Sekolah', 'text'],
        'nama_kepsek'   => ['Nama Kepala Sekolah', 'text'],
        'npsn'          => ['NPSN', 'text'],
        'akreditasi'    => ['Akreditasi', 'text'],
        'tahun_berdiri' => ['Tahun Berdiri', 'text'],
        'telepon'       => ['Telepon', 'text'],
        'email'         => ['Email', 'email'],
        'alamat'        => ['Alamat', 'text'],
        'jumlah_siswa'  => ['Jumlah Siswa', 'number'],
        'jumlah_guru'   => ['Jumlah Guru', 'number'],
        'jumlah_ekskul' => ['Jumlah Ekskul', 'number'],
        'maps_url'      => ['Link Google Maps', 'url'],
    ];
@endphp

<style>
    .pe-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:20px;margin-bottom:16px}
    .pe-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px}
    @media(max-width:700px){.pe-grid{grid-template-columns:1fr}}
    .pe-card label{display:block;font-weight:600;font-size:14px;margin-bottom:4px}
    .pe-card input[type=text],.pe-card input[type=email],.pe-card input[type=number],.pe-card input[type=url],.pe-card textarea{width:100%;padding:9px 12px;border:1px solid #d1d5db;border-radius:8px;font:inherit;box-sizing:border-box}
    .pe-err{color:#dc2626;font-size:13px;margin-top:3px}
</style>

<main class="content">
    <div class="container">

        <h1 class="page-title">Edit Profil Sekolah</h1>
        <p class="page-subtitle">Hanya admin yang dapat mengubah data ini.</p>
        <hr class="divider">

        <form action="{{ route('profile-sekolah.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="pe-card">
                <div class="pe-grid">
                    @foreach($kecil as $name => [$label, $type])
                        <div>
                            <label for="{{ $name }}">{{ $label }}</label>
                            <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}"
                                   value="{{ old($name, $profil->$name) }}">
                            @error($name)<div class="pe-err">{{ $message }}</div>@enderror
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="pe-card">
                <label for="foto">Foto Sekolah</label>
                @if($profil->foto_url)
                    <img src="{{ $profil->foto_url }}" alt="" style="max-width:220px;border-radius:8px;display:block;margin-bottom:8px">
                @endif
                <input type="file" id="foto" name="foto" accept="image/*">
                @error('foto')<div class="pe-err">{{ $message }}</div>@enderror
            </div>

            @foreach($teks as $name => $label)
                <div class="pe-card">
                    <label for="{{ $name }}">{{ $label }}</label>
                    <textarea id="{{ $name }}" name="{{ $name }}" rows="5">{{ old($name, $profil->$name) }}</textarea>
                    @error($name)<div class="pe-err">{{ $message }}</div>@enderror
                </div>
            @endforeach

            <button type="submit" class="btn-action">💾 Simpan Perubahan</button>
            <a href="{{ route('profil') }}" style="margin-left:12px;color:#6b7280;">Batal</a>
        </form>

    </div>
</main>
@endsection