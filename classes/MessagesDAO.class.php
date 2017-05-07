<?php
	include_once('DatabaseDAO.class.php');

	class MessagesDAO extends DatabaseDAO
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function put($exp, $dest, $obj, $contenu)
		{
			$requete = $this->bdd->prepare('INSERT INTO ' . $this->getTableName() . '(idExpediteur, idDestinataire, date_message, objet, contenu) VALUE(:exp, :dest, NOW(), :obj, :contenu)');
			$requete->execute(array('exp' => $exp,
									'dest' => $dest,
									'obj' => $obj,
									'contenu' => $contenu)) or die(print_r($requete->errorInfo(), true));
		}

		public function getCrossMembres($id)
		{
			$requete = $this->bdd->prepare('SELECT date_message, objet, contenu, pseudo FROM ' . $this->getTableName() . ' JOIN membres WHERE idDestinataire = :dest AND membres.ID = messages.idExpediteur');
			$requete->execute(array('dest' => $id,)) or die(print_r($supp->errorInfo(), true));

			return $requete;
		}
		
		public function getTableName()
		{
			return "messages";
		}
	}
?>