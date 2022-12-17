# symfony-apiplatform-tmdb


## Infomation
Comme nous l'avons vu en cours j'avais un problème pour me connecter à ma base de donnée Myssql. J'ai donc décidé de faire le projet avec une base de donnée sqlite pour ne plus avoir ce problème.

## Install project

1. composer install
2. php bin/console doctrine:database:create
3. php bin/console doctrine:migrations:diff
3. php bin/console doctrine:migrations:migrate
    * if you have problems with the migration you can try to execute the command
        * rm -rf migrations/*
        * symfony console doctrine:migrations:dump-schema
        * symfony console doctrine:migrations:rollup
        * php bin/console doctrine:migrations:migrate
4. php bin/console doctrine:fixtures:load
5. php bin/console app:create-tables
    * the command may take a long time to execute because there is a lot of give to get
6. php bin/console server:start

## API

### the different routes :

1. /api/movies
    * /api/movies/{id}
3. /api/series
    * /api/series/{id}
5. /api/animes
    * /api/animes/{id}
7. /api/memes
    * /api/memes/{id}
9. /api/posts
    * /api/posts/{id}


## easyAdmin

### the different routes :

1. DOMAIN_URL/register (if you want to create a new user)
2. DOMAIN_URL/login   (if you want to connect)
3. DOMAIN_URL/admin   (if you want to access to the admin panel)




