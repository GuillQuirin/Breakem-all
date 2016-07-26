--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `name`, `firstname`, `pseudo`, `birthday`, `description`, `kind`, `city`, `email`, `password`, `status`, `img`, `idTeam`, `isConnected`, `lastConnexion`, `token`, `rss`, `authorize_mail_contact`) VALUES
(1, NULL, NULL, 'Dylan', 655555371, 'Ne te retiens pas', NULL, NULL, 'Dylan@breakemall.com', '$2y$10$ImEAJhCQtLSkYxyonLC3Iu31jTeEO9vxnXaBOPaVgxxVfZHECW5.m', 3, 'dylan.jpg', NULL, 0, 1469301416, '', 0, 1),
(2, NULL, NULL, 'Meghan', 939551662, 'Never fall', NULL, NULL, 'Meghan@breakemall.com', '$2y$10$axNCynFJE8LHuSdHdXMKVOJun.CVdVbXxCPUu8vQTUF1Xg1KxzdGi', 3, 'meghan.jpg', NULL, 1, 1469357062, '', 0, 1),
(3, NULL, NULL, 'Guillaume', 506076790, 'Toujours la pour toi !', NULL, NULL, 'Guillaume@breakemall.com', '$2y$10$ImEAJhCQtLSkYxyonLC3Iu31jTeEO9vxnXaBOPaVgxxVfZHECW5.m', 3, 'guillaume.jpg', NULL, 0, 1469356844, '', 0, 1),
(4, NULL, NULL, 'Teddy', 655553306, 'Jamais vaincu', NULL, NULL, 'Teddy@breakemall.com', '$2y$10$ImEAJhCQtLSkYxyonLC3Iu31jTeEO9vxnXaBOPaVgxxVfZHECW5.m', 3, 'teddy.jpg', NULL, 0, 1469356870, '', 0, 1),
(5, NULL, NULL, 'Remy', 655555371, 'J''espère gagner', NULL, NULL, 'Remy@breakemall.com', '$2y$10$ImEAJhCQtLSkYxyonLC3Iu31jTeEO9vxnXaBOPaVgxxVfZHECW5.m', 3, 'remy.jpg', NULL, 0, 1469356887, '', 0, 1),
(6, NULL, NULL, 'Megchan', 566304256, NULL, NULL, NULL, 'megchan@breakemall.com', '$2y$10$8K2YzJlApFI5JAO2JhdWhOqFAq/5zYvKaj835fyUJNqmzrT4zuEQa', 1, NULL, NULL, 0, 1469353509, '', 0, 1),
(7, NULL, NULL, 'Reconnois', 471696342, NULL, NULL, NULL, 'reconnois@breakemall.com', '$2y$10$/PQrJ3k2whhA.PlRN..dzuCv19wC7wzbl.K9ZH6CmZfvONERMxAgS', 1, NULL, NULL, 0, 1469353559, '', 0, 1),
(8, NULL, NULL, 'Rayz', 566307203, NULL, NULL, NULL, 'rayz@breakemall.com', '$2y$10$SRRqrS1zd7qeEm7Nb1XPbup9n0GuZwOhic0zC91q7KCB0veSMKJy6', 1, NULL, NULL, 0, 1469356853, '', 0, 1),
(9, NULL, NULL, 'Teddou', 913460438, NULL, NULL, NULL, 'teddou@breakemall.com', '$2y$10$oEXXipxMOaowbOgTvRl6Nu5rg0wH4CCkMFZU3NWMTKFaTa4KbU9gm', 1, NULL, NULL, 0, NULL, '', 0, 1),
(10, NULL, NULL, 'Dydou', 913460438, NULL, NULL, NULL, 'dydou@breakemall.com', '$2y$10$4yBPG0awhOgmr8nZN9SoLepTEnWbUHEv4KT/UdfslXifCkROEZdsS', 1, NULL, NULL, 0, NULL, '', 0, 1),
(11, NULL, NULL, 'DeathPart', 913460438, NULL, NULL, NULL, 'deathpart@breakemall.com', '$2y$10$0F6nVMc4Ff.bXMQORwk9RNULL', 1, NULL, NULL, 0, NULL, '', 0, 1),
(12, NULL, NULL, 'RedFort', 913460438, NULL, NULL, NULL, 'redfort@breakemall.com', '$2y$10$WpD9EXOlPGCmijTWRhB35eSlNPtz415ltdWCV376ulP6kA49KzleO', 1, NULL, NULL, 0, NULL, '', 0, 1),
(18, NULL, NULL, 'Gorgous', 913460438, NULL, NULL, NULL, 'gorgous@breakemall.com', '$2y$10$WxCOeBandK3i4Y.yokONou1J6J/u27QJoju1KbsAIs7YN0Z8Nnk2q', 1, NULL, NULL, 0, 1469356933, '', 0, 1),
(19, NULL, NULL, 'SuperMan', 913460458, NULL, NULL, NULL, 'superman@breakemall.com', '$2y$10$FVUiTCLJDrvqD87kNRvOBOS1ijx/vjn6.fbo.NO51QfLIqlO1lKou', 1, NULL, NULL, 0, 1469356985, '', 0, 1),
(20, NULL, NULL, 'Wonder', 566305709, NULL, NULL, NULL, 'wonder@breakemall.com', '$2y$10$orzlr0paa7Kd64tKKgcMdu1YULe07j84x5Y077kAS5bJlx1prvVAO', 1, NULL, NULL, 0, 1469356897, '', 0, 1),
(21, NULL, NULL, 'Virus', 566305998, NULL, NULL, NULL, 'virus@breakemall.com', '$2y$10$ys.0UVX2mr13ReoiRh/tQusIooURs51D72wVzVSa5qZGgnaTU77Z2', 1, NULL, NULL, 0, 1469356964, '', 0, 1),
(22, NULL, NULL, 'Vanitas', 566306215, NULL, NULL, NULL, 'vanitas@breakemall.com', '$2y$10$Yb3h4FBmGTumWHJ5va4ZguUcNBqh98QezEwyv5N4hGq5pui.vm1Iu', 1, NULL, NULL, 0, NULL, '', 0, 1);

