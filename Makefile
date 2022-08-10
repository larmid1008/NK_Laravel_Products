CURRENT_ID=$([[ $(id -u) -gt 9999 ]] && echo "root" || id -u)
CURRENT_GROUP=$([[ $(id -g) -gt 9999 ]] && echo "root" || id -g)

DC := CURRENT_USER=${CURRENT_ID}:${CURRENT_GROUP} docker-compose
FPM := $(DC) exec php-fpm
ARTISAN := $(FPM) php artisan

artisan:
	@$(ARTISAN) $@

env:
	cp ./.env.example ./.env

build:
	@$(DC) build

start:
	@$(DC) up -d

stop:
	@$(DC) stop

keygen:
	@$(ARTISAN) key:generate

migrate:
	@$(ARTISAN) migrate

migrate_fresh:
	@$(ARTISAN) migrate:fresh

migrate_refresh:
	@$(ARTISAN) migrate:refresh

seed:
	@$(ARTISAN) db:seed

api_list:
	@$(ARTISAN) route:list

composer-install:
	@$(FPM) composer install

dump-autoload:
	@$(FPM) composer dump-autoload

install: env build start composer-install dump-autoload keygen migrate seed

dev: start dump-autoload

deploy: env build start composer-install dump-autoload keygen migrate



