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
-- Структура таблицы `vn_images`
--

CREATE TABLE `vn_images` (
  `id` int(11) NOT NULL,
  `bigImage` tinytext NOT NULL,
  `mediumImage` tinytext NOT NULL,
  `smallImage` tinytext NOT NULL,
  `code` tinytext NOT NULL,
  `listOrder` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `vn_images`
--

INSERT INTO `vn_images` (`id`, `bigImage`, `mediumImage`, `smallImage`, `code`, `listOrder`) VALUES
(7, 'img/bigImages/bigimage0_20180527043958.jpg', 'img/mediumImages/mediumimage0_20180527043958.jpg', 'img/smallImages/smallimage0_20180527043958.jpg', 'lenovo4', 1),
(8, 'img/bigImages/bigimage1_20180527043958.jpg', 'img/mediumImages/mediumimage1_20180527043958.jpg', 'img/smallImages/smallimage1_20180527043958.jpg', 'lenovo4', 2),
(9, 'img/bigImages/bigimage2_20180527043958.jpg', 'img/mediumImages/mediumimage2_20180527043958.jpg', 'img/smallImages/smallimage2_20180527043958.jpg', 'lenovo4', 3),
(10, 'img/bigImages/bigimage0_20180527055746.jpg', 'img/mediumImages/mediumimage0_20180527055746.jpg', 'img/smallImages/smallimage0_20180527055746.jpg', 'dellXPS1', 1),
(11, 'img/bigImages/bigimage1_20180527055746.jpg', 'img/mediumImages/mediumimage1_20180527055746.jpg', 'img/smallImages/smallimage1_20180527055746.jpg', 'dellXPS1', 2),
(12, 'img/bigImages/bigimage2_20180527055747.jpg', 'img/mediumImages/mediumimage2_20180527055747.jpg', 'img/smallImages/smallimage2_20180527055747.jpg', 'dellXPS1', 3),
(16, 'img/bigImages/bigimage0_20180527063733.jpg', 'img/mediumImages/mediumimage0_20180527063733.jpg', 'img/smallImages/smallimage0_20180527063733.jpg', 'asusZenbook', 1),
(17, 'img/bigImages/bigimage1_20180527063733.jpg', 'img/mediumImages/mediumimage1_20180527063733.jpg', 'img/smallImages/smallimage1_20180527063733.jpg', 'asusZenbook', 2),
(19, 'img/bigImages/bigimage0_20180527064040.jpg', 'img/mediumImages/mediumimage0_20180527064040.jpg', 'img/smallImages/smallimage0_20180527064040.jpg', 'dellInspiron', 1),
(20, 'img/bigImages/bigimage1_20180527064040.jpg', 'img/mediumImages/mediumimage1_20180527064040.jpg', 'img/smallImages/smallimage1_20180527064040.jpg', 'dellInspiron', 2),
(21, 'img/bigImages/bigimage2_20180527064041.jpg', 'img/mediumImages/mediumimage2_20180527064041.jpg', 'img/smallImages/smallimage2_20180527064041.jpg', 'dellInspiron', 3),
(22, 'img/bigImages/bigimage0_20180527064503.jpg', 'img/mediumImages/mediumimage0_20180527064503.jpg', 'img/smallImages/smallimage0_20180527064503.jpg', 'lenovoIdeapad320s', 1),
(23, 'img/bigImages/bigimage1_20180527064503.jpg', 'img/mediumImages/mediumimage1_20180527064503.jpg', 'img/smallImages/smallimage1_20180527064503.jpg', 'lenovoIdeapad320s', 2),
(24, 'img/bigImages/bigimage2_20180527064503.jpg', 'img/mediumImages/mediumimage2_20180527064503.jpg', 'img/smallImages/smallimage2_20180527064503.jpg', 'lenovoIdeapad320s', 3),
(25, 'img/bigImages/bigimage0_20180527064927.jpg', 'img/mediumImages/mediumimage0_20180527064927.jpg', 'img/smallImages/smallimage0_20180527064927.jpg', 'lenovoLegionY520', 1),
(26, 'img/bigImages/bigimage1_20180527064928.jpg', 'img/mediumImages/mediumimage1_20180527064928.jpg', 'img/smallImages/smallimage1_20180527064928.jpg', 'lenovoLegionY520', 2),
(27, 'img/bigImages/bigimage2_20180527064928.jpg', 'img/mediumImages/mediumimage2_20180527064928.jpg', 'img/smallImages/smallimage2_20180527064928.jpg', 'lenovoLegionY520', 3),
(38, 'img/bigImages/bigimage0_20180601105845.jpg', 'img/mediumImages/mediumimage0_20180601105845.jpg', 'img/smallImages/smallimage0_20180601105845.jpg', 'lenovoV', 1),
(39, 'img/bigImages/bigimage1_20180601105845.jpg', 'img/mediumImages/mediumimage1_20180601105845.jpg', 'img/smallImages/smallimage1_20180601105845.jpg', 'lenovoV', 2),
(40, 'img/bigImages/bigimage2_20180601105846.jpg', 'img/mediumImages/mediumimage2_20180601105846.jpg', 'img/smallImages/smallimage2_20180601105846.jpg', 'lenovoV', 3),
(45, 'img/bigImages/bigimage_20180607050255.jpg', 'img/mediumImages/mediumimage_20180607050255.jpg', 'img/smallImages/smallimage_20180607050255.jpg', 'asusZenbook', 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `vn_images`
--
ALTER TABLE `vn_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `vn_images`
--
ALTER TABLE `vn_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
