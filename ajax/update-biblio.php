<?php
require "../connect.php";
error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sql = "UPDATE `bibliothecaire` SET 
		`nom_biblio` = :nom_biblio
		
		WHERE `bibliothecaire`.`mat_biblio` LIKE '".$_POST['mat_biblio']."'";
if (!$stmt = $conn->prepare($sql)) {
	
}else{
	if ($stmt->execute(array(
		':nom_biblio' => $_POST['nom_biblio']
	))) { 
		$returnPhp = array( 'mat_biblio' => $_POST['mat_biblio'] );
 } else {  
	 $returnPhp = null;
 
 }
}

$return = json_encode($returnPhp );
echo $return;
?>
