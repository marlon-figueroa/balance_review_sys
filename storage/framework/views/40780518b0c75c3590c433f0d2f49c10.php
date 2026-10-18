<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title',
    'icon' => null,
    'image' => null,
    'subtitle' => null,
    'section' => 'Seguridad',
    'parent' => null,
    'breadcrumb' => true,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'title',
    'icon' => null,
    'image' => null,
    'subtitle' => null,
    'section' => 'Seguridad',
    'parent' => null,
    'breadcrumb' => true,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $crumbs = [
        ['label' => 'Inicio', 'url' => route('home')],
    ];

    if ($section) {
        $crumbs[] = ['label' => $section];
    }

    if ($parent) {
        $crumbs[] = ['label' => $parent['label'], 'url' => $parent['url']];
    }

    $crumbs[] = ['label' => $title, 'active' => true];
?>

<header <?php echo e($attributes->class(['view-header mb-4'])); ?>>
    <div class="view-header__top d-flex flex-wrap align-items-start justify-content-between gap-3">
        <div class="d-flex align-items-start gap-3 min-w-0">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($image): ?>
                <img src="<?php echo e($image); ?>" alt="" class="view-header__media" width="48" height="48">
            <?php elseif($icon): ?>
                <div class="view-header__icon" aria-hidden="true">
                    <i class="bi bi-<?php echo e($icon); ?>"></i>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="min-w-0">
                <h1 class="view-header__title h3 mb-0"><?php echo e($title); ?></h1>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($subtitle): ?>
                    <p class="view-header__subtitle text-body-secondary small mb-0 mt-1"><?php echo e($subtitle); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($slot->isNotEmpty()): ?>
            <div class="view-header__actions ms-auto">
                <?php if (isset($component)) { $__componentOriginala6c0d8207066ef39d2aaf6209f6e5572 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala6c0d8207066ef39d2aaf6209f6e5572 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-actions','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-actions'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                    <?php echo e($slot); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala6c0d8207066ef39d2aaf6209f6e5572)): ?>
<?php $attributes = $__attributesOriginala6c0d8207066ef39d2aaf6209f6e5572; ?>
<?php unset($__attributesOriginala6c0d8207066ef39d2aaf6209f6e5572); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala6c0d8207066ef39d2aaf6209f6e5572)): ?>
<?php $component = $__componentOriginala6c0d8207066ef39d2aaf6209f6e5572; ?>
<?php unset($__componentOriginala6c0d8207066ef39d2aaf6209f6e5572); ?>
<?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($breadcrumb): ?>
        <nav aria-label="breadcrumb" class="view-header__breadcrumb mt-2">
            <ol class="view-header__crumbs list-unstyled d-flex flex-wrap align-items-center justify-content-end gap-1 mb-0 small">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $crumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $crumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! empty($crumb['active'])): ?>
                        <li class="view-header__crumb view-header__crumb--active" aria-current="page"><?php echo e($crumb['label']); ?></li>
                    <?php elseif(! empty($crumb['url'])): ?>
                        <li class="view-header__crumb">
                            <a href="<?php echo e($crumb['url']); ?>">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($crumb['label'] === 'Inicio'): ?>
                                    <i class="bi bi-house-door me-1" aria-hidden="true"></i>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php echo e($crumb['label']); ?>

                            </a>
                        </li>
                    <?php else: ?>
                        <li class="view-header__crumb view-header__crumb--muted"><?php echo e($crumb['label']); ?></li>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if (! ($loop->last)): ?>
                        <li class="view-header__crumb-sep" aria-hidden="true"><i class="bi bi-chevron-right"></i></li>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </ol>
        </nav>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</header>
<?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/components/page-header.blade.php ENDPATH**/ ?>