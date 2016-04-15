-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 15 Janvier 2013 à 16:02
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `utilisateur`, `titre`, `commentaire`, `date`, `lien`) VALUES
(7, 14, 'Merci', 'Moi, personnellement j''ai apprÃ©cie l''idÃ©e du site web, mais je trouve qu''il faut encore du travail du cotÃ© marketing(faire connaitre l''idÃ©e).', '2013-01-15 00:56:17', 1),
(8, 2, 'Super', 'Super, shareLink.com un nom de domaine trop cool <3', '2013-01-15 01:07:38', 1),
(9, 13, 'Wawou,j''apprecie', 'Merci Mr Wandejiw pour vos idÃ©es, on va en tenir compte pour l''amÃ©lioration de shareLink dans son ensemble.', '2013-01-15 01:15:18', 1),
(10, 14, 'Salam', 'Euh Tu es trÃ¨s fort ...\r\nEuh vous etes trÃ¨s fort les gars', '2013-01-15 01:38:03', 1),
(20, 12, 'Hello', 'Je suis nouveau sur ce site, mais je propose que mÃªme les internautes puissent ajouter des commentaire. Lâ€™anonymat... ', '2013-01-15 15:38:56', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `liens`
--

INSERT INTO `liens` (`id`, `titre`, `utilisateur`, `description`, `date`, `visite`, `url`) VALUES
(1, 'Le site du zÃ©ro', 12, 'Le site du zÃ©ro est idÃ©ale pour tous les dÃ©butants en informatique!', '2012-11-12 16:17:50', 4, 'http://www.siteduzero.com/'),
(2, 'Code Source', 13, 'CommunautÃ© d''informaticiens. Vous y trouverez emplois, tutoriels, et bien d''autres.', '2012-07-09 16:20:48', 31, 'http://www.codes-sources.com/'),
(3, 'Sprites Ressource', 2, 'Sprites gratuits pour tous vos jeux vidÃ©os. Jeunes programmeurs Profitez en !!!', '2012-11-30 16:27:43', 13, 'http://spriters-resource.com/'),
(11, 'Reseau social', 14, 'La plus grande rÃ©seaux social, Restez connecter avec le monde entier', '2013-01-15 01:00:05', 0, 'https://www.facebook.com/'),
(12, 'Twitter', 12, 'Bienvenue sur Twitter.\r\nDÃ©couvrez ce qui se passe en ce moment chez les personnes et dans les organismes qui vous tiennent Ã  cÅ“ur.', '2013-01-15 01:02:40', 0, 'https://twitter.com/'),
(13, 'Comment Ã§a Marche', 13, 'Rejoignez la communautÃ© Informatique, le monde Informatique', '2013-01-15 01:33:47', 0, 'http://www.commentcamarche.net/');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `identifiant`, `nom`, `prenom`, `email`, `motdepasse`) VALUES
(2, 'adnane.berkane', 'Berkane', 'Adnane', 'adnaneberkane@yahoo.fr', 'f95775c206420ac8b94d480aaf60b34d'),
(12, 'rukundofiston', 'RUKUNDO', 'Prenom', 'rukundofiston@yahoo.com', 'ab4f63f9ac65152575886860dde480a1'),
(13, 'aamer', 'Mohamed', 'Aamer', 'mohamed.aamer@gmail.com', 'a07faaaaa1801121a846eb495fc581e9'),
(14, 'yassine', 'ELQANDILI', 'Yassine', 'yassine.elquandili@gmail.com', '5bfe0c405c67de32b1de9ea40d093666');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
