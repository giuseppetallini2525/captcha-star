<?php
function strbool($value)
{
    return $value ? 'true' : 'false';
}
session_start();
$doInsert=true;
$check=false;
$dist=0;
$tolerance=4; 
$tolerance=$tolerance*$tolerance*2;
$tolerance=35;
//la sessione è ancora valida
if(isset($_SESSION['Ssolutions']) && isset($_REQUEST['tx']) && isset($_REQUEST['ty']))
{
	$tx=$_REQUEST['tx'];
	$ty=$_REQUEST['ty'];
	$log=$_REQUEST['l'];
	$poscanv=$_REQUEST['poscanv'];
	if(isset($_SESSION['Slogmouse'])) $log=$_SESSION['Slogmouse']." ".$log;
	$_SESSION['Slogmouse']="";
	$solutionline=$_SESSION['Ssolutions'];
	while(strlen($solutionline)>3 && !$check)
	{
		$sx= intval($solutionline);
		$solutionline = substr(strstr($solutionline, ' '), 1);
		$sy=intval($solutionline);
		$solutionline = substr(strstr($solutionline, ' '), 1);
		//controllo la distanza fra t e s
		$dist=($tx-$sx)*($tx-$sx)+($ty-$sy)*($ty-$sy);
		if($dist<$tolerance)
		{
			$check=true;
			//servono entrambe
			if($_SESSION['Sneedboth'])
			{
				//tolgo da Ssolutions quella appena trovata
				$_SESSION['Ssolutions']=str_replace($sx." ".$sy,"-".$sx." -".$sy,$_SESSION['Ssolutions']);
				$_SESSION['Sneedboth']=false;
				$doInsert=false;
			}
		}
	}
	if($check) print("true\ncorrect\n");
	else
	{
		print("false\n".$dist."<".$tolerance."\n");
	}
}
else print("false\nSession not found\n");


if($doInsert)
{
	$endtime=time();
	$timepassed=($endtime-$_SESSION['Sstarttime']);

	include '../../lib/dati.php';
	$query = "INSERT INTO captchasession
	(noiselevel, overlapnoise, nsolutions, separatedmovement, sensibility, nomichallenges, npezzipiccoli, npezzigrandi, inputpresenter, solutions, nickname, time, answer, errore, ispassed, logmouse, poscanvas) VALUES 
	(".$_SESSION['SnoiseLevel'].",".strbool($_SESSION['SoverlapNoise']).",".$_SESSION['SnumberOfSolutions'].",".strbool($_SESSION['SseparateMovement']).",".$_SESSION['Ssensibility'].",\"".$_SESSION['SnomiChallenges']."\", ".$_SESSION['Snpezzipiccoli'].", ".$_SESSION['Snpezzigrandi'].", \"".$_SESSION['Sinputpresenter']."\" ,\"".$_SESSION['Ssolutions']."\",\"".$_SESSION['Snickname']."\",".$timepassed.",\"".$tx." ".$ty."\",".$dist.",".strbool($check).",\"".$log."\",\"".$poscanv."\")";

	$result = mysqli_query($conn, $query);
	if(!$result) die("Failed:\n".$query);
	//salvo l'ultimo id per poter mettere il rating
	$_SESSION['Sidlastchallenge']=mysqli_insert_id($conn);
}
?>
