<?php

namespace App\Services;

use App\Enums\NaturalezaCuenta;
use App\Models\LineaBalanza;
use App\Models\PeriodoRevision;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RevisionBalanceImportService
{
    public function __construct(private RevisionBalanceProcesoService $proceso) {}

    public function importarCsv(PeriodoRevision $periodo, UploadedFile $archivo): int
    {
        if (! $periodo->editable()) {
            throw ValidationException::withMessages([
                'archivo' => 'Solo se puede importar en periodos en borrador.',
            ]);
        }

        $handle = fopen($archivo->getRealPath(), 'r');
        if ($handle === false) {
            throw ValidationException::withMessages(['archivo' => 'No se pudo leer el archivo.']);
        }

        $encabezado = fgetcsv($handle);
        if ($encabezado === false) {
            fclose($handle);
            throw ValidationException::withMessages(['archivo' => 'El CSV está vacío.']);
        }

        $columnas = array_map(fn ($c) => strtolower(trim((string) $c)), $encabezado);
        $requeridas = ['codigo_cuenta', 'nombre', 'naturaleza', 'debe', 'haber', 'saldo'];
        foreach ($requeridas as $col) {
            if (! in_array($col, $columnas, true)) {
                fclose($handle);
                throw ValidationException::withMessages([
                    'archivo' => "Falta la columna {$col} en el encabezado del CSV.",
                ]);
            }
        }

        $indice = array_flip($columnas);
        $lineas = [];

        while (($fila = fgetcsv($handle)) !== false) {
            if ($fila === [null] || trim(implode('', $fila)) === '') {
                continue;
            }

            $naturaleza = NaturalezaCuenta::tryFrom(strtolower(trim((string) ($fila[$indice['naturaleza']] ?? ''))));
            if ($naturaleza === null) {
                fclose($handle);
                throw ValidationException::withMessages([
                    'archivo' => 'Naturaleza inválida; use activo, pasivo o patrimonio.',
                ]);
            }

            $lineas[] = [
                'codigo_cuenta' => trim((string) $fila[$indice['codigo_cuenta']]),
                'nombre' => trim((string) $fila[$indice['nombre']]),
                'naturaleza' => $naturaleza,
                'debe' => (float) str_replace(',', '', (string) ($fila[$indice['debe']] ?? 0)),
                'haber' => (float) str_replace(',', '', (string) ($fila[$indice['haber']] ?? 0)),
                'saldo' => (float) str_replace(',', '', (string) ($fila[$indice['saldo']] ?? 0)),
            ];
        }

        fclose($handle);

        if ($lineas === []) {
            throw ValidationException::withMessages(['archivo' => 'No hay filas de datos en el CSV.']);
        }

        return DB::transaction(function () use ($periodo, $lineas) {
            $periodo->lineasBalanza()->delete();

            foreach ($lineas as $datos) {
                $periodo->lineasBalanza()->create($datos);
            }

            $this->proceso->ejecutar($periodo->fresh(['lineasBalanza', 'conciliaciones']));

            return count($lineas);
        });
    }
}
