-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 11 jan. 2023 à 16:06
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `favoris`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_cat` int(11) NOT NULL,
  `categorie` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_cat`, `categorie`) VALUES
(1, 'Outils'),
(2, 'Front End'),
(3, 'Back End'),
(4, 'Dev Web Mobile'),
(5, 'Veilles'),
(6, 'Gestion de projet'),
(7, ''),
(8, 'tata'),
(9, '');

-- --------------------------------------------------------

--
-- Structure de la table `categorie_ss_categorie`
--

CREATE TABLE `categorie_ss_categorie` (
  `id_cat` int(11) NOT NULL,
  `id_ss_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie_ss_categorie`
--

INSERT INTO `categorie_ss_categorie` (`id_cat`, `id_ss_cat`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(3, 7),
(3, 8),
(3, 9),
(4, 10),
(5, 11),
(5, 12),
(6, 13),
(6, 14);

-- --------------------------------------------------------

--
-- Structure de la table `favori`
--

CREATE TABLE `favori` (
  `id` int(11) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `etiquette` varchar(150) DEFAULT NULL,
  `descript` varchar(500) DEFAULT NULL,
  `adresse_url` varchar(2000) NOT NULL,
  `id_cat` int(11) DEFAULT NULL,
  `id_ss_cat` int(11) DEFAULT NULL,
  `id_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favori`
--

INSERT INTO `favori` (`id`, `nom`, `etiquette`, `descript`, `adresse_url`, `id_cat`, `id_ss_cat`, `id_type`) VALUES
(1, 'VSCode', '', '', 'https://code.visualstudio.com/', 1, 1, NULL),
(2, 'Git', 'Branche', '', 'https://learngitbranching.js.org/?locale=fr_FR', 1, 1, 1),
(3, 'Git', 'Site officiel', '', 'https://github.com/', 1, 1, NULL),
(4, 'Git', 'Commandes Git', '', 'https://www.hostinger.fr/tutoriels/commandes-git ', 1, 1, NULL),
(5, 'Figma', '', 'Apprendre figma', 'https://youtu.be/e68PKFYWfoQ ', 1, 2, 1),
(6, 'Figma', '', '', 'https://www.youtube.com/watch?v=icaC_DTYs3c&ab_channel=TutorialTim ', 1, 2, 2),
(7, 'Miro', '', '', 'https://miro.com/fr/ ', 1, 2, NULL),
(8, 'Open Studi', '', '', 'https://www.openstudio.fr/2022/10/27/comment-optimiser-lergonomie-de-son-site-web/ ', 2, 3, NULL),
(9, 'Wireframe', '', '', 'https://www.usabilis.com/definition-wireframe/', 2, 3, NULL),
(10, 'Doc Mozilla', '', '', 'https://developer.mozilla.org/fr/docs/Learn/Getting_started_with_the_web/HTML_basics ', 2, 4, 5),
(11, 'Element HTML', '', '', 'https://developer.mozilla.org/fr/docs/Web/HTML/Element ', 2, 4, 5),
(12, 'HTML+CSS', '', '', 'http://iamjmm.ovh/NSI/ressourcesHTMLCSS/cours/htmlCss/c5-2.html ', 2, 4, NULL),
(13, 'Site Vitrine', '', '', 'https://www.youtube.com/watch?v=Cwm9qX9onq4 ', 2, 4, 1),
(14, 'Cours HTML', '', '', 'https://www.youtube.com/watch?v=qsbkZ7gIKnc', 2, 4, 3),
(15, 'HTML5 CSS3', '', '', 'https://openclassrooms.com/fr/courses/1603881-apprenez-a-creer-votre-site-web-avec-html5-et-css3 ', 2, 4, 3),
(16, 'BEM', '', '', 'https://alticreation.com/bem-pour-le-css/ ', 2, 5, NULL),
(17, 'FlexBox', 'FlexBox', '', 'https://css-tricks.com/snippets/css/a-guide-to-flexbox/ ', 2, 5, 4),
(18, 'FlexBox', 'FlexBox', '', 'https://youtu.be/UcC76tcvLgA ', 2, 5, 7),
(19, 'FlexBox', 'FlexBox', '', 'https://flexboxfroggy.com/#fr ', 2, 5, 4),
(20, 'Apprendre le JS', '', '', 'https://openclassrooms.com/fr/courses/6175841-apprenez-a-programmer-avec-javascript ', 2, 6, 3),
(21, 'Tableaux', '', '', 'https://www.youtube.com/watch?v=kUXNmv4ZcWA ', 2, 6, 7),
(22, 'AlgoBox', 'Algorithme pour les enfants', '', 'https://www.xm1math.net/algobox/doc.html ', 3, 7, 5),
(23, 'OCR Algorithme', '', '', 'https://openclassrooms.com/fr/courses/4366701-decouvrez-le-fonctionnement-des-algorithmes ', 3, 7, 3),
(24, 'Algorithme', 'Algo récréatif', '', 'https://pixees.fr/classcode/formations/module1/ ', 3, 7, 3),
(25, 'Boucles, instructions répétitives', '', '', 'https://studylibfr.com/doc/179347/cours-sur-les-boucles-ou-instructions-r%C3%A9p%C3%A9titives# ', 3, 7, 3),
(26, 'Constantes, Variables', '', '', 'https://www.youtube.com/watch?v=cEK4cPTP5qE&ab_channel=HassanELBAHI ', 3, 7, 3),
(27, 'Manuel PHP', '', '', 'https://www.php.net/manual/fr/ ', 3, 8, 5),
(28, 'Cours Greta', '', '', 'https://drive.google.com/drive/u/0/folders/1-HH7b2Rf_tvJVnHV6cKqr2nRekLjGFes ', 3, 8, 3),
(29, 'Cours Greta', 'Support', '', 'https://drive.google.com/drive/folders/1nPTgAOYv5ZsIARtEQ74n-F4pLzfT5Ngq?usp=share_link', 3, 9, 3),
(30, 'OCR Administrer MySQL', '', '', 'https://openclassrooms.com/fr/courses/1959476-administrez-vos-bases-de-donnees-avec-mysql ', 3, 9, 3),
(31, 'OCR SGBDR', '', '', 'https://openclassrooms.com/fr/courses/6971126-implementez-vos-bases-de-donnees-relationnelles-avec-sql ', 3, 9, 3),
(32, 'OCR Site Web Php_ MySQL', '', '', 'https://openclassrooms.com/fr/courses/918836-concevez-votre-site-web-avec-php-et-mysql ', 3, 9, 3),
(33, 'Site Web Php_ MySQL', '', '', 'http://www.turrier.fr/articles/php-mysql-creer-bdd/php-mysql-creer-bdd.php ', 3, 9, 1),
(34, 'SQL Officiel', '', '', 'https://sql.sh/ ', 3, 9, 5),
(35, 'Aide mémoire', '', '', 'https://sql.sh/919-aide-memoire-mysql ', 3, 9, 4),
(36, 'Responsive Design', 'Explication', '', 'https://www.usabilis.com/responsive-web-design-site-web-adaptatif/ ', 4, 10, 6),
(37, 'Apprendre en jouant', '', '', 'https://www.codingame.com/ ', 4, 10, 1),
(38, 'Cours Greta Scrum', 'SCRUM', '', 'https://drive.google.com/file/d/178KS7Z_AD9nIO_ohfHFIuGnOrSueWduW/view ', 6, 13, 3),
(39, 'Cours Greta –veille internet', '', '', 'https://drive.google.com/file/d/13Jrto7jRgyCmP660VsZx76aI1zUYKE5j/view?usp=sharing ', 5, 11, 3),
(40, 'Cours Greta –support veille', '', '', 'https://drive.google.com/file/d/1Pq1S5q6Cg9bsvcAKwWqoDiGLlQ3W_2vo/view?usp=sharing ', 5, 11, 3),
(41, 'Moteur de recherche', '', '', 'https://outilstice.com/2021/08/meilleurs-moteurs-de-recherche-pour-etudiants/#Google_Scholar_Lincontournable_moteur_de_recherche_pour_etudiants ', 5, 12, 6),
(42, 'Apprendre en jouant', '', '', 'https://www.codingame.com/ ', 5, 12, 1),
(43, 'nom du site', '', '', 'www.toto.com', NULL, NULL, NULL),
(44, 'sdsq', '', '', 'https://efdezfdefez', NULL, NULL, NULL),
(45, 'sdsq', '', '', 'https://efdezfdefez', NULL, NULL, NULL),
(46, 'asdfsef', '', '', 'https://tatat.fr', NULL, NULL, NULL),
(47, 'dezrezrfe', '', '', 'https://www.totoland.com', NULL, NULL, NULL),
(48, 'dezrezrfe', '', '', 'https://www.totoland.com', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ss_categorie`
--

CREATE TABLE `ss_categorie` (
  `id_ss_cat` int(11) NOT NULL,
  `ss_categorie` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ss_categorie`
--

INSERT INTO `ss_categorie` (`id_ss_cat`, `ss_categorie`) VALUES
(1, 'Développeur'),
(2, 'Design'),
(3, 'Maquette'),
(4, 'HTML'),
(5, 'CSS'),
(6, 'Java Script'),
(7, 'Algorithmes'),
(8, 'PHP'),
(9, 'SQL'),
(10, 'Responsive Web Design'),
(11, 'Support'),
(12, 'Articles'),
(13, 'SCRUM'),
(14, 'MERISE');

-- --------------------------------------------------------

--
-- Structure de la table `type_favori`
--

CREATE TABLE `type_favori` (
  `id_type` int(11) NOT NULL,
  `type_favori` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_favori`
--

INSERT INTO `type_favori` (`id_type`, `type_favori`) VALUES
(1, 'Tutoriel'),
(2, 'Plugin'),
(3, 'Cours'),
(4, 'Mémo'),
(5, 'Documentation'),
(6, 'Article'),
(7, 'Vidéo');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_cat`);

--
-- Index pour la table `categorie_ss_categorie`
--
ALTER TABLE `categorie_ss_categorie`
  ADD PRIMARY KEY (`id_cat`,`id_ss_cat`);

--
-- Index pour la table `favori`
--
ALTER TABLE `favori`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cat` (`id_cat`),
  ADD KEY `id_ss_cat` (`id_ss_cat`),
  ADD KEY `id_type` (`id_type`);

--
-- Index pour la table `ss_categorie`
--
ALTER TABLE `ss_categorie`
  ADD PRIMARY KEY (`id_ss_cat`);

--
-- Index pour la table `type_favori`
--
ALTER TABLE `type_favori`
  ADD PRIMARY KEY (`id_type`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `favori`
--
ALTER TABLE `favori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `ss_categorie`
--
ALTER TABLE `ss_categorie`
  MODIFY `id_ss_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `type_favori`
--
ALTER TABLE `type_favori`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categorie_ss_categorie`
--
ALTER TABLE `categorie_ss_categorie`
  ADD CONSTRAINT `categorie_ss_categorie_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `categorie` (`id_cat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `categorie_ss_categorie_ibfk_2` FOREIGN KEY (`id_ss_cat`) REFERENCES `ss_categorie` (`id_ss_cat`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `favori`
--
ALTER TABLE `favori`
  ADD CONSTRAINT `favori_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `categorie` (`id_cat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `favori_ibfk_2` FOREIGN KEY (`id_ss_cat`) REFERENCES `ss_categorie` (`id_ss_cat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `favori_ibfk_3` FOREIGN KEY (`id_type`) REFERENCES `type_favori` (`id_type`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
