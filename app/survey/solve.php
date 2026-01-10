<?php
session_start();
include '../../lib/dati.php';
//mancano le variabili di session
if(!isset($_REQUEST['nickname']) && !isset($_SESSION['Snickname']))
{//ritorna alla home, e basta.
	/* Redirect to a different page in the current directory that was requested */
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'index.php';
	header("Location: http://$host$uri/$extra");
	exit;
}
//è il primo livello, metto tutte le variabile inviate nella session e nel db
if(isset($_REQUEST['nickname']) && !isset($_SESSION['Snickname']))
{
	//se il nickname ha meno di 2 caratteri, lo killo
	if(strlen(mysqli_real_escape_string($conn, $_REQUEST['nickname']))<2) die("Invalid nickname!");

	//controllo validità
	$mail=mysqli_real_escape_string($conn, $_REQUEST['email']);
	$query = "SELECT * FROM captchasurvey WHERE email='".$mail."' ORDER BY repeatedntimes DESC";
	$result = mysqli_query($conn, $query);
	if(mysqli_num_rows($result)>0)
	{
		//TODO rifarglielo fare, con n+1
		$row = mysqli_fetch_array($result);
		$_SESSION['Snesimavolta']=$row['repeatedntimes']+1;
	}
	if($_SESSION['secretcode']!='6134') die("Wrong code.<br/>Are you authorized?");

	$_SESSION['Snickname']=mysqli_real_escape_string($conn, $_REQUEST['nickname']);
	$_SESSION['Semail']=mysqli_real_escape_string($conn, $_REQUEST['email']);
	$_SESSION['Sage']=mysqli_real_escape_string($conn, $_REQUEST['age']);
	$_SESSION['Seducation']=mysqli_real_escape_string($conn, $_REQUEST['education']);
	$_SESSION['Snationality']=mysqli_real_escape_string($conn, $_REQUEST['nationality']);
	$_SESSION['Sgender']=mysqli_real_escape_string($conn, $_REQUEST['gender']);
	$_SESSION['Sageinternet']=mysqli_real_escape_string($conn, $_REQUEST['ageinternet']);
	$_SESSION['Sfrequencyinternet']=mysqli_real_escape_string($conn, $_REQUEST['frequencyinternet']);
	$_SESSION['Smousewasused']=mysqli_real_escape_string($conn, $_REQUEST['mousewasused']);
	$confirm=date("F j, Y, g:i a");
	$_SESSION['Sconfirmcode']=$confirm;
	//prendo l'indirizzo ip
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	    $ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
	    $ip = $_SERVER['REMOTE_ADDR'];
	}
	
	//metto questi dati nel database
	if(isset($_SESSION['Snesimavolta'])) $query = "INSERT into captchasurvey (repeatedntimes,nickname, email, ip, gender, age, education, nationality, ageinternet, frequencyinternet, virtualmousewasused, confirm) VALUES
	(".$_SESSION['Snesimavolta'].", \"".$_SESSION['Snickname']."\",\"".$_SESSION['Semail']."\", \"".$ip."\", '".$_SESSION['Sgender']."', '".$_SESSION['Sage']."', \"".$_SESSION['Seducation']."\", \"".$_SESSION['Snationality']."\", '".$_SESSION['Sageinternet']."', \"".$_SESSION['Sfrequencyinternet']."\", \"".$_SESSION['Smousewasused']."\", \"".$confirm."\");";
	else $query = "INSERT into captchasurvey (nickname, email, ip, gender, age, education, nationality, ageinternet, frequencyinternet, virtualmousewasused, confirm) VALUES
	(\"".$_SESSION['Snickname']."\",\"".$_SESSION['Semail']."\", \"".$ip."\", '".$_SESSION['Sgender']."', '".$_SESSION['Sage']."', \"".$_SESSION['Seducation']."\", \"".$_SESSION['Snationality']."\", '".$_SESSION['Sageinternet']."', \"".$_SESSION['Sfrequencyinternet']."\", \"".$_SESSION['Smousewasused']."\", \"".$confirm."\");";
	//print($query);
	$result = mysqli_query($conn, $query);
	if(!$result) die("Connection to the database failed\n");

	//inizializzo altre variabili
	$_SESSION['Sidcurrentsurvey']=mysqli_insert_id($conn);

	$_SESSION['Sprogress']=1;
	//valore random
	$invalid=true;
	while($invalid)
	{
		if(isset($_SESSION['Snesimavolta']) && $_SESSION['Snesimavolta']>5) $lvl=rand(1,6);
		else $lvl=rand(1,8);
		$query="SELECT level".$lvl."id as tester FROM captchasurvey WHERE id='".$_SESSION['Sidcurrentsurvey']."'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($result);
		if($row['tester']==NULL) $invalid=false;
	}
	$_SESSION['Slivello']=$lvl;
}
//ricevo i dati dal textbasedCAPTCHA e lo registro tutto in ID
if(isset($_REQUEST['ratehuman']) && isset($_REQUEST['ratepc']) && isset($_REQUEST['answer']))
{
	//prendo i dati da request.
	$submitstring=$_REQUEST['ispassed'].";".$_REQUEST['time'].";".$_REQUEST['answer'].";".$_REQUEST['ratehuman'].".".$_REQUEST['ratepc'].";".$_REQUEST['captchanswer'];
	$query = "UPDATE captchasurvey	SET `level".$_SESSION['Slivello']."id`='".$submitstring."' WHERE `id`='".$_SESSION['Sidcurrentsurvey']."'";
	$result = mysqli_query($conn, $query);
	if(!$result) die("Connection to the database failed\n".$query);


	//aumento il progress
	$_SESSION['Sprogress']=$_SESSION['Sprogress']+1;
	//genero il livello a random (fermarsi se sono tutti NULL)
	if($_SESSION['Sprogress']<=8) $invalid=true;
	else $invalid=false;
	if((isset($_SESSION['Snesimavolta']) && $_SESSION['Snesimavolta']>5) && $_SESSION['Sprogress']>6) $invalid=false;
	$lvl=9999;
	while($invalid)
	{
		if(isset($_SESSION['Snesimavolta']) && $_SESSION['Snesimavolta']>5) $lvl=rand(1,6);
		else $lvl=rand(1,8);
		$query="SELECT level".$lvl."id as tester FROM captchasurvey WHERE id='".$_SESSION['Sidcurrentsurvey']."'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($result);
		if($row['tester']==NULL) $invalid=false;
	}
	$_SESSION['Slivello']=$lvl;
}
//ricevo i dati di rating
else if(isset($_SESSION['Sidlastchallenge']) && isset($_REQUEST['ratehuman']) && isset($_REQUEST['ratepc']))
{
	$ratestring=$_REQUEST['ratehuman'].".".$_REQUEST['ratepc'];
	$query = "UPDATE captchasession	SET `rating`='".$ratestring."' WHERE `id`='".$_SESSION['Sidlastchallenge']."'";
	//print($query);
	$result = mysqli_query($conn, $query);
	if(!$result) die("Failed:\n".$query);
	//aggiungo idlastchallenge alla colonna corrispondente di captchasurvey
	$query = "UPDATE captchasurvey	SET `level".$_SESSION['Slivello']."id`='".$_SESSION['Sidlastchallenge']."' WHERE `id`='".$_SESSION['Sidcurrentsurvey']."'";
	//print($query);
	$result = mysqli_query($conn, $query);
	if(!$result) die("Failed:\n".$query);

	$_SESSION['Sprogress']=$_SESSION['Sprogress']+1;
	// genero il livello a random (fermarsi se sono tutti NULL)
	if($_SESSION['Sprogress']<=8) $invalid=true;
	else $invalid=false;
	if(isset($_SESSION['Snesimavolta']) && $_SESSION['Snesimavolta']>5 && $_SESSION['Sprogress']>6) $invalid=false;
	$lvl=9999;
	while($invalid)
	{
		if(isset($_SESSION['Snesimavolta']) && $_SESSION['Snesimavolta']>5) $lvl=rand(1,6);
		else $lvl=rand(1,8);
		$query="SELECT level".$lvl."id as tester FROM captchasurvey WHERE id='".$_SESSION['Sidcurrentsurvey']."'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($result);
		if($row['tester']==NULL) $invalid=false;
	}
	$_SESSION['Slivello']=$lvl;
}
//genero il livello corrente
if(isset($_SESSION['Slivello']))
{

	if($_SESSION['Slivello']==1)
	{
		$_SESSION['SnoiseLevel']=0;
		$_SESSION['Ssensibility']=5;
		$_SESSION['SenableRotation']=false;
		$_SESSION['SnumberOfSolutions']=1;
		$_SESSION['Sneedboth']=false;
	}
	else if($_SESSION['Slivello']==2)
	{
		$_SESSION['SnoiseLevel']=70;
		$_SESSION['Ssensibility']=7;
		$_SESSION['SenableRotation']=false;
		$_SESSION['SnumberOfSolutions']=1;
		$_SESSION['Sneedboth']=false;
	}
	else if($_SESSION['Slivello']==3)
	{
		$_SESSION['SnoiseLevel']=70;
		$_SESSION['Ssensibility']=7;
		$_SESSION['SenableRotation']=true;
		$_SESSION['SnumberOfSolutions']=1;
		$_SESSION['Sneedboth']=false;
	}
	else if($_SESSION['Slivello']==4)
	{
		$_SESSION['SnoiseLevel']=10;
		$_SESSION['Ssensibility']=7;
		$_SESSION['SenableRotation']=false;
		$_SESSION['SnumberOfSolutions']=2;
		$_SESSION['Sneedboth']=true;
	}
	else if($_SESSION['Slivello']==5)
	{
		$_SESSION['SnoiseLevel']=0;
		$_SESSION['Ssensibility']=7;
		$_SESSION['SenableRotation']=false;
		$_SESSION['SnumberOfSolutions']=3;
		$_SESSION['Sneedboth']=false;
	}
	else if($_SESSION['Slivello']==6)
	{
		$_SESSION['SnoiseLevel']=250;
		$_SESSION['Ssensibility']=5;
		$_SESSION['SenableRotation']=false;
		$_SESSION['SnumberOfSolutions']=1;
		$_SESSION['Sneedboth']=false;
	}

	//TEXTBASED
	else if($_SESSION['Slivello']==7)
	{
		//textbased, lo gestiamo in un altra pagina
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'tbcsolve.php';
		header("Location: http://$host$uri/$extra");
		exit;
	}
	else if($_SESSION['Slivello']==8)
	{
		//
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'tbcsolve.php';
		header("Location: http://$host$uri/$extra");
		exit;
	}
	else //finito.
	{
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'landing.php';
		header("Location: http://$host$uri/$extra");
		exit;
	}
	//inizializzo il timer
	$_SESSION['Sstarttime']=time();
}

//conto il progress
$progresso=$_SESSION['Sprogress'];
if(isset($_SESSION['Snesimavolta'])) $progresso=$progresso+8+($_SESSION['Snesimavolta']-1)*8;
$totale=8;
if(isset($_SESSION['Snesimavolta'])) $totale=$totale+($_SESSION['Snesimavolta'])*8;

if(isset($_SESSION['Snesimavolta']) && $_SESSION['Snesimavolta']>5)
{
	$progresso=$progresso-($_SESSION['Snesimavolta']-5)*2;
	$totale=$totale-($_SESSION['Snesimavolta']-5)*2;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<title>Test <?php print $_SESSION['Sprogress']." - ".$_SESSION['Snickname']; ?> - CAPTCHaStar's Survey</title>
	</head>
	<body>
	<div>
		<img src="header.png" style="width: 100%;"/>
		<h1>Survey</h1>
		<div id="progress">
			<p>You are at test number <span><?php print($progresso."/".$totale); ?></span>.</p>
			<?php
				if($_SESSION['Slivello']==4)
				{
					print "<br/><p>In this test you will need to find <span style='color: #FF2222;'>two images in sequence.</span></p>";
					print "<script> confirm('In this test you will need to find two different images one after the other. These images will be in different positions. After you find the first one, the test will ask you to find the next one.'); </script>";
				}
			?>
		</div>
		<script>
		//conferma prima di uscire
		window.onbeforeunload = function() {
    		return 'Are you sure? Progress will not be saved';
		};
		//registra il movimento del mouse
		var tickmouse=setInterval(function(){logMouse()},100);
		var log="";
		var logX=0;
		var logY=0;
		var nlog=0;
		function logMouse()
		{
			log=log+" "+logX+"."+logY;
			nlog++;
			//mettiamo i log in variabile di sessione o saranno troppo lunghi per GET
			if(nlog>500)
			{
				var fileName = "writelog.php?l="+log;
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
				log="";
				nlog=0;
			}
		}
		function recordMouse(evt)
		{
			logX=evt.clientX;
			logY=evt.clientY;
		}
		document.addEventListener('mousemove', recordMouse ,false);
		</script>
		<div id="content">
			<h2>Click when you see the shape!</h2>
		<!--code for make the captcha working-->
		<?php
		if(isset($_SESSION['Sneedboth']) && $_SESSION['Sneedboth']) print("<span id='mobilecheck' onClick='mobilecheckBoth()'><a href='#captchatest'> CHECK</a></span>");
		else print("<span id='mobilecheck' onClick='mobilecheck()'><a href='#captchatest'> CHECK</a></span>");
		?>
<br/>
<canvas id="captcha" width="300" height="300" style="">
	TODO flash version
</canvas>
<p id="iHaveAMouse" onClick="iHaveAMouse()" style="font-size: 50%;"><a href="#captchatest"> Something wrong, i have a mouse.</a></p>
<div id="result">
</div>
	<div id="rateit">
		<form name="rate" id="rate" action="solve.php" class="nostyle" method="POST">
			<input name="ratehuman" id="ratehuman" type="hidden" value="0"/>
			<input name="ratepc" id="ratepc" type="hidden" value="0"/>
		<div class="starRate">
			<div class="nostyle"><span>Please rate the difficulty.</span><b></b></div>
				<ul>
					<li><a id="human5" href="javascript:setHuman(5)"><span>Impossible</span></a></li>
					<li><a id="human4" href="javascript:setHuman(4)"><span>Hard</span></a></li>
					<li><a id="human3" href="javascript:setHuman(3)"><span>Challenging</span></a></li>
					<li><a id="human2" href="javascript:setHuman(2)"><span>Medium</span></a></li>
					<li><a id="human1" href="javascript:setHuman(1)"><span>Easy</span></a></li>
				</ul>
			</div>
		<div class="starRate">
			<div class="nostyle"><span>How much do you think it would be difficult for a computer?</span><b></b></div>
				<ul>
					<li><a id="pc5" href="javascript:setPc(5)"><span>Impossible</span></a></li>
					<li><a id="pc4" href="javascript:setPc(4)"><span>Hard</span></a></li>
					<li><a id="pc3" href="javascript:setPc(3)"><span>Challenging</span></a></li>
					<li><a id="pc2" href="javascript:setPc(2)"><span>Medium</span></a></li>
					<li><a id="pc1" href="javascript:setPc(1)"><span>Easy</span></a></li>
				</ul>
		</div>
		<input disabled type="submit" name="continue" id="continue" value=" Continue " style="margin-top: 20px;"/>
		</form>
	</div>
<script>
document.getElementById("continue").disabled = true;
function setHuman(val)
{
	if(val>=1) document.getElementById("human1").className="selected";
	else document.getElementById("human1").className="none";
	if(val>=2) document.getElementById("human2").className="selected";
	else document.getElementById("human2").className="none";
	if(val>=3) document.getElementById("human3").className="selected";
	else document.getElementById("human3").className="none";
	if(val>=4) document.getElementById("human4").className="selected";
	else document.getElementById("human4").className="none";
	if(val>=5) document.getElementById("human5").className="selected";
	else document.getElementById("human5").className="none";
	document.getElementById("ratehuman").value=val;
	if(document.getElementById("ratepc").value>0) document.getElementById("continue").disabled = false;
}
function setPc(val)
{
	if(val>=1) document.getElementById("pc1").className="selected";
	else document.getElementById("pc1").className="none";
	if(val>=2) document.getElementById("pc2").className="selected";
	else document.getElementById("pc2").className="none";
	if(val>=3) document.getElementById("pc3").className="selected";
	else document.getElementById("pc3").className="none";
	if(val>=4) document.getElementById("pc4").className="selected";
	else document.getElementById("pc4").className="none";
	if(val>=5) document.getElementById("pc5").className="selected";
	else document.getElementById("pc5").className="none";
	document.getElementById("ratepc").value=val;
	if(document.getElementById("ratehuman").value>0) document.getElementById("continue").disabled = false;
}

//nascondo il rating
var rateit = document.getElementById("rateit");
rateit.style.display="none";
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
	//ora il listener del click
	<?php
	if(isset($_SESSION['Sneedboth']) && $_SESSION['Sneedboth']) print("canvas.addEventListener('click', controllaBoth, false);");
	else print("canvas.addEventListener('click', controlla, false);");
	?>


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
	if(isTouch) checkmobile.style.display="inline";
	else
	{
		checkmobile.style.display="none";
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
		<?php
		if(isset($_SESSION['Sneedboth']) && $_SESSION['Sneedboth']) print("canvas.addEventListener('click', controllaBoth, false);");
		else print("canvas.addEventListener('click', controlla, false);");
		?>
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
		var rect = canvas.getBoundingClientRect();
		var ctx = canvas.getContext("2d");
		var box = document.getElementById("result");
		box.innerHTML="Checking..."+box.innerHTML;

		//rimuoviamo i listener
		document.removeEventListener('mousemove', recordMouse ,false);
		clearInterval(tickmouse);

		//annulla il controllo alla chiusura della pagina
		window.onbeforeunload = null;

		//chiama il checker
		var fileName = "checker.php?tx="+virtualMouseX+"&ty="+virtualMouseY+"&l="+log+"&poscanv="+Math.round(rect.left)+"."+Math.round(rect.top);
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
		}
		else
		{
			box.innerHTML=box.innerHTML.replace("Checking...","<span id=\"failure\"> Failure!</span> Are you a robot?");
		}
		rateit.style.display="block";
	}
	function mobilecheckBoth()
	{
		if(checkPerformed) return;
		if(nControlli>0) checkPerformed=true;
		var canvas = document.getElementById("captcha");
		var rect = canvas.getBoundingClientRect();
		var ctx = canvas.getContext("2d");
		var box = document.getElementById("result");
		box.innerHTML="Checking..."+box.innerHTML;

		if(nControlli>0)
		{
			//rimuoviamo i listener
			document.removeEventListener('mousemove', recordMouse ,false);
			clearInterval(tickmouse);

			//annulla il controllo alla chiusura della pagina
			window.onbeforeunload = null;
		}

		//chiama il checker
		var fileName = "checker.php?tx="+virtualMouseX+"&ty="+virtualMouseY+"&l="+log+"&poscanv="+Math.round(rect.left)+"."+Math.round(rect.top);
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
			if(nControlli==0) box.innerHTML="<span id='success'>Success! <span style='color: #FF2222;'>Now find the next shape</span>.</span>";
			else box.innerHTML="<span id='success'>Success!</span>";
			nControlli++;
		}
		else
		{
			box.innerHTML="<span id=\"failure\"> Failure!</span> Are you a robot?";
			nControlli=10;
		}
		if(nControlli==10)
		{
			//rimuoviamo i listener
			document.removeEventListener('mousemove', recordMouse ,false);
			clearInterval(tickmouse);

			//annulla il controllo alla chiusura della pagina
			window.onbeforeunload = null;
		}
		//mostra il box in cui fare il rating
		if(nControlli>1) rateit.style.display="block";
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
	document.removeEventListener('mousemove', recordMouse ,false);
	canvas.removeEventListener('mousemove', anima ,false);
	canvas.removeEventListener('click', controlla ,false);
	clearInterval(tickmouse);
	
	//annulla il controllo alla chiusura della pagina
	window.onbeforeunload = null;

	//chiama il checker
	var fileName = "checker.php?tx="+mousex+"&ty="+mousey+"&l="+log+"&poscanv="+Math.round(rect.left)+"."+Math.round(rect.top);
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
		box.innerHTML=box.innerHTML.replace("Checking...","<span id=\"success\">Success!</span>");
	}
	else
	{
		box.innerHTML=box.innerHTML.replace("Checking...","<span id=\"failure\"> Failure!</span>");
	}
	//mostra il box in cui fare il rating
	rateit.style.display="block";

}
function controllaBoth(evt) {
	var canvas = document.getElementById("captcha");
	var rect = canvas.getBoundingClientRect();
	var ctx = canvas.getContext("2d");
	var mousePos = getMousePos(canvas, evt);
	var mousex=Math.round(mousePos.x);
	var mousey=Math.round(mousePos.y);
	var box = document.getElementById("result");
	var rateit = document.getElementById("rateit");
	box.innerHTML="Checking..."+box.innerHTML;

	if(nControlli>0)
	{
		//rimuoviamo i listener
		document.removeEventListener('mousemove', recordMouse ,false);
		canvas.removeEventListener('mousemove', anima ,false);
		canvas.removeEventListener('click', controllaBoth ,false);
		clearInterval(tickmouse);
		
		//annulla il controllo alla chiusura della pagina
		window.onbeforeunload = null;
	}

	//chiama il checker
	var fileName = "checker.php?tx="+mousex+"&ty="+mousey+"&l="+log+"&poscanv="+Math.round(rect.left)+"."+Math.round(rect.top);
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
		if(nControlli==0) box.innerHTML="<span id='success'>Success! <span style='color: #FF2222;'>Now find the next shape</span>.</span>";
		else box.innerHTML="<span id='success'>Success!</span>";
		nControlli++;
	}
	else
	{
		box.innerHTML="<span id='failure'> Failure!</span>";
		nControlli=10;
	}
	if(nControlli==10)
	{
		//rimuoviamo i listener
		document.removeEventListener('mousemove', recordMouse ,false);
		canvas.removeEventListener('mousemove', anima ,false);
		canvas.removeEventListener('click', controllaBoth ,false);
		clearInterval(tickmouse);
		
		//annulla il controllo alla chiusura della pagina
		window.onbeforeunload = null;
	}
	//mostra il box in cui fare il rating
	if(nControlli>1) rateit.style.display="block";

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
var canvas = document.getElementById("captcha");
var ctx = canvas.getContext("2d");
ctx.fillStyle = "#FFFFFF";

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

	var i=0;
	while(i<lines.length)
	{
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

	disegna(150,150);
</script>
	</div>
</div>
	</body>
</html>
