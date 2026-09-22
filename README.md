# Instalación del proyecto

Este proyecto utiliza **Laravel**, **Composer**, **Node.js**, **NPM**, **Vue.js** y **Axios**.

## Requisitos

Antes de comenzar, asegúrate de tener instalados:


## 1. Clonar el proyecto

```bash
git clone URL_DEL_REPOSITORIO
cd NOMBRE_DEL_PROYECTO
```

## 2. Instalar dependencias de PHP

Instala las dependencias del proyecto mediante Composer:

```bash
composer install
```

Configura en el archivo `.env` los datos de conexión a la base de datos:

```env
DB_DATABASE=orders_service
DB_USERNAME=usuario
DB_PASSWORD=contraseña
```

## 4. Ejecutar las migraciones

Para crear las tablas de la base de datos:

```bash
php artisan migrate
```

## 5. Instalar dependencias de NPM

Instala las dependencias de JavaScript:

```bash
npm install
```

## 6. Instalar Axios

Si Axios no se encuentra instalado en el proyecto, ejecuta:

```bash
npm install axios
```

## 7. Ejecutar el proyecto

Para iniciar el servidor de Laravel:

```bash
php artisan serve
```

El proyecto quedará disponible en:

```text
http://127.0.0.1:8000
```

## Comandos principales

| Comando                    | Descripción                            |
| -------------------------- | -------------------------------------- |
| `composer install`         | Instala las dependencias de PHP        |
| `npm install`              | Instala las dependencias de JavaScript |
| `npm install axios`        | Instala Axios                          |
| `php artisan migrate`      | Ejecuta las migraciones                |
| `php artisan serve`        | Inicia el servidor de Laravel          |

## Tecnologías utilizadas

* Laravel
* PHP
* Axios
* MySQL
* Composer
* NPM

