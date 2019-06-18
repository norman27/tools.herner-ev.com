import * as React from 'react';

//@TODO move this to its own .d.ts file
interface EffectSettings {
}

interface IProps {
}

interface IState {
}

class Effect extends React.Component<IProps, IState> {
    render() {
        return (
            <div>
                canvas
            </div>
        )
    }
}

export { Effect, EffectSettings }