-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 25 Eki 2022, 09:05:28
-- Sunucu sürümü: 10.4.24-MariaDB
-- PHP Sürümü: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `egegen`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `prescription`
--

CREATE TABLE `prescription` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `prescription`
--

INSERT INTO `prescription` (`id`, `name`, `status`) VALUES
(1, 'debee23', 0),
(2, 'Mustafa UYSAL', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `prescription_ingredients`
--

CREATE TABLE `prescription_ingredients` (
  `id` int(11) NOT NULL,
  `prescription_id` int(11) DEFAULT NULL,
  `ing_pres_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `prescription_ingredients`
--

INSERT INTO `prescription_ingredients` (`id`, `prescription_id`, `ing_pres_id`) VALUES
(9, 1, 1),
(11, 2, 1),
(12, 2, 7);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`id`, `name`, `status`) VALUES
(1, 'Mustafa UYSAL', 1),
(7, 'deneme 2', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products_ingredients`
--

CREATE TABLE `products_ingredients` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `ing_product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `products_ingredients`
--

INSERT INTO `products_ingredients` (`id`, `product_id`, `ing_product_id`) VALUES
(4, 7, 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `prescription_ingredients`
--
ALTER TABLE `prescription_ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `products_ingredients`
--
ALTER TABLE `products_ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `prescription_ingredients`
--
ALTER TABLE `prescription_ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `products_ingredients`
--
ALTER TABLE `products_ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
