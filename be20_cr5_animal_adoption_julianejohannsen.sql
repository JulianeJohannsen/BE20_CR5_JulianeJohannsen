-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 25. Nov 2023 um 17:40
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `be20_cr5_animal_adoption_julianejohannsen`
--
CREATE DATABASE IF NOT EXISTS `be20_cr5_animal_adoption_julianejohannsen` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `be20_cr5_animal_adoption_julianejohannsen`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` varchar(400) DEFAULT NULL,
  `size` varchar(10) NOT NULL,
  `age` int(11) NOT NULL,
  `species` varchar(25) NOT NULL,
  `breed` varchar(25) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `vaccinated` tinyint(4) NOT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `animals`
--

INSERT INTO `animals` (`id`, `name`, `location`, `description`, `size`, `age`, `species`, `breed`, `status`, `vaccinated`, `picture`) VALUES
(1, 'Snoop', 'Regensburger Str. 1, 81492 Bad Kebin', 'Snoop loves to play fetch and chase balls, so he is always up for a good game of fetch.', 'medium', 6, 'Dog', 'Labrador', 0, 1, '6560f15f5dd7f.jpg'),
(2, 'Ellie', 'Im Eisholz 87a, 24190 Krausestadt', 'Ellie loves to be petted and snuggled up with her owners.', 'Small', 9, 'Cat', '', 0, 1, '65612b92f2f09.jpg'),
(3, 'Tracker', 'Arnold-Ohletz-Str. 47c, 17306 Jessyburg', 'Tracker is a very loyal pet and is always happy to be around his family members.', 'Small', 2, 'Ferret', '', 1, 1, '6561f266307ed.jpg'),
(4, 'Curly', 'Höfer Mühle 73c, 22137 Loschfeld', 'Curly is a great addition to any family and is sure to bring a lot of joy and laughter into your home. Please always keep guinea pigs at least in pairs!', 'Very small', 2, 'Guinea Pig', 'long-haired guinea pig', 0, 1, '6561f38a83038.jpg'),
(5, 'Chivas', 'Brandenburger Str. 43, 95531 Joybrunn', 'Chivas is a great companion and loves to go on walks and explore new places.', 'Very big', 9, 'Alpaca', '', 1, 1, '6561f49dbc198.jpg'),
(6, 'Flint', 'A.-W.-v.-Hofmann-Str. 24, 16817 Griesebrunn', 'Flint is always eager to make new friends and will happily greet anyone.', 'Very small', 7, 'Bird', 'Hyacinth macaw', 1, 1, '6561f5db55b43.jpg'),
(7, 'Puffy', 'Hüscheider Gärten 23, 62777 Schlechtwegdorf', 'Puffy loves to chase mice.', 'Small', 10, 'Cat', 'Persian', 1, 1, '6561f6c2ca310.jpg'),
(8, 'Figaro', 'Borussiastr. 4, 13599 Mareikefeld', 'Figaro brings a lot of joy and laughter into your home.', 'Very small', 10, 'Bird', 'Sulphur-crested cockatoo', 1, 1, '6561f9817b95b.jpg'),
(9, 'Jackpot', 'Johannes-Baptist-Str. 56b, 75316 Nussbeckhagen', 'Jackpot is an active dog and loves to be taken for hikes and other outdoor activities.', 'Small', 5, 'Dog', 'Jack Russel Terrier', 1, 1, '6561f8cf1e277.jpg'),
(10, 'Charisma', 'Völklinger Str. 17, 23720 Nicolaygrün', '', 'Very small', 9, 'Lizard', 'Bearded dragon', 1, 1, '6561fa65ac924.jpg'),
(11, 'Flake', 'Moosweg 68, 67078 Kisabrunn', 'Flake loves to be petted and snuggled up with her owners.', 'Very small', 1, 'Hamster', '', 1, 1, '6561fb1660cec.jpg'),
(12, 'Brittany', 'Dünnwalder Grenzweg 1, 72865 Luanberg', 'Brittany is an exceptionally friendly donkey and loves to meet new people.', 'Very big', 11, 'Donkey', '', 1, 1, '6561fbe7c9dc4.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `zip` int(11) NOT NULL,
  `city` varchar(25) NOT NULL,
  `street` varchar(50) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `pass`, `phone`, `zip`, `city`, `street`, `picture`, `status`) VALUES
(1, 'John', 'Doe', 'john@email.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '+4312345', 1010, 'Vienna', 'Herrengasse 12', '6560aad4b590a.jpg', 'user'),
(2, 'Jane', 'Doe', 'jane@email.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '+43123456', 1140, 'Vienna', 'Dehnegasse 5', '65609ab907680.jpg', 'adm'),
(3, 'Jason', 'Doe', 'jason@email.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '+431234567', 1130, 'Vienna', 'Auhofstraße 63', 'avatar.png', 'user');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_pet`
--

CREATE TABLE `user_pet` (
  `id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `fk_pet_id` int(11) NOT NULL,
  `adopt_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `user_pet`
--

INSERT INTO `user_pet` (`id`, `fk_user_id`, `fk_pet_id`, `adopt_date`) VALUES
(1, 1, 1, '2023-11-24 22:53:23'),
(2, 1, 2, '2023-11-24 23:04:22'),
(3, 3, 4, '2023-11-25 14:42:43');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user_pet`
--
ALTER TABLE `user_pet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`fk_user_id`),
  ADD KEY `fk_pet_id` (`fk_pet_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `user_pet`
--
ALTER TABLE `user_pet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `user_pet`
--
ALTER TABLE `user_pet`
  ADD CONSTRAINT `user_pet_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_pet_ibfk_2` FOREIGN KEY (`fk_pet_id`) REFERENCES `animals` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
