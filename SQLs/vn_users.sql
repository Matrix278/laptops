-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июн 09 2018 г., 10:00
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
-- Структура таблицы `vn_users`
--

CREATE TABLE `vn_users` (
  `id` int(11) NOT NULL,
  `username` tinytext NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `lang` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `vn_users`
--

INSERT INTO `vn_users` (`id`, `username`, `password`, `status`, `lang`) VALUES
(1, 'Admin', 'e3afed0047b08059d0fada10f400c1e5', 20, 'ru'),
(2, 'user', '084e0343a0486ff05530df6c705c8bb4', 0, 'et');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `vn_users`
--
ALTER TABLE `vn_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `vn_users`
--
ALTER TABLE `vn_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
