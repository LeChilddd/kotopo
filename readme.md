# Getting Started

## Needed
PHP 8, Symfony 6, MariaDB version 8, Docker

## Run
```
docker-compose up -d --force-recreate
docker-compose up -d --build
bin/composer update

docker-compose down --remove-orphans to stop the Docker containers.
```
Open your Browser at https://kotopo.localhost
Accept the auto-generated TLS certificate

## Database
To connect to phpmyadmin, in server add 'database', and enter your login.

### To make or modify entity
```
bin/make entity
```
### To check schema of database
```
bin/doctrine schema:validate
```
### To modify attribute of entity
```
bin/doctrine migrations:execute --down "DoctrineMigrations\Version{number of migration's file}"
```

### To migrate data base
```
bin/make migration
bin/doctrine migrations:migrate
```
