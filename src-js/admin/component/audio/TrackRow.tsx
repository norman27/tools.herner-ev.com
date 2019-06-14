import * as React from 'react';
import { Routing } from '../../../routing/Routing';

interface IProps extends Track {
    dispatch: (Notification) => void,
    track: string,
    duration: number
}

export default class TrackRow extends React.Component<IProps> {
    handleClickTrack = (event: React.MouseEvent<HTMLButtonElement>, track: string) => {
        fetch(Routing.generate('admin.audio.track', {track: track}), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if (response.status >= 200 && response.status < 300) {
                this.props.dispatch({type: 'ADD_NOTIFICATION', text: 'Musik gestartet', style: 'success'});
            } else {
                this.props.dispatch({type: 'ADD_NOTIFICATION', text: 'Fehler beim Abspielen', style: 'error'});
            }
        }).catch(err => err);
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