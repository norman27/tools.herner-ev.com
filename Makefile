release:
	mv .env.local .env.local-release
	composer install --no-dev -o
	npm ci
	npm run build:prod
	rm -f release-bundle.tgz
	tar -czvf release-bundle.tgz --exclude vendor/bin config public src templates translations vendor .env
	mv .env.local-release .env.local

dev:
	docker-compose up -d