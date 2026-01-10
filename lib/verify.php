<?php
/**
 * =============================================================================
 * CAPTCHA CORE - RESTRICTIVE LICENSE
 * =============================================================================
 * This file is NOT covered by the MIT License.
 * See LICENSE-CAPTCHA-CORE for terms of use.
 * Unauthorized use, copying, or distribution is prohibited.
 * Contact the repository owner for permission requests.
 * =============================================================================
 */
session_start();
$check=false;
$tolerance=4; 
$tolerance=49;
//la sessione è ancora valida
if(isset($_SESSION['Ssolutions']) && isset($_REQUEST['tx']) && isset($_REQUEST['ty']))
{
	$tx=$_REQUEST['tx'];
	$ty=$_REQUEST['ty'];
	$solutionline=$_SESSION['Ssolutions'];
	$attempts=$_SESSION['Sattempts'];
	while(strlen($solutionline)>3 && !$check && $attempts>0)
	{
		$sx= intval($solutionline);
		$solutionline = substr(strstr($solutionline, ' '), 1);
		$sy=intval($solutionline);
		$solutionline = substr(strstr($solutionline, ' '), 1);
		//controllo la distanza fra t e s
		$dist=($tx-$sx)*($tx-$sx)+($ty-$sy)*($ty-$sy);
		if($dist<$tolerance) $check=true;
	}
	if($check) print("true\n");
	else print("false\n");
}
else print("false\n");

//TODO LOGGA IN SQL QUEL CHE é SUCCESSO
//in nomiChallenges ci sono i nomi
?>