@extends('layout.app')

@section('title', 'Edit User')

@section('content')
<main class="content">
    <div class="container">

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
            <div>
                <h1 class="page-title">Edit User</h1>
                <p class="page-subtitle">Perbarui data pengguna.</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="btn-action" style="background:#6c757d;">
                ← Kembali
            </a>
        </div>

        <hr class="divider">

        @if ($errors->any())
            <div style="background:#f8d7da; color:#721c24; padding:12px 16px; border-radius:5px; margin-bottom:16px;">
                <ul style="margin:0; padding-left:20px;">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div style="background:#f8d7da; color:#721c24; padding:12px 16px; border-radius:5px; margin-bottom:16px;">
                {{ session('error') }}
            </div>
        @endif

        @php
            $isOperator    = Auth::user()->role === 'operator';
            $targetIsAdmin = $user->role === 'admin';
            $canEditStatus = ! ($isOperator && $targetIsAdmin);
            $canEditRole   = ! ($isOperator && $targetIsAdmin);
        @endphp

        <div class="card">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div style="margin-bottom:16px;">
                    <label style="display:block; font-weight:600; margin-bottom:6px;">
                        Nama Lengkap <span style="color:red;">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                           style="width:100%; padding:8px 12px; border:1px solid #ccc; border-radius:4px; font-size:14px;">
                </div>

                <div style="margin-bottom:16px;">
                    <label style="display:block; font-weight:600; margin-bottom:6px;">
                        Username <span style="color:red;">*</span>
                    </label>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}" required
                           style="width:100%; padding:8px 12px; border:1px solid #ccc; border-radius:4px; font-size:14px;">
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px;">
                    <div>
                        <label style="display:block; font-weight:600; margin-bottom:6px;">
                            Password Baru <span style="color:#888; font-weight:400;">(kosongkan jika tidak diganti)</span>
                        </label>
                        <input type="password" name="password"
                               style="width:100%; padding:8px 12px; border:1px solid #ccc; border-radius:4px; font-size:14px;">
                    </div>
                    <div>
                        <label style="display:block; font-weight:600; margin-bottom:6px;">
                            Konfirmasi Password
                        </label>
                        <input type="password" name="password_confirmation"
                               style="width:100%; padding:8px 12px; border:1px solid #ccc; border-radius:4px; font-size:14px;">
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <label style="display:block; font-weight:600; margin-bottom:6px;">
                        Role <span style="color:red;">*</span>
                    </label>

                    @if ($canEditRole)
                        <select name="role" required
                                style="width:100%; padding:8px 12px; border:1px solid #ccc; border-radius:4px; font-size:14px;">
                            <option value="admin"    {{ old('role', $user->role) === 'admin'    ? 'selected' : '' }}>Admin</option>
                            <option value="operator" {{ old('role', $user->role) === 'operator' ? 'selected' : '' }}>Operator</option>
                            <option value="user"     {{ old('role', $user->role) === 'user'     ? 'selected' : '' }}>User</option>
                        </select>
                    @else
                        <input type="text" value="{{ $user->role }}" disabled
                               style="width:100%; padding:8px 12px; border:1px solid #ddd; border-radius:4px; font-size:14px; background:#f5f5f5; color:#666;">
                        <input type="hidden" name="role" value="{{ $user->role }}">
                        <p style="font-size:12px; color:#999; margin-top:4px;">
                            Anda tidak bisa mengubah role akun admin.
                        </p>
                    @endif
                </div>

                <div style="margin-bottom:20px; padding:16px; background:#f9f9f9; border-radius:6px;">
                    <label style="display:block; font-weight:600; margin-bottom:10px;">
                        Status Akun
                    </label>

                    @php
                        $currentStatus = old('is_active', $user->is_active ? '1' : '0');
                    @endphp

                    @if ($canEditStatus)
                        <div style="display:flex; gap:20px; align-items:center;">
                            <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                                <input type="radio"
                                       name="is_active"
                                       value="1"
                                       {{ $currentStatus == '1' ? 'checked' : '' }}>
                                <span style="color:#28a745; font-weight:600;">● Aktif</span>
                            </label>

                            <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                                <input type="radio"
                                       name="is_active"
                                       value="0"
                                       {{ $currentStatus == '0' ? 'checked' : '' }}>
                                <span style="color:#dc3545; font-weight:600;">● Nonaktif</span>
                            </label>
                        </div>

                        <p style="font-size:12px; color:#888; margin-top:8px;">
                            User nonaktif tidak bisa login ke sistem.
                        </p>
                    @else
                        <div style="display:flex; align-items:center; gap:8px;">
                            @if ($user->is_active)
                                <span style="color:#28a745; font-weight:600;">● Aktif</span>
                            @else
                                <span style="color:#dc3545; font-weight:600;">● Nonaktif</span>
                            @endif
                            <span style="font-size:12px; color:#999;">(tidak bisa diubah)</span>
                        </div>

                        <input type="hidden" name="is_active" value="{{ $user->is_active ? '1' : '0' }}">

                        <p style="font-size:12px; color:#999; margin-top:8px;">
                            Anda tidak bisa mengubah status akun admin.
                        </p>
                    @endif
                </div>

                <div class="action-buttons" style="margin-top:20px; padding-top:16px; border-top:1px solid #eee;">
                    <button type="submit" class="btn-action">Update</button>
                    <a href="{{ route('admin.users.index') }}" class="btn-action" style="background:#6c757d;">Batal</a>
                </div>

            </form>
        </div>

    </div>
</main>
@endsection
