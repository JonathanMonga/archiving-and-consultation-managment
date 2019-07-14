<?php
require "../connect.php";
error_reporting(E_ERROR | E_WARNING | E_PARSE);


$sql = "INSERT INTO rapport (effectif, observation, mat_biblio, date)
        VALUES ( :effectif, :observation, :mat_biblio, :date)";

if (!$stmt = $conn->prepare($sql)) {
	echo "Statement invalid.<br>";
} else {
	echo "Statement prepared.<br>";
	
	if ($stmt->execute(array(
		':effectif' => $_POST['effectif'],
		':observation' => $_POST['observation'],
		':mat_biblio' => $_POST['mat_biblio'],
		':date' => date("Y-m-d")
	))) { echo "Execution réussie"; } else { echo "Execution échouée"; }
}
?>