

<?php $__env->startSection('title', 'Beranda'); ?>

<?php $__env->startSection('content'); ?>

<?php
    use Illuminate\Support\Str;

    $gambar = fn ($m) => $m->gambar ?? $m->foto ?? $m->image ?? $m->thumbnail ?? null;
?>


<section class="hero">
    <div class="container">
        <h1><?php echo e($profil->nama_sekolah ?? $profil->nama ?? 'SMA Cendikia Nusantara'); ?></h1>
        <p>
            <?php echo e(Str::limit($profil->deskripsi ?? 'Selamat datang di website resmi sekolah kami. Temukan berita, galeri, ekstrakurikuler, dan informasi akademik terbaru.', 180)); ?>

        </p>
        <div class="hero-actions">
            <a href="#profil" class="btn btn-primary">Kenali sekolah kami</a>
            <a href="<?php echo e(route('berita.index')); ?>" class="btn btn-ghost">Baca berita terbaru</a>
        </div>
    </div>
</section>


<?php echo $__env->make('landing.profil-sekolah', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('landing.guru-staff', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<section class="section" id="berita">
    <div class="container">
        <div class="section-head">
            <h2>Berita &amp; Pengumuman</h2>
            <a href="<?php echo e(route('berita.index')); ?>">Lihat semua</a>
        </div>

        <?php if($beritas->isNotEmpty()): ?>
            <div class="grid-3">
                <?php $__currentLoopData = $beritas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('berita.show', $b)); ?>" class="media-card">
                        <?php if($gambar($b)): ?>
                            <img src="<?php echo e(asset('storage/' . $gambar($b))); ?>" alt="<?php echo e($b->judul ?? ''); ?>">
                        <?php else: ?>
                            <div class="noimg"></div>
                        <?php endif; ?>
                        <div class="media-body">
                            <h3><?php echo e($b->judul ?? $b->title ?? 'Tanpa judul'); ?></h3>
                            <div class="media-meta"><?php echo e(optional($b->created_at)->translatedFormat('d M Y')); ?></div>
                            <p><?php echo e(Str::limit(strip_tags(Str::markdown($b->isi ?? $b->konten ?? '')), 100)); ?></p>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="card muted">Belum ada berita.</div>
        <?php endif; ?>
    </div>
</section>


<section class="section" id="ekskul">
    <div class="container">
        <div class="section-head">
            <h2>Ekstrakurikuler</h2>
            <a href="<?php echo e(route('ekstrakurikuler.index')); ?>">Lihat semua</a>
        </div>

        <?php if($ekskuls->isNotEmpty()): ?>
            <div class="grid-3">
                <?php $__currentLoopData = $ekskuls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('ekstrakurikuler.show', $e)); ?>" class="media-card">
                        <?php if($gambar($e)): ?>
                            <img src="<?php echo e(asset('storage/' . $gambar($e))); ?>" alt="<?php echo e($e->nama ?? ''); ?>">
                        <?php else: ?>
                            <div class="noimg"></div>
                        <?php endif; ?>
                        <div class="media-body">
                            <h3><?php echo e($e->nama ?? $e->judul ?? 'Ekstrakurikuler'); ?></h3>
                            <p><?php echo e(Str::limit(strip_tags(Str::markdown($e->deskripsi ?? '')), 90)); ?></p>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="card muted">Belum ada data ekstrakurikuler.</div>
        <?php endif; ?>
    </div>
</section>


<section class="section" id="galeri">
    <div class="container">
        <div class="section-head">
            <h2>Galeri</h2>
            <a href="<?php echo e(route('galeri.index')); ?>">Lihat semua</a>
        </div>

        <?php if($galeris->isNotEmpty()): ?>
            <div class="grid-3">
                <?php $__currentLoopData = $galeris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('galeri.show', $g)); ?>" class="media-card">
                        <?php if($gambar($g)): ?>
                            <img src="<?php echo e(asset('storage/' . $gambar($g))); ?>" alt="<?php echo e($g->judul ?? ''); ?>">
                        <?php else: ?>
                            <div class="noimg"></div>
                        <?php endif; ?>
                        <div class="media-body">
                            <h3><?php echo e($g->judul ?? $g->title ?? 'Galeri'); ?></h3>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="card muted">Belum ada foto di galeri.</div>
        <?php endif; ?>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views/landing.blade.php ENDPATH**/ ?>