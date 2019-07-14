
	  <?php
		
		$modifier = false;
		
		require "../connect.php";
	  	if (isset($_GET['id'])) {
			
			// Persistant variables
			$DBdata = null;
			
			// Get global id
	  		$id = $_GET['id'];
			
	  		$sql = "SELECT COUNT(*) FROM liste_consultation WHERE `id` = $id ";
	  		if ($res = $conn->query($sql)) {
	  			if( $res->fetchColumn() > 0) {
	  				$modifier = true;
					
					$sql = "SELECT * FROM liste_consultation WHERE `id` = :id";
					if ($stmt = $conn->prepare($sql)) {
						if ($stmt->execute(array(
							':id' => $id
						))) { 
							$DBdata = $stmt->fetch(PDO::FETCH_ASSOC);
						} else { ## $log .= " Select échouée"; 
						}
					}
					
	  			} else {
	  				print "<div data-alert class=\"alert-box alert\" id=\"client-alert-box\">
			  		  		Erreur : La liste de consultation n° $id n'est pas dans la base.
		  		  			</div>";
							$modifier = false;
	  			}
	  		}

	  		    /* Check the number of rows that match the SELECT statement */
		  
	  		}

	  		$res = null;
	
		
		
	  	?>
	  

<div class="row">
	<div class="large-6 columns">
		<h2><?php if ($modifier == true) { print "Liste n° " . $DBdata['num_fiche'];} else { print "Nouveau consultation";}?></h2>
	</div>
</div>
<div class="row">
<div data-alert id="outcome" class="large-12 columns alert-box success" style="display:none;">

</div>
</div>
<form id="form-med" method="POST">
<div class="row">
      <div class="large-4 columns">
		  <label>Numéro de la liste</label>
		  <span id="jq_num_fiche" class="hide"><?php if ($modifier == true) { print $DBdata['num_fiche'];}?></span>
		  <select id="id_num_fiche" name="num_fiche">
		      <?php
			  $sql = "SELECT * FROM numero_liste WHERE state = 'active'";
			  foreach ($conn->query($sql) as $row) {
				  print '<option value="' . $row['num_fiche'] . '">' .'Liste N° >> '. $row['num_fiche'] . '</option>'; // Fill out all fournisseurs in a drop-down
			  }
			  ?>
		  </select>
	  </div>
	  <div class="large-4 columns">
		   <label>Archive consulté</label>
		  <input id="equiv_generique" name="doc_consult" type="text" placeholder="Archive consulté" value="<?php if ($modifier == true) { print $DBdata['doc_consult'];};?>" required><br>
	  </div>
	  <div class="large-4 columns">
		  <label>Heure d'entrée</label>
		  <input id="equiv_generique" name="heure_entree" type="time" placeholder="Heure d'entrée" value="<?php if ($modifier == true) { print $DBdata['heure_entree'];};?>" required><br>
	  </div>
</div>

<div class="row">
     <div class="large-4 columns">
		  <label>Nom du consultant</label>
		  <span id="jq_consult" class="hide"><?php if ($modifier == true) { print $DBdata['mat_consult'];}?></span>
		  <select id="id_consult" name="mat_consult">
		     <?php
			  $sql = "SELECT * FROM consultant";
			  foreach ($conn->query($sql) as $row) {
				  print '<option value="' . $row['mat_consult'] . '">' .$row['nom_consult'] . '</option>'; // Fill out all fournisseurs in a drop-down
			  }
			  ?>
		  </select>
	  </div>
	
	  <div class="large-4 columns">
		  <label>Nom du bibliothécaire</label>
		  <span id="jq_biblio" class="hide"><?php if ($modifier == true) { print $DBdata['mat_biblio'];}?></span>
		  <select id="id_biblio" name="mat_biblio">
		    <?php
			  $sql = "SELECT * FROM bibliothecaire";
			  foreach ($conn->query($sql) as $row) {
				  print '<option value="' . $row['mat_biblio'] . '">' .$row['nom_biblio'] . '</option>'; // Fill out all fournisseurs in a drop-down
			  }
			  ?>
		  </select>
	  </div>
	<div class="large-4 columns">
		 <label>Heure de sortie</label>
		<input id="agents_actifs" required name="heure_sortie" type="time" placeholder="Heure de sortie" value="<?php if ($modifier == true) { print $DBdata['heure_sortie'];}?>"><br>
	</div>
	<div class="large-4 columns">
    </div>
