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
    $logo = $_SESSION["nome"];
    $query ="select immagine from loghi where nome = '$logo'";
    $risultato = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($risultato);


$status = '';


if ( isset($_POST['captcha']) && ($_POST['captcha']!="") ){
// Validation: Checking entered captcha code with the generated captcha code
        if(strcasecmp($_SESSION["nome"], $_POST['captcha']) != 0){
        // Se le stringhe sono diverse
            
            $status = "<p style='color:#FFFFFF; font-size:20px'>
            <span style='background-color:#FF0000;'>Il codice inserito è sbagliato, si prega di riprovare.</span></p>";
            echo "<a href = 'captcha.php'>$status</a>";}
        else{
        $pic = $row["immagine"];
        $status = "<p style='color:#FFFFFF; font-size:20px'>
        <span style='background-color:#46ab4a;'>La tua soluzione è corretta.</span>
        </p>";
        echo "<a href = 'welcome.php'>$status</a>";
        echo "<img src = '$pic' width ='400' height = '300'/>";}
         
    

}
?>