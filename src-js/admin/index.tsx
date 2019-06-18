const $ = require('../../node_modules/jquery/dist/jquery.min.js');
require('../../node_modules/popper.js/dist/umd/popper.min.js');
require('../../node_modules/bootstrap/dist/js/bootstrap.min.js');
require('../../node_modules/@coreui/coreui/dist/js/coreui.min.js');

import * as React from 'react';
import * as ReactDOM from 'react-dom';
import { createStore } from 'redux';
import { Provider } from 'react-redux';
import App from './component/App';
import appReducer from './reducers';

const store = createStore(appReducer);

ReactDOM.render(
    <Provider store={store}>
        <App />
    </Provider>,
    document.getElementById('app')
)