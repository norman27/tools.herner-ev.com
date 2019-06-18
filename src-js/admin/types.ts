type NotificationActionType =
    | { type: "ADD_ERROR_NOTIFICATION", text: string }
    | { type: "ADD_SUCCESS_NOTIFICATION", text: string }

type Track = {
    track: string,
    duration: number
}