-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 21 2018 г., 19:33
-- Версия сервера: 5.7.23
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gbphp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `gellery`
--

CREATE TABLE `gellery` (
  `id` int(3) NOT NULL,
  `address` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gellery`
--

INSERT INTO `gellery` (`id`, `address`, `name`, `size`) VALUES
(1, 'flowers1.jpg', 'flowers1.jpg', '300'),
(2, 'flowers2.jpg', 'flowers2.jpg', '300'),
(3, 'flowers3.jpg', 'flowers3.jpg', '300');

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int(3) NOT NULL,
  `name` varchar(20) NOT NULL,
  `info` varchar(255) NOT NULL,
  `price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `name`, `info`, `price`) VALUES
(1, 'Товар 1', 'Информация о товаре', '100'),
(2, 'Товар 2', 'Информация о товаре', '200'),
(3, 'Товар 3', 'Информация о товаре', '300'),
(4, 'Товар 4', 'Информация о товаре', '400'),
(108, 'Сумка', 'Инфо', '150'),
(109, 'Туфли', 'Информация', '3000');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `typeUser` int(1) DEFAULT '0' COMMENT '0 - user, 1 - admin',
  `groups` varchar(255) NOT NULL,
  `fio` varchar(75) NOT NULL,
  `DOB` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `typeUser`, `groups`, `fio`, `DOB`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'Anna', 1, 'admin', 'Петрова Анна', '2018-12-02'),
(2, 'asd', 'b706835de79a2b4e80506f582af3676a', 'Ivan', 0, '', '', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `zakaz`
--

CREATE TABLE `zakaz` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zakaz` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `zakaz`
--

INSERT INTO `zakaz` (`id`, `name`, `address`, `zakaz`) VALUES
(2, 'Андрей', 'Кемерово', '[{\"id\":\"3\",\"price\":\"300\",\"count\":2}]'),
(3, 'Диана', 'Кемерово', '[{\"id\":\"1\",\"price\":\"100\",\"count\":3},{\"id\":\"4\",\"price\":\"400\",\"count\":2}]'),
(4, 'Юля', 'Москва', '[{\"id\":\"2\",\"price\":\"200\",\"count\":1},{\"id\":\"3\",\"price\":\"300\",\"count\":2}]'),
(5, 'Петров', 'Екатеринбург, пр. Ленина, 100-5', '[{\"id\":\"4\",\"price\":\"400\",\"count\":1}]');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `gellery`
--
ALTER TABLE `gellery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `zakaz`
--
ALTER TABLE `zakaz`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `gellery`
--
ALTER TABLE `gellery`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `zakaz`
--
ALTER TABLE `zakaz`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
