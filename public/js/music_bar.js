var canvasWidth = 1350
var audioEl = document.getElementById("audio1")
var canvas = document.getElementById("progress1").getContext('2d')
var ctrl = document.getElementById('audioControl1')

function togglePlaying() {

    var method;
    if (ctrl.getAttribute("action") == "play") {
        method = 'pause';
        musicAction = 'play';
    } else {
        method = 'play';
        musicAction = 'pause';
    }
    ctrl.setAttribute('action',method);
    ctrl.setAttribute('class','fas fa-'+method+' fa-inverse');

    audioEl[musicAction]()
}

function updateBar() {
canvas.clearRect(0, 0, canvasWidth, 50)
canvas.fillStyle = "#000";
canvas.fillRect(0, 0, canvasWidth, 50)

var currentTime = audioEl.currentTime
var duration = audioEl.duration

// if (currentTime === duration) {
//     ctrl.innerHTML = "Play"L
// }

document.getElementById("current-time").innerHTML = convertElapsedTime(currentTime)

var percentage = currentTime / duration
var progress = (canvasWidth * percentage)
canvas.fillStyle = "rgb(132, 255, 255)"
canvas.fillRect(0, 0, progress, 50)
}

function convertElapsedTime(inputSeconds) {
var seconds = Math.floor(inputSeconds % 60)
if (seconds < 10) {
seconds = "0" + seconds
}
var minutes = Math.floor(inputSeconds / 60)
return minutes + ":" + seconds
}



// var canvasWidth = 1350
// var audioEl = document.getElementById("audio1")
// var canvas = document.getElementById("progress1").getContext('2d')
// var ctrl = document.getElementById('audioControl1')

// function togglePlaying() {

// var play = ctrl.innerHTML === 'Play'
// var method

// if (play) {
// ctrl.innerHTML = 'Pause'
// method = 'play'
// } else {
// ctrl.innerHTML = "Play"
// method = 'pause'
// }

// audioEl[method]()

// }

// function updateBar() {
// canvas.clearRect(0, 0, canvasWidth, 50)
// canvas.fillStyle = "#000";
// canvas.fillRect(0, 0, canvasWidth, 50)

// var currentTime = audioEl.currentTime
// var duration = audioEl.duration

// // if (currentTime === duration) {
// //     ctrl.innerHTML = "Play"L
// // }

// document.getElementById("current-time").innerHTML = convertElapsedTime(currentTime)

// var percentage = currentTime / duration
// var progress = (canvasWidth * percentage)
// canvas.fillStyle = "white"
// canvas.fillRect(0, 0, progress, 50)
// }

// function convertElapsedTime(inputSeconds) {
// var seconds = Math.floor(inputSeconds % 60)
// if (seconds < 10) {
// seconds = "0" + seconds
// }
// var minutes = Math.floor(inputSeconds / 60)
// return minutes + ":" + seconds
// }