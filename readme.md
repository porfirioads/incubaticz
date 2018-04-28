# INCUBATICZ

Este proyecto es una plataforma para el registro de proyectos al Programa de 
apoyo para la incubación de empresas de tecnologías de información y 
comunicación (INCUBATICZ)

## Instrucciones de instalación

1. Clonar el proyecto
2. Asegurarse de tener instalado composer, npm, bower y gulp
3. Ejecutar los siguientes comandos en la terminal:

```bash
sudo chmod 777 storage
composer install
npm install
bower install
gulp watch
php artisan cache:clear
``` 

## Solución de errores

**laravel/framework v5.x.x requires ext-mcrypt:**

```bash
sudo apt-get install php7.0-mcrypt
```
