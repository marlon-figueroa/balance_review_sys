# Revisión de balance

Sistema MVP de revisión de balance contable: Laravel 12, Bootstrap 5, MySQL y Podman.

## Documentación

- [Arquitectura de componentes](docs/arquitectura-componentes.html)
- [Podman (desarrollo local)](docs/podman.md)
- [Ingesta CSV de balanza](docs/ingesta-balanza.md)
- Requerimientos del dominio: [balance_review_sistema.txt](balance_review_sistema.txt)

## Desarrollo local

```bash
composer install
cp .env.example .env
php artisan key:generate
npm install && npm run build
php artisan migrate --seed
php artisan serve
```

Con contenedores: ver [docs/podman.md](docs/podman.md).

## Pruebas

```bash
php artisan test
```

## Roles

Segregación de funciones: **Registrador** carga datos y envía; **Revisor** aprueba o rechaza; **Aprobador** certifica; **Gerencia** consulta reportes certificados.
