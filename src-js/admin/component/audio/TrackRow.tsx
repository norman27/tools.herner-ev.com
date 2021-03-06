/// <reference path="../../types.ts" />

import * as React from 'react';
import { Dispatch } from 'redux';
import { Routing } from '../../../symfony/routing/Routing';
import { apiPost } from './Settings';

interface Props extends Track {
    dispatch: Dispatch<NotificationActionType>
}

class TrackRow extends React.Component<Props> {
    handleClickTrack = (event: React.MouseEvent<HTMLButtonElement>, track: string): void => {
        apiPost(this.props.dispatch, Routing.generate('admin.screen.audio.track', {track: track}), 'Musik gestartet');
    }

    render() {
        return (
            <tr key={this.props.track}>
                <td>{this.props.track}</td>
                <td>{this.props.duration}s</td>
                <td>
                    <button className="btn btn-light" type="button"
                        onClick={(event: React.MouseEvent<HTMLButtonElement>) => this.handleClickTrack(event, this.props.track)}>
                            <i className="far fa-play-circle" />
                    </button>
                </td>
            </tr>
        )
    }
}

export { TrackRow }