<?php
	session_start();

	include_once("classes/Support.class.php");
	include_once("classes/Erreur.class.php");
	
	if(!isset($_SESSION['membre']))
		header('Location: index.php');
	$membre = unserialize($_SESSION['membre']);
?>
<!DOCTYPE html>
<html lang="fr" >

	<head>
		<?php include("static/linkcss.php"); ?>
		<link rel="stylesheet" href="style/formulaire.css" />
		<link rel="stylesheet" href="style/widget.css" />
		<link rel="shortcut icon" type="image/png" href="style/images/icones/favicon.png">
		<title>Nous contacter</title>
   </head>
   

   
   <body>
   
   		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<!-------------------------------------------------------------------------------- HEADER ----------------------------------------------------------------------->
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<?php include("static/header.php"); ?>
		

		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<!-------------------------------------------------------------------------------- CORPS ------------------------------------------------------------------------->
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<section id= "corps">
			
			<?php
				if(isset($_POST['type']) AND Support::traiter_message($membre, $_POST['type']) == Erreur::$PAS_ERREUR)
				{
					?> <h1>Votre message a bien été transmis</h1> <?php
				}
			?>
		
			<h1>Contactez nous</h1>
			
			<form method="post" action="contact.php">
				<p>
					<input type="hidden" name="type" value="contact" />
					
					<fieldset>
						
						<textarea class="editText" name="message" id ="message" rows="10" cols="40" placeholder="Message" required></textarea>
					
						<input class="bouton" type="submit" value="Envoyer" id="envoyer" />
					</fieldset><br/>
				</p>
			</form>
		</section>
		
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<!---------------------------------------------------------------------------- PIED DE PAGE ------------------------------------------------------------------->
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<?php include("static/footer.php"); ?>

   </body>
</html>