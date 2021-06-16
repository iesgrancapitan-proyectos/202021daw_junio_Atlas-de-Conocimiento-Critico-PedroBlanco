#!/usr/bin/env bash

# La mayoría de los FIXME están relacionados con la posibilidad de actualización sobre un despliegue existente

# Descargamos la aplicación del repositorio
# FIXME: Comprobar si ya existe el repositorio en el directorio

### 2021-06-15 Al ser un archivo en un repositorio privado, no vamos a poder descargar el archivo si no tenemos acceso al repositorio privado
### git clone --recurse-submodules --branch main https://github.com/iesgrancapitan-proyectos/202021daw_junio_Atlas-de-Conocimiento-Critico-PedroBlanco.git atlas
### cd atlas

echo
echo "*****************************************************"
echo "***** INICIO - Copiando archivos de configuración ***"
echo "*****************************************************"
echo

# Tomamos la configuración por defecto
# Pero respetamos los archivo existentes para poder usar el script para actualizar la aplicación

if [[ ! -f atlas/.env ]]; then
    cp atlas/.env.example atlas/.env
    echo "++++++ Creamos atlas/.env (con los valores por defecto)"
else
    echo "===== Respetamos atlas/.env existente"
    echo "========== Borrar manualmente para regenerar"
    echo "========== Comprobar contenido en caso de actualización"
fi

if [[ ! -f laradock-atlas-daw/.env ]]; then
    cp laradock-atlas-daw/.env.example laradock-atlas-daw/.env
    echo "++++++ laradock-atlas-daw/.env (con los valores por defecto)"
else
    echo "===== Respetamos laradock-atlas-daw/.env"
    echo "========== Borrar manualmente para regenerar"
    echo "========== Comprobar contenido en caso de actualización"
fi

if [[ ! -f laradock-atlas-daw/nginx/sites/atlas.conf ]]; then
    cp laradock-atlas-daw/nginx/sites/atlas.conf.example laradock-atlas-daw/nginx/sites/atlas.conf
    echo "++++++ Creamos laradock-atlas-daw/nginx/sites/atlas.conf (con los valores por defecto)"
else
    echo "===== Respetamos laradock-atlas-daw/nginx/sites/atlas.conf existente"
    echo "========== Borrar manualmente para regenerar"
    echo "========== Comprobar contenido en caso de actualización"
fi


echo
echo "*****************************************************"
echo "***** Generando y arrancando contenedores Docker ****"
echo "*****************************************************"
echo

# Generamos y levantamos los contenedores
cd laradock-atlas-daw
docker-compose up -d

# Creamos la base de datos y el usuario que usaremos
# FIXME: Aunque el SQL comprueba si la BD y usuario ya existen, habría que comprobar si sirve para sobrescribir/cambiar la contraseña de usuario
cd ..
set -a
source atlas/.env
source laradock-atlas-daw/.env

echo
echo "*****************************************************"
echo "***** Configurando Base de datos  *******************"
echo "*****************************************************"
echo

envsubst < install/atlas-init.sql | docker exec -i atlas_mariadb_1 mysql -u root --password=$MARIADB_ROOT_PASSWORD

# Configuramos la parte Laravel de la aplicación
echo
echo "*****************************************************"
echo "***** Instalando dependencias con Composer **********"
echo "*****************************************************"
echo

docker exec -w /var/www/atlas atlas_workspace_1 composer install

echo
echo "*****************************************************"
echo "***** Instalando dependencias con NPM ***************"
echo "*****************************************************"
echo

docker exec -w /var/www/atlas atlas_workspace_1 npm install
docker exec -w /var/www/atlas atlas_workspace_1 npm run dev

echo
echo "*****************************************************"
echo "***** Configurando aplicación Laravel ***************"
echo "*****************************************************"
echo

docker exec -w /var/www/atlas atlas_workspace_1 php artisan key:generate
docker exec -w /var/www/atlas atlas_workspace_1 php artisan migrate
docker exec -w /var/www/atlas atlas_workspace_1 php artisan db:seed --force
docker exec -w /var/www/atlas atlas_workspace_1 php artisan config:cache

echo
echo "*****************************************************"
echo "***** FIN: Pruebe a acceder a http://localhost/ *****"
echo "*****************************************************"
echo
