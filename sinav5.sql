-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 24 Oca 2020, 20:40:36
-- Sunucu sürümü: 5.6.24
-- PHP Sürümü: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `sinav5`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `anket`
--

CREATE TABLE IF NOT EXISTS `anket` (
  `id` int(11) NOT NULL,
  `ad` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `s` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `c1` varchar(400) COLLATE utf8_turkish_ci NOT NULL,
  `c2` varchar(400) COLLATE utf8_turkish_ci NOT NULL,
  `c3` varchar(400) COLLATE utf8_turkish_ci NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `anket`
--

INSERT INTO `anket` (`id`, `ad`, `s`, `c1`, `c2`, `c3`, `tarih`) VALUES
(1, 'asuman', 'asuman', 'iphone', 'samsung', 'huweÄ±', '2019-06-19 08:54:59');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `begen`
--

CREATE TABLE IF NOT EXISTS `begen` (
  `id` int(11) NOT NULL,
  `ad` varchar(400) COLLATE utf8_turkish_ci NOT NULL,
  `gonderi_id` int(11) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `begen`
--

INSERT INTO `begen` (`id`, `ad`, `gonderi_id`, `tarih`) VALUES
(4, 'asuman', 1, '2019-06-19 08:14:20'),
(7, 'busra', 1, '2019-06-19 08:24:02');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cevap`
--

CREATE TABLE IF NOT EXISTS `cevap` (
  `id` int(11) NOT NULL,
  `ad` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `anketid` int(11) NOT NULL,
  `c` varchar(400) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `cevap`
--

INSERT INTO `cevap` (`id`, `ad`, `anketid`, `c`) VALUES
(3, 'asuman', 1, 'samsung'),
(4, 'asuman', 1, 'huweÄ±'),
(5, 'asuman', 1, 'iphone');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `gonderi`
--

CREATE TABLE IF NOT EXISTS `gonderi` (
  `id` int(11) NOT NULL,
  `ad` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `gonderi` varchar(400) COLLATE utf8_turkish_ci NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `gonderi`
--

INSERT INTO `gonderi` (`id`, `ad`, `gonderi`, `tarih`) VALUES
(1, 'asuman', 'selam', '2019-06-19 07:44:41');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kisi`
--

CREATE TABLE IF NOT EXISTS `kisi` (
  `id` int(11) NOT NULL,
  `ad` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(100) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kisi`
--

INSERT INTO `kisi` (`id`, `ad`, `sifre`) VALUES
(1, 'asuman', '1'),
(2, 'busra', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorum`
--

CREATE TABLE IF NOT EXISTS `yorum` (
  `id` int(11) NOT NULL,
  `ad` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `gonderi_id` int(11) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `yorum` varchar(400) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yorum`
--

INSERT INTO `yorum` (`id`, `ad`, `gonderi_id`, `tarih`, `yorum`) VALUES
(0, 'asuman', 1, '2019-06-19 08:18:20', 'asdfgrth'),
(0, 'asuman', 1, '2019-06-19 08:21:12', 'aszsetdryty'),
(0, 'asuman', 1, '2019-06-19 08:21:15', 'awdsefdgtrfy'),
(0, 'busra', 1, '2019-06-19 08:22:53', 'asdfgrth');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `anket`
--
ALTER TABLE `anket`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `begen`
--
ALTER TABLE `begen`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `cevap`
--
ALTER TABLE `cevap`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `gonderi`
--
ALTER TABLE `gonderi`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kisi`
--
ALTER TABLE `kisi`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `anket`
--
ALTER TABLE `anket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `begen`
--
ALTER TABLE `begen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Tablo için AUTO_INCREMENT değeri `cevap`
--
ALTER TABLE `cevap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Tablo için AUTO_INCREMENT değeri `gonderi`
--
ALTER TABLE `gonderi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `kisi`
--
ALTER TABLE `kisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
