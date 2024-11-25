## CONFIGURACION INICIAL

1. Asegurarse de tener los siguientes paquetes en el equipo: PHP, Composer, Laravel, nodejs, npm.

2. Ejecutar los siguientes comandos en la carpeta laravel-project para instalar dependencias.
```console
npm install
```
```console
composer install
```

3. Crear la base de datos.
```console
php artisan migrate
```

4. Meterle datos dummy a la base de datos.
```console
php artisan db:seed
```

5. Compilar los cambios y lanzar el servidor.
```console
composer dev build
```

6. Forma alternativa de lanzar el servidor.
```console
php artisan serve --host 0.0.0.0
```

## Ejecucion en DOCKER

1. Teniendo docker instalado, ejecutar:
```console
docker build -t mightymorfi .
docker run -p 8000:8000 -d mightymorfi
```
