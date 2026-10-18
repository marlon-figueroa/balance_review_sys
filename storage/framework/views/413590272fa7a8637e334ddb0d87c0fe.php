<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name',
    'label' => null,
    'value' => '1',
    'uncheckedValue' => null,
    'checked' => false,
    'id' => null,
    'switch' => false,
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
    'value' => '1',
    'uncheckedValue' => null,
    'checked' => false,
    'id' => null,
    'switch' => false,
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
    $id ??= str_replace('.', '_', $clave).(str_ends_with($name, '[]') ? '_'.\Illuminate\Support\Str::slug((string) $value, '_') : '');
    $marcado = ! empty(old())
        ? in_array((string) $value, array_map('strval', (array) old($clave, [])), true)
        : (bool) $checked;
    $invalido = $errors->has($clave) || $errors->has($clave.'.*');
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($col): ?>
    <div class="<?php echo e($col); ?>">
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['form-check', 'form-switch' => $switch]); ?>">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! is_null($uncheckedValue)): ?>
            <input type="hidden" name="<?php echo e($name); ?>" value="<?php echo e($uncheckedValue); ?>">
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <input type="checkbox" id="<?php echo e($id); ?>" name="<?php echo e($name); ?>" value="<?php echo e($value); ?>"
               <?php if($switch): ?> role="switch" <?php endif; ?>
               <?php if($marcado): echo 'checked'; endif; ?> <?php if($required): echo 'required'; endif; ?>
               <?php echo e($attributes->class(['form-check-input', 'is-invalid' => $invalido])); ?>>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($label): ?>
            <label for="<?php echo e($id); ?>" class="form-check-label">
                <?php echo e($label); ?> <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($required): ?><span class="text-danger">*</span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </label>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <?php echo $__env->make('components.form.partials.feedback', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($col): ?>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/components/form/checkbox.blade.php ENDPATH**/ ?>