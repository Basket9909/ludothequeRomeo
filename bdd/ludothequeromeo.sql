-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 28 sep. 2021 à 18:53
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ludothequeromeo`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `login`, `password`) VALUES
(1, 'romeo', '$2y$10$qw4zmb6owm./4mhjL0bFQOFATCj4utzWS.w6MT7B8aZ8j11b5exjm');

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

DROP TABLE IF EXISTS `jeux`;
CREATE TABLE IF NOT EXISTS `jeux` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  `type` varchar(150) NOT NULL,
  `editeur` varchar(150) NOT NULL,
  `date` date NOT NULL,
  `image` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `jeux`
--

INSERT INTO `jeux` (`id`, `nom`, `type`, `editeur`, `date`, `image`) VALUES
(1, 'NBA2k21', 'Simulation', '2K sports', '2020-09-04', '1911921878nba2k21.jpg'),
(6, 'fifa 22', 'Simulation', 'EA sport', '2021-09-08', '2045374567fifa21.jpg'),
(7, 'Assasin\'s creed valhalla', 'RPG', 'Ubisoft', '2020-11-10', '312538770assassins.jpg'),
(8, 'Call og duty - cold war', 'Fps', 'Activision', '2020-11-13', '1287973387callof.jpg'),
(9, 'F1 2021', 'Simulation', 'EA sport', '2021-07-15', '1113709661f12021.jpg'),
(10, 'Red dead redemption 2', 'RPG', 'Rockstar Game', '2018-10-25', '769742099reddead.jpg'),
(11, 'F1 2020', 'Simulation', 'EA sport', '2020-07-05', '194338815f12020.jpg'),
(12, 'NBA2k20', 'Simulation', '2K sports', '2019-08-21', '377312138nba2k20.jpg'),
(13, 'Football Manager 2020', 'Gestion', 'Sega', '2019-10-31', '656030738footballmanager20.jpg'),
(14, 'Football Manager 2021', 'Gestion', 'Sega', '2020-11-10', '1770323600footballmanager2021cover.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
