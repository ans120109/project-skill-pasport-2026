@extends('layout.app')

@section('title', 'Nilai Ujikom')

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
    .tabel-nilai { width: 100%; min-width: 780px; border-collapse: collapse; }
    .tabel-nilai th {
        background: #0f1f4b; color: #fff; text-align: left;
        padding: 12px 14px; font-size: 13px; font-weight: 600; white-space: nowrap;
    }
    .tabel-nilai td {
        padding: 11px 14px; font-size: 14px;
        border-bottom: 1px solid #eef0f4; vertical-align: middle;
    }
    .tabel-nilai tbody tr:last-child td { border-bottom: 0; }
    .tabel-nilai tbody tr:hover { background: #f8f9fc; }
    .tabel-nilai .nilai-angka { font-weight: 700; }

    .badge-status {
        display: inline-block; padding: 4px 12px; border-radius: 999px;
        font-size: 12px; font-weight: 700; white-space: nowrap;
    }
    .badge-lulus { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
    .badge-tidak { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

    .tabel-nilai .aksi { min-width: 190px; }
    .ket-nilai { font-size: 13px; color: var(--muted); margin-top: 12px; }
</style>
@endpush

@section('content')
@php
    $bisaKelola = auth()->check() && in_array(auth()->user()->role, ['admin', 'operator']);
@endphp

<div class="container">
    <div class="page-header">
        <div>
            <h1 class="page-title">Nilai Ujikom</h1>
            <p class="page-subtitle">Hasil Uji Kompetensi Keahlian siswa. Nilai akhir dihitung dari jumlah nilai Penguji 1, Penguji 2 dan Penguji 3 dibagi 3, 
                jika nilai 75 atau lebih dinyatakan <b>Lulus</b>, di bawah 75 <b>Tidak Lulus</b>.</p>
        </div>

        @if ($bisaKelola)
            <a href="{{ route('nilai-ujikom.create') }}" class="btn btn-tambah">Tambah Nilai</a>
        @endif
    </div>
    <hr class="divider">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="stat-grid">
        <div class="stat-card" style="border-left-color: #2a6fb5;">
            <h3 style="color: #2a6fb5;">Total Peserta</h3>
            <p class="angka">{{ $totalPeserta }}</p>
        </div>
        <div class="stat-card" style="border-left-color: #16a34a;">
            <h3 style="color: #16a34a;">Lulus</h3>
            <p class="angka">{{ $totalLulus }}</p>
        </div>
        <div class="stat-card" style="border-left-color: #dc2626;">
            <h3 style="color: #dc2626;">Tidak Lulus</h3>
            <p class="angka">{{ $totalTidakLulus }}</p>
        </div>
    </div>
    
    <div class="tabel-wrap">
        <table class="tabel-nilai">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Penguji 1</th>
                    <th>Penguji 2</th>
                    <th>Penguji 3</th>
                    <th>Nilai Akhir</th>
                    <th>Status</th>
                    @if ($bisaKelola)
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($nilai as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->kelas }}</td>
                        <td>{{ $item->nilai_penguji1 }}</td>
                        <td>{{ $item->nilai_penguji2 }}</td>
                        <td>{{ $item->nilai_penguji3 }}</td>
                        <td class="nilai-angka">{{ $item->nilai_akhir }}</td>
                        <td>
                            @if ($item->lulus)
                                <span class="badge-status badge-lulus">✔ Lulus</span>
                            @else
                                <span class="badge-status badge-tidak">✘ Tidak Lulus</span>
                            @endif
                        </td>
                        @if ($bisaKelola)
                            <td>
                                <div class="aksi">
                                    <a href="{{ route('nilai-ujikom.edit', $item->getKey()) }}" class="btn btn-edit btn-sm">Edit</a>
                                    <form action="{{ route('nilai-ujikom.destroy', $item->getKey()) }}" method="POST"
                                          onsubmit="return confirm('Hapus data nilai {{ $item->nama }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-hapus btn-sm">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $bisaKelola ? 9 : 8 }}">
                            <div class="empty">Belum ada data nilai ujikom.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <p class="ket-nilai">Keterangan: <b>Nilai Akhir = jumlah nilai Penguji 1, Penguji 2 dan Penguji 3 dibagi 3 (dibulatkan)</b>. Siswa dinyatakan <b>Lulus Ujikom</b> jika nilai akhir <b>75 atau lebih</b>.</p>
</div>
@endsection