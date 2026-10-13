<?php $__env->startSection('title', 'Edit Ekstrakurikuler'); ?>

<?php $__env->startPush('styles'); ?>
<?php echo $__env->make('partials.ui-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('partials.form-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="page-title">Edit Ekstrakurikuler</h1>
    <p class="page-subtitle">Perbarui data ekstrakurikuler.</p>
    <hr class="divider">

    <form action="<?php echo e(route('ekstrakurikuler.update', $ekstrakurikuler->getKey())); ?>" method="POST"
          enctype="multipart/form-data" class="form-card">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="form-group">
            <label for="nama">Nama Ekstrakurikuler <span class="req">*</span></label>
            <input type="text" id="nama" name="nama" value="<?php echo e(old('nama', $ekstrakurikuler->nama)); ?>" required>
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
            <label for="jadwal">Jadwal</label>
            <input type="text" id="jadwal" name="jadwal" value="<?php echo e(old('jadwal', $ekstrakurikuler->jadwal)); ?>"
                   placeholder="Contoh: Senin dan Jumat, 15.00">
            <?php $__errorArgs = ['jadwal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi"><?php echo e(old('deskripsi', $ekstrakurikuler->deskripsi)); ?></textarea>
            <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label for="gambar">Gambar <span class="hint">(kosongkan jika tidak ingin mengganti, maks. 2 MB)</span></label>
            <?php if($ekstrakurikuler->gambar): ?>
                <img src="<?php echo e(asset('storage/' . $ekstrakurikuler->gambar)); ?>" alt="Gambar saat ini" class="foto-lama">
            <?php endif; ?>
            <input type="file" id="gambar" name="gambar" accept="image/*" data-preview>
            <img id="preview" class="img-preview" alt="Preview gambar baru">
            <?php $__errorArgs = ['gambar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-simpan">Simpan Perubahan</button>
            <a href="<?php echo e(route('ekstrakurikuler.index')); ?>" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views\ekstrakurikuler\edit.blade.php ENDPATH**/ ?>