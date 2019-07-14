
	  <?php
		
		$modifier = false;
		
		require "../connect.php";
	  	if (isset($_GET['id'])) {
			
			// Persistant variables
			$DBdata = null;
			
			// Get global id
	  		$num_fiche = $_GET['id'];
			
			
	  		$sql = "SELECT COUNT(*) FROM numero_liste WHERE `num_fiche` = $num_fiche ";
	  		if ($res = $conn->query($sql)) {
	  			if( $res->fetchColumn() > 0) {
	  				$modifier = true;
					
					$sql = "SELECT * FROM numero_liste WHERE `num_fiche` = :num_fiche";
					if ($stmt = $conn->prepare($sql)) {
						if ($stmt->execute(array(
							':num_fiche' => $num_fiche
						))) { 
							$DBdata = $stmt->fetch(PDO::FETCH_ASSOC);
						} else { ## $log .= " Select échouée"; 
						}
					}
					
	  			} else {
	  				print "<div data-alert class=\"alert-box alert\" id=\"client-alert-box\">
			  		  		Erreur : La iste n° $num_fiche n'est pas dans la base.
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
		<h2><?php if ($modifier == true) { print 'Liste n° '.$DBdata['num_fiche'];} else { print "Nouveau numero_liste";}?></h2>
	</div>
</div>
<div class="row">
<div data-alert id="outcome" class="large-12 columns alert-box success" style="display:none;">

</div>
</div>
<form id="form-med" method="POST">
<div class="row">

	  <div class="large-4 columns">
		   <label>Numéro de la liste<?php if ($modifier == true) { print '(non modifiable)';} ?></label>
		  <input id="id_med_field" name="num_fiche" style="" type="text" placeholder="Numéro de la liste" <?php if ($modifier == true) { print 'readonly';} ?> value="<?php if ($modifier == true) { print $DBdata['num_fiche'];};?>" required>
	  </div>

	  <div class="large-4 columns">
		   <label>Année d'utilisation<?php if ($modifier == true) { print '(non modifiable)';} ?></label>
		  <input id="id_med_field" name="annee" style="" type="text" placeholder="Année d'utilisation" <?php if ($modifier == true) { print 'readonly';} ?> value="<?php if ($modifier == true) { print $DBdata['annee'];};?>" required>
	  </div>

	  <div class="large-4 columns">
		  <label>Status</label>
		  <span id="jq_state" class="hide"><?php if ($modifier == true) { print $DBdata['state'];}?></span>
		  <select id="id_state" name="state">
			  <option value="active">Activer</option>
			  <option value="desactive">Desactiver</option>
		  </select>
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

	var jq_state = $('#jq_state').text().trim();
	$('#id_state option[value=' + jq_state + ']').prop('selected', true);
	
	
	//Submit new if new
	var modifier = "<?php print $modifier; ?>";
	if (modifier == "") {
		$('#ajouter').click(function(){
			$.ajax({
			  url:'ajax/inserer-numero-ajax.php',
			  data:$('#form-med').serialize(),
			  type:'POST',
			  success:function(data){
				  $('#outcome').prepend("Votre liste a été ajouté à la base").fadeIn();
				  var delay = 1000; //Your delay in milliseconds
				  setTimeout(function(){ window.location = 'index.php?page=afficher-numeros'; }, delay);
			  	}
			});
	
			return false;
		});
	} else if (modifier == "1") {
		$('#update').click(function(){
			$.ajax({
			  url:'ajax/update-numero.php',
			  data:$('#form-med').serialize(),
			  type:'POST',
			  success:function(data){
				  $data = $.parseJSON(data);
				  $message = "Le liste n° "+$data['num_fiche']+" a été mis à jour."
				  $('#outcome').prepend($message).fadeIn();
				  var delay = 1000; //Your delay in milliseconds
				  setTimeout(function(){ window.location = 'index.php?page=afficher-numeros'; }, delay);
			  	}
			});
	
			return false;
		});
		$('#supprimer').click(function(){
			alertify.confirm("Vous allez supprimer cette liste du système. Souhaitez-vous continuer ?", function(e){
				if (e) {
					$.ajax({
					  url:'ajax/sup-numero.php',
					  data:$('#form-med').serialize(),
					  type:'POST',
					  success:function(data){					
						  $('#outcome').prepend(data).fadeIn();
						  var delay = 1000; //Your delay in milliseconds
						  setTimeout(function(){ window.location = 'index.php?page=afficher-numeros'; }, delay);
					  	}
					});
				}
			});
		})
	}
});

</script>