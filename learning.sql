-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mar 26 Février 2019 à 21:17
-- Version du serveur :  5.7.25-0ubuntu0.18.04.2
-- Version de PHP :  7.2.15-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `learning`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `administrateur`
--

INSERT INTO `administrateur` (`id`, `utilisateur_id`, `mobile`) VALUES
(1, 1, '97250000'),
(2, 2, '97032059');

-- --------------------------------------------------------

--
-- Structure de la table `avatar`
--

CREATE TABLE `avatar` (
  `id` int(11) NOT NULL,
  `extension` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `avatar`
--

INSERT INTO `avatar` (`id`, `extension`, `name`) VALUES
(1, 'png', 'd1f01a7e14c0e3ea66e254e7684dd499.png'),
(2, 'png', 'de558ca87690cf06fefb552a99f6e4b0.png'),
(3, 'png', '919ebaf14533f53a8e6b787eccd85968.png'),
(4, 'png', '75ab1a792026f275fc84340582c9dc19.png');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `slug`) VALUES
(1, 'html / css', 'html-css'),
(2, 'Javascript', 'javascript'),
(3, 'PHP', 'php'),
(4, 'Langage C', 'langage-c'),
(5, 'Langage C++', 'langage-c-1'),
(6, 'Langage Java', 'langage-java'),
(7, 'Android', 'android'),
(8, 'IOS', 'ios'),
(9, 'Framework IONIC', 'framework-ionic'),
(10, 'Framework Flutter', 'framework-flutter');

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id` int(11) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `formateur_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  `video_id` int(11) DEFAULT NULL,
  `titre` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `niveau` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateCreation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `cours`
--

