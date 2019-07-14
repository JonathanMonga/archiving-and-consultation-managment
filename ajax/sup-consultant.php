<?php
require "../connect.php";
error_reporting(E_ERROR | E_WARNING | E_PARSE);


$mat_consult = $_POST['mat_consult'];


$sql = "DELETE FROM `consultant` WHERE `consultant`.`mat_consult` = '$mat_consult'";

if (!$stmt = $conn->query($sql)) {
	$returnPhp = "Erreur: Delete Statement invalid.";
}else{
	$returnPhp = "Votre consultant a été supprimé.";
}


// Write the contents back to the file
//file_put_contents($file, $log."\n");

echo $returnPhp;
?>
