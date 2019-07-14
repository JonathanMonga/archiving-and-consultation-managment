<?php
require "../connect.php";
error_reporting(E_ERROR | E_WARNING | E_PARSE);


$id = $_POST['id'];

$sql = "DELETE FROM `liste_consultation` WHERE `liste_consultation`.`id` = '$id'";

if (!$stmt = $conn->query($sql)) {
	$returnPhp = "Erreur: Delete Statement invalid.";
}else{
	$returnPhp = "Votre liste_consultation a été supprimé.";
}


// Write the contents back to the file
//file_put_contents($file, $log."\n");

echo $returnPhp;
?>
