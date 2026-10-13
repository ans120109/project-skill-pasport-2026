@extends('layout.app')

@section('title', 'Data User')

@section('content')
<main class="content">
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
            <div>
                <h1 class="page-title">Data User</h1>
                <p class="page-subtitle">Manajemen akun pengguna sistem.</p>
            </div>

            @auth
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.users.create') }}" class="btn-action">
                        + Tambah User
                    </a>
                @endif
            @endauth
        </div>

        <hr class="divider">
        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div style="background:#f8d7da; color:#721c24; padding:12px 16px; border-radius:5px; margin-bottom:16px; border-left:4px solid #dc3545;">
                {{ session('error') }}
            </div>
        @endif
        <div class="card">
            <h2>🔐 Daftar User</h2>

            <div style="overflow-x:auto; margin-top:12px;">
                <table style="width:100%; border-collapse:collapse; min-width:700px;">
                    <thead>
                        <tr style="background:#f7f5ef;">
                            <th style="padding:10px; text-align:left; border-bottom:2px solid #ddd; font-size:14px;">No</th>
                            <th style="padding:10px; text-align:left; border-bottom:2px solid #ddd; font-size:14px;">Nama</th>
                            <th style="padding:10px; text-align:left; border-bottom:2px solid #ddd; font-size:14px;">Username</th>
                            <th style="padding:10px; text-align:left; border-bottom:2px solid #ddd; font-size:14px;">Role</th>
                            <th style="padding:10px; text-align:left; border-bottom:2px solid #ddd; font-size:14px;">Status</th>

                            @auth
                                @if (Auth::user()->role === 'admin' || Auth::user()->role === 'operator')
                                    <th style="padding:10px; text-align:left; border-bottom:2px solid #ddd; font-size:14px;">Aksi</th>
                                @endif
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users ?? [] as $i => $user)
                            <tr style="border-bottom:1px solid #eee;">
                                <td style="padding:10px; font-size:14px;">{{ $i + 1 }}</td>
                                <td style="padding:10px; font-size:14px;">{{ $user->name }}</td>
                                <td style="padding:10px; font-size:14px;">{{ $user->username ?? '-' }}</td>
                                <td style="padding:10px; font-size:14px;">
                                    <span style="background:#d99a22; color:white; padding:3px 10px; border-radius:12px; font-size:12px; font-weight:600;">
                                        {{ $user->role ?? 'user' }}
                                    </span>
                                </td>
                                <td style="padding:10px; font-size:14px;">
                                    @if ($user->is_active)
                                        <span style="background:#28a745; color:white; padding:3px 10px; border-radius:12px; font-size:12px; font-weight:600;">
                                            ● Aktif
                                        </span>
                                    @else
                                        <span style="background:#dc3545; color:white; padding:3px 10px; border-radius:12px; font-size:12px; font-weight:600;">
                                            ● Nonaktif
                                        </span>
                                    @endif
                                </td>
                                @auth
                                    @if (Auth::user()->role === 'admin' || Auth::user()->role === 'operator')
                                        <td style="padding:10px;">
                                            <div style="display:flex; gap:6px; flex-wrap:wrap;">

                                                @php
                                                    $isOperator = Auth::user()->role === 'operator';
                                                    $targetIsAdmin = $user->role === 'admin';
                                                    $canEdit = ! $isOperator || ! $targetIsAdmin;
                                                @endphp

                                                @if ($canEdit)
                                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                                       class="btn-action"
                                                       style="font-size:12px; padding:4px 10px;">
                                                        Edit
                                                    </a>
                                                @else
                                                    <span style="font-size:12px; color:#999; padding:4px 10px;">
                                                        (Admin - read only)
                                                    </span>
                                                @endif
                                                @if (Auth::user()->role === 'admin' && $user->id !== Auth::id())
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                          method="POST"
                                                          onsubmit="return confirm('Yakin hapus user ini?')"
                                                          style="margin:0;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="btn-action btn-danger"
                                                                style="font-size:12px; padding:4px 10px;">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                @endif

                                            </div>
                                        </td>
                                    @endif
                                @endauth
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="padding:20px; text-align:center; color:#888;">
                                    Belum ada user.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @auth
            @if (Auth::user()->role === 'operator')
                <div style="background:#e7f3ff; border-left:4px solid #2196F3; padding:12px 16px; border-radius:5px; margin-top:16px;">
                    <p style="margin:0; font-size:14px; color:#0d47a1;">
                        ℹ️ Anda login sebagai <strong>Operator</strong>. Anda <strong>tidak bisa</strong> mengedit user dengan role <strong>Admin</strong> atau mengubah statusnya.
                    </p>
                </div>
            @endif
        @endauth

    </div>
</main>
@endsection
