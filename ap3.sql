-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 13 sep. 2022 à 15:56
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ap3`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `cl_id` int(11) NOT NULL,
  `cl_code` varchar(11) NOT NULL,
  `cl_nomPrenom` varchar(60) NOT NULL,
  `cl_adresse` varchar(128) NOT NULL,
  `cl_email` varchar(45) NOT NULL,
  `cl_telephone` varchar(15) NOT NULL,
  `cl_dateNaissance` date NOT NULL,
  `cl_nbEnfant` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `enfant`
--

CREATE TABLE `enfant` (
  `en_id` int(11) NOT NULL,
  `en_age` int(11) NOT NULL,
  `fk_cl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `est_stocke`
--

CREATE TABLE `est_stocke` (
  `fk_pr` int(11) NOT NULL,
  `fk_ls` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `est_stocke`
--

INSERT INTO `est_stocke` (`fk_pr`, `fk_ls`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
  `hi_id` int(11) NOT NULL,
  `hi_date` date NOT NULL,
  `hi_prixTotal` float NOT NULL,
  `hi_quantite` int(11) NOT NULL,
  `fk_cl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `lieustockage`
--

CREATE TABLE `lieustockage` (
  `ls_id` int(11) NOT NULL,
  `ls_libelle` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `lieustockage`
--

INSERT INTO `lieustockage` (`ls_id`, `ls_libelle`) VALUES
(1, 'Le Havre'),
(2, 'Lyon'),
(3, 'Marseille');

-- --------------------------------------------------------

--
-- Structure de la table `lie_a`
--

CREATE TABLE `lie_a` (
  `fk_pr` int(11) NOT NULL,
  `fk_hi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `ph_id` int(11) NOT NULL,
  `ph_chemin` varchar(125) NOT NULL,
  `fk_pr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`ph_id`, `ph_chemin`, `fk_pr`) VALUES
(1, 'images/1475188027-ramses.jpg', 1),
(2, 'images/affrontemonregard.jpg', 1),
(3, 'images/damn.jpg', 2),
(4, 'images/doigdrip.jpg', 2);

-- --------------------------------------------------------

--
-- Structure de la table `pratique`
--

CREATE TABLE `pratique` (
  `fk_cl` int(11) NOT NULL,
  `fk_sp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `pr_id` int(11) NOT NULL,
  `pr_nom` varchar(100) NOT NULL,
  `pr_reference` varchar(18) NOT NULL,
  `pr_NomFournisseur` varchar(45) NOT NULL,
  `pr_rayon` varchar(45) NOT NULL,
  `pr_coutHT` float NOT NULL,
  `pr_description` text NOT NULL,
  `pr_stockInternet` int(11) NOT NULL,
  `pr_stockMagasin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`pr_id`, `pr_nom`, `pr_reference`, `pr_NomFournisseur`, `pr_rayon`, `pr_coutHT`, `pr_description`, `pr_stockInternet`, `pr_stockMagasin`) VALUES
(1, 'Siphano + Gordon', 'FOUSPO000001', 'Fournisseur', 'Sport', 12.54, 'siphano et Gordon Ramses', 14, 12),
(2, 'Chien et doigdrip', 'DOISPO000002', 'Doigby', 'Sport', 75.56, 'Chien + doigdrip', 12, 14);

-- --------------------------------------------------------

--
-- Structure de la table `sports`
--

CREATE TABLE `sports` (
  `sp_id` int(11) NOT NULL,
  `sp_libelle` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`cl_id`);

--
-- Index pour la table `enfant`
--
ALTER TABLE `enfant`
  ADD PRIMARY KEY (`en_id`),
  ADD KEY `fk_cl` (`fk_cl`);

--
-- Index pour la table `est_stocke`
--
ALTER TABLE `est_stocke`
  ADD PRIMARY KEY (`fk_pr`,`fk_ls`),
  ADD KEY `fk_ls` (`fk_ls`);

--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`hi_id`),
  ADD KEY `fk_cl` (`fk_cl`);

--
-- Index pour la table `lieustockage`
--
ALTER TABLE `lieustockage`
  ADD PRIMARY KEY (`ls_id`);

--
-- Index pour la table `lie_a`
--
ALTER TABLE `lie_a`
  ADD PRIMARY KEY (`fk_pr`,`fk_hi`),
  ADD KEY `fk_hi` (`fk_hi`);

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`ph_id`),
  ADD KEY `fk_pr` (`fk_pr`);

--
-- Index pour la table `pratique`
--
ALTER TABLE `pratique`
  ADD PRIMARY KEY (`fk_cl`,`fk_sp`),
  ADD KEY `fk_sp` (`fk_sp`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`pr_id`);

--
-- Index pour la table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`sp_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `cl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `enfant`
--
ALTER TABLE `enfant`
  MODIFY `en_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
  MODIFY `hi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lieustockage`
--
ALTER TABLE `lieustockage`
  MODIFY `ls_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `ph_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `sports`
--
ALTER TABLE `sports`
  MODIFY `sp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `enfant`
--
ALTER TABLE `enfant`
  ADD CONSTRAINT `enfant_ibfk_1` FOREIGN KEY (`fk_cl`) REFERENCES `client` (`cl_id`);

--
-- Contraintes pour la table `est_stocke`
--
ALTER TABLE `est_stocke`
  ADD CONSTRAINT `est_stocke_ibfk_1` FOREIGN KEY (`fk_ls`) REFERENCES `lieustockage` (`ls_id`),
  ADD CONSTRAINT `est_stocke_ibfk_2` FOREIGN KEY (`fk_pr`) REFERENCES `produit` (`pr_id`);

--
-- Contraintes pour la table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `historique_ibfk_1` FOREIGN KEY (`fk_cl`) REFERENCES `client` (`cl_id`);

--
-- Contraintes pour la table `lie_a`
--
ALTER TABLE `lie_a`
  ADD CONSTRAINT `lie_a_ibfk_1` FOREIGN KEY (`fk_hi`) REFERENCES `historique` (`hi_id`),
  ADD CONSTRAINT `lie_a_ibfk_2` FOREIGN KEY (`fk_pr`) REFERENCES `produit` (`pr_id`);

--
-- Contraintes pour la table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`fk_pr`) REFERENCES `produit` (`pr_id`);

--
-- Contraintes pour la table `pratique`
--
ALTER TABLE `pratique`
  ADD CONSTRAINT `pratique_ibfk_2` FOREIGN KEY (`fk_sp`) REFERENCES `sports` (`sp_id`),
  ADD CONSTRAINT `pratique_ibfk_3` FOREIGN KEY (`fk_cl`) REFERENCES `client` (`cl_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
