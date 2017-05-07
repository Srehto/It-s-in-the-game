<?php
	abstract class DatabaseDAO
	{
		const HOST = 'mysql:host=localhost;dbname=game';
		const LOGIN = 'root';
		const PASS = '';

		protected $bdd;

		public function __construct()
		{
			try
			{
				$this->bdd = new PDO(self::HOST, self::LOGIN, self::PASS);
				$this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch (Exeption $e)
			{
				die('Erreur : ' . $e->getMessage());
			}
		}

		public function get($id = 0)
		{
			$requete;
			if($id == 0)
				$requete = $this->bdd->prepare('SELECT * FROM ' . $this->getTableName());
			else
				$requete = $this->bdd->prepare('SELECT * FROM ' . $this->getTableName() . ' WHERE ID = :id');
			$requete->execute(array('id' => $id)) or die(print_r($supp->errorInfo(), true));

			return $requete;
		}

		public function delete($id)
		{
			$requete = $bdd->prepare('DELETE FROM ' . getTableName() . ' WHERE ID = :id');
			$requete->execute(array('id' => $id)) or die(print_r($supp->errorInfo(), true));
		}
		
		public function getTableName()
		{
			return "database";
		}
	}
?>