<?php
	include_once('DatabaseDAO.class.php');

	class SuggestionDAO extends DatabaseDAO
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function put($id_membre, $jeu, $suggestion)
		{
			$requete = $this->bdd->prepare('INSERT INTO ' . SuggestionDAO::getTableName() . '(id_membre, date_message, jeu, suggestion) VALUE(:id_membre, NOW(), :jeu, :suggestion)');
			$requete->execute(array('id_membre' => $id_membre,
									'jeu' => $jeu,
									'suggestion' => $suggestion)) or die(print_r($requete->errorInfo(), true));
		}

		public function getCrossMembres()
		{
			$requete = $this->bdd->prepare('SELECT suggestions.ID as suggID, date_message, jeu, suggestion, vu, membres.ID as membre, pseudo, mail, avatar FROM ' . $this->getTableName() . ' JOIN membres WHERE suggestions.id_membre = membres.ID');
			$requete->execute() or die(print_r($supp->errorInfo(), true));

			return $requete;
		}

		public function setVu($id)
		{
			$req = $this->bdd->prepare('UPDATE ' . $this->getTableName() . ' SET vu = 1 WHERE ID = :id');
			$req->execute(array('id' => $id)) or die(print_r($supp->errorInfo(), true));
		}
		
		public function getTableName()
		{
			return "suggestions";
		}
	}
?>