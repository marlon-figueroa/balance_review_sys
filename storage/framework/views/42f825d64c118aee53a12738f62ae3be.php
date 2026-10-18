<?php if (is_impersonating()) : ?>
    <?php ($impersonador = app('impersonate')->getImpersonator()); ?>
    <div class="alert alert-warning d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3" role="status">
        <span>
            <i class="bi bi-person-bounding-box me-1"></i>
            Está viendo la aplicación como <strong><?php echo e(Auth::user()->name); ?></strong>
            (<?php echo e(Auth::user()->email); ?>).
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($impersonador): ?>
                Su cuenta es <?php echo e($impersonador->name); ?>.
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </span>
        <form method="POST" action="<?php echo e(route('impersonate.leave')); ?>" class="mb-0">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-sm btn-warning">Volver a mi cuenta</button>
        </form>
    </div>
<?php endif; ?>
<?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/partials/impersonacion.blade.php ENDPATH**/ ?>