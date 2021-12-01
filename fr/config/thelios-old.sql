-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 20, 2021 at 04:08 PM
-- Server version: 10.3.28-MariaDB
-- PHP Version: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thelios`
--

-- --------------------------------------------------------

--
-- Table structure for table `ACTIVITES`
--

CREATE TABLE `ACTIVITES` (
  `ID` int(11) NOT NULL,
  `EVENT_ID` int(11) NOT NULL,
  `THEME` text NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `DATE` date NOT NULL,
  `HEURE` text NOT NULL,
  `SALLE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ACTIVITES`
--

INSERT INTO `ACTIVITES` (`ID`, `EVENT_ID`, `THEME`, `DESCRIPTION`, `DATE`, `HEURE`, `SALLE`) VALUES
(6, 85, 'Safari', 'Avec les lions', '2019-09-30', '12h34', 'Tanzanie'),
(8, 85, 'Safari - Copiea', 'Avec les éléphants', '2019-09-25', '22h30', 'Kenya');

-- --------------------------------------------------------

--
-- Table structure for table `EVENTS`
--

CREATE TABLE `EVENTS` (
  `ID` int(11) NOT NULL,
  `NOM` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `CREATION` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PAR` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `DESCRIPTION` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `DATE_IN` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `DATE_OUT` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `OPT_ACCUEIL` tinyint(1) NOT NULL DEFAULT 0,
  `OPT_ACTUALITES` tinyint(1) NOT NULL DEFAULT 0,
  `OPT_PROGRAMME` tinyint(1) NOT NULL DEFAULT 0,
  `OPT_HEBERGEMENT` tinyint(1) NOT NULL DEFAULT 0,
  `OPT_INFOSPRATIQUES` tinyint(1) NOT NULL DEFAULT 0,
  `OPT_PRESSE` tinyint(1) NOT NULL DEFAULT 0,
  `OPT_CONTACT` tinyint(1) NOT NULL DEFAULT 0,
  `OPT_INSCRIPTION` tinyint(1) NOT NULL DEFAULT 0,
  `OPT_ACTIVITES` tinyint(1) NOT NULL DEFAULT 0,
  `OPT_HEBERGEMENT2` tinyint(1) NOT NULL DEFAULT 0,
  `OPT_TRANSPORT` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `EVENTS`
--

