export const addNotification = (text: string, style: string) => ({
    type: 'ADD_NOTIFICATION',
    text,
    style
})