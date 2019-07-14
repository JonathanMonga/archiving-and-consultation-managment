-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 14 Juillet 2019 à 19:26
-- Version du serveur :  5.6.21
-- Version de PHP :  5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `archivage`
--

-- --------------------------------------------------------

--
-- Structure de la table `archives`
--

CREATE TABLE IF NOT EXISTS `archives` (
  `code_archive` varchar(50) NOT NULL,
  `sujet_travail` varchar(255) DEFAULT NULL,
  `nom_auteur` varchar(50) DEFAULT NULL,
  `prom_auteur` varchar(50) DEFAULT NULL,
  `annee` year(4) DEFAULT NULL,
  `mat_biblio` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `archives`
--

INSERT INTO `archives` (`code_archive`, `sujet_travail`, `nom_auteur`, `prom_auteur`, `annee`, `mat_biblio`) VALUES
('ARCHI002', 'Gestion archivage et consultation dans une institution cas de l''istia.', 'Nsenga Monga', 'G3', 2019, 'BIBLIO001');

-- --------------------------------------------------------

--
-- Structure de la table `bibliothecaire`
--

CREATE TABLE IF NOT EXISTS `bibliothecaire` (
  `mat_biblio` varchar(50) NOT NULL,
  `nom_biblio` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `bibliothecaire`
--

INSERT INTO `bibliothecaire` (`mat_biblio`, `nom_biblio`) VALUES
('BIBLIO001', 'Jonathan Monga Nsenga');

-- --------------------------------------------------------

--
-- Structure de la table `consultant`
--

CREATE TABLE IF NOT EXISTS `consultant` (
  `mat_consult` varchar(50) NOT NULL,
  `nom_consult` varchar(50) DEFAULT NULL,
  `prom_consult` varchar(50) DEFAULT NULL,
  `fac_consult` varchar(50) DEFAULT NULL,
  `inst_consult` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `consultant`
--

INSERT INTO `consultant` (`mat_consult`, `nom_consult`, `prom_consult`, `fac_consult`, `inst_consult`) VALUES
('CONSULT001', 'Jonathan Monga', 'G1', 'Gestion informatique', 'ISES'),
('CONSULT003', 'Ajiveth Mpanga', 'G3', 'Gestion informatique', 'ISES'),
('CONSULT004', 'MIke Mbuya', 'L2', 'Marketing', 'ISS'),
('CONSULT005', 'Leatitia Mutonkole', 'G3', 'Gestion informatique', 'ISES'),
('CONSULT006', 'Heritier', 'L2', 'Gestion informatique', 'ISES');

-- --------------------------------------------------------

--
-- Structure de la table `liste_consultation`
--

CREATE TABLE IF NOT EXISTS `liste_consultation` (
`id` int(11) NOT NULL,
  `date_consult` date DEFAULT NULL,
  `num_fiche` int(11) NOT NULL,
  `heure_entree` time DEFAULT NULL,
  `heure_sortie` time DEFAULT NULL,
  `doc_consult` varchar(255) DEFAULT NULL,
  `mat_consult` varchar(50) DEFAULT NULL,
  `mat_biblio` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `liste_consultation`
--

INSERT INTO `liste_consultation` (`id`, `date_consult`, `num_fiche`, `heure_entree`, `heure_sortie`, `doc_consult`, `mat_consult`, `mat_biblio`) VALUES
(11, '2019-07-11', 2, '13:00:00', '15:00:00', 'Gestion d''un parc animalier cas de la fermer FUTUKA', 'CONSULT005', 'BIBLIO001'),
(12, '2019-07-18', 2, '10:00:00', '15:00:00', 'Gestion d''enregistrement des accidents de circulation', 'CONSULT001', 'BIBLIO001'),
(14, '2019-07-11', 5, '11:11:00', '11:11:00', 'Gestion d''enregistrement des accidents de circulation', 'CONSULT003', 'BIBLIO001'),
(15, '2019-07-14', 5, '12:30:00', '12:40:00', 'Gestion d''enregistrement des accidents de circulation', 'CONSULT001', 'BIBLIO001'),
(16, '2019-07-14', 5, '12:22:00', '12:02:00', 'Gestion d''enregistrement des accidents de circulation', 'CONSULT003', 'BIBLIO001');

-- --------------------------------------------------------

--
-- Structure de la table `numero_liste`
--

CREATE TABLE IF NOT EXISTS `numero_liste` (
`num_fiche` int(11) NOT NULL,
  `annee` varchar(4) COLLATE utf8_unicode_520_ci NOT NULL,
  `state` varchar(50) COLLATE utf8_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Contenu de la table `numero_liste`
--

INSERT INTO `numero_liste` (`num_fiche`, `annee`, `state`) VALUES
(4, '2019', 'desactive'),
(5, '2020', 'active');

-- --------------------------------------------------------

--
-- Structure de la table `rapport`
--

CREATE TABLE IF NOT EXISTS `rapport` (
`num_rapport` int(11) NOT NULL,
  `effectif` int(11) DEFAULT NULL,
  `observation` varchar(50) DEFAULT NULL,
  `mat_biblio` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `rapport`
--

INSERT INTO `rapport` (`num_rapport`, `effectif`, `observation`, `mat_biblio`, `date`) VALUES
(18, 2, 'Bonne journée', 'BIBLIO001', '2019-07-14');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `archives`
--
ALTER TABLE `archives`
 ADD PRIMARY KEY (`code_archive`);

--
-- Index pour la table `bibliothecaire`
--
ALTER TABLE `bibliothecaire`
 ADD PRIMARY KEY (`mat_biblio`);

--
-- Index pour la table `consultant`
--
ALTER TABLE `consultant`
 ADD PRIMARY KEY (`mat_consult`);

--
-- Index pour la table `liste_consultation`
--
ALTER TABLE `liste_consultation`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `numero_liste`
--
ALTER TABLE `numero_liste`
 ADD PRIMARY KEY (`num_fiche`);

--
-- Index pour la table `rapport`
--
ALTER TABLE `rapport`
 ADD PRIMARY KEY (`num_rapport`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `liste_consultation`
--
ALTER TABLE `liste_consultation`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `numero_liste`
--
ALTER TABLE `numero_liste`
MODIFY `num_fiche` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `rapport`
--
ALTER TABLE `rapport`
MODIFY `num_rapport` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
