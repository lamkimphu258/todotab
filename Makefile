build:
	docker-compose build

up:
	docker-compose up -d

down:
	docker-compose down

restart: down up

env-init:
	ln -s "${PWD}/app/.env" "${PWD}/.env"

container-list:
	docker-compose ps

app-exec:
	docker-compose exec app

composer-install:
	docker-compose exec app \
	composer install

composer-require:
	docker-compose exec app \
    composer require $(PKG)

yarn-install:
	docker-compose exec app \
	yarn install

yarn-dev:
	docker-compose exec app \
	yarn run dev

yarn-watch:
	docker-compose exec app \
	yarn run watch

