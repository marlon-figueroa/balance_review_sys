<?php
    $usuarioEtiqueta = $bitacora->usuario
        ? "{$bitacora->usuario->name} ({$bitacora->usuario->email})"
        : 'Invitado / sistema';
    $modeloEtiqueta = $bitacora->modelo_type
        ? class_basename($bitacora->modelo_type)." #{$bitacora->modelo_id}"
        : null;
    $clienteEtiqueta = collect([$bitacora->navegador, $bitacora->sistema_operativo, $bitacora->dispositivo])
        ->filter()
        ->implode(' · ');
    $peticion = $bitacora->metodo_http ? "{$bitacora->metodo_http} /{$bitacora->ruta}" : null;
    $camposCambio = collect(array_keys($bitacora->valores_anteriores ?? []))
        ->merge(array_keys($bitacora->valores_nuevos ?? []))
        ->unique()
        ->values();
?>

<table class="table table-sm align-middle mb-0">
    <tbody>
        <tr><th class="text-nowrap w-25">Fecha</th><td><?php echo e($bitacora->created_at?->format('d/m/Y H:i:s') ?? '—'); ?></td></tr>
        <tr><th>Usuario</th><td><?php echo e($usuarioEtiqueta); ?></td></tr>
        <tr><th>Tipo de acción</th><td><?php echo $__env->make('admin.bitacora.partials.tipo', ['tipo' => $bitacora->tipo_accion], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></td></tr>
        <tr><th>Acción</th><td><?php echo e($bitacora->accion); ?></td></tr>
        <tr><th>Descripción</th><td><?php echo e($bitacora->descripcion ?: '—'); ?></td></tr>
        <tr><th>Módulo</th><td><?php echo e($bitacora->modulo ?: '—'); ?></td></tr>
        <tr><th>Registro afectado</th><td><?php echo e($modeloEtiqueta ?: '—'); ?></td></tr>
        <tr><th>Resultado</th><td><?php echo $__env->make('admin.bitacora.partials.resultado', ['exitoso' => $bitacora->exitoso], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php echo e($bitacora->exitoso ? 'Exitoso' : 'Fallido'); ?></td></tr>
        <tr><th>Error</th><td><?php echo e($bitacora->error_mensaje ?: '—'); ?></td></tr>
        <tr><th>Código HTTP</th><td><?php echo e($bitacora->status_code ?? '—'); ?></td></tr>
        <tr><th>Petición</th><td><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($peticion): ?><code><?php echo e($peticion); ?></code><?php else: ?>—<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></td></tr>
        <tr><th>IP</th><td><?php echo e($bitacora->ip_address ?: '—'); ?></td></tr>
        <tr><th>Navegador / SO / dispositivo</th><td><?php echo e($clienteEtiqueta ?: '—'); ?></td></tr>
        <tr><th>Tiempo de ejecución</th><td><?php echo e($bitacora->tiempo_ejecucion !== null ? "{$bitacora->tiempo_ejecucion} ms" : '—'); ?></td></tr>
        <tr><th>Etiquetas</th><td><?php echo e($bitacora->tags ?: '—'); ?></td></tr>
    </tbody>
</table>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($camposCambio->isNotEmpty()): ?>
    <h6 class="mt-4"><i class="bi bi-arrow-left-right me-1"></i> Cambios</h6>
    <div class="table-responsive">
        <table class="table table-sm table-bordered align-middle">
            <thead class="text-body-secondary">
                <tr><th>Campo</th><th>Valor anterior</th><th>Valor nuevo</th></tr>
            </thead>
            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $camposCambio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php
                        $anterior = $bitacora->valores_anteriores[$campo] ?? null;
                        $nuevo = $bitacora->valores_nuevos[$campo] ?? null;
                        $formatear = fn ($valor) => match (true) {
                            $valor === null || $valor === '' => '—',
                            is_array($valor) => json_encode($valor, JSON_UNESCAPED_UNICODE),
                            default => (string) $valor,
                        };
                    ?>
                    <tr>
                        <th class="text-nowrap"><?php echo e($campo); ?></th>
                        <td class="text-danger-emphasis"><?php echo e($formatear($anterior)); ?></td>
                        <td class="text-success-emphasis"><?php echo e($formatear($nuevo)); ?></td>
                    </tr>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bitacora->datos_adicionales): ?>
    <h6 class="mt-4"><i class="bi bi-info-circle me-1"></i> Datos adicionales</h6>
    <pre class="bg-body-tertiary p-2 rounded small mb-0"><?php echo e(json_encode($bitacora->datos_adicionales, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)); ?></pre>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bitacora->user_agent): ?>
    <p class="small text-muted mt-3 mb-0 text-break"><?php echo e($bitacora->user_agent); ?></p>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/admin/bitacora/partials/detalle-registro.blade.php ENDPATH**/ ?>