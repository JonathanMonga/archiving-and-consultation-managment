<?php
require "../connect.php";
error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sql = "UPDATE `consultant` SET 
		`nom_consult` = :nom_consult ,
		`prom_consult` = :prom_consult ,
		`fac_consult` = :fac_consult ,
		`inst_consult` = :inst_consult
		
		WHERE `consultant`.`mat_consult` LIKE '".$_POST['mat_consult']."'";
if (!$stmt = $conn->prepare($sql)) {
	
}else{
	if ($stmt->execute(array(
		':nom_consult' => $_POST['nom_consult'],
		':prom_consult' => $_POST['prom_consult'],
		':fac_consult' => $_POST['fac_consult'],
		':inst_consult' => $_POST['inst_consult']
	))) { 
		$returnPhp = array( 'mat_consult' => $_POST['mat_consult'] );
 } else {  
	 $returnPhp = null;
 
 }
}

$return = json_encode($returnPhp );
echo $return;
?>
