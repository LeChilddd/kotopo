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

