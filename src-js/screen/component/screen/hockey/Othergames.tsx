import * as React from 'react';
import { TeamLogo } from '../../../../hockey/TeamLogo'

type Othergame = {
  hometeam: Club,
  awayteam: Club,
  homescore: number,
  awayscore: number,
  isFinished: boolean
}

type Props = {
  items: Othergame[]
}

class Othergames extends React.Component<Props> {
    render() {
        return (
            <section className="present" data-fullscreen="">
                <div className="bg-green-light screen-title"><h4>Zwischenstände</h4></div>
                <table>
                    <tbody>
                        {this.props.items.map((item: Othergame, index) => {
                            return (
                                <tr key={index}>
                                    <td>
                                      <TeamLogo logo={item.hometeam.logo} alt={item.hometeam.name} width={40} height={40} />
                                    </td>
                                    <td>{item.hometeam.name}</td>
                                    <td>
                                      <TeamLogo logo={item.awayteam.logo} alt={item.awayteam.name} width={40} height={40} />
                                    </td>
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