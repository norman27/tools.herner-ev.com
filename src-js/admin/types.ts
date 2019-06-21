type Club = {
    name: string
}

type Game = {
    hometeam: Club,
    awayteam: Club,
    gamedate: string, // ie. 2019-06-21
    gametime: string // ie. 20:00
}

type NotificationActionType =
    | { type: "ADD_ERROR_NOTIFICATION", text: string }
    | { type: "ADD_SUCCESS_NOTIFICATION", text: string }

type Track = {
    track: string,
    duration: number
}