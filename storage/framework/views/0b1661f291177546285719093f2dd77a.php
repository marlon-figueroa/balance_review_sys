<?php
    $usuarioEtiqueta = $sesion->user
        ? "{$sesion->user->name} ({$sesion->user->email})"
        : '—';
    $inicioEstimado = $eventos->first()?->created_at;
    $iconoTipo = fn (string $codigo) => match ($codigo) {
        'crear' => 'plus-circle',
        'actualizar' => 'pencil-square',
        'eliminar' => 'trash',
        'login' => 'box-arrow-in-right',
        'logout' => 'box-arrow-right',
        'impersonar' => 'person-bounding-box',
        'fin_impersonacion' => 'person-check',
        'login_fallido' => 'shield-x',
        'bloqueo' => 'lock',
        'personalizada' => 'gear',
        'sesion_invalidada' => 'box-arrow-right',
        default => 'dot',
    };
?>

<dl class="row small mb-4">
    <dt class="col-sm-3">Usuario</dt>
    <dd class="col-sm-9"><?php echo e($usuarioEtiqueta); ?></dd>
    <dt class="col-sm-3">IP</dt>
    <dd class="col-sm-9"><?php echo e($sesion->ip_address ?: '—'); ?></dd>
    <dt class="col-sm-3">Cliente</dt>
    <dd class="col-sm-9"><?php echo e($sesion->resumenCliente() ?: '—'); ?></dd>
    <dt class="col-sm-3">Inicio (estimado)</dt>
    <dd class="col-sm-9"><?php echo e($inicioEstimado?->format('d/m/Y H:i:s') ?? '—'); ?></dd>
    <dt class="col-sm-3">Última actividad</dt>
    <dd class="col-sm-9"><?php echo e($sesion->last_activity_at?->format('d/m/Y H:i:s') ?? '—'); ?></dd>
</dl>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($eventos->isEmpty()): ?>
    <p class="text-muted mb-0">No hay eventos de bitácora asociados a esta sesión.</p>
<?php else: ?>
    <ol class="sesion-timeline mb-0">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $eventos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <li class="sesion-timeline__item <?php if(! $evento->exitoso): ?> sesion-timeline__item--error <?php endif; ?>">
                <span class="sesion-timeline__marker" aria-hidden="true"></span>
                <div class="sesion-timeline__time"><?php echo e($evento->created_at?->format('d/m/Y H:i:s')); ?></div>
                <div class="sesion-timeline__title">
                    <i class="bi bi-<?php echo e($iconoTipo($evento->tipo_accion)); ?> me-1"></i>
                    <?php echo e(\App\Models\Bitacora::etiquetaTipoAccion($evento->tipo_accion)); ?> — <?php echo e($evento->accion); ?>

                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($evento->descripcion): ?>
                    <div><?php echo e($evento->descripcion); ?></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <div class="sesion-timeline__meta">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($evento->modulo): ?>
                        <span class="me-2"><?php echo e($evento->modulo); ?></span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($evento->ruta): ?>
                        <code>/<?php echo e($evento->ruta); ?></code>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    · <?php echo e($evento->exitoso ? 'Exitoso' : 'Fallido'); ?>

                    · <a href="<?php echo e(route('admin.bitacora.show', $evento)); ?>" class="link-primary">Ver registro</a>
                </div>
            </li>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </ol>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/admin/bitacora/partials/timeline-sesion.blade.php ENDPATH**/ ?>