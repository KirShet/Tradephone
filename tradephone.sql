-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 24 2023 г., 10:36
-- Версия сервера: 10.8.4-MariaDB
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tradephone`
--

-- --------------------------------------------------------

--
-- Структура таблицы `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `colors`
--

INSERT INTO `colors` (`id`, `color`) VALUES
(4, 'gold'),
(7, 'violet'),
(9, '#CD5C5C'),
(12, '#00FA9A'),
(13, '#00FA99'),
(16, '#f1f1f1');

-- --------------------------------------------------------

--
-- Структура таблицы `makes`
--

CREATE TABLE `makes` (
  `id` int(11) NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `makes`
--

INSERT INTO `makes` (`id`, `model`) VALUES
(1, 'Apple'),
(2, 'POCO'),
(3, 'Xiaomi'),
(4, 'Tecno');

-- --------------------------------------------------------

--
-- Структура таблицы `memory`
--

CREATE TABLE `memory` (
  `id` int(11) NOT NULL,
  `ROM` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `memory`
--

INSERT INTO `memory` (`id`, `ROM`) VALUES
(2, '32'),
(3, '64'),
(4, '128'),
(5, '256'),
(6, '512');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guarantee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL,
  `release_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diagonal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resolution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `img`, `guarantee`, `model`, `model_id`, `release_year`, `diagonal`, `resolution`) VALUES
(2, 'xiaomi mi5', 29990, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sequi, doloremque et aliquid dicta commodi adipisci perspiciatis ullam laboriosam cupiditate eum odio natus culpa cum a autem distinctio, accusantium fugiat? Aspernatur.', 'grid-catalog.png', '12', 'Samsung Galaxy A23', 3, '2022', '6.6', '2408х1080'),
(4, '', 29990, '22 33 22', 'grid-catalog.png', NULL, NULL, 3, NULL, NULL, NULL),
(5, '', 29990, '2222', 'grid-catalog.png', NULL, NULL, 2, NULL, NULL, NULL),
(6, '', 29990, '1111', 'grid-catalog.png', NULL, NULL, 2, NULL, NULL, NULL),
(7, '', 29990, '555', 'grid-catalog.png', NULL, NULL, 4, NULL, NULL, NULL),
(8, '', 29990, '6666', 'grid-catalog.png', NULL, NULL, 4, NULL, NULL, NULL),
(9, '', 29990, '111 2  2 2 2', 'grid-catalog.png', NULL, NULL, 1, NULL, NULL, NULL),
(10, '', 29990, '22223', 'grid-catalog.png', NULL, NULL, 1, NULL, NULL, NULL),
(11, 'hhhh', 8888, '88888888888888888888888888888888888888888m iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii', '652cda9297daf.png', NULL, NULL, 4, NULL, NULL, NULL),
(12, '7777', 77777, '77777', 'Capture001.png', NULL, NULL, 3, NULL, NULL, NULL),
(14, '12', 12, '111111111222222222', '6536105b3ba90.png', '12', '12', 2, '12', '12', '12'),
(15, '111', 1, '1', '6536131076adb.png', '111', '11', 4, '1', '1', '1'),
(16, '111122', 11, '11', '655b1538450fc.png', '11', '11', 4, '11', '11', '11'),
(17, '22111', 22, '222', '655b1be55d02f.png', '222', '222', 4, '22', '22', '22'),
(18, '333', 34, '33', '655c50c09bedc.png', '333', '333', 3, '333', '333', '33'),
(19, '44', 44, '44', '655c59939ff11.png', '44', '44', 1, '44', '44', '44');

-- --------------------------------------------------------

--
-- Структура таблицы `product_colors`
--

CREATE TABLE `product_colors` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `product_colors`
--

INSERT INTO `product_colors` (`id`, `product_id`, `color_id`) VALUES
(11, 2, 7),
(17, 2, 13),
(18, 2, 4),
(20, 4, 9),
(21, 4, 13),
(22, 4, 16),
(23, 5, 12),
(24, 5, 9),
(25, 5, 4),
(26, 5, 13),
(27, 2, 12),
(28, 6, 4),
(29, 16, 9),
(30, 14, 7),
(31, 17, 13),
(32, 14, 7),
(33, 17, 13),
(34, 7, 7),
(35, 7, 13),
(36, 7, 16),
(37, 8, 9),
(38, 8, 13),
(40, 8, 16),
(41, 9, 12),
(42, 9, 16),
(43, 9, 9),
(44, 10, 9),
(45, 10, 16),
(46, 10, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `product_memory`
--

CREATE TABLE `product_memory` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `memory_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `product_memory`
--

INSERT INTO `product_memory` (`id`, `product_id`, `memory_id`) VALUES
(1, 2, 2),
(3, 2, 2),
(4, 2, 4),
(5, 2, 5),
(6, 2, 3),
(7, 2, 5),
(10, 5, 2),
(11, 5, 4),
(12, 5, 6),
(13, 4, 3),
(14, 4, 5),
(15, 7, 3),
(16, 7, 5),
(17, 8, 5),
(18, 8, 4),
(19, 8, 2),
(20, 9, 5),
(21, 9, 6),
(22, 9, 3),
(23, 10, 2),
(24, 10, 4),
(25, 10, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `email`) VALUES
(1, '1@1');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(1, 'admin', 'admin11');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `makes`
--
ALTER TABLE `makes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `memory`
--
ALTER TABLE `memory`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `model_id` (`model_id`);

--
-- Индексы таблицы `product_colors`
--
ALTER TABLE `product_colors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `product_id_2` (`product_id`),
  ADD KEY `color_id` (`color_id`);

--
-- Индексы таблицы `product_memory`
--
ALTER TABLE `product_memory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `memory_id` (`memory_id`);

--
-- Индексы таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `makes`
--
ALTER TABLE `makes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `memory`
--
ALTER TABLE `memory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT для таблицы `product_memory`
--
ALTER TABLE `product_memory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`model_id`) REFERENCES `makes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product_colors`
--
ALTER TABLE `product_colors`
  ADD CONSTRAINT `product_colors_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_colors_ibfk_2` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product_memory`
--
ALTER TABLE `product_memory`
  ADD CONSTRAINT `product_memory_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_memory_ibfk_2` FOREIGN KEY (`memory_id`) REFERENCES `memory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
