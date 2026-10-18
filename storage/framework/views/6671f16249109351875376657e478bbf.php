<?php if (isset($component)) { $__componentOriginal1c5d31f145ea1c04eae277cd42351dba = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1c5d31f145ea1c04eae277cd42351dba = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.action-bar','data' => ['create' => '/demo/crear','createLabel' => 'Nuevo demo','createPermission' => 'usuarios.crear','export' => '/demo/pdf','exportPermission' => 'usuarios.exportar','table' => 'tabla-demo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('action-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['create' => '/demo/crear','create-label' => 'Nuevo demo','create-permission' => 'usuarios.crear','export' => '/demo/pdf','export-permission' => 'usuarios.exportar','table' => 'tabla-demo']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1c5d31f145ea1c04eae277cd42351dba)): ?>
<?php $attributes = $__attributesOriginal1c5d31f145ea1c04eae277cd42351dba; ?>
<?php unset($__attributesOriginal1c5d31f145ea1c04eae277cd42351dba); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1c5d31f145ea1c04eae277cd42351dba)): ?>
<?php $component = $__componentOriginal1c5d31f145ea1c04eae277cd42351dba; ?>
<?php unset($__componentOriginal1c5d31f145ea1c04eae277cd42351dba); ?>
<?php endif; ?>
                      <?php if (isset($component)) { $__componentOriginalec2502b834f860c8e30d229aa8f280e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalec2502b834f860c8e30d229aa8f280e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.delete-button','data' => ['url' => '/demo/1','permission' => 'usuarios.eliminar','confirm' => '¿Eliminar demo?','redirect' => '/demo','label' => 'Eliminar']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('delete-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => '/demo/1','permission' => 'usuarios.eliminar','confirm' => '¿Eliminar demo?','redirect' => '/demo','label' => 'Eliminar']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalec2502b834f860c8e30d229aa8f280e2)): ?>
<?php $attributes = $__attributesOriginalec2502b834f860c8e30d229aa8f280e2; ?>
<?php unset($__attributesOriginalec2502b834f860c8e30d229aa8f280e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalec2502b834f860c8e30d229aa8f280e2)): ?>
<?php $component = $__componentOriginalec2502b834f860c8e30d229aa8f280e2; ?>
<?php unset($__componentOriginalec2502b834f860c8e30d229aa8f280e2); ?>
<?php endif; ?><?php /**PATH /private/var/folders/d9/ryc8kmxd0sq06bx3700lgnm80000gn/T/laravel-blade9mtggl7l2tpc6jHB9Le.blade.php ENDPATH**/ ?>