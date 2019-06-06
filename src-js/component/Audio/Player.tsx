import * as React from "react";

interface AudioSettings {
    src: string;
    volume: number;
}

interface IProps {
    src: string,
    volume: number
}

interface IState extends AudioSettings {
    isPlaying: boolean,
    isAutoplayAllowed: boolean
}

class Player extends React.Component<IProps, IState> {
    constructor(props: IProps) {
        super(props);
        this.state = {
            isPlaying: false,
            isAutoplayAllowed: false,
            ...props
        }
    }

    componentDidUpdate(prevProp: IProps) {
        if (this.props.src === "") {
            this.stop();
        } else if (this.props.src !== prevProp.src) {
            this.play();
        }

        if (this.props.volume !== prevProp.volume) {
            this.setVolume(this.props.volume);
        }
    }

    componentDidMount() {
        if (!this.state.isPlaying) {
            this.play();
            this.setState({isPlaying: true});
        }
    }

    handleAllowAutoplay() {
        this.play();
    }

    play() {
        var node = document.getElementById('audio') as HTMLAudioElement;
        node.pause();
        node.src = this.props.src;
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