@extends('layout.app')

@section('title', 'Login')

@section('content')
<div class="auth-wrap">
    <div class="auth-card">
        <h1>Login</h1>
        <p class="auth-sub">Masuk ke Panel Sekolah</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username"
                       class="form-input @error('username') is-invalid @enderror"
                       value="{{ old('username') }}" placeholder="Masukkan username"
                       autocomplete="username" autofocus required>
                @error('username')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password"
                       class="form-input @error('password') is-invalid @enderror"
                       placeholder="Masukkan kata sandi"
                       autocomplete="current-password" required>
                @error('password')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="form-btn">Login</button>
        </form>

        <div class="auth-foot">
            <span>Belum punya akun? <a href="{{ route('register') }}">Register</a></span>
            <a href="{{ route('home') }}">&larr; Kembali ke halaman sekolah</a>
        </div>
    </div>
</div>
@endsection