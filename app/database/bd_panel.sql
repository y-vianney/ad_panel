-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 19, 2025 at 09:24 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_panel`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `contact` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `contact` (`contact`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `adresse`, `contact`) VALUES
(1, 'ADJUMANY', 'Yann Axel', 'Abidjan', '0102030405'),
(2, 'Zouzou', 'Patrick', 'Yopougon', '0596639774');

-- --------------------------------------------------------

--
-- Table structure for table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `montant` int NOT NULL,
  `mode` varchar(25) NOT NULL,
  `statut` varchar(25) NOT NULL,
  `reservation_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reservation_id` (`reservation_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `paiement`
--

INSERT INTO `paiement` (`id`, `date`, `montant`, `mode`, `statut`, `reservation_id`) VALUES
(3, '2025-05-17', 4464000, 'Orange Money', 'Soldé', 9);

-- --------------------------------------------------------

--
-- Table structure for table `panneau`
--

DROP TABLE IF EXISTS `panneau`;
CREATE TABLE IF NOT EXISTS `panneau` (
  `id` int NOT NULL AUTO_INCREMENT,
  `emplacement` varchar(100) NOT NULL,
  `longueur` float NOT NULL,
  `largeur` float NOT NULL,
  `type` varchar(25) NOT NULL,
  `etat` varchar(25) NOT NULL,
  `prix` int NOT NULL,
  `description` text NOT NULL,
  `reservation_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reservation_id` (`reservation_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `panneau`
--

INSERT INTO `panneau` (`id`, `emplacement`, `longueur`, `largeur`, `type`, `etat`, `prix`, `description`, `reservation_id`) VALUES
(2, 'Abidjan, Cocody', 2, 4, 'Panneaux modernes', 'Réservé', 12000, 'test', 0),
(3, 'Abidjan, Cocody', 3, 5, 'Panneaux classiques', 'Réservé', 10000, 'Ce panneau moderne, situé dans le quartier prisé de Cocody à Abidjan, offre une visibilité optimale pour vos campagnes publicitaires. Avec ses dimensions de 2 mètres sur 4, il est idéal pour capter l’attention dans un environnement urbain dynamique.', 0),
(4, 'Abidjan, Yopougon', 3, 5, 'Big size', 'Réservé', 20000, 'test', 0),
(5, 'Abidjan, Cocody', 3, 4, 'Panneaux modernes', 'Réservé', 15000, 'test', 0),
(6, 'Abidjan - Plateau, Avenue Chardy', 4, 3, 'Panneaux modernes', 'Réservé', 15000, 'Grand panneau idéal pour campagnes urbaines.', 0),
(7, 'Yopougon - Sideci, en face de la pharmacie Akadjoba', 3.5, 2.5, 'Panneaux classiques', 'Réservé', 12000, 'Visible depuis une route très fréquentée.', 0),
(8, 'Cocody - Deux Plateaux, Vallon', 5, 3, 'City led', 'Disponible', 20000, 'Panneau numérique haute visibilité.', 0),
(9, 'Marcory - Zone 4, rue Paul Langevin', 3, 2, 'Panneaux classiques', 'Disponible', 10000, 'Bonne exposition au carrefour principal.', 0),
(10, 'Treichville - Boulevard de Marseille', 4.5, 3.5, 'Panneaux modernes', 'Disponible', 13000, 'Panneau situé en bordure de voie rapide.', 0),
(11, 'Abobo - Rond-point Gagnoa', 3, 2, 'Panneaux classiques', 'Disponible', 9500, 'Zone très dense avec beaucoup de piétons.', 0),
(12, 'Koumassi - Remblais, proche du marché', 4, 3, 'Big size', 'Disponible', 14000, 'Emplacement stratégique près d’un grand marché.', 0),
(13, 'Bingerville - Entrée ville', 5, 3, 'Kilometrique', 'Disponible', 11000, 'Bonne visibilité en sortie d’autoroute.', 0),
(14, 'Port-Bouët - Route aéroportuaire', 6, 4, 'City led', 'Réservé', 30000, 'Panneau numérique en face de l’aéroport.', 9),
(15, 'Adjamé - Gare routière', 3.5, 2.5, 'Panneaux classiques', 'Disponible', 12500, 'Exposition maximale à la foule de la gare.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_deb` date NOT NULL,
  `date_fin` date NOT NULL,
  `statut` varchar(25) NOT NULL,
  `montant` int NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `date_deb`, `date_fin`, `statut`, `montant`, `client_id`) VALUES
(9, '2025-05-17', '2025-06-17', 'Suspendue', 4464000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(125) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `client_id` (`client_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `email`, `password`, `client_id`) VALUES
(1, 'test@gm.co', '$2y$10$4AfejPU1r3DkDq3BpwIv7u3wjomfsAuoqYcF5ygVFOGBQjJnWzgMy', 1),
(2, 'angepatrick459@gmail.com', '$2y$10$phcqxWNhCPbe6Lblqr7pfOzEnffWIQEvqm7nGLBL02siKUCnYOJyq', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
