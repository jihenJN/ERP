-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2022 at 12:31 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `isoft_codifaerp`
--

-- --------------------------------------------------------

--
-- Table structure for table `bureaupostes`
--

CREATE TABLE `bureaupostes` (
  `id` int(11) NOT NULL,
  `gouvernorat_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `codepostal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bureaupostes`
--

INSERT INTO `bureaupostes` (`id`, `gouvernorat_id`, `name`, `codepostal`) VALUES
(1, 2, 'tunis Cartage', '2035'),
(2, 2, 'cite Ennasr Ariana', '2001'),
(3, 2, 'Borj Baccouch', '2027'),
(4, 2, 'Soukra', '2036'),
(5, 2, 'Ariana', '2080'),
(6, 2, 'Ariana geant', '2002'),
(7, 2, 'Menzah 6', '2091'),
(8, 2, 'cite la Gazelle', '2083'),
(9, 7, 'Mjaz elbab ', '9070'),
(10, 7, 'Teboursouk', '9040'),
(11, 7, 'Beja', '9000'),
(12, 7, 'Dougga', '9032'),
(13, 1, 'Rades Medina', '2098'),
(14, 1, 'Mhamdia', '1145'),
(15, 1, 'Hammam Lif', '2050'),
(16, 1, 'Rades', '2040'),
(17, 1, 'Ezzahra', '2034'),
(18, 1, 'Ben Arous', '2013'),
(19, 1, 'Erislaa', '2044'),
(20, 1, 'Ezzahra El Habib', '2065'),
(21, 1, 'Nouvelle Medina', '2063'),
(22, 1, 'Mourouj 1', '2074'),
(23, 1, 'Merouj 3', '2068'),
(24, 1, 'Megrin Riadh', '2014'),
(25, 1, 'Mornag', '2090'),
(26, 1, 'Megrine', '2033'),
(27, 3, 'Bizert', '7000'),
(28, 3, 'Ras Djebel', '7070'),
(29, 3, 'Bizert bab mater', '7061'),
(30, 3, 'Menzel Bourgiba', '7050'),
(31, 3, 'MZL Bourgiba Ennajah', '7072'),
(32, 3, 'Mateur', '7030'),
(33, 3, 'Manzel jemil', '7080'),
(34, 5, 'gabes hached', '6001'),
(35, 5, 'Gabes B-bhar', '6000'),
(36, 5, 'Cite El Amel', '6033'),
(37, 5, 'El Hamma', '6020'),
(38, 5, 'Mereth', '6080'),
(39, 10, 'Gafsa', '2100'),
(40, 10, 'Gafsa Cite Ennour', '2123'),
(41, 10, 'Gafsa Intilaka', '2117'),
(42, 10, 'Metlaoui', '2130'),
(43, 10, 'El Guettar', '2180'),
(44, 10, 'Errdayef', '2120'),
(45, 10, 'Gafsa gare', '2111'),
(46, 20, 'bouhajla', '3180'),
(47, 20, 'Kairouan Okba', '3140'),
(48, 20, 'Kairaqouan Sud', '3131'),
(49, 20, 'Kairaqouan ', '3100'),
(50, 20, 'Ouseltia', '3120'),
(51, 20, 'Hajeb Laayoune', '3160'),
(52, 20, 'Cite Hajjem', '3129'),
(53, 20, 'Cherarda', '3116'),
(54, 20, 'Cite Ennaser Kairouan', '3182'),
(55, 20, 'Cite lbn Jazzar', '3199'),
(56, 20, 'Haffouz', '3130'),
(57, 11, 'Sbiba', '1270'),
(58, 11, 'Feryana', '1240'),
(59, 11, 'Tela', '1210'),
(60, 11, 'Kasserine', '1200'),
(61, 11, 'Sbeitla', '1250'),
(62, 25, 'Douz', '4260'),
(63, 25, 'Keblil', '4200'),
(64, 25, 'Keblil Biez', '4280'),
(65, 25, 'Souk lahad', '4230'),
(66, 6, 'Dahmani', '7170'),
(67, 6, 'Kef', '7100'),
(68, 6, 'Terjerouin', '7150'),
(69, 6, 'Kef Ouest', '7117'),
(70, 9, 'Hekaima', '5131'),
(71, 9, 'Mahdia Republique', '5150'),
(72, 9, 'Chebba', '5170'),
(73, 9, 'Mahdia', '5100'),
(74, 9, 'mahdia hiboun', '5111'),
(75, 9, 'Ksour Essef', '5180'),
(76, 9, 'Souassi', '5140'),
(77, 9, 'El Jamm', '5160'),
(78, 16, 'Tebourba', '1130'),
(79, 16, 'Mornaguia', '1110'),
(80, 16, 'Denden', '2011'),
(81, 16, 'Mannouba', '2010'),
(82, 18, 'El May', '4175'),
(83, 18, 'Ajim', '4135'),
(84, 18, 'Mouensa', '4144'),
(85, 18, 'Midoun', '4116'),
(86, 18, 'Zarzis', '4170'),
(87, 18, 'Medenie', '4100'),
(88, 18, 'Jerba', '4180'),
(89, 18, 'Jerba Aeroport', '4120'),
(90, 18, 'Cedouikech', '4145'),
(91, 18, 'Akrou', '4176'),
(92, 18, 'Benguerden', '4160'),
(93, 18, 'Souihel', '4173'),
(94, 23, 'Ksar Hellal', '5070'),
(95, 23, 'Moknine', '5050'),
(96, 23, 'Jammel', '5020'),
(97, 23, 'Monastir', '5000'),
(98, 23, 'Ksar Hlel Riadh', '5016'),
(99, 23, 'Monastir Republique', '5060'),
(100, 23, 'Teboulba', '5080'),
(101, 19, 'Kelibia', '8090'),
(102, 19, 'yasmine hammamet', '8057'),
(103, 19, 'nabeul thameur', '8062'),
(104, 19, 'Beni khiar', '8060'),
(105, 19, 'Korba', '8070'),
(106, 19, 'Mrezga', '8058'),
(107, 19, 'Soliman', '8020'),
(108, 19, 'Grombalia', '8030'),
(109, 19, 'Dar Chaaban Fehri', '8011'),
(110, 19, 'Hammamet', '8050'),
(111, 19, 'Manzel Temim', '8080'),
(112, 19, 'Nabeul', '8000'),
(113, 17, 'merkez chihiya', '3041'),
(114, 17, 'Merkez Bouacida', '3031'),
(115, 17, 'cite El Habib', '3052'),
(116, 17, 'Sidi Abbes', '3062'),
(117, 17, 'Sfax Jadida', '3027'),
(118, 17, 'markez el alia', '3051'),
(119, 17, 'Sfax 15 Novembre', '3089'),
(120, 17, 'cite Khayri', '3079'),
(121, 17, 'Cite Bahri', '3064'),
(122, 17, 'Esskhira', '3050'),
(123, 17, 'sfax', '3000'),
(124, 17, 'Karkena', '3070'),
(125, 17, 'sfax Hached', '3069'),
(126, 17, 'El Boustene', '3099'),
(127, 17, 'tyna', '3083'),
(128, 17, 'El Aguereb', '3030'),
(129, 17, 'Sakiet Ezzit', '3021'),
(130, 17, 'jbeniyana', '3080'),
(131, 17, 'El Hencha', '3010'),
(132, 17, 'Sfax Maghreb Arabe', '3049'),
(133, 17, 'EL Mahres', '3060'),
(134, 17, 'Sakiet Eddaier', '3011'),
(135, 8, 'Benaoun', '9120'),
(136, 8, 'Bir El Hfay', '9113'),
(137, 8, 'jimla', '9110'),
(138, 8, 'Meknasi', '9140'),
(139, 8, 'Ergueb', '9170'),
(140, 8, 'Sidi Bou Zid', '9100'),
(141, 12, 'Makthar', '6140'),
(142, 12, 'Bouarada', '6180'),
(143, 12, 'Siliana', '6100'),
(144, 12, 'Rouhia', '6150'),
(145, 22, 'Enfidha', '4030'),
(146, 22, 'Sousse Khzema', '4051'),
(147, 22, 'Hammam Sousse', '4011'),
(148, 22, 'Hammam Sousse plage', '4083'),
(149, 22, 'Kalla Kebira', '4060'),
(150, 22, 'Sousse', '4000'),
(151, 22, 'Sahloul', '4054'),
(152, 22, 'Sousse Corniche', '4059'),
(153, 22, 'Hammam Sousse Gharbi', '4017'),
(154, 22, 'Msaken', '4070'),
(155, 22, 'Sousse lbn Khaldoun', '4061'),
(156, 22, 'Sousse erriadh', '4023'),
(157, 22, 'Kantaoui', '4089'),
(158, 24, 'Tataouine mahrajene', '3234'),
(159, 24, 'tataouine Ettahrir', '3263'),
(160, 23, 'Ghomrassen', '3220'),
(161, 23, 'Tataouin', '3200'),
(162, 21, 'Nefta', '2240'),
(163, 21, 'Dguech', '2260'),
(164, 21, 'Tozeure', '2200'),
(165, 21, 'Tozeur chokrasti', '2210'),
(166, 15, 'Zahrouni', '2051'),
(167, 15, 'Cite Mahragene', '1082'),
(168, 15, 'Sidi Hassine', '1095'),
(169, 15, 'Mohamed V', '1023'),
(170, 15, 'Tunis RP', '1000'),
(171, 15, 'Tunis Republique', '1001'),
(172, 15, 'Monplaisir', '1073'),
(173, 15, 'El Manar ||', '2092'),
(174, 15, 'Berge du Lac', '1053'),
(175, 15, 'Tunisi Thameur', '1069'),
(176, 15, 'Cartage', '2016'),
(177, 15, 'Marsa Safsaf', '2078'),
(178, 15, 'Tunis belvedere', '1002'),
(179, 15, 'Bardo', '2000'),
(180, 15, 'Tunis Hached', '1049'),
(181, 15, 'cite El Mhiri', '2045'),
(182, 15, 'cite Rommana', '1068'),
(183, 15, 'cite Ezzouhour', '2052'),
(184, 15, 'Bab Menara', '1008'),
(185, 15, 'bab el khadhra', '1075'),
(186, 15, 'Tunis aeroport', '2079'),
(187, 15, 'El Menzah', '1004'),
(188, 15, 'bab Souika', '1006'),
(189, 15, 'cite El khadra', '1003'),
(190, 13, 'El Fahs', '1140'),
(191, 13, 'Bir Mcherga', '1141'),
(192, 13, 'zaghouan', '1100'),
(193, 13, 'lbel El WEst', '1111'),
(194, 13, 'hammam zriba', '1152'),
(195, 13, 'Ennadhour', '1160'),
(198, 4, 'Ain Drahem', '8130'),
(199, 4, 'Bousalem', '8170'),
(200, 4, 'Tabarka', '8110'),
(201, 4, 'Jendouba', '8100'),
(204, 4, 'Ghardimaou', '8160');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bureaupostes`
--
ALTER TABLE `bureaupostes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bureaupostes`
--
ALTER TABLE `bureaupostes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
