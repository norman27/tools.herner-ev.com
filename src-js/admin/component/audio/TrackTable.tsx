/// <reference path="../../types.ts" />

import * as React from 'react';
import { Dispatch } from 'redux';
import { Routing } from '../../../routing/Routing';
import TrackRow from './TrackRow';

type Props = {
    dispatch: Dispatch<NotificationActionType>
}

type State = {
    tracks: Track[]
}

export default class TrackTable extends React.Component<Props, State> {
    state: State = {
        tracks: []
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
                        return <TrackRow dispatch={this.props.dispatch} {...value} key={index} />
                    })}
                </tbody>
            </table>
        )
    }
}