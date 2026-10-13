<?php $__env->startSection('title', 'Dashboard Siswa'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .btn {
        display: inline-flex; align-items: center; justify-content: center; gap: 6px;
        padding: 9px 18px; border: 1px solid transparent; border-radius: 8px;
        font-family: inherit; font-size: 13px; font-weight: 600; line-height: 1.2;
        text-decoration: none; cursor: pointer;
        transition: background .2s, color .2s, transform .1s, box-shadow .2s;
    }
    .btn:hover { transform: translateY(-1px); box-shadow: 0 4px 10px rgba(0,0,0,.15); }
    .btn-gold { background: #d99a22; color: #fff; border-color: #d99a22; }
    .btn-gold:hover { background: #c28a1c; border-color: #c28a1c; }
    .btn-outline { background: #fff; color: #0f1f4b; border-color: #0f1f4b; }
    .btn-outline:hover { background: #0f1f4b; color: #fff; }

    .welcome {
        display: flex; align-items: center; justify-content: space-between;
        gap: 16px; flex-wrap: wrap;
        background: #0f1f4b; color: #fff;
        border-radius: 14px; padding: 22px 26px; margin: 16px 0 24px;
    }
    .welcome h2 { margin: 0 0 4px; font-size: 20px; color: #fff; }
    .welcome p { margin: 0; font-size: 14px; opacity: .85; color: #fff; }
    .welcome .role-badge {
        background: #d99a22; color: #fff; padding: 4px 14px;
        border-radius: 999px; font-size: 12px; font-weight: 600;
    }

    .section-head {
        display: flex; align-items: center; justify-content: space-between;
        margin: 8px 0 12px;
    }
    .section-head h3 {
        margin: 0; font-size: 18px; color: #0f1f4b;
        border-left: 4px solid #d99a22; padding-left: 10px;
    }
    .section-head a { font-size: 13px; font-weight: 600; color: #d99a22; text-decoration: none; }
    .section-head a:hover { text-decoration: underline; }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 16px;
        margin-bottom: 28px;
    }
    .info-card {
        background: #fff; border: 1px solid #e5e7eb; border-radius: 12px;
        overflow: hidden; display: flex; flex-direction: column;
        text-decoration: none; color: inherit;
        transition: box-shadow .2s, transform .2s;
    }
    .info-card:hover { box-shadow: 0 6px 16px rgba(0,0,0,.08); transform: translateY(-2px); }
    .info-card img {
        width: 100%; height: 140px; object-fit: cover; display: block; background: #e9e6df;
    }
    .info-card .noimg {
        height: 140px; background: #e9e6df; display: flex;
        align-items: center; justify-content: center; font-size: 32px;
    }
    .info-body { padding: 14px 16px 16px; display: flex; flex-direction: column; flex: 1; }
    .info-body h4 { margin: 0 0 6px; font-size: 15px; color: #0f1f4b; line-height: 1.4; }
    .info-meta { font-size: 12px; color: #6b7280; margin-bottom: 8px; }
    .info-body p { margin: 0 0 10px; font-size: 13px; line-height: 1.6; color: #4b5563; }
    .info-more { margin-top: auto; font-size: 12px; font-weight: 600; color: #d99a22; }

    .badge-jadwal {
        display: inline-block; background: #fdf3dc; color: #8a5a00;
        padding: 3px 10px; border-radius: 999px; font-size: 11px;
        font-weight: 600; margin-bottom: 8px; align-self: flex-start;
    }

    .empty-box {
        grid-column: 1 / -1; background: #fff; border: 1px dashed #d1d5db;
        border-radius: 12px; padding: 24px; text-align: center; color: #6b7280; font-size: 14px;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="page-title">Portal Siswa</h1>
    <p class="page-subtitle">Informasi akademik dan kegiatan sekolah Anda.</p>
    <hr class="divider">

    <div class="welcome">
        <div>
            <h2>Halo, <?php echo e(auth()->user()->name); ?> 👋</h2>
            <p>Selamat datang di portal siswa SMA Cendikia Nusantara.</p>
        </div>
        <span class="role-badge">Siswa</span>
    </div>

    <div class="section-head">
        <h3>📰 Berita &amp; Pengumuman Terbaru</h3>
        <a href="<?php echo e(route('berita.index')); ?>">Lihat semua →</a>
    </div>

    <div class="info-grid">
        <?php $__empty_1 = true; $__currentLoopData = $beritaTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $berita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('berita.show', $berita->getKey())); ?>" class="info-card">
                <?php if($berita->gambar_url): ?>
                    <img src="<?php echo e($berita->gambar_url); ?>" alt="<?php echo e($berita->judul); ?>">
                <?php else: ?>
                    <div class="noimg">📰</div>
                <?php endif; ?>
                <div class="info-body">
                    <h4><?php echo e($berita->judul); ?></h4>
                    <div class="info-meta">
                        🗓️ <?php echo e(($berita->tanggal ?? $berita->created_at)->translatedFormat('d F Y')); ?>

                        <?php if($berita->penulis): ?> · <?php echo e($berita->penulis); ?> <?php endif; ?>
                    </div>
                    <p><?php echo e(\Illuminate\Support\Str::limit(trim(str_replace(['**', '*', '#'], '', strip_tags($berita->isi ?? ''))), 90)); ?></p>
                    <span class="info-more">Baca selengkapnya →</span>
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="empty-box">Belum ada berita atau pengumuman.</div>
        <?php endif; ?>
    </div>

    <div class="section-head">
        <h3>⚽ Informasi Ekstrakurikuler</h3>
        <a href="<?php echo e(route('ekstrakurikuler.index')); ?>">Lihat semua →</a>
    </div>

    <div class="info-grid">
        <?php $__empty_1 = true; $__currentLoopData = $ekstrakurikuler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ekskul): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('ekstrakurikuler.show', $ekskul->getKey())); ?>" class="info-card">
                <?php if($ekskul->gambar): ?>
                    <img src="<?php echo e(asset('storage/' . $ekskul->gambar)); ?>" alt="<?php echo e($ekskul->nama); ?>">
                <?php else: ?>
                    <div class="noimg">⚽</div>
                <?php endif; ?>
                <div class="info-body">
                    <h4><?php echo e($ekskul->nama); ?></h4>
                    <?php if($ekskul->jadwal): ?>
                        <span class="badge-jadwal">🕒 <?php echo e($ekskul->jadwal); ?></span>
                    <?php endif; ?>
                    <p><?php echo e(\Illuminate\Support\Str::limit(strip_tags($ekskul->deskripsi ?? ''), 90)); ?></p>
                    <span class="info-more">Lihat detail →</span>
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="empty-box">Belum ada data ekstrakurikuler.</div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views\siswa\dashboard.blade.php ENDPATH**/ ?>