## CONFIGURACION INICIAL

- Asegurarse de tener los siguientes paquetes en el equipo. PHP, Composer, Laravel, nodejs, npm

- Ejecutar los siguientes comandos en la carpeta laravel-project para instalar dependencias
- - npm install
- - composer install

- Instalar DB Mock (TODO poner como)

- Lanzar el server de prueba:
- - php artisan serve --host 0.0.0.0

## Ejecucion en DOCKER

- Teniendo docker instalado, ejecutar:
- - **docker build -t nombreImagenLocal . **
- - **docker run -p 8000:8000 -d nombreImagenLocal **