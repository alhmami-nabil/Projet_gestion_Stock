-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 29 juil. 2021 à 12:54
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
-- Base de données : `projet_fil_rouge`
--

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

DROP TABLE IF EXISTS `demande`;
CREATE TABLE IF NOT EXISTS `demande` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CIN` varchar(10) NOT NULL,
  `DateDepart` date NOT NULL,
  `DateRetour` date NOT NULL,
  `DateDemande` date NOT NULL,
  `Etat` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `demande`
--

INSERT INTO `demande` (`ID`, `CIN`, `DateDepart`, `DateRetour`, `DateDemande`, `Etat`) VALUES
(75, 'L53461', '2021-07-10', '2021-07-20', '2021-07-09', 1),
(76, 'LC291738', '2021-07-15', '2021-07-18', '2021-07-14', -1),
(77, 'L53461', '2021-07-30', '2021-08-04', '2021-07-29', 1);

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

DROP TABLE IF EXISTS `personnel`;
CREATE TABLE IF NOT EXISTS `personnel` (
  `cin` varchar(10) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `division` varchar(255) NOT NULL,
  `tel` varchar(12) NOT NULL,
  `adresse` text NOT NULL,
  `jourstot` int(2) NOT NULL,
  `joursrest` int(2) NOT NULL,
  `login` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `admin` int(1) NOT NULL,
  `email` text NOT NULL,
  PRIMARY KEY (`cin`),
  UNIQUE KEY `cin` (`cin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `personnel`
--

INSERT INTO `personnel` (`cin`, `nom`, `prenom`, `grade`, `division`, `tel`, `adresse`, `jourstot`, `joursrest`, `login`, `pass`, `admin`, `email`) VALUES
('L53461', 'Nanan', 'yassine', '2', '2', '0601849678', 'Av hafsa oum mouaminin, agg', 20, 3, 'alhmami', 'x5K6tSYYv3gfc', 0, 'alnabil175@gmail.com'),
('LC291738', 'Al hmami', 'Nabil', '1', '1', '0601849678', 'Av hafsa oum mouaminin', 20, 20, 'nabil', 'x5K6tSYYv3gfc', 1, 'alnabil175@gmail.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