</div>

<div class="row">
    <div class="large-4 columns">
		 <label>Date de consultation</label>
		<input id="agents_actifs" required name="date_consult" type="date" placeholder="Date de consultation" value="<?php if ($modifier == true) { print $DBdata['date_consult'];}?>"><br>
	</div>

	<div class="large-4 columns">
		<input name="id" type="hidden" value="<?php if ($modifier == true) { print $DBdata['id'];}?>"><br>
	</div>
</div>

<div class="row">
	<?php if ($modifier == true) { ?>
		<div class="large-3 columns push-2">
			<a href="javascript:void(0)" id="supprimer" class="large-12 radius button alert">Supprimer</a>
		</div>
			<?php } ?>
			
			<div class="<?php if ($modifier == false) { print ""; }?> large-3 columns">
				<a href="javascript:void(0)" id="<?php if ($modifier == true) { print "update"; } else { print "ajouter"; }?>" class="radius large-12 button"><?php if ($modifier == true) { print "Enregistrer"; } else { print "Ajouter"; }?></a>
			</div>
</div>
</form>
</div>
<div class="row">

	

<script>

$(document).ready(function(){
	
	var jq_num_fiche = $('#jq_num_fiche').text().trim();
	$('#id_num_fiche option[value=' + jq_num_fiche + ']').prop('selected', true);

	var jq_consult = $('#jq_consult').text().trim();
	$('#id_consult option[value=' + jq_consult + ']').prop('selected', true);

	var jq_biblio = $('#jq_biblio').text().trim();
	$('#id_biblio option[value=' + jq_biblio + ']').prop('selected', true);
	
	//Submit new if new
	var modifier = "<?php print $modifier; ?>";

	if (modifier == "") {
		$('#ajouter').click(function(){
			$.ajax({
			  url:'ajax/inserer-consultation-ajax.php',
			  data:$('#form-med').serialize(),
			  type:'POST',
			  success:function(data){
				  $('#outcome').prepend("Votre liste de consultation a été ajouté à la base").fadeIn();
				  var delay = 1000; //Your delay in milliseconds
				  setTimeout(function(){ window.location = 'index.php?page=afficher-consultations'; }, delay);
			  	}
			});
	
			return false;
		});
	} else if (modifier == "1") {
		$('#update').click(function(){
			$.ajax({
			  url:'ajax/update-consultation.php',
			  data:$('#form-med').serialize(),
			  type:'POST',
			  success:function(data){
				  $data = $.parseJSON(data);
				  $message = "La liste de consultation "+$data['id']+" a été mis à jour."
				  $('#outcome').prepend($message).fadeIn();
				  var delay = 1000; //Your delay in milliseconds
				  setTimeout(function(){ window.location = 'index.php?page=afficher-consultations'; }, delay);
			  	}
			});
	
			return false;
		});
		$('#supprimer').click(function(){
			alertify.confirm("Vous allez supprimer cette liste de consultation du système. Souhaitez-vous continuer ?", function(e){
				if (e) {
					$.ajax({
					  url:'ajax/sup-consultation.php',
					  data:$('#form-med').serialize(),
					  type:'POST',
					  success:function(data){					
						  $('#outcome').prepend(data).fadeIn();
						  var delay = 1000; //Your delay in milliseconds
						  setTimeout(function(){ window.location = 'index.php?page=afficher-consultations'; }, delay);
					  	}
					});
				}
			});
		})
	}
});

</script>