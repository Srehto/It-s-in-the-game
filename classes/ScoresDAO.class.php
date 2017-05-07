<?php
	include_once('DatabaseDAO.class.php');

	class ScoresDAO extends DatabaseDAO
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function put($id_membre, $jeu, $score, $niveau)
		{
			$requete = $this->bdd->prepare('INSERT INTO ' . $this->getTableName() . '(id_membre, jeu, score, niveau, date_score) VALUE(:id_membre, :jeu, :score, :niveau, NOW())');
			$requete->execute(array('id_membre' => $id_membre,
									'jeu' => $jeu,
									'score' => $score,
									'niveau' => $niveau)) or die(print_r($requete->errorInfo(), true));
		}

		public function getCrossMembres()
		{
			$requete = $this->bdd->prepare('SELECT scores.ID as scoreID, id_membre, jeu, score, date_score, membres.ID as membreID, pseudo, mail, avatar FROM ' . $this->getTableName() . ' JOIN membres WHERE scores.id_membre = membres.ID');
			$requete->execute() or die(print_r($supp->errorInfo(), true));

			return $requete;
		}
		
		public function getJeux()
		{
			$requete = $this->bdd->prepare('SELECT DISTINCT jeu FROM ' . $this->getTableName());
			$requete->execute() or die(print_r($supp->errorInfo(), true));

			return $requete;
		}
		
		public function getScoresByJeuOrderByScore($id, $jeu)
		{
			$requete = $this->bdd->prepare('SELECT * FROM ' . $this->getTableName() . ' WHERE id_membre = :id AND jeu = :jeu ORDER BY niveau DESC, score');
			$requete->execute(array('id' => $id,
									'jeu' => $jeu)) or die(print_r($supp->errorInfo(), true));

			return $requete;
		}
		
		public function getMeilleursScoresByJeu($jeu)
		{
			$requete = $this->bdd->prepare('SELECT * FROM ' . $this->getTableName() . ' WHERE jeu = :jeu ORDER BY niveau DESC, score LIMIT 10');
			$requete->execute(array('jeu' => $jeu)) or die(print_r($supp->errorInfo(), true));

			return $requete;
		}
		
		public function getNiveauMaxScoreMax($id, $jeu)
		{
			$requete = $this->bdd->prepare('SELECT MIN(score) AS score, niveau FROM ' . $this->getTableName() . ' WHERE niveau = (SELECT MAX(niveau) FROM scores WHERE jeu = :jeu AND id_membre = :id)');
			$requete->execute(array('id' => $id,
									'jeu' => $jeu)) or die(print_r($supp->errorInfo(), true));

			return $requete->fetch();
		}
		
		public function getNiveauMaxScoreMin($id, $jeu)
		{
			$requete = $this->bdd->prepare('SELECT MIN(score) AS score, niveau FROM ' . $this->getTableName() . ' WHERE niveau = (SELECT MAX(niveau) FROM scores WHERE jeu = :jeu AND id_membre = :id)');
			$requete->execute(array('id' => $id,
									'jeu' => $jeu)) or die(print_r($supp->errorInfo(), true));

			return $requete->fetch();
		}

		public function getTableName()
		{
			return "scores";
		}
	}
?>