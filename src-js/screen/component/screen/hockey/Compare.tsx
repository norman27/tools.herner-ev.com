import * as React from 'react';

type Props = {
    //@TODO all english, and color logic
    homeplatz: number,
    awayplatz: number,
    homepunkte: number,
    awaypunkte: number,
    hometore: number,
    homegegentore: number,
    awaytore: number,
    awaygegentore: number
}

class Compare extends React.Component<Props> {
    render() {
        //let sponsorImage = '/media/screen/' + this.props.sponsor;


        return (
            <section className="screen-compare present" data-fullscreen>
                <div className="bg-green-light screen-title"><h4>Teamvergleich</h4></div>

                <table>
                    <tbody>
                        <tr>
                            <td align="right"><span className="bg-red-light">{ this.props.homeplatz }</span></td>
                            <td className="middle" align="center">Tabellenplatz</td>
                            <td><span className="bg-green-light">{ this.props.awayplatz }</span></td>
                        </tr>
                        <tr>
                            <td align="right"><span className="bg-red-light">{ this.props.homepunkte }</span></td>
                            <td className="middle" align="center">Punkte</td>
                            <td><span className="bg-green-light">{ this.props.awaypunkte }</span></td>
                        </tr>
                        <tr>
                            <td align="right"><span className="bg-red-light">{ this.props.hometore }:{ this.props.homegegentore }</span></td>
                            <td className="middle" align="center">Tore</td>
                            <td><span className="bg-green-light">{ this.props.awaytore }:{ this.props.awaygegentore}</span></td>
                        </tr>
                    </tbody>
                </table>
            </section>
        )
    }
}

export { Compare }