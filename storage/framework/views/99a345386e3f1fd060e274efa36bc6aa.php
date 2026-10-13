<?php $__env->startSection('title', 'Detail User'); ?>

<?php $__env->startSection('content'); ?>

<div class="user-edit-page">

    <div class="user-page-header">

        <h1>
            Detail Data User
        </h1>

        <p>
            Informasi lengkap akun pengguna.
        </p>

    </div>


    <div class="user-edit-card">

        <div class="user-form-group">

            <label>
                Nama Lengkap
            </label>

            <div class="user-form-control">
                <?php echo e($user->name); ?>

            </div>

        </div>


        <div class="user-form-group">

            <label>
                Username
            </label>

            <div class="user-form-control">
                <?php echo e($user->username); ?>

            </div>

        </div>


        <div class="user-form-group">

            <label>
                Role
            </label>

            <div class="user-form-control">
                <?php echo e(ucfirst($user->role)); ?>

            </div>

        </div>


        <div class="user-form-group">

            <label>
                Status Akun
            </label>

            <div class="user-form-control">
                <?php echo e($user->isInactive() ? 'Nonaktif' : 'Aktif'); ?>

            </div>

        </div>


        <div class="user-form-group">

            <label>
                Terakhir Aktif
            </label>

            <div class="user-form-control">
                <?php if($user->last_active_at): ?>
                    <?php echo e($user->last_active_at->translatedFormat('d F Y, H:i')); ?>

                    (<?php echo e($user->last_active_at->diffForHumans()); ?>)
                <?php else: ?>
                    Belum tercatat
                <?php endif; ?>
            </div>

        </div>


        <div class="user-form-group">

            <label>
                Terdaftar Sejak
            </label>

            <div class="user-form-control">
                <?php echo e($user->created_at?->translatedFormat('d F Y, H:i') ?? '-'); ?>

            </div>

        </div>


        <div class="user-form-actions">

            <a
                href="<?php echo e(route('admin.users.edit', $user)); ?>"
                class="user-btn user-btn-primary"
            >
                Edit
            </a>


            <a
                href="<?php echo e(route('admin.users.index')); ?>"
                class="user-btn user-btn-secondary"
            >
                Kembali
            </a>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views\admin\users\show.blade.php ENDPATH**/ ?>