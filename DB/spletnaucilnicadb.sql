-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 03. jun 2016 ob 04.59
-- Različica strežnika: 10.1.10-MariaDB
-- Različica PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Zbirka podatkov: `spletnaucilnicadb`
--

-- --------------------------------------------------------

--
-- Struktura tabele `forum`
--

CREATE TABLE `forum` (
  `idTema` int(20) NOT NULL,
  `idPredmet` int(20) NOT NULL,
  `naslov` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `stObjave` int(20) NOT NULL,
  `besedilo` text COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `opravljanjepredmeta`
--

CREATE TABLE `opravljanjepredmeta` (
  `idOcena` int(20) NOT NULL,
  `idPredmet` int(20) NOT NULL,
  `idStudent` int(20) NOT NULL,
  `Ocena` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `opravljanjepredmeta`
--

INSERT INTO `opravljanjepredmeta` (`idOcena`, `idPredmet`, `idStudent`, `Ocena`) VALUES
(1, 1, 16, 0),
(2, 2, 16, 0),
(3, 3, 16, 0),
(4, 1, 17, 0),
(5, 2, 17, 0),
(6, 1, 16, 9),
(7, 1, 16, 7),
(8, 2, 16, 6),
(9, 3, 16, 10),
(10, 1, 17, 6),
(12, 3, 17, 0),
(13, 2, 19, 0);

-- --------------------------------------------------------

--
-- Struktura tabele `predmet`
--

CREATE TABLE `predmet` (
  `idPredmet` int(20) NOT NULL,
  `idProfesor` int(20) NOT NULL,
  `Opis` text COLLATE utf8_slovenian_ci NOT NULL,
  `Naslov` varchar(50) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `predmet`
--

INSERT INTO `predmet` (`idPredmet`, `idProfesor`, `Opis`, `Naslov`) VALUES
(1, 1, 'Tehnologije : HTML, CSS, PHP, JavaScript, jQuery, MySQL', 'Spletne tehnologije'),
(2, 1, 'Snov : Slovar, Disjunktne množice, Vrste s prednostjo, Razširjene podatkovne strukture, Deli in vladaj, Dinamično programiranje, Obdelava nestrukturiranih besedil, Grafi, Naključnost', 'Algoritmi in podatkovne strukture 2'),
(3, 2, 'UML, RUP, OOP, Scrum, PowerDesigner', 'Razvoj informacijskih sistemov');

-- --------------------------------------------------------

--
-- Struktura tabele `profesor`
--

CREATE TABLE `profesor` (
  `idProfesor` int(20) NOT NULL,
  `ime` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `priimek` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `datumRojstva` date NOT NULL,
  `naziv` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `geslo` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `profesor`
--

INSERT INTO `profesor` (`idProfesor`, `ime`, `priimek`, `datumRojstva`, `naziv`, `geslo`, `email`) VALUES
(1, 'Aleš', 'Horvat', '2016-06-16', 'Dr. računalništva in informatike', 'c5066d16144524a08f39352802701e8c', 'ah9381@profesor.si'),
(2, 'Peter', 'Zmeda', '2016-06-16', 'Dipl. Inž. Rač. in Inf.', 'cf2760bb8dce3b3db0eaa756f2bf444f', 'peterZmeda@profesor.si');

-- --------------------------------------------------------

--
-- Struktura tabele `snov`
--

CREATE TABLE `snov` (
  `idSnov` int(20) NOT NULL,
  `naslov` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `besedilo` text COLLATE utf8_slovenian_ci NOT NULL,
  `idPredmet` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `student`
--

CREATE TABLE `student` (
  `idStudent` int(20) NOT NULL,
  `ime` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `priimek` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `datumRojstva` date NOT NULL,
  `letnik` int(10) NOT NULL,
  `geslo` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `student`
--

INSERT INTO `student` (`idStudent`, `ime`, `priimek`, `datumRojstva`, `letnik`, `geslo`, `email`) VALUES
(16, 'Aleš', 'Horvat', '2016-06-16', 2, 'c5066d16144524a08f39352802701e8c', 'ah9381@student.uni-lj.si'),
(17, 'Peter', 'Zmeda', '2016-06-16', 1, 'cf2760bb8dce3b3db0eaa756f2bf444f', 'peterZmeda@student.uni-lj.si'),
(19, 'Student', 'FRI', '0000-00-00', 2, '995f200a8a985b8473b06b9ef05c0f1e', 'student@student.uni-lj.si');

-- --------------------------------------------------------

--
-- Struktura tabele `termin`
--

CREATE TABLE `termin` (
  `idTermin` int(20) NOT NULL,
  `cas` time NOT NULL,
  `dan` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `prostor` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `idPredmet` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `termin`
--

INSERT INTO `termin` (`idTermin`, `cas`, `dan`, `prostor`, `idPredmet`) VALUES
(1, '12:00:00', 'Sreda', 'P1', 1),
(2, '09:00:00', 'Ponedeljek', 'PA', 2),
(3, '10:00:00', 'Petek', 'P1', 3),
(4, '08:00:00', 'Četrtek', 'P1', 1),
(6, '08:00:00', 'Torek', 'PA', 9),
(7, '10:00:00', 'Torek', 'P9', 10);

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`idTema`);

--
-- Indeksi tabele `opravljanjepredmeta`
--
ALTER TABLE `opravljanjepredmeta`
  ADD PRIMARY KEY (`idOcena`),
  ADD KEY `FOREIGN_PREDMET` (`idPredmet`);

--
-- Indeksi tabele `predmet`
--
ALTER TABLE `predmet`
  ADD PRIMARY KEY (`idPredmet`),
  ADD KEY `Foreign` (`idProfesor`);

--
-- Indeksi tabele `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`idProfesor`);

--
-- Indeksi tabele `snov`
--
ALTER TABLE `snov`
  ADD PRIMARY KEY (`idSnov`);

--
-- Indeksi tabele `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`idStudent`);

--
-- Indeksi tabele `termin`
--
ALTER TABLE `termin`
  ADD PRIMARY KEY (`idTermin`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `forum`
--
ALTER TABLE `forum`
  MODIFY `idTema` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT tabele `opravljanjepredmeta`
--
ALTER TABLE `opravljanjepredmeta`
  MODIFY `idOcena` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT tabele `predmet`
--
ALTER TABLE `predmet`
  MODIFY `idPredmet` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT tabele `profesor`
--
ALTER TABLE `profesor`
  MODIFY `idProfesor` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT tabele `snov`
--
ALTER TABLE `snov`
  MODIFY `idSnov` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT tabele `student`
--
ALTER TABLE `student`
  MODIFY `idStudent` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT tabele `termin`
--
ALTER TABLE `termin`
  MODIFY `idTermin` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
