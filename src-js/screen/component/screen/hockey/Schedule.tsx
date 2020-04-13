import * as React from 'react';
import { TeamLogo } from '../../../../hockey/TeamLogo'

type TableItem = {
  hometeam: Club,
  awayteam: Club,
  gamedate: string,
  gametime: string
}

type Props = {
  title: string,
  items: TableItem[]
}

class Schedule extends React.Component<Props> {
    render() {
        return (
            <section className="present" data-fullscreen="">
                <div className="bg-green-light screen-title"><h4>{this.props.title}</h4></div>
                <table>
                    <tbody>
                        {this.props.items.map((item: TableItem, index) => {
                            let gameDate = new Date(item.gamedate);
                            return (
                                <tr key={index}>
                                    <td>{ gameDate.toLocaleDateString('de-DE', {month: '2-digit', year: 'numeric', day: '2-digit'}) }</td>
                                    <td>{ item.gametime }&nbsp;Uhr</td>
                                    <td>
                                      <TeamLogo logo={item.hometeam.logo} alt={item.hometeam.name} width={40} height={40} />
                                    </td>
                                    <td>{item.hometeam.name}</td>
                                    <td>
                                      <TeamLogo logo={item.awayteam.logo} alt={item.awayteam.name} width={40} height={40} />
                                    </td>
                                    <td>{item.awayteam.name}</td>
                                </tr>
                            )
                        })}
                    </tbody>
                </table>
            </section>
        )
    }
}

export { Schedule }