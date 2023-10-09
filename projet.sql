-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 09 oct. 2023 à 16:15
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

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
-- Structure de la table `biens`
--

CREATE TABLE `biens` (
  `id_bien` int(11) NOT NULL,
  `nom_bien` varchar(40) NOT NULL,
  `rue_bien` varchar(40) NOT NULL,
  `cop_bien` varchar(40) NOT NULL,
  `vil_bien` varchar(40) NOT NULL,
  `sup_bien` int(11) NOT NULL,
  `nb_couchage` int(11) NOT NULL,
  `nb_pieces` int(11) NOT NULL,
  `nb_chambres` int(11) NOT NULL,
  `descriptif` varchar(40) NOT NULL,
  `ref_bien` varchar(40) NOT NULL,
  `statut_bien` tinyint(1) NOT NULL,
  `id_type_bien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id_client` int(11) NOT NULL,
  `nom_client` varchar(40) NOT NULL,
  `prenom_client` varchar(40) NOT NULL,
  `rue_client` varchar(40) NOT NULL,
  `cop_client` varchar(40) NOT NULL,
  `vil_client` varchar(40) NOT NULL,
  `mail_client` varchar(40) NOT NULL,
  `pass_client` varchar(40) NOT NULL,
  `statut_client` tinyint(1) NOT NULL,
  `valid_client` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `id_photo` int(11) NOT NULL,
  `nom_photo` varchar(40) NOT NULL,
  `lien_photo` varchar(40) NOT NULL,
  `id_bien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id_reservation` int(11) NOT NULL,
  `date_resa` datetime NOT NULL,
  `dad_resa` datetime NOT NULL,
  `daf_resa` datetime NOT NULL,
  `commentaire` varchar(250) NOT NULL,
  `moderation` tinyint(1) NOT NULL,
  `annul_resa` tinyint(1) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_bien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tarif`
--

CREATE TABLE `tarif` (
  `id_tarif` int(11) NOT NULL,
  `dd_tarif` datetime NOT NULL,
  `df_tarif` datetime NOT NULL,
  `prix_loc` int(11) NOT NULL,
  `id_bien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type_bien`
--

CREATE TABLE `type_bien` (
  `id_type_bien` int(11) NOT NULL,
  `lib_type_bien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `biens`
--
ALTER TABLE `biens`
  ADD PRIMARY KEY (`id_bien`),
  ADD KEY `fk_id_type_bien` (`id_type_bien`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id_photo`),
  ADD KEY `fk2_id_bien` (`id_bien`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `fk_id_client` (`id_client`),
  ADD KEY `fk3_id_bien` (`id_bien`);

--
-- Index pour la table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id_tarif`),
  ADD KEY `fk_id_bien` (`id_bien`);

--
-- Index pour la table `type_bien`
--
ALTER TABLE `type_bien`
  ADD PRIMARY KEY (`id_type_bien`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `biens`
--
ALTER TABLE `biens`
  MODIFY `id_bien` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `type_bien`
--
ALTER TABLE `type_bien`
  MODIFY `id_type_bien` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `biens`
--
ALTER TABLE `biens`
  ADD CONSTRAINT `fk_id_type_bien` FOREIGN KEY (`id_type_bien`) REFERENCES `type_bien` (`id_type_bien`);

--
-- Contraintes pour la table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `fk2_id_bien` FOREIGN KEY (`id_bien`) REFERENCES `biens` (`id_bien`);

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk3_id_bien` FOREIGN KEY (`id_bien`) REFERENCES `biens` (`id_bien`),
  ADD CONSTRAINT `fk_id_client` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id_client`);

--
-- Contraintes pour la table `tarif`
--
ALTER TABLE `tarif`
  ADD CONSTRAINT `fk_id_bien` FOREIGN KEY (`id_bien`) REFERENCES `biens` (`id_bien`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
