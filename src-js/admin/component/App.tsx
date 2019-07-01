import * as React from 'react';
import * as ReactDOM from 'react-dom';
import { connect } from 'react-redux';
import { NotificationContainer } from 'react-notifications';
import { Settings } from './audio/Settings';
import { TrackTable } from './audio/TrackTable';
import { Games } from './aside/Games';
import { ScreenTable } from './screen/ScreenTable';
import { Routing } from '../../symfony/routing/Routing';

const App = ({ dispatch }) => {

    ReactDOM.render(<Games />, document.getElementById('aside-games'));

    switch(window.location.pathname) {
        case Routing.generate('admin.screen.audio'):
            const audioSettings = document.getElementById('audio-settings');
            ReactDOM.render(<Settings dispatch={dispatch} volume={audioSettings.dataset.volume} />, audioSettings);
            ReactDOM.render(<TrackTable dispatch={dispatch} />, document.getElementById('audio-track'));
            break;
        case Routing.generate('admin.screen.screens'):
            ReactDOM.render(<ScreenTable dispatch={dispatch} />, document.getElementById('screen-list'));
            break;
    }

    return (
        <div>
            <NotificationContainer />
        </ div>
    )
}

const ConnectedApp = connect()(App);

export { ConnectedApp }