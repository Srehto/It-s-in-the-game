<?php
	include_once('DatabaseDAO.class.php');

	class ContactDAO extends DatabaseDAO
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function put($id_membre, $message)
		{
			$requete = $this->bdd->prepare('INSERT INTO ' . ContactDAO::getTableName() . '(id_membre, date_message, message) VALUE(:id_membre, NOW(), :mess)');
			$requete->execute(array('id_membre' => $id_membre,
									'mess' => $message)) or die(print_r($requete->errorInfo(), true));
		}

		public function getCrossMembres()
		{
		$requete = $this->bdd->prepare('SELECT contacts.ID as contact, date_message, message, vu, membres.ID as membre, pseudo, mail, avatar FROM ' . $this->getTableName() . ' JOIN membres WHERE contacts.id_membre = membres.ID');
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
			return "contacts";
		}
	}
?>