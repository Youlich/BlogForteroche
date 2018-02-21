-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 21 fév. 2018 à 17:02
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
  `pseudo` varchar(255) NOT NULL,
  `pass` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `pseudo`, `pass`) VALUES
(2, 'jforteroche', 'soleil123');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL,
  `post_id` int(11) NOT NULL,
  `membre_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `author`, `comment`, `comment_date`, `post_id`, `membre_id`) VALUES
(1, 'juju', 'chouette', '2018-02-07 16:40:10', 1, 0),
(2, 'dd', 'dd', '2018-02-12 17:47:10', 1, 0),
(3, 'dd', 'dd', '2018-02-12 17:47:29', 1, 0),
(4, 'gg', 'C\'est magnifique ', '2018-02-12 17:48:19', 1, 0),
(5, 'juju', 'chouette !', '2018-02-12 17:51:02', 3, 0),
(6, 'juju', 'c\'est beau !!!', '2018-02-12 17:52:44', 4, 0),
(7, 'juju', 'bravo !!', '2018-02-12 20:59:16', 2, 0),
(8, 'juju', 'hello !!', '2018-02-14 18:08:22', 1, 0),
(9, 'dd', 'cc', '2018-02-15 16:29:17', 1, 0),
(10, 'cc', 'vvvvv', '2018-02-15 16:29:35', 1, 0),
(11, 'vbe', 'zzzzzt', '2018-02-15 16:30:50', 1, 0),
(12, 'dd', 'cccn', '2018-02-15 16:38:46', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) CHARACTER SET utf8 NOT NULL,
  `pass` text CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date_inscription` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id`, `pseudo`, `pass`, `email`, `date_inscription`) VALUES
(1, 'juju', '$2y$10$n0VR8HUSDK6N78U/uw8Jje2jNUgpcID.hlq9H7zIJAbTMijwe2Cku', 'jutatibouet@yahoo.fr', '2017-12-03'),
(18, 'bonbon', '$2y$10$5LudME5B9Ih7o33UHKq8geDqyTEcIU4bekoe5lY2O3Zh02jvBsEXm', 'jutatibouet@yahoo.fr', '2018-02-15'),
(5, 'trutu', '$2y$10$QKunwGjJvtNPBB6t/6aOgexnrwWV2rlDwBbVDnoryiy20TdTcGfnq', 'UTU@g1mail.com', '2017-12-03'),
(6, 'tutu', '$2y$10$6rMLAHx3Z9ZwW8/AYUXjL.UC8LAvR9cIVffWBQUPBq0XYMzduiX7C', 'UTU@g1mail.com', '2017-12-03'),
(17, 'juju', '$2y$10$k.NT4eI.cdHYXHOigNoX1Osgi0nWKGjZEKSwTV4Cv.TffRofxSx9q', 'juju.tatibouet@gmail.com', '2017-12-18'),
(8, 'toto', '$2y$10$phuBkJeaFaaNVYtYR1DB1OsbDjJghBtweISlVdQbT4pIhNKO4w5si', 'toto@gmail.com', '2017-12-04'),
(9, 'toto', '$2y$10$XL/Hx2zIVpn/blKompWgl.WHgGAq./.k3TCdM5bKom7X1vzdjXBva', 'toto@gmail.com', '2017-12-04'),
(10, 'toto', '$2y$10$/mRW6XeLxeNjk8UwvYpcC..hDwcYzM6Y9y9N7GXs9uNw..GnJW.WG', 'toto@gmail.com', '2017-12-04'),
(11, 'toto', '$2y$10$vjjbrFJjwWUAhA3ZvPUxcer6SZDJiFsrDykqWpOpr9op.QTsZ.ufG', 'toto@gmail.com', '2017-12-04'),
(12, 'titi', '$2y$10$xgne0FOjxVVyzHKDppF4o.Q28HjbWQY5/sz0kwsOGTMcoRafWRDai', 'ju.tatibouet@gmail.com', '2017-12-08'),
(13, 'tutu', '$2y$10$Co8RBeSxXl3tJNU4rQ.q8ODhVxjKv8.wb9I0YuJoZallJyO11b7tO', 'tutu.tutu@gmail.com', '2017-12-08'),
(14, 'georgio', '$2y$10$jCr8Fv3i7amY2MYIabvOa.OlCsv/KcTFEjKu1RxlGIZw8B1xnZC8m', 'georgio@yahoo.fr', '2017-12-11'),
(15, 'didine', '$2y$10$fw276QQ7BlUsPjCRy17wUOONf/byhZsRHjEvfp3.lViQ9WDINsbuK', 'didine@yahoo.fr', '2017-12-11'),
(16, 'didino', '$2y$10$iPFWjkrHJpMO2.9o9bxhNOBWEH6xTkGvGjvySutKqw1P0gxTM7ZRS', 'didino@yahoo.fr', '2017-12-11');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_date` date DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `resum` text,
  `image` varchar(1000) DEFAULT NULL,
  `nbcomms` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `post_date`, `title`, `content`, `resum`, `image`, `nbcomms`) VALUES
