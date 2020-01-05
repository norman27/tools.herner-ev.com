/// <reference path="../../types.ts" />

import * as React from 'react';
import { Attendance } from './media/Attendance';
import { Content } from './media/Content';
import { Images } from './media/Images';
import { Schedule } from './hockey/Schedule';
import { Table } from './hockey/Table';

class Screen extends React.Component<ScreenSettings> {
    render() {
        return (
            <div>
                {(() => {
                    switch(this.props.screenType) {
                        case 'attendance':
                            return <Attendance {...this.props.config} />;
                        case 'content':
                            return <Content {...this.props.config} />;
                        case 'images':
                            return <Images />;
                        case 'schedule':
                            return <Schedule {...this.props.config} />;
                        case 'table':
                            return <Table {...this.props.config} />;
                    }
                })()}
            </div>
        )
    }
}

export { Screen }