--
-- Contenu de la table `team`
--

INSERT INTO `team` (`id`, `status`, `name`, `img`, `slogan`, `id_user_creator`, `description`) VALUES
(1, 1, 'TeamDeLaMort', 'ehome.jpg', 'Un pour un un pour tous', 1, 'Team pour tous les noobs'),
(3, 1, 'Super Team', 'navi.jpg', 'Venez participer aux tournois avec nous !', 21, 'Super description, rejoignez-nous !'),
(4, 1, 'Wonder Cross', 'secret.jpg', 'Les femmes sont plus fortes que les hommes', 20, 'Love you'),
(5, 1, 'Risquer le tout pour le tout', 'virtus.jpg', 'Rien ne nous arrêtera', 3, 'Never stop'),
(6, 1, 'SuperTeam', 'SuperTeam.jpg', NULL, 22, 'jbvdj'),
(7, 1, 'MegTeam', 'MegTeam.jpg', 'Notre team sera la meilleure', 2, 'cezsbcuesdbcvuedbufced fvuesbduc vubdsv urdvbfgur urfgbvufrvds vvjdf vfdg vjfd vjfd v dhv hfd gvhrfdhhrhvgf gr fd vhr gvrfdhv hfrg rfd hg hrdf vghrghbrdf ghrugbrdf grugburdf gurbdugvfuj');


