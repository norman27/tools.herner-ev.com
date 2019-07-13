import * as React from 'react';

type Props = {
    title: string,
    content: string
}

class Content extends React.Component<Props> {
    render() {
        return (
            <div>
                <h1 className="title bg-green-light">{this.props.title}</h1>
                {this.props.content}
            </div>
        )
    }
}

export { Content }