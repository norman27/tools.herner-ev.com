release-bundle:
	tar -czvf release-bundle.tgz config public src templates translations vendor .env

run-dev:
	docker-compose up