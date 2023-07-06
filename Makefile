PHP_CONTAINER="app-php"

init: build up migrate

build:
	docker-compose -f docker-compose.yml build

up:
	docker-compose -f docker-compose.yml up -d

down:
	docker-compose -f docker-compose.yml down

bash:
	docker exec -it ${PHP_CONTAINER} sh

migrate:
	@make exec/"php artisan migrate"

exec/%:
	@docker exec -it ${PHP_CONTAINER} $*

composer-install:
	@make exec/"composer install"

composer/%:
	@make exec/"composer $*"

test:
	@make exec/"php artisan test"