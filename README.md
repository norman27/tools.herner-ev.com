# HEV Leinwand

[![CircleCI](https://circleci.com/gh/norman27/tools.herner-ev.com.svg?style=svg)](https://circleci.com/gh/norman27/tools.herner-ev.com)

This consists of tools to run Online Services for Herner EV. This includes for example the ice rink screen:

![Image of Screen](https://raw.githubusercontent.com/norman27/tools.herner-ev.com/master/doc/screen.png)


## Installation
The application can be run locally using docker. First copy the file `.env` to `.env.local`
and change the MySQL configuration to `DATABASE_URL=mysql://hev:hev@tools.herner-ev.local:3306/hev?serverVersion=5.7`

Then you need to install backend and frontend packages and build the assets:
```bash
composer install
npm ci
npm run build:prod
```

### Database
You can initialize the database with example data by executing:
```bash
bin/console doctrine:database:create
bin/console doctrine:schema:create
bin/console doctrine:database:import sql/example.sql
```
This includes an admin user with username / password: `admin / admin`

### Frontend Routing
We use the FOSJsRoutingBundle for frontend routing. This means all routes being used need to be exposed.
Whenever exposed routes change you need to execute `npm run fos-routes` to regenerate the config
used by the frontend router.

## Electron
For development testing simply run:
```bash
npm run electron:start
```
The following command will output an electron app to `./electron/dist`
```bash
npm run electron:dist
```
