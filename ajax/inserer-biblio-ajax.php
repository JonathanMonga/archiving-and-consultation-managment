<?php
require "../connect.php";
error_reporting(E_ERROR | E_WARNING | E_PARSE);


$sql = "INSERT INTO bibliothecaire (mat_biblio, nom_biblio)
        VALUES ( :mat_biblio, :nom_biblio)";

if (!$stmt = $conn->prepare($sql)) {
	echo "Statement invalid.<br>";
} else {
	echo "Statement prepared.<br>";
	
	if ($stmt->execute(array(
		':mat_biblio' => $_POST['mat_biblio'],
		':nom_biblio' => $_POST['nom_biblio']
	))) { echo "Execution réussie"; } else { echo "Execution échouée"; }
}
?>