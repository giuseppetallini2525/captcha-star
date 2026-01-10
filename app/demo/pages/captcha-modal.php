<?php
/**
 * Pagina CAPTCHA per il modal - versione semplificata
 */
session_start();

// Ricevi la pagina di origine per il matching
$fromPage = isset($_GET['from']) ? urldecode($_GET['from']) : '';
if (!empty($fromPage)) {
    setcookie('pagina', $fromPage, time()+3600, '/');
}

$_SESSION['secretcode'] = '6134';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sponsored CAPTCHA</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: transparent;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            min-height: 100%;
        }
        .captcha-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
            text-align: center;
        }
        .captcha-subtitle {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .captcha-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }
        #captcha {
            background: #000;
            border-radius: 8px;
            cursor: crosshair;
        }
        .controls {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        .btn-reset {
            background: #f3f4f6;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.85rem;
            color: #374151;
            transition: background 0.2s;
        }
        .btn-reset:hover {
            background: #e5e7eb;
        }
        #result {
            text-align: center;
            min-height: 24px;
            font-weight: 500;
        }
        #result .success {
            color: #059669;
        }
        #result .failure {
            color: #dc2626;
        }
        .logo-reveal {
            margin-top: 1rem;
            text-align: center;
            animation: fadeIn 0.5s ease;
        }
        .logo-reveal img {
            max-width: 200px;
            max-height: 120px;
            object-fit: contain;
        }
        .logo-reveal p {
            margin-top: 0.5rem;
            color: #059669;
            font-weight: 600;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .instructions {
            font-size: 0.8rem;
            color: #888;
            text-align: center;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <h1 class="captcha-title">Sponsored CAPTCHA</h1>
    <p class="captcha-subtitle">Verify you're human to continue</p>

    <p class="instructions">Move your mouse over the black box. Click when you see a recognizable shape.</p>

    <div class="captcha-container">
        <canvas id="captcha" width="300" height="300"></canvas>

        <div class="controls">
            <button class="btn-reset" onclick="restart()">Try Another</button>
        </div>

        <div id="result"></div>

        <div id="logoReveal" class="logo-reveal" style="display: none;">
            <img id="logoImage" src="" alt="Sponsored Logo">
            <p>Sponsored by this brand!</p>
        </div>
    </div>

<script>
var canvas = document.getElementById("captcha");
var ctx = canvas.getContext("2d");
ctx.fillStyle = "#FFFFFF";

var vertex = [];
var bigVertex = [];
var lines;
var logo = "";
var pointSize = 4;
var bigPointSize = 14;
var canClick = true; // Flag per permettere i click

function Point(mxx, mxy, cx, myx, myy, cy) {
    this.mxx = mxx;
    this.mxy = mxy;
    this.cx = cx;
    this.myx = myx;
    this.myy = myy;
    this.cy = cy;
}

function load() {
    vertex = [];
    bigVertex = [];

    // Aggiungi timestamp per evitare cache e ottenere un nuovo logo
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../../../lib/getter.php?t=" + Date.now(), false);
    xhr.send();

    lines = xhr.responseText.split("\n");
    var i = 0;

    while(i < lines.length) {
        if(lines[i].substring(0,3) === "# F") {
            logo = lines[i].substring(4);
            var parts = logo.split('/');
            var category = parts[parts.length - 2];
            var image = parts[parts.length - 1];
            document.getElementById("logoImage").src = "../../../logos/" + category + '/' + image;
        }
        if(lines[i].substring(0,3) === "# b")
            i = parseLines(bigVertex, i);
        else if(lines[i].substring(0,3) === "# s")
            i = parseLines(vertex, i);
        else
            i++;
    }

    disegna(150, 150);
}

function parseLines(saveTo, indToStart) {
    var i = indToStart + 1;
    while(true) {
        var mxx = parseInt(lines[i]);
        if(isNaN(mxx)) break;

        var parts = lines[i].split(" ");
        saveTo.push(new Point(
            parseInt(parts[0]),
            parseInt(parts[1]),
            parseInt(parts[2]),
            parseInt(parts[3]),
            parseInt(parts[4]),
            parseInt(parts[5])
        ));
        i++;
    }
    return i;
}

function disegna(mousex, mousey) {
    ctx.save();
    ctx.setTransform(1, 0, 0, 1, 0, 0);
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.restore();

    for(var i = 0; i < vertex.length; i++) {
        var x = vertex[i].mxy * mousey / 100000 + vertex[i].mxx * mousex / 100000 + vertex[i].cx - pointSize/2;
        var y = vertex[i].myx * mousex / 100000 + vertex[i].myy * mousey / 100000 + vertex[i].cy - pointSize/2;
        ctx.fillRect(x, y, pointSize, pointSize);
    }

    for(var i = 0; i < bigVertex.length; i++) {
        var x = bigVertex[i].mxy * mousey / 100000 + bigVertex[i].mxx * mousex / 100000 + bigVertex[i].cx - bigPointSize/2;
        var y = bigVertex[i].myx * mousex / 100000 + bigVertex[i].myy * mousey / 100000 + bigVertex[i].cy - bigPointSize/2;
        ctx.fillRect(x, y, bigPointSize, bigPointSize);
    }
}

function getMousePos(canvas, evt) {
    var rect = canvas.getBoundingClientRect();
    return {
        x: evt.clientX - rect.left,
        y: evt.clientY - rect.top
    };
}

// Funzione per il movimento del mouse
function handleMouseMove(evt) {
    var pos = getMousePos(canvas, evt);
    disegna(pos.x, pos.y);
}

// Funzione per il click
function handleClick(evt) {
    if (!canClick) return; // Ignora click se già cliccato

    var pos = getMousePos(canvas, evt);
    var mousex = Math.round(pos.x);
    var mousey = Math.round(pos.y);

    var box = document.getElementById("result");
    box.innerHTML = "Checking...";
    canClick = false; // Disabilita ulteriori click

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../../../lib/verify.php?tx=" + mousex + "&ty=" + mousey, false);
    xhr.send();

    var response = xhr.responseText.split("\n");

    if(response[0] === "true") {
        box.innerHTML = '<span class="success">Correct! You are human.</span>';
        document.getElementById("logoReveal").style.display = "block";
        // Notify parent window
        if(window.parent && window.parent !== window) {
            window.parent.postMessage({type: 'captcha-success'}, '*');
        }
    } else {
        box.innerHTML = '<span class="failure">Incorrect. Try again!</span>';
        setTimeout(function() {
            restart();
        }, 1500);
    }
}

// Aggiungi i listener
canvas.addEventListener('mousemove', handleMouseMove);
canvas.addEventListener('click', handleClick);

function restart() {
    document.getElementById("result").innerHTML = "";
    document.getElementById("logoReveal").style.display = "none";
    canClick = true; // Riabilita i click
    load();
}

load();
</script>
</body>
</html>
