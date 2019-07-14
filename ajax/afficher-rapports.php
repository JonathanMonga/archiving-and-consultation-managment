<?php
require "../connect.php";

error_reporting(E_ERROR | E_WARNING | E_PARSE);


$sql = "SELECT * FROM rapport, bibliothecaire WHERE rapport.mat_biblio = bibliothecaire.mat_biblio AND date = CURRENT_DATE"; // SQL Query
foreach ($conn->query($sql) as $row) { // Loop through each row and for each row display table layout
  print '<tr class="med_row" id="med_'.$row['num_rapport'].'">'; // put ID in CSS class to enable selecting specific rows of the table via JS in the form med_ID-GOES-HERE
  print '<td>'.$row['num_rapport'].'</td>';
  print '<td>'.$row['date'].'</td>';
  print '<td>'.$row['effectif'].'</td>';
  print '<td>'.$row['observation'].'</td>';
  print '<td><a href="index.php?page=modifier-biblio&id='.$row['mat_biblio'].'">'.ucwords($row['nom_biblio']).'</a></td>'; // Name of medication and ID label
  print '</tr>';
}
?>