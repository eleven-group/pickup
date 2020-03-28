up:
	docker-compose up -d --build

down:
	docker-compose down

run:
	docker-compose up --build

sh-php:
	docker exec -ti pickup-php sh

sh-front:
	docker exec -ti pickup-front sh

sh-admin:
	docker exec -ti pickup-admin sh

first-init:
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

