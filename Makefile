release-bundle:
	mv .env.local .env.local-release
	composer install --no-dev -o
	npm ci
	npm run build:prod
	tar -czvf release-bundle.tgz config public src templates translations vendor .env --exclude vendor/bin
	mv .env.local-release .env.local

run-dev:
	docker-compose up