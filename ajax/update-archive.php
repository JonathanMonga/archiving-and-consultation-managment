<?php
require "../connect.php";
error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sql = "UPDATE `archives` SET 
		`sujet_travail` = :sujet_travail ,
		`nom_auteur` = :nom_auteur ,
		`prom_auteur` = :prom_auteur ,
		`annee` = :annee ,
		`mat_biblio` = :mat_biblio 
		
		WHERE `archives`.`code_archive` = '".$_POST['code_archive']."'";
if (!$stmt = $conn->prepare($sql)) {
	
}else{
	if ($stmt->execute(array(
		':sujet_travail' => $_POST['sujet_travail'],
		':nom_auteur' => $_POST['nom_auteur'],
		':prom_auteur' => $_POST['prom_auteur'],
		':annee' => $_POST['annee'],
		':mat_biblio' => $_POST['mat_biblio']
	))) { 
		$returnPhp = array( 'code_archive' => $_POST['code_archive'] );
 } else {  
	 $returnPhp = null;
 
 }
}

$return = json_encode($returnPhp );
echo $return;
?>
