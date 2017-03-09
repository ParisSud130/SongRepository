-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 08 Mars 2017 à 15:07
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `song_repository`
--

-- --------------------------------------------------------

--
-- Structure de la table `trame`
--
DROP TABLE IF EXISTS `trame`;
CREATE TABLE `trame` (
  `idTrame` int(11) NOT NULL,
  `dateModification` datetime NOT NULL,
  `dateExecution` date NOT NULL,
  `propriétaire` int(11) NOT NULL,
  `commentaire` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `trame_chant`
--

DROP TABLE IF EXISTS `trame_chant`;
CREATE TABLE `trame_chant` (
  `idTrame` int(11) NOT NULL,
  `idChant` int(11) NOT NULL,
  `ordre` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `trame_chant_strophe`
--

DROP TABLE IF EXISTS `trame_chant_strophe`;
CREATE TABLE `trame_chant_strophe` (
  `idTrame` int(11) NOT NULL,
  `idChant` int(11) NOT NULL,
  `idStrophe` int(11) NOT NULL,
  `ordre` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `trame`
--
ALTER TABLE `trame`
  ADD PRIMARY KEY (`idTrame`);

--
-- Index pour la table `trame_chant`
--
ALTER TABLE `trame_chant`
  ADD PRIMARY KEY (`idTrame`,`idChant`);

--
-- Index pour la table `trame_chant_strophe`
--
ALTER TABLE `trame_chant_strophe`
  ADD PRIMARY KEY (`idTrame`,`idChant`,`idStrophe`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
