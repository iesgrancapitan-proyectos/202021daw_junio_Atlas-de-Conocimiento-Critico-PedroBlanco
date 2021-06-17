#!/usr/bin/env bash

# La mayoría de los FIXME están relacionados con la posibilidad de actualización sobre un despliegue existente

# Descargamos la aplicación del repositorio
# FIXME: Comprobar si ya existe el repositorio en el directorio

### 2021-06-15 Al ser un archivo en un repositorio privado, no vamos a poder descargar el archivo si no tenemos acceso al repositorio privado
### git clone --recurse-submodules --branch main https://github.com/iesgrancapitan-proyectos/202021daw_junio_Atlas-de-Conocimiento-Critico-PedroBlanco.git atlas
### cd atlas

atlas_init() {
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
}

atlas_up() {
    echo
    echo "*****************************************************"
    echo "***** Generando y arrancando contenedores Docker ****"
    echo "*****************************************************"
    echo

    # Generamos y levantamos los contenedores
    cd laradock-atlas-daw
    docker-compose up -d
    cd ..
}

atlas_config () {
    # Creamos la base de datos y el usuario que usaremos
    # FIXME: Aunque el SQL comprueba si la BD y usuario ya existen, habría que comprobar si sirve para sobrescribir/cambiar la contraseña de usuario
    set -a
    source atlas/.env
    source laradock-atlas-daw/.env

    echo
    echo "*****************************************************"
    echo "***** Configurando Base de datos  *******************"
    echo "*****************************************************"
    echo

    envsubst < install/atlas-init.sql | docker exec -i ${COMPOSE_PROJECT_NAME}_mariadb mysql -v -v -u root --password=$MARIADB_ROOT_PASSWORD

    # Configuramos la parte Laravel de la aplicación
    echo
    echo "*****************************************************"
    echo "***** Instalando dependencias con Composer **********"
    echo "*****************************************************"
    echo

    docker exec -w /var/www/atlas ${COMPOSE_PROJECT_NAME}_workspace composer install

    echo
    echo "*****************************************************"
    echo "***** Instalando dependencias con NPM ***************"
    echo "*****************************************************"
    echo

    docker exec -w /var/www/atlas ${COMPOSE_PROJECT_NAME}_workspace npm -g install npm
    docker exec -w /var/www/atlas ${COMPOSE_PROJECT_NAME}_workspace mkdir -p /root/.npm/_logs
    docker exec -w /var/www/atlas ${COMPOSE_PROJECT_NAME}_workspace npm install
    docker exec -w /var/www/atlas ${COMPOSE_PROJECT_NAME}_workspace npm run dev

    echo
    echo "*****************************************************"
    echo "***** Configurando aplicación Laravel ***************"
    echo "*****************************************************"
    echo

    docker exec -w /var/www/atlas ${COMPOSE_PROJECT_NAME}_workspace php artisan key:generate
    docker exec -w /var/www/atlas ${COMPOSE_PROJECT_NAME}_workspace php artisan migrate
    docker exec -w /var/www/atlas ${COMPOSE_PROJECT_NAME}_workspace php artisan db:seed --force
    curl -X GET 'http://localhost:7700/health'
    echo
    docker exec -w /var/www/atlas ${COMPOSE_PROJECT_NAME}_workspace php artisan scout:import "App\Models\Autor"
    docker exec -w /var/www/atlas ${COMPOSE_PROJECT_NAME}_workspace php artisan scout:import "App\Models\Geo"
    docker exec -w /var/www/atlas ${COMPOSE_PROJECT_NAME}_workspace php artisan scout:import "App\Models\Mapa"
    docker exec -w /var/www/atlas ${COMPOSE_PROJECT_NAME}_workspace php artisan config:cache

    echo
    echo "*****************************************************"
    echo "***** FIN: Pruebe a acceder a $APP_URL "
    echo "*****************************************************"
    echo
}

atlas_down () {
    cd laradock-atlas-daw
    docker-compose down
    cd ..
}

atlas_start () {
    cd laradock-atlas-daw
    docker-compose start
    cd ..
}

atlas_stop () {
    cd laradock-atlas-daw
    docker-compose stop
    cd ..
}

case "$1" in
up)
    atlas_init
    atlas_up
    atlas_config
    ;;
down)
    atlas_down
    ;;
start)
    atlas_start
    ;;
stop)
    atlas_stop
    ;;
restart)
    atlas_stop
    atlas_start
    ;;
update)
    atlas_stop
    atlas_init
    atlas_start
    atlas_config
    ;;
*)
    echo "Uso: atlas-guick {up|down|start|stop|restart|update)"
    exit 1
    ;;
esac

exit 0

