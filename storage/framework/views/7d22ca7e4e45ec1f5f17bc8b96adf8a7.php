<li class="nav-item app-sidebar-item" data-nivel="<?php echo e($item['nivel']); ?>">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item['children']): ?>
        <button type="button"
                class="<?php echo \Illuminate\Support\Arr::toCssClasses(['nav-link app-sidebar-branch w-100', 'collapsed' => ! $item['abierto']]); ?>"
                data-bs-toggle="collapse"
                data-bs-target="#<?php echo e($item['id']); ?>"
                aria-controls="<?php echo e($item['id']); ?>"
                aria-expanded="<?php echo e($item['abierto'] ? 'true' : 'false'); ?>"
                title="<?php echo e($item['label']); ?>">
            <i data-feather="<?php echo e($item['icon']); ?>" class="app-sidebar-icon"></i>
            <span class="text-truncate"><?php echo e($item['label']); ?></span>
            <i data-feather="chevron-right" class="app-sidebar-chevron ms-auto"></i>
        </button>

        <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['collapse', 'show' => $item['abierto']]); ?>" id="<?php echo e($item['id']); ?>">
            <ul class="nav flex-column app-sidebar-submenu">
                <?php echo $__env->renderEach('layouts.partials.sidebar-item', $item['children'], 'item'); ?>
            </ul>
        </div>
    <?php else: ?>
        <a href="<?php echo e($item['url']); ?>"
           class="<?php echo \Illuminate\Support\Arr::toCssClasses(['nav-link', 'active' => $item['activo']]); ?>"
           title="<?php echo e($item['label']); ?>"
           <?php if($item['activo']): ?> aria-current="page" <?php endif; ?>>
            <i data-feather="<?php echo e($item['icon']); ?>" class="app-sidebar-icon"></i>
            <span class="text-truncate"><?php echo e($item['label']); ?></span>
        </a>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</li>
<?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/layouts/partials/sidebar-item.blade.php ENDPATH**/ ?>