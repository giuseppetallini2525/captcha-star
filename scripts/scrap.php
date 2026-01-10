<?php
/**
 * Scraping dei loghi e inserimento nel database
 */
require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/../lib/simple_html_dom.php');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("unable to connect");
if(!$conn) {
    echo "connessione fallita";
}
else {
    echo "connessione al database effettuata";
}

$categorie = array("advertising","architecture","arts-and-design","auto-and-moto","beauty-and-cosmetics","business","communication","construction",
"engineering","environment","fashion","food-and-drinks","game","music","sports");

//foreach($categorie as $cat){
    $cat = "food-and-drinks";
    $html = file_get_html("https://seeklogo.com/free-vector-logos/$cat?filter=brand");

    foreach($html->find('img') as $element){
        $path = $element->src;
        $len = strlen($path);

        if(substr($path,$len - 7,$len)== 'com.png'){
            echo '<img src ="https://seeklogo.com/'.$element->src.'">';
            echo '<br>';
            $val1 = get_string_between($path,'images/','-logo-');
            $val = substr($val1,2,strlen($val1)+1);
            echo $val;
            $query ="insert into scrape(nome,categoria,immagine) values('$val','$cat','$path')";
            echo $query;
            $risultato = mysqli_query($conn,$query);
            if($risultato){
                echo "la query è andata";
            }
         }
   
    }
    for($i = 2;$i<3;$i++){
        
        $html1 = file_get_html("https://seeklogo.com/free-vector-logos/$cat?page=$i&filter=brand");

        foreach($html1->find('img') as $element1){
        $path1 = $element1->src;
        $len1 = strlen($path1);
        //echo $path;
        //echo '<br>';
        //echo substr($path,$len - 3,$len);
        //echo '<br>';
            if(substr($path1,$len1 - 7,$len1)== 'com.png'){
                echo '<img src ="https://seeklogo.com/'.$element1->src.'">';
                echo '<br>';
                $val3 = get_string_between($path1,'images/','-logo-');
                $val2 = substr($val3,2,strlen($val3)+1);
                echo $val2;
                $query2 ="insert into scrape(nome,categoria,immagine) values('$val2','$cat','$path1')";
                echo $query2;
                $risultato1 = mysqli_query($conn,$query2);
                if($risultato1){
                    echo "la query è andata";
                }

             }
        
         }
    }   
//}

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
 
?>