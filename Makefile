PROJECT_NAME=pickup

up:
	docker-compose up -d --build

down:
	docker-compose down --remove-orphans

help:
	@grep -E '(^[0-9a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-25s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

run:
	docker-compose up --build

restart:
	make down && \
	make up

sh-php:
	docker exec -ti pickup-php sh

sh-front:
	docker exec -ti pickup-front sh

sh-admin:
	docker exec -ti pickup-admin sh

network:
	docker network create ${PROJECT_NAME}

first-init:
	make network
	make up
	make copy-env
	make install

copy-env:
	cp front/.env.dist front/.env
	cp api/.env api/.env.local

php-dev:
	docker exec pickup-php make reset-dev

install: up
	make install-php
	make install-front
	make install-admin

install-php:
	docker exec pickup-php make install
	docker exec pickup-php make reset-dev

install-front:
	docker exec pickup-front yarn install

install-admin:
	docker exec pickup-admin yarn install

.PHONY: up down run sh-php sh-front sh-admin first-init copy-env install install-php php-dev install-admin install-front

