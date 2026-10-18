<?php

namespace App\Enums;

enum NaturalezaCuenta: string
{
    case Activo = 'activo';
    case Pasivo = 'pasivo';
    case Patrimonio = 'patrimonio';

    public function etiqueta(): string
    {
        return match ($this) {
            self::Activo => 'Activo',
            self::Pasivo => 'Pasivo',
            self::Patrimonio => 'Patrimonio',
        };
    }
}
