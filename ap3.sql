-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le : mar. 27 sep. 2022 à 15:37
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
-- Structure de la table `a_en_stock`
--

CREATE TABLE `a_en_stock` (
  `pr_stock` int(11) NOT NULL,
  `fk_pr` varchar(12) NOT NULL,
  `fk_ma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `cl_id` int(11) NOT NULL,
  `cl_code` varchar(11) NOT NULL,
  `cl_nom` varchar(60) NOT NULL,
  `cl_prenom` varchar(45) NOT NULL,
  `cl_mdp` varchar(150) NOT NULL,
  `cl_adresse` varchar(128) NOT NULL,
  `cl_email` varchar(45) NOT NULL,
  `cl_telephone` varchar(15) NOT NULL,
  `cl_dateNaissance` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`cl_id`, `cl_code`, `cl_nom`, `cl_prenom`, `cl_mdp`, `cl_adresse`, `cl_email`, `cl_telephone`, `cl_dateNaissance`) VALUES
(1, 'CL00000001', 'o²o', 'oooo', '72905e7b32d847468edcdbf99f7d218e466cd828300306f1d9f8c3e0512e44fe4394644b581ed52656a2870c9a67c592bc40ca322099aa52bf528c54f9cabde0', '25 rue zzzzz', 'ooooooo@gmail.com', '0658985412', '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `co_id` int(11) NOT NULL,
  `co_date` date NOT NULL,
  `co_prixTotal` float NOT NULL,
  `co_statut` varchar(45) NOT NULL DEFAULT 'En attente',
  `fk_cl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`co_id`, `co_date`, `co_prixTotal`, `co_statut`, `fk_cl`) VALUES
(2, '2022-09-27', 80.59, 'En attente', 1);

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
  `fk_pr` varchar(12) NOT NULL,
  `fk_ls` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `est_stocke`
--

INSERT INTO `est_stocke` (`fk_pr`, `fk_ls`) VALUES
('000000000001', 1),
('000000000002', 2);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `fo_id` varchar(3) NOT NULL,
  `fo_nom` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`fo_id`, `fo_nom`) VALUES
('NIK', 'Nike');

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
  `pr_quantite` int(11) NOT NULL,
  `fk_pr` varchar(12) NOT NULL,
  `fk_co` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `magasin`
--

CREATE TABLE `magasin` (
  `ma_id` int(11) NOT NULL,
  `ma_lieu` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `magasin`
--

INSERT INTO `magasin` (`ma_id`, `ma_lieu`) VALUES
(1, 'Paris'),
(2, 'Tours');

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `ph_id` int(11) NOT NULL,
  `ph_chemin` varchar(125) NOT NULL,
  `fk_pr` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`ph_id`, `ph_chemin`, `fk_pr`) VALUES
(1, 'images/nike-revolution-6-nn2.jpg', '000000000001'),
(2, 'images/nike-revolution-6-nn.jpg', '000000000001'),
(3, 'images/nike_251136_BV6877_010_20210211T143858_01.jpg', '000000000002'),
(4, 'images/nike_251136_BV6877_010_20210211T143900_02.jpg', '000000000002');

-- --------------------------------------------------------

--
-- Structure de la table `pratique`
--

CREATE TABLE `pratique` (
  `fk_cl` int(11) NOT NULL,
  `fk_ra` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `pr_nom` varchar(100) NOT NULL,
  `pr_reference` varchar(12) NOT NULL,
  `pr_coutHT` float NOT NULL,
  `pr_description` text NOT NULL,
  `pr_stockInternet` int(11) NOT NULL,
  `fk_fournisseur` varchar(3) NOT NULL,
  `fk_rayon` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`pr_nom`, `pr_reference`, `pr_coutHT`, `pr_description`, `pr_stockInternet`, `fk_fournisseur`, `fk_rayon`) VALUES
('Chaussures nike', '000000000001', 12.54, 'Chaussures nike sport', 1, 'NIK', 'FOO'),
('Jogging nike', '000000000002', 75.56, 'Jogging nike sport', 12, 'NIK', 'FOO');

-- --------------------------------------------------------

--
-- Structure de la table `rayon`
--

CREATE TABLE `rayon` (
  `ra_id` varchar(3) NOT NULL,
  `ra_libelle` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `rayon`
--

INSERT INTO `rayon` (`ra_id`, `ra_libelle`) VALUES
('FOO', 'Football'),
('VOL', 'Volley');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `a_en_stock`
--
ALTER TABLE `a_en_stock`
  ADD PRIMARY KEY (`fk_pr`,`fk_ma`),
  ADD KEY `fk_ma` (`fk_ma`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`cl_id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`co_id`),
  ADD KEY `fk_cl` (`fk_cl`);

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
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`fo_id`);

--
-- Index pour la table `lieustockage`
--
ALTER TABLE `lieustockage`
  ADD PRIMARY KEY (`ls_id`);

--
-- Index pour la table `lie_a`
--
ALTER TABLE `lie_a`
  ADD PRIMARY KEY (`fk_pr`,`fk_co`),
  ADD KEY `fk_hi` (`fk_co`);

--
-- Index pour la table `magasin`
--
ALTER TABLE `magasin`
  ADD PRIMARY KEY (`ma_id`);

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
  ADD PRIMARY KEY (`fk_cl`,`fk_ra`),
  ADD KEY `fk_sp` (`fk_ra`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`pr_reference`),
  ADD KEY `fk_rayon` (`fk_rayon`),
  ADD KEY `fk_fournisseur` (`fk_fournisseur`);

--
-- Index pour la table `rayon`
--
ALTER TABLE `rayon`
  ADD PRIMARY KEY (`ra_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `cl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `co_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `enfant`
--
ALTER TABLE `enfant`
  MODIFY `en_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lieustockage`
--
ALTER TABLE `lieustockage`
  MODIFY `ls_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `magasin`
--
ALTER TABLE `magasin`
  MODIFY `ma_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `ph_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `a_en_stock`
--
ALTER TABLE `a_en_stock`
  ADD CONSTRAINT `a_en_stock_ibfk_2` FOREIGN KEY (`fk_ma`) REFERENCES `magasin` (`ma_id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`fk_cl`) REFERENCES `client` (`cl_id`);

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
  ADD CONSTRAINT `est_stocke_ibfk_2` FOREIGN KEY (`fk_pr`) REFERENCES `produit` (`pr_reference`);

--
-- Contraintes pour la table `lie_a`
--
ALTER TABLE `lie_a`
  ADD CONSTRAINT `lie_a_ibfk_1` FOREIGN KEY (`fk_co`) REFERENCES `commande` (`co_id`);

--
-- Contraintes pour la table `pratique`
--
ALTER TABLE `pratique`
  ADD CONSTRAINT `pratique_ibfk_3` FOREIGN KEY (`fk_cl`) REFERENCES `client` (`cl_id`),
  ADD CONSTRAINT `pratique_ibfk_4` FOREIGN KEY (`fk_ra`) REFERENCES `rayon` (`ra_id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`fk_rayon`) REFERENCES `rayon` (`ra_id`),
  ADD CONSTRAINT `produit_ibfk_2` FOREIGN KEY (`fk_fournisseur`) REFERENCES `fournisseur` (`fo_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
