const electron = require('electron');
const { app, BrowserWindow } = require('electron');
const path = require('path');

let screenWindow;
let adminWindow;

let windowConfig = {
    width: 1200,
    height: 860,
    useContentSize: true,
    x: 20,
    y: 20,
    icon: path.join(__dirname, 'icons/64x64.png'),
    webPreferences: {
        nodeIntegration: true,
        webviewTag: true
    }
};

electron.ipcMain.on('admin-trigger-force-reload', function (event, arg) {
    screenWindow.loadURL(
        (process.env.NODE_ENV === 'development') ? 'http://127.0.0.1:8001' : 'https://tools.herner-ev.com/screen/frame'
    );
});

function createScreenWindow() {
    let externalDisplay = electron.screen.getAllDisplays().find((display) => {
        return display.bounds.x !== 0 || display.bounds.y !== 0;
    });

    let myConfig = {
        width: 896,
        height: 515,
        x: (externalDisplay) ? externalDisplay.bounds.x : 0,
        y: (externalDisplay) ? externalDisplay.bounds.y : 0,
        movable: false,
        resizable: false,
        frame: false,
        backgroundColor: '#000000',
    };

    screenWindow = new BrowserWindow({ ...windowConfig, ...myConfig });
    screenWindow.loadURL(
        (process.env.NODE_ENV === 'development') ? 'http://127.0.0.1:8001' : 'https://tools.herner-ev.com/screen/frame'
    );
    screenWindow.on('closed', function () { screenWindow = null });
}

function createAdminWindow() {
    adminWindow = new BrowserWindow(windowConfig);
    adminWindow.loadFile(path.join(__dirname, 'templates/admin.html'));
    adminWindow.on('closed', function () { adminWindow = null });
}

app.commandLine.appendSwitch('autoplay-policy', 'no-user-gesture-required');

app.on('ready', function() {
    createAdminWindow();
    createScreenWindow();
});

app.on('window-all-closed', function () {
    if (process.platform !== 'darwin') {
        app.quit();
    }
});

app.on('activate', function () {
    if (screenWindow === null) {
        createScreenWindow();
    }
    if (adminWindow === null) {
        createAdminWindow();
    }
});
