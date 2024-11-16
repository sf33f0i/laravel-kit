-include .env
export

all: up

cp-env:
	@test -f .env || cp .env.example .env

build:
	./build.sh

install: cp-env build composer-install up artisan-key-generate yarn-install yarn-prod migrate artisan-seed artisan-storage-link

install-dev: cp-env build composer-install-dev up artisan-key-generate yarn-install migrate artisan-seed yarn-prod artisan-storage-link

up:
	@docker-compose up -d --build --remove-orphans

down:
	@docker-compose down

down-v:
	@docker-compose down -v

restart:
	@docker-compose restart

stop:
	@docker-compose stop

env:
	@docker-compose exec --user=www-data php bash

env-root:
	@docker-compose exec php bash

artisan-key-generate:
	@docker-compose exec --user=www-data php php artisan key:generate

artisan-storage-link:
    @docker-compose exec --user=www-data php php artisan storage:link

composer-install:
	@docker-compose run --rm -e COMPOSER_MEMORY_LIMIT=-1 php composer install --no-dev

composer-install-dev:
	@docker-compose run --rm -e COMPOSER_MEMORY_LIMIT=-1 php composer install

composer-command:
	@docker-compose run --rm php composer $(command)

migrate:
	@docker-compose exec --user=www-data php php artisan migrate

artisan-seed:
	@docker-compose exec --user=www-data php php artisan db:seed

generate-ide-helper:
	@docker-compose exec --user=www-data php php artisan ide-helper:generate

artisan-cmd:
	@docker-compose exec --user=www-data php php artisan $(cmd)

admin-lte:
	@docker-compose exec --user=www-data php php artisan adminlte:install

crud-generator:
	@docker-compose exec --user=www-data php php artisan vendor:publish --provider="Appzcoder\CrudGenerator\CrudGeneratorServiceProvider"

yarn-install:
	@docker-compose run --rm node yarn install

yarn-watch:
	@docker-compose run --rm node yarn dev

yarn-prod:
	@docker-compose run --rm node yarn build

yarn-command:
	@docker-compose run --rm node yarn $(command)

create-dump:
	@docker-compose exec db pg_dump -U $(DB_USERNAME) -d $(DB_DATABASE) -Fp -b -O > $(PROJECT_NAME).sql
