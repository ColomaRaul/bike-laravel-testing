PHP_CONTAINER="app-php"

init: build up

build:
	docker-compose -f docker-compose.yml build

up:
	docker-compose -f docker-compose.yml up -d

down:
	docker-compose -f docker-compose.yml down

bash:
	docker exec -it ${PHP_CONTAINER} sh

exec/%:
	@docker exec -it ${PHP_CONTAINER} $*

composer-install:
	@make exec/"composer install"

composer/%:
	@make exec/"composer $*"