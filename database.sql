-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 29 sep 2017 om 09:26
-- Serverversie: 10.1.21-MariaDB
-- PHP-versie: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web-project3tin`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `locatie`
--

CREATE TABLE `locatie` (
  `id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `probleemMelding`
--

CREATE TABLE `probleemmelding` (
  `id` int(11) NOT NULL,
  `locatieid` int(11) NOT NULL,
  `probleem` varchar(45) NOT NULL,
  `datum` date NOT NULL,
  `afgehandeld` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `statusmelding`
--

CREATE TABLE `statusmelding` (
  `id` int(11) NOT NULL,
  `locatieid` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexen voor ge�xporteerde tabellen
--

--
-- Indexen voor tabel `locatie`
--
ALTER TABLE `locatie`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `probleemMelding`
--
ALTER TABLE `probleemmelding`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `statusmelding`
--
ALTER TABLE `statusmelding`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor ge�xporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `locatie`
--
ALTER TABLE `locatie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `probleemMelding`
--
ALTER TABLE `probleemmelding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `statusmelding`
--
ALTER TABLE `statusmelding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
