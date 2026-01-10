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
 *
 * Getter - Genera il captcha con i punti del logo
 */
session_start();
require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/similarity.php');
//parametri che influenzano la generazione
$noiseLevel=30;				//livello di disturbo, 0=none (in percentuale sul numero di punti)
$overlapNoise=true;			//indica se il disturbo si può overlappare all'immagine da generare
$numberOfSolutions=1;		//il numero di immagini visualizzabili
$separateMovement=false;	//i punti si spostano in base ad un asse alla volta
$sensibility=7;				//bigger -> more movement 
$disableBig=true;		//disabilita i pezzi grossi
$enableRotation=false;		//rotazione casuale disabilitata

//prendiamo i parametri dalla SESSION, se ci sono. Se no li impostiamo noi.
if(isset($_SESSION['SnoiseLevel'])) $noiseLevel=$_SESSION['SnoiseLevel'];
else $_SESSION['SnoiseLevel']=$noiseLevel;
if(isset($_SESSION['SoverlapNoise'])) $overlapNoise=$_SESSION['SoverlapNoise'];
else $_SESSION['SoverlapNoise']=$overlapNoise;
if(isset($_SESSION['SnumberOfSolutions'])) $numberOfSolutions=$_SESSION['SnumberOfSolutions'];
else $_SESSION['SnumberOfSolutions']=$numberOfSolutions;
if(isset($_SESSION['SseparateMovement'])) $separateMovement=$_SESSION['SseparateMovement'];
else $_SESSION['SseparateMovement']=$separateMovement;
if(isset($_SESSION['Ssensibility'])) $sensibility=$_SESSION['Ssensibility'];
else $_SESSION['Ssensibility']=$sensibility;
if(isset($_SESSION['SdisableBig'])) $disableBig=$_SESSION['SdisableBig'];
else $_SESSION['SdisableBig']=$disableBig;
if(isset($_SESSION['SenableRotation'])) $enableRotation=$_SESSION['SenableRotation'];
else $_SESSION['SenableRotation']=$enableRotation;

//vettori che salvano i dot generati
$smallPoints=array();
$bigPoints=array();

//matrice che contiene il pixel count dell'immagine suddivisa in blocchi 5x5
$pixelcount=array(array());

