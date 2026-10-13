<?php $__env->startSection('title', 'Edit Siswa'); ?>

<?php $__env->startPush('styles'); ?>
<?php echo $__env->make('partials.ui-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('partials.form-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<style>
    .edit-head {
        display: flex; justify-content: space-between; align-items: flex-start;
        gap: 16px; flex-wrap: wrap;
    }
    .form-group select {
        width: 100%; padding: 10px 12px; border: 1px solid #d1d5db;
        border-radius: 8px; font: inherit; font-size: 14px; background: #fff;
        box-sizing: border-box; transition: border-color .2s, box-shadow .2s;
    }
    .form-group select:focus {
        outline: none; border-color: #d99a22; box-shadow: 0 0 0 3px rgba(217,154,34,.2);
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="edit-head">
        <div>
            <h1 class="page-title">Edit Siswa</h1>
            <p class="page-subtitle">Perbarui data siswa.</p>
        </div>
        <a href="<?php echo e(route('siswa-guru.create')); ?>?tab=siswa" class="btn-back">Kembali</a>
    </div>
    <hr class="divider">

    <form action="<?php echo e(route('siswa-guru.siswa.update', $siswa->id)); ?>" method="POST" class="form-card">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="form-row">
            <div class="form-group">
                <label for="nis">NIS <span class="req">*</span></label>
                <input type="text" id="nis" name="nis" value="<?php echo e(old('nis', $siswa->nis)); ?>" required>
                <?php $__errorArgs = ['nis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <label for="nama">Nama <span class="req">*</span></label>
                <input type="text" id="nama" name="nama" value="<?php echo e(old('nama', $siswa->nama)); ?>" required>
                <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin <span class="req">*</span></label>
                <select id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="L" <?php if(old('jenis_kelamin', $siswa->jenis_kelamin) === 'L'): echo 'selected'; endif; ?>>Laki-laki</option>
                    <option value="P" <?php if(old('jenis_kelamin', $siswa->jenis_kelamin) === 'P'): echo 'selected'; endif; ?>>Perempuan</option>
                </select>
                <?php $__errorArgs = ['jenis_kelamin'];
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
                <input type="text" id="kelas" name="kelas" value="<?php echo e(old('kelas', $siswa->kelas)); ?>" required>
                <?php $__errorArgs = ['kelas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="sekolah_asal">Sekolah Asal</label>
                <input type="text" id="sekolah_asal" name="sekolah_asal"
                       value="<?php echo e(old('sekolah_asal', $siswa->sekolah_asal)); ?>">
                <?php $__errorArgs = ['sekolah_asal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                       value="<?php echo e(old('tanggal_lahir', optional($siswa->tanggal_lahir)->format('Y-m-d'))); ?>">
                <?php $__errorArgs = ['tanggal_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="no_hp">No. HP</label>
            <input type="text" id="no_hp" name="no_hp" value="<?php echo e(old('no_hp', $siswa->no_hp)); ?>">
            <?php $__errorArgs = ['no_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat"><?php echo e(old('alamat', $siswa->alamat)); ?></textarea>
            <?php $__errorArgs = ['alamat'];
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
            <a href="<?php echo e(route('siswa-guru.create')); ?>?tab=siswa" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views\data-user\edit-siswa.blade.php ENDPATH**/ ?>