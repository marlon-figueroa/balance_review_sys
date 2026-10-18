<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Revisión <?php echo e($periodo->etiquetaPeriodo()); ?></title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1 { font-size: 18px; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #ccc; padding: 4px 6px; text-align: left; }
        th { background: #f5f5f5; }
    </style>
</head>
<body>
    <h1>Informe de revisión de balance — <?php echo e($periodo->etiquetaPeriodo()); ?></h1>
    <p>Estado: <?php echo e($periodo->estado->etiqueta()); ?> | Certificado: <?php echo e($periodo->certificado_at?->format('d/m/Y') ?? '—'); ?></p>

    <h2>Resumen contable</h2>
    <p>Activo: <?php echo e(number_format((float) $periodo->total_activo, 2)); ?> |
       Pasivo: <?php echo e(number_format((float) $periodo->total_pasivo, 2)); ?> |
       Patrimonio: <?php echo e(number_format((float) $periodo->total_patrimonio, 2)); ?></p>

    <h2>Hallazgos</h2>
    <table>
        <thead><tr><th>Severidad</th><th>Título</th><th>Descripción</th></tr></thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $periodo->hallazgos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <tr>
                    <td><?php echo e($h->severidad->value); ?></td>
                    <td><?php echo e($h->titulo); ?></td>
                    <td><?php echo e($h->descripcion); ?></td>
                </tr>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </tbody>
    </table>

    <h2>KPIs</h2>
    <?php $kpis = $periodo->kpis ?? []; ?>
    <ul>
        <li>Liquidez corriente: <?php echo e($kpis['liquidez_corriente'] ?? '—'); ?></li>
        <li>Endeudamiento: <?php echo e($kpis['endeudamiento'] ?? '—'); ?></li>
        <li>Capital de trabajo: <?php echo e(isset($kpis['capital_trabajo']) ? number_format($kpis['capital_trabajo'], 2) : '—'); ?></li>
    </ul>

    <h2>Ajustes aprobados</h2>
    <table>
        <thead><tr><th>Cuenta</th><th>Monto</th><th>Descripción</th></tr></thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $periodo->ajustes->where('estado', 'aprobado'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ajuste): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <tr>
                    <td><?php echo e($ajuste->codigo_cuenta); ?></td>
                    <td><?php echo e(number_format((float) $ajuste->monto, 2)); ?></td>
                    <td><?php echo e($ajuste->descripcion); ?></td>
                </tr>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/revisiones/pdf.blade.php ENDPATH**/ ?>