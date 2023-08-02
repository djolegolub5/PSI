-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jun 19, 2023 at 06:40 PM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vvk_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `anketa`
--

DROP TABLE IF EXISTS `anketa`;
CREATE TABLE IF NOT EXISTS `anketa` (
  `ID` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `anketa`
--

INSERT INTO `anketa` (`ID`) VALUES
(10);

-- --------------------------------------------------------

--
-- Table structure for table `forma`
--

DROP TABLE IF EXISTS `forma`;
CREATE TABLE IF NOT EXISTS `forma` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Naslov` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `BrPitanja` int NOT NULL,
  `DatumOd` datetime NOT NULL,
  `DatumDo` datetime NOT NULL,
  `IDAut` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FormaAutor` (`IDAut`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `forma`
--

INSERT INTO `forma` (`ID`, `Naslov`, `BrPitanja`, `DatumOd`, `DatumDo`, `IDAut`) VALUES
(10, 'Popularne ličnosti', 3, '2023-06-06 02:12:42', '2023-06-30 00:00:00', 2),
(11, 'Domaća kinematografija', 5, '2023-06-06 02:22:46', '2023-06-30 00:00:00', 2),
(13, 'Kviz', 1, '2023-06-18 10:00:54', '2023-06-19 00:00:00', 2),
(14, 'xxx', 1, '2023-06-18 10:03:03', '2023-06-30 00:00:00', 2),
(15, 'yyy', 1, '2023-06-18 10:05:39', '2023-06-30 00:00:00', 2),
(16, 'Kviz Obavesten Test', 1, '2023-06-19 06:10:58', '2023-06-18 00:00:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

DROP TABLE IF EXISTS `komentar`;
CREATE TABLE IF NOT EXISTS `komentar` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Komentar` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `Datum` datetime DEFAULT NULL,
  `IDKor` int NOT NULL,
  `IDNas` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `NaslovKomentar` (`IDNas`),
  KEY `KorisnikKomentar` (`IDKor`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`ID`, `Komentar`, `Datum`, `IDKor`, `IDNas`) VALUES
(27, 'Super!', '2023-06-01 23:49:08', 10, 8);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Ime` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Prezime` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `KorIme` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Lozinka` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `DatRodjenja` datetime NOT NULL,
  `Email` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `BrTel` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `Slika` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `BrPoena` int NOT NULL,
  `Novac` int NOT NULL,
  `DatReg` datetime NOT NULL,
  `Status` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`ID`, `Ime`, `Prezime`, `KorIme`, `Lozinka`, `DatRodjenja`, `Email`, `BrTel`, `Slika`, `BrPoena`, `Novac`, `DatReg`, `Status`) VALUES
(1, 'nikola', 'Curović', 'sc13', 'sifra123', '2002-02-04 12:22:00', 's@g.com', '0600126230', 'metallica.png', 131, 1303, '2023-05-17 13:00:23', 'Registrovan'),
(2, 'Admin', 'Admin', 'admin', 'admin123', '2023-05-01 01:53:28', 'admin@admin.rs', '063271688', 'admin.jpg', 0, 1500, '2023-05-20 23:53:28', 'Admin'),
(3, 'Teodora', 'Ristovic', 'tekii', 'sifra567', '2001-09-13 00:00:00', 'tea@etf.bg.ac.rs', '+381654321', 'image.jpeg', 0, 5000, '2023-05-28 03:53:41', 'Registrovan'),
(4, 'Djordje', 'Golubovic', 'djole', 'djole123', '2001-05-10 00:00:00', 'djole@etf.bg.ac.rs', '+3814325678', 'djole.jpg', 46, 1850, '2023-05-28 04:28:13', 'Registrovan'),
(9, 'Marija', 'Ristovic', 'makii<3', 'makii123', '2010-07-15 00:00:00', 'makii_artist@gmail.com', '+381236754', 'wolf.jpg', 0, 2000, '2023-05-28 09:03:06', 'Registrovan'),
(10, 'Aleksa', 'Trivic', 'akicar', 'akicar123', '2023-05-15 00:00:00', 'aki@etf.rs', '+381600123456', 'ceca.jpg', 211, 101, '2023-05-31 06:12:31', 'Registrovan'),
(13, 'Ste', 'Fan', 'stefan', 'stefan123', '2023-05-31 00:00:00', 's@g.com', '+381600123456', 'zdravko.png', 0, 0, '2023-05-31 06:41:25', 'Registrovan'),
(16, 'Novi', 'Najnoviji', 'novi', 'sifra123', '2023-06-13 00:00:00', 'novi@novi.rs', '+38163271688', '6477f297c352a.jpg', 0, 0, '2023-06-01 01:21:27', 'Registrovan'),
(17, 'Luka', 'Ristovic', 'lukalu', 'luklu123', '2005-05-06 00:00:00', 'lukalu123@gmail.com', '+3814325678', '6479db9011bab.jpeg', 0, 1500, '2023-06-02 12:07:44', 'Neautorizovan'),
(18, 'xxx', 'xxx', 'xxxx', 'sifra123', '2023-06-08 00:00:00', 'xxx@etf.rs', '+381621345789', NULL, 0, 0, '2023-06-18 10:08:10', 'Registrovan'),
(19, 'dddd', 'dddd', 'dddd', 'sifra123', '2023-06-02 00:00:00', 'dd@etf.rs', '+381632547891', NULL, 0, 0, '2023-06-18 10:10:05', 'Neautorizovan'),
(20, 'sss', 'sss', 'ssss', 'sifra123', '2023-06-09 00:00:00', 'ss@etf.rs', '+381632549871', NULL, 0, 10000, '2023-06-18 10:10:37', 'Neautorizovan'),
(21, 'ttt', 'ttt', 'ttt', 'sifra123', '2023-06-04 00:00:00', 'tt@etf.rs', '+381632578941', NULL, 10000, 0, '2023-06-18 10:11:08', 'Neautorizovan'),
(22, 'Suspendovan', 'Suspendovan', 'suspendovan', 'suspendovan123', '2023-06-18 23:08:12', 'suspendovan@etf.rs', '+38163271688', NULL, 0, 0, '2023-06-18 23:08:12', 'Suspendovan'),
(23, 'Iste', 'kao', 'istekao', 'sifra123', '2023-06-19 15:17:57', 'istekao@etf.rs', '+381631258479', NULL, 0, 0, '2023-06-19 15:17:57', 'Suspendovan'),
(24, 'Kri', 'ticar', 'kriticar', 'sifra123', '2023-06-18 17:22:16', 'kriticar@etf.rs', '+381632457981', NULL, 0, 0, '2023-06-08 17:22:16', 'Kriticar'),
(25, 'iksiks', 'iksiks', 'iksiks', 'sifra123', '2023-06-09 17:42:50', 'iks@etf.rs', '+381631258479', NULL, 0, 0, '2023-06-17 17:42:50', 'Registrovan');

-- --------------------------------------------------------

--
-- Table structure for table `korisnikkviz`
--

DROP TABLE IF EXISTS `korisnikkviz`;
CREATE TABLE IF NOT EXISTS `korisnikkviz` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `IDKor` int NOT NULL,
  `IDKviz` int NOT NULL,
  `BrBodova` int NOT NULL,
  `DatumZavrsetka` datetime NOT NULL,
  `obavesten` int DEFAULT '0',
  `VremeRada` time NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `KorisnikKK` (`IDKor`),
  KEY `KvizKK` (`IDKviz`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `korisnikkviz`
--

INSERT INTO `korisnikkviz` (`ID`, `IDKor`, `IDKviz`, `BrBodova`, `DatumZavrsetka`, `obavesten`, `VremeRada`) VALUES
(18, 9, 16, 10, '2023-06-19 06:11:17', 0, '00:00:02'),
(19, 10, 13, 5, '2023-06-13 20:39:23', 0, '00:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `kviz`
--

DROP TABLE IF EXISTS `kviz`;
CREATE TABLE IF NOT EXISTS `kviz` (
  `ID` int NOT NULL,
  `Vrsta` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Pravila` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `DatObj` datetime DEFAULT NULL,
  `BrUcesnika` int DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `kviz`
--

INSERT INTO `kviz` (`ID`, `Vrsta`, `Pravila`, `DatObj`, `BrUcesnika`) VALUES
(11, 'Domaci', '1,2,1,2,4;10,5,1', '2023-06-06 02:22:46', 6),
(13, 'Domaci', '1;1,0,0', '2023-06-14 10:00:54', 0),
(14, 'Domaci', '5;3,2,1', '2023-06-18 10:03:03', 0),
(15, 'Domaci', '1;1,1,1', '2023-06-18 10:05:39', 0),
(16, 'Domaci', '10;10,5,1', '2023-06-19 06:10:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nagrada`
--

DROP TABLE IF EXISTS `nagrada`;
CREATE TABLE IF NOT EXISTS `nagrada` (
  `Mesto` int NOT NULL,
  `Vrednost` int NOT NULL,
  `ID` int NOT NULL AUTO_INCREMENT,
  `IDKvi` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `KvizNagrada` (`IDKvi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `naslov`
--

DROP TABLE IF EXISTS `naslov`;
CREATE TABLE IF NOT EXISTS `naslov` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Ime` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Godina` int NOT NULL,
  `Zanr` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Cena` int NOT NULL,
  `Link` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Opis` varchar(512) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `BrPoena` int NOT NULL,
  `Slika` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ProsOcena` decimal(10,2) DEFAULT NULL,
  `Kategorija` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Trajanje` int DEFAULT NULL,
  `BrSezona` int DEFAULT NULL,
  `NosiPoena` int NOT NULL,
  `CenaIznajmljivanje` int NOT NULL,
  `PoeniIznajmljivanje` int NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `naslov`
--

INSERT INTO `naslov` (`ID`, `Ime`, `Godina`, `Zanr`, `Cena`, `Link`, `Opis`, `BrPoena`, `Slika`, `ProsOcena`, `Kategorija`, `Trajanje`, `BrSezona`, `NosiPoena`, `CenaIznajmljivanje`, `PoeniIznajmljivanje`) VALUES
(1, 'E.T.', 1982, 'Drama, Fantastika', 150, 'https://pristupnilink5.com', 'A troubled child summons the courage to help a friendly alien escape from Earth and return to his home planet.', 20, 'e.t..jpg', '7.00', 'Film', 160, NULL, 0, 0, 0),
(2, 'Avatar', 2009, 'Fantastika', 150, 'https://pristupnilink2.com', 'Avatar (marketed as James Cameron\'s Avatar) is a 2009 epic science fiction film directed, written, co-produced, and co-edited by James Cameron and starring Sam Worthington, Zoe Saldana, Stephen Lang, Michelle Rodriguez,[6] and Sigourney Weaver. ', 20, 'avatar.jpg', '7.00', 'Film', 120, NULL, 0, 5, 7),
(3, 'Nemoguća misija: Razilaženje', 2018, 'Fantastika, Akcija', 150, 'https://pristupnilink3.com', 'Nemoguća misija: Razilaženje (engl. Mission: Impossible – Fallout) je američki akcioni film iz 2018. godine, reditelja i scenariste Kristofera Makvorija na osnovu serije Nemoguća misija autora Brusa Gelera koja je se prikazivala od 1966. do 1973. na kanalu', 20, 'mission.jpg', '8.50', 'Film', 180, NULL, 0, 0, 0),
(4, 'Forrest Gump', 1991, 'Drama', 150, 'https://pristupnilink5.com', 'Slow-witted Forrest Gump (Tom Hanks) has never thought of himself as disadvantaged, and thanks to his supportive mother (Sally Field), he leads anything but a restricted life.', 30, 'forrest.jpg', '7.00', 'Film', 129, NULL, 10, 0, 0),
(5, 'Ceca show', 2022, 'Dokumentarni', 0, 'http://blictv.blic.rs/ceca-deca-prva-sezona-ceca-show-a-3', 'Zivot i karijera najvece balanske zvezde!', 300, '647b9e29e4390.jpg', '7.00', 'Serija', NULL, 1, 200, 250, 150),
(6, 'Jaws', 1975, 'Triler, Avantura', 150, 'https://pristupnilink6.com', 'When a killer shark unleashes chaos on a beach community off Cape Cod, it\'s up to a local sheriff, a marine biologist, and an old seafarer to hunt the beast down.', 56, 'jaws.jpg', '8.00', 'Film', 124, NULL, 0, 0, 0),
(7, 'Friends', 1994, 'Komedija', 150, 'https://pristupnilink7.com', 'Follows the personal and professional lives of six twenty to thirty year-old friends living in the Manhattan borough of New York City.', 30, 'friends.jpg', '8.00', 'Serija', NULL, 12, 0, 0, 0),
(8, 'Hobbit', 2012, 'Fantastika, Avantura', 0, 'https://pristupnilink8.com', 'A reluctant Hobbit, Bilbo Baggins, sets out to the Lonely Mountain with a spirited group of dwarves to reclaim their mountain home, and the gold within it from the dragon Smaug.', 30, 'hobbit.jpg', '7.00', 'Film', 120, NULL, 0, 0, 0),
(9, 'Eragon', 2006, 'Akcija, Avantura', 0, 'https://pristupnilink4.com', 'Eragon, a farm boy, stumbles upon a dragon\'s egg. He befriends the dragon cub and rides it only to realise that he is destined to be a dragon rider who must save his people from an evil king.', 250, '6479eba18f688.jpg', '7.00', 'Film', 104, NULL, 250, 125, 125),
(13, 'Novi', 2023, 'Triler', 0, 'pristupnilink.com', 'Film koji je u trendu', 3, NULL, '10.00', 'Film', 2, NULL, 4, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ocena`
--

DROP TABLE IF EXISTS `ocena`;
CREATE TABLE IF NOT EXISTS `ocena` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Ocena` int NOT NULL,
  `IDKor` int NOT NULL,
  `IDNas` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `KorisnikOcena` (`IDKor`),
  KEY `NaslovOcena` (`IDNas`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `ocena`
--

INSERT INTO `ocena` (`ID`, `Ocena`, `IDKor`, `IDNas`) VALUES
(15, 8, 10, 8);

-- --------------------------------------------------------

--
-- Table structure for table `pitanje`
--

DROP TABLE IF EXISTS `pitanje`;
CREATE TABLE IF NOT EXISTS `pitanje` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Tip` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Tekst` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `DrugiTekst` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `Slika` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `BrPonudjenih` int NOT NULL,
  `IDFor` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FormaPitanje` (`IDFor`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `pitanje`
--

INSERT INTO `pitanje` (`ID`, `Tip`, `Tekst`, `DrugiTekst`, `Slika`, `BrPonudjenih`, `IDFor`) VALUES
(25, 'RADIO', 'Koju ličnost biste želeli najviše da upoznate?', '', '', 3, 10),
(26, 'CHECK', 'Koju domaću seriju biste voleli da pogledate?', '', '', 3, 10),
(27, 'SELECT', 'Kojeg glumca mlađe generacije biste voleli da gledate?', '', '', 3, 10),
(28, 'RADIO', 'O kom pevaču narodne muzike je snimljen film 2021. godine?', '', '', 3, 11),
(29, 'CHECK', 'Koliko delova ima film Hajde da se volimo?', '', '', 3, 11),
(30, 'SELECT', 'U kojoj državi se dešava radnja filma Pljačka Trećeg Rajha?', '', '', 3, 11),
(31, 'TEKST', 'Srećko', 'je glavni lik u seriji Bela lađa.', '', 1, 11),
(32, 'SLIKA', 'Kako se zove serija sa slike?', '', '647f412a1e4f2.jpg', 3, 11),
(33, 'RADIO', 'Kviz', '', '', 1, 13),
(34, 'RADIO', 'xxx', '', '', 1, 14),
(35, 'RADIO', 'yyy', '', '', 1, 15),
(36, 'RADIO', 'Pitanje 1', '', '', 3, 16);

-- --------------------------------------------------------

--
-- Table structure for table `ponudjen`
--

DROP TABLE IF EXISTS `ponudjen`;
CREATE TABLE IF NOT EXISTS `ponudjen` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Tekst` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Tacan` int NOT NULL,
  `IDPit` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PitanjePonudjen` (`IDPit`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `ponudjen`
--

INSERT INTO `ponudjen` (`ID`, `Tekst`, `Tacan`, `IDPit`) VALUES
(41, 'Svetlana Ceca Ražnatović', 0, 25),
(42, 'Zdravko Čolić', 0, 25),
(43, 'Lepa Brena', 0, 25),
(44, 'Ubice mog oca', 0, 26),
(45, 'Južni vetar', 0, 26),
(46, 'Bela lađa', 0, 26),
(47, 'Miloš Biković', 0, 27),
(48, 'Aleksandar Radojičić', 0, 27),
(49, 'Tamara Dragičević', 0, 27),
(50, 'Lepa Lukić', 0, 28),
(51, 'Toma Zdravković', 1, 28),
(52, 'Aco Pejović', 0, 28),
(53, 'jedan', 0, 29),
(54, 'tri', 1, 29),
(55, 'dva', 0, 29),
(56, 'Tajland', 0, 30),
(57, 'Švajcarska', 0, 30),
(58, 'Nemačka', 1, 30),
(59, 'Šojić', 1, 31),
(60, 'Ceca show', 1, 32),
(61, 'Ceca i deca', 1, 32),
(62, 'Ceca show Ceca i deca', 1, 32),
(63, 'Kviz', 0, 33),
(64, 'xxx', 0, 34),
(65, 'yyy', 0, 35),
(66, 'tacan', 1, 36),
(67, 'netacan', 0, 36),
(68, 'netacan', 0, 36);

-- --------------------------------------------------------

--
-- Table structure for table `poseduje`
--

DROP TABLE IF EXISTS `poseduje`;
CREATE TABLE IF NOT EXISTS `poseduje` (
  `idPos` int NOT NULL AUTO_INCREMENT,
  `DatumOd` datetime NOT NULL,
  `DatumDo` datetime DEFAULT NULL,
  `IDKor` int NOT NULL,
  `IDNas` int NOT NULL,
  PRIMARY KEY (`idPos`),
  KEY `KorisnikPoseduje` (`IDKor`),
  KEY `NaslovPoseduje` (`IDNas`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `poseduje`
--

INSERT INTO `poseduje` (`idPos`, `DatumOd`, `DatumDo`, `IDKor`, `IDNas`) VALUES
(9, '2023-05-26 23:04:44', '2023-05-29 01:04:44', 1, 3),
(10, '2023-05-26 23:06:45', '2023-05-30 01:06:45', 1, 1),
(11, '2023-05-26 23:06:45', '2023-05-31 01:06:45', 1, 3),
(12, '2023-05-26 11:11:17', NULL, 1, 2),
(13, '2023-05-26 11:14:57', NULL, 1, 4),
(15, '2023-05-26 11:44:05', NULL, 1, 6),
(16, '2023-05-31 06:11:04', NULL, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pretplata`
--

DROP TABLE IF EXISTS `pretplata`;
CREATE TABLE IF NOT EXISTS `pretplata` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `DatumOd` datetime NOT NULL,
  `DatumDo` datetime NOT NULL,
  `IDKor` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `KorisnikPretplata` (`IDKor`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `pretplata`
--

INSERT INTO `pretplata` (`ID`, `DatumOd`, `DatumDo`, `IDKor`) VALUES
(11, '2023-06-01 17:23:29', '2023-06-07 17:23:29', 24);

-- --------------------------------------------------------

--
-- Table structure for table `suspendovan`
--

DROP TABLE IF EXISTS `suspendovan`;
CREATE TABLE IF NOT EXISTS `suspendovan` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Datum` datetime NOT NULL,
  `Trajanje` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Razlog` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `IDKor` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `KorisnikSuspendovan` (`IDKor`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `suspendovan`
--

INSERT INTO `suspendovan` (`ID`, `Datum`, `Trajanje`, `Razlog`, `IDKor`) VALUES
(24, '2023-06-01 17:19:07', '24', 'Glupi komentari.', 23);

-- --------------------------------------------------------

--
-- Table structure for table `uplata`
--

DROP TABLE IF EXISTS `uplata`;
CREATE TABLE IF NOT EXISTS `uplata` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Suma` int NOT NULL,
  `Datum` datetime NOT NULL,
  `IDKor` int NOT NULL,
  `BrKartice` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `VaziDo` date NOT NULL,
  `CVV` int NOT NULL,
  `Drzava` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Grad` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `UplataKorisnik` (`IDKor`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `uplata`
--

INSERT INTO `uplata` (`ID`, `Suma`, `Datum`, `IDKor`, `BrKartice`, `VaziDo`, `CVV`, `Drzava`, `Grad`) VALUES
(1, 1500, '2023-05-28 08:50:07', 3, '2345165789', '0000-00-00', 1234, 'Srbija', 'Beograd'),
(2, 1500, '2023-05-28 08:56:06', 3, '2345165789', '0000-00-00', 1234, 'Srbija', 'Beograd'),
(3, 2000, '2023-05-28 09:05:09', 9, '12345678', '0000-00-00', 1234, 'Srbija', 'Beograd'),
(4, 2000, '2023-05-30 12:24:44', 4, 'sdf', '0000-00-00', 0, 'sdf', 'sdf'),
(5, 299, '2023-05-30 12:37:45', 4, '1111222233334444', '0000-00-00', 123, 'Srbija', 'Beograd'),
(6, 299, '2023-05-30 12:38:34', 4, '1111222233334444', '0000-00-00', 123, 'Srbija', 'Beograd'),
(7, 1500, '2023-05-31 06:14:22', 10, '123', '0000-00-00', 123, 'Srbija', 'Beograd'),
(9, 1500, '2023-06-02 12:34:56', 17, '2345165789', '0000-00-00', 1224356218, 'Srbija', 'Beograd'),
(10, 2000, '2023-06-06 01:50:44', 1, '1', '0000-00-00', 2651, 'rb', 'bgvs');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anketa`
--
ALTER TABLE `anketa`
  ADD CONSTRAINT `AnketaForma` FOREIGN KEY (`ID`) REFERENCES `forma` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `forma`
--
ALTER TABLE `forma`
  ADD CONSTRAINT `FormaAutor` FOREIGN KEY (`IDAut`) REFERENCES `korisnik` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `KorisnikKomentar` FOREIGN KEY (`IDKor`) REFERENCES `korisnik` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `NaslovKomentar` FOREIGN KEY (`IDNas`) REFERENCES `naslov` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `korisnikkviz`
--
ALTER TABLE `korisnikkviz`
  ADD CONSTRAINT `KorisnikKK` FOREIGN KEY (`IDKor`) REFERENCES `korisnik` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `KvizKK` FOREIGN KEY (`IDKviz`) REFERENCES `kviz` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kviz`
--
ALTER TABLE `kviz`
  ADD CONSTRAINT `kvizForma` FOREIGN KEY (`ID`) REFERENCES `forma` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ocena`
--
ALTER TABLE `ocena`
  ADD CONSTRAINT `KorisnikOcena` FOREIGN KEY (`IDKor`) REFERENCES `korisnik` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `NaslovOcena` FOREIGN KEY (`IDNas`) REFERENCES `naslov` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pitanje`
--
ALTER TABLE `pitanje`
  ADD CONSTRAINT `FormaPitanje` FOREIGN KEY (`IDFor`) REFERENCES `forma` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ponudjen`
--
ALTER TABLE `ponudjen`
  ADD CONSTRAINT `PitanjePonudjen` FOREIGN KEY (`IDPit`) REFERENCES `pitanje` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `poseduje`
--
ALTER TABLE `poseduje`
  ADD CONSTRAINT `KorisnikPoseduje` FOREIGN KEY (`IDKor`) REFERENCES `korisnik` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `NaslovPoseduje` FOREIGN KEY (`IDNas`) REFERENCES `naslov` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pretplata`
--
ALTER TABLE `pretplata`
  ADD CONSTRAINT `KorisnikPretplata` FOREIGN KEY (`IDKor`) REFERENCES `korisnik` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `suspendovan`
--
ALTER TABLE `suspendovan`
  ADD CONSTRAINT `KorisnikSuspendovan` FOREIGN KEY (`IDKor`) REFERENCES `korisnik` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `uplata`
--
ALTER TABLE `uplata`
  ADD CONSTRAINT `UplataKorisnik` FOREIGN KEY (`IDKor`) REFERENCES `korisnik` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
