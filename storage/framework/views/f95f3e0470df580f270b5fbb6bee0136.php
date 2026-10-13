<?php $__env->startSection('title', 'Edit Nilai Ujikom'); ?>

<?php $__env->startPush('styles'); ?>
<?php echo $__env->make('partials.ui-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('partials.form-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<style>
    .form-group input[type="number"] {
        width: 100%; padding: 10px 12px; border: 1px solid #d1d5db;
        border-radius: 8px; font: inherit; font-size: 14px; background: #fff;
        box-sizing: border-box; transition: border-color .2s, box-shadow .2s;
    }
    .form-row.tiga { grid-template-columns: repeat(3, 1fr); }
    @media (max-width: 700px) { .form-row.tiga { grid-template-columns: 1fr; } }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="page-title">Edit Nilai Ujikom</h1>
    <p class="page-subtitle">Perbarui data nilai ujikom siswa.</p>
    <hr class="divider">

    <form action="<?php echo e(route('nilai-ujikom.update', $nilai->getKey())); ?>" method="POST" class="form-card">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="form-group">
            <label for="nama">Nama Siswa <span class="req">*</span></label>
            <input type="text" id="nama" name="nama" value="<?php echo e(old('nama', $nilai->nama)); ?>" required>
            <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label for="kelas">Kelas <span class="req">*</span></label>
            <input type="text" id="kelas" name="kelas" value="<?php echo e(old('kelas', $nilai->kelas)); ?>" required>
            <?php $__errorArgs = ['kelas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-row tiga">
            <div class="form-group">
                <label for="nilai_penguji1">Nilai Penguji 1 <span class="req">*</span> <span class="hint">(0 - 100)</span></label>
                <input type="number" id="nilai_penguji1" name="nilai_penguji1"
                       value="<?php echo e(old('nilai_penguji1', $nilai->nilai_penguji1)); ?>"
                       min="0" max="100" required>
                <?php $__errorArgs = ['nilai_penguji1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <label for="nilai_penguji2">Nilai Penguji 2 <span class="req">*</span> <span class="hint">(0 - 100)</span></label>
                <input type="number" id="nilai_penguji2" name="nilai_penguji2"
                       value="<?php echo e(old('nilai_penguji2', $nilai->nilai_penguji2)); ?>"
                       min="0" max="100" required>
                <?php $__errorArgs = ['nilai_penguji2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <label for="nilai_penguji3">Nilai Penguji 3 <span class="req">*</span> <span class="hint">(0 - 100)</span></label>
                <input type="number" id="nilai_penguji3" name="nilai_penguji3"
                       value="<?php echo e(old('nilai_penguji3', $nilai->nilai_penguji3)); ?>"
                       min="0" max="100" required>
                <?php $__errorArgs = ['nilai_penguji3'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-simpan">Simpan Perubahan</button>
            <a href="<?php echo e(route('nilai-ujikom.index')); ?>" class="btn btn-outline">Batal</a>
        </div>
    </form>

    <p class="muted" style="margin-top: 12px;">Nilai akhir dihitung otomatis dari <b>jumlah nilai Penguji 1, Penguji 2 dan Penguji 3 dibagi 3 (dibulatkan)</b>.</p>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views\nilai-ujikom\edit.blade.php ENDPATH**/ ?>