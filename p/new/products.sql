-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 12 2022 г., 02:01
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `users`
--

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `model` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `promo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `count` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`product_id`, `picture`, `name`, `price`, `country`, `model`, `category`, `year`, `promo`, `created_at`, `count`) VALUES
(1, '/img/mers_s_class1.jpeg', 'Mercedes-Benz S-Class', '9 980 000 ₽', 'Германия', 'W223', 'Седан', '2020', '/img/mers_s_class.png', '2022-10-25 06:49:47', '145'),
(2, '/img/mers_e_class1.jpeg', 'Mercedez-Benz E-Class седан', '5 990 000 ₽', 'Германия', 'E200 D', 'Cедан', '2021', '/img/mers_e_class.png', '2022-10-25 06:49:47', '18'),
(3, '/img/mers_e_class_cab1.jpeg', 'Mercedes-Benz Е-класс ', '6 640 000 ₽', 'Германия', 'E220', 'Кабриолет', '2022', '/img/mers_e_class_cab.png', '2022-10-25 06:49:47', '45'),
(4, '/img/mers_cls1.jpeg', 'Mercedes-Benz CLS купе', '9 270 000 ₽', 'Германия', 'CLS', 'Купе', '2021', '/img/mers_cls.png', '2022-10-25 06:49:47', '120'),
(5, '/img/mers_e_class_k1.jpeg', 'Mercedes-Benz E-класс купе', '8 430 000 ₽', 'Германия', 'E200', 'Купе', '2021', '/img/mers_e_class_k.png', '2022-10-25 06:49:47', '86'),
(6, '/img/mers_gla1.jpeg', 'Mercedes-Benz GLA', '6 630 000 ₽', 'Германия', 'GLA', 'Седан', '2021', '/img/mers_gla.png', '2022-10-25 06:49:47', '100'),
(7, '/img/mers_gle1.jpeg', 'Mercedes-Benz GLE купе', '9 240 000 ₽', 'Германия', 'GLE Coupe', 'Купе', '2020', '/img/mers_gle.png', '2022-10-25 06:49:47', '81'),
(8, '/img/mers_g_class1.jpeg', 'Mercedes-Benz G-класс', '9 900 000 ₽', 'Германия', 'G350 d', 'Внедорожник', '2021', '/img/mers_g_class.png', '2022-10-25 06:49:47', '41'),
(9, '/img/mers_cla1.jpeg', 'Mercedez-Benz CLA купе', '5 010 000 ₽\r\n', 'Германия', 'CLA Coupe', 'Купе', '2020', '/img/mers_cla.png', '2022-10-25 06:49:47', '12');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
