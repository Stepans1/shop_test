-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Май 24 2023 г., 07:35
-- Версия сервера: 5.7.39
-- Версия PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop_sw`
--

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `weight` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dvd`
--

CREATE TABLE `dvd` (
  `id` int(11) NOT NULL,
  `size` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `furnitures`
--

CREATE TABLE `furnitures` (
  `id` int(11) NOT NULL,
  `height` double NOT NULL,
  `width` double NOT NULL,
  `length` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `productType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `price`, `productType`) VALUES
(6, '1', '1', 1, '1');

--
-- Триггеры `products`
--
DELIMITER $$
CREATE TRIGGER `deleteBook` BEFORE DELETE ON `products` FOR EACH ROW DELETE FROM books WHERE id = OLD.id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `deleteDvd` BEFORE DELETE ON `products` FOR EACH ROW DELETE FROM dvd WHERE id = OLD.id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `deleteFurniture` BEFORE DELETE ON `products` FOR EACH ROW DELETE FROM furnitures WHERE id = OLD.id
$$
DELIMITER ;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `dvd`
--
ALTER TABLE `dvd`
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `furnitures`
--
ALTER TABLE `furnitures`
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`id`) REFERENCES `products` (`id`);

--
-- Ограничения внешнего ключа таблицы `dvd`
--
ALTER TABLE `dvd`
  ADD CONSTRAINT `dvd_ibfk_1` FOREIGN KEY (`id`) REFERENCES `products` (`id`);

--
-- Ограничения внешнего ключа таблицы `furnitures`
--
ALTER TABLE `furnitures`
  ADD CONSTRAINT `furnitures_ibfk_1` FOREIGN KEY (`id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
