<?php
    $nama    = $orang->nama ?? $orang->name ?? '-';
    $jabatan = $orang->jabatan ?? $orang->mapel ?? $orang->mata_pelajaran ?? ucfirst($orang->role ?? '');
    $foto    = $orang->foto ?? null;

    $kata    = preg_split('/\s+/', trim(preg_replace('/^(Drs?\.|Dra\.|Hj?\.)\s*/i', '', $nama)));
    $inisial = mb_strtoupper(mb_substr($kata[0] ?? '', 0, 1) . mb_substr($kata[1] ?? '', 0, 1));
?>

<div class="card orang">
    <?php if($foto): ?>
        <img src="<?php echo e(asset('storage/' . $foto)); ?>" alt="<?php echo e($nama); ?>" class="orang-foto">
    <?php else: ?>
        <div class="orang-foto orang-inisial" aria-hidden="true"><?php echo e($inisial); ?></div>
    <?php endif; ?>
    <h4><?php echo e($nama); ?></h4>
    <p><?php echo e($jabatan); ?></p>
</div><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views\partials\kartu-orang.blade.php ENDPATH**/ ?>