-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : Dim 22 mai 2022 à 21:41
-- Version du serveur :  10.6.5-MariaDB
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `omnessante`
--

-- --------------------------------------------------------

--
-- Structure de la table `cb`
--

DROP TABLE IF EXISTS `cb`;
CREATE TABLE IF NOT EXISTS `cb` (
  `Prenom` varchar(20) NOT NULL,
  `Numero` int(11) NOT NULL,
  `Type` varchar(11) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Date` date NOT NULL,
  `Code` int(4) NOT NULL,
  PRIMARY KEY (`Nom`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cb`
--

INSERT INTO `cb` (`Prenom`, `Numero`, `Type`, `Nom`, `Date`, `Code`) VALUES
('Adrien', 299900000, 'Mastercard', 'Cailleau', '2023-06-14', 1204),
('Anouk', 300040005, 'Visa', 'Francois', '2024-01-03', 2604);

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

DROP TABLE IF EXISTS `comptes`;
CREATE TABLE IF NOT EXISTS `comptes` (
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Type` int(11) NOT NULL,
  `Login` varchar(50) NOT NULL,
  `MDP` varchar(50) NOT NULL,
  PRIMARY KEY (`Nom`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comptes`
--

INSERT INTO `comptes` (`Nom`, `Prenom`, `Type`, `Login`, `MDP`) VALUES
('Cailleau', 'Adrien', 1, 'adriencl', 'audrey'),
('Francois', 'Anouk', 1, 'nouki', 'Mattias'),
('Perez', 'Benjamin', 2, 'benjos', 'Redbull'),
('Colin', 'Cyriac', 2, 'cyrvdr', 'medecin'),
('admin', '', 3, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `labo`
--

DROP TABLE IF EXISTS `labo`;
CREATE TABLE IF NOT EXISTS `labo` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Service` varchar(20) NOT NULL,
  `Salle` int(11) NOT NULL,
  `Tel` varchar(20) NOT NULL,
  `Mail` varchar(30) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `labo`
--

INSERT INTO `labo` (`Id`, `Nom`, `Service`, `Salle`, `Tel`, `Mail`) VALUES
(1, 'plaisance', 'depistage covid', 4, '0444444444', 'plaisancelab@gmail.com'),
(2, 'biogroup', 'test sanguin', 62, '013333333333', 'biomail@gmail.com'),
(3, 'plaisance', 'cancerologie', 200, '0444444444', 'plaisancelab@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `medecins`
--

DROP TABLE IF EXISTS `medecins`;
CREATE TABLE IF NOT EXISTS `medecins` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Prenom` varchar(20) NOT NULL,
  `Spé` varchar(20) NOT NULL,
  `Salle` int(11) NOT NULL,
  `Tel` varchar(20) NOT NULL,
  `Mail` varchar(30) NOT NULL,
  `Image` varchar(20) NOT NULL,
  `Repos` varchar(10) NOT NULL,
  `Cv` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `medecins`
--

INSERT INTO `medecins` (`Id`, `Nom`, `Prenom`, `Spé`, `Salle`, `Tel`, `Mail`, `Image`, `Repos`, `Cv`) VALUES
(1, 'Perez', 'Benjamin', 'Generaliste', 23, '0611111111', 'benjamin@gmail.com', 'benjamin.jpg', 'mardi', 'benjamin.dtd'),
(2, 'Colin', 'Cyriac', 'Cardiologie', 34, '0722222222', 'cyriac@gmail.com', 'cyriac.jpg', 'jeudi', 'cyriac.dtd');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `NomM` varchar(20) NOT NULL,
  `PrenomM` varchar(20) NOT NULL,
  `NomP` varchar(20) NOT NULL,
  `PrenomP` varchar(20) NOT NULL,
  `Type` int(11) NOT NULL,
  `Message` varchar(200) NOT NULL,
  `Id` int(11) NOT NULL,
  `envoyeur` varchar(20) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`NomM`, `PrenomM`, `NomP`, `PrenomP`, `Type`, `Message`, `Id`, `envoyeur`) VALUES
('Colin', 'Cyriac', 'Cailleau', 'Adrien', 1, 'Bonjour Monsieur Cailleau. Pouvez-vous me confirmer votre présence au rendez-vous du mois prochain ?', 1, 'medecin'),
('Colin', 'Cyriac', 'Francois', 'Anouk', 2, 'Avez-vous des disponibilités début Juin ?', 0, 'patient');

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `Nom` varchar(20) NOT NULL,
  `Prenom` varchar(20) NOT NULL,
  `Tel` int(11) NOT NULL,
  `Mail` varchar(30) NOT NULL,
  `Adresse` varchar(50) NOT NULL,
  `CarteVitale` int(20) NOT NULL,
  `CB` int(20) NOT NULL,
  PRIMARY KEY (`Nom`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`Nom`, `Prenom`, `Tel`, `Mail`, `Adresse`, `CarteVitale`, `CB`) VALUES
('Cailleau', 'Adrien', 650607080, 'adrien@gmail.com', '20 rue du cheval blanc, Chatillon', 1020429443, 299900000),
('Francois', 'Anouk', 750507089, 'anouk@gmail.com', '21 rue Saint Amand, Paris', 2010963335, 300040005);

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE IF NOT EXISTS `rdv` (
  `NomM` varchar(20) NOT NULL,
  `PrenomM` varchar(20) NOT NULL,
  `NomP` varchar(20) NOT NULL,
  `PrenomP` varchar(20) NOT NULL,
  `Date` date NOT NULL,
  `Heure` time NOT NULL,
  PRIMARY KEY (`NomP`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `rdv`
--

INSERT INTO `rdv` (`NomM`, `PrenomM`, `NomP`, `PrenomP`, `Date`, `Heure`) VALUES
('plaisance', '', 'Cailleau', 'Adrien', '2022-06-06', '14:00:00'),
('Perez', 'Benjamin', 'Francois', 'Anouk', '2022-05-31', '10:30:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
