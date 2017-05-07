<?php
	include_once('DatabaseDAO.class.php');

	class MembreDAO extends DatabaseDAO
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function put($pseudo, $mdp, $mail, $question, $reponse)
		{
			$requete = $this->bdd->prepare('INSERT INTO ' . $this->getTableName() . '(pseudo, mdp, mail, question, reponse, date_inscription) VALUE(:pseudo, :mdp, :mail, :quest, :rep, NOW())');
			$requete->execute(array('pseudo' => $pseudo,
									'mdp' => $mdp,
									'mail' => $mail,
									'quest' => $question,
									'rep' => $reponse)) or die(print_r($requete->errorInfo(), true));
		}

		public function getMembre($pseudo, $mdp)
		{
			$req = $this->bdd->prepare('SELECT * FROM ' . $this->getTableName() . ' WHERE pseudo = :pseudo AND mdp = :mdp');
			$req->execute(array('pseudo' => $pseudo,
									'mdp' => $mdp)) or die(print_r($requete->errorInfo(), true));
			return $req;
		}

		public function getMembreByMail($mail)
		{
			$req = $this->bdd->prepare('SELECT * FROM ' . $this->getTableName() . ' WHERE mail = :mail');
			$req->execute(array('mail' => $mail)) or die(print_r($requete->errorInfo(), true));
			return $req->fetch();
		}

		public function existsPseudo($pseudo)
		{
			$requete = $this->bdd->prepare('SELECT * FROM ' . $this->getTableName() . ' WHERE pseudo = :pseudo');
			$requete->execute(array('pseudo' => $pseudo)) or die(print_r($requete->errorInfo(), true));
			return $requete->fetch() != NULL;
		}

		public function modifyBackground($id, $fond)
		{
			$requete = $this->bdd->prepare('UPDATE ' . $this->getTableName() . ' SET fond = :fond WHERE ID = :id');
			$requete->execute(array('fond' => $this->fond,
									'id' => $this->id)) or die(print_r($requete->errorInfos(), true));
		}

		public function banir($id)
		{
			$requete = $this->bdd->prepare('DELETE FROM ' . $this->getTableName() . ' WHERE id = :id');
			$requete->execute(array('id' => $id)) or die(print_r($requete->errorInfo(), true));
		}
		
		public function getTableName()
		{
			return "membres";
		}
	}
?>