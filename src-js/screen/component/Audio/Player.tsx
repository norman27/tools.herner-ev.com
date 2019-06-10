import * as React from "react";

interface AudioSettings {
    track: string;
    volume: number;
    lastChange: number;
}

interface IProps {
    track: string,
    volume: number,
    lastChange: number,
    timestamp: number
}

interface IState {
    isPlaying: boolean,
    isAutoplayAllowed: boolean
}

const getTrack = (props: IProps): string => {
    // play silence if selected track is too old
    return (props.lastChange + 10 > props.timestamp) ? props.track : '/audio/silence.mp3';
}

class Player extends React.Component<IProps, IState> {
    constructor(props: IProps) {
        super(props);
        this.state = {
            isPlaying: false,
            isAutoplayAllowed: false
        }
    }

    componentDidMount() {
        if (!this.state.isPlaying) {
            this.play(event, getTrack(this.props));
            this.setState({isPlaying: true});
        }
    }

    componentDidUpdate(prevProp: IProps) {
        if (this.props.track === "") {
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
        node.src = track;
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
                    <button onClick={this.handleAllowAutoplay}>Turn on Sound</button>
                }
            </div>
        )
    }
}

export { Player, AudioSettings }