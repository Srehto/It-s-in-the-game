<?php
	session_start();
	include_once('../classes/Membre.class.php');
	include_once('../classes/DatabaseDAO.class.php');
	include_once('../classes/MembreDAO.class.php');
	include_once('../classes/AssistanceDAO.class.php');
	include_once('../classes/SuggestionDAO.class.php');
	include_once('../classes/ContactDAO.class.php');
	include_once('../classes/Date.class.php');
	include_once('../htmlpurifier/HTMLPurifier.auto.php');

	if(!isset($_SESSION['membre']))
		header('Location: ../');
	$membre = unserialize($_SESSION['membre']);
	if(!$membre->isAdmin())
		header('Location: ../');

	controler_reponses($membre);
?>

<!DOCTYPE html>
<html lang="fr" >

	<head>
		<?php
		include("../static/linkcss.php");
		if(isset($_GET['type']) AND $_GET['type'] == 'membres')
		{
			?><link rel="stylesheet" href="membres.css" /><?php
		}
		else
		{
			?><link rel="stylesheet" href="messages.css" /><?php
		}
		?>
		<link rel="stylesheet" href="admin.css" />
		<link rel="stylesheet" href="../style/widget.css" />
		<link rel="shortcut icon" type="image/png" href="../style/images/icones/favicon.png">
		<title>Administration</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
		<style type="text/css">
			#corps
			{
				background-image : url("<?php echo '../style/images/fonds/custom/' . $membre->getFond() . '.jpg'; ?>");
			}
		</style>
   </head>
   

   
   <body>
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<!-------------------------------------------------------------------------------- HEADER ----------------------------------------------------------------------->
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<div id="menu">
			<a id="retour" href="../"><img src="../style/images/icones/ic_reply.png"/></a>
			<a class="rubrique" href="?type=membres"/>Membres</a>
			<a class="rubrique" href="?type=assi"/>Assistance</a>
			<a class="rubrique" href="?type=sugg"/>Suggestions</a>
			<a class="rubrique" href="?type=cont">Messages divers</a>
		</div>
		
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<!-------------------------------------------------------------------------------- CORPS ------------------------------------------------------------------------->
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<section id="corps">
			<div id="boite">
			<?php afficher_contenu(); ?>
			</div>
		</section>
   </body>
</html>

