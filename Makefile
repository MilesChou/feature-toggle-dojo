#!/usr/bin/make -f

.PHONY: database

# ---------------------------------------------------------------------

all: test

clean:
	rm -f ./.env

test:
	php vendor/bin/phpcs
	phpdbg -qrr vendor/bin/phpunit

coverage: test
	@if [ "`uname`" = "Darwin" ]; then open build/coverage/index.html; fi

up:
	docker-compose up -d
	php artisan migrate -v
	php artisan db:seed

down:
	docker-compose down -v
