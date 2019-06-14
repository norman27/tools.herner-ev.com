import { NotificationManager } from 'react-notifications';

const notifications = (state = [], action) => {
    switch (action.type) {
        case 'ADD_NOTIFICATION':
            switch(action.style) {
                case 'success':
                    NotificationManager.success(action.text);
                    break;
                case 'error':
                    NotificationManager.error(action.text);
                    break;
            }
            return [
                ...state,
                {
                    text: action.text,
                    style: action.style,
                    completed: false
                }
            ];
        default:
            return state;
    }
}

export default notifications