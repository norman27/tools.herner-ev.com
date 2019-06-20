import * as React from 'react';
import * as ReactDOM from 'react-dom';
import { Settings } from './Settings';
import { TrackTable } from './TrackTable';
import { Routing } from '../../../routing/Routing';

const Audio = ({ dispatch }) => {
    const audioSettings = document.getElementById('tab-audio-settings');
    ReactDOM.render(<Settings dispatch={dispatch} volume={audioSettings.dataset.volume} />, audioSettings);
    ReactDOM.render(<TrackTable dispatch={dispatch} />, document.getElementById('tab-audio-track'));

    return (null)
}

export { Audio }