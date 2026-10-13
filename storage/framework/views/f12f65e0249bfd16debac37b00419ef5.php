<?php $__env->startSection('title', 'Edit User'); ?>

<?php $__env->startSection('content'); ?>
<main class="content">
    <div class="container">

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
            <div>
                <h1 class="page-title">Edit User</h1>
                <p class="page-subtitle">Perbarui data pengguna.</p>
            </div>
            <a href="<?php echo e(route('admin.users.index')); ?>" class="btn-action" style="background:#6c757d;">
                ← Kembali
            </a>
        </div>

        <hr class="divider">

        <?php if($errors->any()): ?>
            <div style="background:#f8d7da; color:#721c24; padding:12px 16px; border-radius:5px; margin-bottom:16px;">
                <ul style="margin:0; padding-left:20px;">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($err); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div style="background:#f8d7da; color:#721c24; padding:12px 16px; border-radius:5px; margin-bottom:16px;">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <?php
            $isOperator    = Auth::user()->role === 'operator';
            $targetIsAdmin = $user->role === 'admin';
            $canEditStatus = ! ($isOperator && $targetIsAdmin);
            $canEditRole   = ! ($isOperator && $targetIsAdmin);
        ?>

        <div class="card">
            <form action="<?php echo e(route('admin.users.update', $user->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div style="margin-bottom:16px;">
                    <label style="display:block; font-weight:600; margin-bottom:6px;">
                        Nama Lengkap <span style="color:red;">*</span>
                    </label>
                    <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" required
                           style="width:100%; padding:8px 12px; border:1px solid #ccc; border-radius:4px; font-size:14px;">
                </div>

                <div style="margin-bottom:16px;">
                    <label style="display:block; font-weight:600; margin-bottom:6px;">
                        Username <span style="color:red;">*</span>
                    </label>
                    <input type="text" name="username" value="<?php echo e(old('username', $user->username)); ?>" required
                           style="width:100%; padding:8px 12px; border:1px solid #ccc; border-radius:4px; font-size:14px;">
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px;">
                    <div>
                        <label style="display:block; font-weight:600; margin-bottom:6px;">
                            Password Baru <span style="color:#888; font-weight:400;">(kosongkan jika tidak diganti)</span>
                        </label>
                        <input type="password" name="password"
                               style="width:100%; padding:8px 12px; border:1px solid #ccc; border-radius:4px; font-size:14px;">
                    </div>
                    <div>
                        <label style="display:block; font-weight:600; margin-bottom:6px;">
                            Konfirmasi Password
                        </label>
                        <input type="password" name="password_confirmation"
                               style="width:100%; padding:8px 12px; border:1px solid #ccc; border-radius:4px; font-size:14px;">
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <label style="display:block; font-weight:600; margin-bottom:6px;">
                        Role <span style="color:red;">*</span>
                    </label>

                    <?php if($canEditRole): ?>
                        <select name="role" required
                                style="width:100%; padding:8px 12px; border:1px solid #ccc; border-radius:4px; font-size:14px;">
                            <option value="admin"    <?php echo e(old('role', $user->role) === 'admin'    ? 'selected' : ''); ?>>Admin</option>
                            <option value="operator" <?php echo e(old('role', $user->role) === 'operator' ? 'selected' : ''); ?>>Operator</option>
                            <option value="user"     <?php echo e(old('role', $user->role) === 'user'     ? 'selected' : ''); ?>>User</option>
                        </select>
                    <?php else: ?>
                        <input type="text" value="<?php echo e($user->role); ?>" disabled
                               style="width:100%; padding:8px 12px; border:1px solid #ddd; border-radius:4px; font-size:14px; background:#f5f5f5; color:#666;">
                        <input type="hidden" name="role" value="<?php echo e($user->role); ?>">
                        <p style="font-size:12px; color:#999; margin-top:4px;">
                            Anda tidak bisa mengubah role akun admin.
                        </p>
                    <?php endif; ?>
                </div>

                <div style="margin-bottom:20px; padding:16px; background:#f9f9f9; border-radius:6px;">
                    <label style="display:block; font-weight:600; margin-bottom:10px;">
                        Status Akun
                    </label>

                    <?php
                        $currentStatus = old('is_active', $user->is_active ? '1' : '0');
                    ?>

                    <?php if($canEditStatus): ?>
                        <div style="display:flex; gap:20px; align-items:center;">
                            <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                                <input type="radio"
                                       name="is_active"
                                       value="1"
                                       <?php echo e($currentStatus == '1' ? 'checked' : ''); ?>>
                                <span style="color:#28a745; font-weight:600;">● Aktif</span>
                            </label>

                            <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                                <input type="radio"
                                       name="is_active"
                                       value="0"
                                       <?php echo e($currentStatus == '0' ? 'checked' : ''); ?>>
                                <span style="color:#dc3545; font-weight:600;">● Nonaktif</span>
                            </label>
                        </div>

                        <p style="font-size:12px; color:#888; margin-top:8px;">
                            User nonaktif tidak bisa login ke sistem.
                        </p>
                    <?php else: ?>
                        <div style="display:flex; align-items:center; gap:8px;">
                            <?php if($user->is_active): ?>
                                <span style="color:#28a745; font-weight:600;">● Aktif</span>
                            <?php else: ?>
                                <span style="color:#dc3545; font-weight:600;">● Nonaktif</span>
                            <?php endif; ?>
                            <span style="font-size:12px; color:#999;">(tidak bisa diubah)</span>
                        </div>

                        <input type="hidden" name="is_active" value="<?php echo e($user->is_active ? '1' : '0'); ?>">

                        <p style="font-size:12px; color:#999; margin-top:8px;">
                            Anda tidak bisa mengubah status akun admin.
                        </p>
                    <?php endif; ?>
                </div>

                <div class="action-buttons" style="margin-top:20px; padding-top:16px; border-top:1px solid #eee;">
                    <button type="submit" class="btn-action">Update</button>
                    <a href="<?php echo e(route('admin.users.index')); ?>" class="btn-action" style="background:#6c757d;">Batal</a>
                </div>

            </form>
        </div>

    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views\admin\users\edit.blade.php ENDPATH**/ ?>