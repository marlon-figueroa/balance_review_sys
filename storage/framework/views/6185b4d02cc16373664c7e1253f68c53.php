<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Bitácora</title>
    <style>
        @page { margin: 90px 30px 60px 30px; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 9px; color: #212529; }
        header { position: fixed; top: -70px; left: 0; right: 0; height: 60px; border-bottom: 2px solid <?php echo e(config('branding.primary')); ?>; }
        header h1 { margin: 0; font-size: 16px; color: <?php echo e(config('branding.primary')); ?>; }
        header .meta { font-size: 9px; color: #6c757d; }
        footer { position: fixed; bottom: -40px; left: 0; right: 0; height: 30px; font-size: 8px; color: #6c757d; text-align: right; }
        footer .page:after { content: counter(page); }
        .filtros { margin-bottom: 8px; }
        .filtros span { display: inline-block; background: #e9ecef; padding: 2px 6px; border-radius: 3px; margin-right: 4px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: <?php echo e(config('branding.primary')); ?>; color: #fff; text-align: left; padding: 5px; }
        td { padding: 4px 5px; border-bottom: 1px solid #dee2e6; vertical-align: top; }
        tr:nth-child(even) td { background: #f8f9fa; }
        .ok { color: #198754; font-weight: bold; }
        .error { color: #dc3545; font-weight: bold; }
        .text-center { text-align: center; }
        .aviso { color: #997404; margin-top: 6px; }
    </style>
</head>
<body>
    <header>
        <h1><?php echo e(config('app.name')); ?> &mdash; Bitácora</h1>
        <div class="meta">Generado el <?php echo e(now()->format('d/m/Y H:i')); ?> por <?php echo e(auth()->user()->name); ?></div>
    </header>

    <footer>
        Página <span class="page"></span>
    </footer>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($filtros): ?>
        <div class="filtros">
            <strong>Filtros:</strong>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $filtros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $etiqueta => $valor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <span><?php echo e($etiqueta); ?>: <?php echo e($valor); ?></span>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <table>
        <thead>
            <tr>
                <th style="width: 11%">Fecha</th>
                <th style="width: 14%">Usuario</th>
                <th style="width: 10%">Tipo</th>
                <th style="width: 9%">Módulo</th>
                <th style="width: 16%">Acción</th>
                <th style="width: 25%">Descripción</th>
                <th style="width: 10%">IP</th>
                <th style="width: 5%">Res.</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <tr>
                    <td><?php echo e($registro->created_at?->format('d/m/Y H:i:s')); ?></td>
                    <td><?php echo e($registro->usuario?->name ?? 'Invitado / sistema'); ?></td>
                    <td><?php echo e(\App\Models\Bitacora::etiquetaTipoAccion($registro->tipo_accion)); ?></td>
                    <td><?php echo e($registro->modulo); ?></td>
                    <td><?php echo e($registro->accion); ?></td>
                    <td><?php echo e($registro->descripcion); ?></td>
                    <td><?php echo e($registro->ip_address); ?></td>
                    <td class="text-center">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($registro->exitoso): ?>
                            <span class="ok">OK</span>
                        <?php else: ?>
                            <span class="error">Falló</span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </td>
                </tr>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <tr>
                    <td colspan="8" class="text-center">No hay registros que coincidan con los filtros.</td>
                </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>

    <p style="margin-top: 8px;"><strong>Total:</strong> <?php echo e($registros->count()); ?> registro(s)</p>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($registros->count() >= $limite): ?>
        <p class="aviso">Se muestran solo los <?php echo e($limite); ?> registros más recientes; refine los filtros para acotar el reporte.</p>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</body>
</html>
<?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/pdf/bitacora.blade.php ENDPATH**/ ?>