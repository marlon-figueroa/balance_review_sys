<?php
    $variantes = [
        'enviar' => ['success', 'send'],
        'aprobar' => ['success', 'check-circle'],
        'rechazar' => ['danger', 'x-circle'],
        'certificar' => ['success-outline', 'patch-check'],
    ];
    $confirmaciones = [
        'enviar' => 'El periodo pasará a revisión y no podrá editarse hasta que sea aprobado o rechazado.',
        'certificar' => 'El balance quedará certificado y no admitirá más cambios.',
    ];
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($accionesFlujo !== []): ?>
    <?php if (isset($component)) { $__componentOriginalb8f070ebd9b9b1550e3534b5f5c4ffbb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb8f070ebd9b9b1550e3534b5f5c4ffbb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-action-group','data' => ['label' => 'Flujo de aprobación']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-action-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Flujo de aprobación']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $accionesFlujo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <?php ([$variante, $icono] = $variantes[$accion] ?? ['nav', 'arrow-right']); ?>
            <form method="POST" action="<?php echo e(route('revisiones.flujo', [$periodo, $accion])); ?>" class="page-action-form"
                  <?php if($accion === 'rechazar'): ?>
                      data-observaciones="requerida"
                      data-observaciones-campo="comentario"
                      data-observaciones-titulo="<?php echo e(\App\Services\RevisionBalanceFlujoService::ETIQUETAS[$accion]); ?>"
                      data-observaciones-etiqueta="Motivo del rechazo"
                      data-observaciones-placeholder="Indique qué debe corregir el registrador..."
                      data-observaciones-boton="Rechazar"
                      data-observaciones-mensaje="Indique el motivo del rechazo."
                  <?php elseif(isset($confirmaciones[$accion])): ?>
                      data-confirm="<?php echo e($confirmaciones[$accion]); ?>"
                      data-confirm-title="¿<?php echo e(\App\Services\RevisionBalanceFlujoService::ETIQUETAS[$accion]); ?>?"
                      data-confirm-button="Sí, continuar"
                  <?php endif; ?>>
                <?php echo csrf_field(); ?>
                <input type="hidden" name="comentario" value="">
                <?php if (isset($component)) { $__componentOriginalea0a006b13ef86193364f165ef549f04 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalea0a006b13ef86193364f165ef549f04 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.action-btn','data' => ['type' => 'submit','variant' => $variante,'icon' => $icono,'label' => \App\Services\RevisionBalanceFlujoService::ETIQUETAS[$accion]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('action-btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','variant' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($variante),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icono),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\App\Services\RevisionBalanceFlujoService::ETIQUETAS[$accion])]); ?>
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
            </form>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
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
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/revisiones/partials/botones-flujo.blade.php ENDPATH**/ ?>