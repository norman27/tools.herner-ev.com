import * as React from 'react';
import { Player, AudioSettings } from './Audio/Player'; //@TODO maybe better naming and splitting?
import { Effect, EffectSettings } from './Effect/Effect';
import { Screen, ScreenSettings } from './Screen/Screen';
import { Routing } from '../../routing/Routing';

interface IProps {}

interface IState {
    audio: AudioSettings,
    effect: EffectSettings,
    screen: ScreenSettings,
    timestamp: number,
    error?: string
}

export default class App extends React.Component<IProps, IState> {
    private defaultState: IState = {
        audio: {
            track: 'silence.mp3',
            volume: 80,
            lastChange: 0
        },
        effect: {},
        screen: {
            type: 'image', // @TODO add another default for preloading
            data: []
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
            .then(response => response.json())
            .then(
                (result) => {
                    this.setState(result);
                },
                (error) => {
                    // @TODO do we need this?
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
                <Screen {...this.state.screen} />
                <Player {...this.state.audio} timestamp={this.state.timestamp} />
                <Effect {...this.state.effect} />
            </div>
        )
    }
}