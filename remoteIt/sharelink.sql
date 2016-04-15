-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Lun 10 Décembre 2012 à 16:44
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `sharelink`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `utilisateur` int(10) unsigned NOT NULL,
  `titre` varchar(256) NOT NULL,
  `commentaire` text NOT NULL,
  `date` datetime NOT NULL,
  `lien` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `liens`
--

CREATE TABLE IF NOT EXISTS `liens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(256) NOT NULL,
  `utilisateur` int(11) unsigned NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL,
  `visite` int(10) unsigned NOT NULL,
  `url` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `liens`
--

INSERT INTO `liens` (`id`, `titre`, `utilisateur`, `description`, `date`, `visite`, `url`) VALUES
(1, 'Le site du zÃ©ro', 1, 'Le site du zÃ©ro est idÃ©ale pour tous les dÃ©butants en informatique!', '2012-11-12 16:17:50', 32, 'http://www.siteduzero.com/'),
(2, 'Code Source', 1, 'CommunautÃ© d''informaticiens. Vous y trouverez emplois, tutoriels, et bien d''autres.', '2012-07-09 16:20:48', 28, 'http://www.codes-sources.com/'),
(3, 'Sprites Ressource', 2, 'Sprites gratuits pour tous vos jeux vidÃ©os. Jeunes programmeurs Profitez en !!!', '2012-11-30 16:27:43', 10, 'http://spriters-resource.com/'),
(5, 'Photoshop C6', 5, 'A tous les infographes! Le meilleur logiciel c''est par ici!!! Et c''est gratuit!', '2012-12-10 16:33:20', 0, 'http://www.clubic.com/telecharger-fiche9635-adobe-photoshop-cs6.html'),
(8, 'Picasa', 5, 'Ce logiciel est vraiment gÃ©nial! Je l''utilise pour toutes mes retouches photo! Essayez le!', '2012-12-10 16:41:18', 3, 'http://picasa.google.com/');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(256) DEFAULT NULL,
  `nom` varchar(256) DEFAULT NULL,
  `prenom` varchar(256) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `motdepasse` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `identifiant`, `nom`, `prenom`, `email`, `motdepasse`) VALUES
(1, 'wandjiew', 'WANDJIE', 'Wilfried', 'wandjiewil@yahoo.fr', 'e7236697824fb37763235980f1061218'),
(2, 'jamel', 'CHENDJOUO', 'Jamel', 'Jamelst@yahoo.fr', 'f95775c206420ac8b94d480aaf60b34d'),
(3, '8thWonder', 'KAMDOUM', 'Sandra', 'Ksandra@hotmail.com', 'f40a37048732da05928c3d374549c832'),
(4, 'MF', 'BALLA', 'Ines', 'Balla@hotmail.com', 'ea81aa7df47d74c6737bf98fabf3ff82'),
(5, 'The8thBall', 'AVALAYE', 'Sabine', 'Sabineavalaye@yahoo.fr', 'e668ab336799b9f36c47f8ce3c738d79'),
(6, 'rhesus', 'NKENFACK', 'Edgard', 'Rhesus@yahoo.fr', '7d4396bcc7e10c47e0e0dfadb2cc2397'),
(7, 'Harry', 'MAMBOU', 'Harry', 'Mambah@yahoo.fr', '3b87c97d15e8eb11e51aa25e9a5770e9'),
(8, 'Francine', 'KAMSU', 'Francine', 'Kamfr@yahoo.fr', '2430242dc52b9fec75095457ac808899'),
(9, 'Ruch', 'RUCHAUD', 'William', 'Ruchwill@hotmail.fr', '1108feac5870f819156e035bd223a1c2'),
(10, 'ronald', 'NAFAK', 'Ronald', 'Ronaldo@hotmail.fr', '5af0a0feb2094f43bebb50c518c1ebfe'),
(11, 'Ruth', 'NGOKO', 'Ruth', 'Ruth@yahoo.fr', '81ea66d57d6b827ef722f4f20f8a669c');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
