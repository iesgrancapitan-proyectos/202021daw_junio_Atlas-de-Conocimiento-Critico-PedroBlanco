@echo off
echo ***
echo Script para arrancar y parar los contenedores de laradock
echo ***

cd laradock-atlas-daw
docker-compose start nginx mariadb php-fpm workspace meilisearch
rem docker-compose start nginx mariadb php-fpm workspace

echo ***
echo Pulsar Ctrl+C para terminar de ejecutar del script y dejar los contenedores arrancados
echo Si se pulsa cualquier tecla para continuar, se paran los contenedores
echo ***

pause

docker-compose stop nginx mariadb php-fpm workspace meilisearch
rem docker-compose stop nginx mariadb php-fpm workspace
cd ..
