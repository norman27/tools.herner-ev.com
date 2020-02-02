import * as React from 'react';

type Props = {
    attendance: number,
    sponsor: string | null
}

class Attendance extends React.Component<Props> {
    render() {
        let sponsorImage = '/media/screen/' + this.props.sponsor;
        return (
            <section className="screen-attendance present" data-fullscreen>
                <div className="bg-green-light screen-title"><h4>Die Zuschauerzahl</h4></div>
                <div className="attendance-number">{this.props.attendance}</div>
                {this.props.sponsor !== null &&
                    <div>
                        Präsentiert von:<br />
                        <img src={sponsorImage} style={{width: "320px"}} />
                    </div>
                }
            </section>
        )
    }
}

export { Attendance }