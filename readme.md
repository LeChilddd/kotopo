# Getting Started

To connect to phpmyadmin, in server add 'database', and enter your login.

### Run
```
docker-compose up -d --force-recreate
docker-compose up -d --build
bin/composer update
```

### To make entity
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
