<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Proyecto Laravel con Livewire y Sanctum

Este es un proyecto basado en Laravel que implementa autenticación con Laravel Sanctum, gestión de usuarios con Livewire y un sistema de administración para activar usuarios.

## Prerequerimientos

Antes de instalar este proyecto, asegúrese de tener instalados los siguientes requisitos:

### General

-   PHP 8.1 o superior

-   Composer

-   MySQL 5.7+ o MariaDB 10+

-   Node.js y NPM (para compilar assets si es necesario)

### En Windows

-   XAMPP o Laragon

-   Git Bash (recomendado)

-   Composer

-   Node.js

### En Linux/macOS

-   Apache o Nginx

-   PHP y extensiones necesarias (`pdo`, `mbstring`, `openssl`, `tokenizer`, `xml`)

-   Composer

-   Node.js y NPM

## Instalación

Clona el repositorio y accede a la carpeta del proyecto:

```bash
git clone https://github.com/jsha64/blog_laravel.git
cd blog_laravel
```

Instala las dependencias de PHP y NPM:

```bash
composer install
npm install
```

## Configuración del Entorno

Copia el archivo .env.example a .env:

```bash
cp .env.example .env
```

Genera la clave de aplicación:

```bash
php artisan key:generate
```

Configura la base de datos en el archivo .env:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_bd
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

> [!NOTE]
> No es necesario ya que al copiar desde `.env.example` queda el entorno ya configurado si deseas configurarlo es a tu eleccion.

## Migraciones y Seeds

Ejecuta las migraciones para crear las tablas en la base de datos:

```bash
php artisan migrate --seed
```

## Servidor de Desarrollo

Para iniciar el servidor en local, ejecuta:

```bash
php artisan serve
```

Si necesitas compilar assets:

```bash
npm run dev
```

> [!NOTE]
> En este caso puedes usar solo Composer para las dependencia e iniciar el servidor

## Ejecución de Pruebas

Para ejecutar las pruebas unitarias y de integración:

```bash
php artisan test
```

Si deseas correr solo una prueba específica:

```bash
php artisan test --filter=NombreDelTest
```

## Autenticación con Sanctum

Este proyecto usa Laravel Sanctum para la autenticación basada en `tokens`. Asegúrate de configurar correctamente los encabezados en `Postman` u otra herramienta para probar la `API`.

> [!NOTE]
> Si es necesario debes ejecutar `php artisan migrate --seed` ya que puede que el usuario se borre de la base de datos y asi poder hacer los tests necesarios
