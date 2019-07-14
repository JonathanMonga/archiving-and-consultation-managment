<span id="printout">
<div class="row">
   
  <div class="large-10 push-3 columns">
	  <h1>Consultants</h1>
	  <p>Depuis cette interface vous pouvez gérer les consultants.</p>
  </div>

</div>



<div class="row">

  <div class="large-12 columns">
	  <table>
		  <thead>
			  <tr>
			      <th style="background:rgb(103, 58, 183);color:white">Matricule du consultant</th>
				  <th style="background:rgb(103, 58, 183);color:white">Nom du consultant</th>
				  <th style="background:rgb(103, 58, 183);color:white">Promotion</th>
				  <th style="background:rgb(103, 58, 183);color:white">Faculté</th>
				  <th style="background:rgb(103, 58, 183);color:white">Institution</th>
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
		  <input id="id_med_field" name="mat_consult" style="" type="text" placeholder="Matricule du consultant">
	  </div>
	  <div class="large-4 columns">
		  <input id="equiv_generique" name="nom_consult" type="text" placeholder="Nom du consultant"><br>
	  </div>
	  <div class="large-4 columns">
		  <select id="id_fournisseur" name="prom_consult">
			  <option value="G1">G1</option>';
			  <option value="G2">G2</option>';
			  <option value="G3">G3</option>';
			  <option value="L1">L1</option>';
			  <option value="L2">L2</option>';
		  </select>
	  </div>
</div>
<div class="row">
	<div class="large-4 columns">
		<input id="nom_med_field" name="fac_consult" style="" type="text" placeholder="Faculté"><br>
	</div>
	<div class="large-4 columns">
		<input id="agents_actifs" name="inst_consult" type="text" placeholder="Institution"><br>
	</div>
	<div class="large-4 columns">
		
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
	$('#ajax-load-list-med').hide().load('ajax/afficher-consultants.php').fadeIn();

	$('#add-to-db').on('submit', function() {
		$.ajax({
		  url:'ajax/inserer-consultant-ajax.php',
		  data:$(this).serialize(),
		  type:'POST',
		  success:function(data){
			  $('#outcome').prepend(data).fadeIn();
			  $('#ajax-load-list-med').fadeOut().load('ajax/afficher-consultants.php').fadeIn();
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