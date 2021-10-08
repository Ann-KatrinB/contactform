<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Kontaktformular</title>

		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>

		<style>
			#form {border-top:#F0F0F0 2px solid; background:#FAF8F8; padding:10px;}
			#form div{margin-bottom: 15px}
			#form div label{margin-left: 5px}
			.form-group{padding:10px; border:#F0F0F0 1px solid; border-radius:4px;}
			.success{background-color: #8a8a8a; border:#757575 1px solid; padding: 5px 10px; border-radius:4px;}
			.info{font-size:.8em;color: #FF6600; letter-spacing:2px; padding-left:5px;}
			.btn{background-color:#2FC332; border:0; padding:10px 40px; color:#FFF; border:#F0F0F0 1px solid; border-radius:4px;}
		</style>
	</head>
	<body>
		<div id="form">
			<div class="row">

				<div class="col-md-9">
					<div class="contact-info">
						<h2>Kontaktformular</h2>
					</div>
				</div> <!-- div 'col-md-9' -->

				<div class="col-md-8">
				<form action="<?php echo htmlspecialchars($_SERVER['SCRIPT_NAME']);?>" method="POST" id="formular" name="formular">
					
					<div class="form-group">
						<label class="control-label col-sm-2" for="firma">Firma*:</label>
						<span id="firma-info" class="info"></span><br/>
						<div class="col-sm-10"> 
						<input type="text" class="form-control" id="firma" placeholder="Firmenname eingeben" name="firma">
						</div>
					</div> <!-- FIRMA EINGABE -->

					<div class="form-group">
						<label class="control-label col-sm-2" for="name">Name*:</label>
						<span id="name-info" class="info"></span><br/>
						<div class="col-sm-10"> 
						<input type="text" class="form-control" id="name" placeholder="Name eingeben" name="name">
						</div>
					</div> <!-- NAME EINGABE -->

					<div class="form-group">
						<label class="control-label col-sm-2" for="email">Email*:</label>
						<span id="email-info" class="info"></span><br/>
						<div class="col-sm-10"> 
						<input type="text" class="form-control" id="email" placeholder="Email eingeben" name="email">
						</div>
					</div> <!-- EMAIL EINGABE -->

					<div class="form-group">
						<label class="control-label col-sm-2" for="comment">Kommentar*:</label>
						<span id="comment-info" class="info"></span><br/>
						<div class="col-sm-10"> 
						<textarea class="form-control" id="comment" placeholder="Hinterlassen Sie einen Kommentar" rows="5" name="comment"></textarea>
						</div>
					</div> <!-- KOMMENTAR EINGABE -->

					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-default" id="submit" name="submit">Senden</button>
						
							<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
							</div>
						</div>
					</div>
				</form>
				</div> <!-- div 'col-md-8' -->
			</div> <!-- div 'row' -->
		</div> <!-- div 'form' -->
	</body>
</html>

<script>
$(document).ready(function() {
	$('#formular').submit(function(event) {
				
	event.preventDefault();

		var valid;
		valid = validate();

		if(valid == true) {
			
			$.ajax ({
				url: 'data_insert.php',
				method: 'POST',
				data: $(this).serialize(),
				cache: false,
				datatype: 'json',
				success: function(response) {
					var response = JSON.parse(response);

					if(response.statusCode==200) {
						$('#formular').find('input:text').val('');
						$("#success").show();
						$('#success').html('Daten wurden hinzugefügt!'); 						
					}
					else if(response.statusCode==201){
						$("#success").show();
						$('#success').html('Fehler bei der Datenübertragung!'); 
					}
				} //success
			}); //ajax
		}

		//VALIDIERUNG - FEHLER HINWEIS
		function validate() {
			var valid = true;

			$(".form-control").css('background-color','');
			$(".info").html(''); //entfernt das '(benötigt)', wenn befüllt
	
			if(!$("#firma").val()) {
				$("#firma-info").html("<b>(ben&oumltigt)</b>");
				$("#firma").css('background-color','#FFFFDF');
				valid = false;
			}
			if(!$("#name").val()) {
				$("#name-info").html("<b>(ben&oumltigt)</b>");
				$("#name").css('background-color','#FFFFDF');
				valid = false;
			}
			if(!$("#email").val()) {
				$("#email-info").html("<b>(ben&oumltigt)</b>");
				$("#email").css('background-color','#FFFFDF');
				valid = false;
			}
			if(!$("#email").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
				$("#email-info").html("<b>(fehlerhaft)</b>");
				$("#email").css('background-color','#FFFFDF');
				valid = false;
			}
			if(!$("#comment").val()) {
				$("#comment-info").html("<b>(ben&oumltigt)</b>");
				$("#comment").css('background-color','#FFFFDF');
				valid = false;
			}

			return valid;
		} //function validate

	}); //submit function

}); //document ready function
</script>