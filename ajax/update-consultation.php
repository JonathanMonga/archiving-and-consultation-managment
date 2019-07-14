<?php
require "../connect.php";
error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sql = "UPDATE `liste_consultation` SET 
		`num_fiche` = :num_fiche ,
		`date_consult` = :date_consult ,
		`heure_entree` = :heure_entree ,
		`heure_sortie` = :heure_sortie ,
		`doc_consult` = :doc_consult ,
		`mat_consult` = :mat_consult ,
		`mat_biblio` = :mat_biblio 
		
		WHERE `liste_consultation`.`id` = '".$_POST['id']."'";
if (!$stmt = $conn->prepare($sql)) {
	
}else{
	if ($stmt->execute(array(
		':num_fiche' => $_POST['num_fiche'],
		':date_consult' => $_POST['date_consult'],
		':heure_entree' => $_POST['heure_entree'],
		':heure_sortie' => $_POST['heure_sortie'],
		':doc_consult' => $_POST['doc_consult'],
		':mat_consult' => $_POST['mat_consult'],
		':mat_biblio' => $_POST['mat_biblio']
	))) { 
		$returnPhp = array( 'id' => $_POST['id'] );
 } else {  
	 $returnPhp = null;
 
 }
}

$return = json_encode($returnPhp );
echo $return;
?>