(1, '2018-02-06', 'Chapitre 1 : Quand le rêve devient réalité', 'Les expériences de son frère et d’une amie, respectivement au Québec et en Alaska, ont convaincu Marion de tenter l’aventure. Le rêve devient réalité lorsque, au retour de son premier séjour en Amérique du Nord, dans le cadre de vacances, elle trouve sa lettre d’acceptation au programme «Découverte USA». L’attente du placement a alors commencé. C’est au dernier moment, fin août, que Marion a su qu’elle partirait pour Anchorage, Alaska. L’inquiétude de cette longue attente est vite effacée par l’excitation du départ : en septembre Marion s’envole pour son pays d’accueil, et fait une escale de quelques jours sur la côte est des États-Unis avec les autres participants au programme.\r\nElle se souvient de son arrivée à Anchorage: «Je me suis dit : “Mais c’est pas les États-Unis!”', 'Les expériences de son frère et d’une amie, respectivement au Québec et en Alaska, ont convaincu Marion de tenter l’aventure. Le rêve devient réalité lorsque, au retour de son premier séjour en Amérique du Nord, dans le cadre de vacances, elle trouve sa lettre d’acceptation au programme «Découverte USA». L’attente du placement a alors commencé...', 'reve.jpg', 9),
(2, '2018-02-06', 'Chapitre 2 : Découverte de l\'Alaska', 'Cette ville, Anchorage, de plus de trois cent mille habitants ressemble, d’après elle, plus à une ville canadienne, avec des espaces verts, la mer d’un côté et la montagne de l’autre, qu’aux grandes métropoles des États-Unis avec leurs immenses buildings. La plupart des habitants pêchent leur propre poisson dans les rivières au printemps et en été, et profitent de la saison ensoleillée pour faire de la randonnée. La station de ski située à une heure de route de la ville leur permet de pratiquer également les sports d’hiver. C’est dans ce cadre naturel que Marion, bien souvent, occupait ses après-midi et ses week-ends, entre promenades, photographie et visites avec sa famille.\r\nLa situation géographique de cet état le soumet à des différences d’ensoleillement extrêmes selon la saison. En hiver, il fait nuit très tôt. Marion se souvient s’être retrouvée prête à aller se coucher avant de réaliser qu’il était… 16 heures 30! En revanche, durant l’été, il ne fait jamais vraiment nuit, ce qui favorise les activités extérieures. L’hiver, au contraire, permet aux habitants de cette région de se concentrer sur des activités d’intérieur telles que le théâtre, le cinéma ou tout simplement une soirée en famille à la maison.', 'Cette ville, Anchorage, de plus de trois cent mille habitants ressemble, d’après elle, plus à une ville canadienne, avec des espaces verts, la mer d’un côté et la montagne de l’autre, qu’aux grandes métropoles des États-Unis avec leurs immenses buildings. La plupart des habitants pêchent leur propre poisson dans les rivières au printemps et en été, et profitent de la saison ensoleillée pour faire de la randonnée. La station de ski située à une heure de route de la ville leur permet de pratiquer également les sports d’hiver...', 'decouverte.jpg', 1),
(3, '2018-02-06', 'Chapitre 3 : Les études en Alaska', 'Le lycée était là pour rappeler à Marion qu’elle se trouvait bien aux États-Unis: les casiers, les élèves qui s’habillent aux couleurs du lycée, les grands matchs, les bals… Toutes ces choses qui, finalement, n’existent pas qu’à la télé! Elle a tout de suite été intégrée. Arrivée lors de la «Semaine de découvertes d’autres cultures», elle a immédiatement été identifiée en tant que «La Française». Elle a pu choisir des cours aussi variés qu’intéressants : photographie, sciences criminelles, percussions… Elle a même été «Assistante de français»! Le soutien des professeurs, l’ambiance générale, ou encore la possibilité de choisir des cours en fonction de ses intérêts rendent le lycée là-bas plus attractif : «Je m’amusais, j’avais vraiment envie d’aller à l’école.»\r\nSon intégration au sein de sa famille d’accueil s’est très bien déroulée. Dès le lendemain de son arrivée, Marion a été présentée à tous les amis de la famille. Que de noms à retenir! Mais ce qui lui a fait le plus plaisir, c’est qu’«ils ne [la] présentaient pas comme Marion, l’étudiante d’échange, mais comme Marion, leur troisième fille.»\r\nSi la langue a pu poser quelques petits problèmes de compréhension dans les débuts, après quelques mois, Marion pouvait comprendre parfaitement les gens, ou regarder des films sans les sous-titres. Elle se souvient du moment où elle en a pris conscience: «Dans mon cours d’histoire des Etats-Unis, j’étais en train de parler avec quelqu’un, et je me suis rendue compte que je comprenais ce que la prof disait alors que je ne l’écoutais pas spécialement.» Quel bonheur!\r\nLe «Homesick», Marion ne l’a pas vraiment connu. L’excitation de cette nouvelle aventure et son intégration immédiate au sein de la famille et du lycée y ont beaucoup contribué. Elle se rappelle cependant avoir fêté ses 18 ans, au moment de Noël, au Texas, dans une famille de quarante personnes dont elle ne connaissait vraiment que quatre membres… «C’était un peu le coup dur, mais après que je sois remontée en Alaska au mois de janvier, c’était reparti.»\r\nAu fil de l’année, les amitiés tissées se sont renforcées. Le petit groupe d’étudiants d’échange qui s’était constitué en début d’année s’est vite agrandi, avec les amis américains que chacun apportait.\r\nMais lorsque l’été arrive, synonyme de fin des cours, les au revoir mettent les nerfs de chacun à rude épreuve. L’envie de rentrer en France, de revoir sa famille et ses amis, se mêle à celle de rester, de ne pas voir partir ses amis pour les quatre coins du monde et de ne pas quitter sa famille d’accueil et tous les gens rencontrés durant cette année', 'Le lycée était là pour rappeler à Marion qu’elle se trouvait bien aux États-Unis: les casiers, les élèves qui s’habillent aux couleurs du lycée, les grands matchs, les bals… Toutes ces choses qui, finalement, n’existent pas qu’à la télé! Elle a tout de suite été intégrée. Arrivée lors de la «Semaine de découvertes d’autres cultures», elle a immédiatement été identifiée en tant que «La Française». Elle a pu choisir des cours aussi variés qu’intéressants : photographie, sciences criminelles, percussions…', 'etudes.jpg', 9),
(4, '2018-02-06', 'Chapitre 4 : Expérience unique au coeur des glaciers', 'Avec quelques amis, nous souhaitions découvrir les glaciers, une nouvelle expérience inoubliable s\'offrait à nous.\r\n\r\nNous redescendons  dans le sud de l’ALASKA en empruntant la RICHARDSON HIGHWAY.\r\nLes paysages sont magnifiques…. Pas vraiment besoin de s’arreter dans des points précis. Sur la route, on découvre des lacs à moitiés glacés…et en plus il fait beau !\r\nNous reprenons la route vers 10 heures. La route n’est fait que de chemin de terre et de graviers.. Et là on se dit Vive les 4X4 ! Sans ce genre de véhicule c’est réellement difficilement praticable. Nous avons environs 3heures de route soit 100 miles pour se rendre à Mc Cathy. On croise seulement une station essence qui fait également petit hôtel Laundry et douche ! à la bonheur !\r\n\r\nA midi nous arrivons à proximité d’un centre d’information juste avant l’entrée d’un pont. Avant de nous rendre au KENNICOTT GLACIER, nous ne savions pas que la ville n’était accessible qu’à pieds ou en mini navette (la mini navette passe une fois toutes les heures) prix du ticket 5 $.\r\n\r\nLa journée bien commencée nous décidons de visiter le village de Mc CATHY. c’est comme-ci le temps c’était arrêté. Tout est d’époque ! Il faut savoir qu’il s’agit d’une ancienne ville minière de cuivre. Les Alaskiens mais plus particulièrement les Américians qui avaient flairé le potentiel de ce village ont pu extraire énormément de cuivre pour la fabrication de la monnaie , des tuyauteries….\r\nLe Parc National de « WRANGELL-St ELIAS » vaut apparemment  plus que le détour… iIl est le plus grand des USA et regroupe 4 chaines de montagnes ! Ce parc est un peu moins fréquenté que le DENALI NATIONAL PARK mais connu des très grands alpinistes pour les glaciers.\r\n\r\nIl offre la possibilité de dormir à seulement quelques mètres du KENNICOTT Glacier. On peut s’y rendre au plus prés avec des chaussures de randonnées. En revanche, si l’on décide de s’aventurer sur la journée ou plus, il est vivement recommandé de réserver l’excursion avec un guide…  Il y’a 2 agences a Kennicott, nous avons choisi l’agence ST ELIAS Alpine guides. L’excursion pour la journée complète est de 105 $ par personne. On décide de dormir au campground, la vue est juste magique, nous ne pouvons être  plus prés du glacier..  on est seul dans la nature. Ce parc est très fréquenté des ours comme il y a moins de visiteurs. Des grosses box = BRFC (Bear Resistant Food Containers) sont à disposition pur y mettre notre nourriture et produits de toilettes.\r\nC’est avec une jeune guide saisonnière américaine et son stagiaire, que nous entamons de 9H00 à 17H00 une randonnée sur les glaciers. Le soleil s’est manifesté pour rendre l’expérience encore plus magique…\r\n\r\nMc Carthy et Kenicott ne dispose pas d’électricité mais seulement d’un générateur. C’est un réel bond dans le temps.. le guides nous expliquent se faire réapprovisionner en nourriture toutes les 3 semaines. Ils ne mangent que de la junk food en même temps ce n’est pas très étonnant pour le pays.\r\n\r\non chaussent nos crampons et c’est parti pour un petit tour sur les glaciers… ça croustille pas mal ….\r\n\r\nPour les plus téméraires que nous sommes, on a gouté aux magnifiques piscines de glacier… un petit plongeon de seulement 30 secondes sufft.. c’est le froid le plus total.. à la sortie de l’eau la peau pique de partout. Une sacrée piscine vivifiante !!!!!\r\n\r\nC’était surréel, l’eau était tellement bleu, mais pas n’importe lequel ce bleu profond qui donne envie de se baigner ( je reconnais qu’il faut y réfléchir à deux fois) ….', 'Avec quelques amis, nous souhaitions découvrir les glaciers, une nouvelle expérience inoubliable s\'offrait à nous.\r\n\r\nNous redescendons  dans le sud de l’ALASKA en empruntant la RICHARDSON HIGHWAY.\r\nLes paysages sont magnifiques…. Pas vraiment besoin de s’arreter dans des points précis. Sur la route, on découvre des lacs à moitiés glacés…et en plus il fait beau !\r\nNous reprenons la route vers 10 heures. La route n’est fait que de chemin de terre et de graviers.. Et là on se dit Vive les 4X4 ! Sans ce genre de véhicule c’est réellement difficilement praticable. Nous avons environs 3heures de route soit 100 miles pour se rendre à Mc Cathy. On croise seulement une station essence qui fait également petit hôtel Laundry et douche ! à la bonheur !...', 'glacier.jpg', 9);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
