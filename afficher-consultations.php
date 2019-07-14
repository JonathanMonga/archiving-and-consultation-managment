<span id="printout">
<div class="row">
   
  <div class="large-10 push-3 columns">
	  <h1>Liste des consultations</h1>
	  <p>Depuis cette interface vous pouvez gérer les consultations.</p>
  </div>

</div>



<div class="row">

  <div class="large-12 columns">
	  <table>
	      <caption>
          <h2 style="color:black;">
		    <?php
			   require "connect.php";

               $sql = "SELECT * FROM numero_liste WHERE state = 'active'"; 
               foreach ($conn->query($sql) as $row) { 
                    print 'Fiche N° '.$row['num_fiche']; 
                }
            ?>          
		  </h2>
          </caption>   
		  <thead>
			  <tr>
			      <th style="background:rgb(103, 58, 183);color:white">N°</th>
				  <th style="background:rgb(103, 58, 183);color:white">Date</th>
				  <th style="background:rgb(103, 58, 183);color:white">Nom du consultant</th>
				  <th style="background:rgb(103, 58, 183);color:white">Heure d'entrée</th>
				  <th style="background:rgb(103, 58, 183);color:white">Heure de sortie</th>
				  <th style="background:rgb(103, 58, 183);color:white">Archive consulté</th>
				  <th style="background:rgb(103, 58, 183);color:white">Enregistré par</th>
			  </tr>
		  </thead>
		  <tbody id="ajax-load-list-med">
			  <tr><td colspan=12><div class="windows8">
				  <div id="followingBallsG">
				  <div id="followingBallsG_1" class="followingBallsG">
				  </div>
				  <div id="followingBallsG_2" class="followingBallsG">
				  </div>
				  <div id="followingBallsG_3" class="followingBallsG">
				  </div>
				  <div id="followingBallsG_4" class="followingBallsG">
				  </div>
				  </div></td></tr>
		  </tbody>  
		  
	  </table>
  </div>
</div>
</span>

<div class="row">
  <div class="large-12 columns"><h3>Ajout rapide</h3></div>
</div>
<form id="add-to-db" method="POST">
<div class="row">
      <div class="large-4 columns">
		  <select id="id_fournisseur" name="num_fiche">
			  <?php
			  $sql = "SELECT * FROM numero_liste WHERE state = 'active'";
			  foreach ($conn->query($sql) as $row) {
				  print '<option value="' . $row['num_fiche'] . '">' .'Liste N° >> '. $row['num_fiche'] . '</option>'; // Fill out all fournisseurs in a drop-down
			  }
			  ?>
		  </select>
	  </div>
	  <div class="large-4 columns">
		  <input id="equiv_generique" name="doc_consult" type="text" placeholder="Archive consulté"><br>
	  </div>
	  <div class="large-4 columns">
		  <input id="equiv_generique" name="heure_entree" type="time" placeholder="Heure d'entrée"><br>
	  </div>
</div>
<div class="row">
       <div class="large-4 columns">
		  <select id="id_fournisseur" name="mat_consult">
			  <?php
			  $sql = "SELECT * FROM consultant";
			  foreach ($conn->query($sql) as $row) {
				  print '<option value="' . $row['mat_consult'] . '">' .$row['nom_consult'] . '</option>'; // Fill out all fournisseurs in a drop-down
			  }
			  ?>
		  </select>
	  </div>
	  <div class="large-4 columns">
		  <select id="id_fournisseur" name="mat_biblio">
			  <?php
			  $sql = "SELECT * FROM bibliothecaire";
			  foreach ($conn->query($sql) as $row) {
				  print '<option value="' . $row['mat_biblio'] . '">' .$row['nom_biblio'] . '</option>'; // Fill out all fournisseurs in a drop-down
			  }
			  ?>
		  </select>
	  </div>
	  <div class="large-4 columns">
		  <input id="equiv_generique" name="heure_sortie" type="time" placeholder="Heure de sortie"><br>
	  </div>
</div>
<div class="row">
    <div class="large-4 columns">
		  <input id="equiv_generique" name="date_consult" type="date" placeholder="Date de consultation"><br>
	  </div>
    </div>
<div class="row">
	<div class="large-4 columns">
			<a href="javascript:void(0)" id="print" class="large-12 radius button">Imprimer</a>
	</div>

	<button type="submit" class="large-4 columns button alert radius">Ajouter</button>
</div>
</form>
	  
	
<script> 

$(document).ready(function(){
	
	//Clear the form
	jQuery.fn.emptyMyForm = function(){
	    return this.each(function(){
					$('#id_med_field').show().val('');
					$('#nom_med_field').show().val('');
					$('#equiv_generique, #agents_actifs, #maladie_traitee, #prix, #id_fournisseur').val('');
				
		});
	};

	$('#add-to-db').emptyMyForm();

	//Grab the table of medicines by Ajax
	$('#ajax-load-list-med').hide().load('ajax/afficher-consultations.php').fadeIn();

	$('#add-to-db').on('submit', function() {
		$.ajax({
		  url:'ajax/inserer-consultation-ajax.php',
		  data:$(this).serialize(),
		  type:'POST',
		  success:function(data){
			  $('#outcome').prepend(data).fadeIn();
			  $('#ajax-load-list-med').fadeOut().load('ajax/afficher-consultations.php').fadeIn();
		  	}
		});
		
		return false;
	});

	$('#print').click(function(){
        var display_setting="toolbar=no, location=no, directories=no, menubar=no";  
        display_setting += "scrollbars=no, width=500, height=500, left=100, top=25";  

        var content_innerhtml = document.getElementById("printout").innerHTML;  
        var document_print=window.open("","",display_setting);  
    
	    document_print.document.open();  
        document_print.document.write('<body style="font-family:verdana; font-size:12px;" onLoad="self.print();self.close();" >');  
        document_print.document.write(content_innerhtml);  
        document_print.document.write('</body></html>');  
        document_print.print();  
        document_print.document.close(); 
	
		return false;
	});
});
</script>