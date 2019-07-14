<?php

$query = $_POST['query'];

?>

<div class="row">
   
  <div class="large-10 push-3 columns">
	  
	  <?php
	  
	  if ($query != "") {
		  print "<h1><small>Résultats de la recherche : </small>".$query."</h1>";
		  
		  ?>
		  
	  </div>

	</div>
	<div class="row">

	  <div class="large-12 columns">
		  <table>
			  <thead>
				  <tr>
					  <th style="background:rgb(103, 58, 183);color:white">Code de l'archive</th>
					  <th style="background:rgb(103, 58, 183);color:white">Nom de l'archive</th>
					  <th style="background:rgb(103, 58, 183);color:white">Promotion</th>
					  <th style="background:rgb(103, 58, 183);color:white">Année</th>
					  <th style="background:rgb(103, 58, 183);color:white">Bibliothécaire</th>
				  </tr>
			  </thead>
			  <tbody id="searc-results">
				  <?php
				  	
				  $sql = "SELECT * FROM archives WHERE (`code_archive` LIKE :query) OR (`nom_travail` LIKE :query )"; // SQL Query
				  if (!$stmt = $conn->prepare($sql)) {
				  	echo "Statement invalid.<br>";
				  }else{ 
					  if ($stmt->execute(array(":query" => "%".$query."%" ))) {
						  
						  $meds = $stmt->fetchAll();
						  if ( count($meds) ) {
						  
							  foreach ($meds as $row)
							  {
								print '<tr class="med_row" id="med_'.$row['code_archive'].'">'; // put ID in CSS class to enable selecting specific rows of the table via JS in the form med_ID-GOES-HERE
  print '<td><a href="index.php?page=modifier-archive&id='.$row['code_archive'].'">'.ucwords($row['code_archive']).'</a></td>'; // Name of medication and ID label
  print '<td>'.$row['nom_auteur'].'</td>';
  print '<td>'.$row['sujet_travail'].'</td>';
  print '<td>'.$row['prom_auteur'].'</td>';
  print '<td>'.$row['annee'].'</td>';
  print '<td><a href="index.php?page=modifier-biblio&id='.$row['mat_biblio'].'">'.ucwords($row['nom_biblio']).'</a></td>'; // Name of medication and ID label
							  print '</tr>';
							  }
						  } else {
							  print '<div class="alert-box alert" data-alert-box><p>Aucun résultat ne correspond à votre recherche.</p></div>';
						  }
						  }
					  }
				  
				  
				  ?>
			  
			  
			  
			  
			  
			  
			  </tbody>  
		  
		  </table>
	  </div>
	</div>
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  <?php 
	  } else {
		  print "<h1>Aucun terme n'a été saisi.</h1><h2><small>Merci de saisir un terme de recherche.</small></h2>";
		  print "</div>

	</div>";
	  }
	  ?>