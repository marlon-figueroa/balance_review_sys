# Levantar el proyecto con Podman

El proyecto incluye un `compose.yaml` en la raíz con tres servicios: `app` (PHP-FPM con Laravel), `nginx` y `mysql`. Todos los comandos se ejecutan desde la raíz del proyecto.

## 1. Preparación (solo la primera vez)

En macOS Podman corre dentro de una máquina virtual:

```bash
podman machine init      # solo si nunca la has creado
podman machine start
```

Si no tienes proveedor de compose:

```bash
brew install podman-compose
```

Generar variables de entorno:

```bash
sh podman/setup.sh
```

Verifica que `DB_PASSWORD` en `podman/env/app.env` coincida con `MYSQL_PASSWORD` en `podman/env/mysql.env`.

## 2. Compilar y levantar

```bash
podman compose up -d --build
```

Tras migraciones y seeders, la app queda en http://localhost:8080.

Usuarios demo (contraseña `password`):

| Rol | Correo |
|-----|--------|
| Administrador | admin@example.com |
| Registrador | registrador@example.com |
| Revisor | revisor@example.com |
| Aprobador | aprobador@example.com |
| Gerencia | gerencia@example.com |

## 3. Comandos útiles

```bash
podman compose ps
podman compose logs -f app
podman compose exec app php artisan test
podman compose exec mysql mysql -u balance -p balance_review_sys
```

MySQL local: `127.0.0.1:3307` (variable `DB_HOST_PORT`).

## Arquitectura

Ver [arquitectura-componentes.html](arquitectura-componentes.html) para el mapa de componentes Laravel + Bootstrap + MySQL + Podman.
