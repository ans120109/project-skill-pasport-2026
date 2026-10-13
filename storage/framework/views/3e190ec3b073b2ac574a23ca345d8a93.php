<?php $__env->startSection('content'); ?>
<style>
    .auth-wrap { min-height: 80vh; display: flex; justify-content: center; align-items: flex-start; padding: 24px 12px; }
    .auth-card { width: 100%; max-width: 315px; background: #fff; border-radius: 12px; padding: 22px; box-shadow: 0 4px 20px rgba(0,0,0,.06); }
    .auth-card h1 { font-size: 20px; margin: 0 0 4px; color: #1f2937; }
    .auth-card .sub { font-size: 11px; color: #6b7280; margin-bottom: 16px; }
    .auth-card .alert { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; border-radius: 8px; padding: 10px 12px; font-size: 11px; margin-bottom: 14px; }
    .auth-card .alert ul { margin: 0; padding-left: 16px; }
    .auth-card label { display: block; font-size: 11px; font-weight: 600; margin: 12px 0 6px; color: #111827; }
    .auth-card input, .auth-card select { width: 100%; box-sizing: border-box; padding: 10px 12px; font-size: 12px; border: 1px solid #d6d3c4; border-radius: 8px; background: #fff; outline: none; }
    .auth-card input:focus, .auth-card select:focus { border-color: #f59e0b; box-shadow: 0 0 0 2px rgba(245,158,11,.2); }
    .auth-card .is-invalid { border-color: #dc2626; }
    .auth-card .field-error { color: #dc2626; font-size: 10px; margin-top: 4px; display: block; }
    .auth-card .btn { width: 100%; margin-top: 16px; padding: 11px; background: #f59e0b; border: 0; border-radius: 8px; font-weight: 700; font-size: 12px; cursor: pointer; }
    .auth-card .btn:hover { background: #d97706; }
    .auth-card hr { border: 0; border-top: 1px solid #e5e7eb; margin: 16px 0 12px; }
    .auth-card .links { font-size: 11px; color: #6b7280; }
    .auth-card .links a { color: #b45309; font-weight: 600; text-decoration: none; }
</style>

<div class="auth-wrap">
    <div class="auth-card">
        <h1>Register</h1>
        <div class="sub">Buat akun baru untuk Panel Sekolah</div>

        <?php if($errors->any()): ?>
            <div class="alert">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('register.process')); ?>">
            <?php echo csrf_field(); ?>

            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name" value="<?php echo e(old('name')); ?>"
                   class="<?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required autofocus>
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="field-error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo e(old('username')); ?>"
                   class="<?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
            <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="field-error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <label for="role">Role</label>
            <select id="role" name="role" class="<?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <option value="" disabled <?php echo e(old('role') ? '' : 'selected'); ?>>-- Pilih Role --</option>
                <option value="guru"  <?php echo e(old('role') === 'admin'  ? 'selected' : ''); ?>>Admin</option>
                <option value="guru"  <?php echo e(old('role') === 'guru'  ? 'selected' : ''); ?>>Guru</option>
                <option value="siswa" <?php echo e(old('role') === 'siswa' ? 'selected' : ''); ?>>Siswa</option>
            </select>
            <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="field-error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <label for="password">Kata Sandi</label>
            <input type="password" id="password" name="password" placeholder="Minimal 8 karakter"
                   class="<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="field-error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <label for="password_confirmation">Ulangi Kata Sandi</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                   placeholder="Ketik ulang kata sandi" required>

            <button type="submit" class="btn">Daftar</button>
        </form>

        <hr>
        <div class="links">
            Sudah punya akun? <a href="<?php echo e(route('login')); ?>">Login</a><br><br>
            <a href="<?php echo e(url('/')); ?>">← Kembali ke halaman sekolah</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views\auth\register.blade.php ENDPATH**/ ?>