/// <reference path="../../types.ts" />

import * as React from 'react';
import { Dispatch } from 'redux';
import { Routing } from '../../../routing/Routing';
import Modal from 'react-bootstrap/Modal';
import Button from 'react-bootstrap/Button';

type Props = {
    dispatch: Dispatch<NotificationActionType>
}

type State = {
    screens: EditScreen[],
    showModal: boolean,
    modalBody: string
}

const apiPost = (dispatch: Dispatch<NotificationActionType>, url: string, successMessage: string, successCallback: () => void): void => {
    // @TODO put this somewhere central
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(response => {
        if (response.status === 200) {
            successCallback();
            dispatch({type: 'ADD_SUCCESS_NOTIFICATION', text: successMessage});
        } else {
            dispatch({type: 'ADD_ERROR_NOTIFICATION', text: 'Fehler'});
        }
    }).catch(err => err);
}

class ScreenTable extends React.Component<Props, State> {
    state: State = {
        screens: [],
        showModal: false,
        modalBody: ''
    }

    componentDidUpdate(prevProp: Props) {
        if (this.state.showModal) {
            const form = document.getElementById('screen-form') as HTMLFormElement;

            form.addEventListener('submit', function (event) {
                event.preventDefault();
                const target = event.target as HTMLFormElement;

                fetch(target.action, {method: 'POST', body: new FormData(target)})
                    .then(response => response.text())
                    .then(body => {
                        this.setState({ modalBody: body });
                }).catch((error) => {
                    // @TODO handle error
                });
            }.bind(this));
        }
    }

    handleClickActivate = (event: React.MouseEvent<HTMLButtonElement>, id: number): void => {
        const updateActiveScreen = () => {
            var screens = this.state.screens.map(function (item) {
                item.active = (item.id === id) ? 1 : 0;
                return item;
            });

            this.setState({screens: screens});
        }

        apiPost(this.props.dispatch, Routing.generate('admin.screen.screens.activate', {id: id}), 'Screen aktiviert', updateActiveScreen);
    }

    handleClickEdit = (event: React.MouseEvent<HTMLAnchorElement>, id: number): void => {
        fetch(Routing.generate('admin.screen.screens.edit', {id: id}), {method: 'GET'})
            .then(response => response.text())
            .then(body => {
                this.setState({ showModal: true, modalBody: body });
            }).catch(error => {
                // @TODO handle error
            });
    }

    modalClose = () => {
        this.setState({ showModal: false });
    }

    modalSave = () => {
        const form = (document.getElementById('screen-form') as HTMLFormElement);
        form.dispatchEvent(new Event('submit'));
    }

    componentDidMount() {
        fetch(Routing.generate('admin.screen.screens.list'))
            .then(response => response.json())
            .then(
                (result) => {
                    this.setState(result);
                }
            );
    }

    render() {
        return (
            <div>
                <table className="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Typ</th>
                            <th>Aktion</th>
                        </tr>
                    </thead>
                    <tbody>
                        {this.state.screens.map((value: EditScreen, index) => {
                            const buttonActiveClass = 'btn btn-' + ((value.active === 1) ? 'success' : 'light');
                            return (
                                <tr key={ value.id }>
                                    <td>
                                        <a href="#" onClick={(event: React.MouseEvent<HTMLAnchorElement>) => this.handleClickEdit(event, value.id)}>
                                            <i className="fa fa-edit"></i> { value.name }</a>
                                    </td>
                                    <td>{ value.screenType }s</td>
                                    <td>
                                        <button className={ buttonActiveClass } type="button"
                                                onClick={(event: React.MouseEvent<HTMLButtonElement>) => this.handleClickActivate(event, value.id)}>
                                            <i className="far fa-play-circle" />
                                        </button>
                                    </td>
                                </tr>
                            )
                        })}
                    </tbody>
                </table>

                <Modal show={this.state.showModal} onHide={this.modalClose} size="lg">
                    <Modal.Header closeButton>
                        <Modal.Title>Bearbeiten</Modal.Title>
                    </Modal.Header>
                    <Modal.Body dangerouslySetInnerHTML={{__html: this.state.modalBody}}></Modal.Body>
                    <Modal.Footer>
                        <Button variant="secondary" onClick={this.modalClose}>Abbrechen</Button>
                        <Button variant="primary" onClick={this.modalSave}>Speichern</Button>
                    </Modal.Footer>
                </Modal>
            </div>
        )
    }
}

export { ScreenTable }