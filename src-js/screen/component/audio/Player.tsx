import * as React from 'react';

interface Props {
    track: string,
    volume: number,
    lastChange: number,
    timestamp: number
}

interface State {
    isPlaying: boolean,
    isAutoplayAllowed: boolean
}

/**
 * Play silence if no track given or track is too old
 * @param props
 */
const getTrack = (props: Props): string => {
    return (props.track && props.lastChange + 10 > props.timestamp) ? props.track : 'silence.mp3';
}

class Player extends React.Component<Props, State> {
    state: State = {
        isPlaying: false,
        isAutoplayAllowed: false
    }

    componentDidMount() {
        if (!this.state.isPlaying) {
            this.play(event, getTrack(this.props));
            this.setState({isPlaying: true});
        }
    }

    componentDidUpdate(prevProp: Props) {
        if (this.props.track === '') {
            this.stop();
        } else if (this.props.track !== prevProp.track || this.props.lastChange !== prevProp.lastChange) {
            this.play(event, getTrack(this.props));
        }

        if (this.props.volume !== prevProp.volume) {
            this.setVolume(this.props.volume);
        }
    }

    handleAllowAutoplay = (event: React.MouseEvent<HTMLButtonElement>) => {
        event.stopPropagation();
        this.play(event, getTrack(this.props));
    }

    play = (event: any, track: string) => {
        var node = document.getElementById('audio') as HTMLAudioElement;
        node.pause();
        node.src = '/audio/' + track;
        var promise = node.play() as Promise<void>;

        // @see https://developers.google.com/web/updates/2017/09/autoplay-policy-changes#example_scenarios
        if (promise !== undefined) {
            promise.then(_ => {
                this.setState({isAutoplayAllowed: true});
            }).catch(error => {});
        }
    }

    stop() {
        var node = document.getElementById('audio') as HTMLAudioElement;
        node.pause();
    }

    setVolume(volume: number) {
        var node = document.getElementById('audio') as HTMLAudioElement;
        node.volume = volume / 100;
    }

    render() {
        return (
            <div>
                <audio ref="player" id="audio" autoPlay/>
                {(this.state.isPlaying && !this.state.isAutoplayAllowed) &&
                    <button id="turn-on-sound" onClick={this.handleAllowAutoplay}>Sound erlauben</button>
                }
            </div>
        )
    }
}

export { Player }