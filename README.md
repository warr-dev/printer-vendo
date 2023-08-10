### Get Started

**Requirements**

* php 8.1 >
* database preferably myqsl
* composer

**Running**

* clone the repo
* run
  ```terminal
  cp .env.example .env
  composer install
  php artisan key:generate
  ```
* edit the `.env` file. edit database fields based on your db
* run `php artisan migrate:fresh --seed`
* to run server `php artisan serve`
