import * as React from 'react';
import { Routing } from '../../../routing/Routing';

interface IProps {
    dispatch: (Notification) => void,
    volume: string
}

interface IState {
    volume: string,
    formerVolume: string
}

export default class Settings extends React.Component<IProps, IState> {
    constructor(props: IProps) {
        super(props);
        this.state = {
            volume: props.volume,
            formerVolume: props.volume
        }
    }

    isMuted() {
        return (this.state.volume === '0');
    }

    handleChangeVolume = (event: React.ChangeEvent<HTMLInputElement>) => {
        this.setState({volume: event.target.value});
        this.postVolume(event.target.value);
    }

    handleMuteToggle = (event: React.MouseEvent<HTMLButtonElement>) => {
        if (!this.isMuted()) {
            this.setState({volume: "0", formerVolume: this.state.volume});
            this.postVolume("0");
        } else {
            let formerVolume = (this.state.formerVolume === "0") ? '80' : this.state.formerVolume;
            this.setState({volume: formerVolume});
            this.postVolume(formerVolume);
        }
    }

    handleClickStop = (event: React.MouseEvent<HTMLButtonElement>) => {
        // @TODO API communication is a retourning pattern
        fetch(Routing.generate('admin.audio.track', {track: ''}), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if (response.status >= 200 && response.status < 300) {
                this.props.dispatch({type: 'ADD_NOTIFICATION', text: 'Musik angehalten', style: 'success'});
            } else {
                this.props.dispatch({type: 'ADD_NOTIFICATION', text: 'Fehler beim Anhalten', style: 'error'});
            }
        }).catch(err => err);
    }

    postVolume(volume: string) {
        // @TODO API communication is a retourning pattern
        fetch(Routing.generate('admin.audio.volume', {volume: volume}), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if (response.status >= 200 && response.status < 300) {
                this.props.dispatch({type: 'ADD_NOTIFICATION', text: 'Einstellungen gespeichert', style: 'success'});
            } else {
                this.props.dispatch({type: 'ADD_NOTIFICATION', text: 'Fehler beim Speichern', style: 'error'});
            }
        }).catch(err => err);
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