UPDATE user SET idTeam = 1 WHERE id = 1;
UPDATE user SET idTeam = 1 WHERE id = 2;
UPDATE user SET idTeam = 5 WHERE id = 3;
UPDATE user SET idTeam = 5 WHERE id = 5;
UPDATE user SET idTeam = 4 WHERE id = 20;
UPDATE user SET idTeam = 3 WHERE id = 6;
UPDATE user SET idTeam = 1 WHERE id = 7;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `comment`, `idUser`, `idEntite`, `date`, `status`, `entite`) VALUES
(16, 'Véritable sérieux des joueurs je suis impressionné par leur qualité à être assidu.', 2, 16, '2016-07-24 10:56:37', 0, 1),
(17, 'J&#39;adore cette team ! Des joueurs cool et sympa !', 4, 16, '2016-07-24 10:57:20', 0, 1),
(18, 'Leader sérieux et pleins de prévenance !', 18, 1, '2016-07-24 10:57:51', 0, 1),
(19, 'Super team je vous le dit !! Veneezzz aaah', 21, 3, '2016-07-24 10:58:19', 0, 1),
(20, 'Pas terrible la team... Mais je reste quand même =D', 5, 5, '2016-07-24 10:59:39', 0, 1),
(21, 'Espèce de ****', 5, 5, '2016-07-24 10:59:52', -1, 1),
(22, 'Bravo à vous tous !', 1, 1, '2016-07-24 11:03:07', 0, 1);



--
-- Contenu de la table `typegame`
--

INSERT INTO `typegame` (`id`, `name`, `description`, `img`, `status`) VALUES
(-1, 'poubelle', '', '', -1),
(1, 'moba', 'Il s''agit d''un genre essentiellement multijoueur, qui se joue généralement avec deux équipes de cinq joueurs1. L''objectif pour chaque équipe est de détruire la structure principale de l''équipe adverse, au moyen des personnages contrôlés par chaque joueur et avec l''aide des unités contrôlées par l''ordinateur.', 'typegame-moba.jpg', 1),
(2, 'fps', 'Dans la lignée des Doom et Wolfenstein, vous serez immergé dans un jeu de tir avec une vue à la première personne. Comme si vous y étiez', 'typegame-fps.jpg', 1),
(3, 'course', 'Prenez le volant d''une voiture, d''une moto, qui sait, d''un vélo ou encore d''un snowboard qui sait. Ce genre de jeu est fait pour les mordus de la rapidité.', 'typegame-course.jpg', 1),
(4, 'fight', 'Tekken, Street Fighter, Super Smash Bros, autant de jeux pour se mettre de bonnes torgnoles amicales dans la face. Rien de tel qu''un bon jeu de combat pour essayer toutes les touches de sa manette.', 'typegame-fighting.jpg', 1),
(5, 'sport', 'Pour avoir bonne conscience et pouvoir te dire qu''aurjourd''hui t''as fait un match plein d''envie et que les joueurs se sont bie dépensés c''est par ici', 'typegame-sport.jpg', 1);




--
-- Contenu de la table `game`
--

INSERT INTO `game` (`id`, `name`, `description`, `img`, `year`, `idType`, `status`) VALUES
(-1, 'poubelle', '', '', 0, -1, -1),
(1, 'super smash bros melee', 'Voici l''ambiance Nintendo par excellence. Le jeu qui a révolutionné le jeu de combat et façonné tout une génération. Prends contrôle de légendaires pokémon pour taper dans les pif de mario ou link dans un combat passionément amusant.', 'ssb-bg.jpg', 655555371, 4, 1),
(2, 'battlefield 3', 'L''un des tout meilleurs FPS sur PC. Plongez dans un conflit moderne qui embrase les 4 coins du monde. Avec ses 4 classes customisables, ses armes modifiables, ses nombreux véhicules et son système d''escouade, il s''oriente principalement vers le jeu d''équipe.', 'bf3-bg.jpg', 655555371, 2, 1),
(3, 'counter strike source', 'On ne présente plus le légendaire Counter Strike: Source. Pur produit de nolife geek optimisé pour les fous furieux passant leurs temps à headshot leurs adversaires. Avec ou sans visée. Oubliez la signification du mot frustration. La force viendra en persévérant', 'css-bg.png', 655555371, 2, 1),
(4, 'league of legends', 'Le sport électronique à son paroxisme. Phénomène des clics depuis plus de 4 ans, League of Legends t''amènera dans une arène de laquelle tu ne pourras plus sortir sans y prendre goût ! Incarne un invocateur et lutte avec tes camarades pour faire tomber l''ennemi.', 'lol-bg.jpg', 655555371, 1, 1),
(5, 'Fifa 2016', 'Le plus reconnu des jeux de foot de notre ère. Avec cette refonte version 2015-2016, Fifa fait la part belle aux véritables stratèges du foot, vos défenseurs ne sont plus des rails sur un wagon. Pour gagner il faut maintenant s''entrainer. La bataille pour le milieu de terrain est en marche !', 'Fifa16-bg.jpg', 655555371, 5, 1),
(6, 'need for speed', 'La tuerie de la conduite de l''année 2015. L''aspect arcade et la violence des chocs vous feront passer l''envie d''essayer d''autres jeux de conduite. Tout y est fait pour exploser vos adversaires, mais attention les dégâts sont cumulatifs. Le but reste toujours de finir la course !', 'NFS-bg.jpg', 655555371, 3, 1);


