#!/bin/bash

# Detener la ejecución en caso de error
set -e

# Función para verificar si el servidor de Laravel está corriendo
is_laravel_running() {
    lsof -i :8000 | grep LISTEN > /dev/null 2>&1
    return $?
}

# Instalar dependencias de Composer
echo "Instalando dependencias de Composer..."
if ! composer install --no-interaction --prefer-dist --optimize-autoloader; then
    echo "Error durante la instalación de Composer. Saliendo..."
    exit 1
fi

# Iniciar el servidor de desarrollo de Laravel si no está corriendo
if ! is_laravel_running; then
    echo "El servidor de Laravel no está corriendo. Iniciando el servidor de Laravel..."
    php artisan serve &
    sleep 5  # Aumentamos a 5 segundos para asegurarnos de que el servidor esté listo
else
    echo "El servidor de Laravel ya está corriendo."
fi

# Revertir todas las migraciones
echo "Reseteando las migraciones..."
if ! php artisan migrate:reset; then
    echo "Error durante el reseteo de migraciones. Saliendo..."
    exit 1
fi

# Volver a ejecutar las migraciones
echo "Ejecutando las migraciones..."
if ! php artisan migrate --force; then
    echo "Error durante la ejecución de migraciones. Saliendo..."
    exit 1
fi

# Limpiar cachés y optimizar
echo "Limpiando cachés y optimizando..."
if ! php artisan config:clear || ! php artisan cache:clear || ! php artisan route:clear || ! php artisan view:clear || ! php artisan optimize:clear; then
    echo "Error al limpiar cachés y optimizar. Saliendo..."
    exit 1
fi

# Volver a ejecutar los seeders
echo "Ejecutando los seeders..."
if ! php artisan db:seed --force; then
    echo "Error durante la ejecución de seeders. Saliendo..."
    exit 1
fi

# Cachear configuraciones y optimizar
echo "Cacheando configuraciones y optimizando..."
if ! php artisan config:cache || ! php artisan route:cache || ! php artisan view:cache || ! php artisan optimize; then
    echo "Error al cachear configuraciones. Saliendo..."
    exit 1
fi

# Ejecutar npm para compilar el frontend
echo "Compilando assets de frontend con npm..."
if ! npm install || ! npm run dev; then
    echo "Error durante la compilación de npm. Saliendo..."
    exit 1
fi

# Verificar si php artisan serve ya está corriendo antes de matarlo
if is_laravel_running; then
    echo "Deteniendo el servidor actual..."
    kill $(lsof -t -i:8000)
    sleep 2  # Esperar unos segundos antes de reiniciar
else
    echo "El servidor de Laravel no estaba corriendo."
fi

# Reiniciar el servidor de desarrollo de Laravel
echo "Reiniciando el servidor de desarrollo de Laravel..."
php artisan serve &
sleep 5  # Aumentamos el tiempo de espera para asegurarnos de que el servidor se inicie completamente

echo "Proceso completado."
