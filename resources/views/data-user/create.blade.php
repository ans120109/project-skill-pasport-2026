@extends('layout.app')

@section('title', 'Siswa & Guru')

@php
    $daftarSiswa = $siswas ?? $dataSiswa ?? collect();
    $daftarGuru  = $gurus  ?? $dataGuru  ?? collect();

    $tabAwal = request('tab', (old('nip') !== null || old('jabatan') !== null || old('tipe') !== null) ? 'guru' : 'siswa');
@endphp

@push('styles')
<style>
    .du-page { padding: 2rem 0 1rem; }
    .du-title { font-size: 1.6rem; font-weight: 600; }
    .du-sub { font-size: .85rem; color: var(--muted); margin-top: .1rem; }

    .du-tabs { display: inline-flex; gap: .3rem; padding: .3rem; margin: 1.2rem 0 1.2rem; background: #e7e4dc; border-radius: 10px; }
    .du-tab {
        border: 0; background: transparent; font: inherit; font-size: .85rem; font-weight: 600;
        color: #4b5563; padding: .5rem 1.1rem; border-radius: 8px; cursor: pointer;
        transition: background .15s, color .15s;
    }
    .du-tab:hover { color: var(--navy); }
    .du-tab.is-active { background: #fff; color: var(--navy); box-shadow: 0 1px 3px rgba(0,0,0,.12); }
    .du-tab:focus-visible { outline: 2px solid var(--orange); outline-offset: 2px; }

    .du-panel[hidden] { display: none; }

    .du-card { background: #fff; border-radius: 12px; padding: 1.5rem 1.6rem; box-shadow: 0 1px 3px rgba(0,0,0,.06); margin-bottom: 1.3rem; }
    .du-card h2 { font-size: 1.1rem; font-weight: 600; margin-bottom: 1.1rem; }
    .du-count { font-weight: 500; color: var(--muted); }

    .du-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 1rem 1.1rem; }
    .span-2 { grid-column: span 2; }
    .span-3 { grid-column: span 3; }
    .span-6 { grid-column: span 6; }

    .du-field label { display: block; font-size: .78rem; font-weight: 600; margin-bottom: .3rem; color: #374151; }
    .du-field .req { color: #dc2626; }
    .du-input {
        width: 100%; height: 40px; padding: 0 .75rem; font: inherit; font-size: .88rem;
        border: 1px solid #cfcac0; border-radius: 8px; background: #fff; color: var(--text);
        transition: border-color .15s, box-shadow .15s;
    }
    textarea.du-input { height: auto; min-height: 84px; padding: .6rem .75rem; resize: vertical; }
    select.du-input { appearance: auto; }
    .du-input::placeholder { color: #9ca3af; }
    .du-input:focus { outline: none; border-color: var(--orange); box-shadow: 0 0 0 3px rgba(245,158,11,.25); }
    .du-input.is-invalid { border-color: #dc2626; }
    .du-err { color: #b91c1c; font-size: .73rem; margin-top: .25rem; }

    .du-actions { margin-top: 1.3rem; display: flex; gap: .6rem; }
    .du-btn {
        display: inline-flex; align-items: center; justify-content: center;
        height: 40px; padding: 0 1.4rem; border: 0; border-radius: 8px; cursor: pointer;
        font: inherit; font-size: .88rem; font-weight: 700;
        background: var(--orange); color: #1c1300; transition: filter .15s;
    }
    .du-btn:hover { filter: brightness(1.07); }
    .du-btn:focus-visible { outline: 2px solid var(--navy); outline-offset: 2px; }

    .du-alert { font-size: .85rem; padding: .7rem .9rem; border-radius: 8px; margin-bottom: 1.1rem; }
    .du-alert-ok  { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }
    .du-alert-err { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

    .du-table-wrap { overflow-x: auto; margin: 0 -.4rem; padding: 0 .4rem; }
    .du-table { width: 100%; border-collapse: collapse; font-size: .85rem; min-width: 640px; }
    .du-table th {
        text-align: left; font-size: .75rem; font-weight: 700; color: #4b5563;
        background: #f5f3ee; padding: .65rem .8rem; white-space: nowrap;
    }
    .du-table th:first-child { border-radius: 8px 0 0 8px; }
    .du-table th:last-child  { border-radius: 0 8px 8px 0; }
    .du-table td { padding: .75rem .8rem; border-bottom: 1px solid #eeebe4; vertical-align: middle; }
    .du-table tbody tr:last-child td { border-bottom: 0; }
    .du-table tbody tr:hover { background: #faf9f6; }
    .du-table .num { width: 44px; color: var(--muted); }
    .du-table .aksi { white-space: nowrap; text-align: right; }
    .du-table th.aksi { text-align: right; }
    .du-empty { text-align: center; color: var(--muted); padding: 1.6rem 1rem !important; }

    .du-chip { display: inline-block; min-width: 24px; text-align: center; padding: .1rem .5rem; border-radius: 999px; font-size: .72rem; font-weight: 700; background: #e0e7ff; color: #3730a3; }
    .du-chip.p { background: #fce7f3; color: #9d174d; }

    .du-btn-sm {
        display: inline-flex; align-items: center; height: 30px; padding: 0 .8rem;
        font: inherit; font-size: .76rem; font-weight: 600; border-radius: 6px; cursor: pointer;
        text-decoration: none; background: #fff; transition: background .15s;
    }
    .du-edit  { border: 1px solid #cfcac0; color: var(--navy); }
    .du-edit:hover { background: #f5f3ee; }
    .du-del   { border: 1px solid #fecaca; color: #b91c1c; }
    .du-del:hover { background: #fef2f2; }
    .du-inline { display: inline; margin-left: .3rem; }

    @media (max-width: 760px) {
        .du-grid { grid-template-columns: 1fr; }
        .span-2, .span-3, .span-6 { grid-column: auto; }
        .du-card { padding: 1.2rem 1.1rem; }
    }
</style>
@endpush

@section('content')
<div class="container du-page">

    <h1 class="du-title">Siswa &amp; Guru</h1>
    <p class="du-sub">Manajemen data siswa dan guru.</p>

    @if(session('success'))
        <div class="du-alert du-alert-ok" style="margin-top:1rem">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="du-alert du-alert-err" style="margin-top:1rem">{{ $errors->first() }}</div>
    @endif

    <div class="du-tabs" role="tablist">
        <button type="button" class="du-tab" data-tab="siswa" role="tab">Data Siswa</button>
        <button type="button" class="du-tab" data-tab="guru" role="tab">Data Guru</button>
    </div>

    <div class="du-panel" id="panel-siswa" data-panel="siswa" {{ $tabAwal === 'siswa' ? '' : 'hidden' }}>

        <div class="du-card">
            <h2>Tambah Data Siswa</h2>

            <form action="{{ route('siswa-guru.store') }}" method="POST">
                @csrf
                <div class="du-grid">

                    <div class="du-field span-3">
                        <label for="nis">NIS <span class="req">*</span></label>
                        <input type="text" id="nis" name="nis" value="{{ old('nis') }}"
                               class="du-input @error('nis') is-invalid @enderror" required>
                        @error('nis')<div class="du-err">{{ $message }}</div>@enderror
                    </div>

                    <div class="du-field span-3">
                        <label for="nama">Nama Lengkap <span class="req">*</span></label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                               class="du-input @error('nama') is-invalid @enderror" required>
                        @error('nama')<div class="du-err">{{ $message }}</div>@enderror
                    </div>

                    <div class="du-field span-2">
                        <label for="jenis_kelamin">Jenis Kelamin <span class="req">*</span></label>
                        <select id="jenis_kelamin" name="jenis_kelamin"
                                class="du-input @error('jenis_kelamin') is-invalid @enderror" required>
                            <option value="">-- Pilih --</option>
                            <option value="L" @selected(old('jenis_kelamin') === 'L')>Laki-laki</option>
                            <option value="P" @selected(old('jenis_kelamin') === 'P')>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')<div class="du-err">{{ $message }}</div>@enderror
                    </div>

                    <div class="du-field span-2">
                        <label for="kelas">Kelas <span class="req">*</span></label>
                        <input type="text" id="kelas" name="kelas" value="{{ old('kelas') }}" placeholder="XII RPL 1"
                               class="du-input @error('kelas') is-invalid @enderror" required>
                        @error('kelas')<div class="du-err">{{ $message }}</div>@enderror
                    </div>

                    <div class="du-field span-2">
                        <label for="sekolah_asal">Sekolah Asal</label>
                        <input type="text" id="sekolah_asal" name="sekolah_asal" value="{{ old('sekolah_asal') }}"
                               placeholder="Nama sekolah" class="du-input">
                    </div>

                    <div class="du-field span-3">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                               class="du-input">
                    </div>

                    <div class="du-field span-3">
                        <label for="no_hp">No. HP</label>
                        <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                               placeholder="08xxxxxxxxxx" class="du-input">
                    </div>

                    <div class="du-field span-6">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" class="du-input">{{ old('alamat') }}</textarea>
                    </div>
                </div>

                <div class="du-actions">
                    <button type="submit" class="du-btn">Simpan Siswa</button>
                </div>
            </form>
        </div>

        <div class="du-card">
            <h2>Daftar Siswa <span class="du-count">({{ $daftarSiswa->count() }})</span></h2>

            <div class="du-table-wrap">
                <table class="du-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>JK</th>
                            <th>Kelas</th>
                            <th>Sekolah Asal</th>
                            <th class="aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($daftarSiswa as $s)
                            <tr>
                                <td class="num">{{ $loop->iteration }}</td>
                                <td>{{ $s->nis }}</td>
                                <td>{{ $s->nama }}</td>
                                <td><span class="du-chip {{ $s->jenis_kelamin === 'P' ? 'p' : '' }}">{{ $s->jenis_kelamin }}</span></td>
                                <td>{{ $s->kelas }}</td>
                                <td>{{ $s->sekolah_asal ?: '-' }}</td>
                                <td class="aksi">
                                    <a href="{{ route('siswa-guru.siswa.edit', $s) }}" class="du-btn-sm du-edit">Edit</a>
                                    <form action="{{ route('siswa-guru.siswa.destroy', $s) }}" method="POST" class="du-inline"
                                          onsubmit="return confirm('Hapus data siswa {{ addslashes($s->nama) }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="du-btn-sm du-del">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="du-empty">Belum ada data siswa.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="du-panel" id="panel-guru" data-panel="guru" {{ $tabAwal === 'guru' ? '' : 'hidden' }}>

        <div class="du-card">
            <h2>Tambah Data Guru</h2>

            <form action="{{ route('siswa-guru.guru.store') }}" method="POST">
                @csrf
                <div class="du-grid">

                    <div class="du-field span-3">
                        <label for="g_nip">NIP</label>
                        <input type="text" id="g_nip" name="nip" value="{{ old('nip') }}"
                               class="du-input @error('nip') is-invalid @enderror">
                        @error('nip')<div class="du-err">{{ $message }}</div>@enderror
                    </div>

                    <div class="du-field span-3">
                        <label for="g_nama">Nama Lengkap <span class="req">*</span></label>
                        <input type="text" id="g_nama" name="nama" value="{{ old('nama') }}"
                               class="du-input @error('nama') is-invalid @enderror" required>
                        @error('nama')<div class="du-err">{{ $message }}</div>@enderror
                    </div>

                    <div class="du-field span-4">
                        <label for="g_jabatan">Jabatan <span class="req">*</span></label>
                        <input type="text" id="g_jabatan" name="jabatan" value="{{ old('jabatan') }}"
                               placeholder="Contoh: Guru Matematika" 
                               class="du-input @error('jabatan') is-invalid @enderror" required>
                        @error('jabatan')<div class="du-err">{{ $message }}</div>@enderror
                    </div>

                    <div class="du-field span-2">
                        <label for="g_tipe">Tipe <span class="req">*</span></label>
                        <select id="g_tipe" name="tipe" class="du-input @error('tipe') is-invalid @enderror" required>
                            <option value="guru" @selected(old('tipe') === 'guru')>Guru</option>
                            <option value="staff" @selected(old('tipe') === 'staff')>Staff</option>
                        </select>
                        @error('tipe')<div class="du-err">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="du-actions">
                    <button type="submit" class="du-btn">Simpan Guru</button>
                </div>
            </form>
        </div>

        <div class="du-card">
            <h2>Daftar Guru <span class="du-count">({{ $daftarGuru->count() }})</span></h2>

            <div class="du-table-wrap">
                <table class="du-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Tipe</th>
                            <th>Status</th>
                            <th class="aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($daftarGuru as $g)
                            <tr>
                                <td class="num">{{ $loop->iteration }}</td>
                                <td>{{ $g->nip ?: '-' }}</td>
                                <td>{{ $g->nama }}</td>
                                <td>{{ $g->jabatan ?: '-' }}</td>
                                <td><span class="du-chip">{{ ucfirst($g->tipe) }}</span></td>
                                <td>{{ $g->aktif ? 'Aktif' : 'Nonaktif' }}</td>
                                <td class="aksi">
                                    <a href="{{ route('siswa-guru.guru.edit', $g) }}" class="du-btn-sm du-edit">Edit</a>
                                    <form action="{{ route('siswa-guru.guru.destroy', $g) }}" method="POST" class="du-inline"
                                          onsubmit="return confirm('Hapus data guru {{ addslashes($g->nama ?? $g->name) }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="du-btn-sm du-del">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="du-empty">Belum ada data guru.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    (function () {
        var tabs   = document.querySelectorAll('.du-tab');
        var panels = document.querySelectorAll('.du-panel');

        function show(name) {
            tabs.forEach(function (t) {
                var on = t.dataset.tab === name;
                t.classList.toggle('is-active', on);
                t.setAttribute('aria-selected', on ? 'true' : 'false');
            });
            panels.forEach(function (p) { p.hidden = p.dataset.panel !== name; });
            history.replaceState(null, '', '?tab=' + name);
        }

        tabs.forEach(function (t) {
            t.addEventListener('click', function () { show(t.dataset.tab); });
        });

        show(@json($tabAwal));
    })();
</script>
@endsection