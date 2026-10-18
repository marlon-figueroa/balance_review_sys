<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name',
    'label' => null,
    'type' => 'text',
    'value' => null,
    'id' => null,
    'required' => false,
    'help' => null,
    'col' => 'col-md-6',
    'icon' => null,
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
    'type' => 'text',
    'value' => null,
    'id' => null,
    'required' => false,
    'help' => null,
    'col' => 'col-md-6',
    'icon' => null,
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
    $esFecha = in_array($type, ['date', 'datetime'], true);
    $conHora = $type === 'datetime';

    if ($value instanceof \DateTimeInterface) {
        $value = $value->format($conHora ? 'd/m/Y H:i' : 'd/m/Y');
    }

    $valor = $type === 'password' ? null : old($clave, $value);
    $icono = $icon ?? ($esFecha ? 'calendar-event' : null);
    $invalido = $errors->has($clave) || $errors->has($clave.'.*');

    $atributos = $attributes->class([
        'form-control',
        'datetimepicker' => $esFecha,
        'is-invalid' => $invalido,
    ]);

    if ($esFecha) {
        $atributos = $atributos->merge([
            'placeholder' => $conHora ? 'dd/mm/aaaa hh:mm' : 'dd/mm/aaaa',
            'data-time' => $conHora ? 'true' : null,
        ]);
    }
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($col): ?>
    <div class="<?php echo e($col); ?>">
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php echo $__env->make('components.form.partials.label', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($icono): ?>
        <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['input-group', 'has-validation' => $invalido]); ?>">
            <span class="input-group-text"><i class="bi bi-<?php echo e($icono); ?>"></i></span>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <input type="<?php echo e($esFecha ? 'text' : $type); ?>" id="<?php echo e($id); ?>" name="<?php echo e($name); ?>"
                   <?php if(! is_null($valor)): ?> value="<?php echo e($valor); ?>" <?php endif; ?>
                   <?php if($required): echo 'required'; endif; ?>
                   <?php echo e($atributos); ?>>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($icono): ?>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php echo $__env->make('components.form.partials.feedback', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($col): ?>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/components/form/input.blade.php ENDPATH**/ ?>