-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mer. 18 jan. 2023 à 09:58
-- Version du serveur :  5.5.68-MariaDB
-- Version de PHP :  7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mtderp_isolmaxcom`
--

-- --------------------------------------------------------

--
-- Structure de la table `releves`
--

CREATE TABLE `releves` (
  `id` int(11) NOT NULL,
  `numclt` varchar(255) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `numero` varchar(50) DEFAULT NULL,
  `type` text,
  `typeimp` text,
  `debit` decimal(18,3) DEFAULT NULL,
  `credit` decimal(18,3) DEFAULT NULL,
  `impaye` decimal(18,3) DEFAULT NULL,
  `reglement` decimal(18,3) DEFAULT NULL,
  `avoir` decimal(18,3) DEFAULT NULL,
  `solde` decimal(18,3) DEFAULT NULL,
  `exercice_id` int(11) DEFAULT NULL,
  `typ` varchar(255) DEFAULT NULL,
  `nbligneimp` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `releves`
--
ALTER TABLE `releves`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `releves`
--
ALTER TABLE `releves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
