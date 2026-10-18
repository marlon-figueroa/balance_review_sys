<?php $__env->startSection('title', 'Bitácora'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $pestanas = array_filter([
        'registros' => ['label' => 'Registros', 'icon' => 'list', 'visible' => auth()->user()->can('bitacora.ver')],
        'sesiones' => ['label' => 'Sesiones activas', 'icon' => 'users', 'visible' => auth()->user()->can('bitacora.ver')],
        'monitoreo' => ['label' => 'Monitoreo', 'icon' => 'activity', 'visible' => auth()->user()->can('monitoreo.pulse')],
        'logs' => ['label' => 'Logs', 'icon' => 'file-text', 'visible' => auth()->user()->can('monitoreo.logs')],
    ], fn ($pestana) => $pestana['visible']);
    $activa = array_key_first($pestanas);
?>
    <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'Bitácora','icon' => 'journal-text','subtitle' => 'Registros de actividad, sesiones activas y herramientas de monitoreo.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Bitácora','icon' => 'journal-text','subtitle' => 'Registros de actividad, sesiones activas y herramientas de monitoreo.']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bitacora.exportar')): ?>
            <?php if (isset($component)) { $__componentOriginalb8f070ebd9b9b1550e3534b5f5c4ffbb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb8f070ebd9b9b1550e3534b5f5c4ffbb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-action-group','data' => ['label' => 'Exportar']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-action-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Exportar']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                <x-action-btn variant="export" icon="file-earmark-pdf" label="Exportar PDF" :href="route('admin.bitacora.pdf')" id="btn-exportar-pdf" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['d-none' => $activa !== 'registros']); ?>"" />
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

    <ul class="nav nav-tabs mb-3" id="bitacora-tabs" role="tablist">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pestanas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clave => $pestana): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <li class="nav-item" role="presentation">
                <button type="button" id="tab-<?php echo e($clave); ?>" role="tab"
                        class="nav-link d-flex align-items-center gap-2 <?php if($clave === $activa): ?> active <?php endif; ?>"
                        data-bs-toggle="tab" data-bs-target="#pane-<?php echo e($clave); ?>" data-tab="<?php echo e($clave); ?>"
                        aria-controls="pane-<?php echo e($clave); ?>" aria-selected="<?php echo e($clave === $activa ? 'true' : 'false'); ?>">
                    <i data-feather="<?php echo e($pestana['icon']); ?>"></i> <?php echo e($pestana['label']); ?>

                </button>
            </li>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </ul>

    <div class="tab-content">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bitacora.ver')): ?>
            <?php echo $__env->make('admin.bitacora.partials.registros', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->make('admin.bitacora.partials.sesiones', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('monitoreo.pulse')): ?>
            <?php echo $__env->make('admin.bitacora.partials.panel-embebido', [
                'clave' => 'monitoreo',
                'titulo' => 'Laravel Pulse',
                'url' => route('pulse'),
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('monitoreo.logs')): ?>
            <?php echo $__env->make('admin.bitacora.partials.panel-embebido', [
                'clave' => 'logs',
                'titulo' => 'Visor de logs',
                'url' => route('log-viewer.index'),
                'urlEmbebida' => route('log-viewer.index', ['embed' => 1]),
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endif; ?>
    </div>

<?php echo $__env->yieldPushContent('modals'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/pages/bitacora.js'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/admin/bitacora/index.blade.php ENDPATH**/ ?>