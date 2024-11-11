-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11.11.2024 klo 13:27
-- Palvelimen versio: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kurssienhallinta`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `kurssikirjautuminen`
--

CREATE TABLE `kurssikirjautuminen` (
  `Tunnus` int(11) NOT NULL,
  `Opiskelija` varchar(255) NOT NULL,
  `Kurssi` varchar(255) NOT NULL,
  `Kirjautumispäivä ja -aika` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Rakenne taululle `kurssit`
--

CREATE TABLE `kurssit` (
  `Tunnus` int(11) NOT NULL,
  `Nimi` varchar(255) NOT NULL,
  `Kuvaus` varchar(255) NOT NULL,
  `Alkupäivä` date NOT NULL,
  `Loppupäivä` date NOT NULL,
  `Opettaja` int(11) NOT NULL,
  `Tila` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `kurssit`
--

INSERT INTO `kurssit` (`Tunnus`, `Nimi`, `Kuvaus`, `Alkupäivä`, `Loppupäivä`, `Opettaja`, `Tila`) VALUES
(3, 'Elämän koulu', 'Kyllä siihe tottu ku sitä joutuu ottaa pottuu', '2024-11-01', '2024-11-22', 1, 1),
(4, 'ARabic industry', 'Jahvad hasmad gahbul rjhaid brhjyd jahmad', '2024-11-08', '2024-11-18', 2, 2);

-- --------------------------------------------------------

--
-- Rakenne taululle `opettajat`
--

CREATE TABLE `opettajat` (
  `Tunnusnumero` int(11) NOT NULL,
  `Etunimi` varchar(255) NOT NULL,
  `Sukunimi` varchar(255) NOT NULL,
  `Aine` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `opettajat`
--

INSERT INTO `opettajat` (`Tunnusnumero`, `Etunimi`, `Sukunimi`, `Aine`) VALUES
(1, 'Jouni', 'Koivukangass', 'Elämän koulu'),
(2, 'Tuukka', 'Toovan', 'Arabic industry');

-- --------------------------------------------------------

--
-- Rakenne taululle `opiskelijat`
--

CREATE TABLE `opiskelijat` (
  `Opiskelijanumero` int(11) NOT NULL,
  `Etunimi` varchar(255) NOT NULL,
  `Sukunimi` varchar(255) NOT NULL,
  `Syntymäpäivä` date NOT NULL,
  `Vuosikurssi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `opiskelijat`
--

INSERT INTO `opiskelijat` (`Opiskelijanumero`, `Etunimi`, `Sukunimi`, `Syntymäpäivä`, `Vuosikurssi`) VALUES
(1, 'Janttu', 'Jahvar', '2024-11-20', 2),
(2, 'Janttufsafsaf', 'Jahvarssda', '2024-11-20', 2),
(3, 'Marianne', 'Leskinen', '2015-11-06', 1),
(4, 'Annemaria', 'Johanneksenpoika', '2005-11-10', 3);

-- --------------------------------------------------------

--
-- Rakenne taululle `tilat`
--

CREATE TABLE `tilat` (
  `Tunnus` int(11) NOT NULL,
  `Nimi` varchar(255) NOT NULL,
  `Kapasiteetti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `tilat`
--

INSERT INTO `tilat` (`Tunnus`, `Nimi`, `Kapasiteetti`) VALUES
(1, 'A301', 12),
(2, 'A302', 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kurssikirjautuminen`
--
ALTER TABLE `kurssikirjautuminen`
  ADD PRIMARY KEY (`Tunnus`);

--
-- Indexes for table `kurssit`
--
ALTER TABLE `kurssit`
  ADD PRIMARY KEY (`Tunnus`),
  ADD KEY `Opettaja` (`Opettaja`),
  ADD KEY `Tila` (`Tila`);

--
-- Indexes for table `opettajat`
--
ALTER TABLE `opettajat`
  ADD PRIMARY KEY (`Tunnusnumero`);

--
-- Indexes for table `opiskelijat`
--
ALTER TABLE `opiskelijat`
  ADD PRIMARY KEY (`Opiskelijanumero`);

--
-- Indexes for table `tilat`
--
ALTER TABLE `tilat`
  ADD PRIMARY KEY (`Tunnus`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kurssikirjautuminen`
--
ALTER TABLE `kurssikirjautuminen`
  MODIFY `Tunnus` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kurssit`
--
ALTER TABLE `kurssit`
  MODIFY `Tunnus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `opettajat`
--
ALTER TABLE `opettajat`
  MODIFY `Tunnusnumero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `opiskelijat`
--
ALTER TABLE `opiskelijat`
  MODIFY `Opiskelijanumero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tilat`
--
ALTER TABLE `tilat`
  MODIFY `Tunnus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Rajoitteet vedostauluille
--

--
-- Rajoitteet taululle `kurssit`
--
ALTER TABLE `kurssit`
  ADD CONSTRAINT `kurssit_ibfk_1` FOREIGN KEY (`Opettaja`) REFERENCES `opettajat` (`Tunnusnumero`),
  ADD CONSTRAINT `kurssit_ibfk_2` FOREIGN KEY (`Tila`) REFERENCES `tilat` (`tunnus`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
