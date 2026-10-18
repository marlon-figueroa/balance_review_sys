<div class="modal fade" id="diagrama-modal" tabindex="-1" aria-labelledby="diagrama-modal-titulo" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-diagrama">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="diagrama-modal-titulo">
                    <i class="bi bi-diagram-2 me-1"></i> Diagrama de estados
                </h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                @include('partials.diagrama-estados-contenido', [
                    'diagrama' => $diagrama,
                    'etiquetaEntidad' => 'revisión de balance',
                ])
            </div>
        </div>
    </div>
</div>
