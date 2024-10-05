#!/bin/bash

# Función para verificar si el servidor de Laravel está corriendo
is_laravel_running() {
    lsof -i :8000 | grep LISTEN > /dev/null 2>&1
    return $?
}

# Iniciar el servidor de desarrollo de Laravel si no está corriendo
if ! is_laravel_running; then
    echo "El servidor de Laravel no está corriendo. Iniciando el servidor de Laravel..."
    php artisan serve &
    sleep 2 # Esperar un par de segundos para que el servidor se inicie
else
    echo "El servidor de Laravel ya está corriendo."
fi

# Revertir todas las migraciones
echo "Reseteando las migraciones..."
php artisan migrate:reset

# Volver a ejecutar las migraciones
echo "Ejecutando las migraciones..."
php artisan migrate

# Limpiar cachés y optimizar
echo "Limpiando cachés y optimizando..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear

# Volver a ejecutar los seeders
echo "Ejecutando los seeders..."
php artisan db:seed

# Cachear configuraciones y optimizar
echo "Cacheando configuraciones y optimizando..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Ejecutar npm para compilar el frontend
echo "Compilando assets de frontend con npm..."
npm install
npm run dev

# Detener y reiniciar el servidor de desarrollo de Laravel
echo "Reiniciando el servidor de desarrollo de Laravel..."
kill $(lsof -t -i:8000)
php artisan serve &

echo "Proceso completado."
