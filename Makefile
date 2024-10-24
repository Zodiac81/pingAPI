build:
	docker-compose build
up:
	docker-compose up nginx -d
down:
	docker-compose down -v
php-fpm:
	docker-compose exec php-fpm bash
test:
	docker-compose run --rm php-fpm php artisan test --env=testing
clear:
	docker-compose run --rm php-fpm php artisan opti:clear




