<?php

namespace App\Services;

use App\Enums\EstadoPeriodoRevision;
use App\Models\PeriodoRevision;
use App\Models\RevisionHistorial;

class RevisionBalanceDiagramaService
{
    /** @var list<string> */
    private const ACCIONES_REGISTRADOR = ['crear', 'enviar'];

    public const INICIO = 'inicio';

    public const FIN = 'fin';

    /**
     * @return array{estados: list<array<string, mixed>>, transiciones: list<array<string, mixed>>, pasos: list<array<string, mixed>>, ubicacion: array<string, array{0: int, 1: int}>}
     */
    public function diagrama(PeriodoRevision $periodo): array
    {
        $pasos = $this->pasos($periodo);
        $visitados = array_filter(array_column($pasos, 'destino'));
        $eventosPorEstado = [];

        foreach ($pasos as $paso) {
            if ($paso['destino'] === null) {
                continue;
            }

            $eventosPorEstado[$paso['destino']][] = [
                'numero' => $paso['numero'],
                'accion' => $paso['accion'],
                'actor' => $paso['actor'],
                'fecha' => $paso['fecha'],
                'observaciones' => $paso['observaciones'],
                'rechazo' => $paso['rechazo'],
            ];
        }

        $estados = array_map(fn (EstadoPeriodoRevision $estado) => [
            'id' => $estado->value,
            'nombre' => $estado->etiqueta(),
            'color' => $estado->hex(),
            'visitado' => in_array($estado->value, $visitados, true),
            'actual' => $estado === $periodo->estado,
            'eventos' => $eventosPorEstado[$estado->value] ?? [],
        ], EstadoPeriodoRevision::cases());

        $transiciones = [];
        $agregar = function (string $origen, string $destino) use (&$transiciones): string {
            $clave = "{$origen}>{$destino}";
            $transiciones[$clave] ??= [
                'origen' => $origen,
                'destino' => $destino,
                'eventos' => [],
                'pasos' => [],
                'rechazo' => false,
            ];

            return $clave;
        };

        $agregar(self::INICIO, EstadoPeriodoRevision::Borrador->value);

        foreach (EstadoPeriodoRevision::cases() as $estado) {
            $destinos = $estado->transicionesPermitidas();

            if ($destinos === []) {
                $agregar($estado->value, self::FIN);
            }

            foreach ($destinos as $destino) {
                $agregar($estado->value, $destino->value);
            }
        }

        foreach ($pasos as $paso) {
            if ($paso['destino'] === null) {
                continue;
            }

            $clave = $agregar($paso['origen'], $paso['destino']);
            $transiciones[$clave]['pasos'][] = $paso['numero'];
            $transiciones[$clave]['rechazo'] = $transiciones[$clave]['rechazo'] || $paso['rechazo'];

            if (! in_array($paso['evento'], $transiciones[$clave]['eventos'], true)) {
                $transiciones[$clave]['eventos'][] = $paso['evento'];
            }
        }

        return [
            'estados' => $estados,
            'transiciones' => array_values($transiciones),
            'pasos' => $pasos,
            'ubicacion' => [
                self::INICIO => [0, 0],
                EstadoPeriodoRevision::Borrador->value => [1, 0],
                EstadoPeriodoRevision::EnRevision->value => [2, 0],
                EstadoPeriodoRevision::Aprobado->value => [3, 0],
                EstadoPeriodoRevision::Certificado->value => [4, 0],
                self::FIN => [5, 0],
            ],
        ];
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function pasos(PeriodoRevision $periodo): array
    {
        $periodo->loadMissing(['historial.usuario']);

        $eventos = $periodo->historial
            ->sortBy([['created_at', 'asc'], ['id', 'asc']])
            ->values();

        $ultimo = $eventos->count() - 1;

        return $eventos
            ->map(function (RevisionHistorial $evento, int $indice) use ($ultimo) {
                $estadoAnterior = $evento->estado_anterior !== null
                    ? EstadoPeriodoRevision::tryFrom($evento->estado_anterior)
                    : null;
                $estadoNuevo = EstadoPeriodoRevision::tryFrom($evento->estado_nuevo);
                $esRegistrador = in_array($evento->accion, self::ACCIONES_REGISTRADOR, true);

                return [
                    'numero' => $indice + 1,
                    'origen' => $estadoAnterior?->value ?? self::INICIO,
                    'origenNombre' => $estadoAnterior?->etiqueta() ?? 'Inicio',
                    'destino' => $estadoNuevo?->value,
                    'etapa' => $estadoNuevo?->etiqueta() ?? '—',
                    'color' => $estadoNuevo?->hex() ?? '#6c757d',
                    'evento' => $evento->accion,
                    'accion' => $this->etiquetaAccion($evento->accion),
                    'actor' => $evento->usuario?->name ?? 'Usuario eliminado',
                    'rol' => $esRegistrador ? 'Registrador' : 'Revisor / Aprobador',
                    'fecha' => $evento->created_at?->format('d/m/Y H:i'),
                    'observaciones' => $evento->comentario,
                    'rechazo' => $evento->accion === 'rechazar',
                    'actual' => $indice === $ultimo,
                ];
            })
            ->all();
    }

    private function etiquetaAccion(string $accion): string
    {
        return match ($accion) {
            'crear' => 'Crear periodo',
            default => RevisionBalanceFlujoService::ETIQUETAS[$accion] ?? ucfirst(str_replace('_', ' ', $accion)),
        };
    }
}
