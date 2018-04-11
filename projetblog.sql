-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 11 avr. 2018 à 13:53
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetblog`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `mdp` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `login`, `mdp`, `photo`, `message`) VALUES
(2, 'jforteroche', '$2y$10$6vQ.hVb.jmmhTtvGNBK6PuXcZTlx545A9XZZGbNl6WSPm6NKuoi0i', 'public/images/forteroche.jpg', 'Je m\'appelle Jean Forteroche, auteur de Roman mon m&eacute;tier, ma passion. Je vis en Bretagne, dont je suis originaire. Vous trouverez sur ce site : - mon Blog avec les chapitres de mon nouveau roman. N\'h&eacute;sitez pas &agrave; donner votre avis. - ma bibliographie - une page contact si vous souhaitez me poser des questions compl&eacute;mentaires. Bonne visite ! !');

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `title`) VALUES
(1, 'Billet simple pour l\'Alaska'),
(19, 'Chat noir');

-- --------------------------------------------------------

--
-- Structure de la table `chapters`
--

DROP TABLE IF EXISTS `chapters`;
CREATE TABLE IF NOT EXISTS `chapters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chapterDate` date DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `resum` text,
  `nbcomms` int(11) DEFAULT NULL,
  `bookId` int(11) DEFAULT NULL,
  `imageId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chapters`
--

INSERT INTO `chapters` (`id`, `chapterDate`, `title`, `content`, `resum`, `nbcomms`, `bookId`, `imageId`) VALUES
(1, '2018-04-11', 'Chapitre 1 : Quand le rêve devient réalité', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer maximus lacus in luctus blandit. Donec efficitur orci at mattis lobortis. Nam maximus elit et lacus rutrum, a mollis lacus semper. Cras a enim convallis, vulputate ligula id, rhoncus nisi. Praesent vel tellus scelerisque, ullamcorper ante sed, iaculis libero. Vestibulum iaculis leo ut ipsum efficitur elementum. Ut in vestibulum erat, vitae placerat nulla. Maecenas vel metus tortor. Proin pharetra neque lectus, sed mollis diam auctor eu. Donec semper ex ac tortor tincidunt dapibus. Vivamus laoreet luctus mi at accumsan. Morbi ultricies tempor est, vel bibendum erat scelerisque sed. Vivamus eros tellus, laoreet ac mollis dignissim, aliquet id nisi. Suspendisse vitae erat a mauris auctor blandit a a sem. Maecenas ac mi non dolor porttitor aliquam ut eu massa. Proin pellentesque sem quis enim cursus finibus.&lt;br /&gt;&lt;br /&gt;Suspendisse potenti. Integer maximus fringilla venenatis. In malesuada, arcu quis eleifend eleifend, purus turpis accumsan eros, vel tempus quam dolor non eros. Vivamus odio lectus, facilisis gravida consequat quis, suscipit tristique leo. Vestibulum finibus vehicula dui, sed auctor orci hendrerit in. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla dapibus augue tellus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ornare accumsan lacus a consectetur. Nunc euismod cursus euismod. Vestibulum mollis luctus lorem, id placerat ante venenatis a. Nulla dictum dolor ipsum, vitae vehicula magna pharetra fringilla. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut sollicitudin commodo massa eget molestie.', 'Les expériences de son frère et d’une amie, respectivement au Québec et en Alaska, ont convaincu Marion de tenter l’aventure. Le rêve devient réalité lorsque, au retour de son premier séjour en Amérique du Nord, dans le cadre de vacances, elle trouve sa lettre d’acceptation au programme «Découverte USA». L’attente du placement a alors commencé...', 0, 1, 1),
(2, '2018-02-02', 'Chapitre 2 : Découverte de l\'Alaska', 'Cette ville, Anchorage, de plus de trois cent mille habitants ressemble, d’après elle, plus à une ville canadienne, avec des espaces verts, la mer d’un côté et la montagne de l’autre, qu’aux grandes métropoles des États-Unis avec leurs immenses buildings. La plupart des habitants pêchent leur propre poisson dans les rivières au printemps et en été, et profitent de la saison ensoleillée pour faire de la randonnée. La station de ski située à une heure de route de la ville leur permet de pratiquer également les sports d’hiver. C’est dans ce cadre naturel que Marion, bien souvent, occupait ses après-midi et ses week-ends, entre promenades, photographie et visites avec sa famille.\r\nLa situation géographique de cet état le soumet à des différences d’ensoleillement extrêmes selon la saison. En hiver, il fait nuit très tôt. Marion se souvient s’être retrouvée prête à aller se coucher avant de réaliser qu’il était… 16 heures 30! En revanche, durant l’été, il ne fait jamais vraiment nuit, ce qui favorise les activités extérieures. L’hiver, au contraire, permet aux habitants de cette région de se concentrer sur des activités d’intérieur telles que le théâtre, le cinéma ou tout simplement une soirée en famille à la maison.', 'Cette ville, Anchorage, de plus de trois cent mille habitants ressemble, d’après elle, plus à une ville canadienne, avec des espaces verts, la mer d’un côté et la montagne de l’autre, qu’aux grandes métropoles des États-Unis avec leurs immenses buildings. La plupart des habitants pêchent leur propre poisson dans les rivières au printemps et en été, et profitent de la saison ensoleillée pour faire de la randonnée. La station de ski située à une heure de route de la ville leur permet de pratiquer également les sports d’hiver...', 0, 1, 2),
(3, '2018-02-13', 'Chapitre 3 : Les études en Alaska', 'Le lycée était là pour rappeler à Marion qu’elle se trouvait bien aux États-Unis: les casiers, les élèves qui s’habillent aux couleurs du lycée, les grands matchs, les bals… Toutes ces choses qui, finalement, n’existent pas qu’à la télé! Elle a tout de suite été intégrée. Arrivée lors de la «Semaine de découvertes d’autres cultures», elle a immédiatement été identifiée en tant que «La Française». Elle a pu choisir des cours aussi variés qu’intéressants : photographie, sciences criminelles, percussions… Elle a même été «Assistante de français»! Le soutien des professeurs, l’ambiance générale, ou encore la possibilité de choisir des cours en fonction de ses intérêts rendent le lycée là-bas plus attractif : «Je m’amusais, j’avais vraiment envie d’aller à l’école.»\r\nSon intégration au sein de sa famille d’accueil s’est très bien déroulée. Dès le lendemain de son arrivée, Marion a été présentée à tous les amis de la famille. Que de noms à retenir! Mais ce qui lui a fait le plus plaisir, c’est qu’«ils ne [la] présentaient pas comme Marion, l’étudiante d’échange, mais comme Marion, leur troisième fille.»\r\nSi la langue a pu poser quelques petits problèmes de compréhension dans les débuts, après quelques mois, Marion pouvait comprendre parfaitement les gens, ou regarder des films sans les sous-titres. Elle se souvient du moment où elle en a pris conscience: «Dans mon cours d’histoire des Etats-Unis, j’étais en train de parler avec quelqu’un, et je me suis rendue compte que je comprenais ce que la prof disait alors que je ne l’écoutais pas spécialement.» Quel bonheur!\r\nLe «Homesick», Marion ne l’a pas vraiment connu. L’excitation de cette nouvelle aventure et son intégration immédiate au sein de la famille et du lycée y ont beaucoup contribué. Elle se rappelle cependant avoir fêté ses 18 ans, au moment de Noël, au Texas, dans une famille de quarante personnes dont elle ne connaissait vraiment que quatre membres… «C’était un peu le coup dur, mais après que je sois remontée en Alaska au mois de janvier, c’était reparti.»\r\nAu fil de l’année, les amitiés tissées se sont renforcées. Le petit groupe d’étudiants d’échange qui s’était constitué en début d’année s’est vite agrandi, avec les amis américains que chacun apportait.\r\nMais lorsque l’été arrive, synonyme de fin des cours, les au revoir mettent les nerfs de chacun à rude épreuve. L’envie de rentrer en France, de revoir sa famille et ses amis, se mêle à celle de rester, de ne pas voir partir ses amis pour les quatre coins du monde et de ne pas quitter sa famille d’accueil et tous les gens rencontrés durant cette année', 'Le lycée était là pour rappeler à Marion qu’elle se trouvait bien aux États-Unis: les casiers, les élèves qui s’habillent aux couleurs du lycée, les grands matchs, les bals… Toutes ces choses qui, finalement, n’existent pas qu’à la télé! Elle a tout de suite été intégrée. Arrivée lors de la «Semaine de découvertes d’autres cultures», elle a immédiatement été identifiée en tant que «La Française». Elle a pu choisir des cours aussi variés qu’intéressants : photographie, sciences criminelles, percussions…', 0, 1, 3),
(4, '2018-02-20', 'Chapitre 4 : Expérience unique au coeur des glaciers', 'Avec quelques amis, nous souhaitions découvrir les glaciers, une nouvelle expérience inoubliable s\'offrait à nous.\r\n\r\nNous redescendons  dans le sud de l’ALASKA en empruntant la RICHARDSON HIGHWAY.\r\nLes paysages sont magnifiques…. Pas vraiment besoin de s’arreter dans des points précis. Sur la route, on découvre des lacs à moitiés glacés…et en plus il fait beau !\r\nNous reprenons la route vers 10 heures. La route n’est fait que de chemin de terre et de graviers.. Et là on se dit Vive les 4X4 ! Sans ce genre de véhicule c’est réellement difficilement praticable. Nous avons environs 3heures de route soit 100 miles pour se rendre à Mc Cathy. On croise seulement une station essence qui fait également petit hôtel Laundry et douche ! à la bonheur !\r\n\r\nA midi nous arrivons à proximité d’un centre d’information juste avant l’entrée d’un pont. Avant de nous rendre au KENNICOTT GLACIER, nous ne savions pas que la ville n’était accessible qu’à pieds ou en mini navette (la mini navette passe une fois toutes les heures) prix du ticket 5 $.\r\n\r\nLa journée bien commencée nous décidons de visiter le village de Mc CATHY. c’est comme-ci le temps c’était arrêté. Tout est d’époque ! Il faut savoir qu’il s’agit d’une ancienne ville minière de cuivre. Les Alaskiens mais plus particulièrement les Américians qui avaient flairé le potentiel de ce village ont pu extraire énormément de cuivre pour la fabrication de la monnaie , des tuyauteries….\r\nLe Parc National de « WRANGELL-St ELIAS » vaut apparemment  plus que le détour… iIl est le plus grand des USA et regroupe 4 chaines de montagnes ! Ce parc est un peu moins fréquenté que le DENALI NATIONAL PARK mais connu des très grands alpinistes pour les glaciers.\r\n\r\nIl offre la possibilité de dormir à seulement quelques mètres du KENNICOTT Glacier. On peut s’y rendre au plus prés avec des chaussures de randonnées. En revanche, si l’on décide de s’aventurer sur la journée ou plus, il est vivement recommandé de réserver l’excursion avec un guide…  Il y’a 2 agences a Kennicott, nous avons choisi l’agence ST ELIAS Alpine guides. L’excursion pour la journée complète est de 105 $ par personne. On décide de dormir au campground, la vue est juste magique, nous ne pouvons être  plus prés du glacier..  on est seul dans la nature. Ce parc est très fréquenté des ours comme il y a moins de visiteurs. Des grosses box = BRFC (Bear Resistant Food Containers) sont à disposition pur y mettre notre nourriture et produits de toilettes.\r\nC’est avec une jeune guide saisonnière américaine et son stagiaire, que nous entamons de 9H00 à 17H00 une randonnée sur les glaciers. Le soleil s’est manifesté pour rendre l’expérience encore plus magique…\r\n\r\nMc Carthy et Kenicott ne dispose pas d’électricité mais seulement d’un générateur. C’est un réel bond dans le temps.. le guides nous expliquent se faire réapprovisionner en nourriture toutes les 3 semaines. Ils ne mangent que de la junk food en même temps ce n’est pas très étonnant pour le pays.\r\n\r\non chaussent nos crampons et c’est parti pour un petit tour sur les glaciers… ça croustille pas mal ….\r\n\r\nPour les plus téméraires que nous sommes, on a gouté aux magnifiques piscines de glacier… un petit plongeon de seulement 30 secondes sufft.. c’est le froid le plus total.. à la sortie de l’eau la peau pique de partout. Une sacrée piscine vivifiante !!!!!\r\n\r\nC’était surréel, l’eau était tellement bleu, mais pas n’importe lequel ce bleu profond qui donne envie de se baigner ( je reconnais qu’il faut y réfléchir à deux fois) ….', 'Avec quelques amis, nous souhaitions découvrir les glaciers, une nouvelle expérience inoubliable s\'offrait à nous.\r\n\r\nNous redescendons  dans le sud de l’ALASKA en empruntant la RICHARDSON HIGHWAY.\r\nLes paysages sont magnifiques…. Pas vraiment besoin de s’arreter dans des points précis. Sur la route, on découvre des lacs à moitiés glacés…et en plus il fait beau !\r\nNous reprenons la route vers 10 heures. La route n’est fait que de chemin de terre et de graviers.. Et là on se dit Vive les 4X4 ! Sans ce genre de véhicule c’est réellement difficilement praticable. Nous avons environs 3heures de route soit 100 miles pour se rendre à Mc Cathy. On croise seulement une station essence qui fait également petit hôtel Laundry et douche ! à la bonheur !...', 0, 1, 4),
(65, '2018-04-11', 'Chapitre 5 : retour en France', '&amp;lt;p&amp;gt;ggggdgdgd&amp;lt;/p&amp;gt;\r\n&amp;lt;p&amp;gt;yuutu&amp;lt;/p&amp;gt;', '<p>ggggdgdgd</p>\r\n<p>yuutu</p>', NULL, 1, 0),
(66, '2018-04-11', 'Chapitre 6 : Test nouveau chapitre', '&amp;lt;p&amp;gt;&amp;amp;nbsp;bvbgfjfghgfj&amp;lt;/p&amp;gt;', '<p>&nbsp;bvbgfjfghgfj</p>', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `commentDate` datetime NOT NULL,
  `chapterId` int(11) NOT NULL,
  `membreId` int(11) NOT NULL,
  `membrePseudo` varchar(255) NOT NULL,
  `statut` enum('En attente','Valide','Refus','Alerte') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `commentDate`, `chapterId`, `membreId`, `membrePseudo`, `statut`) VALUES
(44, 'magnifique !!', '2018-04-04 10:43:24', 1, 132, 'Youlich', 'Valide'),
(45, 'trop beau !', '2018-04-04 10:45:06', 2, 132, 'Youlich', 'Alerte'),
(62, 'coucou', '2018-04-10 22:27:14', 4, 132, 'Youlich', 'En attente'),
(72, 'super beau !', '2018-04-11 15:37:55', 3, 135, 'Lucas', 'En attente'),
(74, 'super beau !', '2018-04-11 15:46:22', 2, 137, 'Hugo', 'En attente');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `fileUrl` varchar(255) NOT NULL,
  `chapterId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=127 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `name`, `fileUrl`, `chapterId`) VALUES
