# HEV Leinwand

[![CircleCI](https://circleci.com/gh/norman27/hev-leinwand-herner-ev-com.svg?style=svg)](https://circleci.com/gh/norman27/hev-leinwand-herner-ev-com)

This consists of tools to run Online Services for Herner EV. See Images for examples:

![Image of Admin](https://raw.githubusercontent.com/norman27/hev-leinwand-herner-ev-com/master/doc/admin.png)
![Image of Screen](https://raw.githubusercontent.com/norman27/hev-leinwand-herner-ev-com/master/doc/screen.png)


## Requirements
In order to run the application you need a MySQL server. Copy the file `app/config/parameters.yml.dist`
to `app/config/parameters.yml` and fill in the required credentials.  

## Installation
```bash
composer install
npm ci
```
Afterwards you need to compile the frontend code:
```bash
npm run build:prod
```
To run the server for development use:
```bash
php bin/console server:run
```

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