INSERT INTO `EVENTS` (`ID`, `NOM`, `CREATION`, `PAR`, `DESCRIPTION`, `DATE_IN`, `DATE_OUT`, `OPT_ACCUEIL`, `OPT_ACTUALITES`, `OPT_PROGRAMME`, `OPT_HEBERGEMENT`, `OPT_INFOSPRATIQUES`, `OPT_PRESSE`, `OPT_CONTACT`, `OPT_INSCRIPTION`, `OPT_ACTIVITES`, `OPT_HEBERGEMENT2`, `OPT_TRANSPORT`) VALUES
(1, 'Thélios Spring Convention 2021', '03/10/2019 - 18h48', '2', '', '', '', 1, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `HOTELS`
--

CREATE TABLE `HOTELS` (
  `ID` int(11) NOT NULL,
  `EVENT_ID` int(11) NOT NULL,
  `NOM` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ADRESSE1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ADRESSE2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `CP` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `VILLE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TEL` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `STOCK_SGL` int(11) NOT NULL DEFAULT 0,
  `STOCK_DBL` int(11) NOT NULL DEFAULT 0,
  `STOCK_TWIN` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `HOTELS`
--

INSERT INTO `HOTELS` (`ID`, `EVENT_ID`, `NOM`, `ADRESSE1`, `ADRESSE2`, `CP`, `VILLE`, `TEL`, `STOCK_SGL`, `STOCK_DBL`, `STOCK_TWIN`) VALUES
(37, 85, 'Novotel', '4 boulevard Félix Faure', '', '92100', 'Boulogne-Billancourt', '0185740000', 20, 20, 30),
(53, 85, 'Pullman', '131 bis rue de Billancourt', 'RDC', '92100', 'Boulogne-Billancourt', '0185740092', 50, 10, 10),
(54, 85, 'Novotel - Copie', '4 boulevard Félix Faure', '', '92100', 'Boulogne-Billancourt', '0185740000', 20, 20, 20),
(55, 85, 'Novotel - Copie', '4 boulevard Félix Faure', '', '92100', 'Boulogne-Billancourt', '0185740000', 20, 20, 30);

-- --------------------------------------------------------

--
-- Table structure for table `PROFILS`
--

CREATE TABLE `PROFILS` (
  `ID` int(11) NOT NULL,
  `EVENT_ID` int(11) NOT NULL,
  `MATRICULE` int(11) NOT NULL,
  `PASSWORD` text COLLATE utf8_unicode_ci NOT NULL,
  `PARTICIPATION` tinyint(1) NOT NULL,
  `ISVALID` tinyint(1) NOT NULL,
  `ISPRIVILEGIE` tinyint(1) NOT NULL,
  `CIVILITE` text COLLATE utf8_unicode_ci NOT NULL,
  `NOM` text COLLATE utf8_unicode_ci NOT NULL,
  `PRENOM` text COLLATE utf8_unicode_ci NOT NULL,
  `FONCTION` text COLLATE utf8_unicode_ci NOT NULL,
  `SOCIETE_ID` int(11) NOT NULL,
  `TYPE_SOC` text COLLATE utf8_unicode_ci NOT NULL,
  `SECTEUR` text COLLATE utf8_unicode_ci NOT NULL,
  `NUM_TVA` text COLLATE utf8_unicode_ci NOT NULL,
  `CA` int(11) NOT NULL,
  `A_PAYER` int(11) NOT NULL,
  `CGV` tinyint(1) NOT NULL,
  `REF_COURRIER` text COLLATE utf8_unicode_ci NOT NULL,
  `ADRESSE` text COLLATE utf8_unicode_ci NOT NULL,
  `ADRESSE2` text COLLATE utf8_unicode_ci NOT NULL,
  `CP` text CHARACTER SET latin1 NOT NULL,
  `VILLE` text CHARACTER SET latin1 NOT NULL,
  `PAYS` text COLLATE utf8_unicode_ci NOT NULL,
  `TEL` text CHARACTER SET latin1 NOT NULL,
  `EMAIL` varchar(255) CHARACTER SET latin1 NOT NULL,
  `MOBILE` varchar(255) CHARACTER SET latin1 NOT NULL,
  `REMARQUES` varchar(255) CHARACTER SET latin1 NOT NULL,
  `ENREGISTREMENT` text COLLATE utf8_unicode_ci NOT NULL,
  `CONNEXION` text COLLATE utf8_unicode_ci NOT NULL,
  `DROIT` int(11) NOT NULL DEFAULT 0,
  `DATE_IN` date NOT NULL,
  `DATE_OUT` date NOT NULL,
  `HOTEL_ID` int(11) NOT NULL,
  `TRANSPORT_ALLER1_ID` int(11) DEFAULT NULL,
  `TRANSPORT_ALLER2_ID` int(11) NOT NULL,
  `TRANSPORT_RETOUR_1_ID` int(11) NOT NULL,
  `TRANSPORT_RETOUR_2_ID` int(11) NOT NULL,
  `DEJEUNER` text COLLATE utf8_unicode_ci NOT NULL,
  `DINER` text COLLATE utf8_unicode_ci NOT NULL,
  `ATELIER1_ID` int(11) NOT NULL,
  `ATELIER2_ID` int(11) NOT NULL,
  `ATELIER3_ID` int(11) NOT NULL,
  `ATELIER4_ID` int(11) NOT NULL,
  `ATELIER5_ID` int(11) NOT NULL,
  `DAY1` tinyint(1) DEFAULT 0,
  `DAY2` tinyint(1) DEFAULT 0,
  `NIGHT1` tinyint(1) DEFAULT 0,
  `NIGHT2` tinyint(1) DEFAULT 0,
  `NB_TICKETS` tinyint(1) DEFAULT 0,
  `CADEAU` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `PROFILS`
--

INSERT INTO `PROFILS` (`ID`, `EVENT_ID`, `MATRICULE`, `PASSWORD`, `PARTICIPATION`, `ISVALID`, `ISPRIVILEGIE`, `CIVILITE`, `NOM`, `PRENOM`, `FONCTION`, `SOCIETE_ID`, `TYPE_SOC`, `SECTEUR`, `NUM_TVA`, `CA`, `A_PAYER`, `CGV`, `REF_COURRIER`, `ADRESSE`, `ADRESSE2`, `CP`, `VILLE`, `PAYS`, `TEL`, `EMAIL`, `MOBILE`, `REMARQUES`, `ENREGISTREMENT`, `CONNEXION`, `DROIT`, `DATE_IN`, `DATE_OUT`, `HOTEL_ID`, `TRANSPORT_ALLER1_ID`, `TRANSPORT_ALLER2_ID`, `TRANSPORT_RETOUR_1_ID`, `TRANSPORT_RETOUR_2_ID`, `DEJEUNER`, `DINER`, `ATELIER1_ID`, `ATELIER2_ID`, `ATELIER3_ID`, `ATELIER4_ID`, `ATELIER5_ID`, `DAY1`, `DAY2`, `NIGHT1`, `NIGHT2`, `NB_TICKETS`, `CADEAU`) VALUES
(1005, 1, 0, 'admin1', 0, 0, 0, 'M.', 'DUPONT', 'Jean', '', 0, '', '', '', 0, 0, 0, '', '', '', '', '', '', '', 'a.kerros@arep.co.com', '', '', '06-09-2019 09:39', '11-09-2019 10:46', 1, '0000-00-00', '0000-00-00', 0, NULL, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1017, 2, 0, 'admin2', 0, 0, 0, 'M.', 'DUPONT', 'Jean', '', 0, '', '', '', 0, 0, 0, '', '', '', '', '', '', '', 'a.kerros@arep.co.com', '', '', '06-09-2019 09:39', '31-07-2019 18:24', 1, '0000-00-00', '0000-00-00', 0, NULL, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1018, 3, 0, 'admin3', 0, 0, 0, 'M.', 'DUPONT', 'Jean', '', 0, '', '', '', 0, 0, 0, '', '', '', '', '', '', '', 'a.kerros@arep.co.com', '', '', '06-09-2019 09:39', '31-07-2019 18:24', 1, '0000-00-00', '0000-00-00', 0, NULL, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1158, 29, 0, 'client1', 1, 1, 0, 'Mme', 'sudaka', 'Mélanie', 'Dir. Gén. Adjoint', 0, 'Adhérent', 'Electrique', '', 0, 0, 0, '', '131 bis rue de Billancourt', '1er étage', '92100', 'Bouogne Billancourt', '', '0185740090', 'f.sudaka@arep.co.com', '0645327844', '', '06-09-2019 09:39', '16-09-2019 14:19', 0, '0000-00-00', '0000-00-00', 0, 4, 0, 0, 1, 'oui', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1159, 29, 0, 'client2', 1, 1, 1, 'M.', 'DUPONT', 'Jean', '', 0, 'Fournisseur', '', '', 0, 0, 0, '', '', '', '', '', '', '', 'a.kerros@arep.co.com', '', '', '06-09-2019 09:39', '31-07-2019 18:24', 0, '0000-00-00', '0000-00-00', 0, NULL, 0, 0, 0, '', 'oui', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1160, 29, 0, 'client3', 0, 0, 0, 'M.', 'DUPONT', 'Jean', '', 0, 'Fournisseur', '', '', 0, 0, 0, '', '', '', '', '', '', '', 'a.kerros@arep.co.com', '', '', '06-09-2019 09:39', '31-07-2019 18:24', 0, '0000-00-00', '0000-00-00', 0, NULL, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1161, 29, 0, 'client11', 0, 0, 0, 'M.', 'sudaka', 'fabrice', '', 0, 'Fournisseur', '', '', 0, 0, 0, '', '', '', '', '', '', '', 'f.sudaka@arep.co.Com', '0645327844', '', '06-09-2019 09:39', '07-09-2019 10:41', 0, '0000-00-00', '0000-00-00', 5, 6, 0, 0, 1, 'oui', 'oui', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1162, 1, 0, 'client12', 0, 0, 0, 'M.', 'sudaka', 'fabrice', '', 1, '', '', '', 0, 0, 0, '', '', '', '', '', '', '', 'f.sudaka@arep.co.Com', '0645327844', '', '06-09-2019 09:39', '07-09-2019 10:41', 0, '0000-00-00', '0000-00-00', 10, 5, 0, 0, 0, 'oui', 'oui', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1163, 1, 0, 'client15', 0, 0, 0, 'M.', 'sudaka', 'fabrice', '', 0, '', '', '', 0, 0, 0, '', '', '', '', '', '', '', 'f.sudaka@arep.co.Com', '0645327844', '', '06-09-2019 09:39', '07-09-2019 10:41', 0, '0000-00-00', '0000-00-00', 0, NULL, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1164, 0, 0, '', 0, 0, 0, '', 'dsfsdfsd', '', '', 0, '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '0000-00-00', 0, NULL, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1166, 29, 0, '', 1, 1, 0, '', 'SUDAKA', 'Fabrice', '', 0, 'Adhérent', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '0000-00-00', 0, NULL, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1168, 29, 0, '', 0, 0, 0, '', 'zdzz', '', '', 0, 'Adhérent', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '0000-00-00', 0, NULL, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1169, 29, 0, '', 0, 0, 0, '', 'dsfsdf', '', '', 0, 'Adhérent', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '0000-00-00', 0, NULL, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1171, 0, 0, '', 0, 0, 0, '', 'qqqqq', '', '', 0, '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '0000-00-00', 0, NULL, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1172, 0, 0, '', 1, 0, 0, '', 'qqqqq', '', '', 0, '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '0000-00-00', 0, NULL, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1173, 0, 0, '', 0, 0, 0, '', 'qsdqsds', '', '', 0, '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '0000-00-00', 0, NULL, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1175, 29, 0, '', 1, 0, 0, '', 'adout', 'Jean pierre', 'dg', 0, 'Adhérent', '', '', 0, 0, 0, '', 'fdfsddf', 'ghjhgjfhg', 'kjljkljk', 'jkljkhl', '', 'uuuuuu', 'jkljkljkh', 'jkljkhljhk', 'aaaaaabbbbb', '', '', 0, '0000-00-00', '2019-09-22', 0, NULL, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1176, 29, 0, '', 0, 0, 0, '', 'adout2', '', '', 0, 'Partenaire', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '0000-00-00', 0, NULL, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1179, 0, 0, '', 0, 0, 0, '', 'fdzezef', '', '', 0, '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '0000-00-00', 0, NULL, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1181, 0, 0, '', 0, 0, 0, '', 'zefzezef', '', '', 0, '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '0000-00-00', 0, NULL, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1182, 0, 0, '', 0, 0, 0, '', 'zefzezef', '', '', 0, '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '0000-00-00', 0, NULL, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ROOM`
--

CREATE TABLE `ROOM` (
  `ID` int(11) NOT NULL,
  `EVENT_ID` int(11) NOT NULL,
  `HOTELS_ID` int(11) NOT NULL,
  `ROOM_TYPE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ROOM`
--

INSERT INTO `ROOM` (`ID`, `EVENT_ID`, `HOTELS_ID`, `ROOM_TYPE`) VALUES
(13, 85, 37, 'Single'),
(14, 85, 37, 'Double'),
(15, 85, 37, 'Twin'),
(53, 85, 53, 'Single'),
(54, 85, 53, 'Double'),
(55, 85, 53, 'Twin'),
(56, 85, 54, 'Single'),
(57, 85, 54, 'Double'),
(58, 85, 54, 'Twin'),
(59, 85, 54, 'Single'),
(60, 85, 54, 'Double'),
(61, 85, 54, 'Twin');

-- --------------------------------------------------------

--
-- Table structure for table `SITE_ACCUEIL`
--

CREATE TABLE `SITE_ACCUEIL` (
  `ID` int(11) NOT NULL,
  `EVENT_ID` int(11) NOT NULL,
  `PIC_ACCUEIL` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_ACCUEIL_ST` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_ACCUEIL_T_EDITO` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_ACCUEIL_EDITO` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NB_BLOCS` int(11) NOT NULL,
  `NB_SLIDES` int(11) NOT NULL,
  `TITRE_BLOCS` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_8` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_8` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_8` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_9` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_9` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_9` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SLIDER_1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SLIDER_2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SLIDER_3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SLIDER_4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SLIDER_5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SLIDER_6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SITE_ACCUEIL`
--

INSERT INTO `SITE_ACCUEIL` (`ID`, `EVENT_ID`, `PIC_ACCUEIL`, `TXT_ACCUEIL_ST`, `TXT_ACCUEIL_T_EDITO`, `TXT_ACCUEIL_EDITO`, `NB_BLOCS`, `NB_SLIDES`, `TITRE_BLOCS`, `TITRE_1`, `PIC_1`, `TXT_1`, `TITRE_2`, `PIC_2`, `TXT_2`, `TITRE_3`, `PIC_3`, `TXT_3`, `TITRE_4`, `PIC_4`, `TXT_4`, `TITRE_5`, `PIC_5`, `TXT_5`, `TITRE_6`, `PIC_6`, `TXT_6`, `TITRE_7`, `PIC_7`, `TXT_7`, `TITRE_8`, `PIC_8`, `TXT_8`, `TITRE_9`, `PIC_9`, `TXT_9`, `SLIDER_1`, `SLIDER_2`, `SLIDER_3`, `SLIDER_4`, `SLIDER_5`, `SLIDER_6`) VALUES
(4, 1, 'banner-accueil.jpg', 'Les 03 et 04 septembre 2021', '', '<p style=\"text-align: center; \">Chère Participante, Cher Participant,&nbsp;</p><p style=\"text-align: center; \">Bienvenue sur le site d\'inscription à la Convention Nationale Alliance Healthcare France qui aura lieu au Business Village les 03 et 04 septembre 2021.</p><p style=\"text-align: center; \">Vous trouverez sur ce site les informations pratiques, le programme et le formulaire d’inscription à renseigner avant le vendredi 13 août.</p><p style=\"text-align: center; \">Pour toutes questions, n\'hésitez pas à nous contacter via la page Contact.</p><p style=\"text-align: center; \">L\'équipe organisatrice</p>\r\n\r\n<p style=\"text-align: center;\"><br><a href=\"profil.php\" style=\"background-color: #159a43; color: #fff; text-decoration: none; padding: 25px 50px; border-radius: 30px;\">INSCRIPTION</a></p>', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `SITE_ACTUS`
--

CREATE TABLE `SITE_ACTUS` (
  `ID` int(11) NOT NULL,
  `EVENT_ID` int(11) NOT NULL,
  `PIC_ACTUALITE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_ACTUALITE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_ACTUALITE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NB_ACTUS` int(11) NOT NULL,
  `TITRE_1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_8` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_8` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_8` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_9` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_9` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_9` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SITE_ACTUS`
--

INSERT INTO `SITE_ACTUS` (`ID`, `EVENT_ID`, `PIC_ACTUALITE`, `TXT_ACTUALITE`, `TITRE_ACTUALITE`, `NB_ACTUS`, `TITRE_1`, `PIC_1`, `TXT_1`, `TITRE_2`, `PIC_2`, `TXT_2`, `TITRE_3`, `PIC_3`, `TXT_3`, `TITRE_4`, `PIC_4`, `TXT_4`, `TITRE_5`, `PIC_5`, `TXT_5`, `TITRE_6`, `PIC_6`, `TXT_6`, `TITRE_7`, `PIC_7`, `TXT_7`, `TITRE_8`, `PIC_8`, `TXT_8`, `TITRE_9`, `PIC_9`, `TXT_9`) VALUES
(4, 1, 'BANNER_5dbaa79a7ac96.jpg', '', '', 3, 'INSCRIPTIONS OUVERTES', 'PIC$_5dc3155aae156.jpg', '<p>Inscriptions ouvertes dès aujourd’hui pour l’ensemble des <b>200 Distributeurs membres de Continental</b> à cette <b>12ème Convention Continental</b>.<br>La Convention Continental vous offre, professionnels que vous êtes, l’occasion de réaliser de fructueux contacts pour vos entreprises pour développer ainsi votre Business.<br>48H d\'échanges et de Business pour ainsi créer de nouvelles relations et développer de riches opportunités commerciales.<br>Nous donnons rendez-vous à nos partenaires Fournisseurs à compter du <b>18 novembre</b> pour pouvoir à leur tour s’inscrire à la Convention Continental 2020.<br>L’édition des badges et la prise de rendez-vous aura le à partir du 20 janvier 2020 ; le temps que tout le monde soit bien inscrit.</p>', 'NOUVEAUTES', 'PIC$_5dc3155ac2063.jpg', '<p><span style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" arial,=\"\" helvetica,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;\"=\"\">Pour cette nouvelle édition, Continental mettra à l’honneur les engagements et les actions de ses partenaires Fournisseurs <b>en matière de digital, de RSE et bien entendu d’innovation</b> en leurs décernant un Trophées.</span><br><span style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" arial,=\"\" helvetica,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;\"=\"\">Les <b>Trophées Continental</b> permettront aux initiatives jugées les plus en phase avec les attentes du marché d’être soutenues et valorisées au sein du Réseau.</span><br><span style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" arial,=\"\" helvetica,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;\"=\"\">Cette sélection sera réalisée en collaboration avec l’ensemble de nos Distributeurs pour une meilleure perception des avantages et performances. </span><br><span style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" arial,=\"\" helvetica,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;\"=\"\">Partenaires Fournisseurs, ne manquez pas cette occasion de valoriser vos engagements !</span><br><span style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" arial,=\"\" helvetica,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;\"=\"\">La remise des Trophées se déroulera lors de la soirée de gala, le <b>20 décembre 2019</b>.</span><br></p>', '48H D’ECHANGES', 'PIC$_5dc3155aca33b.jpg', '<p><span style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" arial,=\"\" helvetica,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" text-align:=\"\" justify;\"=\"\">Pour cette 12ème édition, Continental vous propose de rester connectés à votre Business.<br>Plus que jamais Continental entend profiter de cet événement pour <b>favoriser les échanges</b> et accélérer le développement commercial et ainsi créer de nombreuses opportunités.</span><br style=\"text-align: justify;\">Les 200 Adhérents de Continental seront présents à Villepinte pour rencontrer les Fournisseurs participants et signer de nombreuses commandes. Ces rencontres et ces temps d’échanges doivent servir le Business. Un rendez-vous incontournable à ne pas rater !!!</p>', 'LA QUINZAINE : L’OPERATION BUSINESS', '', '<p><span style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" arial,=\"\" helvetica,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" text-align:=\"\" justify;\"=\"\">Des offres exclusivement axées sur des <b>REMISES SUPPLEMENTAIRES</b> aux conditions habituelles des Adhérents.</span><br style=\"text-align: justify;\"><span style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" arial,=\"\" helvetica,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" text-align:=\"\" justify;\"=\"\">Elles seront présentées par marque et seront diffusées en version digitale par vagues en fonction des retours dès la </span><span style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: bold; font-size: 16px; font-family: \" source=\"\" sans=\"\" pro\",=\"\" arial,=\"\" helvetica,=\"\" sans-serif;=\"\" text-align:=\"\" justify;\"=\"\">1ère quinzaine</span><span style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" arial,=\"\" helvetica,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" text-align:=\"\" justify;\"=\"\"> de février aux Adhérents et les offres seront valables du </span><span style=\"font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-size: 16px;\" source=\"\" sans=\"\" pro\",=\"\" arial,=\"\" helvetica,=\"\" sans-serif;=\"\" text-align:=\"\" justify;=\"\" color:=\"\" rgb(51,=\"\" 58,=\"\" 133);\"=\"\"><b>09 au 20 Mars</b></span><span style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" arial,=\"\" helvetica,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" text-align:=\"\" justify;\"=\"\"><b> 2019</b>.</span><br style=\"text-align: justify;\"><span style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" arial,=\"\" helvetica,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;\"=\"\">La notion de Réseau prend alors ici tout son sens, car l’émulation collective autour de ces offres sera un gage de réussite de l’événement.</span></p>', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `SITE_CONTACT`
--

CREATE TABLE `SITE_CONTACT` (
  `ID` int(11) NOT NULL,
  `EVENT_ID` int(11) NOT NULL,
  `PIC_CONTACT` text NOT NULL,
  `TXT_CONTACT_ST` text NOT NULL,
  `MAIL_CONTACT` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SITE_CONTACT`
--

INSERT INTO `SITE_CONTACT` (`ID`, `EVENT_ID`, `PIC_CONTACT`, `TXT_CONTACT_ST`, `MAIL_CONTACT`) VALUES
(3, 1, 'banner-contact.jpg', 'Utilisez le formulaire ci-dessous pour nous contacter', 'e.arminio@arep.co.com');

-- --------------------------------------------------------

--
-- Table structure for table `SITE_HEBERGEMENT`
--

CREATE TABLE `SITE_HEBERGEMENT` (
  `ID` int(11) NOT NULL,
  `EVENT_ID` int(11) NOT NULL,
  `PIC_HEBERGEMENT` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_HEBERGEMENT_ST` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NB_HEBERGEMENT` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_HEBERGEMENT_H1_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_HEBERGEMENT_H1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC1_HEBERGEMENT_H1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC2_HEBERGEMENT_H1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC3_HEBERGEMENT_H1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `MAP_HEBERGEMENT_H1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_HEBERGEMENT_H2_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_HEBERGEMENT_H2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC1_HEBERGEMENT_H2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC2_HEBERGEMENT_H2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC3_HEBERGEMENT_H2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `MAP_HEBERGEMENT_H2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_HEBERGEMENT_H3_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_HEBERGEMENT_H3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC1_HEBERGEMENT_H3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC2_HEBERGEMENT_H3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC3_HEBERGEMENT_H3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `MAP_HEBERGEMENT_H3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SITE_HEBERGEMENT`
--

INSERT INTO `SITE_HEBERGEMENT` (`ID`, `EVENT_ID`, `PIC_HEBERGEMENT`, `TXT_HEBERGEMENT_ST`, `NB_HEBERGEMENT`, `TXT_HEBERGEMENT_H1_TITRE`, `TXT_HEBERGEMENT_H1`, `PIC1_HEBERGEMENT_H1`, `PIC2_HEBERGEMENT_H1`, `PIC3_HEBERGEMENT_H1`, `MAP_HEBERGEMENT_H1`, `TXT_HEBERGEMENT_H2_TITRE`, `TXT_HEBERGEMENT_H2`, `PIC1_HEBERGEMENT_H2`, `PIC2_HEBERGEMENT_H2`, `PIC3_HEBERGEMENT_H2`, `MAP_HEBERGEMENT_H2`, `TXT_HEBERGEMENT_H3_TITRE`, `TXT_HEBERGEMENT_H3`, `PIC1_HEBERGEMENT_H3`, `PIC2_HEBERGEMENT_H3`, `PIC3_HEBERGEMENT_H3`, `MAP_HEBERGEMENT_H3`) VALUES
(31, 1, 'BANNER_5dbaa79a7ac96.jpg', '<b>Salons Hoche</b>', '1', 'L’ Histoire Salons Hoche', '<div align=\"left\">Au début du XXème siècle, en pleines \"années folles\", le 9 Avenue Hoche n\'était autre qu\'un dancing où l\'on vint guincher.<br>Depuis, les alentours des Champs Elysées et plus particulièrement les larges avenues dédiées aux gloires du Ier Empire furent investies par les sièges sociaux de prestigieuses entreprises. <br> <br>Pierre Beteille, propriétaire des lieux s\'associa à un jeune musicien du nom d\'Eddy Barclay. Ensemble, ils fondèrent la maison de disque Barclay. Ces studios d\'enregistrement virent défiler de nombreuses célébrités, d\'Aznavour à Piaf, en passant par Dalida et bien d\'autres.<br> <br>Par la suite, ils cédèrent les lieux à leur fidèle ami Albert Allon Oullo qui transforma ces espaces en de prestigieux salons de réception, respectant la vocation du quartier.<br> <br>Les Salons Hoche sont désormais un lieu de référence dans l\'organisation d\'événements.</div><div align=\"left\"><br></div><div align=\"left\"><span style=\"color: rgb(156, 156, 148);\">In the early 20th century, during the « Roaring Twenties », the 9 Avenue Hoche was the place to come and dance.<br> <br>Later\r\n on, the surroundings of the Champs Elysées and especially the 1st \r\nEmpire avenues were soon taken over by the headquarters of prestigious \r\ncompanies.<br> <br>Owner of the building Pierre Beteille, together with a\r\n young Eddy Barclay, founded what then became the renowned Barclay \r\nrecord company, producing celebrities and singers such as Aznavour, \r\nPiaf, Dalida and Brel.<br> <br>After a long and successful \r\ncollaboration, they signed over the building to their mutual friend \r\nAlbert Allon Oullo. The young artist transformed this space into the \r\ngreat reception halls as they are found today.<br> <br>Over the years, \r\nLes Salons Hoche gained a strong reputation and are now considered as \r\none of the reference establishments in the parisian events organization \r\nscene.</span></div><br>', 'hebergement-1-1.jpg', 'hebergement-1-2.jpg', '', '9 avenue Hoche, 75008 Paris', 'Our story', '<div align=\"left\">In the early 20th century, during the « Roaring Twenties », the 9 Avenue Hoche was the place to come and dance.<br> <br>Later on, the surroundings of the Champs Elysées and especially the 1st Empire avenues were soon taken over by the headquarters of prestigious companies.<br> <br>Owner of the building Pierre Beteille, together with a young Eddy Barclay, founded what then became the renowned Barclay record company, producing celebrities and singers such as Aznavour, Piaf, Dalida and Brel.<br> <br>After a long and successful collaboration, they signed over the building to their mutual friend Albert Allon Oullo. The young artist transformed this space into the great reception halls as they are found today.<br> <br>Over the years, Les Salons Hoche gained a strong reputation and are now considered as one of the reference establishments in the parisian events organization scene.<br></div><br>', 'hebergement-2-1.jpg', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `SITE_INFOS_PRAT`
--

CREATE TABLE `SITE_INFOS_PRAT` (
  `ID` int(11) NOT NULL,
  `EVENT_ID` int(11) NOT NULL,
  `PIC_INFOS` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_ST` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NB_INFOS` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_P1_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ICO_INFOS_P1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_P1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_P2_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ICO_INFOS_P2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_P2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_P3_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ICO_INFOS_P3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_P3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_P4_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ICO_INFOS_P4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_P4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_P5_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ICO_INFOS_P5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_P5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_P6_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ICO_INFOS_P6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_INFOS_P6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_CONTACT` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_CONTACT_ST` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SITE_INFOS_PRAT`
--

INSERT INTO `SITE_INFOS_PRAT` (`ID`, `EVENT_ID`, `PIC_INFOS`, `TXT_INFOS_ST`, `NB_INFOS`, `TXT_INFOS_P1_TITRE`, `ICO_INFOS_P1`, `TXT_INFOS_P1`, `TXT_INFOS_P2_TITRE`, `ICO_INFOS_P2`, `TXT_INFOS_P2`, `TXT_INFOS_P3_TITRE`, `ICO_INFOS_P3`, `TXT_INFOS_P3`, `TXT_INFOS_P4_TITRE`, `ICO_INFOS_P4`, `TXT_INFOS_P4`, `TXT_INFOS_P5_TITRE`, `ICO_INFOS_P5`, `TXT_INFOS_P5`, `TXT_INFOS_P6_TITRE`, `ICO_INFOS_P6`, `TXT_INFOS_P6`, `PIC_CONTACT`, `TXT_CONTACT_ST`) VALUES
(3, 1, 'banner-infos-pratiques.jpg', '', '4', 'ADRESSE', 'map-marker-alt', '<p style=\"text-align: left;\">Business Village<br><span style=\"text-align: center;\">30 Rue de Montaiguillon<br></span><span style=\"text-align: center;\">77560 LOUAN-VILLEGRUIS-FONTAINE</span></p><p style=\"text-align: left;\"><b>Attention :</b> le nombre de places de parking sur site étant limité, il est préférable de maximiser le covoiturage.</p><p style=\"text-align: left;\"><span style=\"text-align: center;\"></span></p><p style=\"text-align: left;\">Merci de vous organiser avec vos collègues.</p>\r\n<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15024.872917822577!2d3.479307200965363!3d48.630150415167634!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47ef2af6d817f393%3A0xca1865f2530202cf!2s30%20Rue%20de%20Montaiguillon%2C%2077560%20Louan-Villegruis-Fontaine!5e0!3m2!1sfr!2sfr!4v1582538109699!5m2!1sfr!2sfr\" width=\"100%\" height=\"350\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\"></iframe>', 'COMMENT VOUS RENDRE AU BUSINESS VILLAGE ?', 'bus', '<p class=\"MsoNormal\" style=\"text-align: center; margin: 0cm 0cm 0.0001pt; font-size: medium; font-family: Cambria, serif; font-style: normal; font-variant-caps: normal;\"><span style=\"font-size: 18.66666603088379px; font-style: normal; font-variant-caps: normal; text-align: left;\"><b>Des bus seront mis en place au départ des gares et aéroports parisiens pour rejoindre le Business Village</b> </span></p><p class=\"MsoNormal\" style=\"text-align: center; margin: 0cm 0cm 0.0001pt;\"><span style=\"text-align: left;\">(sous réserve d\'un nombre minimum d\'inscrits)</span><br></p><p class=\"MsoNormal\" style=\"text-align: left; margin: 0cm 0cm 0.0001pt;\"> </p><ul><li style=\"text-align: left; margin: 0cm 0cm 0.0001pt;\">Gare de Marne la Vallée – Chessy : <strong><em>gare à privilégier si cela est possible</em></strong></li><li style=\"text-align: left; margin: 0cm 0cm 0.0001pt;\">Aéroport de Paris Roissy CDG</li><li style=\"text-align: left; margin: 0cm 0cm 0.0001pt;\">Aéroport de Paris Orly</li><li style=\"text-align: left; margin: 0cm 0cm 0.0001pt;\">Gare de Paris Montparnasse</li><li style=\"text-align: left; margin: 0cm 0cm 0.0001pt;\">Gare de l\'Est</li><li style=\"text-align: left; margin: 0cm 0cm 0.0001pt;\">Gare du Nord</li><li style=\"text-align: left; margin: 0cm 0cm 0.0001pt;\">Gare de Lyon</li></ul><p class=\"MsoNormal\" style=\"margin: 0cm 0cm 0.0001pt; font-size: medium; font-family: Cambria, serif; font-style: normal; font-variant-caps: normal; text-align: start;\"><o:p></o:p></p>', 'VOTRE VALISE', 'suitcase', '<p style=\"text-align: left; \">Tenue correcte exigée pour la journée de réunions du vendredi</p><p style=\"text-align: left; \">\r\nTenue pour la soirée du vendredi : votre plus beau haut blanc avec un blue jean !</p><p style=\"text-align: left; \">\r\nPrévoir des chaussures confortables</p><p style=\"text-align: left; \">\r\nMaillot de bain et serviette (une piscine est accessible de 14h à 20h)</p>', 'VOTRE TRANSPORT VERS PARIS', 'plane', '<p>Nous vous conseillons d’arriver en gare ou aéroport de Paris avant 9h00 le Vendredi 3 Septembre 2021 <strong><em>et de privilégier une arrivée à la gare de Marne la Vallée Chessy si cela est possible.</em></strong></p><p>Pour votre retour, vous devez prendre vos billets après 16h30.</p>', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `SITE_INSCRIPTION`
--

CREATE TABLE `SITE_INSCRIPTION` (
  `ID` int(11) NOT NULL,
  `EVENT_ID` int(11) NOT NULL,
  `BANNIERE` text NOT NULL,
  `SOUS_TITRE` text NOT NULL,
  `CIVILITE` int(11) NOT NULL DEFAULT 0,
  `NOM` int(11) NOT NULL DEFAULT 0,
  `PRENOM` int(11) NOT NULL DEFAULT 0,
  `EMAIL` int(11) NOT NULL DEFAULT 0,
  `MOBILE` int(11) NOT NULL DEFAULT 0,
  `SOCIETE` int(11) NOT NULL DEFAULT 0,
  `FONCTION` int(11) NOT NULL DEFAULT 0,
  `ADRESSE` int(11) NOT NULL DEFAULT 0,
  `CODE_POSTAL` int(11) NOT NULL DEFAULT 0,
  `VILLE` int(11) NOT NULL DEFAULT 0,
  `COMMENTAIRES` int(11) NOT NULL DEFAULT 0,
  `HEBERGEMENT` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SITE_PRESSE`
--

CREATE TABLE `SITE_PRESSE` (
  `ID` int(11) NOT NULL,
  `EVENT_ID` int(11) NOT NULL,
  `PIC_PRESSE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PRESSE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_PRESSE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NB_PRESSE` int(11) NOT NULL,
  `TITRE_1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_8` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_8` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TITRE_9` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_9` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SITE_PRESSE`
--

INSERT INTO `SITE_PRESSE` (`ID`, `EVENT_ID`, `PIC_PRESSE`, `TXT_PRESSE`, `TITRE_PRESSE`, `NB_PRESSE`, `TITRE_1`, `PIC_1`, `TITRE_2`, `PIC_2`, `TITRE_3`, `PIC_3`, `TITRE_4`, `PIC_4`, `TITRE_5`, `PIC_5`, `TITRE_6`, `PIC_6`, `TITRE_7`, `PIC_7`, `TITRE_8`, `PIC_8`, `TITRE_9`, `PIC_9`) VALUES
(2, 1, 'BANNER_5dbaa79a7ac96.jpg        ', 'Vous trouverez dans cette rubrique les communiqués de presse', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `SITE_PROGRAMME`
--

CREATE TABLE `SITE_PROGRAMME` (
  `ID` int(11) NOT NULL,
  `EVENT_ID` int(11) NOT NULL,
  `PIC_PROGRAMME` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_ST` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NB_PROGRAMME` int(11) NOT NULL DEFAULT 0,
  `TXT_PROGRAMME_J1_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_PROGRAMME_J1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J2_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_PROGRAMME_J2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J3_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_PROGRAMME_J3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J4_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_PROGRAMME_J4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J5_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_PROGRAMME_J5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J6_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_PROGRAMME_J6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J7_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_PROGRAMME_J7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J8_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J8` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_PROGRAMME_J8` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J9_TITRE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TXT_PROGRAMME_J9` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PIC_PROGRAMME_J9` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SITE_PROGRAMME`
--

INSERT INTO `SITE_PROGRAMME` (`ID`, `EVENT_ID`, `PIC_PROGRAMME`, `TXT_PROGRAMME_ST`, `NB_PROGRAMME`, `TXT_PROGRAMME_J1_TITRE`, `TXT_PROGRAMME_J1`, `PIC_PROGRAMME_J1`, `TXT_PROGRAMME_J2_TITRE`, `TXT_PROGRAMME_J2`, `PIC_PROGRAMME_J2`, `TXT_PROGRAMME_J3_TITRE`, `TXT_PROGRAMME_J3`, `PIC_PROGRAMME_J3`, `TXT_PROGRAMME_J4_TITRE`, `TXT_PROGRAMME_J4`, `PIC_PROGRAMME_J4`, `TXT_PROGRAMME_J5_TITRE`, `PIC_PROGRAMME_J5`, `TXT_PROGRAMME_J5`, `TXT_PROGRAMME_J6`, `TXT_PROGRAMME_J6_TITRE`, `PIC_PROGRAMME_J6`, `TXT_PROGRAMME_J7_TITRE`, `TXT_PROGRAMME_J7`, `PIC_PROGRAMME_J7`, `TXT_PROGRAMME_J8_TITRE`, `TXT_PROGRAMME_J8`, `PIC_PROGRAMME_J8`, `TXT_PROGRAMME_J9_TITRE`, `TXT_PROGRAMME_J9`, `PIC_PROGRAMME_J9`) VALUES
(3, 1, 'banner-programme.jpg', '', 2, '<h2 style=\"text-align: center;\"> VENDREDI 3 SEPTEMBRE </h2>', '<p style=\"text-align:center;\">11h00 - Plénière d’ouverture<br><br>\r\nPause déjeuner<br><br>\r\nVillage Partenaires & Ateliers en équipe<br><br>\r\n19h00 - Installation dans vos cottages et temps libre<br><br>\r\n20h00 - Apéritif & Soirée<br><strong><em>Tenue pour votre soirée : Blue Jean & Haut blanc</em></strong></p>', 'programme-1.jpg', '<h2 style=\"text-align: center;\">SAMEDI 4 SEPTEMBRE</h2>', '<p style=\"text-align:center;\">8h30 - Ateliers\r\nDéjeuner buffet<br><br>\r\n15h00 - Fin de la Convention<br><br>\r\nTransferts vers les gares et aéroports parisiens.<br><br>\r\n<strong><em>Nous vous conseillons de prendre vos transports retours après 16h30 au départ de Paris</em></strong></p>', 'programme-2.jpg', '', '<br>', '', 'Jeudi 19 décembre', '<p><span style=\"background-color: inherit;\">Duis aute irure dolor in reprehenderit in voluptate \r\nvelit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint \r\noccaecat cupidatat non proident, sunt in culpa qui officia deserunt \r\nmollit anim id est laborum.</span></p>', '', 'Vendredi 20 décembre', '', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem \r\naccusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab\r\n illo inventore veritatis et quasi architecto beatae vitae dicta sunt \r\nexplicabo. <span style=\"background-color: inherit;\"><font color=\"#000000\"><br></font></span></p>', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `SOCIETE`
--

CREATE TABLE `SOCIETE` (
  `ID` int(11) NOT NULL,
  `NOM` varchar(255) NOT NULL,
  `ADRESSE1` varchar(255) DEFAULT NULL,
  `ADRESSE2` varchar(255) DEFAULT NULL,
  `ADRESSE3` varchar(255) DEFAULT NULL,
  `CP` varchar(255) DEFAULT NULL,
  `VILLE` varchar(255) DEFAULT NULL,
  `PAYS` varchar(255) DEFAULT NULL,
  `TEL` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `TVA` varchar(255) DEFAULT NULL,
  `CA` varchar(255) DEFAULT NULL,
  `A_PAYE` int(11) DEFAULT 0,
  `CGV` tinyint(1) DEFAULT 0,
  `AGENCES` text DEFAULT NULL,
  `METIER` text DEFAULT NULL,
  `SOUS_METIER` text DEFAULT NULL,
  `LOGO` text DEFAULT NULL,
  `REFUS` text DEFAULT NULL,
  `VALIDE` int(11) NOT NULL DEFAULT 0,
  `SITE_INTERNET` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SOCIETE`
--

INSERT INTO `SOCIETE` (`ID`, `NOM`, `ADRESSE1`, `ADRESSE2`, `ADRESSE3`, `CP`, `VILLE`, `PAYS`, `TEL`, `EMAIL`, `TVA`, `CA`, `A_PAYE`, `CGV`, `AGENCES`, `METIER`, `SOUS_METIER`, `LOGO`, `REFUS`, `VALIDE`, `SITE_INTERNET`) VALUES
(194, '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', NULL, 1, ''),
(270, 'AREP-Exigences', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(271, 'FFIE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(272, 'AREP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(273, 'AREP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(274, 'AREP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(275, 'FFIE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(276, 'AREP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(277, 'AREP-Exigences', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(278, 'aaa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(279, 'Aaaaa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(280, 'aaa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(281, 'aaaaaa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(282, 'aaa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(283, 'IGNES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(284, 'DEVEKO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(285, 'ARTEMISE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(286, 'AREP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(287, 'AREP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(288, 'SCHNEIDER ELECTRIC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(289, 'CIEM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `TRANSPORTS`
--

CREATE TABLE `TRANSPORTS` (
  `ID` int(11) NOT NULL,
  `EVENT_ID` int(11) DEFAULT NULL,
  `TYPE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `MOYEN` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NOM` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `NUMERO` text NOT NULL,
  `DE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `A` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `DATE_DEPART` text NOT NULL,
  `HEURE_DEPART` text NOT NULL,
  `DATE_ARRIVEE` text NOT NULL,
  `HEURE_ARRIVEE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TRANSPORTS`
--

INSERT INTO `TRANSPORTS` (`ID`, `EVENT_ID`, `TYPE`, `MOYEN`, `NOM`, `DESCRIPTION`, `NUMERO`, `DE`, `A`, `DATE_DEPART`, `HEURE_DEPART`, `DATE_ARRIVEE`, `HEURE_ARRIVEE`) VALUES
(1, 1, 'PRE ACH', 'AVION', 'Air France ', 'BOEING 777', '123', 'Nice', 'Paris CDG', '2019-09-08', '10 h', '2019-09-08', '10h30'),
(2, 1, 'PRE ACH', 'AVION', 'Air France ', 'BOEING 777', '123', 'Toulouse', 'Paris CDG', '2019-09-08', '10 h 20', '2019-09-08', '10h30'),
(3, 1, 'POST ACH', 'AVION', 'Air France ', 'BOEING 777', '123', 'Paris CDG', 'Nice', '2019-09-08', '20 h', '2019-09-08', '21h00'),
(4, 1, 'POST ACH', 'AVION', 'Air France ', 'BOEING 777', '123', 'Paris CDG', 'Toulouse', '2019-09-08', '21 h 00', '2019-09-08', '22h05'),
(5, 1, 'ALLER', 'AVION', 'Air France ', 'BOEING 777', '123', 'Nice', 'Paris CDG', '2019-09-08', '10 h', '2019-09-08', '10h30'),
(6, 1, 'ALLER', 'AVION', 'Air France ', 'BOEING 777', '123', 'Toulouse', 'Paris CDG', '2019-09-08', '10 h 20', '2019-09-08', '10h30'),
(7, 1, 'RETOUR', 'AVION', 'Air France ', 'BOEING 777', '123', 'Paris CDG', 'Nice', '2019-09-08', '20 h', '2019-09-08', '21h00'),
(8, 1, 'RETOUR', 'AVION', 'Air France ', 'BOEING 777', '123', 'Paris CDG', 'Toulouse', '2019-09-08', '21 h 00', '2019-09-08', '22h05'),
(9, 1, 'RETOUR', 'TRAIN', 'Air France ', 'BOEING 777', '123', 'Nice', 'Paris CDG', '2019-09-08', '10 h', '2019-09-08', '10h30'),
(10, 1, 'RETOUR', 'TRAIN', 'Air France ', 'BOEING 777', '123', 'Toulouse', 'Paris CDG', '2019-09-08', '10 h 20', '2019-09-08', '10h30'),
(11, 1, 'RETOUR', 'MINI BUS', 'Air France ', 'BOEING 777', '123', 'Paris CDG', 'Nice', '2019-09-08', '20 h', '2019-09-08', '21h00'),
(12, 1, 'RETOUR', 'AVION', 'Air France ', 'BOEING 777', '123', 'Paris CDG', 'Toulouse', '2019-09-08', '21 h 00', '2019-09-08', '22h05'),
(13, 1, 'RETOUR', 'AVION', 'Air France ', 'BOEING 777', '123', 'Nice', 'Paris CDG', '2019-09-08', '10 h', '2019-09-08', '10h30'),
(14, 1, 'RETOUR', 'AVION', 'Air France ', 'BOEING 777', '123', 'Toulouse', 'Paris CDG', '2019-09-08', '10 h 20', '2019-09-08', '10h30'),
(15, 1, 'RETOUR', 'AVION', 'Air France ', 'BOEING 777', '123', 'Paris CDG', 'Nice', '2019-09-08', '20 h', '2019-09-08', '21h00'),
(19, 85, 'fghfdg', 'gfhhf', 'fgfgfdsgwf', 'gfhfg', 'gfghdfgd', 'hgffdg', 'hgfd', '2019-08-30', 'hgffghd', '2019-09-12', 'hfgdfgd'),
(26, 85, 'fghfdg', 'gfhhf', 'hjgjjjjjjjj', 'd', 'gfghdfgd', 'hgffdg', 'hgfd', '2019-08-30', 'hgffghd', '2019-09-12', 'hfgdfgd');

-- --------------------------------------------------------

--
-- Table structure for table `USERS`
--

CREATE TABLE `USERS` (
  `ID` int(11) NOT NULL,
  `PASSWORD` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PARTICIPATION` tinyint(4) DEFAULT NULL,
  `CIVILITE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `NOM` text NOT NULL,
  `PRENOM` text NOT NULL,
  `SOCIETE_ID` int(11) NOT NULL,
  `FONCTION` text DEFAULT NULL,
  `ADRESSE1` text DEFAULT NULL,
  `CP` text DEFAULT NULL,
  `VILLE` text DEFAULT NULL,
  `TEL` text DEFAULT NULL,
  `MOBILE` text DEFAULT NULL,
  `EMAIL` text DEFAULT NULL,
  `MATRICULE` text DEFAULT NULL,
  `HOTEL_ID` text DEFAULT NULL,
  `ENREGISTREMENT` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `CONNEXION` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `GROUPE` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `FIRST_CO` int(11) DEFAULT 0,
  `DROIT` int(11) DEFAULT NULL,
  `TYPE` text DEFAULT NULL,
  `IS_VALID` tinyint(4) DEFAULT 1,
  `TITRE` text DEFAULT NULL,
  `ADRESSE2` text DEFAULT NULL,
  `PAYS` text DEFAULT NULL,
  `PRESENT_DEJ1` text DEFAULT NULL,
  `PRESENT_REUNION1` text DEFAULT NULL,
  `PRESENT_DINER11` tinyint(4) DEFAULT NULL,
  `PRESENT_NUIT1` tinyint(4) DEFAULT NULL,
  `PRESENT_PDEJ2` tinyint(4) DEFAULT NULL,
  `PRESENT_REUNION21` text DEFAULT NULL,
  `PRESENT_DEJ2` text DEFAULT NULL,
  `PRESENT_REUNION22` tinyint(4) DEFAULT NULL,
  `PRESENT_DINER12` tinyint(4) DEFAULT NULL,
  `PRESENT_NUIT2` text DEFAULT NULL,
  `PRESENT_PDEJ3` tinyint(4) DEFAULT NULL,
  `PRESENT_REUNION31` tinyint(4) DEFAULT NULL,
  `PRESENT_DEJ3` text DEFAULT NULL,
  `PRESENT_REUNION32` tinyint(4) DEFAULT NULL,
  `PRESENT_DINER13` tinyint(4) DEFAULT NULL,
  `PRESENT_NUIT3` tinyint(4) DEFAULT NULL,
  `PRESENT_BUS_ALLER` tinyint(4) DEFAULT NULL,
  `PRESENT_PDEJ4` tinyint(4) DEFAULT NULL,
  `PRESENT_REUNION4` text DEFAULT NULL,
  `PRESENT_DEJ4` text DEFAULT NULL,
  `PRESENT_BUS_RETOUR` tinyint(4) DEFAULT NULL,
  `METIER` text DEFAULT NULL,
  `NB_TICKETS_METRO` int(11) DEFAULT NULL,
  `STATUT` varchar(255) DEFAULT NULL,
  `SOUS_METIER` text DEFAULT NULL,
  `PRESENT_DINER1` tinyint(4) DEFAULT NULL,
  `IS_PRIVILEGIE` tinyint(4) DEFAULT 0,
  `REMARQUES` text DEFAULT NULL,
  `CONDITIONS` text DEFAULT NULL,
  `TRANSPORT` text DEFAULT NULL,
  `MOYEN` text DEFAULT NULL,
  `VOYAGE` text DEFAULT NULL,
  `TRANS_ALLER` text DEFAULT NULL,
  `VILLE_DEPART1` text DEFAULT NULL,
  `TRANS_RETOUR` text DEFAULT NULL,
  `VILLE_DEPART2` text DEFAULT NULL,
  `NAVETTE` text DEFAULT NULL,
  `NAV` text DEFAULT NULL,
  `REMARQUES_TRANS` text DEFAULT NULL,
  `NOM_ACC` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `USERS`
--

INSERT INTO `USERS` (`ID`, `PASSWORD`, `PARTICIPATION`, `CIVILITE`, `NOM`, `PRENOM`, `SOCIETE_ID`, `FONCTION`, `ADRESSE1`, `CP`, `VILLE`, `TEL`, `MOBILE`, `EMAIL`, `MATRICULE`, `HOTEL_ID`, `ENREGISTREMENT`, `CONNEXION`, `GROUPE`, `FIRST_CO`, `DROIT`, `TYPE`, `IS_VALID`, `TITRE`, `ADRESSE2`, `PAYS`, `PRESENT_DEJ1`, `PRESENT_REUNION1`, `PRESENT_DINER11`, `PRESENT_NUIT1`, `PRESENT_PDEJ2`, `PRESENT_REUNION21`, `PRESENT_DEJ2`, `PRESENT_REUNION22`, `PRESENT_DINER12`, `PRESENT_NUIT2`, `PRESENT_PDEJ3`, `PRESENT_REUNION31`, `PRESENT_DEJ3`, `PRESENT_REUNION32`, `PRESENT_DINER13`, `PRESENT_NUIT3`, `PRESENT_BUS_ALLER`, `PRESENT_PDEJ4`, `PRESENT_REUNION4`, `PRESENT_DEJ4`, `PRESENT_BUS_RETOUR`, `METIER`, `NB_TICKETS_METRO`, `STATUT`, `SOUS_METIER`, `PRESENT_DINER1`, `IS_PRIVILEGIE`, `REMARQUES`, `CONDITIONS`, `TRANSPORT`, `MOYEN`, `VOYAGE`, `TRANS_ALLER`, `VILLE_DEPART1`, `TRANS_RETOUR`, `VILLE_DEPART2`, `NAVETTE`, `NAV`, `REMARQUES_TRANS`, `NOM_ACC`) VALUES
(2, 'd033e22ae348aeb5660fc2140aec35850c4da997', NULL, 'M.', 'GATTOUI', 'Fouad', 194, 'AREP', NULL, NULL, NULL, '01 85 74 00 90', '0645327844', 'f.gattoui@arep.co.com', '', NULL, NULL, '18-08-2021 10:46', 'ADMIN', 1, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '1', '0', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL),
(6000, 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'M.', 'KERROS', 'Adrien', 194, 'Web', '02/09/1989', '1', 'AHBCUD839H83', '2030', '0635317186', 'a.kerros@arep.co.com', '1', NULL, '', '02-08-2021 15:38', '1', 1, 0, '', 1, NULL, NULL, NULL, '7h00/12h00', 'Cercle d’Aumale', NULL, 1, NULL, 'Aéroport', '12h00/17h00', NULL, NULL, 'Alain MARTIN : a.martin@arep.co.com', NULL, 1, 'AF739', NULL, NULL, 2, NULL, 2, 'Elodie DUPONT : e.dupont@arep.co.com\r\nAlain DUPONT : a;dupont@arep.co.com', 'AF739', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '1', '2', NULL, NULL, '04/09/2021', 'Marseille', '06/09/2021', 'Marseille', '1', '1', 'Réservation d\'un restaurant SVP', NULL),
(6001, 'dd610c9178eab91dd555bda3982c3451e0dd7687', NULL, 'Mme', 'RENOUARD', 'Sophie', 194, '', '', '', '', '', '', 's.renouard@arep.co.com', '', NULL, '', '15-08-2021 11:50', '1', 1, 0, '', 1, NULL, NULL, NULL, '', '0', NULL, 0, NULL, '0', '', NULL, NULL, '', NULL, 0, '', NULL, NULL, 0, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, '', '', '', '', '', '', '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ACTIVITES`
--
ALTER TABLE `ACTIVITES`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `EVENTS`
--
ALTER TABLE `EVENTS`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `HOTELS`
--
ALTER TABLE `HOTELS`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `PROFILS`
--
ALTER TABLE `PROFILS`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ROOM`
--
ALTER TABLE `ROOM`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `SITE_ACCUEIL`
--
ALTER TABLE `SITE_ACCUEIL`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `SITE_ACTUS`
--
ALTER TABLE `SITE_ACTUS`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `SITE_CONTACT`
--
ALTER TABLE `SITE_CONTACT`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `SITE_HEBERGEMENT`
--
ALTER TABLE `SITE_HEBERGEMENT`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `SITE_INFOS_PRAT`
--
ALTER TABLE `SITE_INFOS_PRAT`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `SITE_INSCRIPTION`
--
ALTER TABLE `SITE_INSCRIPTION`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `SITE_PRESSE`
--
ALTER TABLE `SITE_PRESSE`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `SITE_PROGRAMME`
--
ALTER TABLE `SITE_PROGRAMME`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `SOCIETE`
--
ALTER TABLE `SOCIETE`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD UNIQUE KEY `ID_2` (`ID`),
  ADD UNIQUE KEY `ID_3` (`ID`);

--
-- Indexes for table `TRANSPORTS`
--
ALTER TABLE `TRANSPORTS`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD UNIQUE KEY `ID_2` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ACTIVITES`
--
ALTER TABLE `ACTIVITES`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `EVENTS`
--
ALTER TABLE `EVENTS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `HOTELS`
--
ALTER TABLE `HOTELS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `PROFILS`
--
ALTER TABLE `PROFILS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1183;

--
-- AUTO_INCREMENT for table `ROOM`
--
ALTER TABLE `ROOM`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `SITE_ACCUEIL`
--
ALTER TABLE `SITE_ACCUEIL`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `SITE_ACTUS`
--
ALTER TABLE `SITE_ACTUS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `SITE_CONTACT`
--
ALTER TABLE `SITE_CONTACT`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `SITE_HEBERGEMENT`
--
ALTER TABLE `SITE_HEBERGEMENT`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `SITE_INFOS_PRAT`
--
ALTER TABLE `SITE_INFOS_PRAT`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `SITE_INSCRIPTION`
--
ALTER TABLE `SITE_INSCRIPTION`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SITE_PRESSE`
--
ALTER TABLE `SITE_PRESSE`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `SITE_PROGRAMME`
--
ALTER TABLE `SITE_PROGRAMME`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `SOCIETE`
--
ALTER TABLE `SOCIETE`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=290;

--
-- AUTO_INCREMENT for table `TRANSPORTS`
--
ALTER TABLE `TRANSPORTS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
