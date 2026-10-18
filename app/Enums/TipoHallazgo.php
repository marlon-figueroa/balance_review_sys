<?php

namespace App\Enums;

enum TipoHallazgo: string
{
    case Integridad = 'integridad';
    case Conciliacion = 'conciliacion';
    case Variacion = 'variacion';
    case Anomalia = 'anomalia';
    case Kpi = 'kpi';
}
