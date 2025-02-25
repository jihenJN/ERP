-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 27 oct. 2022 à 12:12
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
-- Base de données : `cod`
--

-- --------------------------------------------------------

--
-- Structure de la table `commercials`
--

CREATE TABLE `commercials` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `mp` varchar(255) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `soldedepart` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commercials`
--

INSERT INTO `commercials` (`id`, `name`, `login`, `mp`, `categorie_id`, `soldedepart`) VALUES
(1, 'USINE', 'USINE', 'USINE', 3, 0),
(2, 'LASSAAD KHANNOUSI', 'LASSAAD', 'LASSAAD', 5, 0),
(3, 'ISSAM BEN YAHIA', 'ISSAM', 'ISSAM', 2, 0),
(4, 'ALI BEN HAJ YAHIA ', 'ALI', 'ALI', 3, 0),
(21, 'sami', '258', '222', 4, 0),
(38, 'hechemm', 'hechembn', '121212', 2, 0),
(48, 'hhhh', 'hhh', '3545345', 1, NULL),
(49, 'test ', 'test', 'test', 1, NULL),
(50, 'test2', 'test2', 'test2', 3, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commercials`
--
ALTER TABLE `commercials`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commercials`
--
ALTER TABLE `commercials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
