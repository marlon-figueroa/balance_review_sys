<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'label',
    'value',
    'valueClass' => '',
    'emphasis' => null,
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
    'label',
    'value',
    'valueClass' => '',
    'emphasis' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div <?php echo e($attributes->class([
    'dashboard-kpi',
    'dashboard-kpi--'.$emphasis => $emphasis,
])); ?>>
    <div class="dashboard-kpi__label"><?php echo e($label); ?></div>
    <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['dashboard-kpi__value', 'fw-bold', $valueClass]); ?>"><?php echo e($value); ?></div>
</div>
<?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/home/_kpi.blade.php ENDPATH**/ ?>