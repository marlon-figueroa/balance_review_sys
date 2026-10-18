<?php
    $mensajes = collect(['error', 'warning', 'success', 'info', 'status'])
        ->filter(fn ($tipo) => filled(session($tipo)))
        ->map(fn ($tipo) => ['type' => $tipo === 'status' ? 'success' : $tipo, 'message' => (string) session($tipo)])
        ->values();

    if ($errors->any()) {
        $mensajes->push([
            'type' => 'warning',
            'message' => $errors->count() === 1
                ? 'Revise el campo marcado en el formulario.'
                : "Revise los {$errors->count()} campos marcados en el formulario.",
        ]);
    }
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($mensajes->isNotEmpty()): ?>
    
    <script type="application/json" id="flash-messages"><?php echo json_encode($mensajes, 15, 512) ?></script>

    <noscript>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $mensajes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mensaje): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <div class="alert alert-<?php echo e($mensaje['type'] === 'error' ? 'danger' : $mensaje['type']); ?>" role="alert">
                <?php echo e($mensaje['message']); ?>

            </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </noscript>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/partials/alerts.blade.php ENDPATH**/ ?>