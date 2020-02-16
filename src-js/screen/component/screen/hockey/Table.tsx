import * as React from 'react';
import { TeamLogo } from '../../../../hockey/TeamLogo'

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
        let tableStyle = {
          fontSize: this.props.font + 'px'
        }

        return (
            <section className="present" data-fullscreen="">
                <div className="bg-green-light screen-title"><h4>{this.props.title}</h4></div>
                <table style={tableStyle}>
                    <tbody>
                        {this.props.items.map((item: TableItem, index) => {
                            return (
                                <tr key={index}>
                                    <td>
                                      <TeamLogo logo={item.club.logo} alt={item.club.name} width={this.props.font} height={this.props.font}/>
                                    </td>
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