# Atlas de Conocimiento Crítico

Este es el repositorio del Proyecto Integrado _Atlas de Conocimiento Crítico_ del Ciclo Superior de Formación Profesional _"Desarrollo de Aplicaciones Web"_ del [IES Gran Capitan](https://informatica.iesgrancapitan.org).

El objetivo principal de este proyecto es elaborar un "Directorio de Mapas de Conocimiento Crítico", concretamente con forma de "mapa geolocalizado" de [mapas de conocimiento crítico](https://ws168.juntadeandalucia.es/wikigestionC/index.php?title=Mapa_de_Conocimiento_Cr%C3%ADtico) y sus datos asociados.

La idea fue propuesta al Grupo de Gestión de Conocimiento ["Identificación del Conocimiento Crítico"](https://ws168.juntadeandalucia.es/iaap/gestiondelconocimiento/proyectos/edicion-2019-2020-edicion-2019-2020/gc06-identificacion-del-conocimiento-critico/) del Programa ["Embajadores del Conocimiento"](https://ws168.juntadeandalucia.es/iaap/gestiondelconocimiento/embajadores-del-conocimiento/) por parte de los coordinadores de dicho Programa, que es una iniciativa del [Instituto Andaluz de Administración Pública](http://www.juntadeandalucia.es/institutodeadministracionpublica/publico/home.filter) (Junta de Andalucía).

El nombre _Atlas de Conocimiento Crítico_ viene por ser un _Directorio_ o compendio de _Mapas de Conocimiento Crítico_ y consiste en una aplicación web desarrollada en [Laravel](https://laravel.com/) y pensada para ser desplegada mediante contenedores [Docker](https://www.docker.com/) de Linux.

## Instalación

La instrucciones detalladas de instalación y despliegue se encuentran en la sección [Manual de Despliegue](https://github.com/iesgrancapitan-proyectos/202021daw_junio_Atlas-de-Conocimiento-Critico-PedroBlanco/wiki/Manual_Despliegue) dentro del wiki del proyecto.

Para una instalación rápida y accesible desde [http://localhost/](http://localhost/) podemos seguir la siguientes instrucciones:

### Requisitos de la instalación rápida

Aparte de tener el puerto 80 libre en nuestra máquina, necesitaremos tener instaladas las siguientes aplicaciones:

- ```bash```
- ```git```
- ```envsubst```

### Instalación y despliegue automáticos

Para desplegar instalar de forma automática la aplicación se puede ejecutar el script ```atlas-quick-start.sh``` que se encuentra en la carpeta raiz del repositorio:

```shell
git clone --recurse-submodules --branch main https://github.com/iesgrancapitan-proyectos/202021daw_junio_Atlas-de-Conocimiento-Critico-PedroBlanco.git atlas
cd atlas
bash atlas-quick-start.sh
```

Una vez se ha ejecutado el script, deberíamos poder acceder a la aplicación instalada en [http://localhost/](http://localhost/).

### Instalación y despliegue por pasos

Alternativamente, se pueden seguir los siguientes pasos ejecutando en un shell ```bash```:

```shell
~$ git clone --recurse-submodules --branch main https://github.com/iesgrancapitan-proyectos/202021daw_junio_Atlas-de-Conocimiento-Critico-PedroBlanco.git atlas
~$ cd atlas
~/atlas$ cp atlas/.env.example atlas/.env
~/atlas$ cp laradock-atlas-daw/.env.example laradock-atlas-daw/.env
~/atlas$ cp laradock-atlas-daw/nginx/sites/atlas.conf.example laradock-atlas-daw/nginx/sites/atlas.conf
~/atlas$ cd laradock-atlas-daw
~/atlas/laradock-atlas-daw$ docker-compose up -d
```

Con los contenedores de la aplicación generados y ejecutándose, llega el momento de configurar la base de datos:

```shell
~/atlas$ set -a
~/atlas$ source atlas/.env
~/atlas$ source laradock-atlas-daw/.env
~/atlas$ envsubst < install/atlas-init.sql | docker exec -it atlas_mariadb mysql -u root --password=$MARIADB_ROOT_PASSWORD
```

Ahora es el turno de configurar la parte [Laravel](https://laravel.com/) de la aplicación:

```shell
docker exec -w /var/www/atlas atlas_workspace composer install
docker exec -w /var/www/atlas atlas_workspace npm install
docker exec -w /var/www/atlas atlas_workspace npm run dev
docker exec -w /var/www/atlas atlas_workspace php artisan key:generate
docker exec -w /var/www/atlas atlas_workspace php artisan migrate --seed
docker exec -w /var/www/atlas atlas_workspace php artisan config:cache
```

Nota: En cada línea, la primera parte es el directorio en que se debe ejecutar cada orden, suponiendo que empecemos por el directorio personal del usuario (```/home/usuario``` o ```~``` de forma abreviada). Si no está presente, es indiferente desde qué directorio se ejecute.

## Documentación

Toda la documentación del proyecto se puede encontrar en la [wiki](https://github.com/iesgrancapitan-proyectos/202021daw_junio_Atlas-de-Conocimiento-Critico-PedroBlanco/wiki):

- [Inicio](https://github.com/iesgrancapitan-proyectos/202021daw_junio_Atlas-de-Conocimiento-Critico-PedroBlanco/wiki/Home)
- [Documentación del Proyecto](https://github.com/iesgrancapitan-proyectos/202021daw_junio_Atlas-de-Conocimiento-Critico-PedroBlanco/wiki/Doc_PI)
- [Introducción](https://github.com/iesgrancapitan-proyectos/202021daw_junio_Atlas-de-Conocimiento-Critico-PedroBlanco/wiki/1Doc_Introduccion)
- [Objetivos y requisitos del proyecto](https://github.com/iesgrancapitan-proyectos/202021daw_junio_Atlas-de-Conocimiento-Critico-PedroBlanco/wiki/2Doc_Objetivos_Requisitos)
- [Estudio previo](https://github.com/iesgrancapitan-proyectos/202021daw_junio_Atlas-de-Conocimiento-Critico-PedroBlanco/wiki/3Doc_Estudio_previo)
- [Plan de trabajo](https://github.com/iesgrancapitan-proyectos/202021daw_junio_Atlas-de-Conocimiento-Critico-PedroBlanco/wiki/4Doc_Plan_Trabajo)
- [Diseño](https://github.com/iesgrancapitan-proyectos/202021daw_junio_Atlas-de-Conocimiento-Critico-PedroBlanco/wiki/5Doc_Diseno)
- [Implantación](https://github.com/iesgrancapitan-proyectos/202021daw_junio_Atlas-de-Conocimiento-Critico-PedroBlanco/wiki/6Doc_Implantacion)
- [Recursos](https://github.com/iesgrancapitan-proyectos/202021daw_junio_Atlas-de-Conocimiento-Critico-PedroBlanco/wiki/7Doc_Recursos)
- [Conclusiones](https://github.com/iesgrancapitan-proyectos/202021daw_junio_Atlas-de-Conocimiento-Critico-PedroBlanco/wiki/8Doc_Conclusiones)
- [Referencias / bibliografía](https://github.com/iesgrancapitan-proyectos/202021daw_junio_Atlas-de-Conocimiento-Critico-PedroBlanco/wiki/9Doc_Referencias_Bibliografia)
- [Anexos](https://github.com/iesgrancapitan-proyectos/202021daw_junio_Atlas-de-Conocimiento-Critico-PedroBlanco/wiki/10Doc_Anexos)
- [Manual de Despliegue](https://github.com/iesgrancapitan-proyectos/202021daw_junio_Atlas-de-Conocimiento-Critico-PedroBlanco/wiki/Manual_Despliegue)
- [Manual de Usuario](https://github.com/iesgrancapitan-proyectos/202021daw_junio_Atlas-de-Conocimiento-Critico-PedroBlanco/wiki/Manual_Usuario)

## Uso

La aplicación viene precargada con los datos de los [mapas de conocimiento crítico](https://ws168.juntadeandalucia.es/wikigestionC/index.php?title=Mapa_de_Conocimiento_Cr%C3%ADtico) realizados (en diferentes fases de desarrollo) desde que empezó Grupo de Gestión de Conocimiento ["Identificación del Conocimiento Crítico"](https://ws168.juntadeandalucia.es/iaap/gestiondelconocimiento/proyectos/edicion-2019-2020-edicion-2019-2020/gc06-identificacion-del-conocimiento-critico/)  en el Programa ["Embajadores del Conocimiento"](https://ws168.juntadeandalucia.es/iaap/gestiondelconocimiento/embajadores-del-conocimiento/) en la edición 2018/2019 hasta la actualidad.

Además se crea un primer usuario (con perfil de Superadministrador) por defecto:

- Usuario: ```super@example.com```
- Contraseña: ```password```

Si hemos seguido los pasos de instalación rápida descritos anteriormente, podremos entrar en la aplicación con las credenciales anteriores en la dirección [http://localhost/](http://localhost/)

## Autor

- [@PedroBlanco](https://www.github.com/PedroBlanco)

## License

Por ahora se ha elegido la licencia [MIT](https://choosealicense.com/licenses/mit/), aunque es bastante posible que se escoja finalmente una licencia con _copyleft_.
