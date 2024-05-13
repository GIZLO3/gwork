-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 13, 2024 at 09:51 PM
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
-- Struktura tabeli dla tabeli `aplikacja`
--

CREATE TABLE `aplikacja` (
  `aplikacja_id` int(11) NOT NULL,
  `uzytkownik_id` int(11) NOT NULL,
  `ogloszenie_id` int(11) NOT NULL,
  `status_aplikacji_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aplikacja`
--

INSERT INTO `aplikacja` (`aplikacja_id`, `uzytkownik_id`, `ogloszenie_id`, `status_aplikacji_id`) VALUES
(5, 1, 3, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `firma`
--

CREATE TABLE `firma` (
  `firma_id` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL,
  `logo` text NOT NULL,
  `nip` varchar(10) NOT NULL,
  `adres` varchar(255) NOT NULL,
  `kod_pocztowy` varchar(6) NOT NULL,
  `miasto` varchar(100) NOT NULL,
  `telefon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `firma`
--

INSERT INTO `firma` (`firma_id`, `nazwa`, `logo`, `nip`, `adres`, `kod_pocztowy`, `miasto`, `telefon`) VALUES
(8, 'Sieć Badawcza Łukasiewicz - Instytut Lotnictwa', '/img/4x.webp', '9372667797', 'Legionów 26/28', '43-300', 'Bielsko-Biała', '555555554');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategoria`
--

CREATE TABLE `kategoria` (
  `kategoria_id` int(11) NOT NULL,
  `kategoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategoria`
--

INSERT INTO `kategoria` (`kategoria_id`, `kategoria`) VALUES
(1, 'IT'),
(2, 'Inżynieria'),
(3, 'Marketing'),
(4, 'Prawo');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ogloszenie`
--

CREATE TABLE `ogloszenie` (
  `ogloszenie_id` int(11) NOT NULL,
  `firma_id` int(11) NOT NULL,
  `stanowisko` varchar(300) NOT NULL,
  `waznosc` date NOT NULL,
  `ogloszenie_adres` varchar(200) NOT NULL,
  `ogloszenie_kod_pocztowy` varchar(200) NOT NULL,
  `ogloszenie_miasto` varchar(200) NOT NULL,
  `wynagrodzenie_od` decimal(11,2) NOT NULL,
  `wynagrodzenie_do` decimal(11,2) NOT NULL,
  `kategoria_id` int(11) NOT NULL,
  `rodzaj_umowy_id` int(11) NOT NULL,
  `poziom_stanowiska_id` int(11) NOT NULL,
  `wymiar_pracy_id` int(11) NOT NULL,
  `tryb_pracy_id` int(11) NOT NULL,
  `obowiazki` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`obowiazki`)),
  `wymagania` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`wymagania`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ogloszenie`
--

INSERT INTO `ogloszenie` (`ogloszenie_id`, `firma_id`, `stanowisko`, `waznosc`, `ogloszenie_adres`, `ogloszenie_kod_pocztowy`, `ogloszenie_miasto`, `wynagrodzenie_od`, `wynagrodzenie_do`, `kategoria_id`, `rodzaj_umowy_id`, `poziom_stanowiska_id`, `wymiar_pracy_id`, `tryb_pracy_id`, `obowiazki`, `wymagania`) VALUES
(1, 8, 'Młodszy Inżynier/Inżynier - Konstruktor Części Silnika Lotniczego', '2024-05-24', 'Aleja Krakowska 110/114', '34-600', '', 5555.00, 6666.00, 4, 5, 9, 2, 3, '[]', '[]'),
(2, 8, 'dwa', '2024-05-26', 'dwa', '34-600', 'fdgd', 0.05, 200.50, 4, 2, 3, 1, 3, '[]', '[]'),
(3, 8, 'trzy', '2024-05-26', 'dwa', '34-600', 'fdgd', 2400.00, 5500.00, 1, 1, 3, 3, 2, '[\"obowiazek 1\"]', '[\"wymaganie 1\"]');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `poziom_stanowiska`
--

CREATE TABLE `poziom_stanowiska` (
  `poziom_stanowiska_id` int(11) NOT NULL,
  `poziom_stanowiska` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poziom_stanowiska`
--

INSERT INTO `poziom_stanowiska` (`poziom_stanowiska_id`, `poziom_stanowiska`) VALUES
(1, 'Praktykant / stażysta'),
(2, 'Asystent'),
(3, 'Młodszy specjalista (Junior)'),
(4, 'Specjalista (Mid / Regular)'),
(5, 'Starszy specjalista (Senior)'),
(6, 'Ekspert'),
(7, 'Kierownik / koordynator'),
(8, 'Menedżer'),
(9, 'Dyrektor'),
(10, 'Prezes'),
(11, 'Pracownik fizyczny');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rodzaj_umowy`
--

CREATE TABLE `rodzaj_umowy` (
  `rodzaj_umowy_id` int(11) NOT NULL,
  `rodzaj_umowy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rodzaj_umowy`
--

INSERT INTO `rodzaj_umowy` (`rodzaj_umowy_id`, `rodzaj_umowy`) VALUES
(1, 'Umowa o pracę'),
(2, 'Umowa o dzieło'),
(3, 'Umowa zlecenie'),
(4, 'Kontrakt B2B'),
(5, 'Umowa na zastępstwo'),
(6, 'Umowa agregacyjna'),
(7, 'Umowa o pracę tymczasową'),
(8, 'Umowa o staż / praktyki');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `status_aplikacji`
--

CREATE TABLE `status_aplikacji` (
  `status_aplikacji_id` int(11) NOT NULL,
  `status_aplikacji` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_aplikacji`
--

INSERT INTO `status_aplikacji` (`status_aplikacji_id`, `status_aplikacji`) VALUES
(1, 'oczekuje'),
(2, 'odrzucona'),
(3, 'zaakceptowana');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tryb_pracy`
--

CREATE TABLE `tryb_pracy` (
  `tryb_pracy_id` int(11) NOT NULL,
  `tryb_pracy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tryb_pracy`
--

INSERT INTO `tryb_pracy` (`tryb_pracy_id`, `tryb_pracy`) VALUES
(1, 'Stacjonarna'),
(2, 'Hybrydowa'),
(3, 'Zdalna'),
(4, 'Mobilna');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `uzytkownik_id` int(11) NOT NULL,
  `login` varchar(25) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `email` varchar(320) NOT NULL,
  `informacje_id` int(11) DEFAULT NULL,
  `firma_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownik`
--

INSERT INTO `uzytkownik` (`uzytkownik_id`, `login`, `haslo`, `email`, `informacje_id`, `firma_id`) VALUES
(1, 'gizlo3', '$2y$10$2pb7vQZi1crPwUOmvbo6fe/wzA2EfEep.vI17DGL77vhPqzL4DITO', 'michalgiza8b@gmail.com', 2, NULL),
(11, 'firma', '$2y$10$jmGzUbxO6Smj27zLvE8YzOrH2uK.NAPY7ufWB6KTqRQP.1i84DvOu', 'firma@gmail.com', NULL, 8);

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
  `zdjecie_profilowe` varchar(300) NOT NULL DEFAULT '/img/blank_profile_picture.png',
  `stanowisko_pracy` varchar(200) DEFAULT NULL,
  `podsumowanie_zawodowe` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '[]',
  `doswiadczenie_zawodowe` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '[]',
  `jezyki` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '[]',
  `umiejetnosci` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '[]',
  `kursy` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownik_informacje`
--

INSERT INTO `uzytkownik_informacje` (`informacje_id`, `imie`, `nazwisko`, `numer_telefonu`, `data_urodzenia`, `adres`, `kod_pocztowy`, `miasto`, `zdjecie_profilowe`, `stanowisko_pracy`, `podsumowanie_zawodowe`, `doswiadczenie_zawodowe`, `jezyki`, `umiejetnosci`, `kursy`) VALUES
(2, 'Michał', 'Giza', '666666666', '2024-04-09', 'ty', '34-600', 'fdgd', '/img/Bez tytułu.png', 'fghfhf', '[\"Zaw\"]', '[\"do\"]', '[\"je\"]', '[\"umn\"]', '[\"kur\"]');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wymiar_pracy`
--

CREATE TABLE `wymiar_pracy` (
  `wymiar_pracy_id` int(11) NOT NULL,
  `wymiar_pracy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wymiar_pracy`
--

INSERT INTO `wymiar_pracy` (`wymiar_pracy_id`, `wymiar_pracy`) VALUES
(1, 'Część etatu'),
(2, 'Dodatkowa / tymczasowa'),
(3, 'Pełny etat');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `aplikacja`
--
ALTER TABLE `aplikacja`
  ADD PRIMARY KEY (`aplikacja_id`),
  ADD KEY `uzytkownik_id` (`uzytkownik_id`),
  ADD KEY `ogloszenie_id` (`ogloszenie_id`);

--
-- Indeksy dla tabeli `firma`
--
ALTER TABLE `firma`
  ADD PRIMARY KEY (`firma_id`);

--
-- Indeksy dla tabeli `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`kategoria_id`);

--
-- Indeksy dla tabeli `ogloszenie`
--
ALTER TABLE `ogloszenie`
  ADD PRIMARY KEY (`ogloszenie_id`),
  ADD KEY `firma_id` (`firma_id`),
  ADD KEY `rodzaj_umowy_id` (`rodzaj_umowy_id`),
  ADD KEY `poziom_stanowiska_id` (`poziom_stanowiska_id`),
  ADD KEY `wymiar_pracy_id` (`wymiar_pracy_id`),
  ADD KEY `tryb_pracy_id` (`tryb_pracy_id`),
  ADD KEY `kategoria_id` (`kategoria_id`);

--
-- Indeksy dla tabeli `poziom_stanowiska`
--
ALTER TABLE `poziom_stanowiska`
  ADD PRIMARY KEY (`poziom_stanowiska_id`);

--
-- Indeksy dla tabeli `rodzaj_umowy`
--
ALTER TABLE `rodzaj_umowy`
  ADD PRIMARY KEY (`rodzaj_umowy_id`);

--
-- Indeksy dla tabeli `status_aplikacji`
--
ALTER TABLE `status_aplikacji`
  ADD PRIMARY KEY (`status_aplikacji_id`);

--
-- Indeksy dla tabeli `tryb_pracy`
--
ALTER TABLE `tryb_pracy`
  ADD PRIMARY KEY (`tryb_pracy_id`);

--
-- Indeksy dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`uzytkownik_id`),
  ADD KEY `informacje_id` (`informacje_id`),
  ADD KEY `firma_id` (`firma_id`);

--
-- Indeksy dla tabeli `uzytkownik_informacje`
--
ALTER TABLE `uzytkownik_informacje`
  ADD PRIMARY KEY (`informacje_id`);

--
-- Indeksy dla tabeli `wymiar_pracy`
--
ALTER TABLE `wymiar_pracy`
  ADD PRIMARY KEY (`wymiar_pracy_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aplikacja`
--
ALTER TABLE `aplikacja`
  MODIFY `aplikacja_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `firma`
--
ALTER TABLE `firma`
  MODIFY `firma_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `kategoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ogloszenie`
--
ALTER TABLE `ogloszenie`
  MODIFY `ogloszenie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `poziom_stanowiska`
--
ALTER TABLE `poziom_stanowiska`
  MODIFY `poziom_stanowiska_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rodzaj_umowy`
--
ALTER TABLE `rodzaj_umowy`
  MODIFY `rodzaj_umowy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `status_aplikacji`
--
ALTER TABLE `status_aplikacji`
  MODIFY `status_aplikacji_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tryb_pracy`
--
ALTER TABLE `tryb_pracy`
  MODIFY `tryb_pracy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `uzytkownik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `uzytkownik_informacje`
--
ALTER TABLE `uzytkownik_informacje`
  MODIFY `informacje_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wymiar_pracy`
--
ALTER TABLE `wymiar_pracy`
  MODIFY `wymiar_pracy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aplikacja`
--
ALTER TABLE `aplikacja`
  ADD CONSTRAINT `aplikacja_ibfk_1` FOREIGN KEY (`ogloszenie_id`) REFERENCES `ogloszenie` (`ogloszenie_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aplikacja_ibfk_2` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownik` (`uzytkownik_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ogloszenie`
--
ALTER TABLE `ogloszenie`
  ADD CONSTRAINT `ogloszenie_ibfk_1` FOREIGN KEY (`firma_id`) REFERENCES `firma` (`firma_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ogloszenie_ibfk_2` FOREIGN KEY (`wymiar_pracy_id`) REFERENCES `wymiar_pracy` (`wymiar_pracy_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ogloszenie_ibfk_3` FOREIGN KEY (`kategoria_id`) REFERENCES `kategoria` (`kategoria_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ogloszenie_ibfk_4` FOREIGN KEY (`tryb_pracy_id`) REFERENCES `tryb_pracy` (`tryb_pracy_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ogloszenie_ibfk_5` FOREIGN KEY (`poziom_stanowiska_id`) REFERENCES `poziom_stanowiska` (`poziom_stanowiska_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ogloszenie_ibfk_6` FOREIGN KEY (`rodzaj_umowy_id`) REFERENCES `rodzaj_umowy` (`rodzaj_umowy_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD CONSTRAINT `uzytkownik_ibfk_1` FOREIGN KEY (`informacje_id`) REFERENCES `uzytkownik_informacje` (`informacje_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uzytkownik_ibfk_2` FOREIGN KEY (`firma_id`) REFERENCES `firma` (`firma_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
