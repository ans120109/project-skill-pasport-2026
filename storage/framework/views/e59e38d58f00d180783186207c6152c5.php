<?php $__env->startSection('title', 'Nilai Ujikom'); ?>

<?php $__env->startPush('styles'); ?>
<?php echo $__env->make('partials.ui-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<style>
    .page-header {
        display: flex; justify-content: space-between; align-items: flex-start;
        gap: 16px; flex-wrap: wrap;
    }

    .stat-grid {
        display: grid; grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
        gap: 14px; margin: 18px 0 22px;
    }
    .stat-card {
        background: #fff; border-radius: 12px; padding: 16px 18px;
        border-left: 4px solid #0f1f4b; box-shadow: 0 1px 3px rgba(0,0,0,.06);
    }
    .stat-card h3 { font-size: 13px; margin: 0 0 6px; font-weight: 600; }
    .stat-card .angka { font-size: 26px; font-weight: 700; margin: 0; }

    .tabel-wrap {
        background: #fff; border-radius: 12px; overflow-x: auto;
        box-shadow: 0 1px 4px rgba(0,0,0,.08);
    }
    .tabel-nilai { width: 100%; min-width: 780px; border-collapse: collapse; }
    .tabel-nilai th {
        background: #0f1f4b; color: #fff; text-align: left;
        padding: 12px 14px; font-size: 13px; font-weight: 600; white-space: nowrap;
    }
    .tabel-nilai td {
        padding: 11px 14px; font-size: 14px;
        border-bottom: 1px solid #eef0f4; vertical-align: middle;
    }
    .tabel-nilai tbody tr:last-child td { border-bottom: 0; }
    .tabel-nilai tbody tr:hover { background: #f8f9fc; }
    .tabel-nilai .nilai-angka { font-weight: 700; }

    .badge-status {
        display: inline-block; padding: 4px 12px; border-radius: 999px;
        font-size: 12px; font-weight: 700; white-space: nowrap;
    }
    .badge-lulus { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
    .badge-tidak { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

    .tabel-nilai .aksi { min-width: 190px; }
    .ket-nilai { font-size: 13px; color: var(--muted); margin-top: 12px; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $bisaKelola = auth()->check() && in_array(auth()->user()->role, ['admin', 'operator']);
?>

<div class="container">
    <div class="page-header">
        <div>
            <h1 class="page-title">Nilai Ujikom</h1>
            <p class="page-subtitle">Hasil Uji Kompetensi Keahlian siswa. Nilai akhir dihitung dari jumlah nilai Penguji 1, Penguji 2 dan Penguji 3 dibagi 3, 
                jika nilai 75 atau lebih dinyatakan <b>Lulus</b>, di bawah 75 <b>Tidak Lulus</b>.</p>
        </div>

        <?php if($bisaKelola): ?>
            <a href="<?php echo e(route('nilai-ujikom.create')); ?>" class="btn btn-tambah">Tambah Nilai</a>
        <?php endif; ?>
    </div>
    <hr class="divider">

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="stat-grid">
        <div class="stat-card" style="border-left-color: #2a6fb5;">
            <h3 style="color: #2a6fb5;">Total Peserta</h3>
            <p class="angka"><?php echo e($totalPeserta); ?></p>
        </div>
        <div class="stat-card" style="border-left-color: #16a34a;">
            <h3 style="color: #16a34a;">Lulus</h3>
            <p class="angka"><?php echo e($totalLulus); ?></p>
        </div>
        <div class="stat-card" style="border-left-color: #dc2626;">
            <h3 style="color: #dc2626;">Tidak Lulus</h3>
            <p class="angka"><?php echo e($totalTidakLulus); ?></p>
        </div>
    </div>
    
    <div class="tabel-wrap">
        <table class="tabel-nilai">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Penguji 1</th>
                    <th>Penguji 2</th>
                    <th>Penguji 3</th>
                    <th>Nilai Akhir</th>
                    <th>Status</th>
                    <?php if($bisaKelola): ?>
                        <th>Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $nilai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($item->nama); ?></td>
                        <td><?php echo e($item->kelas); ?></td>
                        <td><?php echo e($item->nilai_penguji1); ?></td>
                        <td><?php echo e($item->nilai_penguji2); ?></td>
                        <td><?php echo e($item->nilai_penguji3); ?></td>
                        <td class="nilai-angka"><?php echo e($item->nilai_akhir); ?></td>
                        <td>
                            <?php if($item->lulus): ?>
                                <span class="badge-status badge-lulus">✔ Lulus</span>
                            <?php else: ?>
                                <span class="badge-status badge-tidak">✘ Tidak Lulus</span>
                            <?php endif; ?>
                        </td>
                        <?php if($bisaKelola): ?>
                            <td>
                                <div class="aksi">
                                    <a href="<?php echo e(route('nilai-ujikom.edit', $item->getKey())); ?>" class="btn btn-edit btn-sm">Edit</a>
                                    <form action="<?php echo e(route('nilai-ujikom.destroy', $item->getKey())); ?>" method="POST"
                                          onsubmit="return confirm('Hapus data nilai <?php echo e($item->nama); ?>?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-hapus btn-sm">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="<?php echo e($bisaKelola ? 9 : 8); ?>">
                            <div class="empty">Belum ada data nilai ujikom.</div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <p class="ket-nilai">Keterangan: <b>Nilai Akhir = jumlah nilai Penguji 1, Penguji 2 dan Penguji 3 dibagi 3 (dibulatkan)</b>. Siswa dinyatakan <b>Lulus Ujikom</b> jika nilai akhir <b>75 atau lebih</b>.</p>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views/nilai-ujikom/index.blade.php ENDPATH**/ ?>