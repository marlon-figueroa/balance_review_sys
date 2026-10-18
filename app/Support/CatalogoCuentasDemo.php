<?php

namespace App\Support;

use App\Enums\NaturalezaCuenta;

/**
 * Plan de cuentas demostrativo alineado con config/balance_review.php (prefijos 11, 21, 31…).
 */
final class CatalogoCuentasDemo
{
    /**
     * @return list<array{codigo: string, nombre: string, naturaleza: NaturalezaCuenta, es_corriente: bool, orden: int, descripcion?: string}>
     */
    public static function cuentas(): array
    {
        return [
            ['codigo' => '1101', 'nombre' => 'Caja general', 'naturaleza' => NaturalezaCuenta::Activo, 'es_corriente' => true, 'orden' => 10],
            ['codigo' => '1102', 'nombre' => 'Bancos cuenta operativa', 'naturaleza' => NaturalezaCuenta::Activo, 'es_corriente' => true, 'orden' => 20],
            ['codigo' => '1103', 'nombre' => 'Bancos cuenta de ahorro', 'naturaleza' => NaturalezaCuenta::Activo, 'es_corriente' => true, 'orden' => 30],
            ['codigo' => '1201', 'nombre' => 'Cuentas por cobrar clientes', 'naturaleza' => NaturalezaCuenta::Activo, 'es_corriente' => true, 'orden' => 40],
            ['codigo' => '1202', 'nombre' => 'Estimación cuentas incobrables', 'naturaleza' => NaturalezaCuenta::Activo, 'es_corriente' => true, 'orden' => 50],
            ['codigo' => '1301', 'nombre' => 'Inventarios de mercadería', 'naturaleza' => NaturalezaCuenta::Activo, 'es_corriente' => true, 'orden' => 60],
            ['codigo' => '1401', 'nombre' => 'Mobiliario y equipo de oficina', 'naturaleza' => NaturalezaCuenta::Activo, 'es_corriente' => false, 'orden' => 70],
            ['codigo' => '1402', 'nombre' => 'Depreciación acumulada mobiliario', 'naturaleza' => NaturalezaCuenta::Activo, 'es_corriente' => false, 'orden' => 80],
            ['codigo' => '2101', 'nombre' => 'Proveedores nacionales', 'naturaleza' => NaturalezaCuenta::Pasivo, 'es_corriente' => true, 'orden' => 110],
            ['codigo' => '2102', 'nombre' => 'Acreedores diversos', 'naturaleza' => NaturalezaCuenta::Pasivo, 'es_corriente' => true, 'orden' => 120],
            ['codigo' => '2201', 'nombre' => 'Préstamos bancarios corto plazo', 'naturaleza' => NaturalezaCuenta::Pasivo, 'es_corriente' => true, 'orden' => 130],
            ['codigo' => '2202', 'nombre' => 'IVA por pagar', 'naturaleza' => NaturalezaCuenta::Pasivo, 'es_corriente' => true, 'orden' => 140],
            ['codigo' => '2301', 'nombre' => 'Préstamos bancarios largo plazo', 'naturaleza' => NaturalezaCuenta::Pasivo, 'es_corriente' => false, 'orden' => 150],
            ['codigo' => '3101', 'nombre' => 'Capital social', 'naturaleza' => NaturalezaCuenta::Patrimonio, 'es_corriente' => false, 'orden' => 210],
            ['codigo' => '3201', 'nombre' => 'Utilidades retenidas', 'naturaleza' => NaturalezaCuenta::Patrimonio, 'es_corriente' => false, 'orden' => 220],
            ['codigo' => '3202', 'nombre' => 'Resultado del ejercicio', 'naturaleza' => NaturalezaCuenta::Patrimonio, 'es_corriente' => false, 'orden' => 230],
        ];
    }

    /**
     * Saldos de demostración equilibrados (Activo = Pasivo + Patrimonio).
     *
     * @return array<string, array{debe: float, haber: float, saldo: float}>
     */
    public static function saldosDemostrativos(float $factorVariacion = 1.0): array
    {
        $base = [
            '1101' => ['debe' => 10000, 'haber' => 0, 'saldo' => 10000],
            '1102' => ['debe' => 50000, 'haber' => 0, 'saldo' => 50000],
            '1201' => ['debe' => 18000, 'haber' => 0, 'saldo' => 18000],
            '1301' => ['debe' => 40000, 'haber' => 0, 'saldo' => 40000],
            '1401' => ['debe' => 25000, 'haber' => 0, 'saldo' => 25000],
            '1402' => ['debe' => 0, 'haber' => 5000, 'saldo' => -5000],
            '2101' => ['debe' => 0, 'haber' => 30000, 'saldo' => 30000],
            '2201' => ['debe' => 0, 'haber' => 20000, 'saldo' => 20000],
            '2202' => ['debe' => 0, 'haber' => 3500, 'saldo' => 3500],
            '2301' => ['debe' => 0, 'haber' => 15000, 'saldo' => 15000],
            '3101' => ['debe' => 0, 'haber' => 50000, 'saldo' => 50000],
            '3201' => ['debe' => 0, 'haber' => 19500, 'saldo' => 19500],
        ];

        if ($factorVariacion === 1.0) {
            return $base;
        }

        $variacion = [];
        foreach ($base as $codigo => $mov) {
            if (str_starts_with($codigo, '11') || str_starts_with($codigo, '12')) {
                $variacion[$codigo] = [
                    'debe' => round($mov['debe'] * $factorVariacion, 2),
                    'haber' => $mov['haber'],
                    'saldo' => round($mov['saldo'] * $factorVariacion, 2),
                ];
            } else {
                $variacion[$codigo] = $mov;
            }
        }

        return $variacion;
    }
}
