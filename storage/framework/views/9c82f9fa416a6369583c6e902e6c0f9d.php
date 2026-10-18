<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'id',
    'url',
    'columns' => [],
    'order' => [[0, 'asc']],
    'filters' => null,
    'pageLength' => null,
    'card' => true,
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
    'url',
    'columns' => [],
    'order' => [[0, 'asc']],
    'filters' => null,
    'pageLength' => null,
    'card' => true,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $columnas = collect($columns)->map(function (array $columna) {
        $acciones = ! empty($columna['actions']);

        return [
            'label' => $columna['label'] ?? '',
            'headerClass' => $columna['headerClass'] ?? ($acciones ? 'text-end' : ($columna['class'] ?? null)),
            'config' => array_filter([
                'data' => $columna['data'],
                'name' => $columna['name'] ?? ($acciones ? null : $columna['data']),
                'orderable' => $acciones ? false : ($columna['orderable'] ?? null),
                'searchable' => $acciones ? false : ($columna['searchable'] ?? null),
                'className' => trim(($acciones ? 'acciones text-end ' : '').($columna['class'] ?? '')) ?: null,
                'defaultContent' => $columna['defaultContent'] ?? null,
            ], fn ($valor) => $valor !== null),
        ];
    });

    $config = array_filter([
        'url' => $url,
        'order' => $order,
        'pageLength' => $pageLength,
        'columns' => $columnas->pluck('config')->all(),
    ], fn ($valor) => $valor !== null);
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($card): ?>
    <div class="card">
        <div class="card-body">
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <table id="<?php echo e($id); ?>"
                   <?php echo e($attributes->class(['table table-hover align-middle w-100'])); ?>

                   data-datatable-config="<?php echo e(json_encode($config)); ?>"
                   <?php if($filters): ?> data-filters="<?php echo e($filters); ?>" <?php endif; ?>>
                <thead>
                    <tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $columnas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $columna): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <th<?php echo $columna['headerClass'] ? ' class="'.e($columna['headerClass']).'"' : ''; ?>><?php echo e($columna['label']); ?></th>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </tr>
                </thead>
            </table>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($card): ?>
        </div>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/components/datatable.blade.php ENDPATH**/ ?>