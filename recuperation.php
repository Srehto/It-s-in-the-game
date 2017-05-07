<?php
	session_start();
	
	include_once("classes/Membre.class.php");
	include_once("classes/MembreDAO.class.php");

	if(isset($_SESSION['membre']))
		header('Location: ./index.php');
?>
<!DOCTYPE html>
<html lang="fr" >

	<head>
		<?php include("static/linkcss.php"); ?>
		<link rel="stylesheet" href="style/recuperation.css" />
		<link rel="shortcut icon" type="image/png" href="style/images/icones/favicon.png">
		<title>It's in the game</title>
   </head>

   .0
 0   <body>
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<!-------------------------------------------------------------------------------- HEADER ----------------------------------------------------------------------->
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<?php include("static/header.php"); ?>

		
		
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<!-------------------------------------------------------------------------------- CORPS ------------------------------------------------------------------------->
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<section id="corps">

			<?php
			if(isset($_POST['recup']) AND isset($_POST['mail']))
			{
				if($_POST['recup'] == 'mail')
					Membre::envoyer_mail_mdp($_POST['mail']);
				else if($_POST['recup'] == 'quest')
				{
					$bdd = new MembreDAO();
					$membre = $bdd->getMembreByMail($_POST['mail']);
					if($membre != null)
					{
						?>
						<form method="post" action="./recuperation.php?">
							<p><?php echo $membre['question']; ?></p>
							<input type="hidden" name="mail" value="<?php echo $_POST['mail']; ?>"/>
							<input type="text" name="reponse" class="editText" placeholder="Réponse secrète" required/>
							<input type="submit" class="bouton"/>
						</form>
						<?php
					}
					else
						echo 'Cette adresse mail n\'existe pas sur nos serveurs';
				}
			}
			else if(isset($_POST['reponse']) AND isset($_POST['mail']))
			{
				$bdd = new MembreDAO();
				$membre = $bdd->getMembreByMail($_POST['mail']);
				if($membre != null AND $membre['reponse'] == $_POST['reponse'])
					echo 'Voici votre mot de passe : ' . $membre['mdp'];
				else
					echo 'Votre réponse est erronée';
			}
			else
			{
				?>
				<section>
					<p>Choisissez votre moyen de récupération préféré.</p>

					<form method="post" action="recuperation.php">
						<input type="email" class="editText" name="mail" placeholder="Adresse mail" required/>
						<span class="champ">
							<input type="radio" name="recup" value="mail" id="radioMail" />
							<label for="radioMail" class="label-radio">Récupérer mon mot de passe par mail</label>
						</span>

						<span class="champ">
							<input type="radio" name="recup" value="quest" id="radioQuest" checked="checked"/>
							<label for="radioQuest" class="label-radio">Récupérer mon mot de passe avec ma question secrète</label>
						</span>

						<input type="submit" class="bouton"/>
					</form>
				</section>
				<?php
			}
			?>
			
		</section>
		
		
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<!---------------------------------------------------------------------------- PIED DE PAGE ------------------------------------------------------------------->
		<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<?php include("static/footer.php"); ?>
	
	</body>
</html>