<?php
require "../connect.php";

error_reporting(E_ERROR | E_WARNING | E_PARSE);


$sql = 'SELECT * FROM bibliothecaire'; // SQL Query
foreach ($conn->query($sql) as $row) { // Loop through each row and for each row display table layout
  print '<tr class="med_row" id="med_'.$row['mat_biblio'].'">'; // put ID in CSS class to enable selecting specific rows of the table via JS in the form med_ID-GOES-HERE
  print '<td><a href="index.php?page=modifier-biblio&id='.$row['mat_biblio'].'">'.ucwords($row['mat_biblio']).'</a></td>'; // Name of medication and ID label
  print '<td>'.$row['nom_biblio'].'</td>';
  print '</tr>';
}
?>