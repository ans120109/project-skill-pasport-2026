<?php $__env->startSection('title', 'Siswa & Guru'); ?>

<?php
    $daftarSiswa = $siswas ?? $dataSiswa ?? collect();
    $daftarGuru  = $gurus  ?? $dataGuru  ?? collect();

    $tabAwal = request('tab', (old('nip') !== null || old('jabatan') !== null || old('tipe') !== null) ? 'guru' : 'siswa');
?>

<?php $__env->startPush('styles'); ?>
<style>
    .du-page { padding: 2rem 0 1rem; }
    .du-title { font-size: 1.6rem; font-weight: 600; }
    .du-sub { font-size: .85rem; color: var(--muted); margin-top: .1rem; }

    .du-tabs { display: inline-flex; gap: .3rem; padding: .3rem; margin: 1.2rem 0 1.2rem; background: #e7e4dc; border-radius: 10px; }
    .du-tab {
        border: 0; background: transparent; font: inherit; font-size: .85rem; font-weight: 600;
        color: #4b5563; padding: .5rem 1.1rem; border-radius: 8px; cursor: pointer;
        transition: background .15s, color .15s;
    }
    .du-tab:hover { color: var(--navy); }
    .du-tab.is-active { background: #fff; color: var(--navy); box-shadow: 0 1px 3px rgba(0,0,0,.12); }
    .du-tab:focus-visible { outline: 2px solid var(--orange); outline-offset: 2px; }

    .du-panel[hidden] { display: none; }

    .du-card { background: #fff; border-radius: 12px; padding: 1.5rem 1.6rem; box-shadow: 0 1px 3px rgba(0,0,0,.06); margin-bottom: 1.3rem; }
    .du-card h2 { font-size: 1.1rem; font-weight: 600; margin-bottom: 1.1rem; }
    .du-count { font-weight: 500; color: var(--muted); }

    .du-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 1rem 1.1rem; }
    .span-2 { grid-column: span 2; }
    .span-3 { grid-column: span 3; }
    .span-6 { grid-column: span 6; }

    .du-field label { display: block; font-size: .78rem; font-weight: 600; margin-bottom: .3rem; color: #374151; }
    .du-field .req { color: #dc2626; }
    .du-input {
        width: 100%; height: 40px; padding: 0 .75rem; font: inherit; font-size: .88rem;
        border: 1px solid #cfcac0; border-radius: 8px; background: #fff; color: var(--text);
        transition: border-color .15s, box-shadow .15s;
    }
    textarea.du-input { height: auto; min-height: 84px; padding: .6rem .75rem; resize: vertical; }
    select.du-input { appearance: auto; }
    .du-input::placeholder { color: #9ca3af; }
    .du-input:focus { outline: none; border-color: var(--orange); box-shadow: 0 0 0 3px rgba(245,158,11,.25); }
    .du-input.is-invalid { border-color: #dc2626; }
    .du-err { color: #b91c1c; font-size: .73rem; margin-top: .25rem; }

    .du-actions { margin-top: 1.3rem; display: flex; gap: .6rem; }
    .du-btn {
        display: inline-flex; align-items: center; justify-content: center;
        height: 40px; padding: 0 1.4rem; border: 0; border-radius: 8px; cursor: pointer;
        font: inherit; font-size: .88rem; font-weight: 700;
        background: var(--orange); color: #1c1300; transition: filter .15s;
    }
    .du-btn:hover { filter: brightness(1.07); }
    .du-btn:focus-visible { outline: 2px solid var(--navy); outline-offset: 2px; }

    .du-alert { font-size: .85rem; padding: .7rem .9rem; border-radius: 8px; margin-bottom: 1.1rem; }
    .du-alert-ok  { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }
    .du-alert-err { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

    .du-table-wrap { overflow-x: auto; margin: 0 -.4rem; padding: 0 .4rem; }
    .du-table { width: 100%; border-collapse: collapse; font-size: .85rem; min-width: 640px; }
    .du-table th {
        text-align: left; font-size: .75rem; font-weight: 700; color: #4b5563;
        background: #f5f3ee; padding: .65rem .8rem; white-space: nowrap;
    }
    .du-table th:first-child { border-radius: 8px 0 0 8px; }
    .du-table th:last-child  { border-radius: 0 8px 8px 0; }
    .du-table td { padding: .75rem .8rem; border-bottom: 1px solid #eeebe4; vertical-align: middle; }
    .du-table tbody tr:last-child td { border-bottom: 0; }
    .du-table tbody tr:hover { background: #faf9f6; }
    .du-table .num { width: 44px; color: var(--muted); }
    .du-table .aksi { white-space: nowrap; text-align: right; }
    .du-table th.aksi { text-align: right; }
    .du-empty { text-align: center; color: var(--muted); padding: 1.6rem 1rem !important; }

    .du-chip { display: inline-block; min-width: 24px; text-align: center; padding: .1rem .5rem; border-radius: 999px; font-size: .72rem; font-weight: 700; background: #e0e7ff; color: #3730a3; }
    .du-chip.p { background: #fce7f3; color: #9d174d; }

    .du-btn-sm {
        display: inline-flex; align-items: center; height: 30px; padding: 0 .8rem;
        font: inherit; font-size: .76rem; font-weight: 600; border-radius: 6px; cursor: pointer;
        text-decoration: none; background: #fff; transition: background .15s;
    }
    .du-edit  { border: 1px solid #cfcac0; color: var(--navy); }
    .du-edit:hover { background: #f5f3ee; }
    .du-del   { border: 1px solid #fecaca; color: #b91c1c; }
    .du-del:hover { background: #fef2f2; }
    .du-inline { display: inline; margin-left: .3rem; }

    @media (max-width: 760px) {
        .du-grid { grid-template-columns: 1fr; }
        .span-2, .span-3, .span-6 { grid-column: auto; }
        .du-card { padding: 1.2rem 1.1rem; }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container du-page">

    <h1 class="du-title">Siswa &amp; Guru</h1>
    <p class="du-sub">Manajemen data siswa dan guru.</p>

    <?php if(session('success')): ?>
        <div class="du-alert du-alert-ok" style="margin-top:1rem"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <div class="du-alert du-alert-err" style="margin-top:1rem"><?php echo e($errors->first()); ?></div>
    <?php endif; ?>

    <div class="du-tabs" role="tablist">
        <button type="button" class="du-tab" data-tab="siswa" role="tab">Data Siswa</button>
        <button type="button" class="du-tab" data-tab="guru" role="tab">Data Guru</button>
    </div>

    <div class="du-panel" id="panel-siswa" data-panel="siswa" <?php echo e($tabAwal === 'siswa' ? '' : 'hidden'); ?>>

        <div class="du-card">
            <h2>Tambah Data Siswa</h2>

            <form action="<?php echo e(route('siswa-guru.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="du-grid">

                    <div class="du-field span-3">
                        <label for="nis">NIS <span class="req">*</span></label>
                        <input type="text" id="nis" name="nis" value="<?php echo e(old('nis')); ?>"
                               class="du-input <?php $__errorArgs = ['nis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <?php $__errorArgs = ['nis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="du-err"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="du-field span-3">
                        <label for="nama">Nama Lengkap <span class="req">*</span></label>
                        <input type="text" id="nama" name="nama" value="<?php echo e(old('nama')); ?>"
                               class="du-input <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="du-err"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="du-field span-2">
                        <label for="jenis_kelamin">Jenis Kelamin <span class="req">*</span></label>
                        <select id="jenis_kelamin" name="jenis_kelamin"
                                class="du-input <?php $__errorArgs = ['jenis_kelamin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">-- Pilih --</option>
                            <option value="L" <?php if(old('jenis_kelamin') === 'L'): echo 'selected'; endif; ?>>Laki-laki</option>
                            <option value="P" <?php if(old('jenis_kelamin') === 'P'): echo 'selected'; endif; ?>>Perempuan</option>
                        </select>
                        <?php $__errorArgs = ['jenis_kelamin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="du-err"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="du-field span-2">
                        <label for="kelas">Kelas <span class="req">*</span></label>
                        <input type="text" id="kelas" name="kelas" value="<?php echo e(old('kelas')); ?>" placeholder="XII RPL 1"
                               class="du-input <?php $__errorArgs = ['kelas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <?php $__errorArgs = ['kelas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="du-err"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="du-field span-2">
                        <label for="sekolah_asal">Sekolah Asal</label>
                        <input type="text" id="sekolah_asal" name="sekolah_asal" value="<?php echo e(old('sekolah_asal')); ?>"
                               placeholder="Nama sekolah" class="du-input">
                    </div>

                    <div class="du-field span-3">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo e(old('tanggal_lahir')); ?>"
                               class="du-input">
                    </div>

                    <div class="du-field span-3">
                        <label for="no_hp">No. HP</label>
                        <input type="text" id="no_hp" name="no_hp" value="<?php echo e(old('no_hp')); ?>"
                               placeholder="08xxxxxxxxxx" class="du-input">
                    </div>

                    <div class="du-field span-6">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" class="du-input"><?php echo e(old('alamat')); ?></textarea>
                    </div>
                </div>

                <div class="du-actions">
                    <button type="submit" class="du-btn">Simpan Siswa</button>
                </div>
            </form>
        </div>

        <div class="du-card">
            <h2>Daftar Siswa <span class="du-count">(<?php echo e($daftarSiswa->count()); ?>)</span></h2>

            <div class="du-table-wrap">
                <table class="du-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>JK</th>
                            <th>Kelas</th>
                            <th>Sekolah Asal</th>
                            <th class="aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $daftarSiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="num"><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($s->nis); ?></td>
                                <td><?php echo e($s->nama); ?></td>
                                <td><span class="du-chip <?php echo e($s->jenis_kelamin === 'P' ? 'p' : ''); ?>"><?php echo e($s->jenis_kelamin); ?></span></td>
                                <td><?php echo e($s->kelas); ?></td>
                                <td><?php echo e($s->sekolah_asal ?: '-'); ?></td>
                                <td class="aksi">
                                    <a href="<?php echo e(route('siswa-guru.siswa.edit', $s)); ?>" class="du-btn-sm du-edit">Edit</a>
                                    <form action="<?php echo e(route('siswa-guru.siswa.destroy', $s)); ?>" method="POST" class="du-inline"
                                          onsubmit="return confirm('Hapus data siswa <?php echo e(addslashes($s->nama)); ?>?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="du-btn-sm du-del">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="7" class="du-empty">Belum ada data siswa.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="du-panel" id="panel-guru" data-panel="guru" <?php echo e($tabAwal === 'guru' ? '' : 'hidden'); ?>>

        <div class="du-card">
            <h2>Tambah Data Guru</h2>

            <form action="<?php echo e(route('siswa-guru.guru.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="du-grid">

                    <div class="du-field span-3">
                        <label for="g_nip">NIP</label>
                        <input type="text" id="g_nip" name="nip" value="<?php echo e(old('nip')); ?>"
                               class="du-input <?php $__errorArgs = ['nip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['nip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="du-err"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="du-field span-3">
                        <label for="g_nama">Nama Lengkap <span class="req">*</span></label>
                        <input type="text" id="g_nama" name="nama" value="<?php echo e(old('nama')); ?>"
                               class="du-input <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="du-err"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="du-field span-4">
                        <label for="g_jabatan">Jabatan <span class="req">*</span></label>
                        <input type="text" id="g_jabatan" name="jabatan" value="<?php echo e(old('jabatan')); ?>"
                               placeholder="Contoh: Guru Matematika" 
                               class="du-input <?php $__errorArgs = ['jabatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <?php $__errorArgs = ['jabatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="du-err"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="du-field span-2">
                        <label for="g_tipe">Tipe <span class="req">*</span></label>
                        <select id="g_tipe" name="tipe" class="du-input <?php $__errorArgs = ['tipe'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="guru" <?php if(old('tipe') === 'guru'): echo 'selected'; endif; ?>>Guru</option>
                            <option value="staff" <?php if(old('tipe') === 'staff'): echo 'selected'; endif; ?>>Staff</option>
                        </select>
                        <?php $__errorArgs = ['tipe'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="du-err"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="du-actions">
                    <button type="submit" class="du-btn">Simpan Guru</button>
                </div>
            </form>
        </div>

        <div class="du-card">
            <h2>Daftar Guru <span class="du-count">(<?php echo e($daftarGuru->count()); ?>)</span></h2>

            <div class="du-table-wrap">
                <table class="du-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Tipe</th>
                            <th>Status</th>
                            <th class="aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $daftarGuru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="num"><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($g->nip ?: '-'); ?></td>
                                <td><?php echo e($g->nama); ?></td>
                                <td><?php echo e($g->jabatan ?: '-'); ?></td>
                                <td><span class="du-chip"><?php echo e(ucfirst($g->tipe)); ?></span></td>
                                <td><?php echo e($g->aktif ? 'Aktif' : 'Nonaktif'); ?></td>
                                <td class="aksi">
                                    <a href="<?php echo e(route('siswa-guru.guru.edit', $g)); ?>" class="du-btn-sm du-edit">Edit</a>
                                    <form action="<?php echo e(route('siswa-guru.guru.destroy', $g)); ?>" method="POST" class="du-inline"
                                          onsubmit="return confirm('Hapus data guru <?php echo e(addslashes($g->nama ?? $g->name)); ?>?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="du-btn-sm du-del">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="7" class="du-empty">Belum ada data guru.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    (function () {
        var tabs   = document.querySelectorAll('.du-tab');
        var panels = document.querySelectorAll('.du-panel');

        function show(name) {
            tabs.forEach(function (t) {
                var on = t.dataset.tab === name;
                t.classList.toggle('is-active', on);
                t.setAttribute('aria-selected', on ? 'true' : 'false');
            });
            panels.forEach(function (p) { p.hidden = p.dataset.panel !== name; });
            history.replaceState(null, '', '?tab=' + name);
        }

        tabs.forEach(function (t) {
            t.addEventListener('click', function () { show(t.dataset.tab); });
        });

        show(<?php echo json_encode($tabAwal, 15, 512) ?>);
    })();
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views\data-user\create.blade.php ENDPATH**/ ?>