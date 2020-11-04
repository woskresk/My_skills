-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Ноя 04 2020 г., 15:29
-- Версия сервера: 5.7.27-30
-- Версия PHP: 7.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `u0518462_todo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `pass` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id`, `name`, `pass`) VALUES
(1, 'admin', 123);

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `textt` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `edit` int(11) NOT NULL DEFAULT '0',
  `email` text NOT NULL,
  `date_q` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `textt`, `status`, `edit`, `email`, `date_q`) VALUES
(1, 'Дмитрий', 'Купить молоко', 1, 0, 'fhfy@eryr.ru', '2020-08-11 14:21:30'),
(2, 'Гриша', 'Тарелки помыть', 1, 0, 'aeggj@ya.ru', '2020-08-11 17:19:24'),
(3, 'Илоя', 'Сделать масло', 0, 0, 'rfjfk@ya.ru', '2020-08-11 17:28:34'),
(4, 'ddhg', 'Привет это мц', 0, 1, 'ey@ya.ru', '2020-08-11 17:54:55'),
(5, 'ваывпы', 'ппукп', 0, 0, 'woskresk@gmail.com', '2020-08-11 18:44:19'),
(6, 'валырп', 'kidfgiudvhf', 1, 0, 'woskresk@gmail.com', '2020-08-12 11:08:25'),
(7, 'Павел', 'Сделать зарядку', 0, 0, 'fhfi@ya.ru', '2020-08-12 11:55:14'),
(8, 'Иван', 'Послать RYRYRY', 1, 1, 'eee@ya.ru', '2020-08-13 17:23:11'),
(9, 'zzz', 'zzz', 0, 0, 'zzzz@aaa.com', '2020-08-14 08:39:41'),
(10, 'aaa', 'aaa1111', 1, 1, 'aaa1a@aaa.aaa', '2020-08-14 08:39:49'),
(11, 'erer', 'eryrty', 0, 0, 'woskresk@gmail.com', '2020-08-17 12:06:43');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
