<?php
require "../connect.php";
error_reporting(E_ERROR | E_WARNING | E_PARSE);


$sql = "INSERT INTO archives (code_archive ,sujet_travail,nom_auteur,prom_auteur,annee,mat_biblio)
        VALUES ( :code_archive , :sujet_travail, :nom_auteur, :prom_auteur, :annee, :mat_biblio)";

if (!$stmt = $conn->prepare($sql)) {
	echo "Statement invalid.<br>";
} else {
	echo "Statement prepared.<br>";
	
	if ($stmt->execute(array(
		':code_archive' => $_POST['code_archive'],
		':sujet_travail' => $_POST['sujet_travail'],
		':nom_auteur' => $_POST['nom_auteur'],
		':prom_auteur' => $_POST['prom_auteur'],
		':annee' => $_POST['annee'],
		':mat_biblio' => $_POST['mat_biblio']
	))) { echo "Execution réussie"; } else { echo "Execution échouée"; }
}
?>