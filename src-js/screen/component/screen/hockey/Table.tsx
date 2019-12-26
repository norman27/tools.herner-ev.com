import * as React from 'react';

type TableItem = {
  club: Club,
  goalsFor: number,
  goalsAgainst: number,
  points: number
}

type Props = {
  title: string,
  font: number,
  items: TableItem[]
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
                    <tbody>
                        {this.props.items.map((item: TableItem, index) => {
                            return (
                                <tr>
                                    <td>{item.club.name}</td>
                                    <td>{item.goalsFor}:{item.goalsAgainst}</td>
                                    <td>{item.points}</td>
                                </tr>
                            )
                        })}
                    </tbody>
                </table>
            </section>
        )
    }
}

export { Table }