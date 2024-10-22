build:
	docker-compose build
up:
	docker-compose up -d
down:
	docker-compose down
php-fpm:
	docker-compose exec php-fpm bash
test:
	docker-compose run --rm php-fpm php artisan test --env=testing
clear:
	docker-compose run --rm php-fpm php artisan opti:clear

