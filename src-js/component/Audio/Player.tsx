import * as React from "react";

interface IProps {
    src: string,
    volume: number
}

interface IState {
    isPlaying: boolean,
    isAutoplayAllowed: boolean,
    src: string,
    volume: number
}

export default class Player extends React.Component<IProps, IState> {
    constructor(props: IProps) {
        super(props);
        this.state = {
            isPlaying: false,
            isAutoplayAllowed: false,
            ...props
        }
    }

    componentDidUpdate(prevProp: IProps) {
        if (this.props.src !== prevProp.src) {
            this.play(event);
        }
    }

    componentDidMount() {
        if (!this.state.isPlaying) {
            this.play(event);
            this.setState({isPlaying: true});
        }
    }

    handleAllowAutoplay = (event) => {
        this.play(event);
    }

    play = (event) => {
        var node = document.getElementById('audio') as HTMLAudioElement;
        node.pause();
        node.src = this.props.src;
        node.volume = this.props.volume / 100;
        var promise = node.play() as Promise<void>;

        if (promise !== undefined) {
            promise.then(_ => {
                this.setState({isAutoplayAllowed: true});
            }).catch(error => {
                this.setState({isAutoplayAllowed: false});
            });
        }
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