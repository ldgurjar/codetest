-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2017 at 07:03 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codetest`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(10) NOT NULL,
  `answertext` text NOT NULL,
  `answertype` varchar(255) NOT NULL,
  `question_id` int(10) NOT NULL,
  `hassubquestion` int(1) NOT NULL,
  `subquestiondata` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `answertext`, `answertype`, `question_id`, `hassubquestion`, `subquestiondata`) VALUES
(1, 'werwer', 'Single Choice', 1, 1, 'a:2:{i:0;a:4:{s:2:"id";s:1:"1";s:11:"optionValue";s:14:"Multiline Text";s:12:"questiontext";s:9:"123123123";s:10:"answertext";a:1:{i:0;a:2:{s:2:"id";i:1;s:10:"answertext";s:9:"sdfsdfsdf";}}}i:1;a:4:{s:2:"id";s:1:"2";s:11:"optionValue";s:13:"Single Choice";s:12:"questiontext";s:21:"errrrrrrrrrrrrrrrrrrr";s:10:"answertext";a:3:{i:0;a:2:{s:2:"id";s:1:"1";s:10:"answertext";s:2:"r1";}i:1;a:2:{s:2:"id";s:1:"2";s:10:"answertext";s:2:"r2";}i:2;a:2:{s:2:"id";s:1:"3";s:10:"answertext";s:2:"r3";}}}}'),
(2, 'werwerwerwerwerwer', 'Single Choice', 1, 0, 'a:0:{}'),
(3, 'ewewewewewewewewewe', 'Single Choice', 1, 0, 'a:0:{}'),
(4, 'ttttttttttttttttttttttttttttttt', 'Multiple Choice', 2, 0, 'a:0:{}'),
(5, 'ggggggggggggggggg', 'Multiple Choice', 2, 0, 'a:0:{}'),
(6, 'eeeeeeeeeeeeeee', 'Multiple Choice', 2, 0, 'a:0:{}'),
(7, 'ssssssssssssssssssssss', 'Multiple Choice', 2, 0, 'a:0:{}'),
(8, 'ffffffffffffffffffffff', 'Multiple Choice', 2, 1, 'a:1:{i:0;a:4:{s:2:"id";s:1:"1";s:11:"optionValue";s:13:"Single Choice";s:12:"questiontext";s:9:"123123123";s:10:"answertext";a:3:{i:0;a:2:{s:2:"id";s:1:"1";s:10:"answertext";s:18:"qqqqqqqqqqqqqqqqqq";}i:1;a:2:{s:2:"id";s:1:"2";s:10:"answertext";s:31:"rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr";}i:2;a:2:{s:2:"id";s:1:"3";s:10:"answertext";s:21:"uuuuuuuuuuuuuuuuuuuuu";}}}}'),
(9, 'dfgdfgdfg', 'Multiline Text', 3, 0, 'a:0:{}'),
(10, 'dfgdfgdfg', 'Multiline Text', 4, 0, 'a:0:{}'),
(11, 'zxczxczxc', 'Multiline Text', 5, 0, 'a:0:{}'),
(12, 'xcvxcvxcv', 'Multiline Text', 6, 0, 'a:0:{}');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) NOT NULL,
  `questiontext` text NOT NULL,
  `question_parent` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `questiontext`, `question_parent`) VALUES
(1, 'xx', 0),
(2, 'sdfsdfsdfsdfdsf', 0),
(3, 'ddd', 0),
(4, 'ddd', 0),
(5, 'zxczxc', 0),
(6, 'xcvxcv', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
