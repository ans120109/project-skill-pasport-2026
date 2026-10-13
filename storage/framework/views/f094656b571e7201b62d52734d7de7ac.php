<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startPush('styles'); ?>
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $bisaKelola = in_array(auth()->user()->role, ['admin', 'operator']);
?>

<div class="container">
    <h1 class="page-title">Dashboard Utama</h1>
    <p class="page-subtitle">Selamat datang kembali di Panel Akademik SMA Cendekia Nusantara.</p>
    <hr class="divider">

    
    <div class="grid-3 stat-grid">
        <div class="card stat-card" style="border-left-color:#2a6fb5;">
            <h3 style="color:#2a6fb5;">Total Siswa</h3>
            <p class="angka"><?php echo e(number_format($totalSiswa, 0, ',', '.')); ?></p>
        </div>
        <div class="card stat-card" style="border-left-color:#2f8f8a;">
            <h3 style="color:#2f8f8a;">Total Guru</h3>
            <p class="angka"><?php echo e(number_format($totalGuru, 0, ',', '.')); ?></p>
        </div>
        <div class="card stat-card" style="border-left-color:#e39a1b;">
            <h3 style="color:#e39a1b;">Total Ekstrakurikuler</h3>
            <p class="angka"><?php echo e(number_format($totalEkskul, 0, ',', '.')); ?></p>
        </div>
    </div>

    
    <?php if($bisaKelola): ?>
        <div class="card" style="margin-bottom:14px;">
            <h2 class="dash-title">⚡ Aksi Cepat</h2>
            <div class="quick-actions">
                <a href="<?php echo e(route('berita.create')); ?>" class="btn btn-gold">+ Tambah Berita</a>
                <a href="<?php echo e(route('galeri.create')); ?>" class="btn btn-gold">+ Tambah Foto</a>
                <a href="<?php echo e(route('ekstrakurikuler.create')); ?>" class="btn btn-gold">+ Tambah Ekskul</a>
                <a href="<?php echo e(route('siswa-guru.create')); ?>" class="btn btn-outline">Kelola Siswa &amp; Guru</a>
                <a href="<?php echo e(route('profile-sekolah.edit')); ?>" class="btn btn-outline">Edit Profil Sekolah</a>
                <?php if(auth()->user()->role === 'admin'): ?>
                    <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-outline">Kelola Akun</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    
    <div class="dash-grid">
        <div class="card">
            <h2 class="dash-title">📊 Ringkasan Konten</h2>
            <div class="info-row"><span>Berita &amp; Pengumuman</span><span><?php echo e($totalBerita); ?></span></div>
            <div class="info-row"><span>Foto Galeri</span><span><?php echo e($totalGaleri); ?></span></div>
            <div class="info-row"><span>Akun Terdaftar</span><span><?php echo e($akunPerRole->sum()); ?></span></div>

            <div class="badge-row" style="margin-top:12px;">
                <?php $__currentLoopData = ['admin' => 'Admin', 'operator' => 'Operator', 'user' => 'User', 'guru' => 'Guru', 'siswa' => 'Siswa']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="badge"><?php echo e($label); ?>: <?php echo e($akunPerRole[$key] ?? 0); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div class="card">
            <h2 class="dash-title">🏫 Info Sekolah</h2>
            <div class="info-row"><span>NPSN</span><span><?php echo e($profil->npsn ?? '-'); ?></span></div>
            <div class="info-row"><span>Akreditasi</span><span><?php echo e($profil->akreditasi ?? '-'); ?></span></div>
            <div class="info-row"><span>Tahun Berdiri</span><span><?php echo e($profil->tahun_berdiri ?? '-'); ?></span></div>
            <div class="info-row"><span>Kepala Sekolah</span><span><?php echo e($profil->nama_kepsek ?? '-'); ?></span></div>
            <div class="info-row"><span>Telepon</span><span><?php echo e($profil->telepon ?? '-'); ?></span></div>
        </div>
    </div>

    
    <div class="card" style="margin-bottom:14px;">
        <div class="dash-head">
            <h2 class="dash-title">🎓 Data Siswa <span class="dash-count">(<?php echo e($daftarSiswa->count()); ?>)</span></h2>
            <?php if($bisaKelola): ?>
                <a href="<?php echo e(route('siswa-guru.create')); ?>?tab=siswa" class="btn btn-gold">+ Tambah Siswa</a>
            <?php endif; ?>
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
                        <?php if($bisaKelola): ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $daftarSiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="td-no"><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($s->nis); ?></td>
                            <td><?php echo e($s->nama); ?></td>
                            <td><?php echo e($s->jenis_kelamin); ?></td>
                            <td><?php echo e($s->kelas); ?></td>
                            <?php if($bisaKelola): ?>
                                <td class="td-aksi">
                                    <a href="<?php echo e(route('siswa-guru.siswa.edit', $s)); ?>" class="btn btn-edit btn-sm">Edit</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="<?php echo e($bisaKelola ? 6 : 5); ?>" class="dash-empty">Belum ada data siswa.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="dash-grid">
        <div class="card">
            <h2 class="dash-title">👩‍🏫 Guru Terbaru</h2>
            <ul class="mini-list">
                <?php $__empty_1 = true; $__currentLoopData = $guruBaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li>
                        <span><?php echo e($g->nama); ?></span>
                        <span class="sub"><?php echo e($g->jabatan); ?></span>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <li><span class="sub">Belum ada data guru.</span></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    
    <div class="card">
        <h2 class="dash-title">📢 Pengumuman &amp; Berita Terbaru</h2>
        <ul class="mini-list">
            <?php $__empty_1 = true; $__currentLoopData = $beritaBaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li>
                    <a href="<?php echo e(route('berita.show', $b->getKey())); ?>"><?php echo e($b->judul); ?></a>
                    <span class="sub"><?php echo e($b->created_at->format('d M Y')); ?></span>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <li>
                    <span class="sub">
                        Belum ada pengumuman yang diterbitkan hari ini.
                        <?php if($bisaKelola): ?> Gunakan panel admin untuk membuat informasi baru. <?php endif; ?>
                    </span>
                </li>
            <?php endif; ?>
        </ul>
        <a href="<?php echo e(route('berita.index')); ?>" class="dashboard-link">Lihat semua berita →</a>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>