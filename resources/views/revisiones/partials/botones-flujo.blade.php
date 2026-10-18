@php
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
@endphp

@if ($accionesFlujo !== [])
    <x-page-action-group label="Flujo de aprobación">
        @foreach ($accionesFlujo as $accion)
            @php([$variante, $icono] = $variantes[$accion] ?? ['nav', 'arrow-right'])
            <form method="POST" action="{{ route('revisiones.flujo', [$periodo, $accion]) }}" class="page-action-form"
                  @if ($accion === 'rechazar')
                      data-observaciones="requerida"
                      data-observaciones-campo="comentario"
                      data-observaciones-titulo="{{ \App\Services\RevisionBalanceFlujoService::ETIQUETAS[$accion] }}"
                      data-observaciones-etiqueta="Motivo del rechazo"
                      data-observaciones-placeholder="Indique qué debe corregir el registrador..."
                      data-observaciones-boton="Rechazar"
                      data-observaciones-mensaje="Indique el motivo del rechazo."
                  @elseif (isset($confirmaciones[$accion]))
                      data-confirm="{{ $confirmaciones[$accion] }}"
                      data-confirm-title="¿{{ \App\Services\RevisionBalanceFlujoService::ETIQUETAS[$accion] }}?"
                      data-confirm-button="Sí, continuar"
                  @endif>
                @csrf
                <input type="hidden" name="comentario" value="">
                <x-action-btn
                    type="submit"
                    :variant="$variante"
                    :icon="$icono"
                    :label="\App\Services\RevisionBalanceFlujoService::ETIQUETAS[$accion]"
                />
            </form>
        @endforeach
    </x-page-action-group>
@endif
