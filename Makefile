DOCKER_COMPOSE = docker-compose
EXEC_PHP       = $(DOCKER_COMPOSE) exec -T php

install: init-env start vendor ## Init project

init-env: ## Init Env
	cp .env.example .env

start: ## Run project
	$(DOCKER_COMPOSE) up --build --remove-orphans --force-recreate --detach

vendor: ## Composer install
	$(EXEC_PHP) composer install

generate: ## Generate Promocodes "make generate ARGS="1000""
	$(EXEC_PHP) php generate_promocodes.php $(ARGS)

help: ## Help
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-24s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m## /[33m/' && printf "\n"

.PHONY: install init-env generate start vendor
