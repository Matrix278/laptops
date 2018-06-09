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
-- Структура таблицы `vn_aboutUs`
--

CREATE TABLE `vn_aboutUs` (
  `id` int(11) NOT NULL,
  `title` tinytext NOT NULL,
  `lead` text NOT NULL,
  `langCode` varchar(2) NOT NULL,
  `listOrder` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `vn_aboutUs`
--

INSERT INTO `vn_aboutUs` (`id`, `title`, `lead`, `langCode`, `listOrder`) VALUES
(1, 'О нас', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dolor nunc, pulvinar sed blandit ac, tincidunt a lorem. Ut a eros in erat volutpat consequat. Nam sed consectetur lorem, vel molestie ligula. Quisque cursus facilisis neque a vehicula. Nulla dignissim orci pulvinar erat mollis laoreet. Phasellus dictum mi eu lectus semper, sed placerat dolor interdum. Duis id laoreet tortor. Vestibulum sed pharetra libero. Integer id nisi velit. Nulla at purus massa. Maecenas pellentesque venenatis felis in molestie. Duis mattis commodo urna ac luctus. Duis eu sagittis tellus. Etiam auctor libero sed rhoncus scelerisque. Ut nisi magna, ullamcorper vitae pretium ac, scelerisque eget lorem. Nam egestas quis turpis eget iaculis. Integer mollis nisi sit amet bibendum ultrices. Sed dictum dictum est et viverra. Nunc dictum quis risus a consectetur. Sed quis tellus placerat, euismod eros at, eleifend nulla. Etiam posuere dictum nibh vitae congue. Pellentesque pretium dui non accumsan convallis. Nulla semper ipsum et tellus imperdiet tempus. Morbi a nisi et dui laoreet luctus. Proin hendrerit, tellus non cursus dictum, velit leo laoreet ex, ac scelerisque sem urna ac lacus. Cras in odio at orci congue lacinia vel eu metus. Vestibulum sit amet rhoncus justo. Aliquam vitae ligula odio. Nunc interdum iaculis lorem, id semper eros volutpat a. Donec tempus ultrices libero in venenatis. Aliquam erat mi, porta malesuada ipsum accumsan, consectetur commodo orci. Aliquam rhoncus mauris sit amet diam commodo ornare. Nunc egestas nisl velit, eget tempor lectus fermentum nec. Vestibulum tincidunt dolor dolor, sed congue tortor fermentum ac. Nam ac odio lectus. Quisque quis lectus consectetur, blandit arcu quis, vehicula orci. Etiam in convallis nisl. In eget sapien egestas, maximus massa at, vehicula metus. In pulvinar lobortis elementum. Morbi lacinia volutpat nisi, quis semper purus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed aliquet aliquet sapien, a fringilla justo pulvinar vitae. Nam ac pellentesque velit, eget faucibus lorem. Suspendisse tincidunt commodo dictum. Sed ornare faucibus dui, quis vestibulum ex suscipit eget. Pellentesque nisl dolor, tincidunt ac volutpat id, lobortis at mauris. Cras tempor enim nunc, quis fringilla urna condimentum quis. Nulla sodales orci vel dui ultrices, sit amet hendrerit dolor pulvinar. Morbi id mi metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi at neque nec orci suscipit dictum eu a tellus. Proin sollicitudin nulla ut odio bibendum, ut sagittis dui ultricies. Mauris in nunc posuere, tempor risus nec, lacinia sapien. Aenean nec erat iaculis, porttitor mi sit amet, semper turpis. Ut iaculis metus dui, nec hendrerit magna lobortis eu. Maecenas convallis a metus sed vehicula. Praesent fermentum sit amet arcu non feugiat. Maecenas varius imperdiet elit et varius. Donec at dapibus sem. Sed dignissim lectus at sapien maximus tempor dapibus sit amet eros. Nam non lorem a tortor convallis fermentum. Donec nisi diam, dictum non elit vitae, vehicula ultrices augue. Donec maximus viverra est, nec ornare lectus imperdiet quis. Nam ornare, neque nec iaculis iaculis, eros metus commodo elit, in vestibulum lacus quam eu enim. Pellentesque non felis at nulla dapibus tempor non a urna.', 'ru', 1),
(2, 'Meist', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dolor nunc, pulvinar sed blandit ac, tincidunt a lorem. Ut a eros in erat volutpat consequat. Nam sed consectetur lorem, vel molestie ligula. Quisque cursus facilisis neque a vehicula. Nulla dignissim orci pulvinar erat mollis laoreet. Phasellus dictum mi eu lectus semper, sed placerat dolor interdum. Duis id laoreet tortor. Vestibulum sed pharetra libero. Integer id nisi velit. Nulla at purus massa. Maecenas pellentesque venenatis felis in molestie. Duis mattis commodo urna ac luctus. Duis eu sagittis tellus. Etiam auctor libero sed rhoncus scelerisque. Ut nisi magna, ullamcorper vitae pretium ac, scelerisque eget lorem. Nam egestas quis turpis eget iaculis. Integer mollis nisi sit amet bibendum ultrices. Sed dictum dictum est et viverra. Nunc dictum quis risus a consectetur. Sed quis tellus placerat, euismod eros at, eleifend nulla. Etiam posuere dictum nibh vitae congue. Pellentesque pretium dui non accumsan convallis. Nulla semper ipsum et tellus imperdiet tempus. Morbi a nisi et dui laoreet luctus. Proin hendrerit, tellus non cursus dictum, velit leo laoreet ex, ac scelerisque sem urna ac lacus. Cras in odio at orci congue lacinia vel eu metus. Vestibulum sit amet rhoncus justo. Aliquam vitae ligula odio. Nunc interdum iaculis lorem, id semper eros volutpat a. Donec tempus ultrices libero in venenatis. Aliquam erat mi, porta malesuada ipsum accumsan, consectetur commodo orci. Aliquam rhoncus mauris sit amet diam commodo ornare. Nunc egestas nisl velit, eget tempor lectus fermentum nec. Vestibulum tincidunt dolor dolor, sed congue tortor fermentum ac. Nam ac odio lectus. Quisque quis lectus consectetur, blandit arcu quis, vehicula orci. Etiam in convallis nisl. In eget sapien egestas, maximus massa at, vehicula metus. In pulvinar lobortis elementum. Morbi lacinia volutpat nisi, quis semper purus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed aliquet aliquet sapien, a fringilla justo pulvinar vitae. Nam ac pellentesque velit, eget faucibus lorem. Suspendisse tincidunt commodo dictum. Sed ornare faucibus dui, quis vestibulum ex suscipit eget. Pellentesque nisl dolor, tincidunt ac volutpat id, lobortis at mauris. Cras tempor enim nunc, quis fringilla urna condimentum quis. Nulla sodales orci vel dui ultrices, sit amet hendrerit dolor pulvinar. Morbi id mi metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi at neque nec orci suscipit dictum eu a tellus. Proin sollicitudin nulla ut odio bibendum, ut sagittis dui ultricies. Mauris in nunc posuere, tempor risus nec, lacinia sapien. Aenean nec erat iaculis, porttitor mi sit amet, semper turpis. Ut iaculis metus dui, nec hendrerit magna lobortis eu. Maecenas convallis a metus sed vehicula. Praesent fermentum sit amet arcu non feugiat. Maecenas varius imperdiet elit et varius. Donec at dapibus sem. Sed dignissim lectus at sapien maximus tempor dapibus sit amet eros. Nam non lorem a tortor convallis fermentum. Donec nisi diam, dictum non elit vitae, vehicula ultrices augue. Donec maximus viverra est, nec ornare lectus imperdiet quis. Nam ornare, neque nec iaculis iaculis, eros metus commodo elit, in vestibulum lacus quam eu enim. Pellentesque non felis at nulla dapibus tempor non a urna.', 'et', 1),
(3, 'About us', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dolor nunc, pulvinar sed blandit ac, tincidunt a lorem. Ut a eros in erat volutpat consequat. Nam sed consectetur lorem, vel molestie ligula. Quisque cursus facilisis neque a vehicula. Nulla dignissim orci pulvinar erat mollis laoreet. Phasellus dictum mi eu lectus semper, sed placerat dolor interdum. Duis id laoreet tortor. Vestibulum sed pharetra libero. Integer id nisi velit. Nulla at purus massa. Maecenas pellentesque venenatis felis in molestie. Duis mattis commodo urna ac luctus. Duis eu sagittis tellus. Etiam auctor libero sed rhoncus scelerisque. Ut nisi magna, ullamcorper vitae pretium ac, scelerisque eget lorem. Nam egestas quis turpis eget iaculis. Integer mollis nisi sit amet bibendum ultrices. Sed dictum dictum est et viverra. Nunc dictum quis risus a consectetur. Sed quis tellus placerat, euismod eros at, eleifend nulla. Etiam posuere dictum nibh vitae congue. Pellentesque pretium dui non accumsan convallis. Nulla semper ipsum et tellus imperdiet tempus. Morbi a nisi et dui laoreet luctus. Proin hendrerit, tellus non cursus dictum, velit leo laoreet ex, ac scelerisque sem urna ac lacus. Cras in odio at orci congue lacinia vel eu metus. Vestibulum sit amet rhoncus justo. Aliquam vitae ligula odio. Nunc interdum iaculis lorem, id semper eros volutpat a. Donec tempus ultrices libero in venenatis. Aliquam erat mi, porta malesuada ipsum accumsan, consectetur commodo orci. Aliquam rhoncus mauris sit amet diam commodo ornare. Nunc egestas nisl velit, eget tempor lectus fermentum nec. Vestibulum tincidunt dolor dolor, sed congue tortor fermentum ac. Nam ac odio lectus. Quisque quis lectus consectetur, blandit arcu quis, vehicula orci. Etiam in convallis nisl. In eget sapien egestas, maximus massa at, vehicula metus. In pulvinar lobortis elementum. Morbi lacinia volutpat nisi, quis semper purus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed aliquet aliquet sapien, a fringilla justo pulvinar vitae. Nam ac pellentesque velit, eget faucibus lorem. Suspendisse tincidunt commodo dictum. Sed ornare faucibus dui, quis vestibulum ex suscipit eget. Pellentesque nisl dolor, tincidunt ac volutpat id, lobortis at mauris. Cras tempor enim nunc, quis fringilla urna condimentum quis. Nulla sodales orci vel dui ultrices, sit amet hendrerit dolor pulvinar. Morbi id mi metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi at neque nec orci suscipit dictum eu a tellus. Proin sollicitudin nulla ut odio bibendum, ut sagittis dui ultricies. Mauris in nunc posuere, tempor risus nec, lacinia sapien. Aenean nec erat iaculis, porttitor mi sit amet, semper turpis. Ut iaculis metus dui, nec hendrerit magna lobortis eu. Maecenas convallis a metus sed vehicula. Praesent fermentum sit amet arcu non feugiat. Maecenas varius imperdiet elit et varius. Donec at dapibus sem. Sed dignissim lectus at sapien maximus tempor dapibus sit amet eros. Nam non lorem a tortor convallis fermentum. Donec nisi diam, dictum non elit vitae, vehicula ultrices augue. Donec maximus viverra est, nec ornare lectus imperdiet quis. Nam ornare, neque nec iaculis iaculis, eros metus commodo elit, in vestibulum lacus quam eu enim. Pellentesque non felis at nulla dapibus tempor non a urna.', 'en', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `vn_aboutUs`
--
ALTER TABLE `vn_aboutUs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `vn_aboutUs`
--
ALTER TABLE `vn_aboutUs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
