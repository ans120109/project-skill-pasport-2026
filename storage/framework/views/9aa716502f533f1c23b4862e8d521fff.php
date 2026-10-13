<?php
    $profil  = $profil ?? \App\Models\ProfilSekolah::first();
    $isAdmin = auth()->check() && auth()->user()->role === 'admin';
?>

<?php if(!$profil): ?>
    <div class="card">
        <p class="muted">Profil sekolah belum diisi.</p>
        <?php if($isAdmin): ?>
            <a href="<?php echo e(route('profile-sekolah.edit')); ?>" class="btn-action">✏️ Isi Profil Sekolah</a>
        <?php endif; ?>
    </div>
<?php else: ?>
<style>
    .ps-hero{display:flex;gap:24px;align-items:center;background:#0f1f4b;color:#fff;border-radius:16px;padding:28px;flex-wrap:wrap;margin-bottom:20px}
    .ps-hero img{width:200px;height:140px;object-fit:cover;border-radius:12px;background:#1d2f66}
    .ps-hero h2{margin:0 0 6px;font-size:24px;color:#fff}
    .ps-hero p{margin:2px 0;opacity:.85;font-size:14px;color:#fff}
    .ps-badges{display:flex;gap:8px;flex-wrap:wrap;margin-top:10px}
    .ps-badge{background:rgba(255,255,255,.15);padding:4px 12px;border-radius:999px;font-size:12px}
    .ps-stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:14px;margin-bottom:20px}
    .ps-stat{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:16px;text-align:center}
    .ps-stat b{display:block;font-size:24px;color:#0f1f4b}
    .ps-stat span{font-size:13px;color:#6b7280}
    .ps-section{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:20px;margin-bottom:16px}
    .ps-section h3{margin:0 0 12px;font-size:18px;color:#0f1f4b;border-left:4px solid #d99a22;padding-left:10px}
    .ps-section ol,.ps-section ul{margin:0;padding-left:22px;line-height:1.7;font-size:14px}
    .ps-section li{margin-bottom:6px}
    .ps-section p{margin:0;line-height:1.7;white-space:pre-line;font-size:14px}
    .ps-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;align-items:start}
    @media(max-width:700px){.ps-grid{grid-template-columns:1fr}.ps-hero img{width:100%}}
    .ps-btn{display:inline-block;background:#d99a22;color:#fff;padding:8px 16px;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px}
</style>

<div class="ps-hero">
    <?php if($profil->foto_url): ?>
        <img src="<?php echo e($profil->foto_url); ?>" alt="Foto <?php echo e($profil->nama_sekolah); ?>">
    <?php endif; ?>
    <div style="flex:1;min-width:220px">
        <h2><?php echo e($profil->nama_sekolah); ?></h2>
        <?php if($profil->alamat): ?><p>📍 <?php echo e($profil->alamat); ?></p><?php endif; ?>
        <?php if($profil->telepon): ?><p>📞 <?php echo e($profil->telepon); ?></p><?php endif; ?>
        <?php if($profil->email): ?><p>✉️ <?php echo e($profil->email); ?></p><?php endif; ?>
        <div class="ps-badges">
            <?php if($profil->npsn): ?><span class="ps-badge">NPSN: <?php echo e($profil->npsn); ?></span><?php endif; ?>
            <?php if($profil->akreditasi): ?><span class="ps-badge">Akreditasi <?php echo e($profil->akreditasi); ?></span><?php endif; ?>
            <?php if($profil->tahun_berdiri): ?><span class="ps-badge">Berdiri <?php echo e($profil->tahun_berdiri); ?></span><?php endif; ?>
        </div>
    </div>

    <?php if($isAdmin): ?>
        <a href="<?php echo e(route('profile-sekolah.edit')); ?>" class="ps-btn">✏️ Edit Profil</a>
    <?php endif; ?>
</div>

<div class="ps-stats">
    <div class="ps-stat"><b><?php echo e(number_format($profil->jumlah_siswa ?? 0)); ?></b><span>Siswa</span></div>
    <div class="ps-stat"><b><?php echo e(number_format($profil->jumlah_guru ?? 0)); ?></b><span>Guru</span></div>
    <div class="ps-stat"><b><?php echo e(number_format($profil->jumlah_ekskul ?? 0)); ?></b><span>Ekstrakurikuler</span></div>
</div>

<?php if($profil->sambutan): ?>
<div class="ps-section">
    <h3>Sambutan Kepala Sekolah</h3>
    <p><?php echo e($profil->sambutan); ?></p>
    <?php if($profil->nama_kepsek): ?>
        <p style="margin-top:10px"><b>— <?php echo e($profil->nama_kepsek); ?></b></p>
    <?php endif; ?>
</div>
<?php endif; ?>

<?php if($profil->tentang): ?>
<div class="ps-section">
    <h3>Tentang Sekolah</h3>
    <p><?php echo e($profil->tentang); ?></p>
</div>
<?php endif; ?>

<div class="ps-grid">
    <div class="ps-section">
        <h3>Visi</h3>
        <p><?php echo e($profil->visi ?: 'Belum diisi.'); ?></p>
    </div>
    <div class="ps-section">
        <h3>Misi</h3>
        <?php if(count($profil->daftar_misi)): ?>
            <ol><?php $__currentLoopData = $profil->daftar_misi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($m); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ol>
        <?php else: ?>
            <p>Belum diisi.</p>
        <?php endif; ?>
    </div>
</div>

<?php if(count($profil->daftar('tujuan'))): ?>
<div class="ps-section">
    <h3>Tujuan</h3>
    <ol><?php $__currentLoopData = $profil->daftar('tujuan'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($t); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ol>
</div>
<?php endif; ?>

<?php if($profil->sejarah): ?>
<div class="ps-section">
    <h3>Sejarah</h3>
    <p><?php echo e($profil->sejarah); ?></p>
</div>
<?php endif; ?>

<div class="ps-grid">
    <div class="ps-section">
        <h3>Fasilitas</h3>
        <?php if(count($profil->daftar('fasilitas'))): ?>
            <ul><?php $__currentLoopData = $profil->daftar('fasilitas'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($f); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
        <?php else: ?>
            <p>Belum diisi.</p>
        <?php endif; ?>
    </div>
    <div class="ps-section">
        <h3>Prestasi</h3>
        <?php if(count($profil->daftar('prestasi'))): ?>
            <ul><?php $__currentLoopData = $profil->daftar('prestasi'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li>🏆 <?php echo e($p); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
        <?php else: ?>
            <p>Belum diisi.</p>
        <?php endif; ?>
    </div>
</div>

<?php if($profil->maps_url): ?>
<div class="ps-section">
    <h3>Lokasi</h3>
    <a href="<?php echo e($profil->maps_url); ?>" target="_blank" rel="noopener" class="ps-btn">📍 Buka di Google Maps</a>
</div>
<?php endif; ?>
<?php endif; ?><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views\partials\profil-sekolah.blade.php ENDPATH**/ ?>