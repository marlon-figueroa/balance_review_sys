<?php

namespace App\Enums;

enum SeveridadHallazgo: string
{
    case Critico = 'critico';
    case Advertencia = 'advertencia';
    case Info = 'info';
}
