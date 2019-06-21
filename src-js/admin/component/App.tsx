import * as React from 'react';
import * as ReactDOM from 'react-dom';
import { connect } from 'react-redux';
import { NotificationContainer } from 'react-notifications';
import { Audio } from './Audio/Audio';
import { Games } from './Aside/Games';
import { Routing } from '../../routing/Routing';

const App = ({ dispatch }) => {

    ReactDOM.render(<Games />, document.getElementById('aside-games'));

    return (
        <div>
            <NotificationContainer />
            {(function() {
                switch(window.location.pathname) {
                    case Routing.generate('admin.screen.audio'):
                        return <Audio dispatch={dispatch} />;
                    default:
                        return null;
                }
            })()}
        </ div>
    )
}

const ConnectedApp = connect()(App);

export { ConnectedApp }