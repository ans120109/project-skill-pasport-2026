

<?php $__env->startSection('title', $galeri->judul); ?>

<?php $__env->startPush('styles'); ?>
<?php echo $__env->make('partials.ui-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<style>
    .detail-top { margin: 12px 0 4px; }
    .detail-card {
        display: flex; gap: 24px; align-items: flex-start;
        background: #fff; border: 1px solid #e5e7eb; border-radius: 12px;
        padding: 20px; margin-top: 16px;
    }
    .detail-foto { flex: 0 0 300px; width: 300px; max-width: 100%; }
    .detail-foto img {
        width: 100%; aspect-ratio: 3 / 4; object-fit: cover; object-position: top center;
        border-radius: 10px; display: block; background: #e9e6df;
    }
    .detail-info { flex: 1; min-width: 0; }
    .detail-info h2 {
        margin: 0 0 10px; font-size: 18px; color: #0f1f4b;
        border-left: 4px solid #d99a22; padding-left: 10px;
    }
    .detail-info p { margin: 0; line-height: 1.8; font-size: 14px; white-space: pre-line; color: #374151; }
    .detail-actions {
        display: flex; gap: 8px; margin-top: 20px; padding-top: 16px;
        border-top: 1px solid #eee; max-width: 320px;
    }
    .detail-actions form { margin: 0; flex: 1; display: flex; }
    .detail-actions .btn { flex: 1; width: 100%; }
    @media (max-width: 700px) {
        .detail-card { flex-direction: column; }
        .detail-foto { flex: none; width: 100%; max-width: 300px; }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $bisaKelola = auth()->check() && in_array(auth()->user()->role, ['admin', 'operator']);
?>

<div class="container">
    <h1 class="page-title"><?php echo e($galeri->judul); ?></h1>
    <p class="page-subtitle">Detail foto galeri sekolah.</p>

    <div class="detail-top">
        <a href="<?php echo e(route('galeri.index')); ?>" class="btn-back">Kembali</a>
    </div>
    <hr class="divider">

    <div class="detail-card">
        <div class="detail-foto">
            <?php if($galeri->foto): ?>
                <img src="<?php echo e(asset('storage/' . $galeri->foto)); ?>" alt="<?php echo e($galeri->judul); ?>">
            <?php else: ?>
                <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='300' height='400'><rect width='100%' height='100%' fill='%23e9e6df'/></svg>" alt="Tanpa foto">
            <?php endif; ?>
        </div>

        <div class="detail-info">
            <h2>Deskripsi</h2>
            <p><?php echo e($galeri->deskripsi ?: 'Belum ada deskripsi.'); ?></p>

            <?php if($bisaKelola): ?>
                <div class="detail-actions">
                    <a href="<?php echo e(route('galeri.edit', $galeri->getKey())); ?>" class="btn btn-edit">Edit</a>
                    <form action="<?php echo e(route('galeri.destroy', $galeri->getKey())); ?>" method="POST"
                          onsubmit="return confirm('Hapus foto ini?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-hapus">Hapus</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views\galeri\show.blade.php ENDPATH**/ ?>