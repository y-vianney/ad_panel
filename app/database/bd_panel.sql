-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 22 mai 2025 à 17:48
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bd_panel`
--
CREATE DATABASE IF NOT EXISTS `bd_panel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `bd_panel`;

-- --------------------------------------------------------

--
-- Structure de la table `client`
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panneau`
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
-- Déchargement des données de la table `panneau`
--

INSERT INTO `panneau` (`id`, `emplacement`, `longueur`, `largeur`, `type`, `etat`, `prix`, `description`, `reservation_id`) VALUES
(2, 'Abidjan, Cocody', 2, 4, 'Panneaux modernes', 'Réservé', 12000, 'test', 11),
(3, 'Abidjan, Cocody', 3, 5, 'Panneaux classiques', 'Réservé', 10000, 'Ce panneau moderne, situé dans le quartier prisé de Cocody à Abidjan, offre une visibilité optimale pour vos campagnes publicitaires. Avec ses dimensions de 2 mètres sur 4, il est idéal pour capter l’attention dans un environnement urbain dynamique.', 12),
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
(14, 'Port-Bouët - Route aéroportuaire', 6, 4, 'City led', 'Réservé', 30000, 'Panneau numérique en face de l’aéroport.', 0),
(15, 'Adjamé - Gare routière', 3.5, 2.5, 'Panneaux classiques', 'Disponible', 12500, 'Exposition maximale à la foule de la gare.', 0);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(125) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'client',
  `client_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `client_id` (`client_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
