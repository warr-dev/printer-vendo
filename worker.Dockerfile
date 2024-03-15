FROM printervendo:laravel

WORKDIR /var/www/html

COPY . .
COPY ./.docker/worker/.env ./.env

RUN apt install -y supervisor