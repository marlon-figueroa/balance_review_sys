<?php
    $etiquetaEntidad = $etiquetaEntidad ?? 'revisión de balance';
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($diagrama['pasos'] === []): ?>
    <p class="text-body-secondary mb-0">Este periodo aún no tiene pasos registrados en el historial.</p>
<?php else: ?>
    <p class="small text-body-secondary">
        Máquina de estados del flujo de <?php echo e($etiquetaEntidad); ?>. Cada estado visitado muestra los eventos que lo alcanzaron. Las flechas punteadas son transiciones posibles que aún no ocurren.
    </p>
    <div id="diagrama-estados" class="diagrama-estados" role="img" aria-label="Diagrama de estados UML del periodo de revisión"></div>
    <script type="application/json" id="diagrama-estados-datos"><?php echo json_encode($diagrama, 15, 512) ?></script>

    <div class="table-responsive mt-3">
        <table class="table table-sm align-middle small mb-0">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Transición</th>
                    <th scope="col">Evento</th>
                    <th scope="col">Actor</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $diagrama['pasos']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <tr class="<?php echo \Illuminate\Support\Arr::toCssClasses(['table-active' => $paso['actual']]); ?>">
                        <td><?php echo e($paso['numero']); ?></td>
                        <td class="text-nowrap"><?php echo e($paso['origenNombre']); ?> <i class="bi bi-arrow-right"></i> <?php echo e($paso['etapa']); ?></td>
                        <td><?php echo e($paso['accion']); ?></td>
                        <td><?php echo e($paso['actor']); ?></td>
                        <td>
                            <span class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'diagrama-leyenda',
                                'diagrama-leyenda--registrador' => $paso['rol'] === 'Registrador',
                                'diagrama-leyenda--revisor' => $paso['rol'] !== 'Registrador',
                            ]); ?>"></span>
                            <?php echo e($paso['rol']); ?>

                        </td>
                        <td class="text-nowrap"><?php echo e($paso['fecha']); ?></td>
                        <td class="<?php echo \Illuminate\Support\Arr::toCssClasses(['text-danger' => $paso['rechazo'], 'text-body-secondary' => ! $paso['rechazo']]); ?>"><?php echo e($paso['observaciones'] ?? '—'); ?></td>
                    </tr>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/partials/diagrama-estados-contenido.blade.php ENDPATH**/ ?>