-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 25 fév. 2021 à 18:11
-- Version du serveur :  8.0.23-0ubuntu0.20.04.1
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `common-database`
--

-- --------------------------------------------------------

--
-- Structure de la table `follow`
--

CREATE TABLE `follow` (
  `fk_id_follower` int NOT NULL,
  `fk_id_followed` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `hashtag`
--

CREATE TABLE `hashtag` (
  `id_hashtag` int NOT NULL,
  `nom` varchar(143) NOT NULL,
  `fk_id_tweet` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `hashtag`
--

INSERT INTO `hashtag` (`id_hashtag`, `nom`, `fk_id_tweet`) VALUES
(1, '#bébé', 0),
(22, 'Array', 10),
(23, 'coucou', 10),
(24, 'bidule', 4),
(25, 'test1', 4),
(26, 'test2', 4),
(27, 'toto', 4),
(28, 'tata', 4),
(29, 'test1', 4),
(30, 'test2', 4),
(31, 'test3', 4),
(32, 'test4', 4),
(33, 'test5', 4),
(34, 'test6', 4),
(35, 'rennes', 190),
(36, 'paris', 190),
(37, 'bidule', 213),
(38, 'tour', 213);

-- --------------------------------------------------------

--
-- Structure de la table `message_prive`
--

CREATE TABLE `message_prive` (
  `id_message` int NOT NULL,
  `fk_id_user_send` int NOT NULL,
  `fk_id_user_receive` int NOT NULL,
  `message` longtext NOT NULL,
  `date_message` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reponse_tweet`
--

CREATE TABLE `reponse_tweet` (
  `fk_id_tweet` int NOT NULL,
  `message` varchar(144) NOT NULL,
  `date` date NOT NULL,
  `fk_id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `re_tweet`
--

CREATE TABLE `re_tweet` (
  `fk_id_tweet` int NOT NULL,
  `fk_id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE `theme` (
  `id_theme` int NOT NULL,
  `nom_theme` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`id_theme`, `nom_theme`) VALUES
(1, 'Light');

-- --------------------------------------------------------

--
-- Structure de la table `tweet`
--

CREATE TABLE `tweet` (
  `id_tweet` int NOT NULL,
  `fk_id_user` int NOT NULL,
  `tweet` varchar(144) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_id_hashtag` int NOT NULL,
  `date_tweet` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tweet`
--

INSERT INTO `tweet` (`id_tweet`, `fk_id_user`, `tweet`, `fk_id_hashtag`, `date_tweet`) VALUES
(72, 11, '#toto', 1, '2021-02-16'),
(73, 11, '#tata', 1, '2021-02-16'),
(74, 11, '#titi', 1, '2021-02-16'),
(75, 11, 'temps de merde #merde', 1, '2021-02-16'),
(92, 16, 'il fait pas tres beau #temps de merde', 1, '2021-02-25'),
(93, 16, 'il fait pas tres beau #tempsdemerde', 1, '2021-02-25'),
(94, 16, 'sqdsqdsqdsqdqsdqsdqs #test', 1, '2021-02-25'),
(98, 16, 'ssdhjdfvdbfjkruglidfhb #encore', 1, '2021-02-25'),
(101, 16, 'sqdqsdsqdqs #lacamarche', 1, '2021-02-25'),
(102, 16, '#toto', 1, '2021-02-25'),
(104, 16, 'dqsdesfdgdrger #okidoki', 1, '2021-02-25'),
(105, 16, 'er\'&quot;r&quot;\'r&quot;\'r&quot;\'r #okilol', 1, '2021-02-25'),
(106, 16, '#tti', 1, '2021-02-25'),
(107, 16, 'sdqsdqsd #toto', 1, '2021-02-25'),
(108, 16, '#toto', 1, '2021-02-25'),
(109, 16, 'sqdqsdqsdqsdqsdfgdfds #tituto', 1, '2021-02-25'),
(110, 16, 'dqsdqsdqsd #tuto', 1, '2021-02-25'),
(111, 16, 'qsd #tuto', 1, '2021-02-25'),
(112, 16, 'qsdqsd #tuto', 1, '2021-02-25'),
(113, 16, 'sqdqsdq #tuto', 1, '2021-02-25'),
(114, 16, 'sqdqsd #tuto', 1, '2021-02-25'),
(115, 16, 'sqdqsdsq #tuto', 1, '2021-02-25'),
(116, 16, 'ok #test', 1, '2021-02-25'),
(117, 16, 'efeflknze #try', 1, '2021-02-25'),
(118, 16, 'qdqsdqd #try', 1, '2021-02-25'),
(119, 16, 'insert hashtag dans hashtag #testtry', 1, '2021-02-25'),
(120, 16, 'try hashtag #trytest', 1, '2021-02-25'),
(121, 16, 'sqdqdsdfq #totuti', 1, '2021-02-25'),
(122, 16, 'dqdkqdj #tutoti', 1, '2021-02-25'),
(123, 16, '#totobidule', 1, '2021-02-25'),
(124, 16, '#gaelnulaubaby', 1, '2021-02-25'),
(125, 16, 'xxxxx', 1, '2021-02-25'),
(126, 16, 'xxxxx', 1, '2021-02-25'),
(127, 16, 'xxxxx', 1, '2021-02-25'),
(128, 16, 'xxxxx', 1, '2021-02-25'),
(129, 16, 'xxxxx', 1, '2021-02-25'),
(130, 16, 'xxxxxxxxxxaaaaaa', 1, '2021-02-25'),
(131, 16, 'antho #tageul', 1, '2021-02-25'),
(132, 16, 'ddddd', 1, '2021-02-25'),
(133, 16, 'jjjj', 1, '2021-02-25'),
(134, 16, 'ssss', 1, '2021-02-25'),
(135, 16, 'coucou #anthocon', 1, '2021-02-25'),
(136, 16, 'x', 1, '2021-02-25'),
(137, 16, 'xxxx', 1, '2021-02-25'),
(138, 16, '', 1, '2021-02-25'),
(139, 16, '', 1, '2021-02-25'),
(140, 16, '', 1, '2021-02-25'),
(141, 16, '', 1, '2021-02-25'),
(142, 16, '', 1, '2021-02-25'),
(143, 16, '', 1, '2021-02-25'),
(144, 16, '', 1, '2021-02-25'),
(145, 16, '', 1, '2021-02-25'),
(146, 16, '', 1, '2021-02-25'),
(147, 16, '', 1, '2021-02-25'),
(148, 16, '', 1, '2021-02-25'),
(149, 16, 'xxxxxx', 1, '2021-02-25'),
(150, 16, 'bidule #lolililol', 1, '2021-02-25'),
(151, 16, 'machin #trucleturc', 1, '2021-02-25'),
(152, 16, 'sssss #caa', 1, '2021-02-25'),
(153, 16, 'un petit café? #cafe', 1, '2021-02-25'),
(154, 16, '', 1, '2021-02-25'),
(155, 16, 'ok #ok #pasok #probleme', 1, '2021-02-25'),
(156, 16, 'oki ca marche #tryandctach', 1, '2021-02-25'),
(157, 16, 'test 20003576 #itstolong', 1, '2021-02-25'),
(158, 16, 'l\'ane trotro, l\'ane trotro, trop trop rigolo #bestHumour', 1, '2021-02-25'),
(159, 16, 'vg,v,g,fv,f,f, #okilopolouyi', 1, '2021-02-25'),
(160, 16, 'dazedlnzdnedjknzjkdnjd #ok', 1, '2021-02-25'),
(161, 16, 'efzlfhuifizef #toto', 1, '2021-02-25'),
(162, 16, 'ermzefojioijojifopefop #bon', 1, '2021-02-25'),
(163, 16, 'ermzefojioijojifopefop #bon', 1, '2021-02-25'),
(164, 16, 'ermzefojioijojifopefop #bonnasse', 1, '2021-02-25'),
(165, 16, 'ermzefojioijojifopefop #bon #toto', 1, '2021-02-25'),
(166, 16, '#toto', 1, '2021-02-25'),
(167, 16, 'xxxxx #coucou', 1, '2021-02-25'),
(168, 16, 'coucou #bidule #tata', 1, '2021-02-25'),
(169, 16, 'coucou #bidule #tata', 1, '2021-02-25'),
(170, 16, 'coucou #bidule #tata', 1, '2021-02-25'),
(171, 16, 'coucou #bidule #tata', 1, '2021-02-25'),
(172, 16, 'coucou #bidule #tata', 1, '2021-02-25'),
(190, 16, 'coucou #rennes #paris', 1, '2021-02-25'),
(193, 16, 'test #test3 #test4', 1, '2021-02-25'),
(213, 16, 'coucou #bidule #tour', 1, '2021-02-25'),
(214, 16, 'toto', 1, '2021-02-25'),
(215, 12, 'test numero 2 allakir', 1, '2021-02-25'),
(216, 16, 'test numero 1 Allakir', 1, '2021-02-25'),
(217, 14, 'test numero 3 testanto', 1, '2021-02-25');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `date_inscription` date NOT NULL,
  `date_naissance` date NOT NULL,
  `fk_id_theme` int NOT NULL,
  `mail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `name`, `pseudo`, `pass`, `photo`, `description`, `date_inscription`, `date_naissance`, `fk_id_theme`, `mail`) VALUES
(11, 'toto de l\'eau', 'toto', 'toto', '/img', 'j\'aime les frites', '2021-02-11', '2021-02-11', 1, 'toto@gmail.com'),
(12, 'cordon anthony', 'allakir', 'e5d95a394e315dacce96df42fddee71a52ebede0', '/img', 'okidoki test anto', '2021-02-24', '1993-07-27', 1, 'anthony@35cordon.fr'),
(13, 'cordon anthony', 'Totolafrite', 'e5d95a394e315dacce96df42fddee71a52ebede0', '/img', 'Alexolitoubatrestrop', '2021-02-24', '1993-07-27', 1, 'anthony35cordon@gmail.com'),
(14, 'cordon anthony', 'testanto', 'e5d95a394e315dacce96df42fddee71a52ebede0', '/img', 'test voir si tout marche\n', '2021-02-24', '1993-07-27', 1, 'anthony67@gmail.com'),
(15, 'toto lafrite', 'test2anto', 'e5d95a394e315dacce96df42fddee71a52ebede0', '/img', 'on check la vida', '2021-02-24', '1993-07-27', 1, 'lafrite@gmail.com'),
(16, 'cordon anthony', 'Allakir1', 'e5d95a394e315dacce96df42fddee71a52ebede0', '/img', 'comptee test anthony', '2021-02-25', '1993-02-03', 1, 'toto35@hotmail.fr');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `follow`
--
ALTER TABLE `follow`
  ADD KEY `fk_id_follower` (`fk_id_follower`),
  ADD KEY `fk_id_followed` (`fk_id_followed`);

--
-- Index pour la table `hashtag`
--
ALTER TABLE `hashtag`
  ADD PRIMARY KEY (`id_hashtag`);

--
-- Index pour la table `message_prive`
--
ALTER TABLE `message_prive`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `fk_id_user_send` (`fk_id_user_send`),
  ADD KEY `fk_id_user_receive` (`fk_id_user_receive`);

--
-- Index pour la table `reponse_tweet`
--
ALTER TABLE `reponse_tweet`
  ADD KEY `fk_id_tweet` (`fk_id_tweet`),
  ADD KEY `fk_id_user` (`fk_id_user`);

--
-- Index pour la table `re_tweet`
--
ALTER TABLE `re_tweet`
  ADD KEY `fk_id_tweet` (`fk_id_tweet`),
  ADD KEY `fk_id_user` (`fk_id_user`);

--
-- Index pour la table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id_theme`);

--
-- Index pour la table `tweet`
--
ALTER TABLE `tweet`
  ADD PRIMARY KEY (`id_tweet`),
  ADD KEY `fk_id_user` (`fk_id_user`),
  ADD KEY `fk_id_hashtag` (`fk_id_hashtag`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_id_theme` (`fk_id_theme`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `hashtag`
--
ALTER TABLE `hashtag`
  MODIFY `id_hashtag` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `message_prive`
--
ALTER TABLE `message_prive`
  MODIFY `id_message` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `theme`
--
ALTER TABLE `theme`
  MODIFY `id_theme` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `tweet`
--
ALTER TABLE `tweet`
  MODIFY `id_tweet` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`fk_id_follower`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`fk_id_followed`) REFERENCES `users` (`id_user`);

--
-- Contraintes pour la table `message_prive`
--
ALTER TABLE `message_prive`
  ADD CONSTRAINT `message_prive_ibfk_1` FOREIGN KEY (`fk_id_user_send`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `message_prive_ibfk_2` FOREIGN KEY (`fk_id_user_receive`) REFERENCES `users` (`id_user`);

--
-- Contraintes pour la table `reponse_tweet`
--
ALTER TABLE `reponse_tweet`
  ADD CONSTRAINT `reponse_tweet_ibfk_1` FOREIGN KEY (`fk_id_tweet`) REFERENCES `tweet` (`id_tweet`),
  ADD CONSTRAINT `reponse_tweet_ibfk_2` FOREIGN KEY (`fk_id_user`) REFERENCES `users` (`id_user`);

--
-- Contraintes pour la table `re_tweet`
--
ALTER TABLE `re_tweet`
  ADD CONSTRAINT `re_tweet_ibfk_1` FOREIGN KEY (`fk_id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `re_tweet_ibfk_2` FOREIGN KEY (`fk_id_tweet`) REFERENCES `tweet` (`id_tweet`);

--
-- Contraintes pour la table `tweet`
--
ALTER TABLE `tweet`
  ADD CONSTRAINT `tweet_ibfk_1` FOREIGN KEY (`fk_id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `tweet_ibfk_2` FOREIGN KEY (`fk_id_hashtag`) REFERENCES `hashtag` (`id_hashtag`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`fk_id_theme`) REFERENCES `theme` (`id_theme`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
