-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2024 at 12:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adventure_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `destinacije`
--

CREATE TABLE `destinacije` (
  `ID` int(11) NOT NULL,
  `naziv` varchar(255) NOT NULL,
  `opis` text DEFAULT NULL,
  `slika` varchar(255) DEFAULT NULL,
  `rejting` decimal(4,2) DEFAULT NULL,
  `duzina_putanje` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `destinacije`
--

INSERT INTO `destinacije` (`ID`, `naziv`, `opis`, `slika`, `rejting`, `duzina_putanje`) VALUES
(132, 'Tara - Banjska stena', 'Banjska stena je jedan od najpoznatijih i najlepših vidikovaca u Srbiji.', '../public/images/Dren.jpg', 4.50, '5.1'),
(208, 'Vidikovac \"Molitva\"', 'Sam vrh Molitva je na visini od 1.247 metara nadmorske visine. Rezervat prirode Uvac.', '../public/images/VidikovacMolitva.jpg', 4.20, '7.5'),
(310, 'Ljuti Krš', 'Ova pešačka staza je i dobila naziv po vrhu koji se zove Ljuti krš. Pogled sa ovog vrha je fascinantan.', '../public/images/LjutiKrs.jpg', 4.70, '10.6'),
(420, 'Trem', 'Trem je sa svojom visinom od 1810 metara najviši vrh Suve planine, na njenom zapadnom kraku.', '../public/images/trem.jpg', 4.00, '12.8'),
(514, 'Tomićeva Koliba - Šiljak', 'Kamp Tomićeva Koliba se nalazi u podnožju Rtnja, a početku staze za uspon do vrha Šiljak.', '../public/images/RtanjTomicevaKoliba.jpg', 4.80, '8.2'),
(629, 'Koritnjak - Devojački Grob', 'Staza prolazi kroz šumu i preko stena kod mesta Rajac, pružajući pogled na Suvu planinu i Svrljiške planine.', '../public/images/KoritnjakDevojackiGrob.jpg', 4.30, '9.2'),
(735, 'Kablar', 'Ovčarsko-kablarska klisura predstavlja jedinstvenu morfološku celinu. Udaljena je 18 km od Čačka.', '../public/images/Kablar.jpg', 4.60, '14.8'),
(821, 'Sokolina - Levećac', 'Istražite ovu 4.8 kilometara dugu stazu od tačke do tačke blizu Bajine Bašte, Zlatiborskog upravnog okruga.', '../public/images/SokolinaLevecac.jpg', 4.90, '4.8'),
(913, 'Drlije - Beljiške Stene', 'Pogledajte ovu stazu od tačke do tačke dužine 3.2 kilometra blizu Bajine Bašte, Zlatiborskog upravnog okruga.', '../public/images/BiljeskeStene.jpg', 4.10, '3.2'),
(1037, 'Koželj - Lednički Vrh', 'Selo Koželj na planini Tupežnice kroz planinsku pećinu do samog Ledničkog vrha na 1160 metara.', '../public/images/LednickiVrh.jpg', 4.40, '11'),
(1168, 'Kota 899', 'Krenite na ovu stazu od tačke do tačke dužine 2,6 km u blizini Čačak-grada, Moravički upravni okrug. Generalno se smatra izazovnom rutom, potrebno je u proseku 1 h 30 min da se završi.', '../public/images/kota889.jpg', 4.10, '2,6'),
(1243, 'Glogovački Vrh', 'Pogledajte ovu stazu od 11,6 km u blizini Zaječar-grada, Zaječarski upravni okrug. Generalno se smatra izazovnom rutom, potrebno je u proseku 4 sata i 39 minuta da se završi.', '../public/images/glogovackivrh.jpg', 5.00, '11,6');

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE `komentari` (
  `ID` int(11) NOT NULL,
  `destinacija_id` int(11) NOT NULL,
  `korisnicko_ime` varchar(255) NOT NULL,
  `sadrzaj` mediumtext NOT NULL,
  `vreme` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`ID`, `destinacija_id`, `korisnicko_ime`, `sadrzaj`, `vreme`, `user_id`) VALUES
(984, 132, 'cor21', 'Prelep pogled, staza je izazovna.', '2020-02-15 07:12:30', 17),
(985, 132, 'luka21', 'Divno mesto, uživao sam na stazi.', '2020-03-17 08:22:45', 18),
(986, 132, 'Milica4', 'Staza je odlična, ali bi mogla biti kraća.', '2020-04-20 08:35:20', 24),
(987, 208, 'Jelenko', 'Vidikovac je fantastičan, staza je malo zahtevna.', '2020-05-01 09:00:05', 19),
(988, 208, 'Jovana18', 'Bilo je prelepo, ali staza bi mogla da bude kraća.', '2020-06-05 10:05:15', 26),
(989, 208, 'Teodora2', 'Staza je duga, ali poglede su vredni truda.', '2020-07-10 11:15:30', 22),
(990, 310, 'Sonja05', 'Staza je duga, ali prelepa.', '2020-08-01 12:30:40', 29),
(991, 310, 'Nikola', 'Vrlo izazovna staza, ali pogled je nezaboravan.', '2020-09-14 13:25:20', 25),
(992, 310, 'Milica4', 'Trebalo bi više informacija na stazi.', '2020-10-05 14:40:55', 24),
(993, 420, 'Sloba', 'Staza je odlična, ali teško je za početnike.', '2020-11-10 16:30:25', 28),
(994, 420, 'Teodora2', 'Pogled sa vrha je fenomenalan, staza je duga.', '2020-12-15 17:05:10', 22),
(995, 420, 'Jovana18', 'Staza je izazovna, ali vredelo je!', '2021-01-02 18:10:30', 26),
(996, 514, 'Sonja05', 'Divno mesto, prelep pogled!', '2021-02-20 19:15:45', 29),
(997, 514, 'Nikola', 'Bilo je fantastično, ali staza bi mogla biti kraća.', '2021-03-05 20:10:55', 25),
(998, 514, 'Jelenko', 'Vrlo lepa staza, ali trebalo bi da bude više odmorišta.', '2021-04-02 20:30:40', 19),
(999, 514, 'Teodora2', 'Pogled je neverovatan, ali staza bi mogla biti bolja.', '2021-05-10 21:05:15', 22),
(1000, 629, 'Sonja05', 'Zadovoljni smo, staza je prelepa.', '2021-06-11 22:05:20', 29),
(1001, 629, 'Milica4', 'Prelep pogled, ali staza je veoma teška.', '2021-07-02 23:15:05', 24),
(1002, 629, 'Teodora2', 'Uživala sam, ali staza je zahtevna.', '2021-08-10 00:30:25', 22),
(1003, 735, 'Sloba', 'Ovo je pravo mesto za ljubitelje prirode.', '2021-09-15 01:05:40', 28),
(1004, 735, 'Nikola', 'Staza je duga, ali vredilo je.', '2021-10-25 02:40:15', 25),
(1005, 735, 'Jovana18', 'Mesto je prelepo, ali trebalo bi da bude više klupa za odmor.', '2021-11-30 04:20:55', 26),
(1006, 821, 'Teodora2', 'Staza je izazovna, ali vrlo lepa.', '2022-01-10 05:00:25', 22),
(1007, 821, 'Sonja05', 'Prelep pogled, staza je odlična.', '2022-02-01 06:05:40', 29),
(1008, 821, 'Jelenko', 'Bilo je fantastično, ali staza bi mogla biti kraća.', '2022-03-05 07:10:15', 19),
(1009, 913, 'Teodora2', 'Pogled sa staze je prelep.', '2022-04-14 07:20:30', 22),
(1010, 913, 'Sonja05', 'Staza je zahtevna, ali vredelo je.', '2022-05-10 08:30:40', 29),
(1011, 913, 'Milica4', 'Bilo je malo naporno, ali prelep pogled.', '2022-06-25 09:05:25', 24),
(1012, 1037, 'Sonja05', 'Pogled je fenomenalan, staza je lepa.', '2022-07-10 10:15:55', 29),
(1013, 1037, 'Jovana18', 'Staza je predivna, ali veoma teška.', '2022-08-01 11:05:25', 26),
(1014, 1037, 'Nikola', 'Odličan uspon, staza bi mogla biti kraća.', '2022-09-05 12:20:40', 25),
(1015, 1168, 'Sloba', 'Divno mesto, ali staza bi mogla biti bolja.', '2022-10-01 13:00:05', 28),
(1016, 1168, 'Jovana18', 'Staza je duga, ali prelep pogled.', '2022-11-03 15:10:30', 26),
(1017, 1168, 'Teodora2', 'Bilo je prelepo, ali staza bi mogla da bude kraća.', '2023-01-10 16:25:20', 22),
(1018, 132, 'Nikola', 'Pogled je neverovatan, staza je izazovna.', '2023-02-15 17:35:10', 25),
(1019, 132, 'Teodora2', 'Bilo je fenomenalno, ali staza bi mogla biti kraća.', '2023-03-18 18:50:25', 22),
(1020, 132, 'Sonja05', 'Staza je lepa, ali trebalo bi da bude više odmorišta.', '2023-04-20 18:40:55', 29),
(1021, 208, 'Jelenko', 'Staza je lepa, ali imajte na umu da je duga.', '2023-05-10 19:20:15', 19),
(1022, 208, 'Sloba', 'Pogled je prelep, ali staza je teža nego što sam mislio.', '2023-06-01 20:10:30', 28),
(1023, 208, 'Jovana18', 'Uživala sam, ali staza je izazovna.', '2023-07-02 21:15:40', 26),
(1024, 310, 'Teodora2', 'Prelep pogled, staza je malo zahtevna.', '2023-08-09 22:25:10', 22),
(1025, 310, 'Nikola', 'Bilo je naporno, ali prelep pogled sa vrha.', '2023-09-14 23:00:25', 25),
(1026, 310, 'Milica4', 'Preporučujem, ali staza bi mogla biti kraća.', '2023-10-05 00:10:50', 24),
(1027, 420, 'Sonja05', 'Staza je lepa, ali izazovna.', '2023-11-01 02:20:35', 29),
(1028, 420, 'Nikola', 'Divan pogled sa staze, ali staza je teža nego što sam mislio.', '2023-11-03 03:10:30', 25),
(1029, 514, 'Jelenko', 'Staza je lepa, ali bi mogla biti kraća.', '2023-11-10 04:00:05', 19),
(1030, 514, 'Teodora2', 'Bilo je fantastično, staza je izazovna, ali vredi!', '2023-12-15 05:20:15', 22),
(1031, 514, 'Sonja05', 'Prelep pogled, staza je bila zahtevna.', '2024-01-10 06:15:25', 29),
(1032, 514, 'Sloba', 'Staza je izazovna, ali pogled je neverovatan.', '2024-02-05 07:05:45', 28),
(1033, 629, 'Milica4', 'Bilo je prelepo, ali trebalo bi da bude više informacija.', '2024-03-01 08:20:30', 24),
(1034, 629, 'Nikola', 'Pogled je neverovatan, staza je lepa.', '2024-04-15 08:10:40', 25),
(1035, 629, 'Teodora2', 'Staza je duga, ali vredilo je!', '2024-05-05 09:25:55', 22),
(1036, 735, 'Sloba', 'Divno mesto, staza je izazovna, ali pogled je prelep.', '2024-06-01 10:30:50', 28),
(1037, 735, 'Sonja05', 'Bilo je malo naporno, ali uživao sam.', '2024-07-05 11:10:30', 29),
(1038, 735, 'Milica4', 'Staza je lepa, ali bi trebalo da bude više odmorišta.', '2024-08-12 12:20:15', 24),
(1039, 821, 'Teodora2', 'Prelep dan, staza je izazovna, ali vredi.', '2024-09-01 13:15:45', 22),
(1040, 821, 'Sonja05', 'Staza je duga, ali vredelo je!', '2024-10-10 14:05:25', 29),
(1041, 821, 'Nikola', 'Pogled je prelep, staza je izazovna.', '2024-11-01 16:00:50', 25),
(1042, 913, 'Jelenko', 'Mesto je fenomenalno, ali trebalo bi da bude više klupa.', '2024-01-05 17:05:15', 19),
(1043, 913, 'Teodora2', 'Staza je izazovna, ali prelep pogled.', '2024-02-20 18:10:25', 22),
(1044, 913, 'Nikola', 'Bilo je fantastično, staza bi mogla biti kraća.', '2024-03-10 19:15:35', 25),
(1045, 1037, 'Sonja05', 'Prelep pogled sa vrha!', '2024-04-15 19:00:40', 29),
(1046, 1037, 'Jovana18', 'Staza je izazovna, ali vredelo je.', '2024-05-10 20:30:15', 26),
(1047, 1037, 'Milica4', 'Pogled je nezaboravan, staza je lepa, ali izazovna.', '2024-06-20 21:10:30', 24),
(1048, 1168, 'Sloba', 'Vrlo lepa staza, ali trebalo bi da bude više označena.', '2024-07-09 22:25:45', 28),
(1049, 1168, 'Sonja05', 'Mesto je prelepo, staza je izazovna.', '2024-08-14 23:00:25', 29),
(1050, 1168, 'Nikola', 'Staza je lepa, ali bi mogla da bude kraća.', '2024-09-05 00:15:40', 25),
(1051, 132, 'Jelenko', 'Staza je izazovna, ali vredilo je!', '2024-10-10 01:05:50', 19),
(1052, 132, 'Teodora2', 'Pogled sa vrha je prelep, staza je duga.', '2024-11-10 03:10:30', 22),
(1053, 132, 'Sonja05', 'Uživali smo, staza je lepa, ali duga.', '2024-11-15 04:25:45', 29),
(1054, 208, 'Nikola', 'Staza je duga, ali prelep pogled.', '2020-05-15 04:00:05', 25);

-- --------------------------------------------------------

--
-- Table structure for table `kontakt`
--

CREATE TABLE `kontakt` (
  `ID` int(20) NOT NULL,
  `ime` varchar(55) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kontakt`
--

INSERT INTO `kontakt` (`ID`, `ime`, `email`, `message`) VALUES
(172, 'Dusan', 'dule8111@gmail.com', 'dadadqwdqdqwd'),
(173, 'Dusan', 'dule8111@gmail.com', 'dadadqwdqdqwd'),
(174, 'Dusan', 'dule8111@gmail.com', 'dadadqwdqdqwd'),
(175, 'Dusan', 'dule8111@gmail.com', 'dadadqwdqdqwd'),
(176, 'Dusan', 'dule8111@gmail.com', 'dadadqwdqdqwd'),
(177, 'Dusan', 'dule8111@gmail.com', 'dadadqwdqdqwd'),
(178, 'Dusan', 'dule8111@gmail.com', 'dadadqwdqdqwd'),
(179, 'Dusan', 'dule8111@gmail.com', 'dadadqwdqdqwd'),
(196, 'Dusan', 'dule8111@gmail.com', 'ajde sad'),
(197, 'Dusan', 'dule8111@gmail.com', 'ajde sad'),
(198, 'Dusan', 'dule8111@gmail.com', 'ajde sad'),
(199, 'Dusan', 'dule8111@gmail.com', 'adadad'),
(200, 'Dusan', 'dule8111@gmail.com', 'dada'),
(201, 'dada', 'dule8111@gmail.com', 'dad');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `ID` int(11) NOT NULL,
  `Ime` text NOT NULL,
  `Prezime` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`ID`, `Ime`, `Prezime`, `username`, `password`, `role`) VALUES
(17, 'Dusan', 'Petrovic', 'cor21', '$2y$10$Qj82w/2o.zKOgraEIjlsZeq8fGrutEJI02Imksd.5CGAzhulDC1wa', 'admin'),
(19, 'Aleksandar', 'Jelenkovic', 'Jelenko1', '$2y$10$zL8dOn6OkN1sbZEZeYSB/uQUhw/8LIYtBcLVGg8/9bNLEdOjnKbmi', 'admin'),
(22, 'Teodora', 'Nestorovic', 'Teodora2', '$2y$10$zPidqIbZaJ12i0Z7QzoV0.hVmf7wW/sJatAhwzw2.hrNP.t5jedg2', 'user'),
(23, 'Luka', 'Rakic', 'Luka2', '$2y$10$DkZ3o4j8dVTLrlHiTNLZAOsEnyOT/q0UVAOYoSJU6CEh09Up69mnO', 'user'),
(24, 'Milica', 'Miličić', 'Milica4', '$2y$10$YWQg9jJs9hbSlNfQ54Ilker9anVa5xND4Uk58wORl6raDGQq7f1Bu', 'user'),
(25, 'Nikola', 'Markovic', 'Nidza', '$2y$10$k467cnuRJ48bUz9PBNw.m.dFgP9kgY4Hxaid0vvs/JnW35Cv75B42', 'user'),
(26, 'Jovana', 'Petrovic', 'Jovana18', '$2y$10$sgW2iPJWKajOM1h99E6aE.yEeF/Ks.6mt3ce5b.i5Bi5/h4eFsTDa', 'user'),
(27, 'Marija', 'Jovanovic', 'Maki03', '$2y$10$5Qvscr.E1cMzbIj49cIoN.NaDo3zgxd/EHnuA/go2gVYztqgrVlF6', 'user'),
(28, 'Slobodan', 'Majstorović', 'Sloba', '$2y$10$P47AXnEA668uavAH2DHOJehxVKw0vfoyG1IP65LIjp8uRJJnTKFwq', 'user'),
(29, 'Sonja', 'Nestorović', 'Sonja05', '$2y$10$OTHs9TivqlV8.za6gjFuyOeKtP3ua/4Jia854YEDR3gFIC1MlZ4ua', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `reactions`
--

CREATE TABLE `reactions` (
  `id` int(11) NOT NULL,
  `destinacija_id` int(11) DEFAULT NULL,
  `korisnicko_ime` varchar(255) DEFAULT NULL,
  `reaction_type` enum('like','dislike') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `reactions`
--

INSERT INTO `reactions` (`id`, `destinacija_id`, `korisnicko_ime`, `reaction_type`) VALUES
(355, 310, NULL, 'like'),
(356, 310, NULL, 'dislike'),
(357, 310, NULL, 'dislike'),
(358, 310, NULL, 'like'),
(359, 310, NULL, 'like'),
(360, 310, NULL, 'like'),
(361, 310, NULL, 'dislike'),
(362, 310, NULL, 'dislike'),
(363, 310, NULL, 'like'),
(364, 310, NULL, 'like'),
(365, 208, NULL, 'like'),
(366, 208, NULL, 'like'),
(367, 208, NULL, 'like'),
(368, 208, NULL, 'like'),
(369, 208, NULL, 'like'),
(370, 208, NULL, 'like'),
(371, 208, NULL, 'like'),
(372, 208, NULL, 'like'),
(373, 208, NULL, 'like'),
(374, 208, NULL, 'like'),
(375, 208, NULL, 'dislike'),
(376, 208, NULL, 'dislike'),
(377, 208, NULL, 'dislike'),
(378, 208, NULL, 'dislike'),
(379, 208, NULL, 'dislike'),
(380, 208, NULL, 'dislike'),
(381, 208, NULL, 'like'),
(382, 208, NULL, 'like'),
(383, 208, NULL, 'like'),
(384, 208, NULL, 'like'),
(385, 208, NULL, 'like'),
(386, 208, NULL, 'like'),
(387, 208, NULL, 'like'),
(388, 208, NULL, 'like'),
(389, 208, NULL, 'like'),
(390, 208, NULL, 'like'),
(391, 208, NULL, 'like'),
(392, 208, NULL, 'like'),
(393, 208, NULL, 'like'),
(394, 208, NULL, 'like'),
(395, 208, NULL, 'like'),
(396, 208, NULL, 'like'),
(397, 208, NULL, 'like'),
(398, 208, NULL, 'like'),
(399, 208, NULL, 'like'),
(400, 208, NULL, 'like'),
(401, 208, NULL, 'like'),
(402, 208, NULL, 'like'),
(403, 208, NULL, 'like'),
(404, 208, NULL, 'dislike'),
(405, 208, NULL, 'dislike'),
(406, 208, NULL, 'dislike'),
(407, 208, NULL, 'like'),
(408, 208, NULL, 'like'),
(409, 208, NULL, 'like'),
(410, 208, NULL, 'like'),
(411, 208, NULL, 'dislike'),
(412, 208, NULL, 'dislike'),
(413, 208, NULL, 'dislike'),
(414, 208, NULL, 'dislike'),
(415, 208, NULL, 'dislike'),
(416, 208, NULL, 'like'),
(417, 208, NULL, 'like'),
(418, 208, NULL, 'dislike'),
(419, 208, NULL, 'dislike'),
(420, 208, NULL, 'like'),
(421, 208, NULL, 'like'),
(422, 208, NULL, 'dislike'),
(423, 208, NULL, 'dislike'),
(424, 208, NULL, 'like'),
(425, 208, NULL, 'like'),
(426, 208, NULL, 'like'),
(427, 208, NULL, 'dislike'),
(428, 208, NULL, 'like'),
(429, 208, NULL, 'like'),
(430, 208, NULL, 'like'),
(431, 208, NULL, 'like'),
(432, 208, NULL, 'like'),
(433, 208, NULL, 'like'),
(434, 208, NULL, 'like'),
(435, 208, NULL, 'dislike'),
(436, 208, NULL, 'like'),
(437, 310, NULL, 'like'),
(438, 310, NULL, 'like'),
(439, 310, NULL, 'like'),
(440, 310, NULL, 'dislike'),
(441, 310, NULL, 'dislike'),
(442, 132, NULL, 'like'),
(443, 132, NULL, 'like'),
(444, 132, NULL, 'like'),
(445, 132, NULL, 'dislike'),
(446, 132, NULL, 'dislike'),
(447, 132, NULL, 'dislike'),
(448, 132, NULL, 'like'),
(449, 132, NULL, 'like'),
(450, 132, NULL, 'like'),
(451, 208, NULL, 'like'),
(452, 208, NULL, 'like'),
(453, 208, NULL, 'like'),
(454, 208, NULL, 'like'),
(455, 208, NULL, 'like'),
(456, 208, NULL, 'like'),
(457, 208, NULL, 'like'),
(458, 208, NULL, 'like'),
(459, 310, NULL, 'like'),
(460, 310, NULL, 'like'),
(461, 310, NULL, 'like'),
(462, 310, NULL, 'dislike'),
(463, 310, NULL, 'like'),
(464, 132, NULL, 'like'),
(465, 132, NULL, 'like'),
(466, 132, NULL, 'like'),
(467, 132, NULL, 'like'),
(468, 132, NULL, 'like'),
(469, 132, NULL, 'like'),
(470, 132, NULL, 'like'),
(471, 132, NULL, 'dislike'),
(472, 132, NULL, 'dislike'),
(473, 132, NULL, 'dislike'),
(474, 132, NULL, 'dislike'),
(475, 132, NULL, 'dislike'),
(476, 132, NULL, 'like'),
(477, 132, NULL, 'like'),
(478, 132, NULL, 'like'),
(479, 132, NULL, 'like'),
(480, 132, NULL, 'like'),
(481, 132, NULL, 'like'),
(482, 132, NULL, 'like'),
(483, 132, NULL, 'like'),
(484, 132, NULL, 'like'),
(485, 132, NULL, 'like'),
(486, 132, NULL, 'like'),
(487, 132, NULL, 'like'),
(488, 132, NULL, 'like'),
(489, 132, NULL, 'dislike'),
(490, 132, NULL, 'dislike'),
(491, 132, NULL, 'like'),
(492, 132, NULL, 'like'),
(493, 132, NULL, 'dislike'),
(494, 132, NULL, 'dislike'),
(495, 132, NULL, 'like'),
(496, 132, NULL, 'like'),
(497, 132, NULL, 'like'),
(498, 132, NULL, 'like'),
(499, 132, NULL, 'like'),
(500, 132, NULL, 'dislike'),
(501, 132, NULL, 'like'),
(502, 310, NULL, 'like'),
(503, 310, NULL, 'like'),
(504, 310, NULL, 'like'),
(505, 310, NULL, 'like'),
(506, 310, NULL, 'like'),
(507, 310, NULL, 'like'),
(508, 310, NULL, 'like'),
(509, 310, NULL, 'like'),
(510, 310, NULL, 'like'),
(511, 310, NULL, 'like'),
(512, 310, NULL, 'like'),
(513, 310, NULL, 'like'),
(514, 310, NULL, 'dislike'),
(515, 310, NULL, 'like'),
(516, 310, NULL, 'dislike'),
(517, 310, NULL, 'dislike'),
(518, 310, NULL, 'dislike'),
(519, 310, NULL, 'dislike'),
(520, 310, NULL, 'like'),
(521, 310, NULL, 'like'),
(522, 310, NULL, 'like'),
(523, 310, NULL, 'like'),
(524, 310, NULL, 'like'),
(525, 310, NULL, 'dislike'),
(526, 310, NULL, 'like'),
(527, 310, NULL, 'dislike'),
(528, 310, NULL, 'dislike'),
(529, 310, NULL, 'like'),
(530, 310, NULL, 'like'),
(531, 310, NULL, 'like'),
(532, 310, NULL, 'dislike'),
(533, 310, NULL, 'like'),
(534, 310, NULL, 'like'),
(535, 310, NULL, 'like'),
(536, 310, NULL, 'like'),
(537, 310, NULL, 'like'),
(538, 310, NULL, 'dislike'),
(539, 310, NULL, 'dislike'),
(540, 310, NULL, 'dislike'),
(541, 310, NULL, 'dislike'),
(542, 310, NULL, 'like'),
(543, 310, NULL, 'like'),
(544, 310, NULL, 'like'),
(545, 310, NULL, 'like'),
(546, 310, NULL, 'like'),
(547, 310, NULL, 'like'),
(548, 821, NULL, 'like'),
(549, 821, NULL, 'like'),
(550, 821, NULL, 'like'),
(551, 821, NULL, 'like'),
(552, 821, NULL, 'like'),
(553, 821, NULL, 'like'),
(554, 821, NULL, 'like'),
(555, 821, NULL, 'dislike'),
(556, 821, NULL, 'dislike'),
(557, 821, NULL, 'dislike'),
(558, 821, NULL, 'dislike'),
(559, 821, NULL, 'dislike'),
(560, 821, NULL, 'like'),
(561, 821, NULL, 'like'),
(562, 821, NULL, 'like'),
(563, 821, NULL, 'like'),
(564, 821, NULL, 'like'),
(565, 821, NULL, 'like'),
(566, 821, NULL, 'like'),
(567, 821, NULL, 'dislike'),
(568, 821, NULL, 'dislike'),
(569, 821, NULL, 'dislike'),
(570, 514, NULL, 'like'),
(571, 514, NULL, 'like'),
(572, 514, NULL, 'like'),
(573, 514, NULL, 'like'),
(574, 514, NULL, 'like'),
(575, 514, NULL, 'like'),
(576, 514, NULL, 'like'),
(577, 514, NULL, 'like'),
(578, 514, NULL, 'like'),
(579, 514, NULL, 'like'),
(580, 514, NULL, 'like'),
(581, 514, NULL, 'like'),
(582, 514, NULL, 'like'),
(583, 514, NULL, 'like'),
(584, 514, NULL, 'like'),
(585, 514, NULL, 'like'),
(586, 514, NULL, 'like'),
(587, 514, NULL, 'like'),
(588, 514, NULL, 'like'),
(589, 514, NULL, 'like'),
(590, 514, NULL, 'like'),
(591, 514, NULL, 'like'),
(592, 514, NULL, 'like'),
(593, 514, NULL, 'like'),
(594, 514, NULL, 'like'),
(595, 514, NULL, 'like'),
(596, 514, NULL, 'dislike'),
(597, 514, NULL, 'dislike'),
(598, 514, NULL, 'dislike'),
(599, 514, NULL, 'dislike'),
(600, 514, NULL, 'dislike'),
(601, 514, NULL, 'dislike'),
(602, 514, NULL, 'dislike'),
(603, 514, NULL, 'dislike'),
(604, 514, NULL, 'dislike'),
(605, 514, NULL, 'dislike'),
(606, 514, NULL, 'dislike'),
(607, 514, NULL, 'dislike'),
(608, 514, NULL, 'dislike'),
(609, 514, NULL, 'dislike'),
(610, 208, NULL, 'like'),
(611, 629, NULL, 'like'),
(612, 629, NULL, 'like'),
(613, 629, NULL, 'like'),
(614, 629, NULL, 'like'),
(615, 629, NULL, 'like'),
(616, 629, NULL, 'like'),
(617, 629, NULL, 'dislike'),
(618, 629, NULL, 'dislike'),
(619, 629, NULL, 'dislike'),
(620, 629, NULL, 'dislike'),
(621, 629, NULL, 'dislike'),
(622, 629, NULL, 'dislike'),
(623, 629, NULL, 'like'),
(624, 629, NULL, 'like'),
(625, 629, NULL, 'like'),
(626, 629, NULL, 'like'),
(627, 629, NULL, 'like'),
(628, 629, NULL, 'like'),
(629, 629, NULL, 'like'),
(630, 629, NULL, 'dislike'),
(631, 629, NULL, 'dislike'),
(632, 1243, NULL, 'like'),
(633, 1243, NULL, 'like'),
(634, 1243, NULL, 'like'),
(635, 1243, NULL, 'like'),
(636, 1243, NULL, 'like'),
(637, 1243, NULL, 'like'),
(638, 1243, NULL, 'like'),
(639, 1243, NULL, 'like'),
(640, 1243, NULL, 'like'),
(641, 1243, NULL, 'like'),
(642, 1243, NULL, 'like'),
(643, 1243, NULL, 'like'),
(644, 1243, NULL, 'like'),
(645, 1243, NULL, 'like'),
(646, 1243, NULL, 'like'),
(647, 1243, NULL, 'like'),
(648, 1243, NULL, 'like'),
(649, 1243, NULL, 'like'),
(650, 1243, NULL, 'like'),
(651, 1243, NULL, 'like'),
(652, 1243, NULL, 'like'),
(653, 1243, NULL, 'like'),
(654, 1243, NULL, 'like'),
(655, 1243, NULL, 'like'),
(656, 1243, NULL, 'like'),
(657, 1243, NULL, 'like'),
(658, 1243, NULL, 'like'),
(659, 1243, NULL, 'like'),
(660, 1243, NULL, 'like'),
(661, 1243, NULL, 'like'),
(662, 1243, NULL, 'like'),
(663, 1243, NULL, 'like'),
(664, 1243, NULL, 'like'),
(665, 1243, NULL, 'like'),
(666, 1243, NULL, 'like'),
(667, 1243, NULL, 'like'),
(668, 1243, NULL, 'like'),
(669, 1168, NULL, 'dislike'),
(670, 1168, NULL, 'dislike'),
(671, 1168, NULL, 'dislike'),
(672, 1168, NULL, 'dislike'),
(673, 1168, NULL, 'dislike'),
(674, 1168, NULL, 'like'),
(675, 1168, NULL, 'like'),
(676, 1168, NULL, 'like'),
(677, 1168, NULL, 'like'),
(678, 1168, NULL, 'like'),
(679, 1168, NULL, 'like'),
(680, 1168, NULL, 'like'),
(681, 1168, NULL, 'like'),
(682, 1168, NULL, 'like'),
(683, 1168, NULL, 'like'),
(684, 1168, NULL, 'like'),
(685, 1168, NULL, 'like'),
(686, 1168, NULL, 'like'),
(687, 1168, NULL, 'like'),
(688, 1168, NULL, 'like'),
(689, 1168, NULL, 'like'),
(690, 1168, NULL, 'like'),
(691, 1168, NULL, 'like'),
(692, 1168, NULL, 'like'),
(693, 1168, NULL, 'like'),
(694, 1168, NULL, 'like'),
(695, 1168, NULL, 'like'),
(696, 1168, NULL, 'like'),
(697, 1168, NULL, 'like'),
(698, 1168, NULL, 'like'),
(699, 1168, NULL, 'like'),
(700, 1168, NULL, 'like'),
(701, 1168, NULL, 'like'),
(702, 1168, NULL, 'like'),
(703, 1168, NULL, 'like'),
(704, 1037, NULL, 'like'),
(705, 1037, NULL, 'like'),
(706, 1037, NULL, 'like'),
(707, 1037, NULL, 'like'),
(708, 1037, NULL, 'like'),
(709, 1037, NULL, 'like'),
(710, 1037, NULL, 'like'),
(711, 1037, NULL, 'like'),
(712, 1037, NULL, 'like'),
(713, 1037, NULL, 'like'),
(714, 1037, NULL, 'like'),
(715, 1037, NULL, 'like'),
(716, 1037, NULL, 'like'),
(717, 1037, NULL, 'like'),
(718, 1037, NULL, 'like'),
(719, 1037, NULL, 'like'),
(720, 1037, NULL, 'like'),
(721, 1037, NULL, 'like'),
(722, 1037, NULL, 'like'),
(723, 1037, NULL, 'like'),
(724, 1037, NULL, 'like'),
(725, 1037, NULL, 'like'),
(726, 1037, NULL, 'like'),
(727, 1037, NULL, 'like'),
(728, 1037, NULL, 'dislike'),
(729, 1037, NULL, 'dislike'),
(730, 1037, NULL, 'dislike'),
(731, 1037, NULL, 'dislike'),
(732, 1037, NULL, 'dislike'),
(733, 1037, NULL, 'dislike'),
(734, 1037, NULL, 'dislike'),
(735, 1037, NULL, 'dislike'),
(736, 1037, NULL, 'dislike'),
(737, 1037, NULL, 'dislike'),
(738, 913, NULL, 'like'),
(739, 913, NULL, 'like'),
(740, 913, NULL, 'like'),
(741, 913, NULL, 'like'),
(742, 913, NULL, 'like'),
(743, 913, NULL, 'like'),
(744, 913, NULL, 'like'),
(745, 913, NULL, 'like'),
(746, 913, NULL, 'like'),
(747, 913, NULL, 'like'),
(748, 913, NULL, 'like'),
(749, 913, NULL, 'like'),
(750, 913, NULL, 'like'),
(751, 913, NULL, 'like'),
(752, 913, NULL, 'like'),
(753, 913, NULL, 'like'),
(754, 913, NULL, 'like'),
(755, 913, NULL, 'like'),
(756, 913, NULL, 'like'),
(757, 913, NULL, 'like'),
(758, 913, NULL, 'like'),
(759, 913, NULL, 'like'),
(760, 913, NULL, 'like'),
(761, 913, NULL, 'like'),
(762, 913, NULL, 'like'),
(763, 913, NULL, 'like'),
(764, 913, NULL, 'like'),
(765, 913, NULL, 'like'),
(766, 913, NULL, 'like'),
(767, 913, NULL, 'like'),
(768, 913, NULL, 'like'),
(769, 913, NULL, 'like'),
(770, 913, NULL, 'like'),
(771, 913, NULL, 'like'),
(772, 821, NULL, 'dislike'),
(773, 821, NULL, 'dislike'),
(774, 821, NULL, 'like'),
(775, 821, NULL, 'like'),
(776, 821, NULL, 'like'),
(777, 821, NULL, 'like'),
(778, 821, NULL, 'like'),
(779, 821, NULL, 'like'),
(780, 821, NULL, 'like'),
(781, 821, NULL, 'like'),
(782, 821, NULL, 'like'),
(783, 821, NULL, 'like'),
(784, 821, NULL, 'like'),
(785, 735, NULL, 'like'),
(786, 735, NULL, 'like'),
(787, 735, NULL, 'like'),
(788, 735, NULL, 'like'),
(789, 735, NULL, 'like'),
(790, 514, NULL, 'like'),
(791, 514, NULL, 'like'),
(792, 514, NULL, 'like'),
(793, 514, NULL, 'like'),
(794, 514, NULL, 'like'),
(795, 514, NULL, 'like'),
(796, 514, NULL, 'like'),
(797, 420, NULL, 'like'),
(798, 420, NULL, 'like'),
(799, 420, NULL, 'like'),
(800, 420, NULL, 'like'),
(801, 420, NULL, 'like'),
(802, 420, NULL, 'like'),
(803, 420, NULL, 'like'),
(804, 420, NULL, 'like'),
(805, 420, NULL, 'like'),
(806, 420, NULL, 'like'),
(807, 420, NULL, 'like'),
(808, 420, NULL, 'like'),
(809, 420, NULL, 'like'),
(810, 420, NULL, 'like'),
(811, 420, NULL, 'like'),
(812, 420, NULL, 'like'),
(813, 420, NULL, 'like'),
(814, 420, NULL, 'like'),
(815, 420, NULL, 'like'),
(816, 420, NULL, 'like'),
(817, 420, NULL, 'like'),
(818, 420, NULL, 'like'),
(819, 420, NULL, 'like'),
(820, 420, NULL, 'like'),
(821, 420, NULL, 'like'),
(822, 420, NULL, 'like'),
(823, 420, NULL, 'like'),
(824, 420, NULL, 'like'),
(825, 420, NULL, 'like'),
(826, 420, NULL, 'like'),
(827, 420, NULL, 'like'),
(828, 420, NULL, 'like'),
(829, 420, NULL, 'like'),
(830, 420, NULL, 'like'),
(831, 420, NULL, 'like'),
(832, 420, NULL, 'like'),
(833, 420, NULL, 'like'),
(834, 420, NULL, 'like'),
(835, 420, NULL, 'like'),
(836, 420, NULL, 'like'),
(837, 420, NULL, 'like'),
(838, 420, NULL, 'like'),
(839, 420, NULL, 'like'),
(840, 420, NULL, 'like'),
(841, 420, NULL, 'like'),
(842, 420, NULL, 'like'),
(843, 420, NULL, 'like'),
(844, 420, NULL, 'like'),
(845, 420, NULL, 'like'),
(846, 420, NULL, 'like'),
(847, 420, NULL, 'like'),
(848, 420, NULL, 'like'),
(849, 420, NULL, 'like'),
(850, 420, NULL, 'like'),
(851, 420, NULL, 'like'),
(852, 420, NULL, 'like'),
(853, 420, NULL, 'like'),
(854, 420, NULL, 'like'),
(855, 420, NULL, 'like'),
(856, 420, NULL, 'like'),
(857, 420, NULL, 'like'),
(858, 420, NULL, 'like'),
(859, 420, NULL, 'like'),
(860, 420, NULL, 'like'),
(861, 420, NULL, 'like'),
(862, 420, NULL, 'like'),
(863, 420, NULL, 'like'),
(864, 420, NULL, 'like'),
(865, 420, NULL, 'like'),
(866, 420, NULL, 'dislike'),
(867, 420, NULL, 'dislike'),
(868, 420, NULL, 'dislike'),
(869, 420, NULL, 'dislike'),
(870, 420, NULL, 'dislike'),
(871, 420, NULL, 'dislike'),
(872, 735, NULL, 'dislike'),
(873, 735, NULL, 'like'),
(874, 735, NULL, 'like'),
(875, 735, NULL, 'like'),
(876, 735, NULL, 'like'),
(877, 735, NULL, 'like'),
(878, 735, NULL, 'like'),
(879, 735, NULL, 'like'),
(880, 735, NULL, 'like'),
(881, 735, NULL, 'dislike'),
(882, 735, NULL, 'dislike'),
(883, 735, NULL, 'dislike'),
(884, 735, NULL, 'dislike'),
(885, 735, NULL, 'dislike'),
(886, 735, NULL, 'dislike'),
(887, 735, NULL, 'dislike'),
(888, 735, NULL, 'dislike'),
(889, 735, NULL, 'dislike'),
(890, 735, NULL, 'dislike'),
(891, 735, NULL, 'dislike'),
(892, 735, NULL, 'dislike'),
(893, 735, NULL, 'dislike'),
(894, 735, NULL, 'dislike'),
(895, 735, NULL, 'dislike'),
(896, 735, NULL, 'dislike'),
(897, 735, NULL, 'dislike'),
(898, 735, NULL, 'dislike'),
(899, 735, NULL, 'dislike'),
(900, 735, NULL, 'dislike'),
(901, 735, NULL, 'dislike'),
(902, 735, NULL, 'dislike'),
(903, 735, NULL, 'dislike'),
(904, 735, NULL, 'dislike'),
(905, 735, NULL, 'dislike'),
(906, 735, NULL, 'dislike'),
(907, 735, NULL, 'dislike'),
(908, 735, NULL, 'dislike');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `destinacije`
--
ALTER TABLE `destinacije`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idx_destinacija_id` (`ID`);

--
-- Indexes for table `komentari`
--
ALTER TABLE `komentari`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `kontakt`
--
ALTER TABLE `kontakt`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `reactions`
--
ALTER TABLE `reactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `destinacija_id` (`destinacija_id`,`korisnicko_ime`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `destinacije`
--
ALTER TABLE `destinacije`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1244;

--
-- AUTO_INCREMENT for table `komentari`
--
ALTER TABLE `komentari`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1055;

--
-- AUTO_INCREMENT for table `kontakt`
--
ALTER TABLE `kontakt`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `reactions`
--
ALTER TABLE `reactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=909;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reactions`
--
ALTER TABLE `reactions`
  ADD CONSTRAINT `reactions_ibfk_1` FOREIGN KEY (`destinacija_id`) REFERENCES `destinacije` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
