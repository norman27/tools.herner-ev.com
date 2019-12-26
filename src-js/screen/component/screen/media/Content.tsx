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
                <div className="bg-green-light title-container"><h5>{this.props.title}</h5></div>
                <div dangerouslySetInnerHTML={this.createMarkup()} />
            </section>
        )
    }
}

export { Content }