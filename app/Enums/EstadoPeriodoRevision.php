<?php

namespace App\Enums;

enum EstadoPeriodoRevision: string
{
    case Borrador = 'borrador';
    case EnRevision = 'en_revision';
    case Aprobado = 'aprobado';
    case Certificado = 'certificado';

    public function etiqueta(): string
    {
        return match ($this) {
            self::Borrador => 'Borrador',
            self::EnRevision => 'En revisión',
            self::Aprobado => 'Aprobado',
            self::Certificado => 'Certificado',
        };
    }

    public function hex(): string
    {
        return match ($this) {
            self::Borrador => '#6c757d',
            self::EnRevision => '#ffc107',
            self::Aprobado => '#0dcaf0',
            self::Certificado => '#198754',
        };
    }

    /**
     * @return list<self>
     */
    public function transicionesPermitidas(): array
    {
        return match ($this) {
            self::Borrador => [self::EnRevision],
            self::EnRevision => [self::Aprobado, self::Borrador],
            self::Aprobado => [self::Certificado, self::Borrador],
            self::Certificado => [],
        };
    }

    public function puedeTransicionarA(self $destino): bool
    {
        return match ($this) {
            self::Borrador => $destino === self::EnRevision,
            self::EnRevision => in_array($destino, [self::Aprobado, self::Borrador], true),
            self::Aprobado => in_array($destino, [self::Certificado, self::Borrador], true),
            self::Certificado => false,
        };
    }
}
