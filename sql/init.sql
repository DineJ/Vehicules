CREATE TABLE `Ip` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `adresse_ip` VARCHAR(40) NOT NULL,
  `nb_echec` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `adresse_ip` (`adresse_ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `Ip` WRITE;
INSERT INTO `Ip` (`id`,`adresse_ip`,`nb_echec`) VALUES
(3,'127.0.0.1',0),
(4,'192.168.0.1',0);
UNLOCK TABLES;


CREATE TABLE `user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(50) NOT NULL,
  `prenom` VARCHAR(50) NOT NULL,
  `admin` TINYINT(1) NOT NULL DEFAULT 0,
  `telephone` CHAR(10) NOT NULL,
  `mail` VARCHAR(100) NOT NULL,
  `actif` TINYINT(1) NOT NULL DEFAULT 1,
  `clef_connexion` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `user` WRITE;
INSERT INTO `user` VALUES
(1,'JRIDI','DINE',0,'0624221008','dinejridi1@gmail.com',1,'3e5d8f902ea30adfe5ce81191016bdf9c56a0a78916157ee953f7ef847a73708'),
(2,'THIERRY','T',1,'0102030405','non@gnma.com',1,'efc9f38a3ed4d3378634b2046dc66db5e36f6470ff03d54f695531008cad6576'),
(3,'PAS','PERMIS',0,'0102030406','dinejridi@gmaisl.com',0,'ca287eda7ae05481385d1db8e9416e6a'),
(4,'Oui','Oui',0,'0011220011','test@gmail.com',1,'1'),
(5,'Oui','Oui',1,'0011220011','testz@gmail.com',1,'1'),
(6,'Oui','Oui',0,'0011220011','teset@gmail.com',1,'1'),
(7,'Oui','Oui',0,'0011220011','tezzst@gmail.com',1,'1'),
(8,'Oui','Oui',1,'0011220011','tdest@gmail.com',1,'1'),
(9,'Oui','Oui',0,'0011220011','tdesddt@gmail.com',1,'1'),
(10,'Oui','Oui',0,'0011220011','tdwesddt@gmail.com',1,'1'),
(11,'Oui','Oui',0,'0011220011','tdffwesddt@gmail.com',0,'1');
UNLOCK TABLES;


CREATE TABLE `vehicule` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `plaque` CHAR(255) NOT NULL,
  `marque` VARCHAR(50) NOT NULL,
  `modele` VARCHAR(50) NOT NULL,
  `date_achat` DATE NOT NULL,
  `date_immat` DATE NOT NULL,
  `ct` DATE NOT NULL,
  `actif` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE_plaque` (`plaque`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `vehicule` WRITE;
INSERT INTO `vehicule` VALUES
(1,'AB123CD','Renault','Clio','2020-01-01','2020-01-01','2025-01-01',1),
(2,'BC-234-DE','Peugeot','208','2021-05-31','2021-05-31','2031-05-22',1),
(3,'CD345EF','Volkswagen','Golf','2019-03-10','2019-03-10','2024-03-10',1),
(4,'DE456FG','Audi','A3','2018-07-01','2018-07-01','2023-07-01',1),
(5,'EF567GH','BMW','X3','2022-02-20','2022-02-20','2027-02-20',1),
(7,'AB999CD','Z','D','2025-10-24','2025-10-31','2025-10-31',0),
(8,'AC-128-SG','CITROEN','C3','2025-10-16','2025-10-31','2025-11-01',0),
(9,'BH-434-','PEUGOT','CCCC','2025-10-19','2025-10-31','2025-11-08',0),
(10,'TT-123-','C','E','2025-10-30','2025-10-30','2025-10-30',0),
(11,'TT-123-OU','T','R','2025-10-30','2025-10-30','2025-10-30',0);
UNLOCK TABLES;

DELIMITER //
CREATE TRIGGER trg_vehicule_date_achat_bi BEFORE INSERT ON vehicule
FOR EACH ROW
BEGIN
  IF NEW.date_achat > CURRENT_DATE() THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "La date d'achat est ultérieur à aujourd'hui. Veuillez resaisir votre date.";
  END IF;
END//
CREATE TRIGGER trg_vehicule_date_achat_bu BEFORE UPDATE ON vehicule
FOR EACH ROW
BEGIN
  IF NEW.date_achat > CURRENT_DATE() THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "La date d'achat est ultérieur à aujourd'hui. Veuillez resaisir votre date.";
  END IF;
END//
DELIMITER ;

CREATE TABLE `type_incident` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(255) NOT NULL,
  `critique` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `type_incident` WRITE;
INSERT INTO `type_incident` VALUES
(1,'Accident',1),
(2,'Panne',0),
(3,'Fuite',0),
(4,'Défectuosité',0),
(5,'Problème technique',0),
(6,'TEST',0),
(7,'NNNC',0),
(8,'INCIDENT',0),
(9,'TEST-INCIDENTV2',0),
(10,'INCIDENTTTT',0),
(11,'DZDV',0),
(12,'EEEF',0),
(13,'EE',0),
(14,'TESTOUI',0),
(15,'TTT',0),
(16,'FFF',0),
(17,'DINE',0),
(18,'EOFPKOFZ',0),
(19,'DDDD',0),
(20,'DEDD',0),
(21,'FFF',0),
(22,'DDD',0),
(23,'CCC',0),
(24,'FF',0),
(25,'GFGFGG',0),
(26,'FFF',0),
(27,'FVEF',0),
(28,'GTTT',0),
(29,'DFBDFB',0),
(30,'FBEBE',0),
(31,'FBEBE',0),
(32,'DFBEB',0),
(33,'RRR',0),
(34,'FFF',0),
(35,'TESTE',0),
(36,'ALPHA',0),
(37,'BETA',0),
(38,'CHARLIE',0),
(39,'BRUNO',0),
(40,'P',0),
(41,'D',0),
(42,'FEF',0),
(43,'DFZEFZF',0),
(44,'TTTTT',0),
(45,'TTZFZFZEF',0),
(46,'FÉF\"HG\"\H(\\"H(',0),
(47,'TEST',0),
(48,'THIERRY',0),
(49,'DINE',0),
(50,'E',0),
(51,'OIUIJ',0),
(52,'NON',0),
(53,'LALALALAL',0),
(54,'TESTMODAL',1),
(55,'MODALREFRESH',1),
(56,'REFRESH2.0',0),
(57,'REFRESHHHHEDHEZUID',0),
(58,'AAAAAA',0),
(59,'TESTREUTN',0),
(60,'RERREER',0),
(61,'TESTZZZZZ',0),
(62,'DFFDZFZEFGZGZGZ\"GZG',0),
(63,'AZXWFD',0),
(64,'TESTETDSQTER',0),
(65,'POIU',0),
(66,'FZFZ',0),
(67,'FEZF',0),
(68,'FFFF',0),
(69,'HHH',0),
(70,'EFZFZ',0),
(71,'BJN N,K B ',0),
(72,'KLKKKKKKI',0),
(73,'CHECK',0),
(74,'PMO',0),
(75,'XXXXX',0),
(76,'POPPPPPPPPPPPPPPPP',0),
(77,'TUTUTUTUTUT',0),
(78,'MMM',1),
(79,'MOMOMMO',0),
(80,'MOMOMOMOMO_MTIUOMT_M',0),
(81,'ALERT',0),
(82,'ALERT2',0),
(83,'ÇA MARCHE',0),
(84,'DDDZDZD\"\"\"\"',0),
(85,'MAMAMIAM',0),
(86,'TESTDEFOU',1),
(87,'JS',1);
UNLOCK TABLES;


CREATE TABLE `assurance` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `date_contrat` DATE NOT NULL,
  `nom_assurance` VARCHAR(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `assurance` WRITE;
INSERT INTO `assurance` VALUES
(1,'2025-03-01', 'AXA'),
(2,'2025-02-15', 'EDF'),
(3,'2025-01-20', 'VANDY'),
(4,'2024-12-10', 'TOTO'),
(5,'2024-11-05', 'OKI');
UNLOCK TABLES;

DELIMITER //
CREATE TRIGGER trg_assurance_date_bu BEFORE UPDATE ON assurance
FOR EACH ROW
BEGIN
  IF NEW.date_contrat < OLD.date_contrat THEN
    SIGNAL SQLSTATE '45000'
      SET MESSAGE_TEXT = "La date du nouveau contrat est antérieur à celle de l ancien. Veuillez resaisir votre date.";
  END IF;
END//
DELIMITER ;


CREATE TABLE `assurance_vehicule` (
  `id_assurance` INT(11) NOT NULL,
  `id_vehicule` INT(11) NOT NULL,
  PRIMARY KEY (`id_assurance`,`id_vehicule`),
  KEY `id_vehicule` (`id_vehicule`),
  CONSTRAINT `assurance_vehicule_ibfk_1` FOREIGN KEY (`id_assurance`) REFERENCES `assurance` (`id`),
  CONSTRAINT `assurance_vehicule_ibfk_2` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicule` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `assurance_vehicule` WRITE;
INSERT INTO `assurance_vehicule` VALUES
(1,1),
(2,2),
(3,3),
(4,4),
(5,5);
UNLOCK TABLES;


CREATE TABLE `lieu` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nom_lieu` VARCHAR(100) NOT NULL,
  `code_postal` CHAR(5) NOT NULL,
  `numero` INT(11) NOT NULL,
  `adresse` VARCHAR(255) NOT NULL,
  `actif` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `lieu` WRITE;
INSERT INTO `lieu` VALUES
(1,'Paris','75000',1,'10 rue de Paris',1),
(2,'Lyon','69000',2,'20 avenue des Alpes',1),
(3,'Marseille','13000',3,'30 boulevard Saint-Pierre',1),
(4,'Toulouse','31000',4,'40 rue de la Garonne',1),
(5,'Nice','06000',5,'50 avenue des Anges',1),
(14,'','',0,'',0),
(21,'','',0,'',0),
(60,'','',0,'',0),
(77,'','',0,'',0);
UNLOCK TABLES;


CREATE TABLE `mission` (
  `id` INT(11) NOT NULL,
  `id_vehicule` INT(11) NOT NULL,
  `id_user` INT(11) NOT NULL,
  `id_lieu_depart` INT(11) NOT NULL,
  `id_lieu_arrive` INT(11) NOT NULL,
  `motif` ENUM('maraude','livraison','repas','demenagement','personnel') NOT NULL,
  `date_depart` DATE NOT NULL,
  `date_arrivee` DATE NOT NULL,
  `km_depart` INT(11) NOT NULL,
  `km_arrive` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_camion` (`id_vehicule`),
  KEY `FK_user` (`id_user`),
  KEY `FK_lieu_depart` (`id_lieu_depart`),
  KEY `FK_lieu_arrive` (`id_lieu_arrive`),
  CONSTRAINT `mission_ibfk_1` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicule` (`id`),
  CONSTRAINT `mission_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  CONSTRAINT `mission_ibfk_3` FOREIGN KEY (`id_lieu_depart`) REFERENCES `lieu` (`id`),
  CONSTRAINT `mission_ibfk_4` FOREIGN KEY (`id_lieu_arrive`) REFERENCES `lieu` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DELIMITER //
CREATE TRIGGER trg_mission_dates_bi BEFORE INSERT ON mission
FOR EACH ROW
BEGIN
  IF NEW.date_arrivee < NEW.date_depart THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "La date d arrivée est antérieur à celle de départ. Veuillez resaisir votre date.";
  END IF;
  IF NEW.date_depart > CURRENT_DATE() THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT ="La date de départ est ultérieur à aujourd hui. Veuillez resaisir votre date.";
  END IF;
  IF NEW.km_arrive < NEW.km_depart THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Le kilométrage d arrivé est plus petit que celui de départ. Veuillez resaisir votre nombre.";
  END IF;
END//
CREATE TRIGGER trg_mission_dates_bu BEFORE UPDATE ON mission
FOR EACH ROW
BEGIN
  IF NEW.date_arrivee < NEW.date_depart THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "La date d arrivée est antérieur à celle de départ. Veuillez resaisir votre date.";
  END IF;
  IF NEW.date_depart > CURRENT_DATE() THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT ="La date de départ est ultérieur à aujourd hui. Veuillez resaisir votre date.";
  END IF;
  IF NEW.km_arrive < NEW.km_depart THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Le kilométrage d arrivé est plus petit que celui de départ. Veuillez resaisir votre nombre.";
  END IF;
END//
DELIMITER ;


CREATE TABLE `incident` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_vehicule` INT(11) NOT NULL,
  `id_user` INT(11) NOT NULL,
  `id_type_incident` INT(11) NOT NULL,
  `date_incident` DATE NOT NULL,
  `explication_incident` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_camion` (`id_vehicule`),
  KEY `id_user` (`id_user`),
  KEY `id_type_accident` (`id_type_incident`),
  CONSTRAINT `incident_ibfk_1` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicule` (`id`),
  CONSTRAINT `incident_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  CONSTRAINT `incident_ibfk_3` FOREIGN KEY (`id_type_incident`) REFERENCES `type_incident` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DELIMITER //
CREATE TRIGGER trg_incident_date_bi BEFORE INSERT ON incident
FOR EACH ROW
BEGIN
  IF NEW.date_incident > CURRENT_DATE() THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "La date de l accident est ultérieur à celle d aujourd hui. Veuillez resaisir vos dates.";
  END IF;
END//
CREATE TRIGGER trg_incident_date_bu BEFORE UPDATE ON incident
FOR EACH ROW
BEGIN
  IF NEW.date_incident > CURRENT_DATE() THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "La date de l accident est ultérieur à celle d aujourd hui. Veuillez resaisir vos dates.";
  END IF;
END//
DELIMITER ;

LOCK TABLES `incident` WRITE;
INSERT INTO `incident` VALUES
(3,2,1,3,'2025-07-02',' OUI C LONG OUI C LONG OUI C LONGOUI C LONGOUI C LONGOUI C LONGOUI C LONG  TOUJOURS LONG OUI C LONGOUI C LONGOUI C LONGOUI C LONG\r\n  OUI C LONG OUI C LONG OUI C LONGOUI C LONGOUI C LONGOUI C LONGOUI C LONG  TOUJOURS LONG OUI C LONGOI C LONGOUI C LONGOUI C LONG\r\n OUI C LONG OUI C LONG OUI C LONGOUI C LONGOUI C LONGOUI C LONGOUI C LONG  TOUJOURS LONG OUI C LONGOUI C LONGOUI C LONGOUI C LONG\r\n OUI C LONG OUI C LONG OUI C LONGOUI C LONGOUI C LONGOUI C LONGOUI C LONG  TOUJOURS LONG OUI C LONGOUI C LONGOUI C LONGOUI C LONG\r\n OUI C LONG OUI C LONG OUI C LONGOUI C LONGOUI C LONGOUI C LONGOUI C LONG  TOUJOURS LONG OUI C LONGOUI C LONGOUI C LONGOUI C LONG OUI C LONG OUI C LONG OUI C LONGOUI C LONGOUI C LONGOUI C LONGOUI C LONG  TOUJOURS LONG OUI C LONGOUI C LONGOUI C LONGOUI C LONG\r\n'),
(5,4,2,4,'2025-07-29','OUILLE FOUILLE TOUILLLE'),
(7,2,1,41,'2025-09-03','DZED'),
(8,2,1,6,'2025-09-03','DZED'),
(9,4,8,6,'2025-09-03','DAÉ\"RÉ'),
(10,3,3,5,'2025-09-10','EFEZF'),
(11,1,1,1,'2025-09-23',''),
(12,5,5,9,'2025-09-20','FF');
UNLOCK TABLES;

CREATE TABLE `infraction` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_mission` INT(11) NOT NULL,
  `date_infraction` DATE NOT NULL,
  `commentaire` TEXT NOT NULL,
  `points` TINYINT(3) UNSIGNED NOT NULL,
  `prix` SMALLINT(5) UNSIGNED NOT NULL,
  `stationnement` TINYINT(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_trajet` (`id_mission`),
  CONSTRAINT `infraction_ibfk_1` FOREIGN KEY (`id_mission`) REFERENCES `mission` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DELIMITER //
CREATE TRIGGER trg_infraction_date_bi BEFORE INSERT ON infraction
FOR EACH ROW
BEGIN
  IF NEW.date_infraction > CURRENT_DATE() THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "La date de l infraction est ultérieur à celle d aujourd hui. Veuillez resaisir votre date.";
  END IF;
END//
CREATE TRIGGER trg_infraction_date_bu BEFORE UPDATE ON infraction
FOR EACH ROW
BEGIN
  IF NEW.date_infraction > CURRENT_DATE() THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "La date de l infraction est ultérieur à celle d aujourd hui. Veuillez resaisir votre date.";
  END IF;
END//
DELIMITER ;

LOCK TABLES `infraction` WRITE;
UNLOCK TABLES;


CREATE TABLE `permis` (
  `id_user` INT(11) NOT NULL,
  `num_permis` CHAR(12) NOT NULL,
  `date_permis` DATE NOT NULL,
  `update_permis` DATE NOT NULL,
  `type_permis` ENUM('B','BE','C','C1','C1E') NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `UNIQUE_num_permis` (`num_permis`) USING BTREE,
  CONSTRAINT `permis_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `permis` WRITE;
INSERT INTO `permis` VALUES
(1,'1234567888','2025-06-01','2038-11-03','C'),
(4,'1234567900','2025-09-04','2025-09-28','C'),
(8,'1234267893','2222-02-23','2223-02-22','C1');
UNLOCK TABLES;

DELIMITER //
CREATE TRIGGER trg_permis_update_date_bu BEFORE UPDATE ON permis
FOR EACH ROW
BEGIN
  IF NEW.update_permis < OLD.update_permis THEN
    SIGNAL SQLSTATE '45000' 
      SET MESSAGE_TEXT = "La date de péremption du permis est antérieur à l ancienne. Veuillez resaisir votre date.";
  END IF;
END//
DELIMITER ;


CREATE TABLE `historique` (
  `id_user` INT(11) NOT NULL,
  `id_ip` INT(11) NOT NULL,
  `date_dbt` TIMESTAMP NOT NULL,
  `date_fin` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id_user`,`date_dbt`),
  KEY `FK_user` (`id_user`),
  KEY `FK_ip` (`id_ip`) USING BTREE,
  CONSTRAINT `fk_ip` FOREIGN KEY (`id_ip`) REFERENCES `Ip` (`id`),
  CONSTRAINT `historique_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `historique` WRITE;
INSERT INTO `historique` VALUES
(1,3,'2025-07-23 12:05:00','2025-07-23 12:06:07'),
(1,3,'2025-07-23 12:06:09','2025-07-23 12:10:01'),
(1,3,'2025-07-23 12:41:02','2025-07-23 12:41:08'),
(1,3,'2025-07-23 12:41:47','2025-07-23 12:42:29'),
(1,3,'2025-07-23 12:58:00','2025-07-23 12:58:32'),
(1,3,'2025-07-23 13:30:36','2025-07-23 13:31:15'),
(1,3,'2025-08-06 04:36:44','2025-08-06 04:38:17'),
(1,3,'2025-08-07 06:21:28','2025-08-07 06:21:41'),
(1,3,'2025-08-07 06:21:46','2025-08-07 06:21:53'),
(2,3,'2025-07-23 06:38:24','2025-07-23 06:40:17'),
(2,3,'2025-07-23 06:42:22','2025-07-23 06:43:43'),
(2,3,'2025-07-23 06:53:22','2025-07-23 06:53:38'),
(2,3,'2025-07-23 07:23:34','2025-07-23 07:23:50'),
(2,3,'2025-07-23 11:23:35','2025-07-23 11:23:35'),
(2,3,'2025-07-23 12:03:28','2025-07-23 12:04:47'),
(2,3,'2025-07-23 12:20:04','2025-07-23 12:31:37'),
(2,3,'2025-07-23 12:39:23','2025-07-23 12:40:46'),
(2,3,'2025-07-23 12:58:41','2025-07-23 13:00:32'),
(2,3,'2025-07-23 13:28:37','2025-07-23 13:29:36'),
(2,3,'2025-07-23 13:34:36','2025-07-23 13:34:53'),
(2,3,'2025-07-25 04:24:00','2025-07-25 04:24:35'),
(2,3,'2025-07-25 04:43:32','2025-07-25 04:49:00'),
(2,3,'2025-07-25 04:54:47','2025-07-25 05:12:41'),
(2,3,'2025-07-28 04:07:03','2025-07-28 04:33:07'),
(2,3,'2025-07-28 04:45:00','2025-07-28 04:45:24');
UNLOCK TABLES;


CREATE TABLE `suivi` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_incident` INT(11) NOT NULL,
  `date_intervention` DATE NOT NULL,
  `description` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_incident` (`id_incident`),
  CONSTRAINT `suivi_ibfk_1` FOREIGN KEY (`id_incident`) REFERENCES `incident` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `suivi` WRITE;
INSERT INTO `suivi` VALUES
(20,3,'2025-09-01','INTERVENTION PRÉVENTIVE SUR LE MOTEUR. ...'),
(21,5,'2025-09-12','Inspection générale après signalement'),
(22,7,'2025-09-09','Contrôle des niveaux d’huile.'),
(23,8,'2025-09-02','Réglage du système électrique. Zd'),
(24,9,'2025-09-08','Changement de pneus usés.'),
(25,10,'2025-09-10','Vérification du système de climatisation');
UNLOCK TABLES;
