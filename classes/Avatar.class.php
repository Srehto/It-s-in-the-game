<?php

	class Avatar
	{
		public static function traiter_avatar($membre, $fichier_avatar)
		{
			/***** Détection d'une éventuelle erreur *****/
			
			if($fichier_avatar['error'] != 0)
				return Erreur::$ERREUR_UPLOAD;
			
			if($fichier_avatar['size'] > 1000000)
				return Erreur::$ERREUR_TALLER;
			
			if($fichier_avatar['size'] < 500)
				return Erreur::$ERREUR_SMALLER;
			
			$extension = pathinfo($fichier_avatar['name'])['extension'];
			
			if(!in_array($extension, array('png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG', 'gif')))
				return Erreur::$ERREUR_TYPE;
			
			Avatar::enregistrer_avatar($membre, $extension);
			return Erreur::$PAS_ERREUR;
		}

		public static function enregistrer_avatar($membre, $extension)
		{
			/***** Suppression de l'ancien avatar *****/
			$fichier = 'membres/avatars/' . $membre->getAvatar();
			if(file_exists($fichier))
				unlink($fichier);
			/***** Suppression de l'ancien avatar *****/

			move_uploaded_file($_FILES['avatar']['tmp_name'], 'membres/avatars/' . $membre->getId() . '.' . $extension);
			
			/***** Affectation du nouvel avatar *****/
			$membre->setAvatar($membre->getId() . '.' . $extension); // Même si le nom ne change pas, l'extension peut changer alors on le fait à chaque fois
			$_SESSION['membre'] = serialize($membre);
			/***** Affectation du nouvel avatar *****/
		}
		
		public static function afficher_erreur_avatar($erreur)
		{
			switch($erreur->getErreur())
			{
			case Erreur::$ERREUR_UPLOAD:
				?><span class="avertissement"><p>Erreur upload.</p></span><?php
				break;
			case Erreur::$ERREUR_TALLER:
				?><span class="avertissement"><p>Fichier trop volumineux.<br/>Votre fichier ne doit pas dépasser 1Mo.</p></span><?php
				break;
			case Erreur::$ERREUR_SMALLER:
				?><span class="avertissement"><p>Fichier trop petit. Votre fichier ne doit pas être inférieur à 500 octets.</p></span><?php
				break;
			case Erreur::$ERREUR_TYPE:
				?><span class="avertissement"><p>Type de fichier non autorisé.</p></span><?php
				break;
			default:
				?><span class="succes"><p>L'avatar a été enregistré avec succès.</p></span><?php
			}
		}
	}
	
?>