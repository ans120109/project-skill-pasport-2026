<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'Beranda'); ?> - SMA Cendikia Nusantara</title>

    <style>
        :root {
            --navy: #0b1d44;
            --navy-2: #13294f;
            --orange: #f59e0b;
            --bg: #f3f1ec;
            --card: #ffffff;
            --text: #1c2333;
            --muted: #6b7280;
            --line: #e2dfd8;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; scroll-padding-top: 70px; }
        body {
            font-family: "Segoe UI", system-ui, -apple-system, Roboto, Arial, sans-serif;
            background: var(--bg); color: var(--text); line-height: 1.6;
            display: flex; flex-direction: column; min-height: 100vh;
        }
        main { flex: 1; }
        a { color: inherit; }
        img { max-width: 100%; display: block; }
        .container { width: min(960px, 92%); margin-inline: auto; }

        .navbar { background: var(--navy); position: sticky; top: 0; z-index: 50; }
        .navbar-inner { display: flex; align-items: center; justify-content: space-between; gap: 1rem; min-height: 56px; flex-wrap: wrap; }
        .brand { display: flex; align-items: center; gap: .6rem; text-decoration: none; color: var(--orange); font-weight: 700; }
        .brand-logo { width: 28px; height: 28px; border-radius: 4px; object-fit: cover; }
        .nav-links { display: flex; gap: 1.1rem; flex-wrap: wrap; align-items: center; }
        .nav-links a, .nav-links button {
            color: #fff; text-decoration: none; font-size: .78rem; font-weight: 600; font-family: inherit;
            padding: 1rem 0; border: 0; border-bottom: 2px solid transparent; background: none; cursor: pointer;
        }
        .nav-links a:hover, .nav-links button:hover { color: var(--orange); }
        .nav-links a.active { color: var(--orange); border-bottom-color: #cbd5e1; }
        .nav-links a:focus-visible, .nav-links button:focus-visible, .brand:focus-visible { outline: 2px solid var(--orange); outline-offset: 3px; }

        .nav-links .nav-btn {
            padding: .45rem 1.05rem; border: 0; border-radius: 8px;
            background: var(--orange); color: #1c1300;
            font-size: .8rem; font-weight: 700;
        }
        .nav-links .nav-btn:hover { color: #1c1300; filter: brightness(1.08); }
        .nav-links .nav-btn-outline {
            padding: .45rem 1.05rem; border: 1px solid #5c6b8f; border-radius: 8px;
            background: none; color: #fff;
            font-size: .8rem; font-weight: 700;
        }
        .nav-links .nav-btn-outline:hover { border-color: var(--orange); color: var(--orange); }

        .hero { background: var(--navy); color: #fff; padding: 3.2rem 0 3.4rem; }
        .hero h1 { font-size: 2rem; font-weight: 600; max-width: 20ch; }
        .hero p { margin-top: .8rem; max-width: 60ch; color: #d6dbe8; font-size: .95rem; }
        .hero-actions { margin-top: 1.4rem; display: flex; gap: .7rem; flex-wrap: wrap; }
        .btn { display: inline-block; padding: .55rem 1.1rem; border-radius: 8px; font-size: .85rem; font-weight: 600; text-decoration: none; }
        .btn-primary { background: var(--orange); color: #1c1300; }
        .btn-ghost { border: 1px solid #5c6b8f; color: #fff; }
        .btn-outline { border: 1px solid #cfcac0; color: var(--navy); background: #fff; }
        .btn:hover { filter: brightness(1.08); }

        .section { padding: 2.2rem 0 .6rem; }
        .section-head { display: flex; justify-content: space-between; align-items: baseline; gap: 1rem; padding-bottom: .8rem; margin-bottom: 1.1rem; border-bottom: 1px solid var(--line); }
        .section-head h2 { font-size: 1.4rem; font-weight: 500; }
        .section-head a { font-size: .8rem; color: #b45309; font-weight: 600; text-decoration: none; }
        .section-head a:hover { text-decoration: underline; }

        .card { background: var(--card); border-radius: 10px; padding: 1.1rem 1.25rem; box-shadow: 0 1px 3px rgba(0,0,0,.06); }
        .card h3 { font-size: 1.05rem; margin-bottom: .4rem; }
        .card p, .card li { font-size: .9rem; }
        .muted { color: var(--muted); font-size: .88rem; }
        .more { margin-top: 1rem; }

        .stack { display: grid; gap: 1rem; margin-top: 1rem; }
        .prose { max-width: 78ch; line-height: 1.75; }

        .grid-3 { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 1rem; }
        .media-card { background: var(--card); border-radius: 10px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,.06); text-decoration: none; display: flex; flex-direction: column; }
        .media-card img, .media-card .noimg { width: 100%; aspect-ratio: 16 / 10; object-fit: cover; background: #d9d5cb; }
        .media-body { padding: .9rem 1rem 1rem; }
        .media-body h3 { font-size: .98rem; margin-bottom: .2rem; }
        .media-meta { font-size: .72rem; color: #a16207; margin-bottom: .35rem; }
        .media-body p { font-size: .82rem; color: #374151; }

        .profil { display: flex; gap: 1.25rem; align-items: flex-start; }
        .profil-foto { width: 260px; border-radius: 8px; object-fit: cover; aspect-ratio: 4 / 3; flex-shrink: 0; }
        .list { padding-left: 1.2rem; display: grid; gap: .45rem; }

        .grid-orang { display: grid; grid-template-columns: repeat(auto-fill, minmax(170px, 1fr)); gap: 1rem; }
        .orang { text-align: center; }
        .orang-foto { width: 96px; height: 96px; border-radius: 50%; object-fit: cover; margin: 0 auto .7rem; }
        .orang-inisial { display: flex; align-items: center; justify-content: center; background: var(--navy-2); color: var(--orange); font-size: 1.5rem; font-weight: 700; }
        .orang h4 { font-size: .9rem; font-weight: 600; }
        .orang p { font-size: .78rem; color: var(--muted); }

        .auth-wrap { min-height: calc(100vh - 56px - 44px); display: flex; align-items: center; justify-content: center; padding: 2rem 1rem; }
        .auth-card { width: min(420px, 100%); background: var(--card); border-radius: 12px; padding: 1.8rem 1.8rem 1.5rem; box-shadow: 0 4px 18px rgba(11, 29, 68, .08); }
        .auth-card h1 { font-size: 1.5rem; font-weight: 600; }
        .auth-sub { font-size: .82rem; color: var(--muted); margin: .2rem 0 1.4rem; }

        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; font-size: .8rem; font-weight: 600; margin-bottom: .35rem; color: var(--text); }
        .form-input {
            width: 100%; padding: .65rem .8rem; font: inherit; font-size: .9rem;
            border: 1px solid #cfcac0; border-radius: 8px; background: #fff; color: var(--text);
            transition: border-color .15s, box-shadow .15s;
        }
        .form-input::placeholder { color: #9ca3af; }
        .form-input:focus { outline: none; border-color: var(--orange); box-shadow: 0 0 0 3px rgba(245, 158, 11, .25); }
        .form-input.is-invalid { border-color: #dc2626; }
        .form-error { color: #b91c1c; font-size: .75rem; margin-top: .3rem; }

        .form-btn {
            width: 100%; padding: .7rem 1rem; border: 0; border-radius: 8px; cursor: pointer;
            background: var(--orange); color: #1c1300; font: inherit; font-size: .9rem; font-weight: 700;
            transition: filter .15s;
        }
        .form-btn:hover { filter: brightness(1.07); }
        .form-btn:focus-visible { outline: 2px solid var(--navy); outline-offset: 2px; }

        .alert { font-size: .82rem; padding: .65rem .8rem; border-radius: 8px; margin-bottom: 1rem; }
        .alert-error { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }
        .alert-success { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }

        .auth-foot { margin-top: 1.3rem; padding-top: 1rem; border-top: 1px solid var(--line); font-size: .82rem; color: var(--muted); display: grid; gap: .45rem; }
        .auth-foot a { color: #b45309; font-weight: 600; text-decoration: none; }
        .auth-foot a:hover { text-decoration: underline; }

        .footer { background: var(--navy); color: #fff; text-align: center; font-size: .7rem; padding: .8rem 1rem; font-weight: 600; margin-top: 2.5rem; }

        @media (max-width: 720px) {
            .profil { flex-direction: column; }
            .profil-foto { width: 100%; }
            .hero h1 { font-size: 1.6rem; }
            .nav-links { gap: .8rem; }
            .nav-links a, .nav-links button { padding: .4rem 0; }
        }
        @media (prefers-reduced-motion: reduce) { html { scroll-behavior: auto; } }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

    <header class="navbar">
        <div class="container navbar-inner">
            <a href="<?php echo e(route('home')); ?>" class="brand">
                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo" class="brand-logo" onerror="this.style.display='none'">
                <span>SMA Cendikia Nusantara</span>
            </a>

            <nav class="nav-links">
                <a href="<?php echo e(route('home')); ?>" class="<?php echo e(request()->routeIs('home') ? 'active' : ''); ?>">Beranda</a>
                <a href="<?php echo e(route('profil')); ?>" class="<?php echo e(request()->routeIs('profil') ? 'active' : ''); ?>">Profil</a>
                <a href="<?php echo e(route('guru-staff')); ?>" class="<?php echo e(request()->routeIs('guru-staff') ? 'active' : ''); ?>">Guru &amp; Staff</a>
                <a href="<?php echo e(route('berita.index')); ?>" class="<?php echo e(request()->routeIs('berita.*') ? 'active' : ''); ?>">Berita &amp; Pengumuman</a>
                <a href="<?php echo e(route('galeri.index')); ?>" class="<?php echo e(request()->routeIs('galeri.*') ? 'active' : ''); ?>">Galeri</a>
                <a href="<?php echo e(route('akademik')); ?>" class="<?php echo e(request()->routeIs('akademik') ? 'active' : ''); ?>">Akademik</a>
                <a href="<?php echo e(route('ekstrakurikuler.index')); ?>" class="<?php echo e(request()->routeIs('ekstrakurikuler.*') ? 'active' : ''); ?>">Ekstrakurikuler</a>
                <a href="<?php echo e(route('nilai-ujikom.index')); ?>" class="<?php echo e(request()-> routeIs('nilai-ujikom.*') ? 'active' : ''); ?>">Nilai Ujikom</a>

                <?php if(auth()->guard()->check()): ?>
                    <?php
                        $role = auth()->user()->role ?? 'admin';
                        $dash = match ($role) {
                            'guru'  => route('guru.dashboard'),
                            'siswa' => route('siswa.dashboard'),
                            'user'  => route('user.dashboard'),
                            default => route('admin.dashboard'),
                        };
                    ?>
                    <?php if(in_array($role, ['admin', 'operator'])): ?>
                        <a href="<?php echo e(route('data-siswa.index')); ?>" class="<?php echo e(request()->routeIs('data-siswa.*') ? 'active' : ''); ?>">Data Siswa</a>
                    <?php endif; ?>
                    <a href="<?php echo e($dash); ?>">Dashboard</a>
                    <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="nav-btn-outline">Keluar</button>
                    </form>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="nav-btn">Masuk</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="footer">
        &copy; <?php echo e(date('Y')); ?> SMA Cendikia Nusantara. All rights reserved.
    </footer>

</body>
</html><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views/layout/app.blade.php ENDPATH**/ ?>