<?php

namespace App\Http\Controllers\Revisiones;

use App\Http\Controllers\Controller;
use App\Models\CuentaContable;
use App\Services\RevisionBalanceCatalogoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportCatalogoCsvController extends Controller
{
    public function __invoke(Request $request, RevisionBalanceCatalogoService $catalogo): StreamedResponse
    {
        $this->authorize('viewAny', CuentaContable::class);

        $conSaldos = $request->boolean('demo');
        $nombre = $conSaldos ? 'balanza-demostrativa.csv' : 'plantilla-catalogo-cuentas.csv';
        $contenido = $catalogo->contenidoCsvPlantilla($conSaldos);

        return response()->streamDownload(
            static fn () => print($contenido),
            $nombre,
            ['Content-Type' => 'text/csv; charset=UTF-8'],
        );
    }
}
