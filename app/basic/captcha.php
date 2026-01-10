<?php
session_start();
    $host = "localhost";
    $user = "captcha";
    $pass = "captcha123";
    $db = "prototipo";

    $conn = new mysqli($host,$user,$pass,$db) or die("unable to connect");
    if(!$conn) {

        echo "connessione fallita";
    }
    else {

        //echo "connessione al database effettuata";
    }

    $queryy = "select count(id) as total from loghi";
    $ris = mysqli_query($conn,$queryy);
    $r = mysqli_fetch_array($ris);

    $num = rand(1,$r["total"]);


    $query ="select * from loghi where id =$num ";

    if(mysqli_query($conn,$query))
    {
                
        //echo "query giusta";
                    
       
    }

    $risultato = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($risultato);

    $_SESSION["nome"] = $row["nome"];   
?>

<html>
<head>
<link rel = "stylesheet" href = "stile.css">
</head>
<form name="form" method="post" action="controllo.php">
<label><strong>Enter Captcha:</strong></label><br />
<input type="text" name="captcha" />
<p><br />
<div>
<img src=<?php echo $row['immagine'] ?> name = "logo"/>
</div>
</p>
<p>Can't read the image?
<a href='javascript: refreshCaptcha();'>click here</a>
to refresh</p>
<input type="submit" name="submit" value="Submit">
</form>
</html>

<script>

function refreshCaptcha(){
    location.reload(true);
}
</script>
</html>