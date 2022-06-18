# Getting Started

## Needed
Docker

## Run
```
docker-compose up -d
```
Open your Browser at `kotopo.localhost`
Accept the auto-generated TLS certificate

if necessary
```
docker-compose down --remove-orphans to stop the Docker containers.
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
