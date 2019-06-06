import * as React from "react";
import { Player, AudioSettings } from "./Audio/Player";

interface IProps {}

interface IState {
    audio: AudioSettings
    error?: string
}

export default class App extends React.Component<IProps, IState> {
    private defaultState: IState = {
        audio: {
            src: "",
            volume: 80
        }
    }

    constructor(props: IProps) {
        super(props);
        this.state = this.defaultState
    }

    refreshStateFromApi(): void {
        var state = this.defaultState;

        //@see https://reactjs.org/docs/faq-ajax.html
        fetch("/api/v1/state.json")
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
        return (
            <div>
                <Player {...this.state.audio} />
            </div>
        )
    }
}