<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'icon',
    'titulo',
    'texto',
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
    'icon',
    'titulo',
    'texto',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="perfil-vacio text-center py-4 px-3">
    <div class="perfil-vacio__icon rounded-circle mx-auto mb-3">
        <i class="bi bi-<?php echo e($icon); ?>"></i>
    </div>
    <p class="fw-semibold mb-1"><?php echo e($titulo); ?></p>
    <p class="text-body-secondary small mb-0"><?php echo e($texto); ?></p>
</div>
<?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/perfil/partials/vacio.blade.php ENDPATH**/ ?>