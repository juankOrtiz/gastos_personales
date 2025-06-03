# Proyecto Gastos Personales

## Descripción
El siguiente proyecto fue creado con fines educativos para ser utilizado por los alumnos de la materia Programación Orientada a Objetos del ISAM.

## Instalación del proyecto 💻

Para instalar el proyecto en un servidor local se deberán seguir los siguientes pasos

### Requisitos previos

* Tener un servidor web instalado en la máquina destino que ejecute el lenguaje de programacion PHP. El servidor utilizado durante el desarrollo fue el **servidor integrado de PHP**.
* Tener un servidor de base de datos instalado en la máquina destino. El servidor utilizado durante el desarrollo fue **MySQL**.
* Tener las credenciales de los distintos servidores a utilizar.
* Tener instalado **Laravel** (versión 12), **PHP** (version minima 8.2) y todas sus dependencias.
* Tener instaladas las siguientes herramientas de desarrollo:
    * Composer
    * NPM

### Pasos a seguir

1. Clonar el repositorio:

```sh
git clone https://github.com/juankOrtiz/gastos_personales.git
```

2. Abrir una consola en la carpeta donde se ha clonado el proyecto e instalar las dependencias de PHP necesarias:

```sh
composer install
```

Y las de NPM:

```sh
npm install
```

3. Crear una copia del archivo `.env.example`, renombrarlo como `.env` y modificar las credenciales necesarias:

```php
APP_NAME='Gastos Personales'
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gastos_personales
DB_USERNAME=root
DB_PASSWORD=
```

Si aun no has llegado a la unidad 4 del programa, las credenciales de bases de datos correspondientes son las siguientes:

```php
APP_NAME='Gastos Personales'
APP_URL=http://localhost

DB_CONNECTION=sqlite
# DB_HOST=
# DB_PORT=
# DB_DATABASE=
# DB_USERNAME=
# DB_PASSWORD=
```

4. Generar la clave de Larvel para la aplicación

```sh
php artisan key:generate
```

5. Para las primeras unidades, crear el archivo `database/database.sqlite` y pasar al siguiente paso. A partir de la unidad 4: crear una base de datos llamada "gastos_personales" en el servidor de base de datos MySQL de tu computadora.

6. Ejecutar las migraciones para crear las tablas en la base de datos

```sh
php artisan migrate
```

7. Finalmente, ejecutar el servidor

```sh
composer run dev
```
