<?php
require "../connect.php";

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sql = "SELECT * FROM liste_consultation, consultant, bibliothecaire, numero_liste 
        WHERE liste_consultation.mat_consult = consultant.mat_consult 
        AND liste_consultation.mat_biblio = bibliothecaire.mat_biblio 
        AND liste_consultation.num_fiche = numero_liste.num_fiche
        AND numero_liste.state = 'active'"; // SQL Query
        
foreach ($conn->query($sql) as $row) { // Loop through each row and for each row display table layout
  print '<tr class="med_row" id="med_'.$row['mat_consult'].'">'; // put ID in CSS class to enable selecting specific rows of the table via JS in the form med_ID-GOES-HERE
  print '<td><a href="index.php?page=modifier-consultation&id='.$row['id'].'">'.ucwords($row['id']).'</a></td>'; // Name of medication and ID label
  print '<td>'.$row['date_consult'].'</td>';
  print '<td>'.$row['nom_consult'].'</td>';
  print '<td>'.$row['heure_entree'].'</td>';
  print '<td>'.$row['heure_sortie'].'</td>';
  print '<td>'.$row['doc_consult'].'</td>';
  print '<td>'.$row['nom_biblio'].'</td>';
  print '</tr>';
}
?>