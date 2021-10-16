build:
	docker-compose build

up:
	docker-compose up -d

down:
	docker-compose down

restart: down up

rebuild: build restart

env-init:
	ln -s "${PWD}/app/.env" "${PWD}/.env"

container-list:
	docker-compose ps

app-exec:
	docker-compose exec app

app-bin-console:
	docker-compose exec app \
	php bin/console $(cmd)

composer-install:
	docker-compose exec app \
	composer install

composer-require:
	docker-compose exec app \
    composer require $(pkg)

composer-remove:
	docker-compose exec app \
	composer remove $(pkg)

composer-dumpautoload:
	docker-compose exec app \
	composer dumpautoload

composer-update:
	docker-compose exec app \
	composer update

yarn-install:
	docker-compose exec app \
	yarn install

yarn-add:
	docker-compose exec app \
	yarn add $(pkg)

yarn-remove:
	docker-compose exec app \
	yarn remove $(pkg)

yarn-dev:
	docker-compose exec app \
	yarn run dev

yarn-watch:
	docker-compose exec app \
	yarn run watch

test-unit:
	docker-compose exec app \
	php bin/phpunit tests/Unit

test-integration:
	docker-compose exec app \
	php bin/phpunit tests/Integration

test-all:
	docker-compose exec app \
	php bin/phpunit tests/

test-one:
	docker-compose exec app \
	php bin/phpunit $(test)

test-coverage:
	docker-compose exec app \
	php bin/phpunit --coverage-html build
