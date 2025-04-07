-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 07 avr. 2025 à 09:28
-- Version du serveur : 10.11.11-MariaDB-0ubuntu0.24.04.2
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
-- Déchargement des données de la table `assurance`
--

INSERT INTO `assurance` (`id`, `date_contrat`) VALUES
(1, '2025-03-01'),
(2, '2025-02-15'),
(3, '2025-01-20'),
(4, '2024-12-10'),
(5, '2024-11-05'),
(18, '0000-00-00'),
(30, '0000-00-00'),
(70, '0000-00-00'),
(82, '0000-00-00');

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

--
-- Déchargement des données de la table `assurance_vehicule`
--

INSERT INTO `assurance_vehicule` (`id_assurance`, `id_vehicule`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Structure de la table `connexion`
--

CREATE TABLE `connexion` (
  `clef_connexion` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `connexion`
--

INSERT INTO `connexion` (`clef_connexion`, `id_user`) VALUES
('6a4a7ff8cb1217f2efc18fceee8d64be', 2),
('6a4a7ff8cb1217f2efc18fceee8d64be', 5),
('9b9a2c7a320e13b29074c37bb94d1ac4', 2),
('a6d1b5f3e5f451c91b4d1c5f36599121', 1),
('b9e9c6a3c8e2cb3767e920f9d568ac39', 1),
('b9e9c6a3c8e2cb3767e920f9d568ac39', 3),
('d90c97e8391720f9dba5cdb19a0d41cb', 2),
('d90c97e8391720f9dba5cdb19a0d41cb', 4);

--
-- Déclencheurs `connexion`
--
DELIMITER $$
CREATE TRIGGER `verif_clef_connexion` BEFORE INSERT ON `connexion` FOR EACH ROW IF NOT NEW.clef_connexion REGEXP BINARY '[a-zA-Z0-9]{32,}' THEN
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
-- Déchargement des données de la table `incident`
--

INSERT INTO `incident` (`id`, `id_vehicule`, `date_incident`, `explication_incident`, `id_user`, `id_type_incident`) VALUES
(1, 1, '2025-03-26', 'Accident mineur', 1, 1),
(2, 2, '2025-03-25', 'Incident de panne', 2, 2),
(3, 3, '2025-03-22', 'Fuite de carburant', 1, 1),
(4, 4, '2025-03-20', 'Défectuosité moteur', 2, 3),
(5, 5, '2025-03-18', 'Problème d\'équipement', 1, 1);

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

--
-- Déchargement des données de la table `incident_suivi`
--

INSERT INTO `incident_suivi` (`id_incident`, `id_suivi`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

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

--
-- Déchargement des données de la table `lieu`
--

INSERT INTO `lieu` (`id`, `nom_lieu`, `code_postal`, `numero`, `adresse`, `actif`) VALUES
(1, 'Paris', '75000', 1, '10 rue de Paris', 1),
(2, 'Lyon', '69000', 2, '20 avenue des Alpes', 1),
(3, 'Marseille', '13000', 3, '30 boulevard Saint-Pierre', 1),
(4, 'Toulouse', '31000', 4, '40 rue de la Garonne', 1),
(5, 'Nice', '06000', 5, '50 avenue des Anges', 1),
(14, '', '', 0, '', 0),
(21, '', '', 0, '', 0),
(60, '', '', 0, '', 0),
(77, '', '', 0, '', 0);

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
CREATE TRIGGER `verif_km_depart` BEFORE INSERT ON `mission` FOR EACH ROW IF NEW.km_depart < (SELECT max(km_arrive) FROM mission as m1, mission as m2 WHERE m1.id_vehicule = m2.id_vehicule) THEN
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
-- Déchargement des données de la table `permis`
--

INSERT INTO `permis` (`id_user`, `num_permis`, `date_permis`, `update_permis`, `type_permis`) VALUES
(1, 'A123456789', '2025-01-01', '2025-01-01', 'B'),
(2, 'B987654321', '2025-02-01', '2025-02-01', 'C'),
(3, 'C567890123', '2025-03-01', '2025-03-01', 'BE'),
(4, 'D246801357', '2025-04-01', '2025-04-01', 'C1'),
(5, 'E135792468', '2025-05-01', '2025-05-01', 'B');

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

--
-- Déchargement des données de la table `session`
--

INSERT INTO `session` (`id`, `id_user`, `date_dbt`, `date_fin`) VALUES
('s1', 1, '2025-03-01', '2025-03-01'),
('s2', 2, '2025-03-02', '2025-03-02'),
('s3', 1, '2025-03-03', '2025-03-03'),
('s4', 2, '2025-03-04', '2025-03-04'),
('s5', 1, '2025-03-05', '2025-03-05');

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

--
-- Déchargement des données de la table `suivi`
--

INSERT INTO `suivi` (`id`, `id_vehicule`, `date_intervention`, `description`) VALUES
(1, 1, '2025-03-01', 'Entretien moteur'),
(2, 2, '2025-03-02', 'Changement de pneus'),
(3, 3, '2025-03-03', 'Réparation du système de freinage'),
(4, 4, '2025-03-04', 'Révision générale'),
(5, 5, '2025-03-05', 'Vidange et révision');

-- --------------------------------------------------------

--
-- Structure de la table `type_incident`
--

CREATE TABLE `type_incident` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `critique` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_incident`
--

INSERT INTO `type_incident` (`id`, `nom`, `critique`) VALUES
(1, 'Accident', 1),
(2, 'Panne', 0),
(3, 'Fuite', 1),
(4, 'Défectuosité', 0),
(5, 'Problème technique', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `telephone` char(10) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `admin`, `telephone`, `mail`, `actif`) VALUES
(1, 'SZADAZDA', 'DZADAZ', 1, '0622221008', 'dinejridi@gmail.com', 0),
(2, 'Martin', 'Claire', 1, '0623456789', 'claire.martin@example.com', 1),
(3, 'Lemoine', 'Pierre', 0, '0634567890', 'pierre.lemoine@example.com', 0),
(4, 'Bernard', 'LU', 1, '0645678901', 'luc.bernard@example.com', 1),
(5, 'Garcia', 'Sofia', 0, '0656789012', 'sofia.garcia@example.com', 1),
(6, 'Dupont', 'Jean', 0, '0612345678', 'jean.dupont@example.com', 1),
(7, 'DEZ', 'ZEZ', 0, '1122334455', 'testtttt@gmail.com', 0);

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
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`id`, `plaque`, `marque`, `modele`, `date_achat`, `date_immat`, `ct`, `actif`) VALUES
(1, 'AB123CD', 'Renault', 'Clio', '2020-01-01', '2020-01-01', '2025-01-01', 1),
(2, 'BC234DE', 'Peugeot', '208', '2021-05-15', '2021-05-15', '2025-05-15', 1),
(3, 'CD345EF', 'Volkswagen', 'Golf', '2019-03-10', '2019-03-10', '2024-03-10', 1),
(4, 'DE456FG', 'Audi', 'A3', '2018-07-01', '2018-07-01', '2023-07-01', 1),
(5, 'EF567GH', 'BMW', 'X3', '2022-02-20', '2022-02-20', '2027-02-20', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT pour la table `infraction`
--
ALTER TABLE `infraction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT pour la table `lieu`
--
ALTER TABLE `lieu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT pour la table `suivi`
--
ALTER TABLE `suivi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `type_incident`
--
ALTER TABLE `type_incident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
