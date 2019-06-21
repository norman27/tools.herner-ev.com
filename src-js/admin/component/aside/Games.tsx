/// <reference path="../../types.ts" />

import * as React from 'react';
import { Dispatch } from 'redux';
import { Routing } from '../../../routing/Routing';

type State = {
    games: Game[]
}

class Games extends React.Component<{}, State> {
    state: State = {
        games: []
    }

    componentDidMount() {
        fetch(Routing.generate('admin.aside.games'))
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
            {this.state.games.map((game: Game, index) => {
                return (
                    <div className="list-group-item list-group-item-accent-warning list-group-item-divider" key={game.id}>
                        <div>{game.hometeam.name} - {game.awayteam.name}</div>
                        <small className="text-muted mr-3">
                            <i className="far fa-calendar"></i>&nbsp; {game.gamedate}</small>
                        <small className="text-muted">
                            <i className="far fa-clock"></i>&nbsp; {game.gametime}</small>
                    </div>
                )
            })}
            </div>
        )
    }
}

export { Games }