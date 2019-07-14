
	  <?php
		
		$modifier = false;
		
		require "../connect.php";
	  	if (isset($_GET['id'])) {
			
			// Persistant variables
			$DBdata = null;
			
			// Get global id
	  		$mat_biblio = $_GET['id'];
			
			
	  		$sql = "SELECT COUNT(*) FROM bibliothecaire WHERE `mat_biblio` LIKE '$mat_biblio' ";
	  		if ($res = $conn->query($sql)) {
	  			if( $res->fetchColumn() > 0) {
	  				$modifier = true;
					
					$sql = "SELECT * FROM bibliothecaire WHERE `mat_biblio` LIKE :mat_biblio";
					if ($stmt = $conn->prepare($sql)) {
						if ($stmt->execute(array(
							':mat_biblio' => $mat_biblio
						))) { 
							$DBdata = $stmt->fetch(PDO::FETCH_ASSOC);
						} else { ## $log .= " Select échouée"; 
						}
					}
					
	  			} else {
	  				print "<div data-alert class=\"alert-box alert\" id=\"client-alert-box\">
			  		  		Erreur : Le bibliothecaire $mat_biblio n'est pas dans la base.
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
		<h2><?php if ($modifier == true) { print $DBdata['mat_biblio'];} else { print "Nouveau bibliothecaire";}?></h2>
	</div>
</div>
<div class="row">
<div data-alert id="outcome" class="large-12 columns alert-box success" style="display:none;">

</div>
</div>
<form id="form-med" method="POST">
<div class="row">

	  <div class="large-4 columns">
		   <label>Matricule du bibliothécaire<?php if ($modifier == true) { print '(non modifiable)';} ?></label>
		  <input id="id_med_field" name="mat_biblio" style="" type="text" placeholder="Matricule du bibliothécaire" <?php if ($modifier == true) { print 'readonly';} ?> value="<?php if ($modifier == true) { print $DBdata['mat_biblio'];};?>" required>
	  </div>
	  <div class="large-4 columns">
		   <label>Nom du bibliothécaire</label>
		  <input id="equiv_generique" name="nom_biblio" type="text" placeholder="Nom du bibliothécaire" value="<?php if ($modifier == true) { print $DBdata['nom_biblio'];};?>" required><br>
	  </div>
	  <div class="large-4 columns">
		  
	  </div>
</div>

<div class="row">
	<?php if ($modifier == true) { ?>
		<div class="large-4 columns">
			<a href="javascript:void(0)" id="supprimer" class="large-12 radius button alert">Supprimer</a>
		</div>
			<?php } ?>
			
			<div class="<?php if ($modifier == false) { print ""; }?> large-4 columns">
				<a href="javascript:void(0)" id="<?php if ($modifier == true) { print "update"; } else { print "ajouter"; }?>" class="radius large-12 button"><?php if ($modifier == true) { print "Enregistrer"; } else { print "Ajouter"; }?></a>
			</div>

			<div class="large-4 columns">

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
			  url:'ajax/inserer-biblio-ajax.php',
			  data:$('#form-med').serialize(),
			  type:'POST',
			  success:function(data){
				  $('#outcome').prepend("Votre bibliothecaire a été ajouté à la base").fadeIn();
				  var delay = 1000; //Your delay in milliseconds
				  setTimeout(function(){ window.location = 'index.php?page=afficher-biblios'; }, delay);
			  	}
			});
	
			return false;
		});
	} else if (modifier == "1") {
		$('#update').click(function(){
			$.ajax({
			  url:'ajax/update-biblio.php',
			  data:$('#form-med').serialize(),
			  type:'POST',
			  success:function(data){
				  $data = $.parseJSON(data);
				  $message = "Le bibliothecaire "+$data['mat_biblio']+" a été mis à jour."
				  $('#outcome').prepend($message).fadeIn();
				  var delay = 1000; //Your delay in milliseconds
				  setTimeout(function(){ window.location = 'index.php?page=afficher-biblios'; }, delay);
			  	}
			});
	
			return false;
		});
		$('#supprimer').click(function(){
			alertify.confirm("Vous allez supprimer ce bibliothecaire du système. Souhaitez-vous continuer ?", function(e){
				if (e) {
					$.ajax({
					  url:'ajax/sup-biblio.php',
					  data:$('#form-med').serialize(),
					  type:'POST',
					  success:function(data){					
						  $('#outcome').prepend(data).fadeIn();
						  var delay = 1000; //Your delay in milliseconds
						  setTimeout(function(){ window.location = 'index.php?page=afficher-biblios'; }, delay);
					  	}
					});
				}
			});
		})
	}
});

</script>