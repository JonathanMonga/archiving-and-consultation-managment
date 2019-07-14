<?php
require "../connect.php";

error_reporting(E_ERROR | E_WARNING | E_PARSE);


$sql = 'SELECT * FROM archives, bibliothecaire WHERE archives.mat_biblio = bibliothecaire.mat_biblio'; // SQL Query
foreach ($conn->query($sql) as $row) { // Loop through each row and for each row display table layout
  print '<tr class="med_row" id="med_'.$row['code_archive'].'">'; // put ID in CSS class to enable selecting specific rows of the table via JS in the form med_ID-GOES-HERE
  print '<td><a href="index.php?page=modifier-archive&id='.$row['code_archive'].'">'.ucwords($row['code_archive']).'</a></td>'; // Name of medication and ID label
  print '<td>'.$row['nom_auteur'].'</td>';
  print '<td>'.$row['sujet_travail'].'</td>';
  print '<td>'.$row['prom_auteur'].'</td>';
  print '<td>'.$row['annee'].'</td>';
  print '<td><a href="index.php?page=modifier-biblio&id='.$row['mat_biblio'].'">'.ucwords($row['nom_biblio']).'</a></td>'; // Name of medication and ID label
  print '</tr>';
}
?>