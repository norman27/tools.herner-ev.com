import * as React from 'react';

type TableItem = {
  hometeam: Club,
  awayteam: Club,
}

type Props = {
  title: string,
  items: TableItem[]
}

class Schedule extends React.Component<Props> {
    render() {
        let logoStyle = {
          height: '40px',
          width: '40px'
        }

        return (
            <section className="screen-content present" data-fullscreen>
                <div className="bg-green-light title-container"><h4>{this.props.title}</h4></div>
                <table>
                    <tbody>
                        {this.props.items.map((item: TableItem, index) => {
                            let logoHome = '/bundles/hockey-teams/img/' + item.hometeam.logo;
                            let logoAway = '/bundles/hockey-teams/img/' + item.awayteam.logo;
                            return (
                                <tr key={index}>
                                    <td><img className="small-logo" style={logoStyle} src={logoHome} /></td>
                                    <td>{item.hometeam.name}</td>
                                    <td><img className="small-logo" style={logoStyle} src={logoAway} /></td>
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