<?php $__env->startSection('title', $ekstrakurikuler->nama); ?>

<?php $__env->startPush('styles'); ?>
<?php echo $__env->make('partials.ui-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<style>
    .detail-top { margin: 14px 0 16px; }
    .detail-card {
        background: #fff; border: 1px solid #e5e7eb; border-radius: 12px;
        overflow: hidden; max-width: 760px;
    }
    .detail-card img {
        width: 100%; max-height: 380px; object-fit: cover; display: block; background: #e9e6df;
    }
    .detail-body { padding: 20px 22px 22px; }
    .detail-body h1 { margin: 0 0 10px; font-size: 24px; color: #0f1f4b; }
    .badge-jadwal {
        display: inline-flex; align-items: center; gap: 6px;
        background: #fdf3dc; color: #8a5a00; padding: 5px 12px;
        border-radius: 999px; font-size: 12px; font-weight: 600; margin-bottom: 14px;
    }
    .detail-body p { margin: 0; line-height: 1.8; font-size: 14px; color: #374151; white-space: pre-line; }
    .detail-actions {
        display: flex; gap: 8px; margin-top: 20px; padding-top: 16px;
        border-top: 1px solid #eee; max-width: 320px;
    }
    .detail-actions form { margin: 0; flex: 1; display: flex; }
    .detail-actions .btn { flex: 1; width: 100%; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $bisaKelola = auth()->check() && in_array(auth()->user()->role, ['admin', 'operator']);
?>

<div class="container">
    <div class="detail-top">
        <a href="<?php echo e(route('ekstrakurikuler.index')); ?>" class="btn-back">Kembali</a>
    </div>

    <div class="detail-card">
        <?php if($ekstrakurikuler->gambar): ?>
            <img src="<?php echo e(asset('storage/' . $ekstrakurikuler->gambar)); ?>" alt="<?php echo e($ekstrakurikuler->nama); ?>">
        <?php endif; ?>

        <div class="detail-body">
            <h1><?php echo e($ekstrakurikuler->nama); ?></h1>

            <?php if($ekstrakurikuler->jadwal): ?>
                <div class="badge-jadwal">🕒 <?php echo e($ekstrakurikuler->jadwal); ?></div>
            <?php endif; ?>

            <p><?php echo e($ekstrakurikuler->deskripsi ?: 'Belum ada deskripsi.'); ?></p>

            <?php if($bisaKelola): ?>
                <div class="detail-actions">
                    <a href="<?php echo e(route('ekstrakurikuler.edit', $ekstrakurikuler->getKey())); ?>" class="btn btn-edit">Edit</a>
                    <form action="<?php echo e(route('ekstrakurikuler.destroy', $ekstrakurikuler->getKey())); ?>" method="POST"
                          onsubmit="return confirm('Hapus ekstrakurikuler ini?')">
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
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views\ekstrakurikuler\show.blade.php ENDPATH**/ ?>