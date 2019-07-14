<?php
require "../connect.php";
error_reporting(E_ERROR | E_WARNING | E_PARSE);


$sql = "INSERT INTO consultant (mat_consult ,nom_consult, prom_consult, fac_consult, inst_consult)
        VALUES ( :mat_consult , :nom_consult, :prom_consult, :fac_consult, :inst_consult)";

if (!$stmt = $conn->prepare($sql)) {
	echo "Statement invalid.<br>";
} else {
	echo "Statement prepared.<br>";
	
	if ($stmt->execute(array(
		':mat_consult' => $_POST['mat_consult'],
		':nom_consult' => $_POST['nom_consult'],
		':prom_consult' => $_POST['prom_consult'],
		':fac_consult' => $_POST['fac_consult'],
		':inst_consult' => $_POST['inst_consult']
	))) { echo "Execution réussie"; } else { echo "Execution échouée"; }
}
?>