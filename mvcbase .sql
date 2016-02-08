-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 08 Février 2016 à 15:33
-- Version du serveur :  10.1.9-MariaDB
-- Version de PHP :  5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mvcbase`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `content` varchar(2047) COLLATE utf8_bin NOT NULL,
  `image` varchar(255) COLLATE utf8_bin NOT NULL,
  `idAuthor` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `image`, `idAuthor`, `date`) VALUES
(2, 'article 1', 'content article 1', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcSBCcyv5PNW4gNDmjo0T85CZsNS_LuEu08UhCwkNYH0eA5iokHP', 0, '2016-01-22 12:51:19'),
(3, 'fefezfez', 'fezfffzezeffezfez', '', 1, '2016-01-22 13:26:27'),
(4, 'test 2', 'article 1 test suite', '', 1, '2016-01-22 13:27:00'),
(7, 'where are you', 'content', '', 1, '2016-01-22 13:31:49'),
(8, 'it''s the hard', 'knock life', '', 1, '2016-01-22 14:18:16'),
(9, '', '', '', 1, '2016-01-22 14:20:29');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `content` varchar(2047) COLLATE utf8_bin NOT NULL,
  `idAuthor` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `title`, `content`, `idAuthor`, `date`) VALUES
(1, 'test de categorie', 'test de contenu de categorie', 1, '2016-01-22 15:36:37'),
(2, 'Categorie 2', 'Test avec une deuxieme categorie', 1, '2016-01-28 11:15:40'),
(3, 'Les pandas', 'Ã©trange ours, a la fois mignon et dangereux! ', 1, '2016-02-01 17:16:50'),
(4, 'La choucroute', 'Ici la choucroute sous toutes ses formes', 1, '2016-02-02 12:47:18');

-- --------------------------------------------------------

--
-- Structure de la table `link_user_topic`
--

CREATE TABLE `link_user_topic` (
  `id_user` int(11) NOT NULL,
  `id_topic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `link_user_topic`
--

INSERT INTO `link_user_topic` (`id_user`, `id_topic`) VALUES
(1, 78),
(8, 78),
(1, 80),
(8, 80),
(1, 80),
(8, 80);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `content` varchar(2047) COLLATE utf8_bin NOT NULL,
  `id_author` int(11) NOT NULL,
  `id_topic` int(11) NOT NULL,
  `id_sCategory` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `post`
--

