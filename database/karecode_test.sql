-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: mysql8.1
-- Üretim Zamanı: 28 Eyl 2024, 14:42:50
-- Sunucu sürümü: 8.1.0
-- PHP Sürümü: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `karecode_test`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('super_admin','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'admin',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `phone`, `role`, `password`) VALUES
(1, 'Sercan', 'Sever', 'sercan@localkod.com', '05555555555', 'super_admin', '$2y$10$424Qj7H0D6mvpjL4dxeTFezSPmVmb752mudRjyaGcjW4Y6UTjqO.q'),
(9, 'Anne Crawford', 'Cross', 'mubi@mailinator.com', '5452526597', 'admin', '$2y$10$O8AFVq5RtgUswoafhJ6tQuctYP1wF2QOI.2jopGuW8unobws9reFC'),
(10, 'Azalia', 'Boyle', 'dokuz@mailinator.com', '1234567891', 'admin', '$2y$10$xrj/CEIyFTGDmNJERDp5reyEmsyzdoe7xd.nlDxoeCmq.cubTSOmK'),
(11, 'Kylie Weaver', 'Livingston', 'beju@mailinator.com', '3216549877', 'admin', '$2y$10$EI08t.94HjwafzQz.PgrHelXPS3FhF7E8pSfl3anH62zFzAzg7GVq'),
(12, 'Irene Cooper', 'Nelson', 'nyxuwax@mailinator.com', '5465132165', 'admin', '$2y$10$vs/yenucxX3eNljS.JfIO.VUCl3I7goW7wjN9jtOR0PgxmqTUgVjW'),
(14, 'Isabella French', 'Church', 'vygijofiqu@mailinator.com', '6549873216', 'admin', '$2y$10$lVR4AT5yTEFPyDzskarkrewv//m1so8joiqxRfLj/BBCZuxOr7j/.'),
(15, 'Kessie Holmes', 'Leon', 'cafipyha@mailinator.com', '1326546544', 'admin', '$2y$10$oARGKULPeFtWQArWxKKYOu8gcj0A73mpmi3sTO2MMvdLMmsD2SUV2');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
