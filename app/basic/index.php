<html>
<body>
<iframe name = "myframe" src = "form.php" width = "70%" height = "370" style= "border: 3px black solid;border-radius: 10px" >
</iframe>
</body>
</html>


<?php
$pagine = array("https://en.wikipedia.org/wiki/Nike,_Inc.","https://www.english-online.at/sports/soccer/european-football.htm","https://www.english-online.at/environment/global-warming/causes-and-effects-of-global-warming.htm","https://en.wikipedia.org/wiki/Coca-Cola","https://www.motor1.com/car-lists/most-expensive-new-cars-ever/","https://online.maryville.edu/blog/evolution-social-media/");
$path = $pagine[random_int(0,count($pagine)-1)];
$page = file_get_contents($path);
//echo '<a href ="form.php?path='.$path.'"> SIGN IN</a>';
setcookie('pagina',$path,time()+3600,'/');

echo $page;


?>
