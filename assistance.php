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
		<title>Assistance technique</title>
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
					?> <h1>Votre problème a bien été soumis</h1> <?php
				}
			?>
		
			<h1>Assistance</h1>

			<form method="post" action="assistance.php">
				<div id="sep_formulaire"></div>
				<p>
					<input type="hidden" name="type" value="assistance" />
					
					<fieldset>
						
						<select class="liste" name="jeu">
							<option value="hanoi">Hanoï</option>
							<option value="autre">autre</option>
						</select></br></br>
						
						<textarea class="editText" name="probleme" id ="probleme" rows="5" cols="40" placeholder="Détaillez le problème" required></textarea></br>
						
						<textarea class="editText" name="commentaire" id ="commentaires" rows="5" cols="40" placeholder="Commentaires supplémentaires"></textarea></br>
					
						<input class="bouton" type="submit" value="Envoyer" id="envoyer"/
						
					</fieldset>
				</p>
				<div id="sep_formulaire"></div>
			</form>
		</section>
		
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<!---------------------------------------------------------------------------- PIED DE PAGE ------------------------------------------------------------------->
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<?php include("static/footer.php"); ?>

   </body>
</html>