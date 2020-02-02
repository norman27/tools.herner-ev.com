import { NotificationManager } from "react-notifications";
import { NotificationReducer } from "./NotificationReducer";

jest.mock("react-notifications");

test("action of type ADD_SUCCESS_NOTIFICATION calls success on NotificationManager", () => {
    NotificationReducer([], { type: "ADD_SUCCESS_NOTIFICATION", text: "" });
    expect(NotificationManager.success.mock.calls.length).toBe(1);
});

test("action of type ADD_ERROR_NOTIFICATION calls error on NotificationManager", () => {
    NotificationReducer([], { type: "ADD_ERROR_NOTIFICATION", text: "" });
    expect(NotificationManager.error.mock.calls.length).toBe(1);
});