--
-- Contenu de la table `platform`
--

INSERT INTO `platform` (`id`, `name`, `description`, `img`, `status`) VALUES
(-1, 'poubelle', '', '', -1),
(1, 'ps3', 'Ancienne console mais toujours là!', 'ps3.png', 1),
(2, 'ps4', 'Dernier console chez sony', 'ps4.png', 1),
(3, 'xbox one', 'Dernier console de Microsoft', 'xboxone.png', 1),
(4, 'xbox 360', 'Ancienne console mais toujours là !', 'xbox360.png', 1),
(5, 'pc', 'Pour les meilleurs', 'pc.png', 1),
(6, 'wii', 'Nintendo en place !', 'wii.png', 1);

--
-- Contenu de la table `gameversion`
--

INSERT INTO `gameversion` (`id`, `idPlateform`, `idGame`, `maxPlayer`, `maxTeam`, `maxPlayerPerTeam`, `name`, `description`, `status`) VALUES
(-1, -1, -1, 0, 0, 0, 'poubelle', '', -1),
(1, 6, 1, 8, 8, 1, 'Free For all', 'Chacun pour soit', 1),
(2, 6, 1, 32, 8, 4, 'Match à mort par équipe', 'Chaque team pour soit', 1),
(3, 1, 2, 192, 8, 24, 'Ruée', 'Attaquez et defendez des positions à tour de rôle', 1),
(4, 1, 2, 192, 8, 12, 'Match à mort par équipe', 'Chacun pour soit', 1),
(5, 1, 2, 48, 48, 1, 'Free For all', 'Chacun pour soit', 1),
(6, 2, 2, 192, 8, 24, 'Ruée', 'Attaquez et defendez des positions à tour de rôle', 1),
(7, 2, 2, 192, 8, 12, 'Match à mort par équipe', 'Chaque team pour soit', 1),
(8, 2, 2, 48, 48, 1, 'Free For all', 'Chacun pour soit', 1),
(9, 3, 2, 192, 8, 24, 'Ruée', 'Attaquez et defendez des positions à tour de rôle', 1),
(10, 3, 2, 192, 8, 12, 'Match à mort par équipe', 'Chaque team pour soit', 1),
(11, 3, 2, 48, 48, 1, 'Free For all', 'Chacun pour soit', 1),
(12, 4, 2, 192, 8, 24, 'Ruée', 'Attaquez et defendez des positions à tour de rôle', 1),
(13, 4, 2, 192, 8, 12, 'Match à mort par équipe', 'Chaque team pour soit', 1),
(14, 4, 2, 48, 48, 1, 'Free For all', 'Chacun pour soit', 1),
(15, 5, 2, 192, 8, 24, 'Ruée', 'Attaquez et defendez des positions à tour de rôle', 1),
(16, 5, 2, 192, 8, 12, 'Match à mort par équipe', 'Chaque team pour soit', 1),
(17, 5, 2, 48, 48, 1, 'Free For all', 'Chacun pour soit', 1),
(18, 5, 3, 96, 16, 6, 'Match à mort par équipe', 'Chaque team pour soit', 1),
(19, 5, 4, 60, 12, 5, 'Classic moba par equipe', 'Chaque team pour soit', 1),
(20, 1, 5, 32, 16, 2, 'Fifa par equipe', 'Chaque team pour soit', 1),
(21, 1, 5, 16, 16, 1, 'Fifa solo', 'Chacun pour soit', 1),
(22, 2, 5, 32, 16, 2, 'Fifa par equipe', 'Chaque team pour soit', 1),
(23, 2, 5, 16, 16, 1, 'Fifa solo', 'Chacun pour soit', 1),
(24, 3, 5, 32, 16, 2, 'Fifa par equipe', 'Chaque team pour soit', 1),
(25, 3, 5, 16, 16, 1, 'Fifa solo', 'Chacun pour soit', 1),
(26, 4, 5, 32, 16, 2, 'Fifa par equipe', 'Chaque team pour soit', 1),
(27, 4, 5, 16, 16, 1, 'Fifa solo', 'Chacun pour soit', 1),
(28, 5, 5, 32, 16, 2, 'Fifa par equipe', 'Chaque team pour soit', 1),
(29, 5, 5, 16, 16, 1, 'Fifa solo', 'Chacun pour soit', 1),
(30, 1, 6, 16, 16, 1, 'NFS solo', 'Chacun pour soit', 1),
(31, 2, 6, 16, 16, 1, 'NFS solo', 'Chacun pour soit', 1),
(32, 3, 6, 16, 16, 1, 'NFS solo', 'Chacun pour soit', 1),
(33, 4, 6, 16, 16, 1, 'NFS solo', 'Chacun pour soit', 1),
(34, 5, 6, 16, 16, 1, 'NFS solo', 'Chacun pour soit', 1),
(35, 6, 6, 16, 16, 1, 'NFS solo', 'Chacun pour soit', 1);



