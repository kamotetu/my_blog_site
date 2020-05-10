up:
	HOST_UID=$(shell id -u) docker-compose up -d --build
down:
	docker-compose down
ssh:
	docker-compose exec -u www-data app bash
