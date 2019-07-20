-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 21 2019 г., 00:24
-- Версия сервера: 8.0.15
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL,
  `name` varchar(55) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tags` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id_post`, `name`, `tags`, `text`, `date`, `image`) VALUES
(27, 'Title', '', 'Text', '2019-07-19 18:16:17', '5a38aa4ebbb8310dca75d7428b259217.jpg'),
(28, 'ЕЩЁ ЕЩЁ ЕЩЁ', '', 'Обычный текст, да, просто тестовый текст', '2019-07-19 23:51:22', '7cfde18fcd33dc7a74e056ce80d53a97.jpg'),
(29, 'Теги присутсвуют в данном посте', 'Теги, на, месте', 'Пост с тегами', '2019-07-20 00:30:53', 'bd3364152e8fec27545d0cc140a60db7.jpg'),
(31, 'Тестируем теги', 'Просто, много, тегов, тестируем, теги, ухты, вау, балдёж, коррупция, пост', 'Тестируем теги', '2019-07-20 20:36:49', '3226c646b832364f22bcc9c967935866.jpg'),
(32, 'Ещё один пост с тегами', 'Ещё, теги, много, тегов, да', 'ТЕТТЕТЕТЕГИИИ', '2019-07-20 20:51:00', 'a87aa6f7f7686eed59885509d2b2cc27.jpg'),
(33, 'Теги на месте', 'Теги, на, месте', 'Теги на месте', '2019-07-20 22:07:24', '2592c7a1092ba638c5be6b364114bf3d.png');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `login` varchar(15) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `login`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'user', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
