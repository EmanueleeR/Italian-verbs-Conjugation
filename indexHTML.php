<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coniugazione Verbi Italiani</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
      color: #333;
      padding: 20px;
    }




    *{
    /*CSS RESET*/
    /*CONFIGURAZIONE DI DEFAULT
    Per azzerare lo stile di default dei <tag> dato dai broswer
    ES: <p> <h1> <div> ecc. hanno del margin e padding di default diverso da 0*/
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    }

    .box{
        box-sizing: border-box;
        /*width: 1245px; meglio settare con percentuali al larghezza*/
        width: 100%; /*largo come tutta la pagina*/
        height: 100%;
        border: solid rgb(0, 139, 116);
    }

    .box-inner-title{
        box-sizing: border-box; 
        background-color: rgb(0, 139, 116);
        width: 100%;
        height: 15%;
        text-align: center;
        
        /*FLEX PER CENTRARE TITOLO NEL BOX DEL TITOLO STESSO*/
        display: flex;
        flex-direction: row;
        justify-content: space-evenly;
        align-items: center;
    }

    .box-subtitle{
        box-sizing: border-box; 
        background-color: #f0f0f0;;
        width: 100%;
        height: 15%;
        text-align: center;
        
        /*FLEX PER CENTRARE TITOLO NEL BOX DEL TITOLO STESSO*/
        display: flex;
        flex-direction: row;
        justify-content: space-evenly;
        align-items: center;
    }

    .box-user-input {
        /*FLEX PER CENTRARE TITOLO NEL BOX DEL TITOLO STESSO*/
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
        align-items: center;
    }

    .conjugation {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .modo {
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin: 10px 0;
      padding: 10px;
      width: 80%;
    }

    .single-row {
      display: flex;
      justify-content: space-between;
    }

    .tempo-verbale {
      background-color: #f5f5f5;
      border: 1px solid #ddd;
      border-radius: 6px;
      margin: 10px 0;
      padding: 10px;
      width: 48%; /* Utilizza meno della metà per garantire spazio tra le colonne */
    }

    h2, h3 {
      color: #006688;
    }

    .tempo-verbale .single-conjugation {
        display: block;
        margin: 5px 0;
    }


    /* Stile dell'input */
    #verbo-input {
      width: 350px;
      padding: 10px;
      border: 2px solid #f5f5f5;
      border-radius: 10px;
      height: 40px;
      outline: none;
      font-size: 16px;
      transition: border-color 0.3s ease;
    }

    /* Effetto hover sull'input */
    #verbo-input:hover {
      background-color: #f5f5f5;
    }
  </style>
</head>
<body>

<div class="box">
        <div class="box-inner-title">
            <h1 class="title" id="main-title">CONIUGATORE VERBI ITALIANI</h1>
        </div>
        <div class="box-subtitle">
            <span class="title" id="main-title">*La seguente è una beta, mancano i verbi irregolari</span>
        </div>
        <div class="box-user-input">
            <label for="verbo-input">Inserisci verbo:</label>
            <input type="text" id="verbo-input" placeholder="inserisci un verbo">
        </div>
  <div class="conjugation">


<?php
include_once 'CLASSI PHP\MakerVerbo.php';
include_once 'CLASSI PHP\Verbo.php';
include_once 'CLASSI PHP\VerboAvere.php';
include_once 'CLASSI PHP\VerboEssere.php';
include_once 'CLASSI PHP\VerboRegolare.php';
include_once 'CLASSI PHP\VerboIrregolare.php';

$p = "regolare";
$infinito = "comprare";

$verbo = MakerVerbo::createVerbo($infinito);
/*if($p == "regolare")
    $verbo = new VerboRegolare("insignire");
else if($p == "irregolare")
    $verbo = new VerboIrregolare("parlare");
else
    throw new Exception("Verbo non compatibile");
*/

//$verbo = new VerboRegolare("parlare");
//$verbo = new Verbo("parlare");
//echo $verbo->getRadice();
//echo "---" . $verbo->getDesinenza();
//echo "<br><br><br><br><br>";
//$verbo = new VerboAvere();

echo $verbo->coniuga();
?>

    </div>
</div>
</body>
</html>