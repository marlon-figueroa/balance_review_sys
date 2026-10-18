<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'id',
    'target',
    'title' => 'Filtros',
    'buttonsClass' => 'col-md-2',
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
    'id',
    'target',
    'title' => 'Filtros',
    'buttonsClass' => 'col-md-2',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="card mb-4">
    <div class="card-header"><i class="bi bi-funnel me-1"></i> <?php echo e($title); ?></div>
    <div class="card-body">
        <form id="<?php echo e($id); ?>" <?php echo e($attributes->class(['row g-3 align-items-end'])); ?> data-filters-for="<?php echo e($target); ?>" autocomplete="off">
            <?php echo e($slot); ?>


            <div class="<?php echo e($buttonsClass); ?> d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-fill" title="Filtrar">
                    <i class="bi bi-search"></i>
                </button>
                <button type="reset" class="btn btn-outline-secondary flex-fill" title="Limpiar">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
        </form>
    </div>
</div>
<?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/components/filters.blade.php ENDPATH**/ ?>