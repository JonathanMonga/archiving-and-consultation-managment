<div class="row">


  <div class="large-12 columns text-left">
      <h1>GAC</h1>
	  <h2>Gestion d'archivage et de consultation</h2>
  </div>

</div>

<div class="row">


  <div class="large-9 columns">
      <div class="panel"><img src="images/panterre.jpg"></div>
  </div>
  <div class="large-3 columns text-right">
	  <div class="panel">
		  <h4>Gestion d'archivage et de consultation</h4>
		  <p>L'interface de GAC vous permet de gérer tous les archives et consultations en un seul endroit.</p>
	  </div>
	  <div class="panel">
		  <a href="index.php?page=afficher-archives" class="button">Ajouter un archive >></a>
	  </div>
  </div>
</div>
<div class="row">
    <div class="large-9 columns">
  	  <div class="panel">
  		  <h4>Consultations</h4>
		  <?php
		  
		  $sql = "SELECT * FROM liste_consultation ORDER BY id DESC LIMIT 10";
		  if ($meds = $conn->query($sql)) {
			  print '<table width="100%"><tr>';
			  foreach ($meds as $med) {
				  print '<tr class="med_row" id="med_'.$med['num_fiche'].'"><td>'.$med['heure_entree'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="label alert radius">'.$med['heure_sortie'].'</span></td><td>'.$med['doc_consult'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>';
			  }
			  print '</tr></table>';
		  } else {
			  print '<div class="alert alert-box">Erreur de requête SQL</div>';
		  }
			
		  ?>
		  <div class="text-right"><a href="index.php?page=afficher-consultation">Voir tous les archives >></a></div>
		  
  	  </div>
    </div>

<!--Reveal stuff-->
<div id="email-fournisseur" class="reveal-modal" data-reveal> </div>

