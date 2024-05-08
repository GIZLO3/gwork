-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2024 at 08:55 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gwork`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `firma`
--

CREATE TABLE `firma` (
  `firma_id` int(11) NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `logo` text NOT NULL,
  `NIP` varchar(10) NOT NULL,
  `ulica` varchar(100) NOT NULL,
  `kod_pocztowy` varchar(6) NOT NULL,
  `miasto` varchar(100) NOT NULL,
  `telefon` varchar(15) NOT NULL,
  `uzytkownik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ogloszenie`
--

CREATE TABLE `ogloszenie` (
  `ogloszenie_id` int(11) NOT NULL,
  `stanowisko` varchar(150) NOT NULL,
  `firma_id` int(11) NOT NULL,
  `wynagrodzenie` decimal(9,2) NOT NULL,
  `atrybuty` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`atrybuty`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `uzytkownik_id` int(11) NOT NULL,
  `login` varchar(25) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `email` varchar(320) NOT NULL,
  `informacje_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownik`
--

INSERT INTO `uzytkownik` (`uzytkownik_id`, `login`, `haslo`, `email`, `informacje_id`) VALUES
(1, 'gizlo3', '$2y$10$ojlFlQ38T7vNarDKl8O4pO30i5kjoUwafK4p0iJcG1uZAFhlDNWX.', 'michal_giza@o2.pl', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik_informacje`
--

CREATE TABLE `uzytkownik_informacje` (
  `informacje_id` int(11) NOT NULL,
  `imie` varchar(100) DEFAULT NULL,
  `nazwisko` varchar(150) DEFAULT NULL,
  `numer_telefonu` varchar(13) DEFAULT NULL,
  `data_urodzenia` date DEFAULT NULL,
  `adres` varchar(255) DEFAULT NULL,
  `kod_pocztowy` varchar(6) DEFAULT NULL,
  `miasto` varchar(300) DEFAULT NULL,
  `stanowisko_pracy` varchar(200) DEFAULT NULL,
  `podsumowanie_zawodowe` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownik_informacje`
--

INSERT INTO `uzytkownik_informacje` (`informacje_id`, `imie`, `nazwisko`, `numer_telefonu`, `data_urodzenia`, `adres`, `kod_pocztowy`, `miasto`, `stanowisko_pracy`, `podsumowanie_zawodowe`) VALUES
(2, 'Michał', 'Giza', '666666666', '2024-04-09', 'ty', '34-600', 'fdgd', 'fghfhf', '[]');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `firma`
--
ALTER TABLE `firma`
  ADD PRIMARY KEY (`firma_id`),
  ADD KEY `uzytkownik_id` (`uzytkownik_id`);

--
-- Indeksy dla tabeli `ogloszenie`
--
ALTER TABLE `ogloszenie`
  ADD PRIMARY KEY (`ogloszenie_id`),
  ADD KEY `firma_id` (`firma_id`);

--
-- Indeksy dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`uzytkownik_id`),
  ADD KEY `informacje_id` (`informacje_id`);

--
-- Indeksy dla tabeli `uzytkownik_informacje`
--
ALTER TABLE `uzytkownik_informacje`
  ADD PRIMARY KEY (`informacje_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `firma`
--
ALTER TABLE `firma`
  MODIFY `firma_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ogloszenie`
--
ALTER TABLE `ogloszenie`
  MODIFY `ogloszenie_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `uzytkownik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `uzytkownik_informacje`
--
ALTER TABLE `uzytkownik_informacje`
  MODIFY `informacje_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `firma`
--
ALTER TABLE `firma`
  ADD CONSTRAINT `firma_ibfk_1` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownik` (`uzytkownik_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ogloszenie`
--
ALTER TABLE `ogloszenie`
  ADD CONSTRAINT `ogloszenie_ibfk_1` FOREIGN KEY (`firma_id`) REFERENCES `firma` (`firma_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD CONSTRAINT `uzytkownik_ibfk_1` FOREIGN KEY (`informacje_id`) REFERENCES `uzytkownik_informacje` (`informacje_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
