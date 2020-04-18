import * as React from 'react';
import { TeamLogo } from '../../../../hockey/TeamLogo';

type LivegameProps = {
  hometeam: Club,
  homescore: number,
  awayteam: Club,
  awayscore: number,
  homegoals: string[],
  awaygoals: string[],
  sponsors: string[],
  socialFacebook: string | null,
  socialInstagram: string | null,
  socialYoutube: string | null,
  socialTwitter: string | null,
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
          <div className="score">
            {props.homescore}:{props.awayscore}
          </div>
          <div className="logo">
            <TeamLogo logo={ props.awayteam.logo } alt={ props.awayteam.name } width={200} height={200}/>
          </div>
        </div>
      </div>
      <div className="bottom">
        <div className="goals">
          <div>
            {props.homegoals.reverse().slice(0, 3).map((goal: string, index) => {
              return (
                <div key={`home-${index}`} className="goal">{goal}</div>
              )
            })}
          </div>
          <div>
            {props.awaygoals.reverse().slice(0, 3).map((goal: string, index) => {
              return (
                <div key={`away-${index}`} className="goal">{goal}</div>
              )
            })}
          </div>
        </div>
        <div className="bg-white sponsors">
          {props.sponsors.map((sponsor: string, index) => {
            return (
              <img key={index} src={ `https://www.herner-ev.com/${ sponsor }` } className="sponsor" alt="" width="144" height="80" />
            )
          })}
        </div>
        {(props.socialFacebook || props.socialInstagram || props.socialYoutube || props.socialTwitter) &&
          <div className="bg-green-light social">
            {props.socialFacebook &&
              <div>
                <img src="/img/social/facebook.svg" alt="" width="20" height="20" />
                <small>{props.socialFacebook}</small>
              </div>
            }
            {props.socialInstagram &&
              <div>
                <img src="/img/social/instagram.svg" alt="" width="20" height="20" />
                <small>{props.socialInstagram}</small>
              </div>
            }
            {props.socialYoutube &&
              <div>
                <img src="/img/social/youtube.svg" alt="" width="20" height="20" />
                <small>{props.socialYoutube}</small>
              </div>
            }
            {props.socialTwitter &&
              <div>
                <img src="/img/social/twitter.svg" alt="" width="20" height="20" />
                <small>{props.socialTwitter}</small>
              </div>
            }
          </div>
        }
      </div>
    </section>
  )
}

export { Livegame }