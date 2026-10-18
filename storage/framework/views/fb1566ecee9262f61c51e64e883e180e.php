<div class="tab-pane fade <?php if($activa === $clave): ?> show active <?php endif; ?>" id="pane-<?php echo e($clave); ?>" role="tabpanel" aria-labelledby="tab-<?php echo e($clave); ?>" tabindex="0">
    <div class="card">
        <div class="card-header d-flex align-items-center gap-2">
            <span><?php echo e($titulo); ?></span>
            <a href="<?php echo e($url); ?>" target="_blank" rel="noopener" class="btn btn-sm btn-outline-secondary ms-auto">
                <i data-feather="external-link"></i> Abrir en pestaña nueva
            </a>
        </div>
        
        <iframe class="panel-embebido" title="<?php echo e($titulo); ?>" data-src="<?php echo e($urlEmbebida ?? $url); ?>"></iframe>
    </div>
</div>
<?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/admin/bitacora/partials/panel-embebido.blade.php ENDPATH**/ ?>