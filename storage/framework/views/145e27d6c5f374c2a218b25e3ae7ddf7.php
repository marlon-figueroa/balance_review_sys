<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'create' => null,
    'createLabel' => 'Nuevo',
    'createIcon' => 'plus-lg',
    'createPermission' => null,
    'export' => null,
    'exportLabel' => 'Exportar PDF',
    'exportPermission' => null,
    'table' => null,
    'groupLabel' => null,
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
    'create' => null,
    'createLabel' => 'Nuevo',
    'createIcon' => 'plus-lg',
    'createPermission' => null,
    'export' => null,
    'exportLabel' => 'Exportar PDF',
    'exportPermission' => null,
    'table' => null,
    'groupLabel' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $puede = fn (?string $permiso) => $permiso === null || (bool) auth()->user()?->can($permiso);
    $tieneExport = $export && $puede($exportPermission);
    $tieneCreate = $create && $puede($createPermission);
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tieneExport || $tieneCreate || ! $slot->isEmpty()): ?>
    <?php if (isset($component)) { $__componentOriginalb8f070ebd9b9b1550e3534b5f5c4ffbb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb8f070ebd9b9b1550e3534b5f5c4ffbb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-action-group','data' => ['label' => $groupLabel]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-action-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($groupLabel)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

        <?php echo e($slot); ?>


        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tieneExport): ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($table): ?>
                <?php if (isset($component)) { $__componentOriginalea0a006b13ef86193364f165ef549f04 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalea0a006b13ef86193364f165ef549f04 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.action-btn','data' => ['variant' => 'export','icon' => 'file-earmark-pdf','label' => $exportLabel,'href' => $export,'dataExportTable' => ''.e($table).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('action-btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'export','icon' => 'file-earmark-pdf','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($exportLabel),'href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($export),'data-export-table' => ''.e($table).'']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalea0a006b13ef86193364f165ef549f04)): ?>
<?php $attributes = $__attributesOriginalea0a006b13ef86193364f165ef549f04; ?>
<?php unset($__attributesOriginalea0a006b13ef86193364f165ef549f04); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalea0a006b13ef86193364f165ef549f04)): ?>
<?php $component = $__componentOriginalea0a006b13ef86193364f165ef549f04; ?>
<?php unset($__componentOriginalea0a006b13ef86193364f165ef549f04); ?>
<?php endif; ?>
            <?php else: ?>
                <?php if (isset($component)) { $__componentOriginalea0a006b13ef86193364f165ef549f04 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalea0a006b13ef86193364f165ef549f04 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.action-btn','data' => ['variant' => 'export','icon' => 'file-earmark-pdf','label' => $exportLabel,'href' => $export]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('action-btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'export','icon' => 'file-earmark-pdf','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($exportLabel),'href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($export)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalea0a006b13ef86193364f165ef549f04)): ?>
<?php $attributes = $__attributesOriginalea0a006b13ef86193364f165ef549f04; ?>
<?php unset($__attributesOriginalea0a006b13ef86193364f165ef549f04); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalea0a006b13ef86193364f165ef549f04)): ?>
<?php $component = $__componentOriginalea0a006b13ef86193364f165ef549f04; ?>
<?php unset($__componentOriginalea0a006b13ef86193364f165ef549f04); ?>
<?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tieneCreate): ?>
            <?php if (isset($component)) { $__componentOriginalea0a006b13ef86193364f165ef549f04 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalea0a006b13ef86193364f165ef549f04 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.action-btn','data' => ['variant' => 'create','icon' => $createIcon,'label' => $createLabel,'href' => $create]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('action-btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'create','icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($createIcon),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($createLabel),'href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($create)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalea0a006b13ef86193364f165ef549f04)): ?>
<?php $attributes = $__attributesOriginalea0a006b13ef86193364f165ef549f04; ?>
<?php unset($__attributesOriginalea0a006b13ef86193364f165ef549f04); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalea0a006b13ef86193364f165ef549f04)): ?>
<?php $component = $__componentOriginalea0a006b13ef86193364f165ef549f04; ?>
<?php unset($__componentOriginalea0a006b13ef86193364f165ef549f04); ?>
<?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb8f070ebd9b9b1550e3534b5f5c4ffbb)): ?>
<?php $attributes = $__attributesOriginalb8f070ebd9b9b1550e3534b5f5c4ffbb; ?>
<?php unset($__attributesOriginalb8f070ebd9b9b1550e3534b5f5c4ffbb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb8f070ebd9b9b1550e3534b5f5c4ffbb)): ?>
<?php $component = $__componentOriginalb8f070ebd9b9b1550e3534b5f5c4ffbb; ?>
<?php unset($__componentOriginalb8f070ebd9b9b1550e3534b5f5c4ffbb); ?>
<?php endif; ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/components/action-bar.blade.php ENDPATH**/ ?>