RUN=docker compose run --rm --user $(shell id -u):$(shell id -g) app

install:
	$(RUN) composer install

tests:
	$(RUN) bin/phpunit

tool:
	$(RUN) sh
