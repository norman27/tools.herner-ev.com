import * as React from 'react';

type Props = {
    title: string,
    content: string
}

type Markup = {
    __html: string,
}

class Content extends React.Component<Props> {
    createMarkup(): Markup {
        return {__html: this.props.content}
    }

    render() {
        return (
            <section className="present" data-fullscreen="">
                <div className="bg-green-light screen-title"><h4>{this.props.title}</h4></div>
                <div dangerouslySetInnerHTML={this.createMarkup()} />
            </section>
        )
    }
}

export { Content }