INSERT INTO `cours` (`id`, `categorie_id`, `formateur_id`, `image_id`, `video_id`, `titre`, `slug`, `description`, `niveau`, `dateCreation`) VALUES
(1, 2, 3, 1, NULL, '4.0 Angular 2 Essential Training JavaScript', '4-0-angular-2-essential-training-javascript', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s st<strong>andard dummy text ever since theown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lo</strong>rem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p><a href=\"http://vestuves.printaprint.lt/wp-content/uploads/2018/07/default_avatar.png\">http://vestuves.printaprint.lt/wp-content/uploads/2018/07/default_avatar.png</a></p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since theown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since theown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since theown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>', 'debutant', '2019-01-24'),
(3, 3, 3, 3, 1, 'Character Designer for 2D Animation', 'character-designer-for-2d-animation', '<p>&nbsp;</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since theown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since theown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since theown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>', 'debutant', '2019-01-24'),
(4, 2, 2, 4, 2, 'WordPress: Creating Custom Plugins with PHP', 'wordpress-creating-custom-plugins-with-php', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text</p>', 'debutant', '2019-01-26'),
(5, 1, 2, 5, 3, 'Laravel Creating Custom Plugins with PHP', 'laravel-creating-custom-plugins-with-php', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text</p>', 'debutant', '2019-01-26'),
(6, 1, 2, 6, 4, 'Symfony Creating Custom Plugins with PHP', 'symfony-creating-custom-plugins-with-php', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text</p>', 'debutant', '2019-01-26'),
(7, 3, 2, 7, 5, 'Javascript Creating Custom Plugins with PHP', 'javascript-creating-custom-plugins-with-php', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text</p>', 'debutant', '2019-01-26'),
(8, 3, 2, 8, 6, 'C++ Creating Custom Plugins with PHP', 'c-creating-custom-plugins-with-php', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text</p>', 'debutant', '2019-01-26'),
(9, 3, 2, 9, 7, 'vb.net Creating Custom Plugins with PHP', 'vb-net-creating-custom-plugins-with-php', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text</p>', 'intermediaire', '2019-01-26'),
(10, 3, 2, 10, 8, 'IOS Creating Custom ios application', 'ios-creating-custom-ios-application', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text</p>', 'intermediaire', '2019-01-26'),
(11, 1, 2, 11, 9, 'IONIC Creating Custom ios application', 'ionic-creating-custom-ios-application', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text</p>', 'debutant', '2019-01-26'),
(12, 1, 2, 12, 10, 'Flutter Creating Custom dart application', 'flutter-creating-custom-dart-application', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text</p>', 'debutant', '2019-01-26'),
(13, 1, 2, 13, 11, 'Javascript Creating Custom dart application', 'javascript-creating-custom-dart-application', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text</p>', 'debutant', '2019-01-26'),
(14, 3, 2, 14, 12, 'Python Creating web site', 'python-creating-web-site', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text</p>', 'debutant', '2019-01-26');

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `extension` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `document`
--

INSERT INTO `document` (`id`, `extension`, `name`) VALUES
(2, 'pdf', 'b18e1ebbc818a4510635d57bf2d6b2f9.pdf'),
(3, 'png', '76dc8bd5d68f2ccada0f774e1a614767.png'),
(6, 'png', '8726c641df7544b7ca696b1cf7e3bc22.png');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id` int(11) NOT NULL,
  `pays_id` int(11) NOT NULL,
  `avatar_id` int(11) DEFAULT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `date_naissance` date NOT NULL,
  `sexe` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `etudiant`
--

INSERT INTO `etudiant` (`id`, `pays_id`, `avatar_id`, `utilisateur_id`, `date_naissance`, `sexe`, `telephone`, `adresse`, `ville`) VALUES
(1, 2, 1, 3, '2017-02-03', 'Homme', '216 97032059', 'avenu trabelisia', 'monastir'),
(2, 11, 4, 8, '2003-12-15', 'Homme', '216 97032059', 'avenu trabelisia', 'monastir');

-- --------------------------------------------------------

--
-- Structure de la table `evaluation_cours`
--

CREATE TABLE `evaluation_cours` (
  `id` int(11) NOT NULL,
  `cours_id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `nombre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `evaluation_cours`
--

INSERT INTO `evaluation_cours` (`id`, `cours_id`, `utilisateur_id`, `nombre`) VALUES
(1, 8, 3, 4),
(2, 13, 3, 4),
(3, 7, 3, 4),
(4, 14, 3, 5),
(5, 14, 5, 1),
(6, 12, 5, 4),
(7, 9, 5, 4);

-- --------------------------------------------------------

--
-- Structure de la table `favoris_cours`
--

CREATE TABLE `favoris_cours` (
  `id` int(11) NOT NULL,
  `cours_id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `favoris_cours`
--

INSERT INTO `favoris_cours` (`id`, `cours_id`, `utilisateur_id`) VALUES
(5, 14, 5),
(6, 12, 5),
(8, 10, 3),
(9, 14, 3),
(10, 13, 3),
(12, 11, 3);

-- --------------------------------------------------------

--
-- Structure de la table `formateur`
--

CREATE TABLE `formateur` (
  `id` int(11) NOT NULL,
  `pays_id` int(11) NOT NULL,
  `avatar_id` int(11) DEFAULT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `date_naissance` date NOT NULL,
  `sexe` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_plus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `formateur`
--

INSERT INTO `formateur` (`id`, `pays_id`, `avatar_id`, `utilisateur_id`, `date_naissance`, `sexe`, `description`, `telephone`, `adresse`, `ville`, `facebook`, `google_plus`, `linkedin`) VALUES
(1, 25, NULL, 4, '2018-02-01', 'Homme', '<p>Cras nec arcu quis libero semper tristique in at velit. Nunc volutpat mattis erat, vel varius dolor fringilla hendrerit. Morbi aliquam orci null.&nbsp;Cras nec arcu quis libero semper tristique in at velit. Nunc volutpat mattis erat, vel varius dolor fringilla hen<strong>drerit. Morbi aliq</strong>uam orci null</p>\n\n<p>&nbsp;</p>\n\n<p>Cras nec arcu quis libero <em><strong>semper tristique in at velit. Nunc volutpat mattis erat, ve</strong></em>l varius dolor fringilla hendrerit. Morbi aliquam orci null</p>', '216 97032059', 'avenu trabelisia', 'monastir', 'https://www.facebook.com/', NULL, NULL),
(2, 219, 2, 5, '1967-03-03', 'Homme', '<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur</p>', '97250000', 'hfdhjkgfhgh', 'sousse', 'http://localhost/learning/public/index.php/', NULL, NULL),
(3, 219, NULL, 6, '1985-02-05', 'Homme', '<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consecteturl</p>', '98565235', 'ghgghnhnn  nhnhnh hbnhbnnh', 'tunis', NULL, NULL, NULL),
(4, 2, 3, 7, '1998-11-17', 'Homme', '<p>&nbsp;kmmmmmmmmmmmm mmmmmmmmmmmmmmm</p>', '216 97032059', 'Rue Chaabene El Bhouri', 'monastir', 'https://www.facebook.com/houssem.eddine.04', 'https://www.googleplus.com/houssem.eddine.04', 'https://www.linkedin.com/houssem.eddine.04');

-- --------------------------------------------------------

--
-- Structure de la table `formateur_categorie`
--

CREATE TABLE `formateur_categorie` (
  `formateur_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `formateur_categorie`
--

INSERT INTO `formateur_categorie` (`formateur_id`, `categorie_id`) VALUES
(1, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 3),
(4, 2),
(4, 3),
(4, 5);

-- --------------------------------------------------------

--
-- Structure de la table `forum_question`
--

CREATE TABLE `forum_question` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texte` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  `ordre` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `forum_question`
--

INSERT INTO `forum_question` (`id`, `utilisateur_id`, `categorie_id`, `titre`, `slug`, `texte`, `date_creation`, `ordre`) VALUES
(1, 3, 1, 'pourquoi mon menu ne s\'affiche pas sur une ligne', 'pourquoi-mon-menu-ne-saffiche-pas-sur-une-ligne', '<ul>\r\n	<li>rrff</li>\r\n	<li>fff</li>\r\n</ul>\r\n\r\n<p>fkf,klf, dfdk,l fdldk,f dflk,dfkl</p>\r\n\r\n<p>dfdfdfd</p>', '2019-02-03 12:19:15', '2019-02-11 22:25:47'),
(3, 3, 1, 'pourquoi mon menu ne s\'affiche pas sur une ligne edit', 'pourquoi-mon-menu-ne-saffiche-pas-sur-une-ligne-edit', '<p>edit Bonjour, Je souhaite que mon menu s&#39;affiche sur deux lignes horizontales. N&eacute;annmoins, je ne comprends pas pourquoi mes items de menu s&#39;affichent les uns en dessous des autres. Merci de vos lumi&egrave;res idem pour la d&eacute;claration .menu ul qui devient ul.menu qui cible les</p>\r\n\r\n<ul>\r\n	<li>avec la class &quot;menu&quot; Sinon, la mise en page avec de est &agrave; proscrire absolument</li>\r\n</ul>', '2019-02-03 12:19:15', '2019-02-11 22:21:00'),
(4, 3, 1, 'Récupération de donnée à partir d\'une WebApp', 'recuperation-de-donnee-a-partir-dune-webapp', '<p>Bonsoir,&nbsp;</p>\r\n\r\n<p>J&#39;aimerais savoir comment peux-t-on r&eacute;cup&eacute;rer le fichier html d&#39;une application web ?</p>\r\n\r\n<p>Car quand je regarde le code source, je ne vois rien, il n&#39;y a qu&#39;un script, et d&egrave;s que j&#39;examine un &eacute;l&eacute;ment j&#39;ai le fichier html que j&#39;aimerais r&eacute;cup&eacute;rer. Le soucis c&#39;est quand je t&eacute;l&eacute;charge le fichier html, j&#39;ai le fichier qui ne m&#39;int&eacute;resse pas.</p>\r\n\r\n<p>Savez-vous comment je peux faire ? Merci d&#39;avance :)&nbsp;</p>', '2019-02-07 17:57:29', '2019-02-11 22:13:37');

-- --------------------------------------------------------

--
-- Structure de la table `forum_reponse`
--

CREATE TABLE `forum_reponse` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `texte` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `forum_reponse`
--

INSERT INTO `forum_reponse` (`id`, `question_id`, `utilisateur_id`, `texte`, `date_creation`) VALUES
(1, 4, 5, 'Car quand je regarde le code source, je ne vois rien, il n\'y a qu\'un script, et dès que j\'examine un élément j\'ai le fichier html que j\'aimerais récupérer. Le soucis c\'est quand je télécharge le fichier html, j\'ai le fichier qui ne m\'intéresse pas.\r\n\r\nSavez-vous comment je peux faire ? Merci d\'avance :) ', '2019-02-07 07:21:20'),
(3, 4, 3, '<p>fjgfjffn jgjgh</p>', '2019-02-11 22:13:04'),
(4, 4, 3, '<p>bbbbbbb</p>', '2019-02-11 22:13:37'),
(5, 3, 3, '<p>okkkk</p>', '2019-02-11 22:21:00'),
(6, 1, 3, '<p>mmmmmmmmmmm edit</p>', '2019-02-11 22:25:47');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `extension` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`id`, `extension`, `name`) VALUES
(1, 'png', '08053cc528c2f99e518c9dff55f33b39.png'),
(3, 'jpeg', '35a8ca6d931a9e5d541b66701cf835b5.jpeg'),
(4, 'jpeg', '3f91ca2e1e04864aa8fa96c81a9ccb8e.jpeg'),
(5, 'png', '060694d75543d8b7a8075bd58c61963b.png'),
(6, 'jpeg', 'ac33985e3137cfa764c4f77e2d45d6da.jpeg'),
(7, 'jpeg', 'dc14bd2c6a741ad1aed3c3856047ffe4.jpeg'),
(8, 'jpeg', '97503035a9b589cb11b89c00bdbaf0ff.jpeg'),
(9, 'png', '269216c722f91e039c87c261ef9c28f0.png'),
(10, 'jpeg', 'e3ad6b2917e46d8cf7f2dca50917367f.jpeg'),
(11, 'jpeg', '0c181dedaf49f70d9053cef47939d8e2.jpeg'),
(12, 'jpeg', 'a86a6e610230379ca0579b8b3746a72f.jpeg'),
(13, 'png', '3d8d2c173f9c4598e105be52fd3b5e9f.png'),
(14, 'jpeg', '16e80acf9af88d7694d1d0bcfbdf0e54.jpeg'),
(16, 'png', 'f854d65d4c1bebe0833f270125cff899.png'),
(17, 'png', '305166eb8104116054268e97252c690b.png'),
(21, 'png', 'bee0d138e57e737153ea57cfa3557e61.png');

-- --------------------------------------------------------

--
-- Structure de la table `lesson`
--

CREATE TABLE `lesson` (
  `id` int(11) NOT NULL,
  `document_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  `video_id` int(11) NOT NULL,
  `cours_id` int(11) NOT NULL,
  `titre` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `duree` int(11) NOT NULL,
  `date_creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `lesson`
--

INSERT INTO `lesson` (`id`, `document_id`, `image_id`, `video_id`, `cours_id`, `titre`, `slug`, `description`, `duree`, `date_creation`) VALUES
(1, 2, 16, 14, 14, 'How To Become a Kickass Laravel Expert? edit', 'how-to-become-a-kickass-laravel-expert-edit', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>', 40, '2019-01-26 12:31:52'),
(2, 3, 17, 15, 14, 'lesson 2 test', 'lesson-2-test', '<p><strong>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s,</strong> when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text ever since </em>the 1500s, when an unk...</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <a href=\"http://file:///home/asus/websites/elearning/curricular.xoothemes.com/blog-single.html\">dummy text ever since the 1500s, when an unk...</a></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unk...</p>', 60, '2019-01-27 10:45:30'),
(3, 6, 21, 19, 14, 'pourquoi mon menu ne s\'affiche pas sur une ligne', 'pourquoi-mon-menu-ne-saffiche-pas-sur-une-ligne', '<p>nhnh</p>', 40, '2019-02-22 17:39:14');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `nom` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sujet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `da7` datetime NOT NULL,
  `lu` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id`, `nom`, `email`, `telephone`, `sujet`, `contenu`, `da7`, `lu`) VALUES
(3, 'houssem', 'houss@gmail.com', '97032059', 'hg', 'jhjhdf', '2019-01-22 04:14:14', 1),
(4, 'houssem', 'houss@gmail.com', '97032059', 'hg', 'jhjhdf', '2019-01-22 04:14:14', 1),
(5, 'entreprise houssem', 'houssem.derouich04@gmail.com', '216 97032059', 'mmmmmmmmmm', 'mmmmmmmmmm', '2019-01-27 22:24:43', 0);

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vu` tinyint(1) NOT NULL,
  `date_notification` datetime NOT NULL,
  `ur` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `notification`
--

INSERT INTO `notification` (`id`, `utilisateur_id`, `description`, `type`, `vu`, `date_notification`, `ur`) VALUES
(8, 5, 'Nouvelle inscription dans un cours', 'inscription_cours', 1, '2019-02-24 18:09:03', '/elearning/public/index.php/espace-formateur/cours/etudiants-inscris/cours/14'),
(9, 5, 'Nouvelle inscription dans un cours', 'inscription_cours', 0, '2019-02-24 18:09:10', '/elearning/public/index.php/espace-formateur/cours/etudiants-inscris/cours/13'),
(10, 5, 'Nouvelle inscription dans un cours', 'inscription_cours', 1, '2019-02-24 18:09:15', '/elearning/public/index.php/espace-formateur/cours/etudiants-inscris/cours/12'),
(11, 5, 'Nouvelle inscription dans un cours', 'inscription_cours', 0, '2019-02-24 18:09:19', '/elearning/public/index.php/espace-formateur/cours/etudiants-inscris/cours/11'),
(12, 5, 'Nouvelle inscription dans un cours', 'inscription_cours', 1, '2019-02-25 17:14:26', '/sofienne/public/index.php/espace-formateur/cours/etudiants-inscris/cours/12'),
(13, 5, 'Nouvelle inscription dans un cours', 'inscription_cours', 1, '2019-02-25 17:14:37', '/sofienne/public/index.php/espace-formateur/cours/etudiants-inscris/cours/11');

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `alpha2` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `alpha3` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `name_en` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `name_fr` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `pays`
--

INSERT INTO `pays` (`id`, `code`, `alpha2`, `alpha3`, `name_en`, `name_fr`) VALUES
(1, 4, 'AF', 'AFG', 'Afghanistan', 'Afghanistan'),
(2, 8, 'AL', 'ALB', 'Albania', 'Albanie'),
(3, 10, 'AQ', 'ATA', 'Antarctica', 'Antarctique'),
(4, 12, 'DZ', 'DZA', 'Algeria', 'Algérie'),
(5, 16, 'AS', 'ASM', 'American Samoa', 'Samoa Américaines'),
(6, 20, 'AD', 'AND', 'Andorra', 'Andorre'),
(7, 24, 'AO', 'AGO', 'Angola', 'Angola'),
(8, 28, 'AG', 'ATG', 'Antigua and Barbuda', 'Antigua-et-Barbuda'),
(9, 31, 'AZ', 'AZE', 'Azerbaijan', 'Azerbaïdjan'),
(10, 32, 'AR', 'ARG', 'Argentina', 'Argentine'),
(11, 36, 'AU', 'AUS', 'Australia', 'Australie'),
(12, 40, 'AT', 'AUT', 'Austria', 'Autriche'),
(13, 44, 'BS', 'BHS', 'Bahamas', 'Bahamas'),
(14, 48, 'BH', 'BHR', 'Bahrain', 'Bahreïn'),
(15, 50, 'BD', 'BGD', 'Bangladesh', 'Bangladesh'),
(16, 51, 'AM', 'ARM', 'Armenia', 'Arménie'),
(17, 52, 'BB', 'BRB', 'Barbados', 'Barbade'),
(18, 56, 'BE', 'BEL', 'Belgium', 'Belgique'),
(19, 60, 'BM', 'BMU', 'Bermuda', 'Bermudes'),
(20, 64, 'BT', 'BTN', 'Bhutan', 'Bhoutan'),
(21, 68, 'BO', 'BOL', 'Bolivia', 'Bolivie'),
(22, 70, 'BA', 'BIH', 'Bosnia and Herzegovina', 'Bosnie-Herzégovine'),
(23, 72, 'BW', 'BWA', 'Botswana', 'Botswana'),
(24, 74, 'BV', 'BVT', 'Bouvet Island', 'Île Bouvet'),
(25, 76, 'BR', 'BRA', 'Brazil', 'Brésil'),
(26, 84, 'BZ', 'BLZ', 'Belize', 'Belize'),
(27, 86, 'IO', 'IOT', 'British Indian Ocean Territory', 'Territoire Britannique de l\'Océan Indien'),
(28, 90, 'SB', 'SLB', 'Solomon Islands', 'Îles Salomon'),
(29, 92, 'VG', 'VGB', 'British Virgin Islands', 'Îles Vierges Britanniques'),
(30, 96, 'BN', 'BRN', 'Brunei Darussalam', 'Brunéi Darussalam'),
(31, 100, 'BG', 'BGR', 'Bulgaria', 'Bulgarie'),
(32, 104, 'MM', 'MMR', 'Myanmar', 'Myanmar'),
(33, 108, 'BI', 'BDI', 'Burundi', 'Burundi'),
(34, 112, 'BY', 'BLR', 'Belarus', 'Bélarus'),
(35, 116, 'KH', 'KHM', 'Cambodia', 'Cambodge'),
(36, 120, 'CM', 'CMR', 'Cameroon', 'Cameroun'),
(37, 124, 'CA', 'CAN', 'Canada', 'Canada'),
(38, 132, 'CV', 'CPV', 'Cape Verde', 'Cap-vert'),
(39, 136, 'KY', 'CYM', 'Cayman Islands', 'Îles Caïmanes'),
(40, 140, 'CF', 'CAF', 'Central African', 'République Centrafricaine'),
(41, 144, 'LK', 'LKA', 'Sri Lanka', 'Sri Lanka'),
(42, 148, 'TD', 'TCD', 'Chad', 'Tchad'),
(43, 152, 'CL', 'CHL', 'Chile', 'Chili'),
(44, 156, 'CN', 'CHN', 'China', 'Chine'),
(45, 158, 'TW', 'TWN', 'Taiwan', 'Taïwan'),
(46, 162, 'CX', 'CXR', 'Christmas Island', 'Île Christmas'),
(47, 166, 'CC', 'CCK', 'Cocos (Keeling) Islands', 'Îles Cocos (Keeling)'),
(48, 170, 'CO', 'COL', 'Colombia', 'Colombie'),
(49, 174, 'KM', 'COM', 'Comoros', 'Comores'),
(50, 175, 'YT', 'MYT', 'Mayotte', 'Mayotte'),
(51, 178, 'CG', 'COG', 'Republic of the Congo', 'République du Congo'),
(52, 180, 'CD', 'COD', 'The Democratic Republic Of The Congo', 'République Démocratique du Congo'),
(53, 184, 'CK', 'COK', 'Cook Islands', 'Îles Cook'),
(54, 188, 'CR', 'CRI', 'Costa Rica', 'Costa Rica'),
(55, 191, 'HR', 'HRV', 'Croatia', 'Croatie'),
(56, 192, 'CU', 'CUB', 'Cuba', 'Cuba'),
(57, 196, 'CY', 'CYP', 'Cyprus', 'Chypre'),
(58, 203, 'CZ', 'CZE', 'Czech Republic', 'République Tchèque'),
(59, 204, 'BJ', 'BEN', 'Benin', 'Bénin'),
(60, 208, 'DK', 'DNK', 'Denmark', 'Danemark'),
(61, 212, 'DM', 'DMA', 'Dominica', 'Dominique'),
(62, 214, 'DO', 'DOM', 'Dominican Republic', 'République Dominicaine'),
(63, 218, 'EC', 'ECU', 'Ecuador', 'Équateur'),
(64, 222, 'SV', 'SLV', 'El Salvador', 'El Salvador'),
(65, 226, 'GQ', 'GNQ', 'Equatorial Guinea', 'Guinée Équatoriale'),
(66, 231, 'ET', 'ETH', 'Ethiopia', 'Éthiopie'),
(67, 232, 'ER', 'ERI', 'Eritrea', 'Érythrée'),
(68, 233, 'EE', 'EST', 'Estonia', 'Estonie'),
(69, 234, 'FO', 'FRO', 'Faroe Islands', 'Îles Féroé'),
(70, 238, 'FK', 'FLK', 'Falkland Islands', 'Îles (malvinas) Falkland'),
(71, 239, 'GS', 'SGS', 'South Georgia and the South Sandwich Islands', 'Géorgie du Sud et les Îles Sandwich du Sud'),
(72, 242, 'FJ', 'FJI', 'Fiji', 'Fidji'),
(73, 246, 'FI', 'FIN', 'Finland', 'Finlande'),
(74, 248, 'AX', 'ALA', 'Åland Islands', 'Îles Åland'),
(75, 250, 'FR', 'FRA', 'France', 'France'),
(76, 254, 'GF', 'GUF', 'French Guiana', 'Guyane Française'),
(77, 258, 'PF', 'PYF', 'French Polynesia', 'Polynésie Française'),
(78, 260, 'TF', 'ATF', 'French Southern Territories', 'Terres Australes Françaises'),
(79, 262, 'DJ', 'DJI', 'Djibouti', 'Djibouti'),
(80, 266, 'GA', 'GAB', 'Gabon', 'Gabon'),
(81, 268, 'GE', 'GEO', 'Georgia', 'Géorgie'),
(82, 270, 'GM', 'GMB', 'Gambia', 'Gambie'),
(83, 275, 'PS', 'PSE', 'Occupied Palestinian Territory', 'Territoire Palestinien Occupé'),
(84, 276, 'DE', 'DEU', 'Germany', 'Allemagne'),
(85, 288, 'GH', 'GHA', 'Ghana', 'Ghana'),
(86, 292, 'GI', 'GIB', 'Gibraltar', 'Gibraltar'),
(87, 296, 'KI', 'KIR', 'Kiribati', 'Kiribati'),
(88, 300, 'GR', 'GRC', 'Greece', 'Grèce'),
(89, 304, 'GL', 'GRL', 'Greenland', 'Groenland'),
(90, 308, 'GD', 'GRD', 'Grenada', 'Grenade'),
(91, 312, 'GP', 'GLP', 'Guadeloupe', 'Guadeloupe'),
(92, 316, 'GU', 'GUM', 'Guam', 'Guam'),
(93, 320, 'GT', 'GTM', 'Guatemala', 'Guatemala'),
(94, 324, 'GN', 'GIN', 'Guinea', 'Guinée'),
(95, 328, 'GY', 'GUY', 'Guyana', 'Guyana'),
(96, 332, 'HT', 'HTI', 'Haiti', 'Haïti'),
(97, 334, 'HM', 'HMD', 'Heard Island and McDonald Islands', 'Îles Heard et Mcdonald'),
(98, 336, 'VA', 'VAT', 'Vatican City State', 'Saint-Siège (état de la Cité du Vatican)'),
(99, 340, 'HN', 'HND', 'Honduras', 'Honduras'),
(100, 344, 'HK', 'HKG', 'Hong Kong', 'Hong-Kong'),
(101, 348, 'HU', 'HUN', 'Hungary', 'Hongrie'),
(102, 352, 'IS', 'ISL', 'Iceland', 'Islande'),
(103, 356, 'IN', 'IND', 'India', 'Inde'),
(104, 360, 'ID', 'IDN', 'Indonesia', 'Indonésie'),
(105, 364, 'IR', 'IRN', 'Islamic Republic of Iran', 'République Islamique d\'Iran'),
(106, 368, 'IQ', 'IRQ', 'Iraq', 'Iraq'),
(107, 372, 'IE', 'IRL', 'Ireland', 'Irlande'),
(108, 376, 'IL', 'ISR', 'Israel', 'Israël'),
(109, 380, 'IT', 'ITA', 'Italy', 'Italie'),
(110, 384, 'CI', 'CIV', 'Côte d\'Ivoire', 'Côte d\'Ivoire'),
(111, 388, 'JM', 'JAM', 'Jamaica', 'Jamaïque'),
(112, 392, 'JP', 'JPN', 'Japan', 'Japon'),
(113, 398, 'KZ', 'KAZ', 'Kazakhstan', 'Kazakhstan'),
(114, 400, 'JO', 'JOR', 'Jordan', 'Jordanie'),
(115, 404, 'KE', 'KEN', 'Kenya', 'Kenya'),
(116, 408, 'KP', 'PRK', 'Democratic People\'s Republic of Korea', 'République Populaire Démocratique de Corée'),
(117, 410, 'KR', 'KOR', 'Republic of Korea', 'République de Corée'),
(118, 414, 'KW', 'KWT', 'Kuwait', 'Koweït'),
(119, 417, 'KG', 'KGZ', 'Kyrgyzstan', 'Kirghizistan'),
(120, 418, 'LA', 'LAO', 'Lao People\'s Democratic Republic', 'République Démocratique Populaire Lao'),
(121, 422, 'LB', 'LBN', 'Lebanon', 'Liban'),
(122, 426, 'LS', 'LSO', 'Lesotho', 'Lesotho'),
(123, 428, 'LV', 'LVA', 'Latvia', 'Lettonie'),
(124, 430, 'LR', 'LBR', 'Liberia', 'Libéria'),
(125, 434, 'LY', 'LBY', 'Libyan Arab Jamahiriya', 'Jamahiriya Arabe Libyenne'),
(126, 438, 'LI', 'LIE', 'Liechtenstein', 'Liechtenstein'),
(127, 440, 'LT', 'LTU', 'Lithuania', 'Lituanie'),
(128, 442, 'LU', 'LUX', 'Luxembourg', 'Luxembourg'),
(129, 446, 'MO', 'MAC', 'Macao', 'Macao'),
(130, 450, 'MG', 'MDG', 'Madagascar', 'Madagascar'),
(131, 454, 'MW', 'MWI', 'Malawi', 'Malawi'),
(132, 458, 'MY', 'MYS', 'Malaysia', 'Malaisie'),
(133, 462, 'MV', 'MDV', 'Maldives', 'Maldives'),
(134, 466, 'ML', 'MLI', 'Mali', 'Mali'),
(135, 470, 'MT', 'MLT', 'Malta', 'Malte'),
(136, 474, 'MQ', 'MTQ', 'Martinique', 'Martinique'),
(137, 478, 'MR', 'MRT', 'Mauritania', 'Mauritanie'),
(138, 480, 'MU', 'MUS', 'Mauritius', 'Maurice'),
(139, 484, 'MX', 'MEX', 'Mexico', 'Mexique'),
(140, 492, 'MC', 'MCO', 'Monaco', 'Monaco'),
(141, 496, 'MN', 'MNG', 'Mongolia', 'Mongolie'),
(142, 498, 'MD', 'MDA', 'Republic of Moldova', 'République de Moldova'),
(143, 500, 'MS', 'MSR', 'Montserrat', 'Montserrat'),
(144, 504, 'MA', 'MAR', 'Morocco', 'Maroc'),
(145, 508, 'MZ', 'MOZ', 'Mozambique', 'Mozambique'),
(146, 512, 'OM', 'OMN', 'Oman', 'Oman'),
(147, 516, 'NA', 'NAM', 'Namibia', 'Namibie'),
(148, 520, 'NR', 'NRU', 'Nauru', 'Nauru'),
(149, 524, 'NP', 'NPL', 'Nepal', 'Népal'),
(150, 528, 'NL', 'NLD', 'Netherlands', 'Pays-Bas'),
(151, 530, 'AN', 'ANT', 'Netherlands Antilles', 'Antilles Néerlandaises'),
(152, 533, 'AW', 'ABW', 'Aruba', 'Aruba'),
(153, 540, 'NC', 'NCL', 'New Caledonia', 'Nouvelle-Calédonie'),
(154, 548, 'VU', 'VUT', 'Vanuatu', 'Vanuatu'),
(155, 554, 'NZ', 'NZL', 'New Zealand', 'Nouvelle-Zélande'),
(156, 558, 'NI', 'NIC', 'Nicaragua', 'Nicaragua'),
(157, 562, 'NE', 'NER', 'Niger', 'Niger'),
(158, 566, 'NG', 'NGA', 'Nigeria', 'Nigéria'),
(159, 570, 'NU', 'NIU', 'Niue', 'Niué'),
(160, 574, 'NF', 'NFK', 'Norfolk Island', 'Île Norfolk'),
(161, 578, 'NO', 'NOR', 'Norway', 'Norvège'),
(162, 580, 'MP', 'MNP', 'Northern Mariana Islands', 'Îles Mariannes du Nord'),
(163, 581, 'UM', 'UMI', 'United States Minor Outlying Islands', 'Îles Mineures Éloignées des États-Unis'),
(164, 583, 'FM', 'FSM', 'Federated States of Micronesia', 'États Fédérés de Micronésie'),
(165, 584, 'MH', 'MHL', 'Marshall Islands', 'Îles Marshall'),
(166, 585, 'PW', 'PLW', 'Palau', 'Palaos'),
(167, 586, 'PK', 'PAK', 'Pakistan', 'Pakistan'),
(168, 591, 'PA', 'PAN', 'Panama', 'Panama'),
(169, 598, 'PG', 'PNG', 'Papua New Guinea', 'Papouasie-Nouvelle-Guinée'),
(170, 600, 'PY', 'PRY', 'Paraguay', 'Paraguay'),
(171, 604, 'PE', 'PER', 'Peru', 'Pérou'),
(172, 608, 'PH', 'PHL', 'Philippines', 'Philippines'),
(173, 612, 'PN', 'PCN', 'Pitcairn', 'Pitcairn'),
(174, 616, 'PL', 'POL', 'Poland', 'Pologne'),
(175, 620, 'PT', 'PRT', 'Portugal', 'Portugal'),
(176, 624, 'GW', 'GNB', 'Guinea-Bissau', 'Guinée-Bissau'),
(177, 626, 'TL', 'TLS', 'Timor-Leste', 'Timor-Leste'),
(178, 630, 'PR', 'PRI', 'Puerto Rico', 'Porto Rico'),
(179, 634, 'QA', 'QAT', 'Qatar', 'Qatar'),
(180, 638, 'RE', 'REU', 'Réunion', 'Réunion'),
(181, 642, 'RO', 'ROU', 'Romania', 'Roumanie'),
(182, 643, 'RU', 'RUS', 'Russian Federation', 'Fédération de Russie'),
(183, 646, 'RW', 'RWA', 'Rwanda', 'Rwanda'),
(184, 654, 'SH', 'SHN', 'Saint Helena', 'Sainte-Hélène'),
(185, 659, 'KN', 'KNA', 'Saint Kitts and Nevis', 'Saint-Kitts-et-Nevis'),
(186, 660, 'AI', 'AIA', 'Anguilla', 'Anguilla'),
(187, 662, 'LC', 'LCA', 'Saint Lucia', 'Sainte-Lucie'),
(188, 666, 'PM', 'SPM', 'Saint-Pierre and Miquelon', 'Saint-Pierre-et-Miquelon'),
(189, 670, 'VC', 'VCT', 'Saint Vincent and the Grenadines', 'Saint-Vincent-et-les Grenadines'),
(190, 674, 'SM', 'SMR', 'San Marino', 'Saint-Marin'),
(191, 678, 'ST', 'STP', 'Sao Tome and Principe', 'Sao Tomé-et-Principe'),
(192, 682, 'SA', 'SAU', 'Saudi Arabia', 'Arabie Saoudite'),
(193, 686, 'SN', 'SEN', 'Senegal', 'Sénégal'),
(194, 690, 'SC', 'SYC', 'Seychelles', 'Seychelles'),
(195, 694, 'SL', 'SLE', 'Sierra Leone', 'Sierra Leone'),
(196, 702, 'SG', 'SGP', 'Singapore', 'Singapour'),
(197, 703, 'SK', 'SVK', 'Slovakia', 'Slovaquie'),
(198, 704, 'VN', 'VNM', 'Vietnam', 'Viet Nam'),
(199, 705, 'SI', 'SVN', 'Slovenia', 'Slovénie'),
(200, 706, 'SO', 'SOM', 'Somalia', 'Somalie'),
(201, 710, 'ZA', 'ZAF', 'South Africa', 'Afrique du Sud'),
(202, 716, 'ZW', 'ZWE', 'Zimbabwe', 'Zimbabwe'),
(203, 724, 'ES', 'ESP', 'Spain', 'Espagne'),
(204, 732, 'EH', 'ESH', 'Western Sahara', 'Sahara Occidental'),
(205, 736, 'SD', 'SDN', 'Sudan', 'Soudan'),
(206, 740, 'SR', 'SUR', 'Suriname', 'Suriname'),
(207, 744, 'SJ', 'SJM', 'Svalbard and Jan Mayen', 'Svalbard etÎle Jan Mayen'),
(208, 748, 'SZ', 'SWZ', 'Swaziland', 'Swaziland'),
(209, 752, 'SE', 'SWE', 'Sweden', 'Suède'),
(210, 756, 'CH', 'CHE', 'Switzerland', 'Suisse'),
(211, 760, 'SY', 'SYR', 'Syrian Arab Republic', 'République Arabe Syrienne'),
(212, 762, 'TJ', 'TJK', 'Tajikistan', 'Tadjikistan'),
(213, 764, 'TH', 'THA', 'Thailand', 'Thaïlande'),
(214, 768, 'TG', 'TGO', 'Togo', 'Togo'),
(215, 772, 'TK', 'TKL', 'Tokelau', 'Tokelau'),
(216, 776, 'TO', 'TON', 'Tonga', 'Tonga'),
(217, 780, 'TT', 'TTO', 'Trinidad and Tobago', 'Trinité-et-Tobago'),
(218, 784, 'AE', 'ARE', 'United Arab Emirates', 'Émirats Arabes Unis'),
(219, 788, 'TN', 'TUN', 'Tunisia', 'Tunisie'),
(220, 792, 'TR', 'TUR', 'Turkey', 'Turquie'),
(221, 795, 'TM', 'TKM', 'Turkmenistan', 'Turkménistan'),
(222, 796, 'TC', 'TCA', 'Turks and Caicos Islands', 'Îles Turks et Caïques'),
(223, 798, 'TV', 'TUV', 'Tuvalu', 'Tuvalu'),
(224, 800, 'UG', 'UGA', 'Uganda', 'Ouganda'),
(225, 804, 'UA', 'UKR', 'Ukraine', 'Ukraine'),
(226, 807, 'MK', 'MKD', 'The Former Yugoslav Republic of Macedonia', 'L\'ex-République Yougoslave de Macédoine'),
(227, 818, 'EG', 'EGY', 'Egypt', 'Égypte'),
(228, 826, 'GB', 'GBR', 'United Kingdom', 'Royaume-Uni'),
(229, 833, 'IM', 'IMN', 'Isle of Man', 'Île de Man'),
(230, 834, 'TZ', 'TZA', 'United Republic Of Tanzania', 'République-Unie de Tanzanie'),
(231, 840, 'US', 'USA', 'United States', 'États-Unis'),
(232, 850, 'VI', 'VIR', 'U.S. Virgin Islands', 'Îles Vierges des États-Unis'),
(233, 854, 'BF', 'BFA', 'Burkina Faso', 'Burkina Faso'),
(234, 858, 'UY', 'URY', 'Uruguay', 'Uruguay'),
(235, 860, 'UZ', 'UZB', 'Uzbekistan', 'Ouzbékistan'),
(236, 862, 'VE', 'VEN', 'Venezuela', 'Venezuela'),
(237, 876, 'WF', 'WLF', 'Wallis and Futuna', 'Wallis et Futuna'),
(238, 882, 'WS', 'WSM', 'Samoa', 'Samoa'),
(239, 887, 'YE', 'YEM', 'Yemen', 'Yémen'),
(240, 891, 'CS', 'SCG', 'Serbia and Montenegro', 'Serbie-et-Monténégro'),
(241, 894, 'ZM', 'ZMB', 'Zambia', 'Zambie');

-- --------------------------------------------------------

--
-- Structure de la table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `quiz`
--

INSERT INTO `quiz` (`id`, `lesson_id`, `titre`, `date_creation`) VALUES
(2, 2, 'test ajout quiz edit', '2019-02-12 12:23:21'),
(3, 1, 'pourquoi mon menu ne s\'affiche pas sur une ligne', '2019-02-12 22:45:42');

-- --------------------------------------------------------

--
-- Structure de la table `quiz_etudiant`
--

CREATE TABLE `quiz_etudiant` (
  `id` int(11) NOT NULL,
  `etudiant_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `date_reponse` datetime NOT NULL,
  `note` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `quiz_etudiant`
--

INSERT INTO `quiz_etudiant` (`id`, `etudiant_id`, `lesson_id`, `date_reponse`, `note`) VALUES
(1, 1, 1, '2019-02-26 20:52:12', 0),
(2, 1, 1, '2019-02-26 20:53:30', 0),
(3, 1, 2, '2019-02-26 21:14:07', 10);

-- --------------------------------------------------------

--
-- Structure de la table `quiz_question`
--

CREATE TABLE `quiz_question` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `juste` tinyint(1) DEFAULT NULL,
  `quiz_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `quiz_question`
--

INSERT INTO `quiz_question` (`id`, `titre`, `juste`, `quiz_id`) VALUES
(1, 'question 1', 0, 2),
(2, 'question 2', 0, 2),
(3, 'question 3', 1, 2),
(4, 'question 4', 0, 2),
(5, 'q1', 0, 3),
(6, 'q2', 0, 3),
(7, 'q3', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `quiz_reponse`
--

CREATE TABLE `quiz_reponse` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `choix_id` int(11) NOT NULL,
  `etudiant_id` int(11) NOT NULL,
  `resultat` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `quiz_reponse`
--

INSERT INTO `quiz_reponse` (`id`, `quiz_id`, `choix_id`, `etudiant_id`, `resultat`) VALUES
(1, 3, 5, 1, 0),
(2, 3, 6, 1, 0),
(3, 2, 3, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `slideshow`
--

CREATE TABLE `slideshow` (
  `id` int(11) NOT NULL,
  `extension` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `display_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `slideshow`
--

INSERT INTO `slideshow` (`id`, `extension`, `name`, `title`, `active`, `created_at`, `display_order`) VALUES
(2, 'jpeg', '87e6498d6eacb607e95a28096cbaf8ac.jpeg', 'test slidershow', 1, '2019-01-23 21:21:23', 0),
(3, 'jpeg', 'ecbf0638d98de1ce23e220c3ca063e15.jpeg', NULL, 1, '2019-01-23 21:23:03', 1);

-- --------------------------------------------------------

--
-- Structure de la table `suivre_cours`
--

CREATE TABLE `suivre_cours` (
  `id` int(11) NOT NULL,
  `cours_id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `suivre_cours`
--

INSERT INTO `suivre_cours` (`id`, `cours_id`, `utilisateur_id`) VALUES
(5, 14, 6),
(6, 14, 8),
(7, 14, 3),
(10, 11, 3),
(11, 13, 3),
(12, 12, 3),
(13, 12, 5),
(14, 11, 5);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json DEFAULT NULL COMMENT '(DC2Type:json_array)',
  `active` tinyint(1) NOT NULL,
  `date_inscription` datetime NOT NULL,
  `dernier_connexion` datetime DEFAULT NULL,
  `prenom` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `email`, `password`, `roles`, `active`, `date_inscription`, `dernier_connexion`, `prenom`, `nom`) VALUES
(1, 'sofienne@gmail.com', '$2y$12$36PVx1hYwLnYwE9ITj61U.eMM875ZowRLFEZd5CPWWo4KB6n9SoM2', '[\"ROLE_SUPER_ADMIN\"]', 1, '2019-01-20 17:00:09', '2019-02-25 17:15:20', 'Sofienne ', 'Sofinne22'),
(2, 'houssem.derouich04@gmail.com', '$2y$12$9h8M7EWgUNk8RSRPFCobY.zdFVqca6XKJ9rxDSNFblYy4oPV/Ts7G', '[\"ROLE_ADMIN\"]', 1, '2019-01-20 17:11:20', NULL, 'Houssem edit', 'Derouich'),
(3, 'etudiant1@gmail.com', '$2y$12$KQ/wqUHt9OJghiY2cnFQQOXd2nGvloBQn/pUB2qU.nMtMrOTdaGum', '[\"ROLE_ETUDIANT\"]', 1, '2019-01-23 21:34:10', '2019-02-26 20:51:58', 'etudiant1', 'symfony edit'),
(4, 'formateur1@gmail.com', '$2y$12$3g.DTVBI3Fh9bRLrb3DlrOYQZLw2o6obHlzjSygxeRbdKgFScGeHu', '[\"ROLE_FORMATEUR\"]', 1, '2019-01-23 21:37:59', '2019-01-23 21:38:01', 'formateur', 'java'),
(5, 'formateur3@gmail.com', '$2y$12$KG6X1TG5zpMn5aCSXhxAHuOX4VoNCAG0bz8fi8byOGKYryJbJJxQm', '[\"ROLE_FORMATEUR\"]', 1, '2019-01-24 09:01:41', '2019-02-26 21:16:42', 'ali', 'ali'),
(6, 'formateur4@gmail.com', '$2y$12$dnLM8TxE..9q286Vh5/hQO4P8RN52rFesN8y81.eEGbOnrvCbYM5m', '[\"ROLE_FORMATEUR\"]', 1, '2019-01-24 10:23:19', '2019-01-24 10:23:20', 'php', 'formateur'),
(7, 'houssem.derouich04@gmail.comf', '$2y$12$Y7Odv.cwNhrvs0d8aAFLjesTMRVQ4ZXoabfsZYiHguEXJOSoutjIa', '[\"ROLE_FORMATEUR\"]', 1, '2019-02-22 17:46:56', '2019-02-22 17:46:58', 'notif', 'test'),
(8, 'houssem.projects@gmail.comkk', '$2y$12$I6phezOacWdom5iOFkpnEORjAASEPnu7zydtYSBYdoCAqwZ4aSdQe', '[\"ROLE_ETUDIANT\"]', 1, '2019-02-22 17:47:54', '2019-02-22 17:47:56', 'entreprise', 'houssem');

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `typevideo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `video`
--

INSERT INTO `video` (`id`, `typevideo`, `identif`) VALUES
(1, 'youtube', 'Z_Qb-BOAVac'),
(2, 'youtube', 'Z_Qb-BOAVac'),
(3, 'youtube', 'Z_Qb-BOAVac'),
(4, 'youtube', 'Z_Qb-BOAVac'),
(5, 'youtube', 'Z_Qb-BOAVac'),
(6, 'youtube', 'Z_Qb-BOAVac'),
(7, 'youtube', 'Z_Qb-BOAVac'),
(8, 'youtube', 'Z_Qb-BOAVac'),
(9, 'youtube', 'Z_Qb-BOAVac'),
(10, 'youtube', 'Z_Qb-BOAVac'),
(11, 'youtube', 'Z_Qb-BOAVac'),
(12, 'youtube', 'Z_Qb-BOAVac'),
(14, 'youtube', '82yVPNwC8cY'),
(15, 'youtube', '82yVPNwC8cY'),
(19, 'youtube', 'Z_Qb-BOAVac');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_32EB52E8FB88E14F` (`utilisateur_id`);

--
-- Index pour la table `avatar`
--
ALTER TABLE `avatar`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_497DD634989D9B62` (`slug`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_FDCA8C9C989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_FDCA8C9C3DA5256D` (`image_id`),
  ADD UNIQUE KEY `UNIQ_FDCA8C9C29C1004E` (`video_id`),
  ADD KEY `IDX_FDCA8C9CBCF5E72D` (`categorie_id`),
  ADD KEY `IDX_FDCA8C9C155D8F51` (`formateur_id`);

--
-- Index pour la table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_717E22E3FB88E14F` (`utilisateur_id`),
  ADD UNIQUE KEY `UNIQ_717E22E386383B10` (`avatar_id`),
  ADD KEY `IDX_717E22E3A6E44244` (`pays_id`);

--
-- Index pour la table `evaluation_cours`
--
ALTER TABLE `evaluation_cours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_383DF16D7ECF78B0` (`cours_id`),
  ADD KEY `IDX_383DF16DFB88E14F` (`utilisateur_id`);

--
-- Index pour la table `favoris_cours`
--
ALTER TABLE `favoris_cours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2EAFFFFD7ECF78B0` (`cours_id`),
  ADD KEY `IDX_2EAFFFFDFB88E14F` (`utilisateur_id`);

--
-- Index pour la table `formateur`
--
ALTER TABLE `formateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_ED767E4FFB88E14F` (`utilisateur_id`),
  ADD UNIQUE KEY `UNIQ_ED767E4F86383B10` (`avatar_id`),
  ADD KEY `IDX_ED767E4FA6E44244` (`pays_id`);

--
-- Index pour la table `formateur_categorie`
--
ALTER TABLE `formateur_categorie`
  ADD PRIMARY KEY (`formateur_id`,`categorie_id`),
  ADD KEY `IDX_5B796C83155D8F51` (`formateur_id`),
  ADD KEY `IDX_5B796C83BCF5E72D` (`categorie_id`);

--
-- Index pour la table `forum_question`
--
ALTER TABLE `forum_question`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_9104C4A9989D9B62` (`slug`),
  ADD KEY `IDX_9104C4A9FB88E14F` (`utilisateur_id`),
  ADD KEY `IDX_9104C4A9BCF5E72D` (`categorie_id`);

--
-- Index pour la table `forum_reponse`
--
ALTER TABLE `forum_reponse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AE7A93B61E27F6BF` (`question_id`),
  ADD KEY `IDX_AE7A93B6FB88E14F` (`utilisateur_id`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_F87474F3989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_F87474F329C1004E` (`video_id`),
  ADD UNIQUE KEY `UNIQ_F87474F3C33F7837` (`document_id`),
  ADD UNIQUE KEY `UNIQ_F87474F33DA5256D` (`image_id`),
  ADD KEY `IDX_F87474F37ECF78B0` (`cours_id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BF5476CAFB88E14F` (`utilisateur_id`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A412FA92CDF80196` (`lesson_id`);

--
-- Index pour la table `quiz_etudiant`
--
ALTER TABLE `quiz_etudiant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A7BADBA6DDEAB1A3` (`etudiant_id`),
  ADD KEY `IDX_A7BADBA6CDF80196` (`lesson_id`);

--
-- Index pour la table `quiz_question`
--
ALTER TABLE `quiz_question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6033B00B853CD175` (`quiz_id`);

--
-- Index pour la table `quiz_reponse`
--
ALTER TABLE `quiz_reponse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4DEC7367853CD175` (`quiz_id`),
  ADD KEY `IDX_4DEC7367D9144651` (`choix_id`),
  ADD KEY `IDX_4DEC7367DDEAB1A3` (`etudiant_id`);

--
-- Index pour la table `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_67B0E4105E237E06` (`name`);

--
-- Index pour la table `suivre_cours`
--
ALTER TABLE `suivre_cours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F8F4CA337ECF78B0` (`cours_id`),
  ADD KEY `IDX_F8F4CA33FB88E14F` (`utilisateur_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1D1C63B3E7927C74` (`email`);

--
-- Index pour la table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `avatar`
--
ALTER TABLE `avatar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `evaluation_cours`
--
ALTER TABLE `evaluation_cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `favoris_cours`
--
ALTER TABLE `favoris_cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `formateur`
--
ALTER TABLE `formateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `forum_question`
--
ALTER TABLE `forum_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `forum_reponse`
--
ALTER TABLE `forum_reponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `pays`
--
ALTER TABLE `pays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;
--
-- AUTO_INCREMENT pour la table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `quiz_etudiant`
--
ALTER TABLE `quiz_etudiant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `quiz_question`
--
ALTER TABLE `quiz_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `quiz_reponse`
--
ALTER TABLE `quiz_reponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `suivre_cours`
--
ALTER TABLE `suivre_cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `FK_32EB52E8FB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `FK_FDCA8C9C155D8F51` FOREIGN KEY (`formateur_id`) REFERENCES `formateur` (`id`),
  ADD CONSTRAINT `FK_FDCA8C9C29C1004E` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`),
  ADD CONSTRAINT `FK_FDCA8C9C3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `FK_FDCA8C9CBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `FK_717E22E386383B10` FOREIGN KEY (`avatar_id`) REFERENCES `avatar` (`id`),
  ADD CONSTRAINT `FK_717E22E3A6E44244` FOREIGN KEY (`pays_id`) REFERENCES `pays` (`id`),
  ADD CONSTRAINT `FK_717E22E3FB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `evaluation_cours`
--
ALTER TABLE `evaluation_cours`
  ADD CONSTRAINT `FK_383DF16D7ECF78B0` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`),
  ADD CONSTRAINT `FK_383DF16DFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `favoris_cours`
--
ALTER TABLE `favoris_cours`
  ADD CONSTRAINT `FK_2EAFFFFD7ECF78B0` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`),
  ADD CONSTRAINT `FK_2EAFFFFDFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `formateur`
--
ALTER TABLE `formateur`
  ADD CONSTRAINT `FK_ED767E4F86383B10` FOREIGN KEY (`avatar_id`) REFERENCES `avatar` (`id`),
  ADD CONSTRAINT `FK_ED767E4FA6E44244` FOREIGN KEY (`pays_id`) REFERENCES `pays` (`id`),
  ADD CONSTRAINT `FK_ED767E4FFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `formateur_categorie`
--
ALTER TABLE `formateur_categorie`
  ADD CONSTRAINT `FK_5B796C83155D8F51` FOREIGN KEY (`formateur_id`) REFERENCES `formateur` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5B796C83BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `forum_question`
--
ALTER TABLE `forum_question`
  ADD CONSTRAINT `FK_9104C4A9BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `FK_9104C4A9FB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `forum_reponse`
--
ALTER TABLE `forum_reponse`
  ADD CONSTRAINT `FK_AE7A93B61E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `forum_question` (`id`),
  ADD CONSTRAINT `FK_AE7A93B6FB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `FK_F87474F329C1004E` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`),
  ADD CONSTRAINT `FK_F87474F33DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `FK_F87474F37ECF78B0` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`),
  ADD CONSTRAINT `FK_F87474F3C33F7837` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`);

--
-- Contraintes pour la table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `FK_BF5476CAFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `FK_A412FA92CDF80196` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`);

--
-- Contraintes pour la table `quiz_etudiant`
--
ALTER TABLE `quiz_etudiant`
  ADD CONSTRAINT `FK_A7BADBA6CDF80196` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`),
  ADD CONSTRAINT `FK_A7BADBA6DDEAB1A3` FOREIGN KEY (`etudiant_id`) REFERENCES `etudiant` (`id`);

--
-- Contraintes pour la table `quiz_question`
--
ALTER TABLE `quiz_question`
  ADD CONSTRAINT `FK_6033B00B853CD175` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`);

--
-- Contraintes pour la table `quiz_reponse`
--
ALTER TABLE `quiz_reponse`
  ADD CONSTRAINT `FK_4DEC7367853CD175` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`),
  ADD CONSTRAINT `FK_4DEC7367D9144651` FOREIGN KEY (`choix_id`) REFERENCES `quiz_question` (`id`),
  ADD CONSTRAINT `FK_4DEC7367DDEAB1A3` FOREIGN KEY (`etudiant_id`) REFERENCES `etudiant` (`id`);

--
-- Contraintes pour la table `suivre_cours`
--
ALTER TABLE `suivre_cours`
  ADD CONSTRAINT `FK_F8F4CA337ECF78B0` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`),
  ADD CONSTRAINT `FK_F8F4CA33FB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
