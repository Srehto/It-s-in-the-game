<?php
session_start();
	
?>
<!DOCTYPE html>
<html lang="fr" >

	<head>
		<?php include("static/linkcss.php"); ?>
		<link rel="stylesheet" href="style/documentation.css" />
		<link rel="shortcut icon" type="image/png" href="style/images/icones/favicon.png">
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
		<title>Documentation API</title>
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

			<ul id="canvas_documentation">
			
				<h1>Documentation</h1>

				Cette documentation est destinée aux développeurs désireux de mettre en avant leurs jeux grâce à notre plateforme online.

				<li class="rubrique_doc">Uploader son jeu</li>
				Vous pourrez uploader votre jeu via le menu d'upload de votre espace membre (à venir).<br/>
				Votre jeu doit être sous la forme d'un dossier compressé, contenant un fichier principal (html ou php) et d'autres fichiers inclus par ce dernier.<br/>
				Il n'y a pas de limite au nombre de fichiers, ou leur taille (fichiers multimédias compris).<br/>
				Le fichier principal doit avoir exactement le même nom que le dossier.<br/>
				Ce nom sera celui par lequel sera connu votre jeu par les joueurs.<br/>
				Ce nom doit être unique, si un jeu possédant déjà ce nom existe, vous devrez en utiliser un autre sinon votre jeu sera refusé par notre équipe.<br/>
				Votre dossier sera étudié par notre équipe, s'il est validé et mit en ligne, vous en serez avertis via le menu d'upload de jeux de votre espace membre.

				<li class="rubrique_doc">Gestion des scores</li>
				La gestion des scores se fait en JavaScript.
				Pour vous servir du module gérant les scores vous devez au préalable inclure le fichier <span class="guillemets">"games.js"</span> comme ceci :
				<span class="guillemets">"../tools/games.js"</span>, 
				en considérant que le fichier dans lequel vous l'incluez se trouve à la racine de votre dossier.
				<ul>
					<li class="sous-rubrique_doc">Enregistrer un score</li>
						Lorsque vous voulez enregistrer un score, la fonction à utiliser est <span class="guillemets">"enregistrer_score(jeu, valeur, niveau, callback)"</span> avec :
						jeu, le nom de votre jeu,
						score, le score à enregistrer,
						niveau, le niveau atteind par le joueur (mettre 0 si facultatif)
						et callback la fonction de callback à utiliser une fois les données enregistrées.

					<li class="sous-rubrique_doc">Récupérer le meilleur score</li>
						Pour récupérer le meilleur score, la fonction à utiliser est "write_best_score(jeu, order)" avec :
						jeu, le nom de votre jeu,
						order, égal à <span class="guillemets">"min"</span> ou <span class="guillemets">"max"</span> pour respectivement récupérer le score minimum ou maximum.
						et callback(score, niveau) la fonction de callback à passer pour utiliser les paramètres qui lui seront transmit.

					<li class="sous-rubrique_doc">récupérer les 10 meilleurs score</li>
						Pour se faire, la fonction à utiliser est <span class="guillemets">"get_10_bests_score(jeu, callback)"</span> avec :
						jeu, le nom du jeu,
						et callback(donnees) la fonction à passer pour utiliser les données.
						Le paramètre de la fonction étant un tableau de tableaux assossiatifs d'index <span class="guillemets">"score"</span> et <span class="guillemets">"niveau"</span>.
				</ul>
			</ul>
		</section>
		
		
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<!---------------------------------------------------------------------------- PIED DE PAGE ------------------------------------------------------------------->
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<?php include("static/footer.php"); ?>
	</body>
</html>