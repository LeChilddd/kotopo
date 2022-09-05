#!make
.DEFAULT_GOAL := help
.PHONY: help
SHELL := /bin/bash

.PHONY: help
help:
	@grep -E '^[a-zA-Z0-9_-]+:.*?## .*$$' Makefile| sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[32m%-15s\033[0m %s\n", $$1, $$2}'

.PHONY: install
install: ## Fresh install of all containers
	git config core.hooksPath ./.git-tools
	cat .git-tools/aliases >> .git/config
	make install-app

.PHONY: install-app
install-app:
	make images
	make init-deps
	make init-db

.PHONY: up
up:
	docker-compose up -d --force-recreate
	make init-deps
	make init-db

.PHONY: images
images:
	docker-compose up -d --force-recreate --build

.PHONY: init-deps
init-deps:
	bin/composer install
	bin/yarn install

.PHONY: init-db
init-db:
	docker-compose run --rm php php bin/console doctrine:database:create --if-not-exists || true
	docker-compose exec -T php php bin/console doctrine:migrations:migrate -n | ccze -m ansi

.PHONY: db-drop
db-drop:
	docker-compose run --rm php php bin/console doctrine:database:drop --force || true



