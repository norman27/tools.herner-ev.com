import * as React from 'react';
import { Player, AudioSettings } from './Audio/Player';
import { Routing } from '../../routing/Routing';

interface IProps {}

interface IState {
    audio: AudioSettings,
    timestamp: number,
    error?: string
}

export default class App extends React.Component<IProps, IState> {
    private defaultState: IState = {
        audio: {
            track: '/audio/silence.mp3',
            volume: 80,
            lastChange: 0
        },
        timestamp: 0
    }

    constructor(props: IProps) {
        super(props);
        this.state = this.defaultState
    }

    refreshStateFromApi(): void {
        var state = this.defaultState;

        //@see https://reactjs.org/docs/faq-ajax.html
        fetch(Routing.generate('screen_api'))
            .then(res => res.json())
            .then(
                (result) => {
                    this.setState(result);
                },
                (error) => {
                    this.setState({...this.defaultState, error});
                }
            );
    }

    componentDidMount() {
        var that = this;
        window.setInterval(function(): void {
            that.refreshStateFromApi();
        }, 2000);
    }

    render() {
        //@TODO on first render these values are not yet fetched from API
        return (
            <div>
                <Player {...this.state.audio} timestamp={this.state.timestamp} />
            </div>
        )
    }
}