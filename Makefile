release-bundle:
	mv .env.local .env.local-release
	composer install --no-dev -o
	npm ci
	npm run build:prod
	tar -czvf --exclude vendor/bin release-bundle.tgz config public src templates translations vendor .env
	mv .env.local-release .env.local

run-dev:
	docker-compose up -d