INSERT INTO `post` (`id`, `content`, `id_author`, `id_topic`, `id_sCategory`, `date`) VALUES
(15, 'contenu avec id_sCategory', 1, 24, 1, '2016-02-01 18:57:21'),
(16, 'contenu', 1, 3, 1, '2016-02-01 19:00:25'),
(17, 'lalalalalalaa', 1, 3, 1, '2016-02-01 19:00:32'),
(18, 'contenu  2 pour tests', 1, 19, 1, '2016-02-01 19:01:25'),
(19, 'Existe il vraiment? quelqu''un a des infos la dessus ?', 1, 30, 4, '2016-02-01 19:06:16'),
(20, 'shnafon', 1, 3, 1, '2016-02-01 19:55:56'),
(21, 'IngrÃ©dients / pour 6 personnes  1,5 kg de choucroute crue 600 Ã  800 g de palette fumÃ©e 400 g de poitrine de porc fumÃ©e 4 saucisses de MontbÃ©liard 6 saucisses de Strasbourg 1 oignon 10 baies de geniÃ¨vre 10 grains de poivre noir 2 feuilles de laurier 1 branche de thym 3 clous de girofle 1 cuillÃ¨re Ã  cafÃ© de cumin 50 cl de vin blanc sec (Riesling) 50 cl d''eau 12 pommes de terre moyennes RÃ©alisation  DifficultÃ© PrÃ©paration Cuisson Repos Temps Total Facile 35 mn 2 h 25 mn 2 h 5 h', 1, 31, 5, '2016-02-02 13:01:59'),
(22, '<del> Dream on ! </del>', 1, 31, 5, '2016-02-02 13:03:48'),
(25, '    <script>alert(''tamere'')</script>', 1, 31, 5, '2016-02-02 14:35:22'),
(26, '    test', 1, 31, 5, '2016-02-02 14:58:01'),
(27, 'fezfezfezfez', 1, 34, 5, '2016-02-03 17:03:08'),
(28, 'lalalaa', 1, 35, 4, '2016-02-03 17:55:16'),
(50, 'gezgzegzegze', 1, 58, 2, '2016-02-05 17:10:12'),
(51, '    bordel', 1, 58, 2, '2016-02-05 17:10:18'),
(52, 'test p pour voir ', 1, 59, 2, '2016-02-05 17:10:46'),
(53, 'cardif', 1, 60, 5, '2016-02-05 17:11:44'),
(54, 'bffdbdhr', 1, 60, 5, '2016-02-05 18:36:50'),
(55, 'contenu du topic test', 1, 61, 5, '2016-02-06 12:31:51'),
(56, 'contenu du topic test', 1, 61, 5, '2016-02-06 12:32:38'),
(57, 'contenu du topic test', 1, 61, 5, '2016-02-06 12:37:08'),
(58, 'rzhrtthtrhrt', 1, 64, 5, '2016-02-06 12:37:43'),
(59, 'rzhrtthtrhrt', 1, 64, 5, '2016-02-06 12:38:13'),
(60, 'rzhrtthtrhrt', 1, 64, 5, '2016-02-06 12:39:33'),
(61, 'rzhrtthtrhrt', 1, 64, 5, '2016-02-06 12:40:39'),
(62, 'rzhrtthtrhrt', 1, 64, 5, '2016-02-06 12:50:04'),
(63, 'rzhrtthtrhrt', 1, 64, 5, '2016-02-06 12:51:42'),
(64, 'rzhrtthtrhrt', 1, 64, 5, '2016-02-06 12:52:41'),
(65, 'rzhrtthtrhrt', 1, 64, 5, '2016-02-06 12:53:06'),
(66, 'rzhrtthtrhrt', 1, 64, 5, '2016-02-06 12:54:18'),
(67, 'rzhrtthtrhrt', 1, 64, 5, '2016-02-06 12:54:42'),
(68, 'rzhrtthtrhrt', 1, 64, 5, '2016-02-06 13:14:01'),
(69, 'rzhrtthtrhrt', 1, 64, 5, '2016-02-06 13:14:33'),
(70, 'rzhrtthtrhrtvsddsvsd', 1, 76, 5, '2016-02-06 13:14:39'),
(71, 'rzhrtthtrhrtvsddsvsd', 1, 76, 5, '2016-02-06 13:15:27'),
(72, 'rzhrtthtrhrtvsddsvsd', 1, 78, 5, '2016-02-06 13:15:34'),
(73, 'rzhrtthtrhrtvsddsvsd', 1, 78, 5, '2016-02-06 13:18:23'),
(74, 'trolalalalalala', 1, 80, 1, '2016-02-06 13:46:45'),
(94, '    ecezceczezc', 1, 80, 1, '2016-02-08 10:05:50'),
(95, '    ezccececez', 1, 80, 1, '2016-02-08 10:06:02'),
(96, 'La choucloute de la mexico !', 1, 81, 5, '2016-02-08 10:18:52'),
(97, 'La choucloute de la mexico !', 1, 82, 5, '2016-02-08 10:40:08'),
(98, 'La choucloute de la mexico !', 1, 82, 5, '2016-02-08 10:40:17');

-- --------------------------------------------------------

--
-- Structure de la table `scategory`
--

CREATE TABLE `scategory` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `content` varchar(2047) COLLATE utf8_bin NOT NULL,
  `id_author` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `scategory`
--

