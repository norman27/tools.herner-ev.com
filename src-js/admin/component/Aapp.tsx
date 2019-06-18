import * as React from 'react';
import * as ReactDOM from 'react-dom';
import { connect } from 'react-redux';
import { NotificationContainer } from 'react-notifications';
import Settings from './audio/Settings';
import TrackTable from './audio/TrackTable';

const App = ({ dispatch }) => {
    //@TODO handle this better
    const audioSettings = document.getElementById('tab-audio-settings');
    if (audioSettings) {
        const volume = audioSettings.dataset.volume;
        ReactDOM.render(<Settings dispatch={dispatch} volume={volume} />, audioSettings);
    }

    const audioTrack = document.getElementById('tab-audio-track');
    if (audioTrack) {
        const track = audioTrack.dataset.volume;
        ReactDOM.render(<TrackTable dispatch={dispatch} />, audioTrack);
    }

    return (
        <div>
            <NotificationContainer />
        </ div>
    )
}

export default connect()(App);