<?php
session_start();

// Se arriva da una pagina demo, usa quella per il matching
if (isset($_GET['from']) && !empty($_GET['from'])) {
    $path = urldecode($_GET['from']);
} else {
    // Fallback: pagine di test
    $pagine = array(
        "https://en.wikipedia.org/wiki/Nike,_Inc.",
        "https://en.wikipedia.org/wiki/Coca-Cola",
        "https://en.wikipedia.org/wiki/Ferrari",
        "https://en.wikipedia.org/wiki/PlayStation",
        "https://en.wikipedia.org/wiki/Spotify"
    );
    $path = $pagine[array_rand($pagine)];
}
setcookie('pagina', $path, time()+3600, '/');
$_SESSION['secretcode'] = '6134';

//codice non serve.
/*$_SESSION['secretcode']='6134';
if(isset($_SESSION['secretcode']) && $_SESSION['secretcode']=='6134')
{
	$secretcode=$_SESSION['secretcode'];
	session_unset();
	session_destroy();
	session_start();
	$_SESSION['secretcode']=$secretcode;
}
else
{
	// Desetta tutte le variabili di sessione.
	session_unset();
	// Infine , distrugge la sessione.
	session_destroy();
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = '../index.php?u=newsurvey/index.php';
	header("Location: http://$host$uri/$extra");
	exit;
}*/
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
		<title>Survey -  SponsoredCAPTCHaStar!</title>
	</head>
	<body>
	<div>
		<span id="lang">
				<a href="indexIt.php" id="lang_switch">ITA</a>
				<span id="lang_switch_selected">ENG</span>
		</span>
			<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT_-buI3dtXGZeI7IbDZkKaEE0wHz6E1f5kNQ&usqp=CAU" style="width: 100%;"/>
		<h1>Survey</h1>
		<div id="description">
			<h2>What is a CAPTCHA?</h2>
			<p>CAPTCHA is an acronym that stands for Completely Automated Public Turing test to tell Computers and Humans Apart.
			In practice, a CAPTCHA is a test used to check whether a computer system is being used by a real human (and not by an automated program).
			CAPTCHAs are useful to avoid the abuse of online services by some malicious programs, for example the registration of e-mail addresses to send spam.
			The most common CAPTCHA is the text based in wich you need to rewrite a distorted text (e.g. <img style="margin-top: -0px;" src="TBCexample.png" alt="Captcha text-based" />) in a text-box.
			<p></p>
			<h2>What is a Sponsored CAPTCHA?</h2>
			<p> A Sponsored Captcha is a captcha in which logos from different brands are involved into the challenge.</p>
			
			
		</div>

		<div id="tutorial" style = "background-color:grey">
			<h2>How it works:</h2>
			<p>Solve a <span>CAPTCHaStar</span> is simple!</p>
			<p>You just need to move the mouse over the black square, and <span>click</span> when those little white dots forms a recognizable shape.</p>
			<p>In practice, you need to find the correct position of the mouse cursor inside the box, as in the example below.</p>
			<img src="tutorial.gif" alt="animated demo" />
			<h2>Try it yourself!</h2>
			<p>To become familiar with CAPTCHaStar, before starting the test, we ask you to solve one.</p>
			<p>Move the mouse in the square below, and click <span id="mobileinstructions">(on the CHECK link outside the square)</span> when you see a recognizable shape.</p>
			
<!--START code for make the captcha working-->
<a href="#captchatest" label="captchatest"><img src="reset.png" alt="Load another test" onClick="restart()"/></a> - <span id="mobilecheck" onClick="mobilecheck()"><a href="#captchatest"> CHECK</a></span>
<br/>
<canvas id="captcha" width="300" height="300" style="touch-action: none;">
	TODO flash version
