FROM php:7.4-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY src/ /var/www/html/

#docker run --name db -e MYSQL_ROOT_PASSWORD=password -e MYSQL_DATABASE=mydb -d mysql:latest

#CMD ["apache2-foreground"]




#docker ps
#docker container ls
#docker container ls -a
#docker-compose up -d

#docker-machine ip

#docker network ls

#descobrir o ip da maquina
#docker inspect \ -f '{{range.NetworkSettings.Networks}}{{.IPAddress}}{{end}}' *nomedocontainer*
#docker inspect \ -f '{{range.NetworkSettings.Networks}}{{.IPAddress}}{{end}}' phpteste-db-1
#docker inspect phpteste-db-1     ---traz todas infos do container

#docker inspect <container id> | grep "IPAddress"
#docker inspect phpteste-db-1 | grep "IPAddress"
#docker inspect <container id> | findstr "IPAddress"
#docker inspect phpteste-db-1 | findstr "IPAddress"
