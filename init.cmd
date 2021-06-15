@echo off
echo ***
echo Script para arrancar y parar los contenedores de laradock
echo ***

cd laradock-atlas-daw
docker-compose start nginx mariadb php-fpm workspace

echo ***
echo Pulsar Ctrl+C para terminar la ejecuci¢n del script y dejar los contenedores arrancados
echo Si se pulsa cualquier tecla para continuar, se parar n los contenedores
echo ***

pause

docker-compose stop nginx mariadb php-fpm workspace
cd ..