--
-- Contenu de la table `tournament`
--

INSERT INTO `tournament` (`id`, `startDate`, `endDate`, `name`, `description`, `typeTournament`, `status`, `nbMatch`, `idUserCreator`, `idGameVersion`, `randomPlayerMix`, `guildOnly`, `idWinningTeam`, `urlProof`, `link`, `creationDate`) VALUES
(1, 1470991843, 1472201443, 'Super tournoi infernal', 'Super tournoi de guilde venez tous !!', 1, 1, 0, 2, 2, 0, 1, NULL, NULL, '$2y$10$S2WSmH7UR.jgVqoNmCS/OOKC3J/WPjk2..Tz0qXtLCqayKshkZisK', '2016-07-22 08:50:46'),
(2, 1469178701, 1470647496, 'Venez vous battre', 'Don''t forget, you''re the best', 1, 1, 0, 2, 2, 1, 0, NULL, NULL, '$2y$10$eBd2p0Mz6J4lQHmlThmrSufQe3jkO0LqE.033p8Xf2Y8YmlNrdQLW', '2016-07-22 09:10:49'),
(3, 1469276164, 1470485764, 'Best tournoi', '', 1, 1, 0, 2, 23, 1, 0, NULL, NULL, '$2y$10$HdlTGBftteW0PiX0DcGnO.m9FNy7Bet0aGDQ9WhwgtC8dChj1HPYG', '2016-07-22 12:16:06'),
(4, 1469615470, 1470825070, 'Defend ta tour contre tous', 'Venez participer à mon tournoi, que le meilleur gagne !', 1, 1, 0, 2, 9, 1, 0, NULL, NULL, '$2y$10$67PjIvMdf3FiLciLGyaSKOx2pHILp2yseMrbRVUR6vJWhOKIqEeme', '2016-07-24 10:31:13'),
(5, 1470134419, 1471344019, 'A celui qui ira le plus vite', 'A vous les manettes ! Venez vous affronter dans un élan de vitesse', 1, 1, 0, 2, 31, 1, 0, NULL, NULL, '$2y$10$UgtymCwCiMXpvp7ZMq8wS.mf38.Vipj5c4fc/HSD2DqKlPxxNIr/K', '2016-07-24 10:40:21');