</canvas>
<img id="logoImage" style="display: none;" align ="right"> 
<p id="iHaveAMouse" onClick="iHaveAMouse()" style="font-size: 50%;"><a href="#captchatest"> Something wrong, i have a mouse.</a></p>
<div id="result">
</div>
<!-- <img id="logoImage" style="display: none" align ="right">  -->
<script>
function iHaveAMouse()
{
	if(isTouch) isTouch=false;
	else return;
	//rimuoviamo i controlli touch
	canvas.removeEventListener("touchmove", mossoTap);
	canvas.removeEventListener("touchstart", cliccatoTap);
	canvas.removeEventListener("touchend", rilasciatoTap);
	//aggiungiamo i controlli del mouse
	canvas.addEventListener('mousemove', anima ,false);
	canvas.addEventListener('click', controlla, false);

	//rimuoviamo cose visibili
	var checkmobile=document.getElementById("mobilecheck");
	checkmobile.style.display="none";
	var mobilefix=document.getElementById("iHaveAMouse");
	mobilefix.style.display="none";
}
function isTouchSupported() {
    var msTouchEnabled = window.navigator.msMaxTouchPoints;
    var generalTouchEnabled = "ontouchstart" in document.createElement("div");
 
    if (msTouchEnabled || generalTouchEnabled) {
        return true;
    }
    return false;
}
var isTouch=isTouchSupported();
//document.title=isTouch;
//variabili globali di struttura
var canvas = document.getElementById("captcha");
var vertex = [];
var bigVertex = [];
var nvertex=0;
var lines;

var pointSize=4;
var bigPointSize=14;
var oldX=0;
var oldY=0;
var nControlli=0;
//attiva i controlli mobile
	var checkmobile=document.getElementById("mobilecheck");
	var instructionsmobile=document.getElementById("mobileinstructions");
	if(isTouch) checkmobile.style.display="inline";
	else
	{
		checkmobile.style.display="none";
		instructionsmobile.style.display="none";
		var mobilefix=document.getElementById("iHaveAMouse");
		mobilefix.style.display="none";
	}
	var canvas = document.getElementById("captcha");
	var virtualMouseX=0;
	var virtualMouseY=0;
	var virtualMousePic=new Image();
	virtualMousePic.src="mouse.png";
	var dragging=false;
	var tapX,tapY,oldTapX,oldTapY;
	var checkPerformed=false;
	if(isTouch)
	{
		canvas.addEventListener("touchmove", mossoTap);
		canvas.addEventListener("touchstart", cliccatoTap);
		canvas.addEventListener("touchend", rilasciatoTap);
		/* TODO non aggiungendoli qualcosa non funzionerà
		//aggiungiamo pure quelli del mouse, because si.
		canvas.addEventListener('mousemove', anima ,false);
		canvas.addEventListener('click', controlla, false);*/
	}
	else
	{
		//aggiungiamo il listener del mouse
		canvas.addEventListener('mousemove', anima ,false);
		//ora il listener del click
		canvas.addEventListener('click', controlla, false);
	}
	function mossoTap(evt)
	{
		//document.title="moving";
	    evt.preventDefault();
	    if(!dragging) return;
	    if(checkPerformed) return;
	    //dragging=true;
	    oldTapX = tapX;
	    oldTapY = tapY;
	    tapX = evt.targetTouches[0].pageX;
	    tapY = evt.targetTouches[0].pageY;
	    var Xamount=Math.abs(oldTapX-tapX)/(window.innerWidth/300);
	    var Yamount=Math.abs(oldTapY-tapY)/(window.innerHeight/300);

	    if(oldTapX>tapX) virtualMouseX-=Xamount;
	    else if(oldTapX<tapX) virtualMouseX+=Xamount;
	    if(virtualMouseX<10) virtualMouseX=10;
	    if(virtualMouseX>290) virtualMouseX=290;

	    if(oldTapY>tapY) virtualMouseY-=Yamount;
	    else if(oldTapY<tapY) virtualMouseY+=Yamount;
	    if(virtualMouseY<10) virtualMouseY=10;
	    if(virtualMouseY>290) virtualMouseY=290;

	    disegna(virtualMouseX,virtualMouseY);
	    var canvas = document.getElementById("captcha");
		var ctx = canvas.getContext("2d");
	    ctx.drawImage(virtualMousePic,virtualMouseX,virtualMouseY);
	}
	function cliccatoTap(evt)
	{
		//document.title="tapped";
	    evt.preventDefault();
	    dragging=true;
	    tapX = evt.targetTouches[0].pageX;
	    tapY = evt.targetTouches[0].pageY;
	}
	function rilasciatoTap(evt)
	{
		//document.title="released";
	    evt.preventDefault();
	    dragging=false;
	}
	function mobilecheck()
	{
		if(checkPerformed) return;
		checkPerformed=true;
		var canvas = document.getElementById("captcha");
		var ctx = canvas.getContext("2d");
		var box = document.getElementById("result");
		box.innerHTML="Checking..."+box.innerHTML;

		//rimuoviamo i listener
		canvas.removeEventListener('mousemove', anima ,false);
		canvas.removeEventListener('click', controlla ,false);

		//chiama il verify
		var fileName = "../../lib/verify.php?tx="+virtualMouseX+"&ty="+virtualMouseY;
		var txtFile;
	    if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			txtFile = new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			txtFile = new ActiveXObject("Microsoft.XMLHTTP");
		}
		txtFile.open("GET",fileName,false);
		txtFile.send();
		var txtDoc = txtFile.responseText;
		lines = txtDoc.split("\n"); // values in lines[0], lines[1]...
		if(lines[0]=="true")
		{
			box.innerHTML=box.innerHTML.replace("Checking...","<span id=\"success\">Success!</span> You're an human!");
			var stbutton = document.getElementById("startbutton");
			stbutton.value="Start!";
			stbutton.removeAttribute("disabled");
			//settiamo che ha il mouse nel form
			var usamouse=document.getElementById("mouseused");
			usamouse.value=isTouch;
			
		}
		else
		{
			box.innerHTML=box.innerHTML.replace("Checking...","<span id=\"failure\"> Failure!</span> Are you a robot?");
			var stbutton = document.getElementById("startbutton");
			stbutton.value="Please solve the CAPTCHA before starting the survey.";
			stbutton.setAttribute("disabled", true);
		}
	}
