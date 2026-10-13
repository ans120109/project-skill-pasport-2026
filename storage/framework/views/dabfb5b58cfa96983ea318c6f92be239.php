<?php $__env->startSection('title', 'Edit Profil Sekolah'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $teks = [
        'tentang'   => 'Tentang Sekolah',
        'visi'      => 'Visi',
        'misi'      => 'Misi (satu poin per baris)',
        'tujuan'    => 'Tujuan (satu poin per baris)',
        'sejarah'   => 'Sejarah',
        'sambutan'  => 'Sambutan Kepala Sekolah',
        'fasilitas' => 'Fasilitas (satu per baris)',
        'prestasi'  => 'Prestasi (satu per baris)',
    ];
    $kecil = [
        'nama_sekolah'  => ['Nama Sekolah', 'text'],
        'nama_kepsek'   => ['Nama Kepala Sekolah', 'text'],
        'npsn'          => ['NPSN', 'text'],
        'akreditasi'    => ['Akreditasi', 'text'],
        'tahun_berdiri' => ['Tahun Berdiri', 'text'],
        'telepon'       => ['Telepon', 'text'],
        'email'         => ['Email', 'email'],
        'alamat'        => ['Alamat', 'text'],
        'jumlah_siswa'  => ['Jumlah Siswa', 'number'],
        'jumlah_guru'   => ['Jumlah Guru', 'number'],
        'jumlah_ekskul' => ['Jumlah Ekskul', 'number'],
        'maps_url'      => ['Link Google Maps', 'url'],
    ];
?>

<style>
    .pe-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:20px;margin-bottom:16px}
    .pe-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px}
    @media(max-width:700px){.pe-grid{grid-template-columns:1fr}}
    .pe-card label{display:block;font-weight:600;font-size:14px;margin-bottom:4px}
    .pe-card input[type=text],.pe-card input[type=email],.pe-card input[type=number],.pe-card input[type=url],.pe-card textarea{width:100%;padding:9px 12px;border:1px solid #d1d5db;border-radius:8px;font:inherit;box-sizing:border-box}
    .pe-err{color:#dc2626;font-size:13px;margin-top:3px}
</style>

<main class="content">
    <div class="container">

        <h1 class="page-title">Edit Profil Sekolah</h1>
        <p class="page-subtitle">Hanya admin yang dapat mengubah data ini.</p>
        <hr class="divider">

        <form action="<?php echo e(route('profile-sekolah.update')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="pe-card">
                <div class="pe-grid">
                    <?php $__currentLoopData = $kecil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => [$label, $type]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <label for="<?php echo e($name); ?>"><?php echo e($label); ?></label>
                            <input type="<?php echo e($type); ?>" id="<?php echo e($name); ?>" name="<?php echo e($name); ?>"
                                   value="<?php echo e(old($name, $profil->$name)); ?>">
                            <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="pe-err"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="pe-card">
                <label for="foto">Foto Sekolah</label>
                <?php if($profil->foto_url): ?>
                    <img src="<?php echo e($profil->foto_url); ?>" alt="" style="max-width:220px;border-radius:8px;display:block;margin-bottom:8px">
                <?php endif; ?>
                <input type="file" id="foto" name="foto" accept="image/*">
                <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="pe-err"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <?php $__currentLoopData = $teks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="pe-card">
                    <label for="<?php echo e($name); ?>"><?php echo e($label); ?></label>
                    <textarea id="<?php echo e($name); ?>" name="<?php echo e($name); ?>" rows="5"><?php echo e(old($name, $profil->$name)); ?></textarea>
                    <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="pe-err"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <button type="submit" class="btn-action">💾 Simpan Perubahan</button>
            <a href="<?php echo e(route('profil')); ?>" style="margin-left:12px;color:#6b7280;">Batal</a>
        </form>

    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views\profile-sekolah\edit.blade.php ENDPATH**/ ?>