<?php $__env->startSection('title', 'Berita & Pengumuman'); ?>

<?php $__env->startPush('styles'); ?>
<?php echo $__env->make('partials.ui-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<style>
    .page-header {
        display: flex; justify-content: space-between; align-items: flex-start;
        gap: 16px; flex-wrap: wrap;
    }
    .berita-list { display: flex; flex-direction: column; gap: 16px; margin-top: 16px; }
    .berita-card {
        display: flex; gap: 18px; background: #fff; border: 1px solid #e5e7eb;
        border-radius: 12px; padding: 14px; align-items: stretch;
    }
    .berita-thumb {
        flex: 0 0 200px; width: 200px; height: 140px; border-radius: 10px;
        object-fit: cover; background: #e9e6df; display: block;
    }
    .berita-noimg {
        flex: 0 0 200px; width: 200px; height: 140px; border-radius: 10px;
        background: #e9e6df; display: flex; align-items: center; justify-content: center; font-size: 32px;
    }
    .berita-body { flex: 1; min-width: 0; display: flex; flex-direction: column; }
    .berita-body h3 { margin: 0 0 6px; font-size: 18px; color: #0f1f4b; }
    .berita-meta { font-size: 12px; color: #6b7280; margin-bottom: 8px; }
    .berita-body p { margin: 0 0 10px; font-size: 14px; line-height: 1.7; color: #4b5563; }
    .berita-link { margin-top: auto; font-size: 13px; font-weight: 600; color: #d99a22; text-decoration: none; }
    .berita-link:hover { text-decoration: underline; }
    .berita-body .aksi { margin-top: 12px; max-width: 220px; }
    @media (max-width: 640px) {
        .berita-card { flex-direction: column; }
        .berita-thumb, .berita-noimg { width: 100%; flex: none; height: 180px; }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $bisaKelola = auth()->check() && in_array(auth()->user()->role, ['admin', 'operator']);
    $daftar = $beritas ?? $berita ?? collect();
?>

<div class="container">
    <div class="page-header">
        <div>
            <h1 class="page-title">Berita &amp; Pengumuman</h1>
            <p class="page-subtitle">Informasi terbaru dari sekolah.</p>
        </div>
        <?php if($bisaKelola): ?>
            <a href="<?php echo e(route('berita.create')); ?>" class="btn btn-tambah">Tambah Berita</a>
        <?php endif; ?>
    </div>
    <hr class="divider">

    <?php if(session('success')): ?>
        <div class="alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="berita-list">
        <?php $__empty_1 = true; $__currentLoopData = $daftar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php $tgl = $item->tanggal ?? $item->created_at; ?>
            <div class="berita-card">
                <?php if($item->gambar_url): ?>
                    <img src="<?php echo e($item->gambar_url); ?>" alt="<?php echo e($item->judul); ?>" class="berita-thumb">
                <?php else: ?>
                    <div class="berita-noimg">📰</div>
                <?php endif; ?>

                <div class="berita-body">
                    <h3><?php echo e($item->judul); ?></h3>
                    <div class="berita-meta">
                        <?php if($tgl): ?> 🗓️ <?php echo e($tgl->translatedFormat('d F Y')); ?> <?php endif; ?>
                        <?php if($item->penulis): ?> · ✍️ <?php echo e($item->penulis); ?> <?php endif; ?>
                    </div>
                    <p><?php echo e(\Illuminate\Support\Str::limit(trim(str_replace(['**', '*', '#'], '', strip_tags($item->isi ?? ''))), 160)); ?></p>

                    <a href="<?php echo e(route('berita.show', $item->getKey())); ?>" class="berita-link">Baca selengkapnya →</a>

                    <?php if($bisaKelola): ?>
                        <div class="aksi">
                            <a href="<?php echo e(route('berita.edit', $item->getKey())); ?>" class="btn btn-edit btn-sm">Edit</a>
                            <form action="<?php echo e(route('berita.destroy', $item->getKey())); ?>" method="POST"
                                  onsubmit="return confirm('Hapus berita ini?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-hapus btn-sm">Hapus</button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="empty">Belum ada berita atau pengumuman.</div>
        <?php endif; ?>
    </div>

    <?php if(is_object($daftar) && method_exists($daftar, 'links')): ?>
        <div style="margin-top:20px;"><?php echo e($daftar->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views\berita.blade.php ENDPATH**/ ?>