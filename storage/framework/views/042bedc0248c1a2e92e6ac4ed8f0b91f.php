<div class="hero-section">
    <?php if($header): ?>
        <h1><?php echo e($header->welcome_banner); ?></h1>
        <p><?php echo e($header->tagline); ?></p>
        
        <?php if($header->main_image): ?>
            <img src="<?php echo e(asset('storage/' . $header->main_image)); ?>" alt="Hero Image">
        <?php endif; ?>
    <?php else: ?>
        <h1>Selamat Datang di Website Kami</h1>
        <p>Ini adalah tagline default.</p>
    <?php endif; ?>
</div><?php /**PATH D:\kspm-sisfor\zxcvb\resources\views/welcome.blade.php ENDPATH**/ ?>