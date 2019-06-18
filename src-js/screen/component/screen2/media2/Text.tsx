import * as React from 'react';

type Props = {
    title: string,
    message: string
}

class Text extends React.Component<Props> {
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