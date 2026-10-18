<?php
    $clases = match ($tipo) {
        'crear' => 'text-bg-success',
        'actualizar' => 'text-bg-primary',
        'eliminar' => 'text-bg-danger',
        'login' => 'text-bg-info',
        'logout' => 'text-bg-secondary',
        'impersonar' => 'text-bg-warning',
        'fin_impersonacion' => 'text-bg-secondary',
        'login_fallido' => 'text-bg-warning',
        'bloqueo' => 'bg-danger-subtle text-danger-emphasis border border-danger-subtle',
        'sesion_invalidada' => 'text-bg-dark',
        default => 'bg-body-secondary text-body-emphasis border',
    };
?>
<span class="badge <?php echo e($clases); ?>"><?php echo e(\App\Models\Bitacora::etiquetaTipoAccion($tipo)); ?></span>
<?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/admin/bitacora/partials/tipo.blade.php ENDPATH**/ ?>