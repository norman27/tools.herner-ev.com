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
        let tableStyle = {
          fontSize: this.props.font + 'px'
        }
        let logoStyle = {
          height: this.props.font + 'px',
          width: this.props.font + 'px'
        }

        return (
            <section className="screen-content present" data-fullscreen>
                <div className="bg-green-light title-container"><h4>{this.props.title}</h4></div>
                <table style={tableStyle}>
                    <tbody>
                        {this.props.items.map((item: TableItem, index) => {
                            let logo = '/bundles/hockey-teams/img/' + item.club.logo;
                            return (
                                <tr key={index}>
                                    <td><img className="small-logo" style={logoStyle} src={logo} /></td>
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