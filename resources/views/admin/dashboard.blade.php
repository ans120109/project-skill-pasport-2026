@extends('layout.app')

@section('title', 'Dashboard')

@push('styles')
<style>
    .stat-grid { margin-bottom: 18px; }
    .stat-card { border-left: 4px solid var(--navy); }
    .stat-card h3 { font-size: 14px; margin: 0; }
    .stat-card .angka { font-size: 26px; font-weight: 700; margin: 10px 0 0; }

    .dash-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 14px;
        margin-bottom: 14px;
    }

    .dash-title { font-size: 15px; margin: 0 0 12px; }

    .quick-actions { display: flex; flex-wrap: wrap; gap: 8px; }

    .mini-list { list-style: none; margin: 0; padding: 0; }
    .mini-list li {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        padding: 9px 0;
        border-bottom: 1px solid var(--line);
        font-size: 13px;
    }
    .mini-list li:last-child { border-bottom: 0; }
    .mini-list .sub { color: var(--muted); font-size: 12px; white-space: nowrap; }

    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid var(--line);
        font-size: 13px;
    }
    .info-row:last-child { border-bottom: 0; }
    .info-row span:first-child { color: var(--muted); }
    .info-row span:last-child { font-weight: 600; text-align: right; }

    .badge-row { display: flex; flex-wrap: wrap; gap: 8px; }
    .badge {
        background: #eef1f7;
        color: var(--navy);
        border-radius: 999px;
        padding: 4px 12px;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-gold {
        background: linear-gradient(135deg, #e8a92d, #d99a22);
        color: #fff; border: 1.5px solid #d99a22;
        box-shadow: 0 3px 8px rgba(217,154,34,.35);
    }
    .btn-gold:hover { background: linear-gradient(135deg, #d99a22, #c28a1c); color: #fff; }
    .btn-edit { background: #0f1f4b; color: #fff; border: 1.5px solid #0f1f4b; }
    .btn-edit:hover { background: #1a3170; color: #fff; }
    .btn-sm { padding: 6px 12px; font-size: 12px; border-radius: 7px; }

    .dash-head {
        display: flex; justify-content: space-between; align-items: center;
        gap: 12px; flex-wrap: wrap; margin-bottom: 12px;
    }
    .dash-head .dash-title { margin: 0; }
    .dash-count { color: var(--muted); font-weight: 500; font-size: 13px; }

    .dash-tbl-wrap { overflow-x: auto; }
    .dash-tbl { width: 100%; min-width: 620px; border-collapse: collapse; }
    .dash-tbl th {
        background: #0f1f4b; color: #fff; text-align: left;
        padding: 10px 12px; font-size: 12.5px; font-weight: 600; white-space: nowrap;
    }
    .dash-tbl th:first-child { border-radius: 8px 0 0 8px; }
    .dash-tbl th:last-child  { border-radius: 0 8px 8px 0; }
    .dash-tbl td {
        padding: 10px 12px; font-size: 13.5px;
        border-bottom: 1px solid var(--line); vertical-align: middle;
    }
    .dash-tbl tbody tr:last-child td { border-bottom: 0; }
    .dash-tbl tbody tr:hover { background: #f8f9fc; }
    .dash-tbl .td-no { width: 44px; color: var(--muted); }
    .dash-tbl .td-aksi { white-space: nowrap; }
    .dash-empty { text-align: center; color: var(--muted); padding: 1.4rem 1rem; }
</style>
@endpush

@section('content')
@php
    $bisaKelola = in_array(auth()->user()->role, ['admin', 'operator']);
@endphp

<div class="container">
    <h1 class="page-title">Dashboard Utama</h1>
    <p class="page-subtitle">Selamat datang kembali di Panel Akademik SMA Cendekia Nusantara.</p>
    <hr class="divider">

    
    <div class="grid-3 stat-grid">
        <div class="card stat-card" style="border-left-color:#2a6fb5;">
            <h3 style="color:#2a6fb5;">Total Siswa</h3>
            <p class="angka">{{ number_format($totalSiswa, 0, ',', '.') }}</p>
        </div>
        <div class="card stat-card" style="border-left-color:#2f8f8a;">
            <h3 style="color:#2f8f8a;">Total Guru</h3>
            <p class="angka">{{ number_format($totalGuru, 0, ',', '.') }}</p>
        </div>
        <div class="card stat-card" style="border-left-color:#e39a1b;">
            <h3 style="color:#e39a1b;">Total Ekstrakurikuler</h3>
            <p class="angka">{{ number_format($totalEkskul, 0, ',', '.') }}</p>
        </div>
    </div>

    
    @if ($bisaKelola)
        <div class="card" style="margin-bottom:14px;">
            <h2 class="dash-title">⚡ Aksi Cepat</h2>
            <div class="quick-actions">
                <a href="{{ route('berita.create') }}" class="btn btn-gold">+ Tambah Berita</a>
                <a href="{{ route('galeri.create') }}" class="btn btn-gold">+ Tambah Foto</a>
                <a href="{{ route('ekstrakurikuler.create') }}" class="btn btn-gold">+ Tambah Ekskul</a>
                <a href="{{ route('siswa-guru.create') }}" class="btn btn-outline">Kelola Siswa &amp; Guru</a>
                <a href="{{ route('profile-sekolah.edit') }}" class="btn btn-outline">Edit Profil Sekolah</a>
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline">Kelola Akun</a>
                @endif
            </div>
        </div>
    @endif

    
    <div class="dash-grid">
        <div class="card">
            <h2 class="dash-title">📊 Ringkasan Konten</h2>
            <div class="info-row"><span>Berita &amp; Pengumuman</span><span>{{ $totalBerita }}</span></div>
            <div class="info-row"><span>Foto Galeri</span><span>{{ $totalGaleri }}</span></div>
            <div class="info-row"><span>Akun Terdaftar</span><span>{{ $akunPerRole->sum() }}</span></div>

            <div class="badge-row" style="margin-top:12px;">
                @foreach (['admin' => 'Admin', 'operator' => 'Operator', 'user' => 'User', 'guru' => 'Guru', 'siswa' => 'Siswa'] as $key => $label)
                    <span class="badge">{{ $label }}: {{ $akunPerRole[$key] ?? 0 }}</span>
                @endforeach
            </div>
        </div>

        <div class="card">
            <h2 class="dash-title">🏫 Info Sekolah</h2>
            <div class="info-row"><span>NPSN</span><span>{{ $profil->npsn ?? '-' }}</span></div>
            <div class="info-row"><span>Akreditasi</span><span>{{ $profil->akreditasi ?? '-' }}</span></div>
            <div class="info-row"><span>Tahun Berdiri</span><span>{{ $profil->tahun_berdiri ?? '-' }}</span></div>
            <div class="info-row"><span>Kepala Sekolah</span><span>{{ $profil->nama_kepsek ?? '-' }}</span></div>
            <div class="info-row"><span>Telepon</span><span>{{ $profil->telepon ?? '-' }}</span></div>
        </div>
    </div>

    
    <div class="card" style="margin-bottom:14px;">
        <div class="dash-head">
            <h2 class="dash-title">🎓 Data Siswa <span class="dash-count">({{ $daftarSiswa->count() }})</span></h2>
            @if ($bisaKelola)
                <a href="{{ route('siswa-guru.create') }}?tab=siswa" class="btn btn-gold">+ Tambah Siswa</a>
            @endif
        </div>

        <div class="dash-tbl-wrap">
            <table class="dash-tbl">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>JK</th>
                        <th>Kelas</th>
                        @if ($bisaKelola)
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($daftarSiswa as $s)
                        <tr>
                            <td class="td-no">{{ $loop->iteration }}</td>
                            <td>{{ $s->nis }}</td>
                            <td>{{ $s->nama }}</td>
                            <td>{{ $s->jenis_kelamin }}</td>
                            <td>{{ $s->kelas }}</td>
                            @if ($bisaKelola)
                                <td class="td-aksi">
                                    <a href="{{ route('siswa-guru.siswa.edit', $s) }}" class="btn btn-edit btn-sm">Edit</a>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $bisaKelola ? 6 : 5 }}" class="dash-empty">Belum ada data siswa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="dash-grid">
        <div class="card">
            <h2 class="dash-title">👩‍🏫 Guru Terbaru</h2>
            <ul class="mini-list">
                @forelse ($guruBaru as $g)
                    <li>
                        <span>{{ $g->nama }}</span>
                        <span class="sub">{{ $g->jabatan }}</span>
                    </li>
                @empty
                    <li><span class="sub">Belum ada data guru.</span></li>
                @endforelse
            </ul>
        </div>
    </div>

    
    <div class="card">
        <h2 class="dash-title">📢 Pengumuman &amp; Berita Terbaru</h2>
        <ul class="mini-list">
            @forelse ($beritaBaru as $b)
                <li>
                    <a href="{{ route('berita.show', $b->getKey()) }}">{{ $b->judul }}</a>
                    <span class="sub">{{ $b->created_at->format('d M Y') }}</span>
                </li>
            @empty
                <li>
                    <span class="sub">
                        Belum ada pengumuman yang diterbitkan hari ini.
                        @if ($bisaKelola) Gunakan panel admin untuk membuat informasi baru. @endif
                    </span>
                </li>
            @endforelse
        </ul>
        <a href="{{ route('berita.index') }}" class="dashboard-link">Lihat semua berita →</a>
    </div>
</div>
@endsection