//FINE controlli mobile
function Point(mxx, mxy, cx, myx, myy, cy) {
//RIGA = moltiplicatoreXX moltiplicatoreXY costanteX moltiplicatoreYX moltiplicatoreYY costanteY
  this.mxx = mxx;
  this.mxy = mxy;
  this.cx = cx;
  this.myx = myx;
  this.myy = myy;
  this.cy = cy;
}
function controlla(evt) {
	var canvas = document.getElementById("captcha");
	var rect = canvas.getBoundingClientRect();
	var ctx = canvas.getContext("2d");
	var mousePos = getMousePos(canvas, evt);
	var mousex=Math.round(mousePos.x);
	var mousey=Math.round(mousePos.y);
	var box = document.getElementById("result");
	var rateit = document.getElementById("rateit");
	box.innerHTML="Checking..."+box.innerHTML;

	//rimuoviamo i listener
	canvas.removeEventListener('mousemove', anima ,false);
	canvas.removeEventListener('click', controlla ,false);

	//chiama il verify
	var fileName = "../../lib/verify.php?tx="+mousex+"&ty="+mousey;
	var txtFile;
    if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		txtFile = new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		txtFile = new ActiveXObject("Microsoft.XMLHTTP");
	}
	txtFile.open("GET",fileName,false);
	txtFile.send();
	var txtDoc = txtFile.responseText;
	lines = txtDoc.split("\n"); // values in lines[0], lines[1]...
	
	if(lines[0]=="true")
	{

		box.innerHTML=box.innerHTML.replace("Checking...","<span id=\"success\">Successo!</span> You're an human!");
		document.getElementById("logoImage").style.display = "block";

		var stbutton = document.getElementById("startbutton");
		stbutton.value="Start!";
		stbutton.removeAttribute("disabled");
		stbutton.style.background="lightgreen";
		//settiamo che ha il mouse nel form
		var usamouse=document.getElementById("mouseused");
		usamouse.value=isTouch;
	}
	else
	{

		box.innerHTML=box.innerHTML.replace("Checking...","<span id=\"failure\"> Failure!</span> Are you a robot?");
		var stbutton = document.getElementById("startbutton");
		stbutton.value="Please solve the CAPTCHA before starting the survey.";
		stbutton.setAttribute("disabled", true);
		stbutton.style.background="lightred";
	}
}
function anima(evt) {
	var ctx = canvas.getContext("2d");
	var mousePos = getMousePos(canvas, evt);
	var mousex=mousePos.x;
	var mousey=mousePos.y;
		//puliamo il canvas
	disegna(mousex,mousey);
}
function bug_workaround() {
  canvas.style.opacity = 0.99;
  setTimeout(function() {
  canvas.style.opacity = 1;
  }, 1);
}
function disegna(mousex,mousey) {
		//puliamo il canvas
	// Store the current transformation matrix
	ctx.save();
	// Use the identity matrix while clearing the canvas
	ctx.setTransform(1, 0, 0, 1, 0, 0);
	ctx.clearRect(0, 0, canvas.width, canvas.height);
	// Restore the transform
	ctx.restore();
	bug_workaround();

	//draw everything
	for(i=0;i<vertex.length;i++)
	{
		x=vertex[i].mxy*mousey/100000+vertex[i].mxx*mousex/100000+vertex[i].cx-pointSize/2;
		y=vertex[i].myx*mousex/100000+vertex[i].myy*mousey/100000+vertex[i].cy-pointSize/2;
		ctx.fillRect(x,y,pointSize,pointSize);
	}
	for(i=0;i<bigVertex.length;i++)
	{
		x=bigVertex[i].mxy*mousey/100000+bigVertex[i].mxx*mousex/100000+bigVertex[i].cx-bigPointSize/2;
		y=bigVertex[i].myx*mousex/100000+bigVertex[i].myy*mousey/100000+bigVertex[i].cy-bigPointSize/2;
		ctx.fillRect(x,y,bigPointSize,bigPointSize);
	}
}
function getMousePos(canvas, evt) {
    var rect = canvas.getBoundingClientRect();
    var newX=evt.clientX - rect.left;
    var newY=evt.clientY - rect.top;
    	returnX=newX;
    	returnY=newY;
    return {
        x: returnX,
        y: returnY
    };
}
function parseLines(saveTo, indToStart)
{//legge lines a partire da indToStart e salva i valori in saveTo, ritorna l'indice con valore non leggibile
	i=indToStart+1;
	while(true)
	{//RIGA = moltiplicatoreXX moltiplicatoreXY costanteX moltiplicatoreYX moltiplicatoreYY costanteY
		mxx=parseInt(lines[i]);
		if(isNaN(mxx)) break;
		lines[i]=lines[i].substring(lines[i].indexOf(" ")+1);		
		mxy=parseInt(lines[i]);
		lines[i]=lines[i].substring(lines[i].indexOf(" ")+1);		
		cx=parseInt(lines[i]);
		lines[i]=lines[i].substring(lines[i].indexOf(" ")+1);		
		myx=parseInt(lines[i]);
		lines[i]=lines[i].substring(lines[i].indexOf(" ")+1);		
		myy=parseInt(lines[i]);
		lines[i]=lines[i].substring(lines[i].indexOf(" ")+1);		
		cy=parseInt(lines[i]);
		saveTo.push(new Point(mxx, mxy, cx, myx, myy,cy));
		i++;
		nvertex++;
	}
	return i;
}
function load()
{
	//svuotiamo gli array
	nvertex=0;
	while(vertex.length > 0) vertex.pop();
	while(bigVertex.length > 0) bigVertex.pop();
	
	var fileName = "../../lib/getter.php";
	var txtFile;
        if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  txtFile = new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  txtFile = new ActiveXObject("Microsoft.XMLHTTP");
	  }
	txtFile.open("GET",fileName,false);
	txtFile.send();
	var txtDoc = txtFile.responseText;
	lines = txtDoc.split("\n"); // values in lines[0], lines[1]...
	//in lines abbiamo linea per linea i file
	//var logo = "";
	var i=0;
	while(i<lines.length)
	{
		if(lines[i].substring(0,3)==="# F") {
			logo = lines[i].substring(4); // Salta "# F "
			var parts = logo.split('/');
			category = parts[parts.length - 2];
			image = parts[parts.length - 1];
			document.getElementById("logoImage").src = "/logos/"+category+'/'+image;
			document.getElementById("logoImage").style.display = "none";

			// alert(logo);
		}
		if(lines[i].substring(0,3)==="# b")
			i=parseLines(bigVertex,i);
		else if(lines[i].substring(0,3)==="# s")
			i=parseLines(vertex,i);
		else if(lines[i].substring(0,3)==="# A")
		{
			alert(lines[i]);
			i++;
		}
		else i++;
	}
	//alert(logo);
	disegna(150,150);
}
function restart()
{
	box = document.getElementById("result");
	box.innerHTML="";
	load();
	if(!isTouch)
	{
		canvas.addEventListener('mousemove', anima ,false);
		//ora il listener del click
		canvas.addEventListener('click', controlla, false);
	}
	/*else
	{		
		//TODO ridondante, ma serve
		canvas.addEventListener('mousemove', anima ,false);
		canvas.addEventListener('click', controlla, false);
	}*/
	checkPerformed=false;
	virtualMousePic.src="mouse.png";
}
var canvas = document.getElementById("captcha");
var ctx = canvas.getContext("2d");
ctx.fillStyle = "#FFFFFF";

load();
checkPerformed=false;
</script>
<!--END code for the working CAPTCHA-->
		</div>
	</body>
</html>