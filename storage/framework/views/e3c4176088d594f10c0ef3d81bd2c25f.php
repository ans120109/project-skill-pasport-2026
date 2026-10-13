<?php $__env->startSection('title', 'Profil'); ?>

<?php $__env->startSection('content'); ?>
<main class="content">
    <div class="container">

        <h1 class="page-title">Profil</h1>
        <p class="page-subtitle">Informasi profil pengguna dan sekolah.</p>
        <hr class="divider">

        <div class="card">
            <h2>👤 Profil</h2>

            <?php if(auth()->guard()->check()): ?>
                <div style="margin-top:12px; line-height:1.9;">
                    <p class="muted" style="margin:0;">
                        <strong>Nama:</strong> <?php echo e(Auth::user()->name); ?>

                    </p>
                    <p class="muted" style="margin:0;">
                        <strong>Username:</strong> <?php echo e(Auth::user()->username ?? '-'); ?>

                    </p>
                    <p class="muted" style="margin:0;">
                        <strong>Role:</strong>
                        <span style="background:#d99a22; color:white; padding:2px 10px; border-radius:12px; font-size:12px; font-weight:600;">
                            <?php echo e(Auth::user()->role ?? 'user'); ?>

                        </span>
                    </p>
                    <p class="muted" style="margin:0;">
                        <strong>Status:</strong>
                        <?php if(Auth::user()->is_active): ?>
                            <span style="color:#28a745; font-weight:600;">● Aktif</span>
                        <?php else: ?>
                            <span style="color:#dc3545; font-weight:600;">● Nonaktif</span>
                        <?php endif; ?>
                    </p>
                </div>

                <div class="action-buttons" style="margin-top:20px; padding-top:16px; border-top:1px solid #eee;">
                    <form action="<?php echo e(route('logout')); ?>" method="POST" style="margin:0;">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn-action btn-danger">🚪 Logout</button>
                    </form>
                </div>
            <?php else: ?>
                <p class="muted">
                    Anda belum login. Silakan
                    <a href="<?php echo e(route('login')); ?>">masuk</a> terlebih dahulu.
                </p>
            <?php endif; ?>
        </div>

        <h2 style="margin:28px 0 14px;">🏫 Profil Sekolah</h2>
        <?php echo $__env->make('partials.profil-sekolah', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views\profile.blade.php ENDPATH**/ ?>