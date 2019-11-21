-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2019 at 08:19 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `football`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `finalplayers`
--

CREATE TABLE `finalplayers` (
  `schedule_id` int(11) NOT NULL,
  `club_name` varchar(20) DEFAULT NULL,
  `pl1` varchar(20) DEFAULT NULL,
  `pl2` varchar(20) DEFAULT NULL,
  `pl3` varchar(20) DEFAULT NULL,
  `pl4` varchar(20) DEFAULT NULL,
  `pl5` varchar(20) DEFAULT NULL,
  `pl6` varchar(20) DEFAULT NULL,
  `pl7` varchar(20) DEFAULT NULL,
  `pl8` varchar(20) DEFAULT NULL,
  `pl9` varchar(20) DEFAULT NULL,
  `pl10` varchar(20) DEFAULT NULL,
  `pl11` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finalplayers`
--

INSERT INTO `finalplayers` (`schedule_id`, `club_name`, `pl1`, `pl2`, `pl3`, `pl4`, `pl5`, `pl6`, `pl7`, `pl8`, `pl9`, `pl10`, `pl11`) VALUES
(14, 'Manchister', 'sicico', 'pogba', 'martial', 'lingard', 'Huan', 'Eric', 'Alexis', 'Romelo', 'nimania', 'andere', 'phil');

-- --------------------------------------------------------

--
-- Table structure for table `zclub`
--

CREATE TABLE `zclub` (
  `club_id` int(11) NOT NULL,
  `club_name` varchar(30) NOT NULL,
  `stadium` varchar(25) DEFAULT NULL,
  `est_date` date NOT NULL,
  `admin_username` varchar(25) NOT NULL,
  `admin_password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zclub`
--

INSERT INTO `zclub` (`club_id`, `club_name`, `stadium`, `est_date`, `admin_username`, `admin_password`) VALUES
(11, 'Manchister', 'Oltraford', '2018-11-05', 'ale', '2121'),
(12, 'City', 'Eitihad', '2019-05-05', 'amanaman', '212121'),
(13, 'Chelse', 'stamford', '2019-06-03', 'man', '234'),
(14, 'tot', 'emirates', '2019-07-24', 'nana', '456'),
(15, 'liverpool', 'anfild', '2019-07-09', 'yyyy', '456');

-- --------------------------------------------------------

--
-- Table structure for table `zclub_info`
--

CREATE TABLE `zclub_info` (
  `season_id` int(11) NOT NULL,
  `club_name` varchar(30) NOT NULL,
  `played` int(4) DEFAULT 0,
  `win` int(4) DEFAULT 0,
  `lose` int(4) DEFAULT 0,
  `draw` int(4) DEFAULT 0,
  `goalscore` int(4) DEFAULT 0,
  `goalon` int(4) DEFAULT 0,
  `goaldifference` int(4) DEFAULT 0,
  `club_point` int(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zclub_info`
--

INSERT INTO `zclub_info` (`season_id`, `club_name`, `played`, `win`, `lose`, `draw`, `goalscore`, `goalon`, `goaldifference`, `club_point`) VALUES
(42, 'Chelse', 1, 1, 0, 0, 5, 2, 3, 3),
(42, 'City', 2, 0, 1, 1, 3, 5, -2, 1),
(42, 'liverpool', 1, 0, 1, 0, 2, 5, -3, 0),
(42, 'Manchister', 1, 1, 0, 0, 4, 2, 2, 3),
(42, 'tot', 1, 0, 0, 1, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `zcoach`
--

CREATE TABLE `zcoach` (
  `coach_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `fname` varchar(10) DEFAULT NULL,
  `lname` varchar(10) DEFAULT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `new_match_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zcoach`
--

INSERT INTO `zcoach` (`coach_id`, `club_id`, `fname`, `lname`, `username`, `password`, `new_match_id`) VALUES
(1, 11, 'Oliguiner', 'Solishire', 'ole', 'ole', NULL),
(2, 12, 'sarr', 'marisio', 'mar', 'mar', NULL),
(3, 13, 'poch', 'cam', 'bar', 'bar', NULL),
(4, 14, 'tion', 'marisio', 'man', 'man', NULL),
(5, 15, 'fofo', 'dodo', 'coco', 'coco', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `zfan`
--

CREATE TABLE `zfan` (
  `ID` int(11) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `surname` varchar(20) DEFAULT NULL,
  `favTeamID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zfan`
--

INSERT INTO `zfan` (`ID`, `username`, `password`, `name`, `surname`, `favTeamID`) VALUES
(12, 'aaaa', 'aaaa', 'Ake', 'Man', 11),
(13, 'sam', 'sam', 'Samuel', 'Abebe', 13),
(14, 'aman', 'aman', 'Aman', 'MyBest', 12);

-- --------------------------------------------------------

--
-- Table structure for table `zmatch_detail`
--

CREATE TABLE `zmatch_detail` (
  `match_id` int(11) NOT NULL,
  `home_score` int(11) DEFAULT 0,
  `home_pos` int(11) DEFAULT 0,
  `home_attempt` int(11) DEFAULT 0,
  `home_target` int(11) DEFAULT 0,
  `away_score` int(11) DEFAULT 0,
  `away_pos` int(11) DEFAULT 0,
  `away_attempt` int(11) DEFAULT 0,
  `away_target` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zmatch_detail`
--

INSERT INTO `zmatch_detail` (`match_id`, `home_score`, `home_pos`, `home_attempt`, `home_target`, `away_score`, `away_pos`, `away_attempt`, `away_target`) VALUES
(14, 4, 69, 40, 30, 2, 31, 32, 23),
(15, 2, 44, 60, 50, 5, 56, 44, 12),
(16, 1, 56, 34, 21, 1, 44, 31, 31),
(17, 5, 74, 14, 8, 3, 26, 20, 9),
(18, 4, 50, 50, 25, 3, 50, 20, 10),
(19, 6, 50, 50, 25, 3, 50, 20, 10),
(20, 1, 50, 50, 25, 3, 50, 20, 10),
(21, 2, 50, 50, 25, 3, 50, 20, 10);

-- --------------------------------------------------------

--
-- Table structure for table `zplayer`
--

CREATE TABLE `zplayer` (
  `player_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `fname` varchar(20) DEFAULT NULL,
  `lname` varchar(20) DEFAULT NULL,
  `tshirt_num` int(5) DEFAULT NULL,
  `Bdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zplayer`
--

INSERT INTO `zplayer` (`player_id`, `club_id`, `fname`, `lname`, `tshirt_num`, `Bdate`) VALUES
(1, 11, 'pogba', 'poli', 6, '2018-05-07'),
(2, 11, 'martial', 'antony', 11, '2018-10-07'),
(3, 11, 'lingard', 'jesi', 5, '2016-07-10'),
(6, 11, 'Huan', 'Mata', 8, '1978-03-12'),
(7, 11, 'Eric', 'Bailey', 3, '2018-12-03'),
(8, 11, 'Alexis', 'Sanches', 7, '2019-07-07'),
(9, 11, 'Romelo', 'lukaku', 9, '0000-00-00'),
(10, 11, 'nimania', 'matich', 31, '2019-07-07'),
(11, 11, 'andere', 'herera', 21, '2019-07-07'),
(12, 11, 'phil', 'jones', 4, '2019-07-01'),
(13, 11, 'sicico', 'totnham', 15, '2019-07-01'),
(14, 11, 'Degia', 'degi', 1, '2019-07-01'),
(15, 11, 'luke', 'shaw', 5, '2019-07-08'),
(16, 13, 'EDEN', 'HAZARD', 10, '2019-07-01'),
(17, 13, 'Hary', 'mag', 5, '2019-07-02'),
(18, 13, 'marcos', 'Alonso', 7, '2019-07-01'),
(19, 13, 'Wiliam', 'hhh', 10, '2019-07-08'),
(20, 13, 'Wiliam', 'hhh', 10, '2019-07-08'),
(21, 13, 'gAahj', 'ckl', 6, '1999-09-09'),
(22, 13, 'huuh', 'ckl', 9, '1999-09-09'),
(23, 13, 'fdkjh', 'ckl', 10, '1999-09-09'),
(24, 13, 'dsjhf', 'ckl', 11, '1999-09-09'),
(25, 13, 'fkjsd', 'ckl', 69, '1999-09-09'),
(26, 13, 'jaksd', 'ckl', 16, '1999-09-09'),
(27, 13, 'jjkdf', 'ckl', 26, '1999-09-09'),
(28, 13, 'kane', 'ckl', 36, '1999-09-09'),
(29, 13, 'mnn', 'ckl', 36, '1999-09-09'),
(30, 13, 'dsaj', 'ckl', 56, '1999-09-09'),
(31, 13, 'sad', 'ckl', 66, '1999-09-09'),
(32, 12, 'gAahj', 'ckl', 6, '1999-09-09'),
(33, 12, 'huuh', 'ckl', 9, '1999-09-09'),
(34, 12, 'fdkjh', 'ckl', 10, '1999-09-09'),
(35, 12, 'dsjhf', 'ckl', 11, '1999-09-09'),
(36, 12, 'fkjsd', 'ckl', 69, '1999-09-09'),
(37, 12, 'jaksd', 'ckl', 16, '1999-09-09'),
(38, 12, 'jjkdf', 'ckl', 26, '1999-09-09'),
(39, 12, 'kane', 'ckl', 36, '1999-09-09'),
(40, 12, 'mnn', 'ckl', 36, '1999-09-09'),
(41, 12, 'dsaj', 'ckl', 56, '1999-09-09'),
(42, 12, 'sad', 'ckl', 66, '1999-09-09'),
(43, 14, 'gAahj', 'ckl', 6, '1999-09-09'),
(44, 14, 'huuh', 'ckl', 9, '1999-09-09'),
(45, 14, 'fdkjh', 'ckl', 10, '1999-09-09'),
(46, 14, 'dsjhf', 'ckl', 11, '1999-09-09'),
(47, 14, 'fkjsd', 'ckl', 69, '1999-09-09'),
(48, 14, 'jaksd', 'ckl', 16, '1999-09-09'),
(49, 14, 'jjkdf', 'ckl', 26, '1999-09-09'),
(50, 14, 'kane', 'ckl', 36, '1999-09-09'),
(51, 14, 'mnn', 'ckl', 36, '1999-09-09'),
(52, 14, 'dsaj', 'ckl', 56, '1999-09-09'),
(53, 14, 'sad', 'ckl', 66, '1999-09-09'),
(54, 15, 'gAahj', 'ckl', 6, '1999-09-09'),
(55, 15, 'huuh', 'ckl', 9, '1999-09-09'),
(56, 15, 'fdkjh', 'ckl', 10, '1999-09-09'),
(57, 15, 'dsjhf', 'ckl', 11, '1999-09-09'),
(58, 15, 'fkjsd', 'ckl', 69, '1999-09-09'),
(59, 15, 'jaksd', 'ckl', 16, '1999-09-09'),
(60, 15, 'jjkdf', 'ckl', 26, '1999-09-09'),
(61, 15, 'kane', 'ckl', 36, '1999-09-09'),
(62, 15, 'mnn', 'ckl', 36, '1999-09-09'),
(63, 15, 'dsaj', 'ckl', 56, '1999-09-09'),
(64, 15, 'sad', 'ckl', 66, '1999-09-09');

-- --------------------------------------------------------

--
-- Table structure for table `zplayer_info`
--

CREATE TABLE `zplayer_info` (
  `player_id` int(11) NOT NULL,
  `season_id` int(11) NOT NULL,
  `player_goal` int(11) DEFAULT NULL,
  `player_assist` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zrefree`
--

CREATE TABLE `zrefree` (
  `refree_id` int(11) NOT NULL,
  `refree_name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `ref_username` varchar(20) NOT NULL,
  `ref_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zrefree`
--

INSERT INTO `zrefree` (`refree_id`, `refree_name`, `surname`, `ref_username`, `ref_password`) VALUES
(1, 'Yideg', 'misge', 'roll', '992a6d18b2a148cf20d9');

-- --------------------------------------------------------

--
-- Table structure for table `zschedule`
--

CREATE TABLE `zschedule` (
  `schedule_id` int(11) NOT NULL,
  `season_id` int(11) NOT NULL,
  `home_team` varchar(20) NOT NULL,
  `away_team` varchar(20) NOT NULL,
  `stadium` varchar(20) NOT NULL,
  `refree` varchar(20) NOT NULL,
  `match_date` date NOT NULL,
  `match_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zschedule`
--

INSERT INTO `zschedule` (`schedule_id`, `season_id`, `home_team`, `away_team`, `stadium`, `refree`, `match_date`, `match_time`) VALUES
(14, 42, 'Manchister', 'City', 'Oltraford', 'Yideg', '2019-07-17', '13:00:00'),
(15, 42, 'liverpool', 'Chelse', 'anfild', 'Yideg', '2019-07-27', '02:00:00'),
(16, 42, 'tot', 'City', 'anfild', 'Yideg', '2019-07-25', '01:00:00'),
(17, 42, 'Manchister', 'liverpool', 'anfild', 'Yideg', '2019-06-17', '13:00:00'),
(18, 42, 'Manchister', 'Chelse', 'anfild', 'Yideg', '2018-09-09', '13:00:00'),
(19, 42, 'Manchister', 'liverpool', 'anfild', 'Yideg', '2018-09-09', '13:00:00'),
(20, 42, 'tot', 'Chelse', 'anfild', 'Yideg', '2018-09-09', '13:00:00'),
(21, 42, 'liverpool', 'Chelse', 'anfild', 'Yideg', '2018-09-09', '13:00:00'),
(22, 42, 'tot', 'Manchister', 'Oltraford', 'Yideg', '2019-07-31', '01:00:00'),
(23, 42, 'Chelse', 'tot', 'stamford', 'Yideg', '2019-07-25', '01:00:00'),
(24, 42, 'liverpool', 'Chelse', 'emirates', 'Yideg', '2019-07-30', '01:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `zseason`
--

CREATE TABLE `zseason` (
  `id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zseason`
--

INSERT INTO `zseason` (`id`, `start_date`, `end_date`) VALUES
(42, '2019-07-12', '2020-05-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `finalplayers`
--
ALTER TABLE `finalplayers`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `zclub`
--
ALTER TABLE `zclub`
  ADD PRIMARY KEY (`club_id`);

--
-- Indexes for table `zclub_info`
--
ALTER TABLE `zclub_info`
  ADD PRIMARY KEY (`season_id`,`club_name`);

--
-- Indexes for table `zcoach`
--
ALTER TABLE `zcoach`
  ADD PRIMARY KEY (`coach_id`),
  ADD KEY `club_id` (`club_id`),
  ADD KEY `new_match_id` (`new_match_id`);

--
-- Indexes for table `zfan`
--
ALTER TABLE `zfan`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `favTeamID` (`favTeamID`);

--
-- Indexes for table `zmatch_detail`
--
ALTER TABLE `zmatch_detail`
  ADD PRIMARY KEY (`match_id`);

--
-- Indexes for table `zplayer`
--
ALTER TABLE `zplayer`
  ADD PRIMARY KEY (`player_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `zplayer_info`
--
ALTER TABLE `zplayer_info`
  ADD PRIMARY KEY (`player_id`,`season_id`),
  ADD KEY `season_id` (`season_id`);

--
-- Indexes for table `zrefree`
--
ALTER TABLE `zrefree`
  ADD PRIMARY KEY (`refree_id`),
  ADD UNIQUE KEY `ref_username` (`ref_username`),
  ADD UNIQUE KEY `ref_password` (`ref_password`);

--
-- Indexes for table `zschedule`
--
ALTER TABLE `zschedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `season_id` (`season_id`);

--
-- Indexes for table `zseason`
--
ALTER TABLE `zseason`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `zclub`
--
ALTER TABLE `zclub`
  MODIFY `club_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `zcoach`
--
ALTER TABLE `zcoach`
  MODIFY `coach_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `zfan`
--
ALTER TABLE `zfan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `zplayer`
--
ALTER TABLE `zplayer`
  MODIFY `player_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `zrefree`
--
ALTER TABLE `zrefree`
  MODIFY `refree_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `zschedule`
--
ALTER TABLE `zschedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `zseason`
--
ALTER TABLE `zseason`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `finalplayers`
--
ALTER TABLE `finalplayers`
  ADD CONSTRAINT `finalplayers_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `zschedule` (`schedule_id`);

--
-- Constraints for table `zcoach`
--
ALTER TABLE `zcoach`
  ADD CONSTRAINT `zcoach_ibfk_1` FOREIGN KEY (`club_id`) REFERENCES `zclub` (`club_id`),
  ADD CONSTRAINT `zcoach_ibfk_2` FOREIGN KEY (`new_match_id`) REFERENCES `zschedule` (`schedule_id`);

--
-- Constraints for table `zfan`
--
ALTER TABLE `zfan`
  ADD CONSTRAINT `zfan_ibfk_1` FOREIGN KEY (`favTeamID`) REFERENCES `zclub` (`club_id`);

--
-- Constraints for table `zmatch_detail`
--
ALTER TABLE `zmatch_detail`
  ADD CONSTRAINT `zmatch_detail_ibfk_1` FOREIGN KEY (`match_id`) REFERENCES `zschedule` (`schedule_id`),
  ADD CONSTRAINT `zmatch_detail_ibfk_2` FOREIGN KEY (`match_id`) REFERENCES `zschedule` (`schedule_id`);

--
-- Constraints for table `zplayer`
--
ALTER TABLE `zplayer`
  ADD CONSTRAINT `zplayer_ibfk_1` FOREIGN KEY (`club_id`) REFERENCES `zclub` (`club_id`);

--
-- Constraints for table `zplayer_info`
--
ALTER TABLE `zplayer_info`
  ADD CONSTRAINT `zplayer_info_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `zplayer` (`player_id`),
  ADD CONSTRAINT `zplayer_info_ibfk_2` FOREIGN KEY (`season_id`) REFERENCES `zseason` (`id`);

--
-- Constraints for table `zschedule`
--
ALTER TABLE `zschedule`
  ADD CONSTRAINT `zschedule_ibfk_1` FOREIGN KEY (`season_id`) REFERENCES `zseason` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
