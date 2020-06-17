# INCUBATICZ

Este proyecto es una plataforma para el registro de proyectos al Programa de 
apoyo para la incubación de empresas de tecnologías de información y 
comunicación (INCUBATICZ)

## Requisitos

- PHP
- MySQL
- Composer

## Instrucciones de instalación

**Clonar proyecto:**

```bash
git clone https://github.com/porfirioangel/INCUBATICZ
```

**Instalar dependencias de Linux:**

```bash
sudo apt install zip
```

**Instalar extensiones de PHP:**

```bash
sudo apt install php7.2-xml
```

**Crea carpeta de caché y asigna personas:**

```
mkdir bootstrap/cache
sudo chmod 755 bootstrap/cache
composer install
```

**Instalar dependencias:**

```bash
composer install
```

**Crear archivo de variables de entorno:**
```
cp .env.example .env
```

**Configurar la base de datos en el archivo .env:**
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mydatabase
DB_USERNAME=myuser
DB_PASSWORD=mypassword
```

**Generar la llave para la aplicación:**

```bash
php artisan key:generate
```

**Crear base de datos:**

```bash
mysql -u root -p
CREATE DATABASE mydatabase;
quit
```

**Correr las migraciones y seeders:**

```bash
php artisan migrate:refresh --seed
```

**Correr proyecto:**
```bash
php artisan serve --host 0.0.0.0 --port 8000
```
