/// <reference path="../../types.ts" />

import * as React from 'react';
import { Table } from './hockey/Table';
import { FadingImages } from './media/FadingImages';
import { Text } from './media/Text';

class Screen extends React.Component<ScreenSettings> {
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

export { Screen }