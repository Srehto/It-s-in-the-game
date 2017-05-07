<?php
	session_start();

	include_once("classes/Support.class.php");
	
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
		<title>Suggestions</title>
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
					?> <h1>Votre suggestion a bien été enregistrée</h1> <?php
				}
			?>
		
			<h1>Suggestion</h1>
			
			<form method="post" action="suggestions.php">
				<p>
					<input type="hidden" name="type" value="suggestion" />
					
					<fieldset>
						
						<select class="liste" name="jeu">
							<option value="hanoi">Hanoï</option>
							<option value="autre">Autre</option>
						</select></br>
						
						<textarea class="editText" name="suggestion" rows="10" cols="40" placeholder="Suggestion" required></textarea></br>
						
						<input class="bouton" type="submit" value="Envoyer"/>
							
					</fieldset>
					
				</p>
			</form>
		</section>
		
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<!---------------------------------------------------------------------------- PIED DE PAGE ------------------------------------------------------------------->
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<?php include("static/footer.php"); ?>

   </body>
</html>