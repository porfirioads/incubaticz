# INCUBATICZ

Este proyecto es una plataforma para el registro de proyectos al Programa de 
apoyo para la incubación de empresas de tecnologías de información y 
comunicación (INCUBATICZ)

## Instrucciones de instalación

**Clonar el proyecto**

**Asegurarse de tener instalado composer, npm, bower y gulp**

**Ejecutar los siguientes comandos en la terminal:**

```bash
sudo chmod 777 storage
composer install
npm install
bower install
gulp watch
php artisan cache:clear
``` 

**Copiar el archivo .env.example y renombrarlo a .env**
```
cp .env.example .env
```

**Configurar la base de datos en el archivo .env:**
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mydatabase
DB_USERNAME=myuser
DB_PASSWORD=mypassword
```

**Generar la llave para la aplicación**
```
php artisan key:generate
```

**Correr las migraciones y seeders:**
```
php artisan migrate:fresh --seed
```

**Correr proyecto:**
```
php artisan serve --host 0.0.0.0 --port 8000
```


## Solución de errores

**laravel/framework v5.x.x requires ext-mcrypt:**

```bash
sudo apt-get install php7.0-mcrypt
```
