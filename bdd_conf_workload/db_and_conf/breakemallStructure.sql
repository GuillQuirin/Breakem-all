-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Ven 06 Mai 2016 à 15:53
-- Version du serveur :  5.5.42
-- Version de PHP :  5.6.10
drop database IF EXISTS breakemallv2;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES cp1250 */;

--
-- Base de données :  `breakemallv2`
--
CREATE DATABASE IF NOT EXISTS `breakemallv2` CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `breakemallv2`;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--


DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `comment` varchar(200) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idEntite` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) DEFAULT 0,
  `entite` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Structure de la table `game`
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE IF NOT EXISTS `game` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `img` varchar(250) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `idType` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Contenu de la table `game`
--

-- --------------------------------------------------------

--
-- Structure de la table `gameversion`
--

DROP TABLE IF EXISTS `gameversion`;
CREATE TABLE IF NOT EXISTS `gameversion` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `idPlateform` int(11) NOT NULL,
  `idGame` int(11) NOT NULL,
  `maxPlayer` int(2) NOT NULL,
  `maxTeam` int(2) NOT NULL,
  `maxPlayerPerTeam` int(2) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(350) NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Contenu de la table `gameversion`
--

-- --------------------------------------------------------

--
-- Structure de la table `matchs`
--
/*"s" nécessaire pr éviter toutn conflit ac l'alias match de SQL*/
DROP TABLE IF EXISTS `matchs`;
CREATE TABLE IF NOT EXISTS `matchs` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `idWinningTeam` int(11) DEFAULT NULL,
  `proof` varchar(100) DEFAULT NULL,
  `idTournament` int(11) NOT NULL,
  `startDate` int(11) NOT NULL,
  `matchNumber` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `matchparticipants`
--

DROP TABLE IF EXISTS `matchparticipants`;
CREATE TABLE IF NOT EXISTS `matchparticipants` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `idMatch` int(11) NOT NULL,
  `idTeamTournament` int(11) NOT NULL,
  `points` int(5) default 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notationuser`
--

DROP TABLE IF EXISTS `notationuser`;
CREATE TABLE IF NOT EXISTS `notationuser` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_judge` int(11) NOT NULL,
  `id_subject` int(11) NOT NULL,
  `note` int(1) DEFAULT '5'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `platform`
--

DROP TABLE IF EXISTS `platform`;
CREATE TABLE IF NOT EXISTS `platform` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(200) NOT NULL,
  `img` varchar(100) NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Contenu de la table `platform`
--
-- --------------------------------------------------------

--
-- Structure de la table `register`
--

DROP TABLE IF EXISTS `register`;
CREATE TABLE IF NOT EXISTS `register` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `status` int(1) DEFAULT '0',
  `idTeamTournament` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idTournament` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rightsteam`
--

DROP TABLE IF EXISTS `rightsteam`;
CREATE TABLE IF NOT EXISTS `rightsteam` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `idUser` int(11) DEFAULT NULL,
  `idTeam` int(11) DEFAULT NULL,
  `right` int(1) DEFAULT '0',
  `title` varchar(45) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `signalmentsuser`
--

DROP TABLE IF EXISTS `signalmentsuser`;
CREATE TABLE IF NOT EXISTS `signalmentsuser` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `subject` varchar(255),
  `description` text,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_indic_user` int(11) NOT NULL,
  `id_signaled_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

DROP TABLE IF EXISTS `team`;
CREATE TABLE IF NOT EXISTS `team` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `status` int(1) DEFAULT 1,
  `name` varchar(45) NOT NULL,
  `img` varchar(100) DEFAULT NULL,
  `slogan` varchar(100) DEFAULT NULL,
  `id_user_creator` int(11) NOT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `teams_joined`
--

DROP TABLE IF EXISTS `teams_joined`;
CREATE TABLE IF NOT EXISTS `teams_joined` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idTeam` int(11) NOT NULL,
  `dateJoin` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dateDeparture` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `teamtournament`
--

DROP TABLE IF EXISTS `teamtournament`;
CREATE TABLE IF NOT EXISTS `teamtournament` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `rank` int(2) DEFAULT NULL,
  `idTournament` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tournament`
--

DROP TABLE IF EXISTS `tournament`;
CREATE TABLE IF NOT EXISTS `tournament` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `startDate` int(11) NOT NULL,
  `endDate` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `typeTournament` int(1) DEFAULT '1',
  `status` int(1) DEFAULT '1',
  `nbMatch` int(2) DEFAULT 0,
  `idUserCreator` int(11) NOT NULL,
  `idGameVersion` int(11) NOT NULL,
  `randomPlayerMix` int(1) DEFAULT 0,
  `guildOnly` int(1) DEFAULT 0,
  `idWinningTeam` int(11) DEFAULT NULL,
  `urlProof` varchar(150) DEFAULT NULL,
  `link` varchar(100) NOT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `typegame`
--

DROP TABLE IF EXISTS `typegame`;
CREATE TABLE IF NOT EXISTS `typegame` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `img` varchar(250) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Contenu de la table `typegame`
--


