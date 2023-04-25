-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Ápr 25. 18:02
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `webshop`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `felhasznalo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `admin`
--

INSERT INTO `admin` (`admin_id`, `felhasznalo_id`) VALUES
(19, 1),
(15, 7);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo`
--

CREATE TABLE `felhasznalo` (
  `felhasznalo_id` int(11) NOT NULL,
  `nev` varchar(60) NOT NULL,
  `emailcim` varchar(60) NOT NULL,
  `jelszo` varchar(60) NOT NULL,
  `iranyitoszam` int(11) NOT NULL,
  `lakcim` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalo`
--

INSERT INTO `felhasznalo` (`felhasznalo_id`, `nev`, `emailcim`, `jelszo`, `iranyitoszam`, `lakcim`) VALUES
(1, 'Neuberger Gábor', 'gbneuberger@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 9228, 'Arany János 14'),
(7, 'asd', 'asd@asdd', 'asd', 1111, 'Arany János 14');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kosar`
--

CREATE TABLE `kosar` (
  `kosar_id` int(11) NOT NULL,
  `felhasznalo_id` int(11) NOT NULL,
  `termek_id` int(11) NOT NULL,
  `mennyiseg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `termek`
--

CREATE TABLE `termek` (
  `termekek_id` int(11) NOT NULL,
  `termek_nev` varchar(60) NOT NULL,
  `termek_tipus` int(11) NOT NULL,
  `termek_ar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `termek`
--

INSERT INTO `termek` (`termekek_id`, `termek_nev`, `termek_tipus`, `termek_ar`) VALUES
(3, 'Kukorica', 3, 1500),
(4, 'Alma', 5, 1200),
(5, 'Korte', 5, 1100),
(6, 'Repa', 7, 600),
(7, 'Borso', 7, 870),
(9, 'Kender', 1, 2000),
(10, 'Gránát Alma', 5, 1600);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `termek_tipus`
--

CREATE TABLE `termek_tipus` (
  `termek_tipus_id` int(11) NOT NULL,
  `tipus` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `termek_tipus`
--

INSERT INTO `termek_tipus` (`termek_tipus_id`, `tipus`) VALUES
(1, 'Gabona_felek'),
(3, 'Veto_mag'),
(5, 'Gyumolcs'),
(7, 'Zoldseg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tranzakcio`
--

CREATE TABLE `tranzakcio` (
  `tranzakcio_id` int(11) NOT NULL,
  `felhasznalo_id` int(11) NOT NULL,
  `termek_id` int(11) NOT NULL,
  `mennyiseg` int(11) NOT NULL,
  `vasralas_ido` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `felhasznalo_id_2` (`felhasznalo_id`);

--
-- A tábla indexei `felhasznalo`
--
ALTER TABLE `felhasznalo`
  ADD PRIMARY KEY (`felhasznalo_id`);

--
-- A tábla indexei `kosar`
--
ALTER TABLE `kosar`
  ADD PRIMARY KEY (`kosar_id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`),
  ADD KEY `termek_id` (`termek_id`);

--
-- A tábla indexei `termek`
--
ALTER TABLE `termek`
  ADD PRIMARY KEY (`termekek_id`),
  ADD KEY `termek_tipus` (`termek_tipus`);

--
-- A tábla indexei `termek_tipus`
--
ALTER TABLE `termek_tipus`
  ADD PRIMARY KEY (`termek_tipus_id`);

--
-- A tábla indexei `tranzakcio`
--
ALTER TABLE `tranzakcio`
  ADD PRIMARY KEY (`tranzakcio_id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`,`termek_id`),
  ADD KEY `termek_id` (`termek_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT a táblához `felhasznalo`
--
ALTER TABLE `felhasznalo`
  MODIFY `felhasznalo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `kosar`
--
ALTER TABLE `kosar`
  MODIFY `kosar_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `termek`
--
ALTER TABLE `termek`
  MODIFY `termekek_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `termek_tipus`
--
ALTER TABLE `termek_tipus`
  MODIFY `termek_tipus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `tranzakcio`
--
ALTER TABLE `tranzakcio`
  MODIFY `tranzakcio_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalo` (`felhasznalo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `kosar`
--
ALTER TABLE `kosar`
  ADD CONSTRAINT `kosar_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalo` (`felhasznalo_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kosar_ibfk_2` FOREIGN KEY (`termek_id`) REFERENCES `termek` (`termekek_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `termek`
--
ALTER TABLE `termek`
  ADD CONSTRAINT `termek_ibfk_1` FOREIGN KEY (`termek_tipus`) REFERENCES `termek_tipus` (`termek_tipus_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `tranzakcio`
--
ALTER TABLE `tranzakcio`
  ADD CONSTRAINT `tranzakcio_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalo` (`felhasznalo_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tranzakcio_ibfk_2` FOREIGN KEY (`termek_id`) REFERENCES `termek` (`termekek_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
