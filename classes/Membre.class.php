<?php

include_once('MembreDAO.class.php');
include_once('MessagesDAO.class.php');
include_once('Date.class.php');

class Membre
{
	private $id;
	private $pseudo;
	private $mdp;
	private $mail;
	private $dateInscription;
	private $avatar;
	private $fond;
	private $admin;
	
	
	public function __construct($donnees)
	{
		$this->id = $donnees['ID'];
		$this->pseudo = $donnees['pseudo'];
		$this->mdp = $donnees['mdp'];
		$this->mail = $donnees['mail'];
		$this->dateInscription = $donnees['date_inscription'];
		$this->avatar = $donnees['avatar'];
		$this->fond = $donnees['fond'];
		$this->admin = $donnees['admin'];
	}
	
	public function __destruct()
	{
		
	}
	

	/**************************************************************************************************************************/
	/************************************************* ACCESSEURS ET MODIFIEURS ***********************************************/
	/**************************************************************************************************************************/
	public function getId()
	{
		return $this->id;
	}
	
	public function getPseudo()
	{
		return $this->pseudo;
	}
	public function setPseudo($nouveauPseudo)
	{
		if(!empty($nouveauPseudo) AND strlen($nouveauPseudo) < 255 )
		{
			$this->pseudo = $nouveauPseudo;
			
			$bdd = Database::connexion();
			$requete = $bdd->prepare('UPDATE ' . Database::getNomTableMembres() . ' SET pseudo = :pseudo WHERE ID = :id');
			$requete->execute(array('pseudo' => $this->pseudo,
									'id' => $this->id)) or die(print_r($requete->errorInfos(), true));
		}
	}
	
	public function getMdp()
	{
		return $this->mdp;
	}
	public function setMdp($nouveauMdp)
	{
		if(!empty($nouveauMdp) AND strlen($nouveauMdp) < 255 )
		{
			$this->mdp = $nouveauMdp;
			
			$bdd = Database::connexion();
			$requete = $bdd->prepare('UPDATE ' . Database::getNomTableMembres() . ' SET mdp = :mdp WHERE ID = :id');
			$requete->execute(array('mdp' => $this->mdp,
									'id' => $this->id)) or die(print_r($requete->errorInfos(), true));
		}
	}
	
	public function getMail()
	{
		return $this->mail;
	}
	public function setMail($nouveauMail)
	{
		if(!empty($nouveauMail) AND strlen($nouveauMail) < 255 )
		{
			$this->mail = $nouveauMail;
			
			$bdd = Database::connexion();
			$requete = $bdd->prepare('UPDATE ' . Database::getNomTableMembres() . ' SET mail = :mail WHERE ID = :id');
			$requete->execute(array('mail' => $this->mail,
									'id' => $this->id)) or die(print_r($requete->errorInfos(), true));
		}
	}
	
	public function getDateInscription()
	{
		$annee = substr($this->dateInscription, 0, 4);
		$mois = Date::getMois(substr($this->dateInscription, 5, 2));
		$jour = substr($this->dateInscription, -2);
		return $jour . ' ' . $mois . ' ' . $annee;
	}
	
	public function getAvatar()
	{
		return $this->avatar;
	}
	
	public function setAvatar($nom)
	{
		$this->avatar = $nom;
		
		$bdd = Database::connexion();
		$requete = $bdd->prepare('UPDATE ' . Database::getNomTableMembres() . ' SET avatar = :avatar WHERE ID = :id');
		$requete->execute(array('avatar' => $this->avatar,
								'id' => $this->id)) or die(print_r($requete->errorInfos(), true));
	}
	
	public function getPathAvatar($espace)
	{
		switch($espace)
		{
		case 'membres':
			return 'avatars/' . $this->avatar;
		default:
			return 'membres/avatars/' . $this->avatar;
		}
	}
	
	
	public function getFond()
	{
		return $this->fond;
	}
	
	public function setFond($fond)
	{
		if(!empty($fond))
		{
			$this->fond = $fond;
			$bdd = new MembreDAO();
			$bdd->modifyBackground($this->id, $fond);
		}
	}
	
	public function isAdmin()
	{
		return $this->admin;
	}
	/**************************************************************************************************************************/
	/**************************************************************************************************************************/
	/**************************************************************************************************************************/


	/**************************************************************************************************************************/
	/**************************************************************************************************************************/
	/**************************************************************************************************************************/
	
	public function banir()
	{
		$bdd = new MembreDAO();
		$bdd->banir($this->id);
	}

	public static function inscrire($pseudo, $mdp, $mail, $question, $reponse)
	{
		$bdd = new MembreDAO();
		$bdd->put($pseudo, $mdp, $mail, $question, $reponse);
	}

	public function envoyer_message($id, $objet, $message)
	{
		$bdd = new MessagesDAO();
		$bdd->put($this->id, $id, $objet, $message);
	}

	public static function envoyerMail($mail, $objet, $txt, $html)
	{
		if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail))
			$passage_ligne = "\r\n";
		else
			$passage_ligne = "\n";
		
		$boundary = "-----=".md5(rand());
		
		$header = "From: \"It's in the game\"<mail@itsinthegame.fr>".$passage_ligne;
		$header.= "Reply-to: \"It's in the game\"<mail@itsinthegame.fr>".$passage_ligne;
		$header.= "MIME-Version: 1.0".$passage_ligne;
		$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
		
		/* Création du message */
		$message = $passage_ligne . "--" . $boundary . $passage_ligne;
		$message.= "Content-Type: text/plain; charset=\"iso-8859-15\"" . $passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
		$message.= $passage_ligne . $txt . $passage_ligne;
		
		$message = $passage_ligne . "--" . $boundary . $passage_ligne;
		$message.= "Content-Type: text/html; charset=\"iso-8859-15\"" . $passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
		$message.= $passage_ligne . $html . $passage_ligne;
		
		
		$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
		$message.= $passage_ligne."--".$boundary."--".$passage_ligne;

		mail($mail, $objet, $message, $header);
	}

	public static function envoyer_mail_inscription($mail)
	{
		$sujet = "Inscription It's in the game";
		
		$message_txt = "Bonjour, votre inscription a bien été prise en compte.";
		$message_html = "<html><head></head><body><b>Bonjour</b>, votre inscription a bien été prise en compte.</body></html>";
		
		Membre::envoyerMail($mail, $sujet, $message_txt, $message_html);
	}

	public static function envoyer_mail_mdp($mail)
	{
		$bdd = new MembreDAO();
		$membre = $bdd->getMembreByMail($mail);
		if($membre != null)
		{
			$sujet = "Récupération mot de passe It's in the game";
			
			$message_txt = "Bonjour, voici votre mot de passe.";
			$message_html = "<html><head></head><body><b>Bonjour</b>, voici votre mot de passe.</body></html>";
			
			Membre::envoyerMail($mail, $sujet, $message_txt, $message_html);
		}
		else
			echo 'Cette adresse mail n\existe pas';
	}
}

?>