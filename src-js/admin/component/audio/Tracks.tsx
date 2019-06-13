import * as React from 'react';
import { Routing } from '../../../routing/Routing';

type AudioTrack = {
    track: string,
    duration: number
}

interface IProps {}

interface IState {
    tracks: AudioTrack[]
}

export default class Tracks extends React.Component<IProps, IState> {
    constructor(props: IProps) {
        super(props);
        this.state = {
            tracks: []
        }
    }

    componentDidMount() {
        fetch(Routing.generate('admin.get.audio.tracks'))
            .then(response => response.json())
            .then(
                (result) => {
                    this.setState(result);
                }
            );
    }

    handleClickTrack = (event: React.MouseEvent<HTMLButtonElement>, track: string) => {
        fetch(Routing.generate('admin.audio.track', {track: track}), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if (response.status >= 200 && response.status < 300) {
                return response; //@TODO just show notification
            } else {
                //@TODO just show notification
                console.log('Somthing happened wrong');
            }
        }).catch(err => err);
    }

    render() {
        return (
            <table className="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Dauer</th>
                        <th>Aktion</th>
                    </tr>
                </thead>
                <tbody>
                    {this.state.tracks.map((value, index) => {
                        // @TODO move to subcomponent: https://stackoverflow.com/questions/29810914/react-js-onclick-cant-pass-value-to-method
                        return <tr key={value.track}>
                            <td>{value.track}</td>
                            <td>{value.duration}s</td>
                            <td>
                                <button onClick={(event: React.MouseEvent<HTMLButtonElement>) => this.handleClickTrack(event, value.track)} type="button">
                                    <i className="far fa-play-circle" /> Abspielen
                                </button>
                            </td>
                        </tr>
                    })}
                </tbody>
            </table>
        )
    }
}