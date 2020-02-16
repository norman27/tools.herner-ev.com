import * as React from 'react';
import { TeamLogo } from '../../../../hockey/TeamLogo'

type LivegameProps = {
  hometeam: Club,
  homescore: number,
  awayteam: Club,
  awayscore: number,
  sponsors: string[],
  ticker: string
}

function Livegame(props: LivegameProps) {
  return (
    <section className="screen-livegame present" data-fullscreen="">
      <div className="bg-green-light screen-title"><h4>{props.hometeam.name} - {props.awayteam.name}</h4></div>
      <div className="score">
        <div>
          <div className="logo">
            <TeamLogo logo={props.hometeam.logo} alt={props.hometeam.name} width={200} height={200}/>
          </div>
          <div className="goals">
            <span id="homescore">{props.homescore}</span>:<span id="awayscore">{props.awayscore}</span>
          </div>
          <div className="logo">
            <TeamLogo logo={ props.awayteam.logo } alt={ props.awayteam.name } width={200} height={200}/>
          </div>
        </div>
      </div>
      <div className="bottom">
        <div className="greenbg clearfix ticker">
          <div className="marquee" id="ticker">{ props.ticker }</div>
          <div className="greenbg">Ticker:</div>
        </div>
        <div className="whitebg clearfix sponsoren">
          {this.props.sponsors.map((sponsor: string, index) => {
            return (
              <img key={index} src={ `https://www.herner-ev.com/${ sponsor }` } alt="" width="180" height="100" />
            )
          })}
        </div>
      </div>
    </section>
  )
}

export { Livegame }