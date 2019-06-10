import * as React from "react";

// @TODO with the current logic it is not possible to run the same track again without selecting silence in between

interface AudioSettings {
    src: string;
    volume: number;
    lastChange: number;
}

interface IProps {
    src: string,
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
    return (props.lastChange + 10 > props.timestamp) ? props.src : '/audio/silence.mp3';
}

class Player extends React.Component<IProps, IState> {
    constructor(props: IProps) {
        super(props);
        this.state = {
            isPlaying: false,
            isAutoplayAllowed: false
        }
    }

    componentDidUpdate(prevProp: IProps) {
        if (this.props.src === "") {
            this.stop();
        } else if (this.props.src !== prevProp.src) {
            this.play(event, getTrack(this.props)); //@TODO fix event
        }

        if (this.props.volume !== prevProp.volume) {
            this.setVolume(this.props.volume);
        }
    }

    componentDidMount() {
        if (!this.state.isPlaying) {
            this.play(event, getTrack(this.props)); //@TODO fix event
            this.setState({isPlaying: true});
        }
    }

    handleAllowAutoplay = (event) => {
        event.stopPropagation();
        // play silence if selected track is too old
        (this.props.lastChange + 10 > this.props.timestamp) ? this.props.src : '/audio/silence.mp3'
        this.play(event, getTrack(this.props));
    }

    // @see https://stackoverflow.com/questions/33973648/react-this-is-undefined-inside-a-component-function
    play = (event, track) => {
        var node = document.getElementById('audio') as HTMLAudioElement;
        node.pause();
        node.src = track;
        var promise = node.play() as Promise<void>;

        // @see https://developers.google.com/web/updates/2017/09/autoplay-policy-changes#example_scenarios
        if (promise !== undefined) {
            promise.then(_ => {
                this.setState({isAutoplayAllowed: true});
            }).catch(error => {
                this.setState({isAutoplayAllowed: false});
            });
        }
    }

    stop() {
        var node = document.getElementById('audio') as HTMLAudioElement;
        node.pause();
    }

    /**
     * @param number volume Between 0-100
     */
    setVolume(volume: number) {
        var node = document.getElementById('audio') as HTMLAudioElement;
        node.volume = this.props.volume / 100;
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