(1, 'reve.jpg', 'public/images/reve.jpg', 1),
(2, 'decouverte.jpg', 'public/images/decouverte.jpg', 2),
(3, 'etudes.jpg', 'public/images/etudes.jpg', 3),
(4, 'glacier.jpg', 'public/images/glacier.jpg', 4),
(126, 'background-2732432_1280.jpg', 'public/images/background-2732432_1280.jpg', 57);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `pass` text NOT NULL,
  `email` varchar(255) CHARACTER SET ascii NOT NULL,
  `dateInscription` date NOT NULL,
  `nbcomms` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=138 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id`, `pseudo`, `pass`, `email`, `dateInscription`, `nbcomms`) VALUES
(135, 'Lucas', '$2y$10$3fsnMWczLU7SVpdFP3Meq.vhB2.8k3AP9q.o/ZG43orqFlwY9m28m', 'lucas@yahoo.fr', '2018-04-10', 1),
(132, 'Youlich', '$2y$10$r2lhTJaSiUeZYSHqZrnlruoPrzSoo3ctsLhAG9j.9KdAk6EtRJRMm', 'jutatibouet@gmail.com', '2018-03-14', 3),
(137, 'Hugo', '$2y$10$/z8kaC8F/IAKVarvVjSoJuIjBdABrZPszwlTbrDjG8SlBa4dcQIOi', 'hugo@yahoo.fr', '2018-04-11', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
