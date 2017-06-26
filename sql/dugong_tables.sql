-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 08 Septembre 2016 à 08:03
-- Version du serveur :  5.5.50-0+deb8u1
-- Version de PHP :  5.6.24-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `charlotte_test`
--

-- --------------------------------------------------------

--
-- Structure de la table `dt_class_tables`
--

DROP TABLE IF EXISTS `dt_class_tables`;
CREATE TABLE IF NOT EXISTS `dt_class_tables` (
`id_class_table` int(11) NOT NULL,
  `nom_table` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `id_typo_table` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `dt_class_tables`
--

INSERT INTO `dt_class_tables` (`id_class_table`, `nom_table`, `id_typo_table`) VALUES
(1, 'dt_class_tables', 4),
(2, 'dt_requete', 4),
(3, 'dt_typo_table', 4);

-- --------------------------------------------------------

--
-- Structure de la table `dt_requete`
--

DROP TABLE IF EXISTS `dt_requete`;
CREATE TABLE IF NOT EXISTS `dt_requete` (
`id_requete` int(11) NOT NULL,
  `question_requete` text COLLATE utf8_unicode_ci NOT NULL,
  `sql_requete` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `dt_typo_table`
--

DROP TABLE IF EXISTS `dt_typo_table`;
CREATE TABLE IF NOT EXISTS `dt_typo_table` (
`id_typo_table` int(11) NOT NULL,
  `typo_table` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `dt_typo_table`
--

INSERT INTO `dt_typo_table` (`id_typo_table`, `typo_table`) VALUES
(1, 'Principale'),
(2, 'Liée'),
(3, 'Relation'),
(4, 'Admin');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `dt_class_tables`
--
ALTER TABLE `dt_class_tables`
 ADD PRIMARY KEY (`id_class_table`), ADD UNIQUE KEY `nom_table` (`nom_table`);

--
-- Index pour la table `dt_requete`
--
ALTER TABLE `dt_requete`
 ADD PRIMARY KEY (`id_requete`);

--
-- Index pour la table `dt_typo_table`
--
ALTER TABLE `dt_typo_table`
 ADD PRIMARY KEY (`id_typo_table`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `dt_class_tables`
--
ALTER TABLE `dt_class_tables`
MODIFY `id_class_table` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `dt_requete`
--
ALTER TABLE `dt_requete`
MODIFY `id_requete` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `dt_typo_table`
--
ALTER TABLE `dt_typo_table`
MODIFY `id_typo_table` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
