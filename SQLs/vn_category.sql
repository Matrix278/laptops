-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июн 09 2018 г., 09:55
-- Версия сервера: 10.1.31-MariaDB
-- Версия PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `id3277440_webview`
--

-- --------------------------------------------------------

--
-- Структура таблицы `vn_category`
--

CREATE TABLE `vn_category` (
  `id` int(11) NOT NULL,
  `code` tinytext NOT NULL,
  `name` tinytext NOT NULL,
  `langCode` varchar(2) NOT NULL,
  `listOrder` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `vn_category`
--

INSERT INTO `vn_category` (`id`, `code`, `name`, `langCode`, `listOrder`) VALUES
(1, 'sensorLaptops', 'Laptops with touch screen', 'en', 1),
(2, 'sensorLaptops', 'Puutetundlikud sülearvutid', 'et', 1),
(3, 'sensorLaptops', 'Ноутбуки с сенсорным экраном', 'ru', 1),
(4, 'homeLaptops', 'Laptops for home, study', 'en', 2),
(5, 'homeLaptops', 'Sülearvutid kodus, õppimiseks', 'et', 2),
(6, 'homeLaptops', 'Ноутбуки для дома, учебы', 'ru', 2),
(7, 'businessLaptops', 'Laptops for business', 'en', 3),
(8, 'businessLaptops', 'Sülearvutid äri jaoks', 'et', 3),
(9, 'businessLaptops', 'Ноутбуки для бизнеса', 'ru', 3),
(65, 'mobileLaptops', 'Mobile and light laptops', 'en', 4),
(66, 'mobileLaptops', 'Mobiilsed ja kerged sülearvutid', 'et', 4),
(67, 'mobileLaptops', 'Мобильные и легкие ноутбуки', 'ru', 4),
(68, 'gamingLaptops', 'Gaming laptops', 'en', 5),
(69, 'gamingLaptops', 'Mängu sülearvutid', 'et', 5),
(70, 'gamingLaptops', 'Игровые ноутбуки', 'ru', 5);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `vn_category`
--
ALTER TABLE `vn_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `vn_category`
--
ALTER TABLE `vn_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
