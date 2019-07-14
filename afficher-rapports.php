<span id="printout">
<div class="row">
   
  <div class="large-10 push-3 columns">
	  <h1>Rapports</h1>
	  <p>Depuis cette interface vous pouvez gérer les rapports.</p>
  </div>

</div>



<div class="row">

  <div class="large-12 columns">
	  <table>
		  <thead>
			  <tr>
			      <th style="background:rgb(103, 58, 183);color:white">N°</th>
				  <th style="background:rgb(103, 58, 183);color:white">Date</th>
				  <th style="background:rgb(103, 58, 183);color:white">Effectif</th>
				  <th style="background:rgb(103, 58, 183);color:white">Observation</th>
				  <th style="background:rgb(103, 58, 183);color:white">Elaboré par</th>
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
		  <h3>
		    <?php
			   require "connect.php";

               $sql = "SELECT COUNT(*) as nombre FROM liste_consultation WHERE date_consult = CURRENT_DATE"; 
               foreach ($conn->query($sql) as $row) { 
                    echo $row['nombre'] <= 1 ? $row['nombre']." Consultation" : $row['nombre']." Consultations"; 
                }
            ?>
		   </h3>
	  </div>
	  <div class="large-4 columns">
		  <input id="id_med_field" name="observation" style="" type="text" placeholder="Observation">
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
</div>

<div class="row">
	<div class="large-4 columns">
			<a href="javascript:void(0)" id="print" class="large-12 radius button">Imprimer</a>
	</div>

	<button type="submit" class="large-4 columns button alert radius">Ajouter</button>

	<div class="large-4 columns">
		  <?php
			   require "connect.php";

               $sql = "SELECT COUNT(*) as nombre FROM liste_consultation WHERE date_consult = CURRENT_DATE"; 
			   
			    foreach ($conn->query($sql) as $row) { 
                    print '<input name="effectif" type="hidden" value="'.$row['nombre'].'"';
                }
            ?>
	  </div>
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
	$('#ajax-load-list-med').hide().load('ajax/afficher-rapports.php').fadeIn();

	$('#add-to-db').on('submit', function() {
		$.ajax({
		  url:'ajax/inserer-rapport-ajax.php',
		  data:$(this).serialize(),
		  type:'POST',
		  success:function(data){
			  $('#outcome').prepend(data).fadeIn();
			  $('#ajax-load-list-med').fadeOut().load('ajax/afficher-rapports.php').fadeIn();
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