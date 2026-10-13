<?php echo csrf_field(); ?>

<div class="form-group">
    <label for="nama">Nama Ekstrakurikuler</label>
    <input type="text" name="nama" id="nama"
           value="<?php echo e(old('nama', $ekstrakurikuler->nama ?? '')); ?>"
           class="form-control <?php echo e($errors->has('nama') ? 'is-invalid' : ''); ?>" required>
    <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-text"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="form-group">
    <label for="jadwal">Jadwal</label>
    <input type="text" name="jadwal" id="jadwal"
           value="<?php echo e(old('jadwal', $ekstrakurikuler->jadwal ?? '')); ?>"
           class="form-control" placeholder="Contoh: Senin dan Jumat, 14.00-16.00">
    <?php $__errorArgs = ['jadwal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-text"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="form-group">
    <label for="deskripsi">Deskripsi</label>
    <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control"><?php echo e(old('deskripsi', $ekstrakurikuler->deskripsi ?? '')); ?></textarea>
    <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-text"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="form-group">
    <label for="gambar">Gambar</label>

    <?php if(!empty($ekstrakurikuler) && $ekstrakurikuler->gambar_url): ?>
        <img src="<?php echo e($ekstrakurikuler->gambar_url); ?>" alt="Gambar saat ini"
             style="display:block; max-width:220px; border-radius:8px; margin-bottom:8px;">
        <div class="muted">Kosongkan jika tidak ingin mengganti gambar.</div>
    <?php endif; ?>

    <input type="file" name="gambar" id="gambar" accept="image/*" class="form-control">
    <?php $__errorArgs = ['gambar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-text"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="<?php echo e(route('ekstrakurikuler.index')); ?>" class="btn btn-outline">Batal</a>
</div><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views\ekstrakurikuler\_form.blade.php ENDPATH**/ ?>