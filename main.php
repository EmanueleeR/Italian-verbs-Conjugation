<?php
include_once 'CLASSI PHP\MakerVerbo.php';
include_once 'CLASSI PHP\Verbo.php';
include_once 'CLASSI PHP\VerboAvere.php';
include_once 'CLASSI PHP\VerboEssere.php';
include_once 'CLASSI PHP\VerboRegolare.php';
include_once 'CLASSI PHP\VerboIrregolare.php';

$p = "regolare";
//$infinito = "cagare";
$infinito = $_GET["verbo"];

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