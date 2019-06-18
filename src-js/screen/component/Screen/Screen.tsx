import * as React from 'react';
import { Table } from './Hockey/Table';
import { FadingImages } from './Media/FadingImages';
import { Text } from './Media/Text';

//@TODO move this to its own .d.ts file
interface ScreenSettings {
    type: string,
    data: any
}

interface IProps extends ScreenSettings {
}

interface IState {
}

class Screen extends React.Component<IProps, IState> {
    render() {
        return (
            <div>
                {(() => {
                    switch(this.props.type) {
                        case 'images':
                            return <FadingImages />;
                        case 'table':
                            return <Table />;
                        case 'text':
                            return <Text {...this.props.data} />;
                    }
                })()}
            </div>
        )
    }
}

export { Screen, ScreenSettings }