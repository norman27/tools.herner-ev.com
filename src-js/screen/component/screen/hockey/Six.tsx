import * as React from 'react';

type SixProps = {
  club: Club,
  number_1: number,
  firstname_1: string,
  name_1: string,
  number_2: number,
  firstname_2: string,
  name_2: string,
  number_3: number,
  firstname_3: string,
  name_3: string,
  number_4: number,
  firstname_4: string,
  name_4: string,
  number_5: number,
  firstname_5: string,
  name_5: string,
  number_6: number,
  firstname_6: string,
  name_6: string,
}

function Six(props: SixProps) {
  return (
      <section className="screen-six present" data-fullscreen>
        <div className="bg-green-light screen-title"><h4>Starting Six: {props.club.name}</h4></div>
        <div className="team-role team-role-forward">
          <div className="player player-3">
            <div className="number bg-red-light">{props.number_1}</div>
            <div>
              <div className="name">{props.name_1}</div>
              <div>{props.firstname_1}</div>
            </div>
          </div>
          <div className="player">
            <div className="number bg-red-light">{props.number_2}</div>
            <div>
              <div className="name">{props.name_2}</div>
              <div>{props.firstname_2}</div>
            </div>
          </div>
          <div className="player">
            <div className="number bg-red-light">{props.number_3}</div>
            <div>
              <div className="name">{props.name_3}</div>
              <div>{props.firstname_3}</div>
            </div>
          </div>
        </div>
        <div className="team-role">
          <div className="player player-2">
            <div className="number bg-red-light">{props.number_4}</div>
            <div>
              <div className="name">{props.name_4}</div>
              <div>{props.firstname_4}</div>
            </div>
          </div>
          <div className="player">
            <div className="number bg-red-light">{props.number_5}</div>
            <div>
              <div className="name">{props.name_5}</div>
              <div>{props.firstname_5}</div>
            </div>
          </div>
        </div>
        <div>
          <div className="player player-1">
            <div className="number bg-red-light">{props.number_6}</div>
            <div>
              <div className="name">{props.name_6}</div>
              <div>{props.firstname_6}</div>
            </div>
          </div>
        </div>
        <div className="logo">
          <img src={ `/bundles/hockey-teams/img/${ props.club.logo }` } width="120" height="120" alt={props.club.name}/>
        </div>
      </section>
  )
}

export { Six }