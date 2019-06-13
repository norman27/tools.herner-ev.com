const $ = require('../../node_modules/jquery/dist/jquery.min.js');
require('../../node_modules/popper.js/dist/umd/popper.min.js');
require('../../node_modules/bootstrap/dist/js/bootstrap.min.js');
require('../../node_modules/@coreui/coreui/dist/js/coreui.min.js');

import * as React from 'react';
import * as ReactDOM from 'react-dom';
import Settings from './component/audio/Settings';
import TrackTable from './component/audio/TrackTable';

//@TODO handle this better (sourrounding app?)
const audioSettings = document.getElementById('tab-audio-settings');
if(audioSettings) {
    const volume = audioSettings.dataset.volume;
    ReactDOM.render(<Settings volume={volume} />, audioSettings);
}

const audioTrack = document.getElementById('tab-audio-track');
if(audioTrack) {
    const track = audioTrack.dataset.volume;
    ReactDOM.render(<TrackTable />, audioTrack);
}