$trasparenti=array();
$sorgente="";
$dimImmagineDaCampionareW=0;
$dimImmagineDaCampionareH=0;
//ritorna true se l'indice del colore passato è trasparente o bianco
function isTrasparent($im,$colindex)
{
	global $trasparenti;
	if(in_array($colindex,$trasparenti)) return true;
	$col=imagecolorsforindex($im, $colindex);
	// print_r($col);
	// return;
	if($col['alpha']==0 && $col['red']>200 && $col['green']>200 && $col['blue']>200)
	{
		array_push($trasparenti, $colindex);
		return true;
	}
	if($col['alpha']<50)
	{
		array_push($trasparenti, $colindex);
		return true;
	}
	return false;
}
//ritorna true se il punto in coordinate x,y può diventare big
function canBeBig($x,$y,$soglia)
{
	global $pixelcount;
	//non è filled
	if($pixelcount[$x][$y]<$soglia) return false;
	//controlliamo se l'intorno è filled
	if($pixelcount[$x-1][$y-1]<$soglia) return false;
	if($pixelcount[$x][$y-1]<$soglia) return false;
	if($pixelcount[$x+1][$y-1]<$soglia) return false;
	if($pixelcount[$x-1][$y]<$soglia) return false;
	if($pixelcount[$x+1][$y]<$soglia) return false;
	if($pixelcount[$x-1][$y+1]<$soglia) return false;
	if($pixelcount[$x][$y+1]<$soglia) return false;
	if($pixelcount[$x+1][$y+1]<$soglia) return false;

	return true;
}
//funzione che prende un immagine a random dalla cartella e ritorna i vettori smallPoints e bigPoints (con tanto di offset)
function campionatePic()
{
	global $smallPoints;
	global $bigPoints;
	global $sorgente;
	global $dimImmagineDaCampionareW;
	global $dimImmagineDaCampionareH;
	global $pixelcount;

	$logosDir = PATH_LOGOS;
	$categorie = LOGO_CATEGORIES;

	$binarizedPic=array(array());

	// Prova a usare similarity se c'è una pagina nel cookie
	$picked = null;
	if(isset($_COOKIE['pagina']) && !empty($_COOKIE['pagina'])) {
		$page_url = $_COOKIE['pagina'];
		$picked = sim(100, 0, $page_url); // 100 dimensioni, cosine similarity
	}

	// Fallback a logo random se similarity fallisce o non c'è pagina
	if($picked === null || empty($picked)) {
		$allLogos = glob($logosDir.'/*/*.png');
		$randomLogo = $allLogos[array_rand($allLogos)];
		$picked = str_replace($logosDir.'/', '', $randomLogo);
		$picked = str_replace('.png', '', $picked);
	}

	$sorgente = $logosDir.'/'.$picked.'.png';
	if(isset($_REQUEST['f'])) $sorgente="$element/".$_REQUEST['f'];
	if(isset($_SESSION['Sf']))
	{
		$sorgente="$element/".$_SESSION['Sf'];
		unset($_SESSION['Sf']);
	}
	$perco =get_string_between($sorgente,'/','.png');
	setcookie('logo',$perco,time()+3600,"/");
	header('Access-Control-Expose-Headers: *');
	//unset($_COOKIE['logo']);
	$im = imagecreatefrompng($sorgente);
	imagealphablending($im, true);
	imagesavealpha($im, true);
	//imagefilter($im, IMG_FILTER_GRAYSCALE); //first, convert to grayscale
	//imagefilter($im, IMG_FILTER_CONTRAST, -255);

	//ruotiamo a random
	global $enableRotation;
	if($enableRotation)
	{
		imagealphablending($im, false);
	    imagesavealpha($im, true);

	    $imrotated = imagerotate($im, rand(5,355), imageColorAllocateAlpha($im, 0, 0, 0, 127));
	    imagealphablending($imrotated, false);
	    imagesavealpha($imrotated, true);

	    $im=$imrotated;
	}

	$w = imagesx($im); // image width
	$h = imagesy($im); // image height

	//dimensioni
	$dimTile=5;
	$nTileW=rand(25,50);
	$nTileH=round($nTileW*($h/$w));
	if($nTileH>60)
	{
		$nTileH=rand(25,50);
		$nTileW=round($nTileH*($w/$h));
	}
	$dimImmagineDaCampionareW=$dimTile*$nTileW;
	$dimImmagineDaCampionareH=$dimTile*$nTileH;


	//resiziamo a dimensione fissa
	$neww=$dimImmagineDaCampionareW;
	$newh=$dimImmagineDaCampionareH;


	$newImg = imagecreatetruecolor($neww, $newh);
	imagealphablending($newImg, false);
	imagesavealpha($newImg,true);
	$transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
	imagefilledrectangle($newImg, 0, 0, $neww, $newh, $transparent);
	imagecopyresampled($newImg, $im, 0, 0, 0, 0, $neww, $newh, $w, $h);
	$im=$newImg;
	$w=$neww;
	$h=$newh;

	//creiamo una matrice booleana con indicati i pixel trasparenti
	$nTrasparenti=0;
	for ($x = 0; $x < $w; $x++)
	{
		$binarizedPic[$x]=array();
		for ($y = 0; $y < $h; $y++)
		{
			$tmp=imagecolorat($im, $x, $y);
			$binarizedPic[$x][$y]=isTrasparent($im,$tmp);
			if($binarizedPic[$x][$y]) $nTrasparenti++;
		}
	}
	//se sono tutti trasparenti, il file usa uno strano standard. Cancelliamolo.
	if($nTrasparenti >= $w*$h)
	{
		unlink($sorgente);
		die("The good thing about standards is that there are so many to choose from. <br/>".$sorgente);
	}
	//se sono troppo pochi trasparenti, invertiamo i colori
	if($nTrasparenti < floor($w*$h)/2)
		for ($x = 0; $x < $w; $x++)
			for ($y = 0; $y < $h; $y++)
				$binarizedPic[$x][$y]=!$binarizedPic[$x][$y];

	//inizializziamo la matrice di pixelcount
	for($i=0;$i<$nTileH;$i++)
	{
		$pixelcount[$i]=array();
		for($k=0;$k<$nTileW;$k++) $pixelcount[$i][$k]=0;
	}
	
	//contiamo il pixel count
	for ($x = 0; $x < $w; $x++)
		for ($y = 0; $y < $h; $y++)
			if(!$binarizedPic[$x][$y]){
				$pixelcount[floor($x/$dimTile)][floor($y/$dimTile)]++;
				/*echo floor($x/$dimTile);
				echo floor($y/$dimTile);
				echo '\n';*/
				;}

	$quanti=0;
	//raggruppiamo ogni gruppo 3x3 di dot in un big dot largo 3x
	global $disableBig;
	for($i=1;$i<$nTileW-1;$i++)
		for($k=1;$k<$nTileH-1;$k++)
			if(!$disableBig && canBeBig($i,$k,$dimTile*$dimTile))
			{
				$posx=$i*$dimTile+ceil($dimTile/2);
				$posy=$k*$dimTile+ceil($dimTile/2);
				//imagefilledellipse($image, $posx, $posy, $dimTile*3+1, $dimTile*3+1, $foreground_color);
				array_push($bigPoints, $posx." ".$posy);
				//azzero l'intorno per non ricontare gli stessi punti
				$pixelcount[$i-1][$k-1]	= 0;
				$pixelcount[$i][$k-1]	= 0;
				$pixelcount[$i+1][$k-1]	= 0;
				$pixelcount[$i-1][$k]	= 0;
				$pixelcount[$i][$k]		= 0;
				$pixelcount[$i+1][$k]	= 0;
				$pixelcount[$i-1][$k+1]	= 0;
				$pixelcount[$i][$k+1]	= 0;
				$pixelcount[$i+1][$k+1]	= 0;

			}
	//campionamento
	for($i=0;$i<$nTileW;$i++)
		for($k=0;$k<$nTileH;$k++)
		{
			if($pixelcount[$i][$k]==$dimTile*$dimTile)
			{
				$posx=$i*$dimTile+ceil($dimTile/2);
				$posy=$k*$dimTile+ceil($dimTile/2);
				//imagefilledellipse($image, $posx, $posy, $dimTile, $dimTile, $foreground_color);
				array_push($smallPoints, $posx." ".$posy);
				$quanti++;
			}
			//fare in modo di piazzare puntini anche a coordinate non "prefissate" e aumentare sia usabilità che variabilità
			else if($pixelcount[$i][$k]>$dimTile*$dimTile/3)
			{
				$posx=$i*$dimTile+ceil($dimTile/2);
				$posy=$k*$dimTile+ceil($dimTile/2);

				//a seconda di dove sono i pixel trasparenti, sposto le coordinate
				$riga=array();	//numero di pixel trasparenti per riga [j]
				$colonna=array();	//numero di pixel trasparenti per colonna [j]
				for($j=0;$j<$dimTile;$j++)
				{
					$riga[$j]=0;
					$colonna[$j]=0;
				}
				for ($x = $i*$dimTile; $x < ($i+1)*$dimTile; $x++)
					for ($y = $k*$dimTile; $y < ($k+1)*$dimTile; $y++)
						if($binarizedPic[$x][$y])
						{
							$colonna[$y-$k*$dimTile]++;
							$riga[$x-$i*$dimTile]++;
						}
				$soglia=$dimTile/3;	//soglia sotto la quale una riga/colonna è dichiarata vuota
				if($riga[1]<=$soglia) $posx-=2;
				else if($riga[0]<=$soglia) $posx-=1;
				if($riga[$dimTile-2]<=$soglia) $posx+=2;
				else if($riga[$dimTile-1]<=$soglia) $posx+=1;

				if($colonna[1]<=$soglia) $posy-=2;
				else if($colonna[0]<=$soglia) $posy-=1;
				if($colonna[$dimTile-2]<=$soglia) $posy+=2;
				else if($colonna[$dimTile-1]<=$soglia) $posy+=1;
				

				//imagefilledellipse($image, $posx, $posy, $dimTile, $dimTile, $foreground_color);
				array_push($smallPoints, $posx." ".$posy);
				$quanti++;	
			}
		}


}
$nomiChallenges="";
$solutions="";
$inputpresenter="";
for($immaginiGenerate=0;$immaginiGenerate<$numberOfSolutions;$immaginiGenerate++)
{
	$smallPoints=array();
	$bigPoints=array();
	campionatePic();
	$nLegitSmall=count($smallPoints);
	$nNoiseSmall=round($nLegitSmall*($noiseLevel/100));
	$nLegitBig=count($bigPoints);
	$nNoiseBig=round($nLegitBig*($noiseLevel/100));
	$_SESSION['Snpezzipiccoli']=count($smallPoints);
	$_SESSION['Snpezzigrandi']=count($bigPoints);
	//outputtiamo i coefficienti	RIGA = moltiplicatoreXX moltiplicatoreXY costanteX moltiplicatoreYX moltiplicatoreYY costanteY
	$offsetx=rand(0,300-$dimImmagineDaCampionareW);
	$offsety=rand(0,300-$dimImmagineDaCampionareH);
	if(isset($_SESSION['Ssolx'])) $solx=$_SESSION['Ssolx'];
	else $solx=rand(10,290);
	if(isset($_SESSION['Ssoly'])) $soly=$_SESSION['Ssoly'];
	else $soly=rand(10,290);
	$nomiChallenges=$nomiChallenges.strstr($sorgente, '/')." ";
	$solutions="".$solx." ".$soly." ".$solutions;
	//print "# .".strstr($sorgente, '/')." ".$solx." ".$soly."\n";
	print "# /Are you a cheater?\n";
	print "# F ".$sorgente."\n";
	print "# small points\n";
	$inputpresenter=$inputpresenter."# small points ".($nLegitSmall+$nNoiseSmall)."\n";
	while($nLegitSmall+$nNoiseSmall>0)
	{
		$line=$smallPoints[$nLegitSmall-1];
		$x= intval($line);
		$line = substr(strstr($line, ' '), 1);
		$y=intval($line);
		$mxx=rand(-10000*$sensibility,10000*$sensibility);
		$mxy=rand(-10000*$sensibility,10000*$sensibility);
		$myx=rand(-10000*$sensibility,10000*$sensibility);
		$myy=rand(-10000*$sensibility,10000*$sensibility);
		if($separateMovement)
		{
			$mxy=0;
			$myx=0;
		}
		$caso=rand(1,$nLegitSmall+$nNoiseSmall);
		//punto che fa parte della soluzione
		if($caso<=$nLegitSmall)
		{
			$cx=round($x-$soly*($mxy/100000)-$solx*($mxx/100000))+$offsetx;
			$cy=round($y-$soly*($myy/100000)-$solx*($myx/100000))+$offsety;
			$nLegitSmall--;
		}
		//punto di noise
		else
		{
			if($overlapNoise)
			{
				$x=rand(0,300);
				$y=rand(0,300);
			}
			//i punti di noise NON devono overlappare la soluzione
			else do{
					$x=rand(0,300);
					$y=rand(0,300);
				} while($x>$offsetx && $x<$offsetx+$dimImmagineDaCampionareW && $y>$offsety && $y<$offsety+$dimImmagineDaCampionareH);
			$cx=round($x-rand(0,300)*($mxy/100000)-rand(0,300)*($mxx/100000));
			$cy=round($y-rand(0,300)*($myy/100000)-rand(0,300)*($myx/100000));
			$nNoiseSmall--;
		}
		print $mxx." ".$mxy." ".$cx." ".$myx." ".$myy." ".$cy."\n";
		$inputpresenter=$inputpresenter.$mxx." ".$mxy." ".$cx." ".$myx." ".$myy." ".$cy."\n";
	}

	print "# big points\n";
	$inputpresenter=$inputpresenter."# big points ".($nLegitBig+$nNoiseBig)."\n";
	while($nLegitBig+$nNoiseBig>0)
	{
		$line=$bigPoints[$nLegitBig-1];
		$x= intval($line);
		$line = substr(strstr($line, ' '), 1);
		$y=intval($line);
		$mxx=rand(-10000*$sensibility,10000*$sensibility);
		$mxy=rand(-10000*$sensibility,10000*$sensibility);
		$myx=rand(-10000*$sensibility,10000*$sensibility);
		$myy=rand(-10000*$sensibility,10000*$sensibility);
		if($separateMovement)
		{
			$mxy=0;
			$myx=0;
		}
		$caso=rand(1,$nLegitBig+$nNoiseBig);
		//punto che fa parte della soluzione
		if($caso<=$nLegitBig)
		{
			$cx=round($x-$soly*($mxy/100000)-$solx*($mxx/100000))+$offsetx;
			$cy=round($y-$soly*($myy/100000)-$solx*($myx/100000))+$offsety;
			$nLegitBig--;
		}
		//punto di noise
		else
		{
			if($overlapNoise)
			{
				$x=rand(0,300);
				$y=rand(0,300);
			}
			//i punti di noise NON devono overlappare la soluzione
			else do{
					$x=rand(0,300);
					$y=rand(0,300);
				} while($x>$offsetx && $x<$offsetx+$dimImmagineDaCampionareW && $y>$offsety && $y<$offsety+$dimImmagineDaCampionareH);
			$cx=round($x-rand(0,300)*($mxy/100000)-rand(0,300)*($mxx/100000));
			$cy=round($y-rand(0,300)*($myy/100000)-rand(0,300)*($myx/100000));
			$nNoiseBig--;
		}
		print $mxx." ".$mxy." ".$cx." ".$myx." ".$myy." ".$cy."\n";
		$inputpresenter=$inputpresenter.$mxx." ".$mxy." ".$cx." ".$myx." ".$myy." ".$cy."\n";
	}
}
function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
$_SESSION['SnomiChallenges']=$nomiChallenges;
$_SESSION['Ssolutions']=$solutions;
$_SESSION['Sinputpresenter']=$inputpresenter;
$_SESSION['Sstarttime']=time();	//così il tempo parte da dopo il loading

$_SESSION['Sattempts']=3;
?>