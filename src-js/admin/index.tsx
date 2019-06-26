const $ = require('../../node_modules/jquery/dist/jquery.min.js');
require('../../node_modules/popper.js/dist/umd/popper.min.js');
require('../../node_modules/bootstrap/dist/js/bootstrap.min.js');
require('../../node_modules/@coreui/coreui/dist/js/coreui.min.js');

import * as React from 'react';
import * as ReactDOM from 'react-dom';
import { createStore, combineReducers } from 'redux';
import { Provider } from 'react-redux';
import { ConnectedApp } from './component/App';
import { NotificationReducer } from './reducers/NotificationReducer';

const store = createStore(combineReducers({
    NotificationReducer,
}));

ReactDOM.render(
    <Provider store={store}>
        <ConnectedApp />
    </Provider>,
    document.getElementById('app')
)