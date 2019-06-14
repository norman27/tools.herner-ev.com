import * as React from 'react';
import * as ReactDOM from 'react-dom';
import Settings from './audio/Settings';
import TrackTable from './audio/TrackTable';
import { connect } from 'react-redux';

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
        <div></ div>
    )
}

export default connect()(App);