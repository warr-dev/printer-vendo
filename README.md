### Get Started

**Requirements**
- linux environment (host network runs on linux docker environment only)
- docker & docker compose (will run at host, please free the ports 9000, 8001)

**Running**

clone the repo
run
- ```cd .docker && docker compose up -d```
- ```cd ..``` to go back to root dir
- ```cp .env.example .env```
- edit .env values based on your environment
- ```docker exec -it printervendo_php composer install```
- ```docker exec -it printervendo_php php artisan key:generate```
- ```docker exec -it printervendo_php php artisan migrate: fresh --seed```
- ```docker exec -it printervendo_php php artisan storage:link```

done!

you can now access the printervendo using http://{host ip/domain}:8001
sometimes on host machine have issue shows 403:cant verify device you can use locahost:8001
