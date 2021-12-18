-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2021 at 04:46 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `facebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `link` text NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `last_activity` datetime NOT NULL DEFAULT current_timestamp(),
  `changedNameAt` datetime DEFAULT NULL,
  `systems` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `username`, `link`, `email`, `mobile`, `password`, `birthday`, `gender`, `last_activity`, `changedNameAt`, `systems`) VALUES
(23, 'Mohamed', '', 'Hajji', 'MOHAMEDHAJJI', 'mohamedhajji7', 'pytaek1@gmail.com', '0601600907', '$2y$10$HAgLeDQ.k8UlvJOLUJi0..67B47JYTN/KCZSgo8xQNgu2U7wxVRjO', '1986-01-01', 'male', '2021-12-18 16:43:32', '2021-12-17 19:12:39', NULL),
(24, 'adad', NULL, 'addddddddd', 'adadaddddddddd', 'adadaddddddddd', 'pytaeadadk1@gmail.com', '0604006003', '$2y$10$5iHf6GKrNLsLxzNFo1UECeSrK54wcFjgSYDPzWgCeaTNWBBaOZz.m', '2021-01-01', 'male', '2021-12-08 23:16:29', NULL, ''),
(25, 'Abderrahim', NULL, 'Berrak', 'AbderrahimBerrak', 'AbderrahimBerrak', 'abderrahim@gmail.com', NULL, '$2y$10$Hz1OB3NbTD9GjTP.glRn4et8ngVSiOttiXUj7iWj29N5ZqVh48plq', '1996-10-04', 'male', '2021-12-18 16:22:34', NULL, NULL),
(26, 'Achraf', NULL, 'Hajji', 'AchrafHajji', 'AchrafHajji', 'achraf@gmail.com', NULL, '$2y$10$whTrxkEmsNExFkG7QUcU2OXPYuf6JX9ezVra2ONSHf0K5t6rKXgba', '2003-06-01', 'male', '2021-12-17 13:58:44', NULL, NULL),
(27, 'chaimae', NULL, 'hajji', 'chaimaehajji', 'chaimaehajji', 'chaimae@gmail.com', NULL, '$2y$10$yenN9Y7VBwcaEx4ZPLcI7ug34a/Djk40WDMqWhJEgiDAhbfC0AAq.', '2002-10-01', 'female', '2021-12-18 16:46:02', NULL, NULL),
(31, 'ada', NULL, 'dadada', 'adadadada', 'adadadada', 'aa@gmail.com', NULL, '$2y$10$JP3MK4o1eyuNU8gx/I5uV.H6ETlt7qRnSfzaVKqryPfbi41aVqbA.', '2013-01-01', 'male', '2021-12-18 13:50:30', NULL, NULL),
(32, 'ad', NULL, 'adadadad', 'adadadadad', 'adadadadad', 'xx@gmail.com', NULL, '$2y$10$Duh8LG/MTBnL.67k3qfub.E6D/BtRW4cVh/EPlcDPKj0.w.pRLMRa', '2021-01-01', 'male', '2021-12-18 14:00:44', NULL, NULL),
(33, 'mohamed', NULL, 'hajjii', 'mohamedhajjii', 'mohamedhajjii', 'py@gmail.com', NULL, '$2y$10$V0vyAX4PMrLiSjbBtbCzHOT8oImME9MKRNRZ/1k15gqh9GJmB0qfS', '2012-01-01', 'male', '2021-12-18 14:11:45', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
