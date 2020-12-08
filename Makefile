DOCKER_COMPOSE = docker-compose
EXEC_PHP       = $(DOCKER_COMPOSE) exec -T php

start: ## Run project
	$(DOCKER_COMPOSE) up --build --remove-orphans --force-recreate --detach

help: ## Help
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-24s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m## /[33m/' && printf "\n"