INSERT INTO `scategory` (`id`, `title`, `content`, `id_author`, `id_category`, `date`) VALUES
(1, 'grgr', 'ggzgzezezeggze', 1, 1, '2016-01-28 15:02:11'),
(2, 'grgr 2', 'ggzgzezezeggze 2', 1, 1, '2016-01-28 15:02:31'),
(3, 'test de Scategorie 2', 'Content blabla du premier post de Scategorie 2', 1, 2, '2016-01-28 15:14:56'),
(4, 'Pand aÃ©rien', 'Des panda volant ! c''est fou mais Ã§a arrive, c''est des panda, qui ont des ailes , ou certains juste des supers pouvoirs', 1, 3, '2016-02-01 19:02:28'),
(5, 'Choucroute garnie', 'plus de dÃ©tails sur ce type de choucroute', 1, 4, '2016-02-02 12:52:55');

-- --------------------------------------------------------

--
-- Structure de la table `topic`
--

CREATE TABLE `topic` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `vues` int(11) NOT NULL DEFAULT '0',
  `id_author` int(11) NOT NULL,
  `id_scategory` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `topic`
--

INSERT INTO `topic` (`id`, `title`, `vues`, `id_author`, `id_scategory`, `date`) VALUES
(3, 'test de topic', 3, 1, 1, '2016-01-29 11:17:17'),
(19, 'test de topic 2', 2, 1, 1, '2016-01-29 13:54:05'),
(30, 'Super Panda', 1, 1, 4, '2016-02-01 19:06:16'),
(31, 'Petite recette facile', 40, 1, 5, '2016-02-02 13:01:36'),
(35, 'test', 5, 1, 4, '2016-02-03 17:55:16'),
(36, 'test de dtopic sup', 4, 1, 1, '2016-02-03 18:07:24'),
(58, 'encore un test', 2, 1, 2, '2016-02-05 17:10:12'),
(59, 'test 2 pour voir ce qui s''affiche', 1, 1, 2, '2016-02-05 17:10:46'),
(60, 'pile dÃ©chargÃ©', 4, 1, 5, '2016-02-05 17:11:44'),
(61, 'lalala le topic test', 0, 1, 5, '2016-02-06 12:31:51'),
(64, 'hthtttr', 0, 1, 5, '2016-02-06 12:37:43'),
(76, 'hthtttrvdsvsdvd', 1, 1, 5, '2016-02-06 13:14:39'),
(78, 'hthtttrvdsvsdvdf', 3, 1, 5, '2016-02-06 13:15:34'),
(80, 'et lalaal le topic', 35, 1, 1, '2016-02-06 13:46:45'),
(81, 'el choucloute', 3, 1, 5, '2016-02-08 10:18:52'),
(82, 'el choucloutes', 20, 1, 5, '2016-02-08 10:39:31');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `public` int(11) NOT NULL,
  `avatar` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'http://idata.over-blog.com/2/03/54/79//OWD40020-XL_500.jpg',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `privilege` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `email`, `public`, `avatar`, `date`, `last_date`, `privilege`) VALUES
(1, 'hollux', '$2y$10$c42ulGCEmpDSNZfiflZ5HutwoQzqRPFJMwTbVMXv6cyOd8pOtHOx2', 'hollux@hotmail.fr', 0, 'http://idata.over-blog.com/2/03/54/79//OWD40020-XL_500.jpg', '2015-12-26 17:07:15', '0000-00-00 00:00:00', 2),
(8, 'hollux2', '$2y$10$0BCZjEJqcPNwxkuI3TMCve19Yumn6rqo./om36LQTfBsMvqOd5avq', 'hollux2@hotmail.fr', 0, 'http://idata.over-blog.com/2/03/54/79//OWD40020-XL_500.jpg', '2016-01-22 09:38:13', '0000-00-00 00:00:00', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `scategory`
--
ALTER TABLE `scategory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Index pour la table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD UNIQUE KEY `title_2` (`title`),
  ADD UNIQUE KEY `title_3` (`title`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT pour la table `scategory`
--
ALTER TABLE `scategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
