-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 01 Novembre 2015 à 17:08
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `game`
--

-- --------------------------------------------------------

--
-- Structure de la table `assistance`
--

CREATE TABLE IF NOT EXISTS `assistance` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` int(11) NOT NULL,
  `date_message` date NOT NULL,
  `jeu` varchar(20) NOT NULL,
  `probleme` text NOT NULL,
  `commentaire` text,
  `vu` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `assistance`
--

INSERT INTO `assistance` (`ID`, `id_membre`, `date_message`, `jeu`, `probleme`, `commentaire`, `vu`) VALUES
(1, 6, '2015-09-27', 'hanoi', 'Bla', '', 1),
(2, 6, '2015-09-27', 'hanoi', 'Bla', '', 1),
(9, 6, '2015-10-03', 'hanoi', 'Coucou', '', 0),
(10, 6, '2015-10-04', 'hanoi', 'Voilà voilà', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` int(11) NOT NULL,
  `date_message` date NOT NULL,
  `message` text NOT NULL,
  `vu` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `contacts`
--

INSERT INTO `contacts` (`ID`, `id_membre`, `date_message`, `message`, `vu`) VALUES
(3, 6, '2015-09-29', 'Un petit message !', 0),
(4, 6, '2015-09-29', 'Un petit message !', 1),
(5, 6, '2015-09-29', 'Un petit message !', 0),
(6, 6, '2015-09-29', 'on peut mettre float : left et position :relative ?\r\n\r\nen fait j''ai un div avec dedans une jaquette à gauche et à droite un div contenant le titre le nom de l''auteur et une image.\r\net donc ce div à droite (qui est un float à gauche de l''image donc) comme le titre peut tenir sur une ou deux ligne il décale mon image que je voudrais aligner à l''image de gauche (je ne sais pas si je suis très clair).\r\ndonc : \r\n', 0),
(7, 6, '2015-09-29', 'Une superposition indésirable !\r\nLe souci avec cette technique est que le contenu de votre page risque de se chevaucher avec le pied de page qui se trouve superposé par-dessus.\r\n\r\nPour éviter ce chevauchement de contenu, il est nécessaire de réserver de l''espace (du padding) en bas de <body>. Par exemple un padding-bottom de 5em si mon pied de page a une hauteur de 5em.\r\n\r\nMais cela entraîne un nouveau problème conséquent : la zone de padding s''ajoute à la taille d''un élément. <body> occupe à présent une hauteur de... 100% + 5em :/\r\n\r\nLa solution réside dans la propriété CSS3 box-sizing, heureusement reconnue par l''ensemble des navigateurs depuis IE8 :', 0);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE IF NOT EXISTS `membres` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mdp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `question` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reponse` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_inscription` date NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'defaut.png',
  `fond` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'sable',
  `admin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`ID`, `pseudo`, `mdp`, `mail`, `question`, `reponse`, `date_inscription`, `avatar`, `fond`, `admin`) VALUES
(6, 'Gabriel', 'mdp', 'kaci.gabriel@yahoo.fr', 'Ami ?', 'Hoyas', '2015-09-26', '6.jpg', 'ble', 1),
(7, 'Simon', 'motdepasse', 'simon@mail.com', '', '', '2015-09-26', 'defaut.png', 'sable', 1),
(9, 'George', 'mdp', 'george@ge.or', '', '', '2015-09-29', 'defaut.png', 'sable', 0),
(14, 'John', 'mdp', 'john@jo.hn', '', '', '2015-09-29', 'defaut.png', 'sable', 0),
(15, 'test', '123', 'test.rapport@galilee.fr', NULL, NULL, '2015-10-27', 'defaut.png', 'sable', 0),
(16, 'test2', '123', 'test.rapport@galilee.fr', 'Quelle est la meilleurs matière de l''année ?', 'PWEB', '2015-11-01', 'defaut.png', 'sable', 0);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `idExpediteur` int(11) NOT NULL,
  `idDestinataire` int(11) NOT NULL,
  `date_message` date NOT NULL,
  `objet` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `vu` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`ID`, `idExpediteur`, `idDestinataire`, `date_message`, `objet`, `contenu`, `vu`) VALUES
(4, 6, 6, '2015-10-01', 'Réponse à la demande d''assistance du 27 Septembre 2015', 'Merci', 0),
(2, 7, 6, '2015-09-29', 'Coucou', 'Comment vas-tu ?', 0),
(5, 6, 6, '2015-10-01', 'Réponse à la suggestion du 01 Octobre 2015', 'Merci pour la suggestion !', 0),
(6, 6, 6, '2015-10-01', 'Réponse à la suggestion du 01 Octobre 2015', 'Merci', 0),
(7, 6, 6, '2015-10-01', 'Réponse à la suggestion du 01 Octobre 2015', 'Merci', 0),
(8, 6, 6, '2015-10-01', 'Réponse à la demande d''assistance du 27 Septembre 2015', 'D''accord', 0),
(9, 6, 6, '2015-10-01', 'Réponse à la demande d''assistance du 27 Septembre 2015', 'Ok :p', 0),
(10, 6, 6, '2015-10-01', 'Réponse à la suggestion du 01 Octobre 2015', 'Merci ! :p', 0),
(11, 6, 6, '2015-10-01', 'Réponse à la suggestion du 01 Octobre 2015', 'Effectivement !', 0);

-- --------------------------------------------------------

--
-- Structure de la table `scores`
--

CREATE TABLE IF NOT EXISTS `scores` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` int(11) NOT NULL,
  `jeu` varchar(255) NOT NULL,
  `valeur` int(11) NOT NULL,
  `niveau` int(11) DEFAULT '0',
  `date_score` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=84 ;

--
-- Contenu de la table `scores`
--

INSERT INTO `scores` (`ID`, `id_membre`, `jeu`, `valeur`, `niveau`, `date_score`) VALUES
(74, 6, 'Hanoi', 3, 2, '2015-10-07 17:45:19'),
(75, 7, 'Hanoi', 7, 3, '2015-10-07 18:11:47'),
(76, 6, 'Tuiles', 50, 6, '0000-00-00 00:00:00'),
(77, 6, 'Truc', 100, 2, '0000-00-00 00:00:00'),
(78, 6, 'Hanoi', 1, 1, '2015-10-07 18:22:16'),
(79, 6, 'Hanoi', 3, 2, '2015-10-07 18:22:22'),
(80, 6, 'Hanoi', 7, 3, '2015-10-07 18:22:35'),
(81, 6, 'Hanoi', 15, 4, '2015-10-07 18:23:12'),
(82, 6, 'Hanoi', 5, 4, '0000-00-00 00:00:00'),
(83, 15, 'Hanoi', 3, 2, '2015-10-27 17:00:34');

-- --------------------------------------------------------

--
-- Structure de la table `suggestions`
--

CREATE TABLE IF NOT EXISTS `suggestions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` int(11) NOT NULL,
  `date_message` date NOT NULL,
  `jeu` varchar(20) NOT NULL,
  `suggestion` text NOT NULL,
  `vu` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `suggestions`
--

INSERT INTO `suggestions` (`ID`, `id_membre`, `date_message`, `jeu`, `suggestion`, `vu`) VALUES
(2, 6, '2015-10-01', 'Hanoï', 'Vous devriez rajouter des animations et du drap&drop', 1),
(3, 6, '2015-10-03', 'hanoi', 'Je suggère à la dao de fonctionner ...', 0),
(4, 6, '2015-10-04', 'hanoi', 'Suggestionnons ! :D ^_^', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
