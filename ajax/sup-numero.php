<?php
require "../connect.php";
error_reporting(E_ERROR | E_WARNING | E_PARSE);


$num_fiche = $_POST['num_fiche'];

$sql = "DELETE FROM `numero_liste` WHERE `numero_liste`.`num_fiche` = $num_fiche";

if (!$stmt = $conn->query($sql)) {
	$returnPhp = "Erreur: Delete Statement invalid.";
}else{
	$returnPhp = "Votre archive a été supprimé.";
}

// Write the contents back to the file
//file_put_contents($file, $log."\n");

echo $returnPhp;
?>
