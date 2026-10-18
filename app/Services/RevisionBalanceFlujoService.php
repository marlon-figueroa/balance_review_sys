<?php

namespace App\Services;

use App\Enums\EstadoPeriodoRevision;
use App\Models\PeriodoRevision;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RevisionBalanceFlujoService
{
    public const ACCIONES = [
        'enviar' => EstadoPeriodoRevision::EnRevision,
        'aprobar' => EstadoPeriodoRevision::Aprobado,
        'rechazar' => EstadoPeriodoRevision::Borrador,
        'certificar' => EstadoPeriodoRevision::Certificado,
    ];

    public const ETIQUETAS = [
        'enviar' => 'Enviar a revisión',
        'aprobar' => 'Aprobar',
        'rechazar' => 'Rechazar',
        'certificar' => 'Certificar balance',
    ];

    public function ejecutar(PeriodoRevision $periodo, User $usuario, string $accion, ?string $comentario = null): PeriodoRevision
    {
        if (! array_key_exists($accion, self::ACCIONES)) {
            throw ValidationException::withMessages(['accion' => 'Acción de flujo no válida.']);
        }

        $destino = self::ACCIONES[$accion];
        $origen = $periodo->estado;

        if (! $origen->puedeTransicionarA($destino)) {
            throw ValidationException::withMessages([
                'accion' => "No se puede {$accion} desde el estado {$origen->etiqueta()}.",
            ]);
        }

        if ($accion === 'enviar' && ! $periodo->integridad_ok) {
            throw ValidationException::withMessages([
                'accion' => 'Corrija la integridad contable antes de enviar a revisión.',
            ]);
        }

        if (in_array($accion, ['aprobar', 'certificar'], true) && $usuario->id === $periodo->usuario_creador_id) {
            throw ValidationException::withMessages([
                'accion' => 'Segregación de funciones: quien registró no puede aprobar ni certificar.',
            ]);
        }

        if ($accion === 'rechazar' && ($comentario === null || trim($comentario) === '')) {
            throw ValidationException::withMessages([
                'comentario' => 'Indique el motivo del rechazo.',
            ]);
        }

        return DB::transaction(function () use ($periodo, $usuario, $accion, $destino, $origen, $comentario) {
            $periodo->estado = $destino;
            $periodo->comentario_rechazo = $accion === 'rechazar' ? $comentario : null;

            if ($accion === 'certificar') {
                $periodo->certificado_at = now();
                $periodo->certificado_por_id = $usuario->id;
            }

            $periodo->save();

            $periodo->historial()->create([
                'usuario_id' => $usuario->id,
                'accion' => $accion,
                'estado_anterior' => $origen->value,
                'estado_nuevo' => $destino->value,
                'comentario' => $comentario,
            ]);

            return $periodo->fresh();
        });
    }

    /**
     * @return list<string>
     */
    public function accionesDisponibles(PeriodoRevision $periodo, User $usuario): array
    {
        $acciones = [];

        foreach (self::ACCIONES as $nombre => $destino) {
            if (! $periodo->estado->puedeTransicionarA($destino)) {
                continue;
            }

            if ($nombre === 'enviar' && ! $usuario->can('revisiones.enviar')) {
                continue;
            }
            if ($nombre === 'aprobar' && ! $usuario->canAny(['revisiones.revisar', 'revisiones.aprobar'])) {
                continue;
            }
            if ($nombre === 'rechazar' && ! $usuario->can('revisiones.revisar')) {
                continue;
            }
            if ($nombre === 'certificar' && ! $usuario->can('revisiones.certificar')) {
                continue;
            }

            if (in_array($nombre, ['aprobar', 'certificar'], true) && $usuario->id === $periodo->usuario_creador_id) {
                continue;
            }

            $acciones[] = $nombre;
        }

        return $acciones;
    }
}