-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `pseudo` varchar(45) NOT NULL,
  `birthday` int(11) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `kind` tinyint(1) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` int(1) DEFAULT '0',
  `img` varchar(100) DEFAULT NULL,
  `idTeam` int(11) DEFAULT NULL,
  `isConnected` tinyint(1) DEFAULT '0',
  `lastConnexion` int(11) DEFAULT NULL,
  `token` varchar(200) NOT NULL,
  `rss` tinyint(1) DEFAULT '0',
  `authorize_mail_contact` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Contenu de la table `user`
--


--
-- Index pour les tables exportées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD KEY `idUser_idc` (`idUser`);
  
--
-- Index pour la table `game`
--
ALTER TABLE `game`
  ADD KEY `idType_idx` (`idType`);

--
-- Index pour la table `gameversion`
--
ALTER TABLE `gameversion`
  ADD KEY `idPlateform_idx` (`idPlateform`),
  ADD KEY `idGame_idx` (`idGame`);

--
-- Index pour la table `matchs`
--
ALTER TABLE `matchs`
  ADD KEY `idWinningTeam_idx` (`idWinningTeam`),
  ADD KEY `idTournament_idx` (`idTournament`);

--
-- Index pour la table `matchparticipants`
--
ALTER TABLE `matchparticipants`
  ADD KEY `idMatch_idx` (`idMatch`),
  ADD KEY `idTeamTournament` (`idTeamTournament`);

--
-- Index pour la table `notationuser`
--
ALTER TABLE `notationuser`
  ADD KEY `id_judge_idx` (`id_judge`),
  ADD KEY `id_subject_idx` (`id_subject`);

--
-- Index pour la table `platform`
--


--
-- Index pour la table `register`
--
ALTER TABLE `register`
  ADD KEY `idTeam_match_idx` (`idTeamTournament`),
  ADD KEY `idUser_idx` (`idUser`),
  ADD KEY `idTournament_idx` (`idTournament`);

--
-- Index pour la table `rightsteam`
--
ALTER TABLE `rightsteam`
  ADD KEY `idUser_idx` (`idUser`),
  ADD KEY `idTeam_idx` (`idTeam`);

--
-- Index pour la table `signalmentsuser`
--
ALTER TABLE `signalmentsuser`
  ADD KEY `id_indic_user_idx` (`id_indic_user`),
  ADD KEY `id_signaled_user_idx` (`id_signaled_user`);

--
-- Index pour la table `team`
--


--
-- Index pour la table `teams_joined`
--
ALTER TABLE `teams_joined`
  ADD KEY `idUser_idx` (`idUser`),
  ADD KEY `idTeam_idx` (`idTeam`);

--
-- Index pour la table `teamtournament`
--
ALTER TABLE `teamtournament`
  ADD KEY `idTournament_idx` (`idTournament`);

--
-- Index pour la table `tournament`
--
ALTER TABLE `tournament`
  ADD KEY `idUserCreator_idx` (`idUserCreator`),
  ADD KEY `idGameVersion_idx` (`idGameVersion`),
  ADD KEY `idWinningTeam_idx` (`idWinningTeam`);

--
-- Index pour la table `typegame`
--


--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD KEY `idTeam_idx` (`idTeam`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `comment`
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `idUser_idc` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `idType` FOREIGN KEY (`idType`) REFERENCES `typegame` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `gameversion`
--
ALTER TABLE `gameversion`
  ADD CONSTRAINT `idGame` FOREIGN KEY (`idGame`) REFERENCES `game` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idPlateform` FOREIGN KEY (`idPlateform`) REFERENCES `platform` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `matchs`
--
ALTER TABLE `matchs`
  ADD CONSTRAINT `idTournament_m` FOREIGN KEY (`idTournament`) REFERENCES `tournament` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idWinningTeam_m` FOREIGN KEY (`idWinningTeam`) REFERENCES `teamtournament` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `matchparticipants`
--
ALTER TABLE `matchparticipants`
  ADD CONSTRAINT `idMatch` FOREIGN KEY (`idMatch`) REFERENCES `matchs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idTeamTournament` FOREIGN KEY (`idTeamTournament`) REFERENCES `teamtournament` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `notationuser`
--
ALTER TABLE `notationuser`
  ADD CONSTRAINT `id_judge` FOREIGN KEY (`id_judge`) REFERENCES `register` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_subject` FOREIGN KEY (`id_subject`) REFERENCES `register` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `register`
--
ALTER TABLE `register`
  ADD CONSTRAINT `idTeamTournament_r` FOREIGN KEY (`idTeamTournament`) REFERENCES `teamtournament` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idTournament_r` FOREIGN KEY (`idTournament`) REFERENCES `tournament` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idUser_r` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `rightsteam`
--
ALTER TABLE `rightsteam`
  ADD CONSTRAINT `idTeam_rights` FOREIGN KEY (`idTeam`) REFERENCES `team` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idUser_rights` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `signalmentsuser`
--
ALTER TABLE `signalmentsuser`
  ADD CONSTRAINT `id_indic_user` FOREIGN KEY (`id_indic_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_signaled_user` FOREIGN KEY (`id_signaled_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `teams_joined`
--
ALTER TABLE `teams_joined`
  ADD CONSTRAINT `idTeam_tj` FOREIGN KEY (`idTeam`) REFERENCES `team` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idUser_tj` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `teamtournament`
--
ALTER TABLE `teamtournament`
  ADD CONSTRAINT `idTournament` FOREIGN KEY (`idTournament`) REFERENCES `tournament` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tournament`
--
ALTER TABLE `tournament`
  ADD CONSTRAINT `idGameVersion` FOREIGN KEY (`idGameVersion`) REFERENCES `gameversion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idUserCreator` FOREIGN KEY (`idUserCreator`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idWinningTeam` FOREIGN KEY (`idWinningTeam`) REFERENCES `teamtournament` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `idTeam` FOREIGN KEY (`idTeam`) REFERENCES `team` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

