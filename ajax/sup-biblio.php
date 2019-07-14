<?php
require "../connect.php";
error_reporting(E_ERROR | E_WARNING | E_PARSE);


$mat_biblio = $_POST['mat_biblio'];

$sql = "DELETE FROM `bibliothecaire` WHERE `bibliothecaire`.`mat_biblio` LIKE '$mat_biblio'";

if (!$stmt = $conn->query($sql)) {
	$returnPhp = "Erreur: Delete Statement invalid.";
}else{
	$returnPhp = "Votre archive a été supprimé.";
}

// Write the contents back to the file
//file_put_contents($file, $log."\n");

echo $returnPhp;
?>
