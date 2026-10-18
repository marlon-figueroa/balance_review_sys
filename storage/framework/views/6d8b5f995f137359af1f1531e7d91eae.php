<?php $__env->startSection('body-class', 'guest-layout'); ?>

<?php $__env->startSection('body'); ?>
    <nav class="navbar navbar-expand app-topbar shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="<?php echo e(url('/')); ?>">
                <span class="app-sidebar-brand-mark" aria-hidden="true">
                    <i data-feather="clipboard"></i>
                </span>
                <span class="fw-bold"><?php echo e(config('app.name', 'Laravel')); ?></span>
            </a>

            <ul class="navbar-nav ms-auto">
                <?php echo $__env->make('partials.theme-toggle', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Route::has('login') && ! request()->routeIs('login')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('login')); ?>">
                            <i class="bi bi-box-arrow-in-right me-1"></i> <span class="d-none d-sm-inline"><?php echo e(__('Login')); ?></span>
                        </a>
                    </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Route::has('register') && ! request()->routeIs('register')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('register')); ?>">
                            <i class="bi bi-person-plus me-1"></i> <span class="d-none d-sm-inline"><?php echo e(__('Register')); ?></span>
                        </a>
                    </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </ul>
        </div>
    </nav>

    <main class="guest-content">
        <div class="container-fluid d-flex flex-column flex-grow-1">
            <?php echo $__env->make('partials.alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>

    <?php echo $__env->make('layouts.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/layouts/guest.blade.php ENDPATH**/ ?>