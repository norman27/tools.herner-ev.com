import * as React from "react";
import Player from "./Audio/Player";

interface IProps {
    startCount: number
}

interface IState {
    count: number
}

export default class App extends React.Component<IProps, IState> {
    constructor(props: IProps) {
        super(props);
        this.state = {count: props.startCount}
    }

    render() {
        var player = {
            src: '/audio/1-second-of-silence.mp3',
            volume: 100
        };

        if (this.state.count > 5) {
            player.src = '/audio/dark-knight-rises.mp3';
        }

        return (
            <div>
                Count: {this.state.count}
                <Player {...player} />
            </div>
        )
    }

    increment() {
        this.setState({count: this.state.count + 1});
    }

    componentDidMount() {
        var that = this;
        window.setInterval(function() {
            that.increment();
        }, 1000);
    }
}