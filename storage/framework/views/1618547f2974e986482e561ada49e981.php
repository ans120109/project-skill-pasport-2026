<?php echo csrf_field(); ?>
<?php if(isset($galeri)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

<div class="form-group">
    <label for="judul">Judul <span style="color:red;">*</span></label>
    <input type="text" id="judul" name="judul" required maxlength="255"
           class="form-control <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
           value="<?php echo e(old('judul', $galeri->judul ?? '')); ?>">
    <?php $__errorArgs = ['judul'];
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
    <textarea id="deskripsi" name="deskripsi" rows="4"
              class="form-control <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('deskripsi', $galeri->deskripsi ?? '')); ?></textarea>
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
    <label for="foto">
        Foto
        <?php if(isset($galeri)): ?>
            <span class="muted">(kosongkan jika tidak diganti, maks. 2 MB)</span>
        <?php else: ?>
            <span style="color:red;">*</span> <span class="muted">(maks. 2 MB)</span>
        <?php endif; ?>
    </label>
    <input type="file" id="foto" name="foto" accept="image/*"
           class="form-control <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
           <?php if(empty($galeri)): ?> required <?php endif; ?>>
    <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="error-text"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <img id="preview" class="preview" alt="Preview"
         <?php if(isset($galeri)): ?> src="<?php echo e($galeri->foto_url); ?>" style="display:block;" <?php endif; ?>>
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-gold">Simpan</button>
    <a href="<?php echo e(route('galeri.index')); ?>" class="btn btn-outline">Batal</a>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    document.getElementById('foto').addEventListener('change', function (e) {
        const img = document.getElementById('preview');
        const file = e.target.files[0];
        if (file) {
            img.src = URL.createObjectURL(file);
            img.style.display = 'block';
        }
    });
</script>
<?php $__env->stopPush(); ?><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views\galeri\_form.blade.php ENDPATH**/ ?>