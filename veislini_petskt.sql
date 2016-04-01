-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016 m. Bal 01 d. 17:53
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `veislini_petskt`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `message`
--

CREATE TABLE `message` (
  `message_id` int(10) NOT NULL,
  `user_id` varchar(5) NOT NULL,
  `time` date NOT NULL,
  `text` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `room`
--

CREATE TABLE `room` (
  `user_id` int(5) NOT NULL,
  `room_id` int(1) NOT NULL,
  `room_name` varchar(50) NOT NULL,
  `capacity` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `user`
--

CREATE TABLE `user` (
  `user_id` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `age` int(3) NOT NULL,
  `country` varchar(30) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `visability` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `first_name`, `last_name`, `age`, `country`, `gender`, `visability`) VALUES
(24, 'Petras9999', 'fa246d0262c3925617b0c72bb20eeb1d', 'petras@gmail.com', 'Petras', 'Å ukutis', 21, 'Lietuva', 'Vyras', 0),
(48, 'Elvinas', '7efed9180bef6f5efd82d443691ca895', 'elvinas21@gmail.com', 'Elvinas', 'KaÄerauskas', 21, 'Lietuva', 'Vyras', 0),
(81, 'Jonas9999', 'fa246d0262c3925617b0c72bb20eeb1d', 'Jonass@gmail.com', 'Jonas', 'Jonaitis', 40, 'Anglija', 'Vyras', 0);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `user_room`
--

CREATE TABLE `user_room` (
  `user_id` int(5) NOT NULL,
  `room_id` int(3) NOT NULL,
  `room_name` varchar(50) DEFAULT NULL,
  `capacity` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD UNIQUE KEY `room_id` (`room_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `user_room`
--
ALTER TABLE `user_room`
  ADD PRIMARY KEY (`room_id`),
  ADD UNIQUE KEY `room_id` (`room_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `user_room`
--
ALTER TABLE `user_room`
  MODIFY `room_id` int(3) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
