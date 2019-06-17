const electron = require('electron');
const { app, BrowserWindow } = require('electron');
const path = require('path');
const ipc = electron.ipcMain;

let screenWindow;
let adminWindow;

ipc.on('admin-trigger-force-reload', function (event, arg) {
    screenWindow.webContents.send('force-reload', true);
});

function createScreenWindow () {
    let displays = electron.screen.getAllDisplays();

    let externalDisplay = displays.find((display) => {
        return display.bounds.x !== 0 || display.bounds.y !== 0;
    })

    let windowConfig = {
        width: 896,
        height: 515,
        useContentSize: true,
        x: 0,
        y: 0,
        movable: false,
        resizeable: false,
        frame: false,
        backgroundColor: '#000000',
        icon: path.join(__dirname, 'icons/64x64.png'),
        webPreferences: {
            nodeIntegration: true
        }
    };

    if (externalDisplay) {
        windowConfig.x = externalDisplay.bounds.x;
        windowConfig.y = externalDisplay.bounds.y;
    }

    screenWindow = new BrowserWindow(windowConfig);
    screenWindow.loadFile('templates/screen.html');

    if (process.env.NODE_ENV === 'development') {
        screenWindow.webContents.openDevTools();
    }

    screenWindow.on('closed', function () {
        screenWindow = null;
    });

    screenWindow.webContents.on('did-finish-load', () => {
        screenWindow.webContents.send('force-reload', true);
    });
}

function createAdminWindow () {
    let displays = electron.screen.getAllDisplays();

    let externalDisplay = displays.find((display) => {
        return display.bounds.x !== 0 || display.bounds.y !== 0;
    })

    let windowConfig = {
        width: 1200,
        height: 900,
        useContentSize: true,
        x: 20,
        y: 20,
        movable: true,
        resizeable: true,
        frame: true,
        icon: path.join(__dirname, 'icons/64x64.png'),
        webPreferences: {
            nodeIntegration: true
        }
    };

    if (!externalDisplay) {
        windowConfig.x = externalDisplay.bounds.x;
        windowConfig.y = externalDisplay.bounds.y;
    }

    adminWindow = new BrowserWindow(windowConfig);
    adminWindow.loadFile('templates/admin.html');

    if (process.env.NODE_ENV === 'development') {
        adminWindow.webContents.openDevTools();
    }

    adminWindow.on('closed', function () {
        adminWindow = null;
    });
}

app.commandLine.appendSwitch('autoplay-policy', 'no-user-gesture-required');
app.on('ready', createScreenWindow);
app.on('ready', createAdminWindow);

app.on('window-all-closed', function () {
    // On macOS it is common for applications and their menu bar
    // to stay active until the user quits explicitly with Cmd + Q
    if (process.platform !== 'darwin') {
        app.quit();
    }
});

app.on('activate', function () {
    // On macOS it's common to re-create a window in the app when the
    // dock icon is clicked and there are no other windows open.
    if (screenWindow === null) {
        createScreenWindow();
    }
    if (adminWindow === null) {
        createAdminWindow();
    }
});
