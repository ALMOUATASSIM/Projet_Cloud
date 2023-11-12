-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db:3306
-- Généré le : dim. 12 nov. 2023 à 16:51
-- Version du serveur : 5.7.44
-- Version de PHP : 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `annuaireuppa`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `pnom` varchar(100) NOT NULL,
  `email` varchar(250) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `pnom`, `email`, `tel`, `password`) VALUES
(1, 'AL MOUATASSIM', 'Anass', 'admin@admin.admin', '06000000', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `id` int(10) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `pnom` varchar(100) NOT NULL,
  `email` varchar(250) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `qui` varchar(30) NOT NULL,
  `ppr` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `demande` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`id`, `nom`, `pnom`, `email`, `tel`, `qui`, `ppr`, `password`, `demande`) VALUES
(2, 'LORENZO', 'Juan Angel ', 'juan-angel.lorenzo-del-castillo@cyu.fr', '06620000', 'Enseignant', 'FY120000', '12345', 1),
(28, 'Z', 'Hafida', 'zro@yahoo.com', '06629999', 'Enseignant', 'Y8gggg', '12345', 1),
(29, 'Ferhati', 'Rachid', 'aa@aa.aa', '0677078500', 'Enseignant', 'DEASSZS', '12345', 1),
(32, 'S', 'Hafid', 'focnn@hotmail.com', '07544444', 'Fonctionnaire', 'Y85668', '12345', 1),
(34, 'Refal', 'Youssefeed', 'aa@aa.ppma', '0677030300', 'Enseignant', 'FYlk50DA', '12345', 0),
(35, 'M', 'Mohamed', 'medb@gmail.com', '06858888', 'Enseignant', 'FT99999', '12345', 1),
(44, 'F', 'Abdellah', 'abdefour@gmail.com', '0630152060', 'Fonctionnaire', 'UAN12001', '12345', 0),
(45, 'EL', 'Noureddine', 'mour@gmail.com', '064755555', 'Fonctionnaire', 'YR77777', '12345', 1),
(48, 'HAMDI', 'Louay', 'hamdi@gmail.com', '0685125204', 'Enseignant', 'AZ10210', '12345', 0);

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `pnom` varchar(100) NOT NULL,
  `email` varchar(250) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `qui` varchar(30) NOT NULL,
  `cne` varchar(15) NOT NULL,
  `fil` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `demande` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id`, `nom`, `pnom`, `email`, `tel`, `qui`, `cne`, `fil`, `password`, `demande`) VALUES
(13, 'aa', 'Youssef', 'rr@rr.rr', '06700000', 'Etudiant', 'H1322222', 'ASR', '12345', 1),
(14, 'EL HAIDO', 'Mariam', 'mariame@gmail.com', '062410000', 'Etudiant', 'S15200000', 'GC', '12345', 1),
(16, 'BOU', 'Ibrahim', 'ibra@gmail.com', '06300000', 'Etudiant', 'H15200000', 'DAI', '12345', 0);

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE `filiere` (
  `id` int(10) NOT NULL,
  `nom` varchar(10) NOT NULL,
  `c_nom` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `filiere`
--

INSERT INTO `filiere` (`id`, `nom`, `c_nom`) VALUES
(1, 'DAI', 'Développeur d\'applications Informatiques (DAI)'),
(2, 'ASR', 'Administrateur de Systèmes et Réseaux (ASR)'),
(27, 'EII', 'Electronique et Informatique Industrielle (EII)'),
(36, 'GEER', 'Génie Electrique et Energies Renouvelables (GEER)'),
(39, 'GC', 'Génie Civil (GC)'),
(46, 'MC', 'Mécatronique Industrielle (MC)'),
(47, 'TDEA', 'Technologie et Diagnostique Electronique Automobile (TDEA)'),
(50, 'GBA', 'Gestion des Banques et Assurances (GBA)'),
(51, 'FCF', 'Finance, Comptabilité et Fiscalité (FCF)'),
(52, 'IGE', 'Informatique et Gestion des Entreprises (IGE)');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `tel` (`tel`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `tel` (`tel`),
  ADD UNIQUE KEY `ppr` (`ppr`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cne` (`cne`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `tel` (`tel`);

--
-- Index pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`),
  ADD UNIQUE KEY `c_nom` (`c_nom`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
