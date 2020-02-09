import * as React from 'react';

type LotteryProps = {
  puck1: number,
  puck2: number,
  puck3: number,
  jersey: number,
  pokal: number,
}

function Lottery(props: LotteryProps) {
  console.log(props);
  return (
      <section className="screen-lottery present" data-fullscreen>
        <div className="bg-green-light screen-title"><h4>Puckwerfen und Verlosung</h4></div>
        <table>
          <tbody>
            <tr>
              <td className="vertical-top">Puckwerfen</td>
              <td className="bg-red">
                1. Platz: Puck <strong>{ props.puck1 }</strong><br />
                2. Platz: Puck <strong>{ props.puck2 }</strong><br />
                3. Platz: Puck <strong>{ props.puck3 }</strong>
              </td>
            </tr>
            <tr>
              <td>Trikotverlosung</td>
              <td className="bg-green">Los <strong>{ props.jersey }</strong></td>
            </tr>
            <tr>
              <td>Pokalübergabe</td>
              <td className="bg-red">{ props.pokal }</td>
            </tr>
          </tbody>
        </table>
      </section>
  )
}

export { Lottery }