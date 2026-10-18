<?php
    $suplantarId = null;

    if (
        isset($impersonateUser)
        && auth()->user()?->canImpersonate()
        && auth()->user()->isNot($impersonateUser)
        && $impersonateUser->canBeImpersonated()
    ) {
        $suplantarId = 'impersonate-'.$impersonateUser->getKey();
    }
?>


<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($suplantarId): ?>
    <form id="<?php echo e($suplantarId); ?>" method="POST" action="<?php echo e(route('impersonate', $impersonateUser)); ?>" hidden>
        <?php echo csrf_field(); ?>
    </form>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<div class="btn-group btn-group-sm" role="group">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($suplantarId): ?>
        <button type="submit" form="<?php echo e($suplantarId); ?>" class="btn btn-outline-secondary" title="Ingresar como este usuario">
            <i class="bi bi-person-bounding-box"></i>
        </button>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($editPermission)): ?>
        <a href="<?php echo e($editUrl); ?>" class="btn btn-outline-primary" title="Editar">
            <i class="bi bi-pencil-square"></i>
        </a>
    <?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($deleteUrl): ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($deletePermission)): ?>
            <button type="button" class="btn btn-outline-danger" title="Eliminar"
                    data-delete-url="<?php echo e($deleteUrl); ?>" data-confirm="<?php echo e($confirm); ?>">
                <i class="bi bi-trash"></i>
            </button>
        <?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/admin/partials/acciones.blade.php ENDPATH**/ ?>