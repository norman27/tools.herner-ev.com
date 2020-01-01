import * as React from 'react';

type Props = {
    title: string,
    content: string
}

class Content extends React.Component<Props> {
    createMarkup() {
        return {__html: this.props.content}
    }

    render() {
        return (
            <section className="screen-content present" data-fullscreen>
                <div className="bg-green-light title-container"><h4>{this.props.title}</h4></div>
                <div dangerouslySetInnerHTML={this.createMarkup()} />
            </section>
        )
    }
}

export { Content }