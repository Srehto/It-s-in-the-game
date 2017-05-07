<?php
	include_once('DatabaseDAO.class.php');

	class AssistanceDAO extends DatabaseDAO
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function put($id_membre, $jeu, $probleme, $commentaire)
		{
			$requete = $this->bdd->prepare('INSERT INTO ' . $this->getTableName() . '(id_membre, date_message, jeu, probleme, commentaire) VALUE(:id_membre, NOW(), :jeu, :probleme, :commentaire)');
			$requete->execute(array('id_membre' => $id_membre,
									'jeu' => $jeu,
									'probleme' => $probleme,
									'commentaire' => $commentaire)) or die(print_r($requete->errorInfo(), true));
		}

		public function getCrossMembres()
		{
			$requete = $this->bdd->prepare('SELECT assistance.ID as assistance, date_message, jeu, probleme, commentaire, vu, membres.ID as membre, pseudo, mail, avatar FROM ' . $this->getTableName() . ' JOIN membres WHERE assistance.id_membre = membres.ID');
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
			return "assistance";
		}
	}
?>