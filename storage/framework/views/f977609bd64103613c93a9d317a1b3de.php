<?php $__env->startSection('title', 'Sesión activa'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'Timeline de la sesión','icon' => 'clock-history','subtitle' => $sesion->user ? $sesion->user->name : 'Sesión sin usuario','parent' => ['url' => route('admin.bitacora.index').'#sesiones', 'label' => 'Bitácora']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Timeline de la sesión','icon' => 'clock-history','subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sesion->user ? $sesion->user->name : 'Sesión sin usuario'),'parent' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['url' => route('admin.bitacora.index').'#sesiones', 'label' => 'Bitácora'])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

        <?php if (isset($component)) { $__componentOriginalb8f070ebd9b9b1550e3534b5f5c4ffbb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb8f070ebd9b9b1550e3534b5f5c4ffbb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-action-group','data' => ['label' => 'Navegación']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-action-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Navegación']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

            <?php if (isset($component)) { $__componentOriginalea0a006b13ef86193364f165ef549f04 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalea0a006b13ef86193364f165ef549f04 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.action-btn','data' => ['variant' => 'nav','icon' => 'arrow-left','label' => 'Volver a sesiones activas','href' => route('admin.bitacora.index').'#sesiones']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('action-btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'nav','icon' => 'arrow-left','label' => 'Volver a sesiones activas','href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.bitacora.index').'#sesiones')]); ?>
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
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $attributes = $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $component = $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>

    <div class="card">
        <div class="card-body">
            <?php echo $__env->make('admin.bitacora.partials.timeline-sesion', ['sesion' => $sesion, 'eventos' => $eventos], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/admin/bitacora/sesion.blade.php ENDPATH**/ ?>