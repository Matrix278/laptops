-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июн 09 2018 г., 09:57
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
-- Структура таблицы `vn_contacts`
--

CREATE TABLE `vn_contacts` (
  `id` int(11) NOT NULL,
  `title` tinytext NOT NULL,
  `adress` tinytext NOT NULL,
  `adressText` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `emailText` tinytext NOT NULL,
  `telephone` tinytext NOT NULL,
  `telephoneText` int(11) NOT NULL,
  `langCode` varchar(2) NOT NULL,
  `listOrder` tinyint(4) NOT NULL,
  `icon` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `vn_contacts`
--

INSERT INTO `vn_contacts` (`id`, `title`, `adress`, `adressText`, `email`, `emailText`, `telephone`, `telephoneText`, `langCode`, `listOrder`, `icon`) VALUES
(1, 'Kontaktid', 'Aadress', 'Parnu mnt 57, 76372, Tallinn', 'E-post', 'nitram278@gmail.com', 'Telefoon', 52461358, 'et', 1, 'fa-envelope'),
(2, 'Контакты', 'Адрес', 'Parnu mnt 57, 76372, Tallinn', 'Э-почта', 'nitram278@gmail.com', 'Телефон', 52461358, 'ru', 1, 'fa-envelope'),
(3, 'Contacts', 'Address', 'Parnu mnt 57, 76372, Tallinn', 'Email', 'nitram278@gmail.com', 'Telephone', 52461358, 'en', 1, 'fa-envelope');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `vn_contacts`
--
ALTER TABLE `vn_contacts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `vn_contacts`
--
ALTER TABLE `vn_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
