import * as React from 'react';
import * as ReactDOM from 'react-dom';
import { connect } from 'react-redux';
import { NotificationContainer } from 'react-notifications';
import { Settings } from './Audio/Settings';
import { TrackTable } from './Audio/TrackTable';

const App = ({ dispatch }) => {
    //@TODO handle this better
    const audioSettings = document.getElementById('tab-audio-settings');
    if (audioSettings) {
        ReactDOM.render(<Settings dispatch={dispatch} volume={audioSettings.dataset.volume} />, audioSettings);
    }

    const audioTrack = document.getElementById('tab-audio-track');
    if (audioTrack) {
        ReactDOM.render(<TrackTable dispatch={dispatch} />, audioTrack);
    }

    return (
        <div>
            <NotificationContainer />
        </ div>
    )
}

const ConnectedApp = connect()(App);

export { ConnectedApp }