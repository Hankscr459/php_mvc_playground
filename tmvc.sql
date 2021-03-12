-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-03-12 09:55:11
-- 伺服器版本： 10.4.17-MariaDB
-- PHP 版本： 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `tmvc`
--

-- --------------------------------------------------------

--
-- 資料表結構 `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `post_image` varchar(255) NOT NULL,
  `post_views_count` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `body`, `post_image`, `post_views_count`, `created_at`) VALUES
(2, 4, 'This is a test post two.', 'This is a description Two.', 'default.jpg', 0, '2021-03-09 16:55:03'),
(3, 4, 'test Post', 'this is a description', 'default.jpg', 0, '2021-03-09 22:41:25'),
(4, 4, 'test Post three', 'this is a description three', 'default.jpg', 0, '2021-03-10 10:25:28'),
(5, 4, 'Test Post four', 'this is a description four.', 'default.jpg', 0, '2021-03-10 10:26:58'),
(8, 2, 'test Post 7', 'this is a description.', 'default.jpg', 0, '2021-03-10 11:17:44'),
(9, 2, 'Test Post 8', 'this is a description.', 'default.jpg', 0, '2021-03-10 11:18:00'),
(10, 2, 'Test Post 9', 'this is a description.', 'default.jpg', 0, '2021-03-10 11:18:23'),
(11, 2, 'Test Post 10', 'this is a description', 'default.jpg', 1, '2021-03-10 11:18:40'),
(12, 2, 'Test Post 11', 'this is a description.', 'default.jpg', 0, '2021-03-10 11:18:58'),
(13, 2, 'Test Post 12', 'this is a description.', 'default.jpg', 0, '2021-03-10 11:19:19'),
(14, 2, 'Test title 13', 'this is description', 'default.jpg', 0, '2021-03-10 11:19:41'),
(15, 2, 'Test Post 14', 'this is adescription.', 'default.jpg', 0, '2021-03-10 11:19:55'),
(16, 2, 'Test Post 15', 'this is a description.', 'default.jpg', 0, '2021-03-10 11:20:17'),
(17, 2, 'Test Post 16', 'this is a description.', 'default.jpg', 2, '2021-03-10 11:20:42'),
(18, 4, 'Test Post', 'thus is a test post.', 'default.jpg', 0, '2021-03-10 20:15:04'),
(21, 4, 'Test Post', '123456', 'default.jpg', 0, '2021-03-10 20:52:28'),
(24, 4, 'Test Post', 'rg re', 'DD3.jpg', 2, '2021-03-10 22:34:05'),
(43, 4, 'Admin test Post', 'hty jt j', 'DD2.jpg', 1, '2021-03-11 14:17:31'),
(45, 4, 'Admin test Post', 'this is a test post', 'DD1.jpg', 0, '2021-03-11 15:27:27'),
(50, 4, 'Test Post', 'this is post image test.', 'default.jpg', 0, '2021-03-11 15:52:17'),
(51, 4, 'Test Post', 'test', 'DD3.jpg', 3, '2021-03-11 16:01:04'),
(52, 4, 'Test Post', 'm hj mjhj', 'LULU1_1615450432.jpg', 5, '2021-03-11 16:13:52'),
(57, 4, 'Test Post', 'jy tyjy t', 'default.jpg', 8, '2021-03-11 16:26:04'),
(58, 4, 'Test Post', 'juy ruj u', 'DD2_1615451222.jpg', 31, '2021-03-11 16:27:02');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL DEFAULT 'subscriber',
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `user_role`, `password`, `created_at`) VALUES
(2, 'black', 'black@gmail.com', 'subscriber', '$2y$10$vNpa5miMQZuT2IoGjtCaiuyzHIE0FYkMDrbuyHiGkuN00ht6vlOxO', '2021-03-09 14:37:42'),
(3, 'white', 'white@gmail.com', 'subscriber', '$2y$10$uTDFNUXA6EPvmgvQeCS/KuFCssW6s6hiuJuRVd0gOVsFewjUBoDpK', '2021-03-09 15:10:32'),
(4, 'hank', 'hank@gmail.com', 'admin', '$2y$10$TWZ9B1KwOJVzfcUveIOvsO5wtk5gtvSWL3fp3GeJeeJA09ImzTJxq', '2021-03-09 16:24:17');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
