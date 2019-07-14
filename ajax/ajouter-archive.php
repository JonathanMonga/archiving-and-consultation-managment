
	  <?php
		
		$modifier = false;
		
		require "../connect.php";
	  	if (isset($_GET['id'])) {
			
			// Persistant variables
			$DBdata = null;
			
			// Get global id
	  		$code_archive = $_GET['id'];
			
			
	  		$sql = "SELECT COUNT(*) FROM archives WHERE `code_archive` LIKE '$code_archive' ";
	  		if ($res = $conn->query($sql)) {
	  			if( $res->fetchColumn() > 0) {
	  				$modifier = true;
					
					$sql = "SELECT * FROM archives WHERE `code_archive` LIKE :code_archive";
					if ($stmt = $conn->prepare($sql)) {
						if ($stmt->execute(array(
							':code_archive' => $code_archive
						))) { 
							$DBdata = $stmt->fetch(PDO::FETCH_ASSOC);
						} else { ## $log .= " Select échouée"; 
						}
					}
					
	  			} else {
	  				print "<div data-alert class=\"alert-box alert\" id=\"client-alert-box\">
			  		  		Erreur : L'archive $code_archive n'est pas dans la base.
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
		<h2><?php if ($modifier == true) { print $DBdata['code_archive'];} else { print "Nouveau archive";}?></h2>
	</div>
</div>
<div class="row">
<div data-alert id="outcome" class="large-12 columns alert-box success" style="display:none;">

</div>
</div>
<form id="form-med" method="POST">
<div class="row">

	  <div class="large-4 columns">
		   <label>Code de l'archive<?php if ($modifier == true) { print '(non modifiable)';} ?></label>
		  <input id="id_med_field" name="code_archive" style="" type="text" placeholder="Code de l'archive" <?php if ($modifier == true) { print 'readonly';} ?> value="<?php if ($modifier == true) { print $DBdata['code_archive'];};?>" required>
	  </div>
	  <div class="large-4 columns">
		   <label>Sujet du travail</label>
		  <input id="equiv_generique" name="sujet_travail" type="text" placeholder="Sujet du travail" value="<?php if ($modifier == true) { print $DBdata['sujet_travail'];};?>" required><br>
	  </div>
	  <div class="large-4 columns">
		  <label>Bibliothécaire</label>
		  <span id="jq_fournisseur" class="hide"><?php if ($modifier == true) { print $DBdata['mat_biblio'];}?></span>
		  <select id="id_fournisseur" name="mat_biblio">
			  <?php
			  $sql = 'SELECT * FROM bibliothecaire';
			  foreach ($conn->query($sql) as $row) {
				  print '<option value="' . $row['mat_biblio'] . '">' . $row['nom_biblio'] . '</option>'; // Fill out all fournisseurs in a drop-down
			  } 
			  ?>
		  </select>
	  </div>
</div>

<div class="row">
	
	<div class="large-4 columns">
		 <label>Nom de l'auteur</label>
		<input id="nom_med_field" required name="nom_auteur" style="" type="text" placeholder="Nom de l'auteur" value="<?php if ($modifier == true) { print $DBdata['nom_auteur'];}?>"><br>
	</div>
	<div class="large-4 columns">
		 <label>Promotion de l'auteur</label>
		<input id="agents_actifs" required name="prom_auteur" type="text" placeholder="Promotion de l'auteur" value="<?php if ($modifier == true) { print $DBdata['prom_auteur'];}?>"><br>
	</div>

	<div class="large-4 columns">
		 <label>Année de rédaction</label>
		<input id="agents_actifs" required name="annee" type="text" placeholder="Année de rédaction" value="<?php if ($modifier == true) { print $DBdata['annee'];}?>"><br>
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
	
	
	//Submit new if new
	var modifier = "<?php print $modifier; ?>";
	if (modifier == "") {
		$('#ajouter').click(function(){
			$.ajax({
			  url:'ajax/inserer-archive-ajax.php',
			  data:$('#form-med').serialize(),
			  type:'POST',
			  success:function(data){
				  $('#outcome').prepend("Votre archive a été ajouté à la base").fadeIn();
				  var delay = 1000; //Your delay in milliseconds
				  setTimeout(function(){ window.location = 'index.php?page=afficher-archives'; }, delay);
			  	}
			});
	
			return false;
		});
	} else if (modifier == "1") {
		$('#update').click(function(){
			$.ajax({
			  url:'ajax/update-archive.php',
			  data:$('#form-med').serialize(),
			  type:'POST',
			  success:function(data){
				  $data = $.parseJSON(data);
				  $message = "L'archive "+$data['code_archive']+" a été mis à jour."
				  $('#outcome').prepend($message).fadeIn();
				  var delay = 1000; //Your delay in milliseconds
				  setTimeout(function(){ window.location = 'index.php?page=afficher-archives'; }, delay);
			  	}
			});
	
			return false;
		});
		$('#supprimer').click(function(){
			alertify.confirm("Vous allez supprimer cet archive du système. Souhaitez-vous continuer ?", function(e){
				if (e) {
					$.ajax({
					  url:'ajax/sup-archive.php',
					  data:$('#form-med').serialize(),
					  type:'POST',
					  success:function(data){					
						  $('#outcome').prepend(data).fadeIn();
						  var delay = 1000; //Your delay in milliseconds
						  setTimeout(function(){ window.location = 'index.php?page=afficher-archives'; }, delay);
					  	}
					});
				}
			});
		})
	}
});

</script>