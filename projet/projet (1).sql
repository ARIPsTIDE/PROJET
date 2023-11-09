-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 07 nov. 2023 à 07:13
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id_client` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_client`, `nom`, `prenom`, `mail`, `password`) VALUES
(1, 'Lavrilleux', 'Aleck', 'aleck.lavrilleux@gmail.com', 'test test');

-- --------------------------------------------------------

--
-- Structure de la table `biens`
--

DROP TABLE IF EXISTS `biens`;
CREATE TABLE IF NOT EXISTS `biens` (
  `id_bien` int NOT NULL AUTO_INCREMENT,
  `nom_bien` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rue_bien` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cop_bien` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `vil_bien` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sup_bien` int NOT NULL,
  `nb_couchage` int NOT NULL,
  `nb_pieces` int NOT NULL,
  `nb_chambres` int NOT NULL,
  `descriptif` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ref_bien` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `statut_bien` tinyint(1) NOT NULL,
  `id_type_bien` int NOT NULL,
  PRIMARY KEY (`id_bien`),
  KEY `fk_id_type_bien` (`id_type_bien`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `biens`
--

INSERT INTO `biens` (`id_bien`, `nom_bien`, `rue_bien`, `cop_bien`, `vil_bien`, `sup_bien`, `nb_couchage`, `nb_pieces`, `nb_chambres`, `descriptif`, `ref_bien`, `statut_bien`, `id_type_bien`) VALUES
(1, 'Maison bleue', '3 impasse', 'oui', 'oui', 240, 4, 4, 3, 'maison bleue', 'maison bleue', 1, 1),
(2, 'Maison', '3 impasse', 'oui', 'oui', 240, 4, 4, 3, 'maison ', 'maison', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id_client` int NOT NULL AUTO_INCREMENT,
  `nom_client` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prenom_client` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rue_client` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cop_client` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `vil_client` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mail_client` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pass_client` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `statut_client` tinyint(1) NOT NULL,
  `valid_client` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id_client`, `nom_client`, `prenom_client`, `rue_client`, `cop_client`, `vil_client`, `mail_client`, `pass_client`, `statut_client`, `valid_client`) VALUES
(1, 'Moundi', 'Aaron-Lee', 'Emile Zola', '19100', 'Brive', 'moundi@moundi.com', '12345', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `id_photo` int NOT NULL AUTO_INCREMENT,
  `nom_photo` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lien_photo` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_bien` int NOT NULL,
  PRIMARY KEY (`id_photo`),
  KEY `fk2_id_bien` (`id_bien`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`id_photo`, `nom_photo`, `lien_photo`, `id_bien`) VALUES
(1, 'photo maison bleue', '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id_reservation` int NOT NULL AUTO_INCREMENT,
  `date_resa` datetime NOT NULL,
  `dad_resa` datetime NOT NULL,
  `daf_resa` datetime NOT NULL,
  `commentaire` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `moderation` tinyint(1) NOT NULL,
  `annul_resa` tinyint(1) NOT NULL,
  `id_client` int NOT NULL,
  `id_bien` int NOT NULL,
  PRIMARY KEY (`id_reservation`),
  KEY `fk_id_client` (`id_client`),
  KEY `fk3_id_bien` (`id_bien`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tarif`
--

DROP TABLE IF EXISTS `tarif`;
CREATE TABLE IF NOT EXISTS `tarif` (
  `id_tarif` int NOT NULL AUTO_INCREMENT,
  `dd_tarif` datetime NOT NULL,
  `df_tarif` datetime NOT NULL,
  `prix_loc` int NOT NULL,
  `id_bien` int NOT NULL,
  PRIMARY KEY (`id_tarif`),
  KEY `fk_id_bien` (`id_bien`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tarif`
--

INSERT INTO `tarif` (`id_tarif`, `dd_tarif`, `df_tarif`, `prix_loc`, `id_bien`) VALUES
(1, '2023-11-03 00:32:18', '2023-11-03 00:32:18', 2000, 1);

-- --------------------------------------------------------

--
-- Structure de la table `type_bien`
--

DROP TABLE IF EXISTS `type_bien`;
CREATE TABLE IF NOT EXISTS `type_bien` (
  `id_type_bien` int NOT NULL AUTO_INCREMENT,
  `lib_type_bien` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_type_bien`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_bien`
--

INSERT INTO `type_bien` (`id_type_bien`, `lib_type_bien`) VALUES
(1, 'Maison');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `fk2_id_bien` FOREIGN KEY (`id_bien`) REFERENCES `biens` (`id_bien`);

--
-- Contraintes pour la table `tarif`
--
ALTER TABLE `tarif`
  ADD CONSTRAINT `fk_id_bien` FOREIGN KEY (`id_bien`) REFERENCES `biens` (`id_bien`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
