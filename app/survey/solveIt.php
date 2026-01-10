<?php
session_start();
include '../../lib/dati.php';
//mancano le variabili di session
if(!isset($_REQUEST['nickname']) && !isset($_SESSION['Snickname']))
{//ritorna alla home, e basta.
	/* Redirect to a different page in the current directory that was requested */
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'indexIt.php';
	header("Location: http://$host$uri/$extra");
	exit;
}
//è il primo livello, metto tutte le variabile inviate nella session e nel db
if(isset($_REQUEST['nickname']) && !isset($_SESSION['Snickname']))
{
	//controllo validità
	$mail=mysqli_real_escape_string($conn, $_REQUEST['email']);
	$query = "SELECT * FROM captchasurvey WHERE email='".$mail."'";
	$result = mysqli_query($conn, $query);
	if(mysqli_num_rows($result)>0) die("Spacente, ma ".$mail." ha gia' preso parte al sondaggio.");
	if($_SESSION['secretcode']!='6134') die("Codice erratp.<br/>Sei autorizzato?");

	$_SESSION['Snickname']=mysqli_real_escape_string($conn, $_REQUEST['nickname']);
	$_SESSION['Semail']=mysqli_real_escape_string($conn, $_REQUEST['email']);
	$_SESSION['Sage']=mysqli_real_escape_string($conn, $_REQUEST['age']);
	$_SESSION['Seducation']=mysqli_real_escape_string($conn, $_REQUEST['education']);
	$_SESSION['Snationality']=mysqli_real_escape_string($conn, $_REQUEST['nationality']);
	$_SESSION['Sageinternet']=mysqli_real_escape_string($conn, $_REQUEST['ageinternet']);
	$_SESSION['Sfrequencyinternet']=mysqli_real_escape_string($conn, $_REQUEST['frequencyinternet']);
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
	$query = "INSERT into captchasurvey (nickname, email, ip, age, education, nationality, ageinternet, frequencyinternet, confirm) VALUES
	(\"".$_SESSION['Snickname']."\",\"".$_SESSION['Semail']."\", \"".$ip."\", '".$_SESSION['Sage']."', \"".$_SESSION['Seducation']."\", \"".$_SESSION['Snationality']."\", '".$_SESSION['Sageinternet']."', \"".$_SESSION['Sfrequencyinternet']."\", \"".$confirm."\");";
	//print($query);
	$result = mysqli_query($conn, $query);
	if(!$result) die("Connection to the database failed\n");

	//inizializzo altre variabili
	$_SESSION['Sidcurrentsurvey']=mysqli_insert_id($conn);
	$_SESSION['Slivello']=1;
}
//ricevo i dati di rating
if(isset($_SESSION['Sidlastchallenge']) && isset($_REQUEST['ratehuman']) && isset($_REQUEST['ratepc']))
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

	//incremento il livello
	$_SESSION['Slivello']=$_SESSION['Slivello']+1;
}
//genero il livello corrente
if(isset($_SESSION['Slivello']))
{
	if($_SESSION['Slivello']==1)
	{
		$_SESSION['SnoiseLevel']=0;
		$_SESSION['SoverlapNoise']=false;
		$_SESSION['SseparateMovement']=true;
		$_SESSION['SdisableBig']=false;
		$_SESSION['Ssensibility']=5;
	}
	else if($_SESSION['Slivello']==2)
	{
		$_SESSION['SnoiseLevel']=20;
		$_SESSION['SoverlapNoise']=false;
		$_SESSION['SseparateMovement']=false;
		$_SESSION['SdisableBig']=true;
		$_SESSION['Ssensibility']=7;
	}
	else if($_SESSION['Slivello']==3)
	{
		$_SESSION['SnoiseLevel']=120;
		$_SESSION['SoverlapNoise']=true;
		$_SESSION['Ssensibility']=10;
	}
	else if($_SESSION['Slivello']==4)
	{
		$_SESSION['SnoiseLevel']=70;
		$_SESSION['Ssensibility']=7;
	}
	else if($_SESSION['Slivello']==5)
	{
		$_SESSION['SnoiseLevel']=0;
		$_SESSION['SoverlapNoise']=false;
		$_SESSION['SseparateMovement']=true;
		$_SESSION['SnumberOfSolutions']=3;
	}
	else if($_SESSION['Slivello']==6)
	{
		$_SESSION['SnoiseLevel']=10;
		$_SESSION['SseparateMovement']=false;
		$_SESSION['SnumberOfSolutions']=2;
		$_SESSION['Sneedboth']=true;
	}
	else if($_SESSION['Slivello']==7)
	{
		$_SESSION['SnoiseLevel']=250;
		$_SESSION['SoverlapNoise']=true;
		$_SESSION['SnumberOfSolutions']=1;
		$_SESSION['Sneedboth']=false;
	}
	else if($_SESSION['Slivello']==8)
	{
		$_SESSION['SnoiseLevel']=180;
		$_SESSION['SdisableBig']=false;
	}
	else //finito.
	{
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'landingIt.php';
		header("Location: http://$host$uri/$extra");
		exit;
	}
	//inizializzo il timer
	$_SESSION['Sstarttime']=time();
}






