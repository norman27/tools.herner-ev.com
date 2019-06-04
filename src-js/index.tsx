import * as React from "react";
import * as ReactDOM from "react-dom";
import App from "./component/App";

let startCount = 1;

ReactDOM.render(<App startCount={startCount} />, document.getElementById("app"));