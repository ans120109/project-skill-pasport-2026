<?php $__env->startSection('title', $berita->judul); ?>

<?php $__env->startPush('styles'); ?>
<?php echo $__env->make('partials.ui-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<style>
    .detail-top { margin: 14px 0 16px; }
    .detail-card {
        background: #fff; border: 1px solid #e5e7eb; border-radius: 12px;
        overflow: hidden; max-width: 820px;
    }
    .detail-card img {
        width: 100%; max-height: 380px; object-fit: cover; display: block; background: #e9e6df;
    }
    .detail-body { padding: 22px 24px 24px; }
    .detail-body h1 { margin: 0 0 10px; font-size: 26px; line-height: 1.3; color: #0f1f4b; }
    .meta { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 18px; }
    .meta span {
        background: #fdf3dc; color: #8a5a00; padding: 5px 12px;
        border-radius: 999px; font-size: 12px; font-weight: 600;
    }
    .isi { line-height: 1.9; font-size: 15px; color: #374151; white-space: pre-line; }
    .detail-actions {
        display: flex; gap: 8px; margin-top: 22px; padding-top: 16px;
        border-top: 1px solid #eee; max-width: 320px;
    }
    .detail-actions form { margin: 0; flex: 1; display: flex; }
    .detail-actions .btn { flex: 1; width: 100%; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $bisaKelola = auth()->check() && in_array(auth()->user()->role, ['admin', 'operator']);
    $tgl = $berita->tanggal ?? $berita->created_at;
?>

<div class="container">
    <div class="detail-top">
        <a href="<?php echo e(route('berita.index')); ?>" class="btn-back">Kembali</a>
    </div>

    <div class="detail-card">
        <?php if($berita->gambar_url): ?>
            <img src="<?php echo e($berita->gambar_url); ?>" alt="<?php echo e($berita->judul); ?>">
        <?php endif; ?>

        <div class="detail-body">
            <h1><?php echo e($berita->judul); ?></h1>

            <div class="meta">
                <?php if($tgl): ?><span>🗓️ <?php echo e($tgl->translatedFormat('d F Y')); ?></span><?php endif; ?>
                <?php if($berita->penulis): ?><span>✍️ <?php echo e($berita->penulis); ?></span><?php endif; ?>
            </div>

            <div class="isi"><?php echo e(trim(str_replace('**', '', $berita->isi))); ?></div>

            <?php if($bisaKelola): ?>
                <div class="detail-actions">
                    <a href="<?php echo e(route('berita.edit', $berita->getKey())); ?>" class="btn btn-edit">Edit</a>
                    <form action="<?php echo e(route('berita.destroy', $berita->getKey())); ?>" method="POST"
                          onsubmit="return confirm('Hapus berita ini?')">
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
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views\berita\show.blade.php ENDPATH**/ ?>