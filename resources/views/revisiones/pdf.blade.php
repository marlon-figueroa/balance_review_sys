<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Revisión {{ $periodo->etiquetaPeriodo() }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1 { font-size: 18px; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #ccc; padding: 4px 6px; text-align: left; }
        th { background: #f5f5f5; }
    </style>
</head>
<body>
    <h1>Informe de revisión de balance — {{ $periodo->etiquetaPeriodo() }}</h1>
    <p>Estado: {{ $periodo->estado->etiqueta() }} | Certificado: {{ $periodo->certificado_at?->format('d/m/Y') ?? '—' }}</p>

    <h2>Resumen contable</h2>
    <p>Activo: {{ number_format((float) $periodo->total_activo, 2) }} |
       Pasivo: {{ number_format((float) $periodo->total_pasivo, 2) }} |
       Patrimonio: {{ number_format((float) $periodo->total_patrimonio, 2) }}</p>

    <h2>Hallazgos</h2>
    <table>
        <thead><tr><th>Severidad</th><th>Título</th><th>Descripción</th></tr></thead>
        <tbody>
            @foreach ($periodo->hallazgos as $h)
                <tr>
                    <td>{{ $h->severidad->value }}</td>
                    <td>{{ $h->titulo }}</td>
                    <td>{{ $h->descripcion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>KPIs</h2>
    @php $kpis = $periodo->kpis ?? []; @endphp
    <ul>
        <li>Liquidez corriente: {{ $kpis['liquidez_corriente'] ?? '—' }}</li>
        <li>Endeudamiento: {{ $kpis['endeudamiento'] ?? '—' }}</li>
        <li>Capital de trabajo: {{ isset($kpis['capital_trabajo']) ? number_format($kpis['capital_trabajo'], 2) : '—' }}</li>
    </ul>

    <h2>Ajustes aprobados</h2>
    <table>
        <thead><tr><th>Cuenta</th><th>Monto</th><th>Descripción</th></tr></thead>
        <tbody>
            @foreach ($periodo->ajustes->where('estado', 'aprobado') as $ajuste)
                <tr>
                    <td>{{ $ajuste->codigo_cuenta }}</td>
                    <td>{{ number_format((float) $ajuste->monto, 2) }}</td>
                    <td>{{ $ajuste->descripcion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
