#!/usr/bin/env bash

# La mayoría de los FIXME están relacionados con la posibilidad de actualización sobre un despliegue existente

# Descargamos la aplicación del repositorio
# FIXME: Comprobar si ya existe el repositorio en el directorio

### 2021-06-15 Al ser un archivo en un repositorio privado, no vamos a poder descargar el archivo si no tenemos acceso al repositorio privado
### git clone --recurse-submodules --branch develop https://github.com/iesgrancapitan-proyectos/202021daw_junio_Atlas-de-Conocimiento-Critico-PedroBlanco.git atlas
### cd atlas

echo
echo "*****************************************************"
echo "***** INICIO - Copiando archivos de configuración ***"
echo "*****************************************************"
echo

# Tomamos la configuración por defecto
# FIXME: Añadir chequeos para no sobrescribir los cambios ya realizados
cp atlas/.env.example atlas/.env
cp laradock-atlas-daw/.env.example laradock-atlas-daw/.env
cp laradock-atlas-daw/nginx/sites/atlas.conf.example laradock-atlas-daw/nginx/sites/atlas.conf

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
docker exec -w /var/www/atlas atlas_workspace_1 php artisan migrate --seed
docker exec -w /var/www/atlas atlas_workspace_1 php artisan config:cache

echo
echo "*****************************************************"
echo "***** FIN: Pruebe a acceder a http://localhost/ *****"
echo "*****************************************************"
echo
