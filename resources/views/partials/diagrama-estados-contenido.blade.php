@php
    $etiquetaEntidad = $etiquetaEntidad ?? 'revisión de balance';
@endphp

@if ($diagrama['pasos'] === [])
    <p class="text-body-secondary mb-0">Este periodo aún no tiene pasos registrados en el historial.</p>
@else
    <p class="small text-body-secondary">
        Máquina de estados del flujo de {{ $etiquetaEntidad }}. Cada estado visitado muestra los eventos que lo alcanzaron. Las flechas punteadas son transiciones posibles que aún no ocurren.
    </p>
    <div id="diagrama-estados" class="diagrama-estados" role="img" aria-label="Diagrama de estados UML del periodo de revisión"></div>
    <script type="application/json" id="diagrama-estados-datos">@json($diagrama)</script>

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
                @foreach ($diagrama['pasos'] as $paso)
                    <tr @class(['table-active' => $paso['actual']])>
                        <td>{{ $paso['numero'] }}</td>
                        <td class="text-nowrap">{{ $paso['origenNombre'] }} <i class="bi bi-arrow-right"></i> {{ $paso['etapa'] }}</td>
                        <td>{{ $paso['accion'] }}</td>
                        <td>{{ $paso['actor'] }}</td>
                        <td>
                            <span @class([
                                'diagrama-leyenda',
                                'diagrama-leyenda--registrador' => $paso['rol'] === 'Registrador',
                                'diagrama-leyenda--revisor' => $paso['rol'] !== 'Registrador',
                            ])></span>
                            {{ $paso['rol'] }}
                        </td>
                        <td class="text-nowrap">{{ $paso['fecha'] }}</td>
                        <td @class(['text-danger' => $paso['rechazo'], 'text-body-secondary' => ! $paso['rechazo']])>{{ $paso['observaciones'] ?? '—' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
