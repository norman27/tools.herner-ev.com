import * as React from 'react';

interface IProps {
    title: string,
    message: string
}

interface IState {
}

class Text extends React.Component<IProps, IState> {
    render() {
        return (
            <div>
                <h1>{this.props.title}</h1>
                {this.props.message}
            </div>
        )
    }
}

export { Text }