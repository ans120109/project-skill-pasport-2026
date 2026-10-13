<?php $__env->startSection('title', 'Profil Sekolah'); ?>

<?php $__env->startSection('content'); ?>
<main class="content">
    <div class="container">

        <h1 class="page-title">Profil Sekolah</h1>
        <p class="page-subtitle">Informasi lengkap tentang sekolah kami.</p>
        <hr class="divider">

        <?php if(session('success')): ?>
            <div class="card" style="background:#dcfce7; color:#166534; margin-bottom:16px;">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php echo $__env->make('partials.profil-sekolah', ['profil' => $profil], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views\profile-sekolah\index.blade.php ENDPATH**/ ?>