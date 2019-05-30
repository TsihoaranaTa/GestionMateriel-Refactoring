-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 23 Février 2019 à 22:45
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `adwya2`
--

-- --------------------------------------------------------

--
-- Structure de la table `departements`
--

DROP TABLE IF EXISTS `departements`;
CREATE TABLE IF NOT EXISTS `departements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_direction` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_direction` (`id_direction`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `departements`
--

INSERT INTO `departements` (`id`, `id_direction`, `nom`) VALUES
(23, 14, 'Departement');

-- --------------------------------------------------------

--
-- Structure de la table `directions`
--

DROP TABLE IF EXISTS `directions`;
CREATE TABLE IF NOT EXISTS `directions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `nom_court` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nom_court` (`nom_court`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `directions`
--

INSERT INTO `directions` (`id`, `nom`, `nom_court`) VALUES
(14, 'DIRECTION', 'Dir');

-- --------------------------------------------------------

--
-- Structure de la table `entrees`
--

DROP TABLE IF EXISTS `entrees`;
CREATE TABLE IF NOT EXISTS `entrees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `date_entree` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `entrees`
--

INSERT INTO `entrees` (`id`, `id_produit`, `quantite`, `date_entree`) VALUES
(1, 11, 12, '2019-01-24'),
(2, 11, 1, '2019-02-01'),
(3, 11, 1, '2019-02-01'),
(4, 11, 1, '2019-02-01'),
(5, 12, 1, '2019-02-01'),
(6, 11, 1, '2019-02-10'),
(7, 12, 1, '2019-02-10'),
(8, 11, 1, '2019-01-19'),
(9, 11, 1, '2019-02-15'),
(10, 11, 1, '2019-02-18'),
(11, 12, 1, '2019-02-15'),
(12, 13, 1, '2019-02-15'),
(13, 12, 1, '2019-01-19'),
(14, 11, 1, '2019-02-10'),
(15, 11, 1, '2019-02-18'),
(16, 11, 1, '2019-02-06'),
(17, 11, 1, '2019-02-20'),
(18, 11, 1, '2019-02-20'),
(19, 11, 1, '2019-02-19'),
(20, 11, 1, '2019-02-20'),
(21, 11, 1, '2019-02-20'),
(22, 11, 1, '2019-02-20'),
(23, 11, 1, '2019-02-01'),
(24, 12, 1, '2019-02-20'),
(25, 11, 1, '2019-02-20'),
(26, 13, 1, '2019-02-20'),
(27, 13, 1, '2019-02-20');

-- --------------------------------------------------------

--
-- Structure de la table `etats`
--

