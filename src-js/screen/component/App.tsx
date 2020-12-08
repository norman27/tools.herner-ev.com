/// <reference path="../types.ts" />

import * as React from 'react';
import { Player } from './audio/Player';
import { Effect } from './effect/Effect';
import { Screen } from './screen/Screen';
import { Routing } from '../../symfony/routing/Routing';

interface State {
    audio: AudioSettings,
    effect: EffectSettings,
    screen: ScreenSettings,
    timestamp: number,
}

declare global {
    interface Window { screenInitState: State; }
}

class App extends React.Component<{}, State> {
    state: State = {
        audio: {
            track: 'silence.mp3',
            volume: 80,
            lastChange: 0
        },
        effect: {
            id: '',
            name: ''
        },
        screen: {
            screenType: 'loading',
            config: []
        },
        timestamp: 0
    }

    constructor(props) {
        super(props);
    }

    refreshStateFromApi(): void {
        fetch(Routing.generate('screen_api'))
            .then(response => response.json())
            .then(
                (result) => {
                    this.setState(result);
                },
                (error) => {
                    // @TODO do we need this?
                }
            );
    }

    componentDidMount() {
        const that = this;
        this.setState(window.screenInitState);
        window.setInterval(function(): void {
            that.refreshStateFromApi();
        }, 2000);
    }

    render() {
        return (
            <div>
                <Player {...this.state.audio} timestamp={this.state.timestamp} />
                <Effect {...this.state.effect} />
                <Screen {...this.state.screen} />
            </div>
        )
    }
}

export { App }