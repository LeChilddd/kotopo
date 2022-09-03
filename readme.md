# Getting Started

## Needed
Docker

## To install app
```
make install
```
Open your Browser at `kotopo.localhost`
Accept the auto-generated TLS certificate

If necessary stop container, recreate them and update composer
```
docker-compose down --remove-orphans
docker-compose up -d --force-recreate --build
bin/composer update
```

### To start app of after changing branch
To restart app and download the needed library
```
make up
```

## Update and run frontend environment
```
bin/yarn install
bin/yarn watch
```

## Database
To connect to phpmyadmin, in server add 'database', and enter your login.<br/>
http://myadmin.kotopo.localhost
```
User : root
Password : root
```

### To make or modify entity
```
bin/make entity
```
### Make authentification
```
bin/make auth
```
### To check schema of database
```
bin/doctrine schema:validate
```

### Create and run file of migration
```
bin/make migration
bin/doctrine migrations:migrate

# Drop database
bin/doctrine d:d --force
```
### DataFixtures
```
# load fixtures : 
bin/doctrine f:l
```

## Test mail local 
http://mailhog.kotopo.localhost/#
