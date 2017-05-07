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

				Cette documentation est destin�e aux d�veloppeurs d�sireux de mettre en avant leurs jeux gr�ce � notre plateforme online.

				<li class="rubrique_doc">Uploader son jeu</li>
				Vous pourrez uploader votre jeu via le menu d'upload de votre espace membre (� venir).<br/>
				Votre jeu doit �tre sous la forme d'un dossier compress�, contenant un fichier principal (html ou php) et d'autres fichiers inclus par ce dernier.<br/>
				Il n'y a pas de limite au nombre de fichiers, ou leur taille (fichiers multim�dias compris).<br/>
				Le fichier principal doit avoir exactement le m�me nom que le dossier.<br/>
				Ce nom sera celui par lequel sera connu votre jeu par les joueurs.<br/>
				Ce nom doit �tre unique, si un jeu poss�dant d�j� ce nom existe, vous devrez en utiliser un autre sinon votre jeu sera refus� par notre �quipe.<br/>
				Votre dossier sera �tudi� par notre �quipe, s'il est valid� et mit en ligne, vous en serez avertis via le menu d'upload de jeux de votre espace membre.

				<li class="rubrique_doc">Gestion des scores</li>
				La gestion des scores se fait en JavaScript.
				Pour vous servir du module g�rant les scores vous devez au pr�alable inclure le fichier <span class="guillemets">"games.js"</span> comme ceci :
				<span class="guillemets">"../tools/games.js"</span>, 
				en consid�rant que le fichier dans lequel vous l'incluez se trouve � la racine de votre dossier.
				<ul>
					<li class="sous-rubrique_doc">Enregistrer un score</li>
						Lorsque vous voulez enregistrer un score, la fonction � utiliser est <span class="guillemets">"enregistrer_score(jeu, valeur, niveau, callback)"</span> avec :
						jeu, le nom de votre jeu,
						score, le score � enregistrer,
						niveau, le niveau atteind par le joueur (mettre 0 si facultatif)
						et callback la fonction de callback � utiliser une fois les donn�es enregistr�es.

					<li class="sous-rubrique_doc">R�cup�rer le meilleur score</li>
						Pour r�cup�rer le meilleur score, la fonction � utiliser est "write_best_score(jeu, order)" avec :
						jeu, le nom de votre jeu,
						order, �gal � <span class="guillemets">"min"</span> ou <span class="guillemets">"max"</span> pour respectivement r�cup�rer le score minimum ou maximum.
						et callback(score, niveau) la fonction de callback � passer pour utiliser les param�tres qui lui seront transmit.

					<li class="sous-rubrique_doc">r�cup�rer les 10 meilleurs score</li>
						Pour se faire, la fonction � utiliser est <span class="guillemets">"get_10_bests_score(jeu, callback)"</span> avec :
						jeu, le nom du jeu,
						et callback(donnees) la fonction � passer pour utiliser les donn�es.
						Le param�tre de la fonction �tant un tableau de tableaux assossiatifs d'index <span class="guillemets">"score"</span> et <span class="guillemets">"niveau"</span>.
				</ul>
			</ul>
		</section>
		
		
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<!---------------------------------------------------------------------------- PIED DE PAGE ------------------------------------------------------------------->
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<?php include("static/footer.php"); ?>
	</body>
</html>