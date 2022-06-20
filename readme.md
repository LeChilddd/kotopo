# Getting Started

## Needed
Docker

## Run
```
docker-compose up -d
```
Open your Browser at `kotopo.localhost`
Accept the auto-generated TLS certificate

If necessary stop container, recreate them and update composer
```
docker-compose down --remove-orphans
docker-compose up -d --force-recreate --build
bin/composer update
```

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

### Create and run file of migration
```
bin/make migration
bin/doctrine migrations:migrate
```
