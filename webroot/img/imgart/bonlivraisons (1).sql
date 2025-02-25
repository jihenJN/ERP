-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 29 sep. 2022 à 09:20
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `isoft_codifa`
--

-- --------------------------------------------------------

--
-- Structure de la table `bonlivraisons`
--

CREATE TABLE `bonlivraisons` (
  `id` int(11) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `client_id` int(11) NOT NULL,
  `pointdevente_id` int(11) NOT NULL,
  `depot_id` int(11) NOT NULL,
  `materieltransport_id` int(11) NOT NULL,
  `cartecarburant_id` int(11) NOT NULL,
  `chauffeur_id` int(11) NOT NULL,
  `convoyeur_id` int(11) NOT NULL,
  `totalht` decimal(10,3) NOT NULL,
  `totalttc` decimal(10,3) NOT NULL,
  `totalfodec` decimal(10,3) NOT NULL,
  `totalremise` decimal(10,3) NOT NULL,
  `totaltva` decimal(10,3) NOT NULL,
  `factureclient_id` int(11) NOT NULL,
  `kilometragedepart` double DEFAULT NULL,
  `kilometragearrive` double DEFAULT NULL,
  `adresselivraisonclient_id` int(11) DEFAULT NULL,
  `payementcomptant` varchar(255) DEFAULT NULL,
  `poste` int(11) NOT NULL,
  `tpe` decimal(10,3) NOT NULL,
  `escompte` varchar(11) NOT NULL,
  `commande_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `bonlivraisons`
--

INSERT INTO `bonlivraisons` (`id`, `numero`, `date`, `client_id`, `pointdevente_id`, `depot_id`, `materieltransport_id`, `cartecarburant_id`, `chauffeur_id`, `convoyeur_id`, `totalht`, `totalttc`, `totalfodec`, `totalremise`, `totaltva`, `factureclient_id`, `kilometragedepart`, `kilometragearrive`, `adresselivraisonclient_id`, `payementcomptant`, `poste`, `tpe`, `escompte`, `commande_id`) VALUES
(146, '000001', '2022-09-28 16:35:23', 26, 9, 1, 0, 0, 0, 0, '36020.000', '44471.360', '353.000', '8180.000', '7100.470', 50, NULL, NULL, NULL, '1', 0, '1718.290', '3', 246);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bonlivraisons`
--
ALTER TABLE `bonlivraisons`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bonlivraisons`
--
ALTER TABLE `bonlivraisons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
