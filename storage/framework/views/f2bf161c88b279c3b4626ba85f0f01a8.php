<?php $__env->startSection('title', 'Ekstrakurikuler'); ?>

<?php $__env->startPush('styles'); ?>
<?php echo $__env->make('partials.ui-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<style>
    .page-header {
        display: flex; justify-content: space-between; align-items: flex-start;
        gap: 16px; flex-wrap: wrap;
    }
    .ekskul-grid {
        display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 16px; margin-top: 16px;
    }
    .ekskul-card {
        background: #fff; border: 1px solid #e5e7eb; border-radius: 12px;
        overflow: hidden; display: flex; flex-direction: column;
    }
    .ekskul-card img, .ekskul-noimg {
        width: 100%; height: 160px; object-fit: cover; display: block; background: #e9e6df;
    }
    .ekskul-noimg { display: flex; align-items: center; justify-content: center; font-size: 36px; }
    .ekskul-body { padding: 14px 16px 16px; display: flex; flex-direction: column; flex: 1; }
    .ekskul-body h3 { margin: 0 0 8px; font-size: 16px; color: #0f1f4b; }
    .badge-jadwal {
        display: inline-block; background: #fdf3dc; color: #8a5a00; padding: 3px 10px;
        border-radius: 999px; font-size: 11px; font-weight: 600; margin-bottom: 8px; align-self: flex-start;
    }
    .ekskul-body p { margin: 0 0 10px; font-size: 13px; line-height: 1.6; color: #4b5563; }
    .ekskul-link { margin-top: auto; font-size: 12px; font-weight: 600; color: #d99a22; text-decoration: none; }
    .ekskul-link:hover { text-decoration: underline; }
    .ekskul-body .aksi { margin-top: 12px; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $bisaKelola = auth()->check() && in_array(auth()->user()->role, ['admin', 'operator']);
    $daftar = $ekstrakurikuler ?? $ekstrakurikulers ?? $data ?? collect();
?>

<div class="container">
    <div class="page-header">
        <div>
            <h1 class="page-title">Ekstrakurikuler</h1>
            <p class="page-subtitle">Kegiatan pengembangan bakat dan minat siswa.</p>
        </div>
        <?php if($bisaKelola): ?>
            <a href="<?php echo e(route('ekstrakurikuler.create')); ?>" class="btn btn-tambah">Tambah Ekstrakurikuler</a>
        <?php endif; ?>
    </div>
    <hr class="divider">

    <?php if(session('success')): ?>
        <div class="alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="ekskul-grid">
        <?php $__empty_1 = true; $__currentLoopData = $daftar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="ekskul-card">
                <?php if($item->gambar): ?>
                    <img src="<?php echo e(asset('storage/' . $item->gambar)); ?>" alt="<?php echo e($item->nama); ?>">
                <?php else: ?>
                    <div class="ekskul-noimg">⚽</div>
                <?php endif; ?>

                <div class="ekskul-body">
                    <h3><?php echo e($item->nama); ?></h3>
                    <?php if($item->jadwal): ?>
                        <span class="badge-jadwal">🕒 <?php echo e($item->jadwal); ?></span>
                    <?php endif; ?>
                    <p><?php echo e(\Illuminate\Support\Str::limit(strip_tags($item->deskripsi ?? ''), 90)); ?></p>

                    <a href="<?php echo e(route('ekstrakurikuler.show', $item->getKey())); ?>" class="ekskul-link">Lihat detail →</a>

                    <?php if($bisaKelola): ?>
                        <div class="aksi">
                            <a href="<?php echo e(route('ekstrakurikuler.edit', $item->getKey())); ?>" class="btn btn-edit btn-sm">Edit</a>
                            <form action="<?php echo e(route('ekstrakurikuler.destroy', $item->getKey())); ?>" method="POST"
                                  onsubmit="return confirm('Hapus ekstrakurikuler ini?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-hapus btn-sm">Hapus</button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="empty" style="grid-column: 1 / -1;">Belum ada data ekstrakurikuler.</div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views\ekstrakurikuler\index.blade.php ENDPATH**/ ?>