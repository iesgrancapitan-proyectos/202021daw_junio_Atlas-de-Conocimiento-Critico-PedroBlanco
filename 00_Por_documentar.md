# Proceso de creación e implantación de la aplicación (entorno de desarrollo)

## Creación del esqueleto en Laravel de la aplicación

En el contenedor _workspace_:

```shell
# sudo laradock
$ composer create-project --prefer-dist laravel/laravel
```

## Creación de la base de datos y del usuario

```sql
CREATE DATABASE `atlas` /*!40100 COLLATE 'utf8mb4_general_ci' */;
CREATE USER 'atlas'@'%' IDENTIFIED BY 'atlas';
GRANT USAGE ON *.* TO 'atlas'@'%';
GRANT EXECUTE, SELECT, SHOW VIEW, ALTER, ALTER ROUTINE, CREATE, CREATE ROUTINE, CREATE TEMPORARY TABLES, CREATE VIEW, DELETE, DROP, EVENT, INDEX, INSERT, REFERENCES, TRIGGER, UPDATE, LOCK TABLES  ON `atlas`.* TO 'atlas'@'%' WITH GRANT OPTION;
FLUSH PRIVILEGES;
```

## Configuraciones adicionales

### Archivos .env

Hay que crear tanto en atlas/ como en laradock-atlas-daw/ los respectivos .env y en este último directorio, hay que recrear docker-compose.yml a partir del de producción.

### NGINX

* Copiar laravel.conf a nginx/sites

### Configuración del nombre de host

* Ver .env en atlas/

## Instalar dependencias para Vue.js

```shell
composer require laravel/ui
```

## Configuración inicial en el contenedor workspace

```shell
cd atlas
npm install
npm update
```

Puede que la siguiente línea haya que cambiarla:

```shell
npm run dev
```

```shell
composer install
php artisan migrate
```
