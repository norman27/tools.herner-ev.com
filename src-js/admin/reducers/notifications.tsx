const notifications = (state = [], action) => {
    switch (action.type) {
        case 'ADD_NOTIFICATION':
            console.log('received ADD_NOTIFICATION: ' + action.text + ', ' + action.style);
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