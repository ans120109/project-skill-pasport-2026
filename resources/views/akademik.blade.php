@extends('layout.app')

@section('title', 'Akademik')

@section('content')
<main class="content">
    <div class="container">

        <h1 class="page-title">Akademik</h1>
        <p class="page-subtitle">Program pembelajaran dan informasi akademik sekolah.</p>
        <hr class="divider">

        <div class="stack">
            <div class="card">
                <h2><span class="academic-icon">📚</span>Program Akademik</h2>
                <p class="muted">
                    Pembelajaran MIPA, IPS, Bahasa, komputer, riset ilmiah,
                    dan pengembangan karakter siswa.
                </p>
            </div>

            <div class="card">
                <h2><span class="academic-icon">🔬</span>Laboratorium</h2>
                <p class="muted">
                    Fasilitas laboratorium sains dan komputer untuk mendukung
                    pembelajaran berbasis praktik.
                </p>
            </div>

            <div class="card">
                <h2><span class="academic-icon">📅</span>Jadwal Pelajaran</h2>
                <p class="muted">
                    Jadwal pelajaran setiap kelas dikelola oleh operator dan
                    dapat diperoleh melalui tata usaha.
                </p>
            </div>

            <div class="card">
                <h2><span class="academic-icon">🏆</span>Kegiatan & Prestasi</h2>
                <p class="muted">
                    Kegiatan olimpiade, ekstrakurikuler, lomba, serta berbagai
                    program pengembangan bakat siswa.
                </p>
            </div>
        </div>

    </div>
</main>
@endsection