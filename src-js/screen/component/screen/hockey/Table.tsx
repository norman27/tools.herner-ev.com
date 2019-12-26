import * as React from 'react';

type Props = {
  title: string,
  font: number
}

class Table extends React.Component<Props> {
    render() {
        let style = {
          fontSize: this.props.font + 'px'
        }

        return (
            <section className="screen-content present" data-fullscreen>
                <div className="bg-green-light title-container"><h5>{this.props.title}</h5></div>
                <table style={style}>
                    <tr>
                        <td></td>
                    </tr>
                </table>
            </section>
        )
    }
}

export { Table }