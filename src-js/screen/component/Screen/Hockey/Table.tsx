import * as React from 'react';

interface IProps {
}

interface IState {
}

class Table extends React.Component<IProps, IState> {
    render() {
        return (
            <table>
                <tr>
                    <td>table</td>
                </tr>
            </table>
        )
    }
}

export { Table }