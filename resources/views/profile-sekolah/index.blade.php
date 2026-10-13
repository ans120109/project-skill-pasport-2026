@extends('layout.app')

@section('title', 'Profil Sekolah')

@section('content')
<main class="content">
    <div class="container">

        <h1 class="page-title">Profil Sekolah</h1>
        <p class="page-subtitle">Informasi lengkap tentang sekolah kami.</p>
        <hr class="divider">

        @if(session('success'))
            <div class="card" style="background:#dcfce7; color:#166534; margin-bottom:16px;">
                {{ session('success') }}
            </div>
        @endif

        @include('partials.profil-sekolah', ['profil' => $profil])

    </div>
</main>
@endsection