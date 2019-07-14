<?php
require "../connect.php";

error_reporting(E_ERROR | E_WARNING | E_PARSE);


$sql = 'SELECT * FROM numero_liste'; // SQL Query
foreach ($conn->query($sql) as $row) { // Loop through each row and for each row display table layout
  print '<tr class="med_row" id="med_'.$row['num_fiche'].'">'; // put ID in CSS class to enable selecting specific rows of the table via JS in the form med_ID-GOES-HERE
  print '<td><a href="index.php?page=modifier-numero&id='.$row['num_fiche'].'">'.ucwords($row['num_fiche']).'</a></td>'; // Name of medication and ID label
  print '<td>'.$row['annee'].'</td>';
  print '<td>'.$row['state'].'</td>';
  print '</tr>';
}
?>