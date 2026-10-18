<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name',
    'label' => null,
    'options' => [],
    'selected' => null,
    'id' => null,
    'multiple' => false,
    'select2' => true,
    'placeholder' => null,
    'allowClear' => false,
    'required' => false,
    'help' => null,
    'col' => 'col-md-6',
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
    'name',
    'label' => null,
    'options' => [],
    'selected' => null,
    'id' => null,
    'multiple' => false,
    'select2' => true,
    'placeholder' => null,
    'allowClear' => false,
    'required' => false,
    'help' => null,
    'col' => 'col-md-6',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $clave = trim(str_replace(['[]', '[', ']'], ['', '.', ''], $name), '.');
    $id ??= str_replace('.', '_', $clave);
    $nombre = $multiple && ! str_ends_with($name, '[]') ? $name.'[]' : $name;

    $opciones = collect($options)->all();
    if (array_is_list($opciones)) {
        $opciones = array_combine($opciones, $opciones) ?: [];
    }

    $seleccion = old($clave, $selected);
    $seleccion = array_map('strval', $seleccion instanceof \Illuminate\Support\Collection ? $seleccion->all() : (array) $seleccion);
    $invalido = $errors->has($clave) || $errors->has($clave.'.*');

    $atributos = $attributes->class([
        'form-select',
        'select2' => $select2,
        'is-invalid' => $invalido,
    ]);

    if ($select2) {
        $atributos = $atributos->merge([
            'data-placeholder' => $placeholder,
            'data-allow-clear' => $allowClear ? 'true' : null,
        ]);
    }
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($col): ?>
    <div class="<?php echo e($col); ?>">
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php echo $__env->make('components.form.partials.label', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <select id="<?php echo e($id); ?>" name="<?php echo e($nombre); ?>" <?php if($multiple): ?> multiple <?php endif; ?> <?php if($required): echo 'required'; endif; ?> <?php echo e($atributos); ?>>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if (! ($multiple)): ?>
            <option value=""><?php echo e($select2 ? '' : ($placeholder ?? 'Seleccione una opción')); ?></option>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $opciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valor => $etiqueta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <option value="<?php echo e($valor); ?>" <?php if(in_array((string) $valor, $seleccion, true)): echo 'selected'; endif; ?>><?php echo e($etiqueta); ?></option>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </select>

    <?php echo $__env->make('components.form.partials.feedback', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($col): ?>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/components/form/select.blade.php ENDPATH**/ ?>