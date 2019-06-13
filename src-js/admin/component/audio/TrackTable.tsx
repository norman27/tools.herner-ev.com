import * as React from 'react';
import { Routing } from '../../../routing/Routing';
import TrackRow from './TrackRow';

interface IProps {}

interface IState {
    tracks: Track[]
}

export default class TrackTable extends React.Component<IProps, IState> {
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
                    {this.state.tracks.map((value: Track, index) => {
                        return <TrackRow {...value} />
                    })}
                </tbody>
            </table>
        )
    }
}