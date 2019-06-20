import * as React from 'react';
import * as ReactDOM from 'react-dom';
import { connect } from 'react-redux';
import { NotificationContainer } from 'react-notifications';
import { Audio } from './Audio/Audio';
import { Routing } from '../../routing/Routing';

const App = ({ dispatch }) => {
    return (
        <div>
            <NotificationContainer />
            {(function() {
                switch(window.location.pathname) {
                    case Routing.generate('admin.audio'):
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