--
-- Contenu de la table `teamtournament`
--

INSERT INTO `teamtournament` (`id`, `rank`, `idTournament`) VALUES
(1, NULL, 1),
(2, NULL, 1),
(3, NULL, 1),
(4, NULL, 1),
(5, NULL, 1),
(6, NULL, 1),
(7, NULL, 1),
(8, NULL, 1),
(9, NULL, 2),
(10, NULL, 2),
(11, NULL, 2),
(12, NULL, 2),
(13, NULL, 2),
(14, NULL, 2),
(15, NULL, 2),
(16, NULL, 2),
(17, NULL, 3),
(18, NULL, 3),
(19, NULL, 3),
(20, NULL, 3),
(21, NULL, 3),
(22, NULL, 3),
(23, NULL, 3),
(24, NULL, 3),
(25, NULL, 3),
(26, NULL, 3),
(27, NULL, 3),
(28, NULL, 3),
(29, NULL, 3),
(30, NULL, 3),
(31, NULL, 3),
(32, NULL, 3),
(33, NULL, 4),
(34, NULL, 4),
(35, NULL, 4),
(36, NULL, 4),
(37, NULL, 4),
(38, NULL, 4),
(39, NULL, 4),
(40, NULL, 4),
(41, NULL, 5),
(42, NULL, 5),
(43, NULL, 5),
(44, NULL, 5),
(45, NULL, 5),
(46, NULL, 5),
(47, NULL, 5),
(48, NULL, 5),
(49, NULL, 5),
(50, NULL, 5),
(51, NULL, 5),
(52, NULL, 5),
(53, NULL, 5),
(54, NULL, 5),
(55, NULL, 5),
(56, NULL, 5);



--
-- Contenu de la table `register`
--

INSERT INTO `register` (`id`, `status`, `idTeamTournament`, `idUser`, `idTournament`) VALUES
(2, 1, 2, 3, 1),
(3, 1, 4, 5, 1),
(4, 1, 3, 4, 1),
(5, 2, 9, 2, 2),
(6, 1, 5, 1, 1),
(7, 2, 17, 2, 3),
(8, 1, 5, 7, 1),
(9, 1, 5, 2, 1),
(10, 1, 35, 2, 4),
(11, 1, 33, 3, 4),
(12, 1, 54, 2, 5),
(13, 1, 52, 3, 5),
(14, 1, 47, 8, 5),
(15, 1, 48, 4, 5),
(16, 1, 50, 5, 5),
(17, 1, 41, 18, 5),
(18, 1, 56, 21, 5),
(19, 1, 55, 19, 5);






--
-- Contenu de la table `matchs`
--

INSERT INTO `matchs` (`id`, `idWinningTeam`, `proof`, `idTournament`, `startDate`, `matchNumber`) VALUES
(1, 52, NULL, 5, 1469356995, 1),
(2, 41, NULL, 5, 1469356995, 1),
(3, 48, NULL, 5, 1469356995, 1),
(4, 54, NULL, 5, 1469356995, 1),
(5, 48, NULL, 5, 1469357026, 2),
(6, 54, NULL, 5, 1469357026, 2),
(7, NULL, NULL, 5, 1469357038, 3);


--
-- Contenu de la table `matchparticipants`
--

INSERT INTO `matchparticipants` (`id`, `idMatch`, `idTeamTournament`, `points`) VALUES
(1, 1, 52, 6),
(2, 1, 47, 1),
(3, 2, 50, 1),
(4, 2, 41, 6),
(5, 3, 48, 6),
(6, 3, 55, 1),
(7, 4, 56, 1),
(8, 4, 54, 6),
(9, 5, 48, 7),
(10, 5, 41, 1),
(11, 6, 52, 1),
(12, 6, 54, 7),
(13, 7, 48, 0),
(14, 7, 54, 0);


