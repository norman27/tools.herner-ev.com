import * as React from 'react';

class Effect extends React.Component<EffectSettings> {
    render() {
        return (
            <div className="effect-container">
                {(() => {
                    switch(this.props.id) {
                        case 'broken':
                            return <img src="/img/screen/effect-broken.png"/>;
                        case 'darken':
                            let darkOverlay = {
                                width: '896px',
                                height: '512px',
                                background: 'rgba(0,0,0,.3)'
                            };
                            return <div style={darkOverlay}></div>;
                        case 'rubberduck':
                            return <img className="shake-slow shake-constant effect-rubberduck" src="/img/screen/effect-rubberduck.png"/>;
                    }
                })()}
            </div>
        )
    }
}

export { Effect }