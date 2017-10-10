-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Gegenereerd op: 10 okt 2017 om 13:13
-- Serverversie: 5.7.19-0ubuntu0.16.04.1
-- PHP-versie: 7.0.22-0ubuntu0.16.04.1

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

--
-- Gegevens worden geëxporteerd voor tabel `locatie`
--

INSERT INTO `locatie` (`id`, `naam`) VALUES
(1, 'Hasselt'),
(2, 'Antwerpen');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `probleemmelding`
--

CREATE TABLE `probleemmelding` (
  `id` int(11) NOT NULL,
  `locatieid` int(11) NOT NULL,
  `probleem` varchar(45) NOT NULL,
  `datum` date NOT NULL,
  `afgehandeld` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `probleemmelding`
--

INSERT INTO `probleemmelding` (`id`, `locatieid`, `probleem`, `datum`, `afgehandeld`) VALUES
(1, 1, 'WC kapot', '2017-10-15', 0);

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
-- Gegevens worden geëxporteerd voor tabel `statusmelding`
--

INSERT INTO `statusmelding` (`id`, `locatieid`, `status`, `datum`) VALUES
(1, 1, 'Goed', '2017-10-10');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `locatie`
--
ALTER TABLE `locatie`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `probleemmelding`
--
ALTER TABLE `probleemmelding`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `locatieid` (`locatieid`);

--
-- Indexen voor tabel `statusmelding`
--
ALTER TABLE `statusmelding`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `locatie`
--
ALTER TABLE `locatie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `probleemmelding`
--
ALTER TABLE `probleemmelding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `statusmelding`
--
ALTER TABLE `statusmelding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
