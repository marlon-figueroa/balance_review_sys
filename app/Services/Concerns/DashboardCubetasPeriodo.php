<?php

namespace App\Services\Concerns;

use Illuminate\Support\Carbon;

trait DashboardCubetasPeriodo
{
    protected const DASHBOARD_SEMANAS = 12;

    protected const DASHBOARD_MESES = 12;

    protected const DASHBOARD_ANIOS = 5;

    /**
     * @return list<array{inicio: string, fin: string, etiqueta: string}>
     */
    protected function cubetasPeriodo(string $periodo, Carbon $hoy): array
    {
        $cubetas = match ($periodo) {
            'semanal' => collect(range(self::DASHBOARD_SEMANAS - 1, 0))->map(function (int $atras) use ($hoy) {
                $inicio = $hoy->copy()->startOfWeek(Carbon::MONDAY)->subWeeks($atras);

                return [
                    'inicio' => $inicio->toDateString(),
                    'fin' => $inicio->copy()->endOfWeek(Carbon::SUNDAY)->toDateString(),
                    'etiqueta' => $inicio->translatedFormat('d M'),
                ];
            }),
            'mensual' => collect(range(self::DASHBOARD_MESES - 1, 0))->map(function (int $atras) use ($hoy) {
                $inicio = $hoy->copy()->startOfMonth()->subMonths($atras);

                return [
                    'inicio' => $inicio->toDateString(),
                    'fin' => $inicio->copy()->endOfMonth()->toDateString(),
                    'etiqueta' => $inicio->translatedFormat('M Y'),
                ];
            }),
            'anual' => collect(range(self::DASHBOARD_ANIOS - 1, 0))->map(function (int $atras) use ($hoy) {
                $inicio = $hoy->copy()->startOfYear()->subYears($atras);

                return [
                    'inicio' => $inicio->toDateString(),
                    'fin' => $inicio->copy()->endOfYear()->toDateString(),
                    'etiqueta' => $inicio->format('Y'),
                ];
            }),
            default => collect(),
        };

        return $cubetas->all();
    }

    /**
     * @param  list<array{inicio: string, fin: string, etiqueta: string}>  $cubetas
     */
    protected function indiceCubetaPeriodo(string $dia, array $cubetas): ?int
    {
        foreach ($cubetas as $indice => $cubeta) {
            if ($dia >= $cubeta['inicio'] && $dia <= $cubeta['fin']) {
                return $indice;
            }
        }

        return null;
    }
}
