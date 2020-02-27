-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  jeu. 27 fév. 2020 à 15:28
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `drive`
--

-- --------------------------------------------------------

--
-- Structure de la table `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `disk_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` int(11) NOT NULL,
  `content_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `file`
--

INSERT INTO `file` (`id`, `disk_name`, `file_name`, `file_size`, `content_type`, `user_id`, `created`, `updated`) VALUES
(1, 'bdbsdhsggbdh-5e4e98ad338aa.jpeg', 'dqsdnqjdqsd', 2097152, 'bdshbdhsd', 1, '2020-02-20 14:33:17', '2020-02-20 14:33:17'),
(2, 'bdbsdhsggbdh-5e4e98d8529a3.jpeg', 'dqsdnqjdqsd', 2097152, 'bdshbdhsd', 1, '2020-02-20 14:34:00', '2020-02-20 14:34:00'),
(3, 'bdbsdhsggbdh-5e4e98e61b91a.jpeg', 'dqsdnqjdqsd', 2097152, 'bdshbdhsd', 1, '2020-02-20 14:34:14', '2020-02-20 14:34:14'),
(4, 'bdbsdhsggbdh-5e4e98ea9566d.jpeg', 'dqsdnqjdqsd', 2097152, 'bdshbdhsd', 1, '2020-02-20 14:34:18', '2020-02-20 14:34:18'),
(5, 'bdbsdhsggbdh-5e4ea9e6e2a2a.jpeg', 'dqsdnqjdqsd', 2097152, 'bdshbdhsd', 1, '2020-02-20 15:46:46', '2020-02-20 15:46:46'),
(6, 'bdbsdhsggbdh-5e562ebb1be0c.mp4', 'dqsdnqjdqsqdsqdsd', 2097152, 'dqsdbdshbsqdsddhsd', 1, '2020-02-26 08:39:23', '2020-02-26 08:39:23'),
(7, 'bdbsdhsggbdh-5e564c2832724.mp4', 'dqsdnqjdqsqdsqdsd', 2097152, 'dqsdbdshbsqdsddhsd', 1, '2020-02-26 10:44:56', '2020-02-26 10:44:56'),
(8, 'bdbsdhsggbdh-5e564ca07f6e4.mp4', 'ttttttttttttt', 2097152, 'videos', 1, '2020-02-26 10:46:56', '2020-02-26 10:46:56'),
(9, 'bdbsdhsggbdh-5e5655901adea.pdf', 'ttttttttttttt', 2097152, 'videos', 1, '2020-02-26 11:25:04', '2020-02-26 11:25:04'),
(10, 'bdbsdhsggbdh-5e57d27c6e8d1.mp4', 'tttttttttttcfcfcftt', 2097152, 'videos', 1, '2020-02-27 14:30:20', '2020-02-27 14:30:20');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200220090847', '2020-02-20 11:49:34'),
('20200220091036', '2020-02-20 11:49:34'),
('20200220114855', '2020-02-20 11:49:35');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `roles`) VALUES
(1, 'bdshbdhsd@yopmail.com', '$2y$13$TySRGrzU5TMQlVeS9nMyj.64B./WZWdrlGjCBWT6h1E01Mk5Yc7Oi', '[]'),
(2, 'bdshbddhsd@yopmail.com', '$2y$13$K8EFkJ28jN6Vr2Cdr6.aOeXR9Km1TNLZRLV2J/W4LQ0iS1E79PDlK', '[]');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
