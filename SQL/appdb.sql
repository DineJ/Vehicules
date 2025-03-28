-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 26 mars 2025 à 14:16
-- Version du serveur : 10.11.8-MariaDB-0ubuntu0.24.04.1
-- Version de PHP : 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `appdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `assurance`
--

CREATE TABLE `assurance` (
  `id` int(11) NOT NULL,
  `date_contrat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déclencheurs `assurance`
--
DELIMITER $$
CREATE TRIGGER `verif_date_contrat` AFTER UPDATE ON `assurance` FOR EACH ROW IF OLD.date_contrat >= NEW.date_contrat THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT ="La date du nouveau contrat est antérieur à celle de l'ancien. Veuillez resaisir votre date."$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `assurance_vehicule`
--

CREATE TABLE `assurance_vehicule` (
  `id_assurance` int(11) NOT NULL,
  `id_vehicule` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `connexion`
--

CREATE TABLE `connexion` (
  `clef_connexion` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déclencheurs `connexion`
--
DELIMITER $$
CREATE TRIGGER `verif_clef_connexion` BEFORE INSERT ON `connexion` FOR EACH ROW IF NOT NEW.clef_connexion REGEXP BINARY '[.]{32}[.]*' THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = "La clef de connexion est trop courte. Veuillez rentrer au moins 32 caractères."$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `incident`
--

CREATE TABLE `incident` (
  `id` int(11) NOT NULL,
  `id_vehicule` int(11) NOT NULL,
  `date_incident` date NOT NULL,
  `explication_incident` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_type_incident` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déclencheurs `incident`
--
DELIMITER $$
CREATE TRIGGER `verif_date_incident` BEFORE INSERT ON `incident` FOR EACH ROW IF NEW.date_incident > DATE( NOW()) THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = "La date de l'accident est ultérieur à celle d'aujourd'hui. Veuillez resaisir vos dates."$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `incident_suivi`
--

CREATE TABLE `incident_suivi` (
  `id_incident` int(11) NOT NULL,
  `id_suivi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `infraction`
--

CREATE TABLE `infraction` (
  `id` int(11) NOT NULL,
  `id_mission` int(11) NOT NULL,
  `date_infraction` date NOT NULL,
  `commentaire` text NOT NULL,
  `points` tinyint(3) UNSIGNED NOT NULL,
  `prix` smallint(5) UNSIGNED NOT NULL,
  `stationnement` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déclencheurs `infraction`
--
DELIMITER $$
CREATE TRIGGER `verif_date_infraction` BEFORE INSERT ON `infraction` FOR EACH ROW IF NEW.date_infraction > DATE( NOW())THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = "La date de l'infraction est ultérieur à celle d'aujourd'hui. Veuillez resaisir votre date."$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

CREATE TABLE `lieu` (
  `id` int(11) NOT NULL,
  `nom_lieu` varchar(100) NOT NULL,
  `code_postal` char(5) NOT NULL,
  `numero` int(11) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `actif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mission`
--

CREATE TABLE `mission` (
  `id` int(11) NOT NULL,
  `id_vehicule` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_lieu_depart` int(11) NOT NULL,
  `id_lieu_arrive` int(11) NOT NULL,
  `motif` enum('maraude','livraison','repas','demenagement','personnel') NOT NULL,
  `date_depart` date NOT NULL,
  `date_arrivee` date NOT NULL,
  `km_depart` int(11) NOT NULL,
  `km_arrive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déclencheurs `mission`
--
DELIMITER $$
CREATE TRIGGER `verif_date_arrivee` BEFORE INSERT ON `mission` FOR EACH ROW IF NEW.date_arrivee <= NEW.date_depart THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = "La date d'arrivée est antérieur à celle de départ. Veuillez resaisir votre date."$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `verif_date_depart` BEFORE INSERT ON `mission` FOR EACH ROW IF NEW.date_depart >= DATE( NOW()) THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT ="La date de départ est ultérieur à aujourd'hui. Veuillez resaisir votre date."$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `verif_km_arrive` BEFORE UPDATE ON `mission` FOR EACH ROW IF NEW.km_arrive <= NEW.km_depart THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = "Le kilométrage d'arrivé est plus petit que celui de départ. Veuillez resaisir votre nombre."$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `verif_km_depart` BEFORE INSERT ON `mission` FOR EACH ROW IF NEW.km_depart < (SELECT max(km_arrive) FROM trajet WHERE id_camion = id_camion) THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = "Le kilométrage de départ est trop petit par rapport à l'ancien indiquer. Veuillez resaisir votre nombre."$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `permis`
--

CREATE TABLE `permis` (
  `id_user` int(11) NOT NULL,
  `num_permis` char(12) NOT NULL,
  `date_permis` date NOT NULL,
  `update_permis` date NOT NULL,
  `type_permis` enum('B','BE','C','C1','C1E') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déclencheurs `permis`
--
DELIMITER $$
CREATE TRIGGER `verif_date_permis` BEFORE UPDATE ON `permis` FOR EACH ROW IF NEW.update_permis < OLD.update_permis THEN 
SIGNAL SQLSTATE '45000' 
SET MESSAGE_TEXT = "La date de péremption du permis est antérieur à l'ancienne. Veuillez resaisir votre date."$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

CREATE TABLE `session` (
  `id` varchar(257) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_dbt` date NOT NULL,
  `date_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `suivi`
--

CREATE TABLE `suivi` (
  `id` int(11) NOT NULL,
  `id_vehicule` int(11) NOT NULL,
  `date_intervention` date NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type_incident`
--

CREATE TABLE `type_incident` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `critique` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `telephone` char(10) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `actif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `admin`, `telephone`, `mail`, `actif`) VALUES
(1, 'SZADAZDA', 'DZADAZ', 0, '0622221008', 'dinejridi@gmail.com', 0),
(2, 'DAZDADAD', 'ADADADA', 1, '1122334455', 'dinejridi@gmail.com', 0);

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `id` int(11) NOT NULL,
  `plaque` char(9) NOT NULL,
  `marque` varchar(50) NOT NULL,
  `modele` varchar(50) NOT NULL,
  `date_achat` date NOT NULL,
  `date_immat` date NOT NULL,
  `ct` date NOT NULL,
  `actif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déclencheurs `vehicule`
--
DELIMITER $$
CREATE TRIGGER `verif_ct` BEFORE UPDATE ON `vehicule` FOR EACH ROW IF OLD.ct >= NEW.ct THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = "La date du nouveau contrôle technique est antérieur à celle de l'ancien. Veuillez resaisir votre date."$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `verif_date_achat` BEFORE INSERT ON `vehicule` FOR EACH ROW IF NEW.date_achat > DATE( NOW()) THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = "La date d'achat est ultérieur à aujourd'hui. Veuillez resaisir votre date."$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `verif_plaque` BEFORE INSERT ON `vehicule` FOR EACH ROW IF NOT NEW.plaque REGEXP BINARY '[A-Z]{2}(("^-"[0-9]{3}"-$")|([0-9]{3}))[A-Z]{2}' THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = "La construction de la plaque d'immatriculation est incorrecte. Voici les formats acceptés 'AB-123-CD' ou 'AB123CD'. Veuillez recommencer votre saisie."$$
DELIMITER ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `assurance`
--
ALTER TABLE `assurance`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `assurance_vehicule`
--
ALTER TABLE `assurance_vehicule`
  ADD PRIMARY KEY (`id_assurance`,`id_vehicule`),
  ADD KEY `id_vehicule` (`id_vehicule`);

--
-- Index pour la table `connexion`
--
ALTER TABLE `connexion`
  ADD PRIMARY KEY (`clef_connexion`,`id_user`),
  ADD KEY `FK_user` (`id_user`);

--
-- Index pour la table `incident`
--
ALTER TABLE `incident`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_camion` (`id_vehicule`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_type_accident` (`id_type_incident`);

--
-- Index pour la table `incident_suivi`
--
ALTER TABLE `incident_suivi`
  ADD PRIMARY KEY (`id_incident`,`id_suivi`),
  ADD KEY `id_suivi` (`id_suivi`);

--
-- Index pour la table `infraction`
--
ALTER TABLE `infraction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_trajet` (`id_mission`);

--
-- Index pour la table `lieu`
--
ALTER TABLE `lieu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mission`
--
ALTER TABLE `mission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_camion` (`id_vehicule`),
  ADD KEY `FK_user` (`id_user`),
  ADD KEY `FK_lieu_depart` (`id_lieu_depart`),
  ADD KEY `FK_lieu_arrive` (`id_lieu_arrive`);

--
-- Index pour la table `permis`
--
ALTER TABLE `permis`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `UNIQUE_num_permis` (`num_permis`) USING BTREE;

--
-- Index pour la table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user` (`id_user`);

--
-- Index pour la table `suivi`
--
ALTER TABLE `suivi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_camion` (`id_vehicule`);

--
-- Index pour la table `type_incident`
--
ALTER TABLE `type_incident`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE_plaque` (`plaque`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `assurance`
--
ALTER TABLE `assurance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `infraction`
--
ALTER TABLE `infraction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lieu`
--
ALTER TABLE `lieu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `suivi`
--
ALTER TABLE `suivi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `type_incident`
--
ALTER TABLE `type_incident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `assurance_vehicule`
--
ALTER TABLE `assurance_vehicule`
  ADD CONSTRAINT `assurance_vehicule_ibfk_1` FOREIGN KEY (`id_assurance`) REFERENCES `assurance` (`id`),
  ADD CONSTRAINT `assurance_vehicule_ibfk_2` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicule` (`id`);

--
-- Contraintes pour la table `connexion`
--
ALTER TABLE `connexion`
  ADD CONSTRAINT `connexion_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `incident`
--
ALTER TABLE `incident`
  ADD CONSTRAINT `incident_ibfk_1` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicule` (`id`),
  ADD CONSTRAINT `incident_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `incident_ibfk_3` FOREIGN KEY (`id_type_incident`) REFERENCES `type_incident` (`id`);

--
-- Contraintes pour la table `incident_suivi`
--
ALTER TABLE `incident_suivi`
  ADD CONSTRAINT `incident_suivi_ibfk_1` FOREIGN KEY (`id_incident`) REFERENCES `incident` (`id`),
  ADD CONSTRAINT `incident_suivi_ibfk_2` FOREIGN KEY (`id_suivi`) REFERENCES `suivi` (`id`);

--
-- Contraintes pour la table `infraction`
--
ALTER TABLE `infraction`
  ADD CONSTRAINT `infraction_ibfk_1` FOREIGN KEY (`id_mission`) REFERENCES `mission` (`id`);

--
-- Contraintes pour la table `mission`
--
ALTER TABLE `mission`
  ADD CONSTRAINT `mission_ibfk_1` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicule` (`id`),
  ADD CONSTRAINT `mission_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `mission_ibfk_3` FOREIGN KEY (`id_lieu_depart`) REFERENCES `lieu` (`id`),
  ADD CONSTRAINT `mission_ibfk_4` FOREIGN KEY (`id_lieu_arrive`) REFERENCES `lieu` (`id`);

--
-- Contraintes pour la table `permis`
--
ALTER TABLE `permis`
  ADD CONSTRAINT `permis_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `suivi`
--
ALTER TABLE `suivi`
  ADD CONSTRAINT `suivi_ibfk_1` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicule` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