DROP TABLE IF EXISTS `etats`;
CREATE TABLE IF NOT EXISTS `etats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `etats`
--

INSERT INTO `etats` (`id`, `nom`) VALUES
(1, 'en panne'),
(2, 'en rÃ©paration'),
(3, 'en marche'),
(4, 'autre');

-- --------------------------------------------------------

--
-- Structure de la table `interventions`
--

DROP TABLE IF EXISTS `interventions`;
CREATE TABLE IF NOT EXISTS `interventions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `id_etat` int(11) NOT NULL,
  `id_materiel` int(11) NOT NULL,
  `ticket` varchar(50) NOT NULL,
  `cout` double NOT NULL,
  `temps` varchar(10) NOT NULL,
  `id_direction` int(11) NOT NULL,
  `id_departement` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `id_personnel` int(11) NOT NULL,
  `intervenant` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_etat` (`id_etat`),
  KEY `id_materiel` (`id_materiel`),
  KEY `id_direction` (`id_direction`),
  KEY `id_departement` (`id_departement`),
  KEY `id_service` (`id_service`),
  KEY `id_personnel` (`id_personnel`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `interventions`
--

INSERT INTO `interventions` (`id`, `nom`, `id_etat`, `id_materiel`, `ticket`, `cout`, `temps`, `id_direction`, `id_departement`, `id_service`, `id_personnel`, `intervenant`) VALUES
(1, 'source 2', 2, 21, 'A0084', 11, '2019-01-24', 14, 23, 7, 8, 'Gerald'),
(3, 'crash', 2, 21, '14', 5000, '2019-02-02', 14, 23, 7, 8, 'Gerald'),
(4, 'allumage', 4, 21, '4', 41, '2019-02-02', 14, 23, 7, 8, 'Gerald'),
(9, 's', 1, 21, '12', 12, '2019-02-12', 14, 23, 7, 8, 'Claudio');

-- --------------------------------------------------------

--
-- Structure de la table `materiels`
--

DROP TABLE IF EXISTS `materiels`;
CREATE TABLE IF NOT EXISTS `materiels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_departement` int(11) NOT NULL,
  `id_direction` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `date` varchar(10) NOT NULL,
  `id_service` int(11) NOT NULL,
  `id_personnel` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_departement` (`id_departement`),
  KEY `id_direction` (`id_direction`),
  KEY `id_service` (`id_service`),
  KEY `id_personnel` (`id_personnel`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `materiels`
--

INSERT INTO `materiels` (`id`, `id_departement`, `id_direction`, `type`, `reference`, `date`, `id_service`, `id_personnel`) VALUES
(21, 23, 14, 'type', 'test', '2019-02-01', 7, 8);

-- --------------------------------------------------------

--
-- Structure de la table `mouvements`
--

DROP TABLE IF EXISTS `mouvements`;
CREATE TABLE IF NOT EXISTS `mouvements` (
  `id` int(11) NOT NULL,
  `type` enum('sortie','entree') NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `mouvements`
--

INSERT INTO `mouvements` (`id`, `type`, `date`) VALUES
(1, 'entree', '2019-01-24'),
(2, 'sortie', '2019-01-24'),
(3, 'sortie', '2019-01-24'),
(4, 'sortie', '2019-01-24'),
(5, 'sortie', '2019-01-24'),
(6, 'sortie', '2019-02-06'),
(7, 'sortie', '2019-02-06'),
(8, 'entree', '2019-01-19'),
(9, 'entree', '2019-02-15'),
(10, 'entree', '2019-02-18'),
(11, 'entree', '2019-02-15'),
(12, 'entree', '2019-02-15'),
(13, 'entree', '2019-01-19'),
(14, 'entree', '2019-02-10'),
(15, 'sortie', '2019-02-20'),
(16, 'sortie', '2019-02-20'),
(17, 'sortie', '2019-02-21'),
(18, 'entree', '2019-02-10'),
(19, 'sortie', '2019-02-20'),
(20, 'entree', '2019-02-20'),
(21, 'sortie', '2019-02-20'),
(22, 'sortie', '2019-02-20'),
(23, 'entree', '2019-02-01'),
(24, 'sortie', '2019-02-20'),
(25, 'entree', '2019-02-20'),
(26, 'sortie', '2019-02-20'),
(27, 'entree', '2019-02-20');

-- --------------------------------------------------------

--
-- Structure de la table `personnels`
--

DROP TABLE IF EXISTS `personnels`;
CREATE TABLE IF NOT EXISTS `personnels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_direction` int(11) NOT NULL,
  `id_departement` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_direction` (`id_direction`),
  KEY `id_departement` (`id_departement`),
  KEY `id_service` (`id_service`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `personnels`
--

INSERT INTO `personnels` (`id`, `id_direction`, `id_departement`, `id_service`, `nom`) VALUES
(8, 14, 23, 7, 'Andriana'),
(9, 14, 23, 7, 'newpers');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` text NOT NULL,
  `reference` varchar(255) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `produits`
--

INSERT INTO `produits` (`id`, `designation`, `reference`, `quantite`) VALUES
(11, 'prodtes', 'prduit', 3),
(12, 'pro4', 'pr4', 3),
(13, 'myprod', '12561662221', 3);

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_direction` int(11) NOT NULL,
  `id_departement` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_direction` (`id_direction`),
  KEY `id_departement` (`id_departement`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `services`
--

INSERT INTO `services` (`id`, `id_direction`, `id_departement`, `nom`) VALUES
(7, 14, 23, 'service');

-- --------------------------------------------------------

--
-- Structure de la table `sorties`
--

DROP TABLE IF EXISTS `sorties`;
CREATE TABLE IF NOT EXISTS `sorties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `date_sortie` date NOT NULL,
  `bon` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_gadget` (`id_produit`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `sorties`
--

INSERT INTO `sorties` (`id`, `id_produit`, `quantite`, `date_sortie`, `bon`) VALUES
(1, 11, 4, '2019-01-24', 'M16'),
(2, 11, 3, '2019-01-24', 'M16'),
(3, 11, 2, '2019-01-24', 'M204'),
(4, 11, 2, '2019-01-24', 'M204'),
(5, 11, 1, '2019-01-24', 'ZR'),
(6, 11, 1, '2019-02-06', 'testtt'),
(7, 11, 1, '2019-02-06', 'testtt'),
(8, 11, 1, '2019-02-19', 'QBZ'),
(9, 11, 1, '2019-02-19', 'QBZ'),
(10, 11, 1, '2019-02-20', 'QBZ'),
(11, 11, 1, '2019-02-19', 'testtt5'),
(12, 11, 1, '2019-02-20', 'fefz'),
(13, 11, 1, '2019-02-19', 'testtt5'),
(14, 11, 1, '2019-02-20', 'QBZ'),
(15, 12, 1, '2019-02-20', 'testtt5'),
(16, 12, 1, '2019-02-20', 'QBZ'),
(17, 12, 1, '2019-02-21', 'testtt'),
(18, 11, 1, '2019-02-20', 'QBZ'),
(19, 11, 1, '2019-02-20', 'QBZ'),
(20, 11, 1, '2019-02-20', 'testtt'),
(21, 11, 1, '2019-02-20', 'testtt'),
(22, 11, 1, '2019-02-20', 'testtt'),
(23, 11, 1, '2019-02-20', 'testtt'),
(24, 11, 1, '2019-02-20', 'QBZ'),
(25, 11, 1, '2019-02-20', 'QBZ'),
(26, 11, 1, '2019-02-20', 'QBZ');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `login` varchar(30) NOT NULL,
  `pw` varchar(30) NOT NULL,
  `type` enum('admin','autre','reparateur') NOT NULL,
  `lpp` int(11) NOT NULL DEFAULT '4',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `login`, `pw`, `type`, `lpp`) VALUES
(1, 'Gerald', 'Gerald', 'a', 'a', 'admin', 4),
(2, 'Visiteur', 'Personnel de la SMMC', 'b', 'b', 'autre', 4),
(3, 'Claudio', 'Claudio', 'c', 'c', 'admin', 4);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `departements`
--
ALTER TABLE `departements`
  ADD CONSTRAINT `departements_ibfk_1` FOREIGN KEY (`id_direction`) REFERENCES `directions` (`id`);

--
-- Contraintes pour la table `interventions`
--
ALTER TABLE `interventions`
  ADD CONSTRAINT `interventions_ibfk_1` FOREIGN KEY (`id_etat`) REFERENCES `etats` (`id`),
  ADD CONSTRAINT `interventions_ibfk_2` FOREIGN KEY (`id_materiel`) REFERENCES `materiels` (`id`),
  ADD CONSTRAINT `interventions_ibfk_3` FOREIGN KEY (`id_direction`) REFERENCES `directions` (`id`),
  ADD CONSTRAINT `interventions_ibfk_4` FOREIGN KEY (`id_departement`) REFERENCES `departements` (`id`),
  ADD CONSTRAINT `interventions_ibfk_5` FOREIGN KEY (`id_service`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `interventions_ibfk_6` FOREIGN KEY (`id_personnel`) REFERENCES `personnels` (`id`);

--
-- Contraintes pour la table `materiels`
--
ALTER TABLE `materiels`
  ADD CONSTRAINT `materiels_ibfk_1` FOREIGN KEY (`id_departement`) REFERENCES `departements` (`id`),
  ADD CONSTRAINT `materiels_ibfk_2` FOREIGN KEY (`id_direction`) REFERENCES `directions` (`id`),
  ADD CONSTRAINT `materiels_ibfk_3` FOREIGN KEY (`id_personnel`) REFERENCES `personnels` (`id`),
  ADD CONSTRAINT `materiels_ibfk_4` FOREIGN KEY (`id_service`) REFERENCES `services` (`id`);

--
-- Contraintes pour la table `personnels`
--
ALTER TABLE `personnels`
  ADD CONSTRAINT `personnels_ibfk_1` FOREIGN KEY (`id_departement`) REFERENCES `departements` (`id`),
  ADD CONSTRAINT `personnels_ibfk_2` FOREIGN KEY (`id_direction`) REFERENCES `directions` (`id`),
  ADD CONSTRAINT `personnels_ibfk_3` FOREIGN KEY (`id_service`) REFERENCES `services` (`id`);

--
-- Contraintes pour la table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`id_departement`) REFERENCES `departements` (`id`),
  ADD CONSTRAINT `services_ibfk_2` FOREIGN KEY (`id_direction`) REFERENCES `directions` (`id`);

--
-- Contraintes pour la table `sorties`
--
ALTER TABLE `sorties`
  ADD CONSTRAINT `sorties_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
