import * as React from 'react';
import { Routing } from '../../../routing/Routing';

interface IProps {
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
        this.postVolume(event.target.value);
    }

    handleMuteToggle = (event: React.MouseEvent<HTMLButtonElement>) => {
        if (!this.isMuted()) {
            this.setState({volume: "0", formerVolume: this.state.volume});
            this.postVolume("0");
        } else {
            this.setState({volume: this.state.formerVolume});
            this.postVolume(this.state.formerVolume);
        }
    }

    postVolume(volume: string) {
        fetch(Routing.generate('admin.audio.volume', {volume: volume}), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if (response.status >= 200 && response.status < 300) {
                return response;
                window.location.reload(); //@TODO just show notification
            } else {
                //@TODO just show notification
                console.log('Somthing happened wrong');
            }
        }).catch(err => err);
    }

    render() {
        const iconMuted = 'far fa-lg fa-bell' + ((this.isMuted()) ? '-slash' : '');

        return (
            <div className="row">
                <div className="form-group col-sm-6">
                    <label htmlFor="volume-settings">Volume</label>
                    <input type="range" min="0" max="100" step="10" defaultValue={this.state.volume}
                            id="volume-settings"
                            name="volume-settings"
                            className="form-control"
                            onChange={this.handleChangeVolume} />
                </div>

                <div className="form-group col-sm-6">
                    <label>Aktionen</label>
                    <div className="controls">
                        <div className="input-group">
                            <button className="btn btn-light" type="button" onClick={this.handleMuteToggle}>
                                <i className={ iconMuted } />
                            </button>
                            <button className="btn btn-light" type="button"><i className="far fa-stop-circle fa-lg" /></button>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}