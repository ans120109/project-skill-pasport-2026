<?php $__env->startSection('title', 'Galeri'); ?>

<?php $__env->startPush('styles'); ?>
<?php echo $__env->make('partials.ui-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<style>
    .page-header {
        display: flex; justify-content: space-between; align-items: flex-start;
        gap: 16px; flex-wrap: wrap;
    }

    .galeri-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 16px;
    }
    .galeri-card {
        background: #fff; border-radius: 10px; overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, .08);
        display: flex; flex-direction: column;
    }
    .galeri-card img {
        width: 100%; aspect-ratio: 3 / 4; object-fit: cover;
        object-position: top center; display: block; background: #e9e6df;
    }
    .galeri-body { padding: 12px 14px 14px; display: flex; flex-direction: column; flex: 1; }
    .galeri-body h3 { margin: 0 0 4px; font-size: 15px; }
    .galeri-body p { margin: 0 0 8px; color: var(--muted); font-size: 12px; }
    .galeri-body .galeri-link {
        margin-top: auto; color: var(--gold); font-size: 12px; font-weight: 600;
    }
    .galeri-body .galeri-link:hover { text-decoration: underline; }
    .galeri-body .aksi { margin-top: 12px; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $bisaKelola = auth()->check() && in_array(auth()->user()->role, ['admin', 'operator']);
?>

<div class="container">
    <div class="page-header">
        <div>
            <h1 class="page-title">Galeri</h1>
            <p class="page-subtitle">Dokumentasi kegiatan sekolah.</p>
        </div>

        <?php if($bisaKelola): ?>
            <a href="<?php echo e(route('galeri.create')); ?>" class="btn btn-tambah">Tambah Foto</a>
        <?php endif; ?>
    </div>
    <hr class="divider">

    <?php if(session('success')): ?>
        <div class="alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="galeri-grid">
        <?php $__empty_1 = true; $__currentLoopData = $galeri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="galeri-card">
                <?php if($item->foto): ?>
                    <img src="<?php echo e(asset('storage/' . $item->foto)); ?>" alt="<?php echo e($item->judul); ?>">
                <?php else: ?>
                    <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='300' height='400'><rect width='100%' height='100%' fill='%23e9e6df'/></svg>" alt="Tanpa foto">
                <?php endif; ?>

                <div class="galeri-body">
                    <h3><?php echo e($item->judul); ?></h3>

                    <?php if($item->deskripsi): ?>
                        <p><?php echo e(\Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 80)); ?></p>
                    <?php endif; ?>

                    <a href="<?php echo e(route('galeri.show', $item->getKey())); ?>" class="galeri-link">Lihat deskripsi lengkap →</a>

                    <?php if($bisaKelola): ?>
                        <div class="aksi">
                            <a href="<?php echo e(route('galeri.edit', $item->getKey())); ?>" class="btn btn-edit btn-sm">Edit</a>
                            <form action="<?php echo e(route('galeri.destroy', $item->getKey())); ?>" method="POST"
                                  onsubmit="return confirm('Hapus foto ini?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-hapus btn-sm">Hapus</button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="empty" style="grid-column: 1 / -1;">Belum ada foto di galeri.</div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views/galeri/index.blade.php ENDPATH**/ ?>