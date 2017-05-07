<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="fr" >

	<head>
		<?php include("static/linkcss.php"); ?>
		<link rel="stylesheet" href="style/plan.css" />
		<link rel="shortcut icon" type="image/png" href="style/images/icones/favicon.png">
		<title>PLan du site</title>
   </head>


   
   <body>
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<!-------------------------------------------------------------------------------- HEADER ----------------------------------------------------------------------->
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<?php include("static/header.php"); ?>
		
		
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<!-------------------------------------------------------------------------------- CORPS ------------------------------------------------------------------------->
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<section id="corps">

			<div id="fond">
			
				<div id="canvas">

					<div id="titre_plan">Plan du site</div>
					
					<ul id="plan">
						<li> <a href="jeux.php" class="rubrique">Jeux</a> </li>

						<li> <a href="documentation.php" class="rubrique">Documentation</a> </li>

						<li>
							<a class="rubrique">Support</a>
							<ul>
								<li> <a href="support-technique.php">Support technique</a> </li>
								<li> <a href="suggestions.php">Suggestions</a> </li>
								<li> <a href="nous-contacter.php">Nous contacter</a> </li>
							</ul>
						</li>

						<li>
							<a class="rubrique">Plus</a>
							<ul>
								<li> <a href="a-propos.php">À propos</a> </li>
							</ul>
						</li>

						<li>
							<a href="./" class="rubrique">Espace membre</a>
							<ul>
								<li> <a href="membres/">Accueil</a> </li>
								<li> <a href="games.php">Jeux</a> </li>
								<li> <a href="membres/?display=scores">Scores</a> </li>
								<li> <a href="membres/?display=mess">Messages</a> </li>
								<li> <a href="membres/?display=param">Paramètres</a> </li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</section>
		
		
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<!---------------------------------------------------------------------------- PIED DE PAGE ------------------------------------------------------------------->
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<?php include("static/footer.php"); ?>
   
   </body>
</html>