import * as React from 'react';

class Effect extends React.Component<EffectSettings> {
    render() {
        return (
            <div className="effect-container">
                {(() => {
                    switch(this.props.id) {
                        case 'broken':
                            return <img src="/img/screen/effect-broken.png"/>;
                        case 'rubberduck':
                            return <img className="shake-slow shake-constant effect-rubberduck" src="/img/screen/effect-rubberduck.png"/>;
                    }
                })()}
            </div>
        )
    }
}

export { Effect }