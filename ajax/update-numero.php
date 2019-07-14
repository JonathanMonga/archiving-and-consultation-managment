<?php
require "../connect.php";
error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sqlUpdate = "UPDATE `numero_liste` SET `state` = 'desactive'";

if ($_POST['state'] == "active") {
	if(!$stmt = $conn->query($sqlUpdate)) {
		$returnPhp = "Erreur: Delete Statement invalid.";
	}else{
		$returnPhp = "Votre archive a été supprimé.";
	}
}

$sql = "UPDATE `numero_liste` SET 
		`annee` = :annee,
		`state` = :state
		
		WHERE `numero_liste`.`num_fiche` = '".$_POST['num_fiche']."'";

if (!$stmt = $conn->prepare($sql)) {
	
}else{
	if ($stmt->execute(array(
		':annee' => $_POST['annee'],
		':state' => $_POST['state']
	))) { 
		$returnPhp = array( 'num_fiche' => $_POST['num_fiche'] );
 } else {  
	 $returnPhp = null;
 
 }
}

$return = json_encode($returnPhp );
echo $return;
?>
