import * as React from 'react';
import { TeamLogo } from '../../../../hockey/TeamLogo'

type Props = {
    //@TODO all english, and color logic
    homeplatz: number,
    awayplatz: number,
    homepunkte: number,
    awaypunkte: number,
    hometore: number,
    homegegentore: number,
    awaytore: number,
    awaygegentore: number,
    homescorer: string,
    homescorerpunkte: number,
    awayscorer: string,
    awayscorerpunkte: number
    homegefahr: string,
    homegefahrpunkte: number,
    awaygefahr: string,
    awaygefahrpunkte: number,
    homebadboy: string,
    homebadboypunkte: number,
    awaybadboy: string,
    awaybadboypunkte: number,
    hometeam: Club,
    awayteam: Club
}

class Compare extends React.Component<Props> {

    getColor(a: number, b: number, inverse = false): string {
        let isBetterA = (a >= b) ? true : false;
        if (inverse) isBetterA = !isBetterA;
        return isBetterA ? 'green' : 'red';
    }

    render() {
        return (
            <section className="screen-compare present" data-fullscreen>
                <div className="bg-green-light screen-title"><h4>Teamvergleich</h4></div>
                <table>
                    <tbody>
                        <tr>
                            <td align="right"><span className={`bg-${ this.getColor(this.props.homeplatz, this.props.awayplatz, true) }-light`}>{ this.props.homeplatz }</span></td>
                            <td className="middle" align="center">Tabellenplatz</td>
                            <td><span className={`bg-${ this.getColor(this.props.awayplatz, this.props.homeplatz, true) }-light`}>{ this.props.awayplatz }</span></td>
                        </tr>
                        <tr>
                            <td align="right"><span className={`bg-${ this.getColor(this.props.homepunkte, this.props.awaypunkte) }-light`}>{ this.props.homepunkte }</span></td>
                            <td className="middle" align="center">Punkte</td>
                            <td><span className={`bg-${ this.getColor(this.props.awaypunkte, this.props.homepunkte) }-light`}>{ this.props.awaypunkte }</span></td>
                        </tr>
                        <tr>
                            <td align="right"><span className={`bg-${ this.getColor(this.props.hometore - this.props.homegegentore, this.props.awaytore - this.props.awaygegentore) }-light`}>{ this.props.hometore }:{ this.props.homegegentore }</span></td>
                            <td className="middle" align="center">Tore</td>
                            <td><span className={`bg-${ this.getColor(this.props.awaytore - this.props.awaygegentore, this.props.hometore - this.props.homegegentore) }-light`}>{ this.props.awaytore }:{ this.props.awaygegentore}</span></td>
                        </tr>
                        <tr>
                            <td align="right"><span className={`bg-${ this.getColor(this.props.homescorerpunkte, this.props.awayscorerpunkte) }-light`}>{ this.props.homescorer }&nbsp;({ this.props.homescorerpunkte } Punkte)</span></td>
                            <td className="middle" align="center">Topscorer</td>
                            <td><span className={`bg-${ this.getColor(this.props.awayscorerpunkte, this.props.homescorerpunkte) }-light`}>{ this.props.awayscorer }&nbsp;({ this.props.awayscorerpunkte } Punkte)</span></td>
                        </tr>
                        <tr>
                            <td align="right"><span className={`bg-${ this.getColor(this.props.homegefahrpunkte, this.props.awaygefahrpunkte) }-light`}>{ this.props.homegefahr }&nbsp;({ this.props.homegefahrpunkte } Tore)</span></td>
                            <td className="middle" align="center">Gefährlich</td>
                            <td><span className={`bg-${ this.getColor(this.props.awaygefahrpunkte, this.props.homegefahrpunkte) }-light`}>{ this.props.awaygefahr }&nbsp;({ this.props.awaygefahrpunkte } Tore)</span></td>
                        </tr>
                        <tr>
                            <td align="right"><span className={`bg-${ this.getColor(this.props.homebadboypunkte, this.props.awaybadboypunkte) }-light`}>{ this.props.homebadboy }&nbsp;({ this.props.homebadboypunkte } Tore)</span></td>
                            <td className="middle" align="center">Bad Boy</td>
                            <td><span className={`bg-${ this.getColor(this.props.awaybadboypunkte, this.props.homebadboypunkte) }-light`}>{ this.props.awaybadboy }&nbsp;({ this.props.awaybadboypunkte } Tore)</span></td>
                        </tr>
                        <tr>
                            <td align="right">
                                <TeamLogo logo={this.props.hometeam.logo} alt={this.props.hometeam.name} width={100} height={100}/>
                            </td>
                            <td></td>
                            <td>
                                <TeamLogo logo={this.props.awayteam.logo} alt={this.props.awayteam.name} width={100} height={100}/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
        )
    }
}

export { Compare }