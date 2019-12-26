/// <reference path="../../types.ts" />

import * as React from 'react';
import { Table } from './hockey/Table';
import { FadingImages } from './media/FadingImages';
import { Content } from './media/Content';

class Screen extends React.Component<ScreenSettings> {
    render() {
        return (
            <div>
                {(() => {
                    switch(this.props.screenType) {
                        case 'images':
                            return <FadingImages />;
                        case 'table':
                            return <Table {...this.props.config} />;
                        case 'content':
                            return <Content {...this.props.config} />;
                    }
                })()}
            </div>
        )
    }
}

export { Screen }