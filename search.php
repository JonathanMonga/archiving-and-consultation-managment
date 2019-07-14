<?php

$query = $_POST['query'];

?>

<div class="row">
   
  <div class="large-10 push-3 columns">
	  
	  <?php
	  
	  if ($query != "") {
		  print "	  <h1><small>Résultats de la recherche : </small>".$query."</h1>";
		  
		  ?>
		  
	  </div>

	</div>
	<div class="row">

	  <div class="large-12 columns">
		  <table>
			  <thead>
				  <tr>
					  <th>Code de l'archive</th>
					  <th>Nom de l'archive</th>
					  <th>Age</th>
					  <th>Quantité en stock</th>
					  <th>Aliment</th>
				  </tr>
			  </thead>
			  <tbody id="searc-results">
				  <?php
				  	
				  $sql = "SELECT * FROM archive WHERE (`code_archive` LIKE :query ) OR (`nom_archive` LIKE :query )"; // SQL Query
				  if (!$stmt = $conn->prepare($sql)) {
				  	echo "Statement invalid.<br>";
				  }else{ 
					  if ($stmt->execute(array(":query" => "%".$query."%" ))) {
						  
						  $meds = $stmt->fetchAll();
						  if ( count($meds) ) {
						  
							  foreach ($meds as $row)
							  {
								print '<tr id="med_'.$row['code_archive'].'">'; // put ID in CSS class to enable selecting specific rows of the table via JS in the form med_ID-GOES-HERE
							    print '<td><a href="index.php?page=modifier-archive&id='.$row['code_archive'].'">'.ucwords(strtolower($row['code_archive'])).'</a></td>'; // Name of medication and ID label
							    print '<td>'.$row['nom_archive'].'</td>';
							    print '<td>'.$row['age'].'</td>';
							    print '<td>'.$row['quantite_stock'].'</td>';
							    print '<td>'.$row['aliment'].'</td>';

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