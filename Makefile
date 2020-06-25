up:
	HOST_UID=$(shell id -u) docker-compose up -d
down:
	docker-compose down
ssh:
	docker-compose exec -u www-data app bash

build:
	HOST_UID=$(shell id -u) docker-compose up -d --build
