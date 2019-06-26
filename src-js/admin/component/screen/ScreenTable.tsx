/// <reference path="../../types.ts" />

import * as React from 'react';
import { Dispatch } from 'redux';
import { Routing } from '../../../routing/Routing';

type Props = {
    dispatch: Dispatch<NotificationActionType>
}

type State = {
    screens: EditScreen[]
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
        screens: []
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
        console.log(id);
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
        )
    }
}

export { ScreenTable }