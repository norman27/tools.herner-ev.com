import * as React from 'react';
import { Routing } from '../../../routing/Routing';

interface IProps extends Track {
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
                return response; //@TODO just show notification
            } else {
                //@TODO just show notification
                console.log('Somthing happened wrong');
            }
        }).catch(err => err);
    }

    render() {
        return (
            <tr key={this.props.track}>
                <td>{this.props.track}</td>
                <td>{this.props.duration}s</td>
                <td>
                    <button onClick={(event: React.MouseEvent<HTMLButtonElement>) => this.handleClickTrack(event, this.props.track)} type="button">
                        <i className="far fa-play-circle" /> Abspielen
                    </button>
                </td>
            </tr>
        )
    }
}