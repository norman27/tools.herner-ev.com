const electron = require('electron')
const { app, BrowserWindow } = require('electron')
let mainWindow

function createWindow () {
  let displays = electron.screen.getAllDisplays()

  let externalDisplay = displays.find((display) => {
    return display.bounds.x !== 0 || display.bounds.y !== 0
  })

  let windowConfig = {
    width: 896,
      height: 515,
      useContentSize: true,
      x: 0,
      y: 0,
      movable: false,
      resizeable: false,
      frame: false
  }

  if (externalDisplay) {
    windowConfig.x = externalDisplay.bounds.x
    windowConfig.y = externalDisplay.bounds.y
  }

  mainWindow = new BrowserWindow(windowConfig)
  mainWindow.loadFile('index.html')
  //mainWindow.webContents.openDevTools()

  mainWindow.on('closed', function () {
    mainWindow = null
  })
}

app.commandLine.appendSwitch('autoplay-policy', 'no-user-gesture-required')
app.on('ready', createWindow)

app.on('window-all-closed', function () {
  // On macOS it is common for applications and their menu bar
  // to stay active until the user quits explicitly with Cmd + Q
  if (process.platform !== 'darwin') {
    app.quit()
  }
})

app.on('activate', function () {
  // On macOS it's common to re-create a window in the app when the
  // dock icon is clicked and there are no other windows open.
  if (mainWindow === null) {
    createWindow()
  }
})


