<?php $__env->startSection('head'); ?>
    
    <script>
        try {
            if (localStorage.getItem('sidebar') === 'collapsed') {
                document.documentElement.classList.add('sidebar-collapsed');
            }
        } catch (e) {}
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body-class', 'app-layout'); ?>

<?php $__env->startSection('body'); ?>
    <div class="app-wrapper">
        <?php echo $__env->make('layouts.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="app-main">
            <?php echo $__env->make('layouts.partials.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <main class="app-content">
                <div class="m-3">
                    <?php echo $__env->make('partials.impersonacion', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php echo $__env->make('partials.alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </main>

            <?php echo $__env->make('layouts.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/layouts/app.blade.php ENDPATH**/ ?>