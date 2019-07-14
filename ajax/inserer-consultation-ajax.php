<?php
require "../connect.php";
error_reporting(E_ERROR | E_WARNING | E_PARSE);


$sql = "INSERT INTO liste_consultation (num_fiche ,date_consult, heure_entree, heure_sortie, doc_consult, mat_consult, mat_biblio)
        VALUES (:num_fiche , :date_consult, :heure_entree, :heure_sortie, :doc_consult, :mat_consult, :mat_biblio)";

if (!$stmt = $conn->prepare($sql)) {
	echo "Statement invalid.<br>";
} else {
	echo "Statement prepared.<br>";
	
	if ($stmt->execute(array(
		':num_fiche' => $_POST['num_fiche'],
		':date_consult' => $_POST['date_consult'],
		':heure_entree' => $_POST['heure_entree'],
		':heure_sortie' => $_POST['heure_sortie'],
		':doc_consult' => $_POST['doc_consult'],
		':mat_consult' => $_POST['mat_consult'],
		':mat_biblio' => $_POST['mat_biblio'],
	))) { echo "Execution réussie"; } else { echo "Execution échouée"; }
}
?>