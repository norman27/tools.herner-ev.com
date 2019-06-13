import * as React from 'react';
import Settings from './component/audio/Settings';
import TrackTable from './component/audio/TrackTable';

interface IProps {}

interface IState {}

export default class App extends React.Component<IProps, IState> {
    render() {
        //@TODO handle this better
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

        return (
            <div></div>
        )
    }
}