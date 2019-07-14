<?php 

require "header.php"; 
require "connect.php";



if (isset($_GET['page'])){
$page = $_GET['page'];
}

if (isset($_GET['page'])) {
	switch ($page){
		case "home":
		require "home.php";
		break;
		case "afficher-archives":
		require "afficher-archives.php";
		break;
		case "afficher-consultants":
		require "afficher-consultants.php";
		break;
		case "afficher-consultations":
		require "afficher-consultations.php";
		break;
		case "afficher-biblios":
		require "afficher-biblios.php";
		break;
		case "afficher-numeros":
		require "afficher-numeros.php";
		break;
		case "afficher-rapports":
		require "afficher-rapports.php";
		break;
		case "modifier-numero":
		require "modifier-numero.php";
		break;
		case "modifier-archive":
		require "modifier-archive.php";
		break;
		case "modifier-consultant":
		require "modifier-consultant.php";
		break;
		case "modifier-consultation":
		require "modifier-consultation.php";
		break;
		case "modifier-biblio":
		require "modifier-biblio.php";
		break;
		case "search":
		require "search.php";
		break;
		default: require "404.php";
	}
} else {
	require "home.php";
}
?>
  
<?php require "footer.php";
require "disconnect.php"; ?>

