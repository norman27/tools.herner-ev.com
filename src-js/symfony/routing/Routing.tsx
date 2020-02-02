import {Router} from 'symfony-ts-router';
const routes = require('./fos_js_routes.json');

const Routing = new Router();
Routing.setRoutingData(routes);

export { Routing }