<div class="row">
  <div class="large-12 columns">
	  <?php
		
		$modifier = false;
		
		
	  	if (isset($_GET['id'])) {
			
			
			// Get global id
	  		$idMed = $_GET['id'];
			
		}
	
		
		
	  	?>
	  <h1>Visualiser / ajouter un numéro des listes</h1>
	  <p>Depuis cette interface vous pouvez visualiser ou modifier des numéros des listes.</p>
	  
  </div>

</div>

<div class="row">
	<div class="large-4 columns text-right">
		<label class="inline">Sélectionner un numéros des listes</label>
	</div>
	<div class="large-6 pull-2 columns">
		<select id="med-dropdown">
			<option value="blanc">&nbsp;&nbsp;&nbsp;</option>
			<option value="nouveau">&nbsp;&nbsp;&nbsp;[nouveau]</option>
			<?php
			$sql = 'SELECT * FROM numero_liste';
			foreach ($conn->query($sql) as $row) {
			  print '<option value="' . $row['num_fiche'] . '"> Liste N°' . $row['num_fiche'] . ' ('.$row['state']. ')'; // Fill out all medicaments in a drop-down
			}
			?>
		</select>
	</div>
</div>

<div id="detail" class="hide">
</div>
	

<script>

$(document).ready(function(){
	
	//Switch to blank on load if no ID, else switch to correct ID(dropdown)
	function the_ID() {
	    var iD = "<?php  if (isset($_GET['id'])) { echo $_GET['id'];}  ?>";
	    if (true) {
			return iD
		} else {
			return false;
		}
	}
	
	// Function pour charger la page correspondante
	function ajaxLoadMed() {
		if ($('#med-dropdown').val() != "blanc") {
			var dropdown_id = $('#med-dropdown').val()
			if (dropdown_id.length > 0 && dropdown_id != "nouveau" ) {			
				$('#detail').hide().load('ajax/ajouter-numero.php?id='+ dropdown_id ).fadeIn();
			} else {
				$('#detail').hide().load('ajax/ajouter-numero.php').fadeIn();
			}
		} else { 
			$('#detail').fadeOut();
		}
	}
	
	// au début, select the correct dropdown and charge the appropriate page
	if (the_ID()) {
		$('#med-dropdown option[value="'+the_ID()+'"]').prop('selected',true);
		ajaxLoadMed();
	} else {
		$('#med-dropdown option[value="blanc"]').prop('selected',true);
		ajaxLoadMed();
	}
	
	
	//Open saisie 'Nouveau med' si on clique sur 'nouveau' dans le dropdown
	
	$('#med-dropdown').change(function(){
		ajaxLoadMed()
		
	});
	
});

</script>