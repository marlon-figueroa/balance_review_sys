#!/bin/sh
# Borra el volumen de datos de MySQL y recrea el servicio con las credenciales
# actuales de podman/env/mysql.env (solo aplican en la primera inicialización).
set -e

cd "$(dirname "$0")/.."

echo "Deteniendo app (depende de mysql)..."
podman compose stop app nginx 2>/dev/null || true

echo "Deteniendo y eliminando contenedor mysql..."
podman compose stop mysql 2>/dev/null || true
podman compose rm -f mysql 2>/dev/null || true

echo "Eliminando volumen balance-review-sys_mysql-data (datos anteriores se pierden)..."
podman volume rm balance-review-sys_mysql-data 2>/dev/null || podman volume rm mysql-data 2>/dev/null || true

echo "Verifique que DB_* en podman/env/app.env coincidan con MYSQL_* en podman/env/mysql.env"
echo "Levantando mysql..."
podman compose up -d mysql

echo "Espere a que mysql esté healthy, luego:"
echo "  podman compose up -d --build app nginx"
echo "  podman compose logs -f app"
