### Get Started

**Requirements**
- linux environment (host network runs on linux docker environment only)
- docker & docker compose (will run at host, please free the ports 9000, 8001 on host machine)

**Running**

clone the repo
run
- ```cd .docker && docker compose up -d```
- ```docker exec -it printervendo_php bash```
- you will be inside container's terminal/shell
- ```./start.sh```

done!

you can now access the printervendo using http://{host ip/domain}:8001
