// @TODO this file should be named .ts instead of .tsx

import { NotificationManager } from 'react-notifications';

const NotificationReducer = (state = [], action) => {
    switch (action.type) {
        case 'ADD_NOTIFICATION': // @TODO maybe ADD_SUCCESS_NOTIFICATION, ...
            switch(action.style) {
                case 'success':
                    NotificationManager.success(action.text, null, 2000);
                    break;
                case 'error':
                    NotificationManager.error(action.text, null, 2000);
                    break;
            }
            return [ // @TODO can we return just state?
                ...state,
                {
                    text: action.text,
                    style: action.style,
                }
            ];
        default:
            return state;
    }
}

export default NotificationReducer