import { NotificationManager } from 'react-notifications';

const NotificationReducer = (state = [], action) => {
    switch (action.type) {
        case 'ADD_SUCCESS_NOTIFICATION':
            NotificationManager.success(action.text, null, 2000);
            break;
        case 'ADD_ERROR_NOTIFICATION':
            NotificationManager.error(action.text, null, 2000);
            break;
    }

    return state;
}

export default NotificationReducer