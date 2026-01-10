

<html>

<form name="form" method="post"  target = "myframe" action="../newsurvey/index.php"
<head>
    <body>
        <form action = "" method = "post" name = "registr">
            cognome:
        <input type="text" name="cognome" size="40" maxlength="40" color= "red" required>
        <br>
            nome:
        <input type="text" name="nome" size="30" maxlength="30" required>
        <br>
            matricola:
        <input type="number" name="matricola" size="7" maxlength="7" min="0" max="1234567">
        <br>
            regione:
        <select name="regione" required>
            <option></option>
            <option value="valdaosta">Val d’Aosta</option>
            <option value="piemonte">Piemonte</option>
            <option value="liguria">Liguria</option>
            <option value="lombardia">Lombardia</option>
            <option value="veneto">Veneto</option>
            <option value="trentino">Trentino Alto Adige</option>
            <option value="friuli">Friuli Venezia-Giulia</option>
            <option value="emilia">Emilia-Romagna</option>
            <option value="toscana">Toscana</option>
            <option value="marche">Marche</option>
            <option value="umbria">Umbria</option>
            <option value="lazio">Lazio</option>
            <option value="abruzzo">Abruzzo</option>
            <option value="molise">Molise</option>
            <option value="campania">Campania</option>
            <option value="basilicata">Basilicata</option>
            <option value="puglia">Puglia</option>
            <option value="calabria">Calabria</option>
            <option value="sicilia">Sicilia</option>
            <option value="sardegna">Sardegna</option>
        </select>
        <br>
        email:
        <input type="email" name="indemail" size="30" maxlength="30">
        <br>
        telefono:
        <input type="number" name="telef" size="16" maxlength="16">
        <br>
        status:
        <input type="text" name="stat" size="30" maxlength="30" list="listastatus">
        <datalist id="listastatus">
        <option value="in corso">
            <option value="fuori corso">
            <option value="ripetente">
            <option value="part-time">
           </datalist>
        <br>
        richieste particolari:
        <br>
  <textarea name="richieste" cols="60" rows="12"></textarea>
  <br>
  <input type="submit" value="Invia">
  <input type="reset" value="Reset">
  </form>
 </body>



