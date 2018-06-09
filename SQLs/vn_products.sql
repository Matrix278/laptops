-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июн 09 2018 г., 09:58
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
-- Структура таблицы `vn_products`
--

CREATE TABLE `vn_products` (
  `id` int(11) NOT NULL,
  `code` tinytext NOT NULL,
  `name` tinytext NOT NULL,
  `description` text NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `categoryCode` tinytext NOT NULL,
  `langCode` varchar(2) NOT NULL,
  `listOrder` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `vn_products`
--

INSERT INTO `vn_products` (`id`, `code`, `name`, `description`, `price`, `categoryCode`, `langCode`, `listOrder`) VALUES
(67, 'lenovo4', 'Lenovo YOGA 310-11 BLACK 80U2005FPB', 'Kaal (kg): 1,35.\r\nEkraan: 11,6\".\r\nResolutsioon: 1366 x 768.\r\nOperatsioonisüsteem: Windows 10.\r\nProtsessor: Intel Pentium.\r\nOperatiivmälu: 2 GB.\r\nKõvaketas (HDD): Ei.\r\nKõvaketas (SSD): 32 GB.\r\nVideokaart: Intel HD Graphics 500.\r\nKlaviatuur: ENG', 259.00, 'sensorLaptops', 'et', 7),
(68, 'lenovo4', 'Lenovo YOGA 310-11 BLACK 80U2005FPB', 'Вес (кг): 1,35.\r\nЭкран: 11,6\".\r\nРазрешение: 1366 x 768.\r\nТип ОС: Windows 10.\r\nПроцессор: Intel Pentium.\r\nОперативная память: 2 GB.\r\nЖесткий диск (HDD): Нет.\r\nЖесткий диск (SSD): 32 GB.\r\nВидеокарта: Intel HD Graphics 500.\r\nРаскладка клавиатуры: ENG', 259.00, 'sensorLaptops', 'ru', 7),
(69, 'lenovo4', 'Lenovo YOGA 310-11 BLACK 80U2005FPB', 'Weight (kg): 1,35.\r\nDisplay: 11,6\".\r\nResolution: 1366 x 768.\r\nOperating System: Windows 10.\r\nProcessor: Intel Pentium.\r\nOperational memory: 2 GB.\r\nHard disk drive (HDD): No.\r\nHard disk drive (SSD): 32 GB.\r\nVideo card: Intel HD Graphics 500.\r\nKeyboard: ENG', 259.00, 'sensorLaptops', 'en', 7),
(70, 'dellXPS1', 'Dell XPS 13 9360 SILVER 272874142', 'Kaal (kg): 1,2.\r\nEkraan: 13,3\".\r\nResolutsioon: 3200 x 1800.\r\nOperatsioonisüsteem: Windows 10.\r\nProtsessor: Intel Core i7.\r\nOperatiivmälu: 16 GB.\r\nKõvaketas (HDD): Ei.\r\nKõvaketas (SSD): 512 GB.\r\nVideokaart: Intel HD Graphics 620.\r\nKlaviatuur: ENG', 1648.00, 'sensorLaptops', 'et', 6),
(71, 'dellXPS1', 'Dell XPS 13 9360 SILVER 272874142', 'Вес (кг): 1,2.\r\nЭкран: 13,3\".\r\nРазрешение: 3200 x 1800.\r\nТип ОС: Windows 10.\r\nПроцессор: Intel Core i7.\r\nОперативная память: 16 GB.\r\nЖесткий диск (HDD): Нет.\r\nЖесткий диск (SSD): 512 GB.\r\nВидеокарта: Intel HD Graphics 620.\r\nРаскладка клавиатуры: ENG', 1648.00, 'sensorLaptops', 'ru', 6),
(72, 'dellXPS1', 'Dell XPS 13 9360 SILVER 272874142', 'Weight (kg): 1,2.\r\nDisplay: 13,3\".\r\nResolution: 3200 x 1800.\r\nOperating System: Windows 10.\r\nProcessor: Intel Core i7.\r\nOperational memory: 16 GB.\r\nHard disk drive (HDD): No.\r\nHard disk drive (SSD): 512 GB.\r\nVideo card: Intel HD Graphics 620.\r\nKeyboard: ENG', 1648.00, 'sensorLaptops', 'en', 6),
(76, 'asusZenbook', 'Asus ZENBOOK 13 UX331UA BLUE 90NB0GZ1-M01760', 'Kaal (kg): 1,1.\r\nEkraan: 13,3\".\r\nResolutsioon: 1920 x 1080.\r\nOperatsioonisüsteem: Windows 10.\r\nProtsessor: Intel Core i3.\r\nOperatiivmälu: 8 GB.\r\nKõvaketas (HDD): Ei.\r\nKõvaketas (SSD): 256 GB.\r\nVideokaart: Intel HD Graphics 500.\r\nKlaviatuur: ENG', 789.00, 'homeLaptops', 'et', 2),
(77, 'asusZenbook', 'Asus ZENBOOK 13 UX331UA BLUE 90NB0GZ1-M01760', 'Вес (кг): 1,1.\r\nЭкран: 13,3\".\r\nРазрешение: 1920 x 1080.\r\nТип ОС: Windows 10.\r\nПроцессор: Intel Core i3.\r\nОперативная память: 8 GB.\r\nЖесткий диск (HDD): Нет.\r\nЖесткий диск (SSD): 256 GB.\r\nВидеокарта: Intel HD Graphics 620.\r\nРаскладка клавиатуры: ENG', 789.00, 'homeLaptops', 'ru', 2),
(78, 'asusZenbook', 'Asus ZENBOOK 13 UX331UA BLUE 90NB0GZ1-M01760', 'Weight (kg): 1,1.\r\nDisplay: 13,3\".\r\nResolution: 1920 x 1080.\r\nOperating System: Windows 10.\r\nProcessor: Intel Core i3.\r\nOperational memory: 8 GB.\r\nHard disk drive (HDD): No.\r\nHard disk drive (SSD): 256 GB.\r\nVideo card: Intel HD Graphics 620.\r\nKeyboard: ENG', 789.00, 'homeLaptops', 'en', 2),
(79, 'dellInspiron', 'Dell INSPIRON 5570 BLACK 5570-2937', 'Kaal (kg): 2,26.\r\nEkraan: 15,6\".\r\nResolutsioon: 1920 x 1080.\r\nOperatsioonisüsteem: Windows 10.\r\nProtsessor: Intel Core i7.\r\nOperatiivmälu: 8 GB.\r\nKõvaketas (HDD): 2000 GB(2 TB).\r\nKõvaketas (SSD): 128 GB.\r\nVideokaart: Radeon 530.\r\nKlaviatuur: ENG', 928.00, 'businessLaptops', 'et', 3),
(80, 'dellInspiron', 'Dell INSPIRON 5570 BLACK 5570-2937', 'Вес (кг): 2,26.\r\nЭкран: 15,6\".\r\nРазрешение: 1920 x 1080.\r\nТип ОС: Windows 10.\r\nПроцессор: Intel Core i7.\r\nОперативная память: 8 GB.\r\nЖесткий диск (HDD): 2000 GB(2 TB).\r\nЖесткий диск (SSD): 128 GB.\r\nВидеокарта: Radeon 530.\r\nРаскладка клавиатуры: ENG', 928.00, 'businessLaptops', 'ru', 3),
(81, 'dellInspiron', 'Dell INSPIRON 5570 BLACK 5570-2937', 'Weight (kg): 2,26.\r\nDisplay: 15,6\".\r\nResolution: 1920 x 1080.\r\nOperating System: Windows 10.\r\nProcessor: Intel Core i7.\r\nOperational memory: 8 GB.\r\nHard disk drive (HDD): 2000 GB(2 TB).\r\nHard disk drive (SSD): 128 GB.\r\nVideo card: Radeon 530.\r\nKeyboard: ENG', 928.00, 'businessLaptops', 'en', 3),
(82, 'lenovoIdeapad320s', 'Lenovo IdeaPad 320S-14 Full HD Kaby Lake i3 Grey', 'Kaal (kg): 1,69.\r\nEkraan: 14\".\r\nResolutsioon: 1920 x 1080.\r\nOperatsioonisüsteem: Windows 10.\r\nProtsessor: Intel Core i3.\r\nOperatiivmälu: 4 GB.\r\nKõvaketas (HDD): Ei.\r\nKõvaketas (SSD): 128 GB.\r\nVideokaart: Intel HD Graphics 620.\r\nKlaviatuur: ENG', 523.00, 'mobileLaptops', 'et', 5),
(83, 'lenovoIdeapad320s', 'Lenovo IdeaPad 320S-14 Full HD Kaby Lake i3 Grey', 'Вес (кг): 1,69.\r\nЭкран: 14\".\r\nРазрешение: 1920 x 1080.\r\nТип операционной системы: Windows 10.\r\nПроцессор: Intel Core i3.\r\nОперативная память: 4 ГБ.\r\nЖесткий диск (HDD): Нет.\r\nЖесткий диск (SSD): 128 ГБ.\r\nВидеокарта: Intel HD Graphics 620.\r\nРаскладка клавиатуры: ENG', 523.00, 'mobileLaptops', 'ru', 5),
(84, 'lenovoIdeapad320s', 'Lenovo IdeaPad 320S-14 Full HD Kaby Lake i3 Grey', 'Weight (kg): 1,69.\r\nDisplay: 14\".\r\nResolution: 1920 x 1080.\r\nOperating System: Windows 10.\r\nProcessor: Intel Core i3.\r\nOperational memory: 4 GB.\r\nHard disk drive (HDD): No.\r\nHard disk drive (SSD): 128 GB.\r\nVideo card: Intel HD Graphics 620.\r\nKeyboard: ENG', 523.00, 'mobileLaptops', 'en', 5),
(85, 'lenovoLegionY520', 'Lenovo LEGION Y520 FULL HD GTX1060 I5', 'Kaal (kg): 2,4.\r\nEkraan: 15,6\".\r\nResolutsioon: 1920 x 1080.\r\nOperatsioonisüsteem: DOS.\r\nProtsessor: Intel Core i5.\r\nOperatiivmälu: 8 GB.\r\nKõvaketas (HDD): 2000 GB(2 TB).\r\nKõvaketas (SSD): 128 GB.\r\nVideokaart: GeForce GTX 1060.\r\nKlaviatuur: ENG', 949.00, 'gamingLaptops', 'et', 4),
(86, 'lenovoLegionY520', 'Lenovo LEGION Y520 FULL HD GTX1060 I5', 'Вес (кг): 2,4.\r\nЭкран: 15,6\".\r\nРазрешение: 1920 x 1080.\r\nТип ОС: DOS.\r\nПроцессор: Intel Core i5.\r\nОперативная память: 8 GB.\r\nЖесткий диск (HDD): 2000 GB(2 TB).\r\nЖесткий диск (SSD): 128 GB.\r\nВидеокарта: GeForce GTX 1060.\r\nРаскладка клавиатуры: ENG', 949.00, 'gamingLaptops', 'ru', 4),
(87, 'lenovoLegionY520', 'Lenovo LEGION Y520 FULL HD GTX1060 I5', 'Weight (kg): 2,4.\r\nDisplay: 15,6\".\r\nResolution: 1920 x 1080.\r\nOperating System: DOS.\r\nProcessor: Intel Core i5.\r\nOperational memory: 8 GB.\r\nHard disk drive (HDD): 2000 GB(2 TB).\r\nHard disk drive (SSD): 128 GB.\r\nVideo card: GeForce GTX 1060.\r\nKeyboard: ENG', 949.00, 'gamingLaptops', 'en', 4),
(121, 'lenovoV', 'Lenovo V110-15 80TG011JPB', 'Kaal (kg): 2,1. Ekraan: 15,6\". Resolutsioon: 1366 x 768. Operatsioonisüsteem: DOS. Protsessor: Intel Celeron. Operatiivmälu: 4 GB. Kõvaketas (HDD): 500 GB. Kõvaketas (SSD): Ei. Videokaart: Intel HD Graphics 500. Klaviatuur: ENG', 230.00, 'sensorLaptops', 'et', 1),
(122, 'lenovoV', 'Lenovo V110-15 80TG011JPB', 'Вес (кг): 2,1. Экран: 15,6\". Разрешение: 1366 x 768. Тип ОС: DOS. Процессор: Intel Celeron. Оперативная память: 4 GB. Жесткий диск (HDD): 500 GB. Жесткий диск (SSD): Нет. Видеокарта: Intel HD Graphics 500. Раскладка клавиатуры: ENG', 230.00, 'sensorLaptops', 'ru', 1),
(123, 'lenovoV', 'Lenovo V110-15 80TG011JPB', 'Weight (kg): 2,1. Display: 15,6 \". Resolution: 1366 x 768. Operating System: DOS. Processor: Intel Celeron. Operational memory: 4 GB. Hard disk drive (HDD): 500 GB. Hard disk drive (SSD): No. Video card: Intel HD Graphics 500. Keyboard: ENG', 230.00, 'sensorLaptops', 'en', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `vn_products`
--
ALTER TABLE `vn_products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `vn_products`
--
ALTER TABLE `vn_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
