<?php
require "../connect.php";
error_reporting(E_ERROR | E_WARNING | E_PARSE);


$sqlInsert = "INSERT INTO numero_liste (annee, state)
		VALUES ( :annee, :state)";
		
$sqlUpdate = "UPDATE `numero_liste` SET `state` = 'desactive'";

if ($_POST['state'] == "active") {
if(!$stmt = $conn->query($sqlUpdate)) {
	$returnPhp = "Erreur: Delete Statement invalid.";
}else{
	$returnPhp = "Votre archive a été supprimé.";
}
}

if (!$stmt = $conn->prepare($sqlInsert)) {
	echo "Statement invalid.<br>";
} else {
	echo "Statement prepared.<br>";
	
	if ($stmt->execute(array(
		':annee' => $_POST['annee'],
		':state' => $_POST['state']
	))) { echo "Execution réussie"; } else { echo "Execution échouée"; }
}
?>