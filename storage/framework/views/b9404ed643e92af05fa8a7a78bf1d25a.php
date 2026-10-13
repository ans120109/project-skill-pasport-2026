<section id="guru" class="section">
    <div class="container">
        <div class="section-head">
            <h2>Daftar Guru</h2>
        </div>

        <?php if($gurus->isNotEmpty()): ?>
            <div class="grid-orang">
                <?php $__currentLoopData = $gurus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('partials.kartu-orang', ['orang' => $orang], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="card muted">Data guru belum tersedia.</div>
        <?php endif; ?>
    </div>
</section>


<section id="staff" class="section">
    <div class="container">
        <div class="section-head">
            <h2>Daftar Staff</h2>
        </div>

        <?php if($staffs->isNotEmpty()): ?>
            <div class="grid-orang">
                <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('partials.kartu-orang', ['orang' => $orang], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="card muted">Data staff belum tersedia.</div>
        <?php endif; ?>
    </div>
</section><?php /**PATH D:\XII RPL 1\serkom\project2026_2\project2026\resources\views/landing/guru-staff.blade.php ENDPATH**/ ?>