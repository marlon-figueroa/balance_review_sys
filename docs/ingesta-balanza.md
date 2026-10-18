# Ingesta de balanza (CSV)

Cada periodo en estado **borrador** permite alimentar la balanza desde el **catálogo de cuentas** (estructura con saldos en cero, balanza demostrativa equilibrada o CSV exportado desde el catálogo) o importar un CSV propio.

El catálogo demostrativo se carga con `php artisan db:seed --class=CatalogoCuentasDemoSeeder`. Los códigos deben existir en el catálogo activo cuando `BALANCE_VALIDAR_CATALOGO=true` (valor por defecto).

## Columnas requeridas

| Columna | Descripción |
|---------|-------------|
| `codigo_cuenta` | Código contable |
| `nombre` | Nombre de la cuenta |
| `naturaleza` | `activo`, `pasivo` o `patrimonio` |
| `debe` | Movimiento débito del periodo |
| `haber` | Movimiento crédito del periodo |
| `saldo` | Saldo final |

## Ejemplo

```csv
codigo_cuenta,nombre,naturaleza,debe,haber,saldo
1101,Caja,activo,10000,0,10000
2101,Proveedores,pasivo,0,30000,30000
3101,Capital social,patrimonio,0,50000,50000
```

Tras importar, el sistema recalcula integridad (`Activo = Pasivo + Patrimonio`), conciliaciones, variaciones frente al último periodo certificado, anomalías y KPIs.
