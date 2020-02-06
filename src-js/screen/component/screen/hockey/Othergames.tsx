import * as React from 'react';

type TableItem = {
  hometeam: Club,
  awayteam: Club,
  homescore: number,
  awayscore: number,
  isFinished: boolean
}

type Props = {
  items: TableItem[]
}

class Othergames extends React.Component<Props> {
    render() {
        return (
            <section className="present" data-fullscreen>
                <div className="bg-green-light screen-title"><h4>Zwischenstände</h4></div>
                <table>
                    <tbody>
                        {this.props.items.map((item: TableItem, index) => {
                            return (
                                <tr key={index}>
                                    <td><img className="small-logo" src={ `/bundles/hockey-teams/img/${ item.hometeam.logo }` } /></td>
                                    <td>{item.hometeam.name}</td>
                                    <td><img className="small-logo" src={ `/bundles/hockey-teams/img/${ item.awayteam.logo }` } /></td>
                                    <td>{item.awayteam.name}</td>
                                    <td><strong><span className={!item.isFinished && 'color-green'}>{item.homescore}:{item.awayscore}</span></strong></td>
                                </tr>
                            )
                        })}
                    </tbody>
                </table>
            </section>
        )
    }
}

export { Othergames }