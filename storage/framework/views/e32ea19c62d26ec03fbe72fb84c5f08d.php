<?php if (isset($component)) { $__componentOriginalfdb51dfa010d2d125b1a6b5a14ef499d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfdb51dfa010d2d125b1a6b5a14ef499d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.filters','data' => ['id' => 'filtros-demo','target' => 'tabla-demo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filters'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'filtros-demo','target' => 'tabla-demo']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
<div class="col-md-4">campo</div> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfdb51dfa010d2d125b1a6b5a14ef499d)): ?>
<?php $attributes = $__attributesOriginalfdb51dfa010d2d125b1a6b5a14ef499d; ?>
<?php unset($__attributesOriginalfdb51dfa010d2d125b1a6b5a14ef499d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfdb51dfa010d2d125b1a6b5a14ef499d)): ?>
<?php $component = $__componentOriginalfdb51dfa010d2d125b1a6b5a14ef499d; ?>
<?php unset($__componentOriginalfdb51dfa010d2d125b1a6b5a14ef499d); ?>
<?php endif; ?><?php /**PATH /private/var/folders/d9/ryc8kmxd0sq06bx3700lgnm80000gn/T/laravel-blade0iafu4hbt3nf5amenNa.blade.php ENDPATH**/ ?>