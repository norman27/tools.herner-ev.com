import FOSRouting from '../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router';

const routes = require('./fos_js_routes.json');
FOSRouting.setRoutingData(routes);
const Routing = FOSRouting;

export { Routing }