<?php

	function afficher_contenu()
	{
		if(isset($_GET['del']))
			supprimer_membre($_GET['del']);
		else if(isset($_GET['del_assi']))
			supprimer_assistance($_GET['del_assi']);
		else if(isset($_GET['del_sugg']))
			supprimer_suggestion($_GET['del_sugg']);
		else if(isset($_GET['del_cont']))
			supprimer_contact($_GET['del_cont']);

		if(isset($_GET['type']))
		{
			switch($_GET['type'])
			{
				case 'membres':
					afficher_membres();
					break;
				case 'assi':
					afficher_assistance();
					break;
				case 'sugg':
					afficher_suggestions();
					break;
				case 'cont':
					afficher_contacts();
					break;
				
				default:
					afficher_explications();
					break;
			}
		}
		else
			afficher_explications();
	}


	function afficher_membres()
	{
		$bdd = new MembreDAO();
		$requete = $bdd->get();
		
		while($donnees = $requete->fetch())
		{
			?>
			<span class="membre">
				<span class="en-tete">
					<span class="infos pseudo"><?php echo $donnees['pseudo'] ?></span>
					<span class="infos mail">E-mail : <?php echo $donnees['mail'] ?></span>
					<span class="infos mdp">Mot de passe : <?php echo $donnees['mdp'] ?></span>
				</span>
				<img class="avatar" src="../membres/avatars/<?php echo $donnees['avatar'] ?>" />
				<a class="del bouton" href="?type=membres&del=<?php echo $donnees['ID'] ?>">Supprimer</a>
			</span>
			<?php
		}

		$requete->closeCursor();
	}


	function afficher_assistance()
	{
		$bdd = new AssistanceDAO();
		$requete = $bdd->getCrossMembres();
		
		while($donnees = $requete->fetch())
		{
			?>
			<form class="message <?php echo ($donnees['vu'])? 'vu' : '' ?>" method="post" action="./">
				<span class="en-tete">
					<span class="infos pseudo"><?php echo $donnees['pseudo'] ?></span>
					<img class="avatar" src="../membres/avatars/<?php echo $donnees['avatar'] ?>" />
					<span class="infos mail"><?php echo $donnees['mail'] ?></span>
				</span>
				<span class="body_mess">
					<span class="objet">Jeu concerné : <?php echo $donnees['jeu'] ?></span>
					<span class="date">le <?php echo Date::toString($donnees['date_message']); ?></span>
					<span class="contenu"><?php echo $donnees['probleme'] ?></span>
					<?php
					if($donnees['commentaire'] != NULL)
					{?>
						<span class="contenu">Commentaires supplémentaires : <?php echo $donnees['commentaire'] ?></span>
					<?php } ?>
					<input type="hidden" name="idAssi" value="<?php echo $donnees['assistance'] ?>">
					<input type="hidden" name="idDest" value="<?php echo $donnees['membre'] ?>">
					<input type="hidden" name="objet" value="Réponse à la demande d'assistance du <?php echo Date::toString($donnees['date_message']); ?>">
					<textarea class="editText" id="reponse" name="reponse" rows="6" placeholder="R&eacute;ponse" required></textarea>
				</span>
				<input class="rep bouton" type="submit" value="Répondre"/>
				<a class="del bouton" href="?type=assi&del_assi=<?php echo $donnees['ID'] ?>">Supprimer</a>
			</form>
			<?php
		}

		$requete->closeCursor();
	}


	function afficher_suggestions()
	{
		$bdd = new SuggestionDAO();
		$requete = $bdd->getCrossMembres();
		
		while($donnees = $requete->fetch())
		{
			?>
			<form class="message <?php echo ($donnees['vu'])? 'vu' : '' ?>" method="post" action="./">
				<span class="en-tete">
					<span class="infos pseudo"><?php echo $donnees['pseudo'] ?></span>
					<img class="avatar" src="../membres/avatars/<?php echo $donnees['avatar'] ?>" />
					<span class="infos mail">E-mail : <?php echo $donnees['mail'] ?></span>
				</span>
				<span class="body_mess">
					<span class="objet">Jeu concerné : <?php echo $donnees['jeu'] ?></span>
					<span class="contenu"><?php echo $donnees['suggestion'] ?></span>
					<input type="hidden" name="idSugg" value="<?php echo $donnees['suggID'] ?>">
					<input type="hidden" name="idDest" value="<?php echo $donnees['membre'] ?>">
					<input type="hidden" name="objet" value="Réponse à la suggestion du <?php echo Date::toString($donnees['date_message']); ?>">
					<textarea class="editText" id="reponse" name="reponse" rows="6" placeholder="R&eacute;ponse" required></textarea>
				</span>
				<input class="rep bouton" type="submit" value="Répondre"/>
				<a class="del bouton" href="?type=sugg&del_sugg=<?php echo $donnees['suggID'] ?>">Supprimer</a>
			</form>
			<?php
		}

		$requete->closeCursor();
	}


	function afficher_contacts()
	{
		$bdd = new ContactDAO();
		$requete = $bdd->getCrossMembres();
		
		while($donnees = $requete->fetch())
		{
			?>
			<form class="message <?php echo ($donnees['vu'])? 'vu' : '' ?>" method="post" action="./">
				<span class="en-tete">
					<span class="infos pseudo"><?php echo $donnees['pseudo'] ?></span>
					<img class="avatar" src="../membres/avatars/<?php echo $donnees['avatar'] ?>" />
					<span class="infos mail">E-mail : <?php echo $donnees['mail'] ?></span>
				</span>
				<span class="body_mess">
					<span class="contenu"><?php echo $donnees['message'] ?></span>
					<input type="hidden" name="idCont" value="<?php echo $donnees['contact'] ?>">
					<input type="hidden" name="idDest" value="<?php echo $donnees['membre'] ?>">
					<input type="hidden" name="objet" value="Réponse au message du <?php echo Date::toString($donnees['date_message']); ?>">
					<textarea class="editText" id="reponse" name="reponse" rows="6" placeholder="R&eacute;ponse" required></textarea>
				</span>
				<input class="rep bouton" type="submit" value="Répondre"/>
				<a class="del bouton" href="?type=cont&rep=<?php echo $donnees['contact'] ?>">Supprimer</a>
			</form>
			<?php
		}

		$requete->closeCursor();
	}

	function supprimer_membre($id)
	{
		$bdd = new MembreDAO();
		$bdd->banir($id);

		?>
		<div id="info_del"><?php echo $donnees['pseudo'] ?>, inscrit le <?php echo Date::toString($donnees['date_inscription']) ?> vient d'être supprimé.</div>
		<?php
	}

	function supprimer_assistance($id)
	{
		$bdd = new AssistanceDAO();
		$bdd->delete($id);

		?>
		<div id="info_del">La demande d'assistance vient d'être supprimé.</div>
		<?php
	}

	function supprimer_suggestion($id)
	{
		$bdd = new SuggestionDAO();
		$bdd->delete($id);

		?>
		<div id="info_del">La suggestion vient d'être supprimé.</div>
		<?php
	}

	function supprimer_contact($id)
	{
		$bdd = new ContactDAO();
		$bdd->delete($id);

		?>
		<div id="info_del">Le message vient d'être supprimé.</div>
		<?php
	}


	function afficher_explications()
	{
		?>
		<p id="explications">Sélectionnez dans le menu, le type de données que vous souhaitez administrer.</p>
		<?php
	}


	function controler_reponses($membre)
	{
		$config = HTMLPurifier_Config::createDefault(); 
		$config->set('Core.Encoding', 'ISO-8859-15'); 
		$config->set('Cache.DefinitionImpl', null);
		$config->set('HTML.Allowed', '');
		$purifier = new HTMLPurifier($config);

		if(isset($_POST['idDest']) AND isset($_POST['objet']) AND isset($_POST['reponse']))
		{
			$membre->envoyer_message($_POST['idDest'], $_POST['objet'], $_POST['reponse']);

			if(isset($_POST['idAssi']))
			{
				$bdd = new AssistanceDAO();
				$bdd->setVu($purifier->purify($_POST['idAssi']));
				header('Location:?type=assi');
			}
			else if(isset($_POST['idSugg']))
			{
				$bdd = new SuggestionDAO();
				$bdd->setVu($purifier->purify($_POST['idSugg']));
				header('Location:?type=sugg');
			}
			else if(isset($_POST['idCont']))
			{
				$bdd = new ContactDAO();
				$bdd->setVu($purifier->purify($_POST['idCont']));
				header('Location:?type=cont');
			}
		}
	}
?>