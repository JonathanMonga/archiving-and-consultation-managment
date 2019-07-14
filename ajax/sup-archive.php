<?php
require "../connect.php";
error_reporting(E_ERROR | E_WARNING | E_PARSE);


$code_archive = $_POST['code_archive'];


$sql = "DELETE FROM `archives` WHERE `archives`.`code_archive` = '$code_archive'";

if (!$stmt = $conn->query($sql)) {
	$returnPhp = "Erreur: Delete Statement invalid.";
}else{
	$returnPhp = "Votre archive a été supprimé.";
}


// Write the contents back to the file
//file_put_contents($file, $log."\n");

echo $returnPhp;
?>
