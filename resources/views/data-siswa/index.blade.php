@extends('layout.app')

@section('title', 'Data Siswa')

@push('styles')
@include('partials.ui-styles')
<style>
    .page-header {
        display: flex; justify-content: space-between; align-items: flex-start;
        gap: 16px; flex-wrap: wrap;
    }

    .stat-grid {
        display: grid; grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
        gap: 14px; margin: 18px 0 22px;
    }
    .stat-card {
        background: #fff; border-radius: 12px; padding: 16px 18px;
        border-left: 4px solid #0f1f4b; box-shadow: 0 1px 3px rgba(0,0,0,.06);
    }
    .stat-card h3 { font-size: 13px; margin: 0 0 6px; font-weight: 600; }
    .stat-card .angka { font-size: 26px; font-weight: 700; margin: 0; }

    .tabel-wrap {
        background: #fff; border-radius: 12px; overflow-x: auto;
        box-shadow: 0 1px 4px rgba(0,0,0,.08);
    }
    .tabel-siswa { width: 100%; min-width: 780px; border-collapse: collapse; }
    .tabel-siswa th {
        background: #0f1f4b; color: #fff; text-align: left;
        padding: 12px 14px; font-size: 13px; font-weight: 600; white-space: nowrap;
    }
    .tabel-siswa td {
        padding: 11px 14px; font-size: 14px;
        border-bottom: 1px solid #eef0f4; vertical-align: middle;
    }
    .tabel-siswa tbody tr:last-child td { border-bottom: 0; }
    .tabel-siswa tbody tr:hover { background: #f8f9fc; }

    .chip-jk {
        display: inline-block; min-width: 26px; text-align: center;
        padding: 3px 10px; border-radius: 999px; font-size: 12px; font-weight: 700;
        background: #e0e7ff; color: #3730a3;
    }
    .chip-jk.p { background: #fce7f3; color: #9d174d; }

    .tabel-siswa .aksi { min-width: 190px; }
    .ket-siswa { font-size: 13px; color: var(--muted); margin-top: 12px; }
</style>
@endpush

@section('content')
<div class="container">
    <div class="page-header">
        <div>
            <h1 class="page-title">Data Siswa</h1>
            <p class="page-subtitle">Daftar seluruh siswa SMA Cendikia Nusantara. Data siswa dapat ditambah, diedit, dan dihapus melalui halaman ini.</p>
        </div>

        <a href="{{ route('siswa-guru.create') }}?tab=siswa" class="btn btn-tambah">Tambah Siswa</a>
    </div>
    <hr class="divider">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="stat-grid">
        <div class="stat-card" style="border-left-color: #2a6fb5;">
            <h3 style="color: #2a6fb5;">Total Siswa</h3>
            <p class="angka">{{ $totalSiswa }}</p>
        </div>
        <div class="stat-card" style="border-left-color: #0f1f4b;">
            <h3 style="color: #0f1f4b;">Laki-laki</h3>
            <p class="angka">{{ $totalLaki }}</p>
        </div>
        <div class="stat-card" style="border-left-color: #9d174d;">
            <h3 style="color: #9d174d;">Perempuan</h3>
            <p class="angka">{{ $totalPerempuan }}</p>
        </div>
    </div>

    <div class="tabel-wrap">
        <table class="tabel-siswa">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>JK</th>
                    <th>Kelas</th>
                    <th>Sekolah Asal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($siswa as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $s->nis }}</td>
                        <td>{{ $s->nama }}</td>
                        <td><span class="chip-jk {{ $s->jenis_kelamin === 'P' ? 'p' : '' }}">{{ $s->jenis_kelamin }}</span></td>
                        <td>{{ $s->kelas }}</td>
                        <td>{{ $s->sekolah_asal ?: '-' }}</td>
                        <td>
                            <div class="aksi">
                                <a href="{{ route('siswa-guru.siswa.edit', $s) }}" class="btn btn-edit btn-sm">Edit</a>
                                <form action="{{ route('siswa-guru.siswa.destroy', $s) }}" method="POST"
                                      onsubmit="return confirm('Hapus data siswa {{ addslashes($s->nama) }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-hapus btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty">Belum ada data siswa.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <p class="ket-siswa">Keterangan: tombol <b>Edit</b> membuka form edit siswa, tombol <b>Hapus</b> menghapus data siswa secara permanen.</p>
</div>
@endsection
