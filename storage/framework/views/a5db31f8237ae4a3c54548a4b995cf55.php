<section id="profil" class="section">
    <div class="container">
        <div class="section-head">
            <h2>Profil Sekolah</h2>
        </div>

        <?php if($profil): ?>
            <div class="card profil">
                <?php if(!empty($profil->foto)): ?>
                    <img src="<?php echo e(asset('storage/' . $profil->foto)); ?>" alt="Foto sekolah" class="profil-foto">
                <?php endif; ?>

                <div>
                    <h3><?php echo e($profil->nama_sekolah ?? $profil->nama ?? 'SMA Cendikia Nusantara'); ?></h3>

                    <?php if(!empty($profil->deskripsi)): ?>
                        <p class="prose"><?php echo e($profil->deskripsi); ?></p>
                    <?php endif; ?>

                    <?php if(!empty($profil->alamat)): ?>
                        <p class="muted" style="margin-top:.5rem"><?php echo e($profil->alamat); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <?php if(!empty($profil->visi) || !empty($profil->misi)): ?>
                <div class="stack">

                    <?php if(!empty($profil->visi)): ?>
                        <div class="card">
                            <h3>Visi</h3>
                            <p class="prose"><?php echo e(trim($profil->visi)); ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($profil->misi)): ?>
                        <?php
                            $reNomor = '/^\d+[\.\)]\s*/';

                            $baris = collect(preg_split('/\r\n|\r|\n/', $profil->misi))
                                ->map(fn ($l) => trim($l))
                                ->filter()
                                ->values();

                            $adaNomor = $baris->contains(fn ($l) => preg_match($reNomor, $l));

                            $intro = $adaNomor
                                ? $baris->takeUntil(fn ($l) => preg_match($reNomor, $l))
                                : collect();

                            $butir = $baris->slice($intro->count())
                                ->map(fn ($l) => trim(preg_replace($reNomor, '', $l)))
                                ->filter()
                                ->values();
                        ?>

                        <div class="card">
                            <h3>Misi</h3>

                            <?php $__currentLoopData = $intro; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kalimat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <p class="prose" style="margin-bottom:.6rem"><?php echo e($kalimat); ?></p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <ol class="list prose">
                                <?php $__currentLoopData = $butir; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($b); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ol>
                        </div>
                    <?php endif; ?>

                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="card muted">
                Data profil sekolah belum diisi. Isi melalui menu Profil Sekolah di dashboard admin.
            </div>
        <?php endif; ?>
    </div>
</section><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views/landing/profil-sekolah.blade.php ENDPATH**/ ?>