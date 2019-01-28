-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2016 at 08:12 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
CREATE TABLE IF NOT EXISTS `author` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_first_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_last_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`author_id`),
  UNIQUE KEY `author_first_name` (`author_first_name`,`author_last_name`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `author_first_name`, `author_last_name`) VALUES
(5, 'allen ', 'turing'),
(10, 'ameer', 'hamza'),
(13, 'hassan', 'iftikhar'),
(7, 'nimra', 'ahmad'),
(9, 'Paul', 'Woker'),
(14, 'sabeen', 'mustafa'),
(8, 'sumera', 'hameed'),
(3, 'thomas', 'edison'),
(4, 'tonny ', 'gaddies'),
(6, 'umera ', 'ahmad');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `book_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_id` tinyint(1) NOT NULL,
  `isbn` int(11) NOT NULL,
  PRIMARY KEY (`book_id`),
  KEY `status_id` (`status_id`),
  KEY `isbn` (`isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `status_id`, `isbn`) VALUES
('b-01', 2, 1189),
('b-02', 2, 1190),
('b-03', 1, 1188),
('b-04', 2, 1169),
('b-06', 2, 1170),
('b-07', 2, 1169),
('b-08', 2, 1188),
('b-11', 1, 114477);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_type` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_type` (`category_type`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_type`) VALUES
(31, 'computing'),
(1, 'database'),
(4, 'designing'),
(58, 'fiction'),
(46, 'General Knowledge'),
(66, 'magazine'),
(2, 'networks'),
(5, 'novels'),
(3, 'programing'),
(57, 'science'),
(38, 'technology');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`) VALUES
(1, 'computer sciences'),
(2, 'arts & architecture'),
(3, 'pharmacy');

-- --------------------------------------------------------

--
-- Table structure for table `isbn`
--

DROP TABLE IF EXISTS `isbn`;
CREATE TABLE IF NOT EXISTS `isbn` (
  `isbn` int(11) NOT NULL,
  `book_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `book_edition` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`isbn`),
  KEY `category_id` (`category_id`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `isbn`
--

INSERT INTO `isbn` (`isbn`, `book_name`, `category_id`, `book_edition`, `author_id`) VALUES
(1169, 'intro to computing', 1, '2nd', 3),
(1170, 'peere kamil', 5, '3rd', 6),
(1188, 'intro to programming', 1, '1st', 3),
(1189, 'musnaf', 5, '2nd', 7),
(1190, 'namal', 2, '4th', 7),
(114477, 'The Nuclear weapon', 46, '2', 9),
(455678, 'namal', 5, '5th', 7);

-- --------------------------------------------------------

--
-- Table structure for table `issue_date`
--

DROP TABLE IF EXISTS `issue_date`;
CREATE TABLE IF NOT EXISTS `issue_date` (
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  PRIMARY KEY (`issue_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issue_date`
--

INSERT INTO `issue_date` (`issue_date`, `due_date`) VALUES
('1982-08-01', '1982-08-20'),
('1982-08-10', '1982-08-20'),
('1982-09-11', '1982-09-21'),
('1982-10-13', '1982-10-23'),
('1982-10-14', '1982-10-24'),
('2016-05-05', '2016-05-15'),
('2016-05-10', '2016-05-20'),
('2016-05-15', '2016-05-25'),
('2016-05-19', '2016-05-29'),
('2016-05-20', '2016-05-30'),
('2016-05-21', '2016-05-31'),
('2016-05-23', '2016-06-02'),
('2016-05-24', '2016-06-03'),
('2016-05-25', '2016-06-04'),
('2016-05-26', '2016-06-05'),
('2016-05-27', '2016-06-06'),
('2016-05-28', '2016-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `issue_return`
--

DROP TABLE IF EXISTS `issue_return`;
CREATE TABLE IF NOT EXISTS `issue_return` (
  `book_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issue_date` date NOT NULL,
  `student_id` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teacher_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `fine` int(11) DEFAULT NULL,
  PRIMARY KEY (`book_id`,`issue_date`),
  KEY `student_id` (`student_id`),
  KEY `teacher_id` (`teacher_id`),
  KEY `issue_date` (`issue_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issue_return`
--

INSERT INTO `issue_return` (`book_id`, `issue_date`, `student_id`, `teacher_id`, `return_date`, `fine`) VALUES
('b-01', '1982-08-01', 'bcsf14a003', NULL, '1982-08-11', 10),
('b-01', '1982-10-14', 'bcsf14a016', NULL, '1982-10-25', 10),
('b-01', '2016-05-05', 'BCSF14A003', NULL, '2016-05-20', 50),
('b-01', '2016-05-21', 'BCSF14A040', NULL, '2016-05-21', 100),
('b-02', '1982-08-10', 'bcsf14a006', NULL, '1982-08-14', 0),
('b-02', '2016-05-21', 'BCSF14A028', NULL, '2016-06-03', 30),
('b-02', '2016-05-24', 'bcsf14a003', NULL, '2016-05-30', 0),
('b-03', '1982-09-11', 'bcsf14a003', NULL, '1982-09-23', 20),
('b-03', '2016-05-27', NULL, '5', NULL, NULL),
('b-08', '2016-05-28', NULL, '5', '2016-05-20', 0),
('b-11', '2016-05-23', 'BCSF14A028', NULL, '2016-05-23', 100),
('b-11', '2016-05-24', NULL, 'b-900', '2016-05-24', 0),
('b-11', '2016-05-26', 'bcsf14a003', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `status_id` tinyint(1) NOT NULL,
  `status_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_type`) VALUES
(1, 'issued'),
(2, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `student_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_semester` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`student_id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_first_name`, `student_last_name`, `current_semester`, `department_id`) VALUES
('bcsf14a003', 'fahad', 'fiaz', 5, 2),
('bcsf14a006', 'ali', 'rehman', 2, 3),
('bcsf14a016', 'asma', 'maqsood', 1, 1),
('BCSF14A028', 'hassan', 'iftikhar', 4, 1),
('bcsf14a030', 'waqar', 'butt', 4, 1),
('bcsf14a032', 'mehru', 'nisa', 3, 1),
('bcsf14a040', 'zain', 'asghar', 4, 1),
('BCSF14A044', 'abdul', 'sadd', 5, 1),
('BCSF14A055', 'Hamza', 'Shafique', 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE IF NOT EXISTS `teacher` (
  `teacher_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`teacher_id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `teacher_first_name`, `teacher_last_name`, `gender`, `department_id`) VALUES
('1', 'sir', 'asim', 'male', 1),
('2', 'sir', 'tariq', 'male', 2),
('23', 'zain', 'ali', 'male', 2),
('3', 'mam', 'esha', 'female', 2),
('4', 'mam', 'fatima', 'female', 3),
('5', 'sir', 'sadaqat', 'male', 1),
('7', 'zain', 'asghar', 'male', 3),
('b-900', 'emma', 'watson', 'female', 2),
('T-05', 'Sir', 'Gazali', 'male', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`),
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `isbn` (`isbn`);

--
-- Constraints for table `isbn`
--
ALTER TABLE `isbn`
  ADD CONSTRAINT `isbn_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `isbn_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`);

--
-- Constraints for table `issue_return`
--
ALTER TABLE `issue_return`
  ADD CONSTRAINT `issue_return_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `issue_return_ibfk_3` FOREIGN KEY (`issue_date`) REFERENCES `issue_date` (`issue_date`),
  ADD CONSTRAINT `issue_return_ibfk_4` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`),
  ADD CONSTRAINT `issue_return_ibfk_5` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
