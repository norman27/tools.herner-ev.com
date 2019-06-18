/// <reference path="../../types.ts" />

import * as React from 'react';
import { Dispatch } from 'redux';
import { Routing } from '../../../routing/Routing';

type Props = {
    dispatch: Dispatch<NotificationActionType>,
    volume: string
}

type State = {
    volume: string,
    formerVolume: string
}

const getInitialState = (props: Props): State => {
    return {
        volume: props.volume,
        formerVolume: props.volume
    }
}

// @TODO this might need to go to a more central place
const apiPost = (dispatch: Dispatch<NotificationActionType>, url: string, successMessage: string): void => {
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(response => {
        if (response.status === 200) {
            dispatch({type: 'ADD_SUCCESS_NOTIFICATION', text: successMessage});
        } else {
            dispatch({type: 'ADD_ERROR_NOTIFICATION', text: 'Fehler'});
        }
    }).catch(err => err);
}

class Settings extends React.Component<Props, State> {
    state = getInitialState(this.props)

    isMuted() {
        return (this.state.volume === '0');
    }

    handleChangeVolume = (event: React.ChangeEvent<HTMLInputElement>) => {
        this.setState({volume: event.target.value});
        this.setVolume(event.target.value);
    }

    handleMuteToggle = (event: React.MouseEvent<HTMLButtonElement>) => {
        if (!this.isMuted()) {
            this.setState({volume: "0", formerVolume: this.state.volume});
            this.setVolume("0");
        } else {
            let formerVolume = (this.state.formerVolume === "0") ? '80' : this.state.formerVolume;
            this.setState({volume: formerVolume});
            this.setVolume(formerVolume);
        }
    }

    handleClickStop = (event: React.MouseEvent<HTMLButtonElement>) => {
        apiPost(this.props.dispatch, Routing.generate('admin.audio.track', {track: ''}), 'Musik gestoppt');
    }

    setVolume(volume: string) {
        apiPost(this.props.dispatch, Routing.generate('admin.audio.volume', {volume: volume}), 'Einstellungen gespeichert');
    }

    render() {
        const iconMuted = 'fas fa-lg fa-fw fa-volume-' + ((this.isMuted()) ? 'mute' : 'up');

        return (
            <div className="row">
                <div className="form-group col-sm-6">
                    <label htmlFor="volume-settings">Volume</label>
                    <input type="range" min="0" max="100" step="10" value={this.state.volume}
                            id="volume-settings"
                            name="volume-settings"
                            className="form-control"
                            onChange={this.handleChangeVolume} />
                </div>

                <div className="form-group col-sm-6">
                    <label>Aktionen</label>
                    <div className="controls">
                        <div className="input-group">
                            <button className="btn btn-light mr-1" type="button" onClick={this.handleMuteToggle}>
                                <i className={ iconMuted } />
                            </button>
                            <button className="btn btn-light" type="button" onClick={this.handleClickStop}>
                                <i className="far fa-stop-circle fa-lg" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

export { Settings, apiPost }