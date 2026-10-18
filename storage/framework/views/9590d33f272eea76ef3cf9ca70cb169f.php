<?php $__env->startSection('title', 'Periodo '.$periodo->etiquetaPeriodo()); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'Revisión '.$periodo->etiquetaPeriodo(),'icon' => 'journal-check','section' => 'Revisión de balance','subtitle' => $periodo->estado->etiqueta(),'parent' => ['url' => route('revisiones.index'), 'label' => 'Listado']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Revisión '.$periodo->etiquetaPeriodo()),'icon' => 'journal-check','section' => 'Revisión de balance','subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($periodo->estado->etiqueta()),'parent' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['url' => route('revisiones.index'), 'label' => 'Listado'])]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.action-btn','data' => ['variant' => 'nav','icon' => 'arrow-left','label' => 'Volver al listado','href' => route('revisiones.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('action-btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'nav','icon' => 'arrow-left','label' => 'Volver al listado','href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('revisiones.index'))]); ?>
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
        <?php if (isset($component)) { $__componentOriginalb8f070ebd9b9b1550e3534b5f5c4ffbb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb8f070ebd9b9b1550e3534b5f5c4ffbb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-action-group','data' => ['label' => 'Consultas']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-action-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Consultas']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

            <?php if (isset($component)) { $__componentOriginalea0a006b13ef86193364f165ef549f04 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalea0a006b13ef86193364f165ef549f04 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.action-btn','data' => ['variant' => 'nav','icon' => 'diagram-2','label' => 'Diagrama de estados','dataBsToggle' => 'modal','dataBsTarget' => '#diagrama-modal']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('action-btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'nav','icon' => 'diagram-2','label' => 'Diagrama de estados','data-bs-toggle' => 'modal','data-bs-target' => '#diagrama-modal']); ?>
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
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reporte', $periodo)): ?>
                <?php if (isset($component)) { $__componentOriginalea0a006b13ef86193364f165ef549f04 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalea0a006b13ef86193364f165ef549f04 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.action-btn','data' => ['variant' => 'export','icon' => 'file-earmark-pdf','label' => 'Reporte PDF','href' => route('revisiones.pdf', $periodo)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('action-btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'export','icon' => 'file-earmark-pdf','label' => 'Reporte PDF','href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('revisiones.pdf', $periodo))]); ?>
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
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $periodo)): ?>
            <?php if (isset($component)) { $__componentOriginalb8f070ebd9b9b1550e3534b5f5c4ffbb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb8f070ebd9b9b1550e3534b5f5c4ffbb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-action-group','data' => ['label' => 'Registro']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-action-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Registro']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                <?php if (isset($component)) { $__componentOriginalea0a006b13ef86193364f165ef549f04 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalea0a006b13ef86193364f165ef549f04 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.action-btn','data' => ['variant' => 'edit','icon' => 'pencil-square','label' => 'Editar','href' => route('revisiones.edit', $periodo)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('action-btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'edit','icon' => 'pencil-square','label' => 'Editar','href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('revisiones.edit', $periodo))]); ?>
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
        <?php endif; ?>
        <?php echo $__env->make('revisiones.partials.botones-flujo', ['periodo' => $periodo, 'accionesFlujo' => $accionesFlujo], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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

    <?php echo $__env->make('partials.alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="row g-3 mb-3">
        <div class="col-md-3"><div class="card"><div class="card-body small">Activo<strong class="d-block fs-5"><?php echo e(number_format((float) $periodo->total_activo, 2)); ?></strong></div></div></div>
        <div class="col-md-3"><div class="card"><div class="card-body small">Pasivo<strong class="d-block fs-5"><?php echo e(number_format((float) $periodo->total_pasivo, 2)); ?></strong></div></div></div>
        <div class="col-md-3"><div class="card"><div class="card-body small">Patrimonio<strong class="d-block fs-5"><?php echo e(number_format((float) $periodo->total_patrimonio, 2)); ?></strong></div></div></div>
        <div class="col-md-3"><div class="card"><div class="card-body small">Integridad<strong class="d-block fs-5 <?php echo e($periodo->integridad_ok ? 'text-success' : 'text-danger'); ?>"><?php echo e($periodo->integridad_ok ? 'OK' : 'Incumplida'); ?></strong></div></div></div>
    </div>

    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-balanza" type="button">Balanza</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-conciliaciones" type="button">Conciliaciones</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-hallazgos" type="button">Hallazgos</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-ajustes" type="button">Ajustes</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-kpis" type="button">KPIs</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-historial" type="button">Historial</button></li>
    </ul>

    <div class="tab-content card border-top-0 rounded-top-0">
        <div class="tab-pane fade show active p-3" id="tab-balanza">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('import', $periodo)): ?>
                <div class="row g-2 mb-3">
                    <div class="col-lg-7">
                        <form method="POST" action="<?php echo e(route('revisiones.importar-balanza', $periodo)); ?>" enctype="multipart/form-data" class="row g-2 align-items-end">
                            <?php echo csrf_field(); ?>
                            <div class="col-md-8">
                                <label class="form-label">Importar CSV de balanza</label>
                                <input type="file" name="archivo" class="form-control" accept=".csv,text/csv" required>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary w-100">Importar</button>
                            </div>
                        </form>
                        <p class="form-text mb-0 mt-1">
                            Use el <a href="<?php echo e(route('revisiones.catalogo.index')); ?>">catálogo de cuentas</a> o descargue
                            <a href="<?php echo e(route('revisiones.catalogo.exportar-csv')); ?>">plantilla CSV</a> /
                            <a href="<?php echo e(route('revisiones.catalogo.exportar-csv', ['demo' => 1])); ?>">CSV demostrativo</a>.
                        </p>
                    </div>
                    <div class="col-lg-5">
                        <label class="form-label">Cargar desde catálogo</label>
                        <div class="d-flex flex-wrap gap-2">
                            <form method="POST" action="<?php echo e(route('revisiones.cargar-catalogo', $periodo)); ?>" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="modo" value="estructura">
                                <button type="submit" class="btn btn-outline-secondary btn-sm">Estructura (saldos en cero)</button>
                            </form>
                            <form method="POST" action="<?php echo e(route('revisiones.cargar-catalogo', $periodo)); ?>" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="modo" value="demo">
                                <button type="submit" class="btn btn-outline-primary btn-sm">Balanza demostrativa</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="table-responsive">
                <table class="table table-sm table-striped">
                    <thead><tr><th>Código</th><th>Nombre</th><th>Naturaleza</th><th>Debe</th><th>Haber</th><th>Saldo</th></tr></thead>
                    <tbody>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $periodo->lineasBalanza; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $linea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <tr>
                                <td><?php echo e($linea->codigo_cuenta); ?></td>
                                <td><?php echo e($linea->nombre); ?></td>
                                <td><?php echo e($linea->naturaleza->etiqueta()); ?></td>
                                <td><?php echo e(number_format((float) $linea->debe, 2)); ?></td>
                                <td><?php echo e(number_format((float) $linea->haber, 2)); ?></td>
                                <td><?php echo e(number_format((float) $linea->saldo, 2)); ?></td>
                            </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <tr><td colspan="6" class="text-center text-body-secondary">Sin líneas. Cargue el catálogo o importe un CSV.</td></tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="tab-pane fade p-3" id="tab-conciliaciones">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $periodo)): ?>
                <form method="POST" action="<?php echo e(route('revisiones.conciliaciones.store', $periodo)); ?>" class="row g-2 mb-3">
                    <?php echo csrf_field(); ?>
                    <div class="col-md-2"><input name="tipo" class="form-control" placeholder="Tipo" required></div>
                    <div class="col-md-3"><input name="referencia" class="form-control" placeholder="Referencia" required></div>
                    <div class="col-md-2"><input name="saldo_contable" type="number" step="0.01" class="form-control" placeholder="Saldo contable" required></div>
                    <div class="col-md-2"><input name="saldo_externo" type="number" step="0.01" class="form-control" placeholder="Saldo externo" required></div>
                    <div class="col-md-2"><button class="btn btn-primary w-100">Agregar</button></div>
                </form>
            <?php endif; ?>
            <table class="table table-sm">
                <thead><tr><th>Tipo</th><th>Referencia</th><th>Contable</th><th>Externo</th><th>Diferencia</th><th></th></tr></thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $periodo->conciliaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <tr>
                            <td><?php echo e($c->tipo); ?></td>
                            <td><?php echo e($c->referencia); ?></td>
                            <td><?php echo e(number_format((float) $c->saldo_contable, 2)); ?></td>
                            <td><?php echo e(number_format((float) $c->saldo_externo, 2)); ?></td>
                            <td><?php echo e(number_format((float) $c->diferencia, 2)); ?></td>
                            <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $periodo)): ?>
                                    <form method="POST" action="<?php echo e(route('revisiones.conciliaciones.destroy', [$periodo, $c])); ?>" class="d-inline"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="btn btn-sm btn-outline-danger">&times;</button></form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade p-3" id="tab-hallazgos">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $periodo->hallazgos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="alert alert-<?php echo e($h->severidad->value === 'critico' ? 'danger' : ($h->severidad->value === 'advertencia' ? 'warning' : 'info')); ?> py-2">
                    <strong><?php echo e($h->titulo); ?></strong> — <?php echo e($h->descripcion); ?>

                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($periodo->hallazgos->isEmpty()): ?>
                <p class="text-body-secondary mb-0">No hay hallazgos registrados.</p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="tab-pane fade p-3" id="tab-ajustes">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $periodo)): ?>
                <form method="POST" action="<?php echo e(route('revisiones.ajustes.store', $periodo)); ?>" class="row g-2 mb-3">
                    <?php echo csrf_field(); ?>
                    <div class="col-md-3">
                        <input name="codigo_cuenta" class="form-control" list="catalogo-cuentas-ajuste" placeholder="Código de cuenta" required autocomplete="off">
                        <datalist id="catalogo-cuentas-ajuste">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $cuentasCatalogo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuenta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <option value="<?php echo e($cuenta->codigo); ?>"><?php echo e($cuenta->nombre); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </datalist>
                    </div>
                    <div class="col-md-2"><input name="monto" type="number" step="0.01" class="form-control" placeholder="Monto" required></div>
                    <div class="col-md-5"><input name="descripcion" class="form-control" placeholder="Descripción" required></div>
                    <div class="col-md-2"><button class="btn btn-primary w-100">Proponer</button></div>
                </form>
            <?php endif; ?>
            <table class="table table-sm">
                <thead><tr><th>Cuenta</th><th>Monto</th><th>Estado</th><th>Propuesto por</th><th></th></tr></thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $periodo->ajustes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ajuste): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <tr>
                            <td><?php echo e($ajuste->codigo_cuenta); ?></td>
                            <td><?php echo e(number_format((float) $ajuste->monto, 2)); ?></td>
                            <td><?php echo e($ajuste->estado); ?></td>
                            <td><?php echo e($ajuste->usuario?->name); ?></td>
                            <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('flujo', $periodo)): ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ajuste->estado === 'propuesto'): ?>
                                        <form method="POST" action="<?php echo e(route('revisiones.ajustes.estado', [$periodo, $ajuste])); ?>" class="d-inline"><?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?><input type="hidden" name="estado" value="aprobado"><button class="btn btn-sm btn-success">Aprobar</button></form>
                                        <form method="POST" action="<?php echo e(route('revisiones.ajustes.estado', [$periodo, $ajuste])); ?>" class="d-inline"><?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?><input type="hidden" name="estado" value="rechazado"><button class="btn btn-sm btn-outline-danger">Rechazar</button></form>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade p-3" id="tab-kpis">
            <?php $kpis = $periodo->kpis ?? []; ?>
            <ul class="list-unstyled mb-0">
                <li>Liquidez corriente: <strong><?php echo e($kpis['liquidez_corriente'] ?? '—'); ?></strong></li>
                <li>Endeudamiento: <strong><?php echo e($kpis['endeudamiento'] ?? '—'); ?></strong></li>
                <li>Capital de trabajo: <strong><?php echo e(isset($kpis['capital_trabajo']) ? number_format($kpis['capital_trabajo'], 2) : '—'); ?></strong></li>
            </ul>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! empty($kpis['alertas'])): ?>
                <p class="mt-2 text-danger small mb-0">Alertas: <?php echo e(implode(', ', $kpis['alertas'])); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="tab-pane fade p-3" id="tab-historial">
            <ul class="list-group list-group-flush">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $periodo->historial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <li class="list-group-item small">
                        <?php echo e($evento->created_at?->format('d/m/Y H:i')); ?> — <?php echo e($evento->usuario?->name); ?>: <?php echo e($evento->accion); ?>

                        (<?php echo e($evento->estado_anterior ?? '—'); ?> → <?php echo e($evento->estado_nuevo); ?>)
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($evento->comentario): ?><br><em><?php echo e($evento->comentario); ?></em><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </li>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </ul>
        </div>
    </div>

    <?php echo $__env->make('revisiones.partials.diagrama', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/pages/revision-show.js'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/revisiones/show.blade.php ENDPATH**/ ?>