/*/rating dell'ultima challenge fatta
if(isset($_SESSION['Sidlastchallenge']) && isset($_REQUEST['rating']))
{
	include '../../lib/dati.php';
	$query = "UPDATE captchasession
	SET `rating`=".$_REQUEST['rating']."
	WHERE `id`='".$_SESSION['Sidlastchallenge']."'";
	$result = mysqli_query($conn, $query);
	if(!$result) die("Failed:\n");
}
if(!isset($_SESSION['Snickname']))
{
	$_SESSION['Snickname']=mysqli_real_escape_string($conn, $_REQUEST['nickname']);
	if(strlen($_SESSION['Snickname'])<2) $_SESSION['Snickname']="Anonymous";
	if(strpos($_SESSION['Snickname'], "fuck")!==false) $_SESSION['Snickname']="Anonymous";
	if(strpos($_SESSION['Snickname'], "shit")!==false) $_SESSION['Snickname']="Anonymous";
	if(strpos($_SESSION['Snickname'], "merda")!==false) $_SESSION['Snickname']="Anonymous";
}
if(!isset($_SESSION['Slevel'])) $_SESSION['Slevel']=1;
if(!isset($_SESSION['SnoiseLevel'])) $_SESSION['SnoiseLevel']=0;
if(!isset($_SESSION['Ssincetime'])) $_SESSION['Ssincetime']=time();
if(!isset($_SESSION['Slosttime'])) $_SESSION['Slosttime']=0;
if(!isset($_SESSION['Slastanswertime'])) $_SESSION['Slastanswertime']=time();
$_SESSION['Sstarttime']=time();
$_SESSION['Slosttime']=$_SESSION['Slosttime']+($_SESSION['Sstarttime']-$_SESSION['Slastanswertime']);
*/
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<title>Test <?php print $_SESSION['Slivello']." - ".$_SESSION['Snickname']; ?> - Sondaggio StarCAPTCHA</title>
	</head>
	<body>
	<div>
		<h1>Sondaggio StarCAPTCHA</h1>
		<div id="progress">
			<p>Sei al Test <span><?php print $_SESSION['Slivello']; ?>/8</span>.</p>
			<?php
				if($_SESSION['Slivello']==2) print "<br/><p>Da questo livello in poi, verranno aggiunti puntini di disturbo che <span style='color: #FF2222;'>non faranno parte dell'immagine finale</span>.</p>";
				if($_SESSION['Slivello']==6) print "<br/><p>In questo test dovrai trovare <span style='color: #FF2222;'>due figure in sequenza.</span></p>";
			?>
		</div>
		<script>
		//conferma prima di uscire
		window.onbeforeunload = function() {
    		return 'Vuoi davvero lasciare la pagina? I progressi non verranno salvati';
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
			<h2>Clicca quando vedi la figura!</h2>
		<!--code for make the captcha working-->
<canvas id="captcha" width="300" height="300" style="">
	TODO flash version
</canvas>
<div id="result">
</div>
	<div id="rateit">
		<form name="rate" id="rate" action="solveIt.php" class="nostyle" method="POST">
			<input name="ratehuman" id="ratehuman" type="hidden" value="0"/>
			<input name="ratepc" id="ratepc" type="hidden" value="0"/>
		<div class="starRate">
			<div class="nostyle"><span>Come l'hai trovato?</span><b></b></div>
				<ul>
					<li><a id="human5" href="javascript:setHuman(5)"><span>Impossibile</span></a></li>
					<li><a id="human4" href="javascript:setHuman(4)"><span>Difficile</span></a></li>
					<li><a id="human3" href="javascript:setHuman(3)"><span>Impegnativo</span></a></li>
					<li><a id="human2" href="javascript:setHuman(2)"><span>Medio</span></a></li>
					<li><a id="human1" href="javascript:setHuman(1)"><span>Facile</span></a></li>
				</ul>
			</div>
		<div class="starRate">
			<div class="nostyle"><span>Come pensi che sia per un computer?</span><b></b></div>
				<ul>
					<li><a id="pc5" href="javascript:setPc(5)"><span>Impossibile</span></a></li>
					<li><a id="pc4" href="javascript:setPc(4)"><span>Difficile</span></a></li>
					<li><a id="pc3" href="javascript:setPc(3)"><span>Impegnativo</span></a></li>
					<li><a id="pc2" href="javascript:setPc(2)"><span>Medio</span></a></li>
					<li><a id="pc1" href="javascript:setPc(1)"><span>Facile</span></a></li>
				</ul>
		</div>
		<input disabled type="submit" name="continue" id="continue" value="Continua" style="margin-top: 20px;"/>
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

//variabili globali di struttura
var vertex = [];
var bigVertex = [];
var nvertex=0;
var lines;

var pointSize=4;
var bigPointSize=14;
var oldX=0;
var oldY=0;
var nControlli=0;
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
	box.innerHTML="Controllo..."+box.innerHTML;

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
		box.innerHTML=box.innerHTML.replace("Controllo...","<span id=\"success\">Successo!</span>");
	}
	else
	{
		box.innerHTML=box.innerHTML.replace("Controllo...","<span id=\"failure\"> Fallimento!</span>");
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
	box.innerHTML="Controllo..."+box.innerHTML;

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
		if(nControlli==0) box.innerHTML="<span id='success'>Successo! Ora trova l'altra figura.</span>";
		else box.innerHTML="<span id='success'>Successo!</span>";
		nControlli++;
	}
	else
	{
		box.innerHTML="<span id='failure'> Fallimento!</span>";
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
	var canvas = document.getElementById("captcha");
	var ctx = canvas.getContext("2d");
	var mousePos = getMousePos(canvas, evt);
	var mousex=mousePos.x;
	var mousey=mousePos.y;
		//puliamo il canvas
	// Store the current transformation matrix
	ctx.save();
	// Use the identity matrix while clearing the canvas
	ctx.setTransform(1, 0, 0, 1, 0, 0);
	ctx.clearRect(0, 0, canvas.width, canvas.height);
	// Restore the transform
	ctx.restore();

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
function disegna(mousex,mousey) {
		//puliamo il canvas
	// Store the current transformation matrix
	ctx.save();
	// Use the identity matrix while clearing the canvas
	ctx.setTransform(1, 0, 0, 1, 0, 0);
	ctx.clearRect(0, 0, canvas.width, canvas.height);
	// Restore the transform
	ctx.restore();

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

	//aggiungiamo il listener del mouse
	canvas.addEventListener('mousemove', anima ,false);
	//ora il listener del click
	<?php
	if(isset($_SESSION['Sneedboth']) && $_SESSION['Sneedboth']) print("canvas.addEventListener('click', controllaBoth, false);");
	else print("canvas.addEventListener('click', controlla, false);");
	?>

	disegna(150,150);
</script>
	</div>
</div>
	</body>
</html>
