type NotificationActionType =
    | { type: "ADD_NOTIFICATION", text: string, style: "error" }
    | { type: "ADD_NOTIFICATION", text: string, style: "success" }

type Track = {
    track: string,
    duration: number
}