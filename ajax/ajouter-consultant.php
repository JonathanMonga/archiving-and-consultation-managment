
	  <?php
		
		$modifier = false;
		
		require "../connect.php";
	  	if (isset($_GET['id'])) {
			
			// Persistant variables
			$DBdata = null;
			
			// Get global id
	  		$mat_consult = $_GET['id'];
			
			
	  		$sql = "SELECT COUNT(*) FROM consultant WHERE `mat_consult` LIKE '$mat_consult' ";
	  		if ($res = $conn->query($sql)) {
	  			if( $res->fetchColumn() > 0) {
	  				$modifier = true;
					
					$sql = "SELECT * FROM consultant WHERE `mat_consult` LIKE :mat_consult";
					if ($stmt = $conn->prepare($sql)) {
						if ($stmt->execute(array(
							':mat_consult' => $mat_consult
						))) { 
							$DBdata = $stmt->fetch(PDO::FETCH_ASSOC);
						} else { ## $log .= " Select échouée"; 
						}
					}
					
	  			} else {
	  				print "<div data-alert class=\"alert-box alert\" id=\"client-alert-box\">
			  		  		Erreur : Le consultant $mat_consult n'est pas dans la base.
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
		<h2><?php if ($modifier == true) { print $DBdata['mat_consult'];} else { print "Nouveau consultant";}?></h2>
	</div>
</div>
<div class="row">
<div data-alert id="outcome" class="large-12 columns alert-box success" style="display:none;">

</div>
</div>
<form id="form-med" method="POST">
<div class="row">

	  <div class="large-4 columns">
		   <label>Matricule du consultant<?php if ($modifier == true) { print '(non modifiable)';} ?></label>
		  <input id="id_med_field" name="mat_consult" style="" type="text" placeholder="Matricule du consultant" <?php if ($modifier == true) { print 'readonly';} ?> value="<?php if ($modifier == true) { print $DBdata['mat_consult'];};?>" required>
	  </div>
	  <div class="large-4 columns">
		   <label>Nom du consultant</label>
		  <input id="equiv_generique" name="nom_consult" type="text" placeholder="Nom du consultant" value="<?php if ($modifier == true) { print $DBdata['nom_consult'];};?>" required><br>
	  </div>
	  <div class="large-4 columns">
		  <label>Promotion</label>
		  <input id="equiv_generique" name="prom_consult" type="text" placeholder="Promotion" value="<?php if ($modifier == true) { print $DBdata['prom_consult'];};?>" required><br>
	  </div>
</div>

<div class="row">
	
	<div class="large-4 columns">
		 <label>Faculté</label>
		<input id="nom_med_field" required name="fac_consult" style="" type="text" placeholder="Faculté" value="<?php if ($modifier == true) { print $DBdata['fac_consult'];}?>"><br>
	</div>
	<div class="large-4 columns">
		 <label>Institution</label>
		<input id="agents_actifs" required name="inst_consult" type="text" placeholder="Institution" value="<?php if ($modifier == true) { print $DBdata['inst_consult'];}?>"><br>
	</div>
	<div class="large-4 columns">
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
			  url:'ajax/inserer-consultant-ajax.php',
			  data:$('#form-med').serialize(),
			  type:'POST',
			  success:function(data){
				  $('#outcome').prepend("Votre consultant a été ajouté à la base").fadeIn();
				  var delay = 1000; //Your delay in milliseconds
				  setTimeout(function(){ window.location = 'index.php?page=afficher-consultants'; }, delay);
			  	}
			});
	
			return false;
		});
	} else if (modifier == "1") {
		$('#update').click(function(){
			$.ajax({
			  url:'ajax/update-consultant.php',
			  data:$('#form-med').serialize(),
			  type:'POST',
			  success:function(data){
				  $data = $.parseJSON(data);
				  $message = "Le consultant "+$data['mat_consult']+" a été mis à jour."
				  $('#outcome').prepend($message).fadeIn();
				  var delay = 1000; //Your delay in milliseconds
				  setTimeout(function(){ window.location = 'index.php?page=afficher-consultants'; }, delay);
			  	}
			});
	
			return false;
		});
		$('#supprimer').click(function(){
			alertify.confirm("Vous allez supprimer ce consultant du système. Souhaitez-vous continuer ?", function(e){
				if (e) {
					$.ajax({
					  url:'ajax/sup-consultant.php',
					  data:$('#form-med').serialize(),
					  type:'POST',
					  success:function(data){					
						  $('#outcome').prepend(data).fadeIn();
						  var delay = 1000; //Your delay in milliseconds
						  setTimeout(function(){ window.location = 'index.php?page=afficher-consultants'; }, delay);
					  	}
					});
				}
			});
		})
	}
});

</script>