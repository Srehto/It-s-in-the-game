<?php

include_once("classes/Erreur.class.php");
include_once("classes/Membre.class.php");
include_once("classes/AssistanceDAO.class.php");
include_once("classes/SuggestionDAO.class.php");
include_once("classes/ContactDAO.class.php");
include_once('htmlpurifier/HTMLPurifier.auto.php');

class Support
{

	public static function traiter_message($membre, $type)
	{
		$config = HTMLPurifier_Config::createDefault(); 
		$config->set('Core.Encoding', 'ISO-8859-15'); 
		$config->set('Cache.DefinitionImpl', null);
		$config->set('HTML.Allowed', '');
		$purifier = new HTMLPurifier($config);

		if($type == 'assistance' AND isset($_POST['jeu']) AND isset($_POST['probleme']) AND isset($_POST['commentaire']))
		{
			$bdd = new AssistanceDAO();
			$bdd->put($membre->getId(), $purifier->purify($_POST['jeu']), $purifier->purify($_POST['probleme']), $purifier->purify($_POST['commentaire']));
			return Erreur::$PAS_ERREUR;
		}
		else if($type == 'suggestion' AND isset($_POST['jeu']) AND isset($_POST['suggestion']))
		{
			$bdd = new SuggestionDAO();
			$bdd->put($membre->getId(), $purifier->purify($_POST['jeu']), $purifier->purify($_POST['suggestion']));
			return Erreur::$PAS_ERREUR;
		}
		else if($type == 'contact' AND isset($_POST['message']))
		{
			$bdd = new ContactDAO();
			$bdd->put($membre->getId(), $purifier->purify($_POST['message']));
			return Erreur::$PAS_ERREUR;
		}
		else
			return Erreur::$ERREUR_FORM;
	}

}
?>