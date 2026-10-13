@extends('layout.app')

@section('title', 'Profil')

@section('content')
<main class="content">
    <div class="container">

        <h1 class="page-title">Profil</h1>
        <p class="page-subtitle">Informasi profil pengguna dan sekolah.</p>
        <hr class="divider">

        <div class="card">
            <h2>👤 Profil</h2>

            @auth
                <div style="margin-top:12px; line-height:1.9;">
                    <p class="muted" style="margin:0;">
                        <strong>Nama:</strong> {{ Auth::user()->name }}
                    </p>
                    <p class="muted" style="margin:0;">
                        <strong>Username:</strong> {{ Auth::user()->username ?? '-' }}
                    </p>
                    <p class="muted" style="margin:0;">
                        <strong>Role:</strong>
                        <span style="background:#d99a22; color:white; padding:2px 10px; border-radius:12px; font-size:12px; font-weight:600;">
                            {{ Auth::user()->role ?? 'user' }}
                        </span>
                    </p>
                    <p class="muted" style="margin:0;">
                        <strong>Status:</strong>
                        @if (Auth::user()->is_active)
                            <span style="color:#28a745; font-weight:600;">● Aktif</span>
                        @else
                            <span style="color:#dc3545; font-weight:600;">● Nonaktif</span>
                        @endif
                    </p>
                </div>

                <div class="action-buttons" style="margin-top:20px; padding-top:16px; border-top:1px solid #eee;">
                    <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                        @csrf
                        <button type="submit" class="btn-action btn-danger">🚪 Logout</button>
                    </form>
                </div>
            @else
                <p class="muted">
                    Anda belum login. Silakan
                    <a href="{{ route('login') }}">masuk</a> terlebih dahulu.
                </p>
            @endauth
        </div>

        <h2 style="margin:28px 0 14px;">🏫 Profil Sekolah</h2>
        @include('partials.profil-sekolah')

    </div>
</main>
@endsection