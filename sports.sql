-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 19, 2018 at 07:36 PM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sports`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `staff_id` int(10) NOT NULL,
  `admin_username` varchar(50) NOT NULL,
  `admin_fname` varchar(30) NOT NULL,
  `admin_lname` varchar(30) NOT NULL,
  `admin_nid` varchar(30) NOT NULL,
  `admin_phone` varchar(30) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT '1',
  `date_registered` date NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`staff_id`, `admin_username`, `admin_fname`, `admin_lname`, `admin_nid`, `admin_phone`, `admin_email`, `active_status`, `date_registered`, `date_updated`, `password`) VALUES
(78581, 'smokoros', 'Steeh', 'Mokoro', '31537790', '0719508386', 'stephenmokoro@gmail.com', 1, '2017-11-30', '2017-11-30 15:48:17', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `captains`
--

CREATE TABLE `captains` (
  `player_auto_id` int(10) NOT NULL,
  `player_team_id` int(5) NOT NULL,
  `user_agreement` tinyint(1) NOT NULL DEFAULT '1',
  `date_appointed` date NOT NULL,
  `end_of_tenure` date DEFAULT NULL,
  `capt_before` tinyint(1) NOT NULL DEFAULT '0',
  `date_registered` date NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active_status` tinyint(1) NOT NULL DEFAULT '1',
  `reason_inactive` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `coaches`
--

CREATE TABLE `coaches` (
  `coach_staff_id` int(10) NOT NULL,
  `coach_nid` varchar(30) NOT NULL,
  `coach_fname` varchar(30) NOT NULL,
  `coach_lname` varchar(30) NOT NULL,
  `coach_other_names` varchar(50) DEFAULT NULL,
  `coach_gender` varchar(10) NOT NULL,
  `coach_username` varchar(30) NOT NULL,
  `coach_phone` varchar(30) NOT NULL,
  `coach_email` varchar(100) NOT NULL,
  `coach_residence` varchar(100) NOT NULL,
  `prev_coaching_state` tinyint(1) NOT NULL DEFAULT '0',
  `prev_team` varchar(100) NOT NULL,
  `coach_sport_id` int(5) NOT NULL,
  `coach_h_achievement` varchar(150) DEFAULT NULL,
  `user_agreement` tinyint(1) NOT NULL DEFAULT '1',
  `date_appointed` date NOT NULL,
  `end_of_tenure` date DEFAULT NULL,
  `date_registered` date NOT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT '1',
  `reason_inactive` varchar(100) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coaches`
--

INSERT INTO `coaches` (`coach_staff_id`, `coach_nid`, `coach_fname`, `coach_lname`, `coach_other_names`, `coach_gender`, `coach_username`, `coach_phone`, `coach_email`, `coach_residence`, `prev_coaching_state`, `prev_team`, `coach_sport_id`, `coach_h_achievement`, `user_agreement`, `date_appointed`, `end_of_tenure`, `date_registered`, `active_status`, `reason_inactive`, `password`, `date_updated`) VALUES
(9876, '69170988', 'Chandler', 'Leonard', 'Olympia Reese', '', 'mokoro5', '0743154944', 'judufygag@hotmail.com', 'Rerum obcaecati ', 0, 'Irure id molesti', 5, 'Rerum obcaecati ', 1, '2017-11-20', NULL, '2017-12-02', 1, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2018-01-19 16:52:12'),
(74865, '5235935', 'Cassandra', 'Shields', 'Jaime Hanson', '', 'mokoro1', '0799474198', 'zuginivi@hotmail.com', 'Laboriosam itaq', 0, 'Laboriosam itaq', 1, 'Laboriosam itaq', 1, '2017-11-20', NULL, '2017-12-01', 1, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2018-01-19 16:51:52'),
(78580, '31537791', 'Samora', 'Mokoro', '', '', 'mokoro7', '0719508387', 'stephen.mokoro1@strathmore.edu', 'Et aut voluptates sed reprehenderit nisi s', 0, 'In ex eos reiciendi', 7, 'Et aut voluptates sed reprehenderit nisi s', 1, '2017-11-20', NULL, '2017-10-14', 1, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2018-01-19 16:53:03'),
(78581, '31537790', 'Stephen', 'Maina', NULL, '', 'mokoro', '0719508386', 'stephen.mokoro@strathmore.edu', 'Madaraka Estate', 0, '', 13, NULL, 1, '2017-11-20', NULL, '2017-10-14', 1, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2017-12-04 07:23:05'),
(78582, '31537792', 'Daniel', 'Odero', '', '', 'mokoro2', '0719508385', 'stephen.mokoro2@strathmore.edu', 'h', 0, '', 2, 'h', 1, '2017-11-20', NULL, '2017-10-14', 1, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2017-12-04 07:23:10'),
(78583, '31537793', 'Bruce', 'Kenyatta', '', '', 'mokoro3', '0719508384', 'stephen.mokoro3@strathmore.edu', 'fff', 1, '', 3, 'fff', 1, '2017-11-20', NULL, '2017-10-14', 1, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2017-12-04 07:23:13'),
(78584, '31537794', 'Sokoro', 'Nyangwono', NULL, '', 'mokoro4', '0719508383', 'stephen.mokoro4@strathmore.edu', 'Madaraka Estate', 0, '', 4, NULL, 1, '2017-11-20', NULL, '2017-10-14', 1, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2017-12-04 07:23:17'),
(78585, '31537795', 'Salim', 'Abdulah', '', '', 'mokoro6', '0719508382', 'stephen.mokoro5@strathmore.edu', 'dd', 0, '', 6, 'dd', 1, '2017-11-20', NULL, '2017-10-14', 1, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2018-01-19 16:52:22'),
(89526, '37520377', 'Emery', 'Ball', 'Merrill Everett', '', 'mokoro8', '0755158142', 'foqu@gmail.com', 'Nairobi South Estate', 0, '', 7, 'The best player-Kenya Premier League', 1, '2017-11-20', NULL, '2017-12-04', 1, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2018-01-19 16:53:10'),
(97867, '16879798', 'Ori', 'Harrington', 'Lisandra Bean', '', 'mokoro9', '0773871655', 'paky@yahoo.com', 'Iure venia', 0, 'Rerum ', 9, 'Iure venia', 1, '2017-11-20', NULL, '2017-12-02', 1, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2018-01-19 16:53:14');

-- --------------------------------------------------------

--
-- Table structure for table `coach_reports`
--

CREATE TABLE `coach_reports` (
  `report_auto_id` int(10) NOT NULL,
  `report_file_name` varchar(150) NOT NULL,
  `report_descriptive_name` varchar(100) NOT NULL,
  `report_date_uploaded` date NOT NULL,
  `report_date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `report_sport_id` int(10) NOT NULL,
  `specific_1_general_0` int(10) NOT NULL DEFAULT '1',
  `file_ext` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coach_reports`
--

INSERT INTO `coach_reports` (`report_auto_id`, `report_file_name`, `report_descriptive_name`, `report_date_uploaded`, `report_date_updated`, `report_sport_id`, `specific_1_general_0`, `file_ext`) VALUES
(3, '934252348921d56c8aea8f2545a62f9e.pdf', 'This is a trial bwana', '2018-01-19', '2018-01-19 17:12:55', 5, 1, '.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` varchar(15) NOT NULL,
  `course_name` varchar(150) NOT NULL,
  `faculty` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `faculty`) VALUES
('BBIT', 'Bachelor of Business Information Technology', 'Faculty of Information Technology'),
('BCOM', 'Bachelor of Commerce', 'Commerce');

-- --------------------------------------------------------

--
-- Table structure for table `dummy`
--

CREATE TABLE `dummy` (
  `dummy_auto_id` int(10) NOT NULL,
  `old_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expenditures`
--

CREATE TABLE `expenditures` (
  `expense_auto_id` int(10) NOT NULL,
  `expense_category` varchar(10) NOT NULL,
  `expense_team_auto_id` int(10) NOT NULL,
  `expense_date` date NOT NULL,
  `expense_cash` double(10,2) NOT NULL,
  `expense_lpo_no` varchar(15) NOT NULL,
  `expense_lpo_amount` double(10,2) NOT NULL,
  `expense_lunches` double(10,2) NOT NULL,
  `expense_comment` varchar(150) NOT NULL,
  `expense_receipt` varchar(120) DEFAULT NULL,
  `expense_record_date` datetime NOT NULL,
  `expense_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenditures`
--

INSERT INTO `expenditures` (`expense_auto_id`, `expense_category`, `expense_team_auto_id`, `expense_date`, `expense_cash`, `expense_lpo_no`, `expense_lpo_amount`, `expense_lunches`, `expense_comment`, `expense_receipt`, `expense_record_date`, `expense_updated`) VALUES
(1, 'Women', 5, '2017-11-20', 89.00, '12', 53.00, 54.00, 'My Birthday', NULL, '2017-12-09 22:42:53', '2017-12-10 00:42:53'),
(2, 'Men', 5, '2017-11-20', 1000.00, '223', 20000.50, 100000.00, 'Heavy supper', NULL, '2017-12-09 22:44:06', '2017-12-10 00:44:06'),
(3, 'Women', 5, '2018-01-05', 29.00, '93', 37.00, 79.00, 'Reprehenderit sapiente', NULL, '2018-01-07 17:23:43', '2018-01-07 17:23:43'),
(4, 'Women', 5, '2017-11-20', 96.00, '64', 63.00, 20.00, 'Itaque consectetur alias deleni', NULL, '2018-01-11 23:44:20', '2018-01-11 23:44:20'),
(5, 'Women', 5, '2018-01-11', 5.00, '1', 97.00, 1.00, 'Laborum eos aut', NULL, '2018-01-11 23:45:56', '2018-01-11 23:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `game_auto_id` int(10) NOT NULL,
  `game_sport_auto_id` int(10) DEFAULT NULL,
  `game_team` int(10) NOT NULL,
  `game_match_type` int(2) NOT NULL,
  `game_title` varchar(100) NOT NULL,
  `game_start_date` date NOT NULL,
  `game_end_date` date NOT NULL,
  `game_summary` varchar(1500) DEFAULT NULL,
  `game_date_recorded` date NOT NULL,
  `game_date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`game_auto_id`, `game_sport_auto_id`, `game_team`, `game_match_type`, `game_title`, `game_start_date`, `game_end_date`, `game_summary`, `game_date_recorded`, `game_date_update`) VALUES
(1, 5, 2, 1, 'KUSA OPEN', '2018-01-13', '2018-01-14', NULL, '2018-01-13', '2018-01-13 18:10:01'),
(2, 5, 2, 1, 'KCB Open', '2018-01-20', '2018-01-21', NULL, '2018-01-13', '2018-01-13 20:28:32'),
(3, 5, 1, 1, 'KCB Open', '2018-01-14', '2018-01-15', NULL, '2018-01-14', '2018-01-13 23:52:35'),
(4, 5, 2, 1, 'Mark Tournament', '2018-01-16', '2018-01-18', NULL, '2018-01-15', '2018-01-15 16:00:30'),
(5, 5, 1, 1, 'KUSA Open', '2018-01-20', '2018-01-21', NULL, '2018-01-19', '2018-01-19 15:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `game_matches`
--

CREATE TABLE `game_matches` (
  `match_auto_id` int(10) NOT NULL,
  `match_game_id` int(10) NOT NULL,
  `match_date` date NOT NULL,
  `match_start_time` time NOT NULL,
  `match_opponents` varchar(50) NOT NULL,
  `match_venue` varchar(30) DEFAULT NULL,
  `match_end_time` time DEFAULT NULL,
  `match_opponents_score` int(5) DEFAULT '0',
  `match_level` varchar(20) NOT NULL,
  `match_date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game_matches`
--

INSERT INTO `game_matches` (`match_auto_id`, `match_game_id`, `match_date`, `match_start_time`, `match_opponents`, `match_venue`, `match_end_time`, `match_opponents_score`, `match_level`, `match_date_updated`) VALUES
(1, 1, '2018-01-13', '10:00:00', 'JKUAT', 'KU', NULL, 0, 'Preliminaries', '2018-01-14 18:21:04'),
(2, 2, '2018-01-13', '11:30:00', 'JKUAT', 'SU', '19:00:00', 2, 'Quarters', '2018-01-19 16:56:53'),
(3, 3, '2018-01-14', '02:30:00', 'Riara', 'Nyayo Stadium', '07:21:00', 2, 'Preliminaries', '2018-01-15 16:21:27'),
(4, 4, '2018-01-15', '12:00:00', 'Riara', 'MMU', '01:30:00', 3, 'Preliminaries', '2018-01-15 16:03:11'),
(5, 2, '2018-01-16', '14:00:00', 'Kavoka', 'Bimos', NULL, 0, 'Preliminaries', '2018-01-16 20:56:22'),
(6, 2, '2018-01-19', '19:08:00', 'KU', 'JKUAT', '20:00:00', 2, 'Quarters', '2018-01-19 16:58:04');

-- --------------------------------------------------------

--
-- Table structure for table `hockey_match_scores`
--

CREATE TABLE `hockey_match_scores` (
  `auto_id` int(10) NOT NULL,
  `player_id` int(10) NOT NULL,
  `score_time` time DEFAULT NULL,
  `green_time` time DEFAULT NULL,
  `yellow_time` time DEFAULT NULL,
  `red_time` time DEFAULT NULL,
  `match_id` int(10) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hockey_match_scores`
--

INSERT INTO `hockey_match_scores` (`auto_id`, `player_id`, `score_time`, `green_time`, `yellow_time`, `red_time`, `match_id`, `date_updated`) VALUES
(50, 21, '18:57:29', NULL, NULL, NULL, 6, '2018-01-19 16:57:29'),
(51, 21, '18:57:33', NULL, NULL, NULL, 6, '2018-01-19 16:57:33'),
(52, 21, '18:57:35', NULL, NULL, NULL, 6, '2018-01-19 16:57:35'),
(53, 21, '18:57:37', NULL, NULL, NULL, 6, '2018-01-19 16:57:37');

-- --------------------------------------------------------

--
-- Table structure for table `hockey_scores`
--

CREATE TABLE `hockey_scores` (
  `hockey_score_auto_id` int(10) NOT NULL,
  `hockey_match_id` int(10) NOT NULL,
  `hockey_player_id` int(10) NOT NULL,
  `score_minute` int(5) DEFAULT NULL,
  `green_card_minute` int(5) DEFAULT NULL,
  `yellow_card_minute` int(5) DEFAULT NULL,
  `red_card_minute` int(5) DEFAULT NULL,
  `time_recorded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `injury_records`
--

CREATE TABLE `injury_records` (
  `injury_auto_id` int(10) NOT NULL,
  `player_auto_id` int(10) NOT NULL,
  `injury_date` date NOT NULL,
  `date_seen` date NOT NULL,
  `injury_description` varchar(150) DEFAULT NULL,
  `diagnosis` varchar(150) DEFAULT NULL,
  `treatment` varchar(150) DEFAULT NULL,
  `physio_remarks` varchar(100) DEFAULT NULL,
  `coach_remarks` varchar(100) DEFAULT NULL,
  `enable_edit` tinyint(1) NOT NULL DEFAULT '0',
  `date_recorded` date NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `match_players`
--

CREATE TABLE `match_players` (
  `auto_id` int(10) NOT NULL,
  `match_id` int(10) NOT NULL,
  `match_player_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `match_players`
--

INSERT INTO `match_players` (`auto_id`, `match_id`, `match_player_id`) VALUES
(10, 6, 21);

-- --------------------------------------------------------

--
-- Table structure for table `match_types`
--

CREATE TABLE `match_types` (
  `match_type_auto_id` int(2) NOT NULL,
  `match_type_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `match_types`
--

INSERT INTO `match_types` (`match_type_auto_id`, `match_type_name`) VALUES
(1, 'Tournament'),
(2, 'League');

-- --------------------------------------------------------

--
-- Table structure for table `physio_therapists`
--

CREATE TABLE `physio_therapists` (
  `phyth_auto_id` int(10) NOT NULL,
  `phyth_staff_id` varchar(30) NOT NULL,
  `phyth_nid` varchar(30) NOT NULL,
  `phyth_fname` varchar(30) NOT NULL,
  `phyth_lname` varchar(30) NOT NULL,
  `phyth_other_names` varchar(50) NOT NULL,
  `phyth_username` varchar(30) NOT NULL,
  `phyth_dob` date NOT NULL,
  `phyth_phone` varchar(30) NOT NULL,
  `phyth_email` varchar(100) NOT NULL,
  `phyth_residence` varchar(100) NOT NULL,
  `user_agreement` tinyint(1) NOT NULL DEFAULT '1',
  `date_appointed` date NOT NULL,
  `end_of_tenure` date DEFAULT NULL,
  `date_registered` date NOT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT '1',
  `reason_inactive` varchar(100) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `physio_therapists`
--

INSERT INTO `physio_therapists` (`phyth_auto_id`, `phyth_staff_id`, `phyth_nid`, `phyth_fname`, `phyth_lname`, `phyth_other_names`, `phyth_username`, `phyth_dob`, `phyth_phone`, `phyth_email`, `phyth_residence`, `user_agreement`, `date_appointed`, `end_of_tenure`, `date_registered`, `active_status`, `reason_inactive`, `password`, `date_updated`) VALUES
(1, '545647', '7465586', 'Chaney', 'Lee', 'Malik Sweeney', 'javyf', '0000-00-00', '+411-68-3070889', 'dakicoban@yahoo.com', 'Kigali', 1, '2016-08-25', NULL, '2017-08-08', 1, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2017-12-04 10:49:40'),
(2, '757448', '4545452', 'Cassady', 'Richardson', 'Megan Carney', 'qutiqim', '0000-00-00', '+764-16-4997136', 'qaji@yahoo.com', 'Madaraka', 1, '2016-08-25', NULL, '2017-07-28', 1, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2017-12-04 10:49:47'),
(3, '685654', '4567899', 'Maina', 'Jomo', 'Kenyatta', 'jmaina', '1980-02-28', '0719508386', 'jmaina@strathmore.edu', 'Madaraka', 1, '2016-08-25', NULL, '2017-07-28', 1, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2017-12-04 10:49:50');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `player_auto_id` int(10) NOT NULL,
  `player_nid` varchar(30) NOT NULL,
  `id_type` varchar(50) NOT NULL,
  `player_fname` varchar(30) NOT NULL,
  `player_lname` varchar(30) NOT NULL,
  `player_other_names` varchar(50) NOT NULL,
  `player_dob` date NOT NULL,
  `stud_id` varchar(10) DEFAULT NULL,
  `player_phone` varchar(30) NOT NULL,
  `player_email` varchar(100) NOT NULL,
  `player_residence` varchar(100) NOT NULL,
  `player_height` double(10,2) NOT NULL,
  `player_weight` double(10,2) NOT NULL,
  `stud_course_id` varchar(15) DEFAULT NULL,
  `kin_fname` varchar(30) NOT NULL,
  `kin_lname` varchar(30) NOT NULL,
  `kin_other_names` varchar(50) NOT NULL,
  `player_gender` varchar(10) NOT NULL,
  `kin_nid` varchar(30) NOT NULL,
  `kin_phone` varchar(30) NOT NULL,
  `kin_email` varchar(100) DEFAULT NULL,
  `kin_alt_phone` varchar(30) NOT NULL,
  `kin_residence` varchar(100) NOT NULL,
  `prev_hschool` varchar(100) NOT NULL,
  `prev_play_state` tinyint(1) NOT NULL DEFAULT '0',
  `prev_team` varchar(100) NOT NULL,
  `player_sport_id` int(10) NOT NULL,
  `player_team_id` int(10) DEFAULT NULL,
  `h_achievement` varchar(100) DEFAULT NULL,
  `agreement` tinyint(1) DEFAULT NULL,
  `player_profile_photo` varchar(150) NOT NULL,
  `date_registered` date NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `alumni_status` tinyint(1) NOT NULL DEFAULT '0',
  `active_status` tinyint(1) NOT NULL DEFAULT '1',
  `reason_inactive` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`player_auto_id`, `player_nid`, `id_type`, `player_fname`, `player_lname`, `player_other_names`, `player_dob`, `stud_id`, `player_phone`, `player_email`, `player_residence`, `player_height`, `player_weight`, `stud_course_id`, `kin_fname`, `kin_lname`, `kin_other_names`, `player_gender`, `kin_nid`, `kin_phone`, `kin_email`, `kin_alt_phone`, `kin_residence`, `prev_hschool`, `prev_play_state`, `prev_team`, `player_sport_id`, `player_team_id`, `h_achievement`, `agreement`, `player_profile_photo`, `date_registered`, `date_updated`, `alumni_status`, `active_status`, `reason_inactive`) VALUES
(21, '435678', 'Passport', 'Adrian', 'Copeland', 'Amelia Stevens', '0000-00-00', '13243', '0743153766', 'nerexaqudo@hotmail.com', 'Westlands', 174.00, 89.00, 'BCOM', 'Serina', 'Buckner', 'Quamar Norman', 'Female', '345678', '0766819567', 'fuhi@hotmail.com', '0746576869', 'Nairobi West', 'Olkejuado', 0, 'Captain', 5, 1, 'Great ', NULL, '8626af1f2fd1dc353b31922bbd37fdb8.jpg', '2018-01-19', '2018-01-19 12:59:03', 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `scoregroups`
--

CREATE TABLE `scoregroups` (
  `levelAutoId` int(10) NOT NULL,
  `levelName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scoregroups`
--

INSERT INTO `scoregroups` (`levelAutoId`, `levelName`) VALUES
(1, 'Preliminary Scores'),
(2, 'Quarters Score');

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

CREATE TABLE `sports` (
  `sport_id` int(5) NOT NULL,
  `sport_name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sports`
--

INSERT INTO `sports` (`sport_id`, `sport_name`, `status`) VALUES
(1, 'Rugby', 1),
(2, 'Volleyball', 1),
(3, 'Basketball', 1),
(4, 'Soccer', 1),
(5, 'Hockey', 1),
(6, 'Handball', 1),
(7, 'Karate', 1),
(8, 'Swimming', 1),
(9, 'Archery', 1),
(10, 'Chess', 1),
(11, 'Scrabble', 1),
(12, 'Tennis', 1),
(13, 'Strength & Conditioning', 1);

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `staff_id` int(10) NOT NULL,
  `super_username` varchar(50) NOT NULL,
  `super_fname` varchar(30) NOT NULL,
  `super_lname` varchar(30) NOT NULL,
  `super_nid` varchar(30) NOT NULL,
  `super_phone` varchar(30) NOT NULL,
  `super_email` varchar(100) NOT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT '1',
  `date_registered` date NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`staff_id`, `super_username`, `super_fname`, `super_lname`, `super_nid`, `super_phone`, `super_email`, `active_status`, `date_registered`, `date_updated`, `password`) VALUES
(78581, 'smokoro', 'Stephen', 'Mokoro', '31537790', '0719508386', 'stephen.mokoro@strathmore.edu', 1, '2017-07-23', '2017-08-13 12:41:24', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_auto_id` int(10) NOT NULL,
  `team_sport_id` int(10) NOT NULL,
  `team_name` varchar(30) NOT NULL,
  `team_alias` varchar(30) NOT NULL,
  `team_gender` varchar(15) NOT NULL,
  `team_category` varchar(15) NOT NULL,
  `team_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_auto_id`, `team_sport_id`, `team_name`, `team_alias`, `team_gender`, `team_category`, `team_status`) VALUES
(1, 5, 'Gladiators', 'Gladiators', 'Male', 'Men', 1),
(2, 5, 'Scorpions', 'Scorpions', 'Female', 'Women', 1),
(3, 1, 'Strathmore Leos', 'LEOS', 'Male', 'Men', 1);

-- --------------------------------------------------------

--
-- Table structure for table `training_attendance`
--

CREATE TABLE `training_attendance` (
  `ta_auto_id` int(10) NOT NULL,
  `player_auto_id` int(10) NOT NULL,
  `training_date` date NOT NULL,
  `attendance_state` varchar(15) NOT NULL DEFAULT 'ABSENT',
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `training_year` int(5) NOT NULL,
  `sport_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `training_attendance`
--

INSERT INTO `training_attendance` (`ta_auto_id`, `player_auto_id`, `training_date`, `attendance_state`, `date_updated`, `training_year`, `sport_id`) VALUES
(6, 21, '2018-01-19', 'ABSENT', '2018-01-19 13:09:36', 2018, 5);

-- --------------------------------------------------------

--
-- Table structure for table `training_days`
--

CREATE TABLE `training_days` (
  `trd_auto_id` int(10) NOT NULL,
  `trd_year` int(5) NOT NULL,
  `trd_sport_id` int(5) NOT NULL,
  `january` int(5) NOT NULL,
  `february` int(5) NOT NULL,
  `march` int(5) NOT NULL,
  `april` int(5) NOT NULL,
  `may` int(5) NOT NULL,
  `june` int(5) NOT NULL,
  `july` int(5) NOT NULL,
  `august` int(5) NOT NULL,
  `september` int(5) NOT NULL,
  `october` int(5) NOT NULL,
  `november` int(5) NOT NULL,
  `december` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training_days`
--

INSERT INTO `training_days` (`trd_auto_id`, `trd_year`, `trd_sport_id`, `january`, `february`, `march`, `april`, `may`, `june`, `july`, `august`, `september`, `october`, `november`, `december`) VALUES
(4, 2018, 5, 17, 14, 19, 9, 17, 20, 8, 10, 11, 31, 21, 26);

-- --------------------------------------------------------

--
-- Table structure for table `travel_documents`
--

CREATE TABLE `travel_documents` (
  `passport_auto_id` int(10) NOT NULL,
  `player_id` int(10) NOT NULL,
  `passport_number` varchar(30) NOT NULL,
  `issue_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `issue_country` varchar(10) NOT NULL,
  `date_recorded` date NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `passport_photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `travel_documents`
--

INSERT INTO `travel_documents` (`passport_auto_id`, `player_id`, `passport_number`, `issue_date`, `expiry_date`, `issue_country`, `date_recorded`, `date_updated`, `passport_photo`) VALUES
(5, 21, '24355', '2018-01-18', '2018-02-02', 'KE', '0000-00-00', '2018-01-19 13:03:51', '5b0f55227efdb9cbfb900f2a67df4b3c.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `captains`
--
ALTER TABLE `captains`
  ADD PRIMARY KEY (`player_auto_id`),
  ADD KEY `player_team_id_fk` (`player_team_id`);

--
-- Indexes for table `coaches`
--
ALTER TABLE `coaches`
  ADD PRIMARY KEY (`coach_staff_id`),
  ADD UNIQUE KEY `staff_id` (`coach_staff_id`),
  ADD UNIQUE KEY `coach_phone` (`coach_phone`),
  ADD UNIQUE KEY `coach_email` (`coach_email`),
  ADD UNIQUE KEY `coach_username` (`coach_username`),
  ADD UNIQUE KEY `coach_nid` (`coach_nid`),
  ADD KEY `coaches_team_id_fk` (`coach_sport_id`);

--
-- Indexes for table `coach_reports`
--
ALTER TABLE `coach_reports`
  ADD PRIMARY KEY (`report_auto_id`),
  ADD KEY `report_sport_id` (`report_sport_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `dummy`
--
ALTER TABLE `dummy`
  ADD PRIMARY KEY (`dummy_auto_id`);

--
-- Indexes for table `expenditures`
--
ALTER TABLE `expenditures`
  ADD PRIMARY KEY (`expense_auto_id`),
  ADD KEY `expense_team_auto_id` (`expense_team_auto_id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_auto_id`),
  ADD KEY `hkm_team_auto_id` (`game_sport_auto_id`),
  ADD KEY `hkm_type_id_fk` (`game_match_type`),
  ADD KEY `game_category_fk` (`game_team`);

--
-- Indexes for table `game_matches`
--
ALTER TABLE `game_matches`
  ADD PRIMARY KEY (`match_auto_id`),
  ADD KEY `hk_game_match_id_fk` (`match_game_id`),
  ADD KEY `match_game_id` (`match_game_id`);

--
-- Indexes for table `hockey_match_scores`
--
ALTER TABLE `hockey_match_scores`
  ADD PRIMARY KEY (`auto_id`);

--
-- Indexes for table `hockey_scores`
--
ALTER TABLE `hockey_scores`
  ADD PRIMARY KEY (`hockey_score_auto_id`),
  ADD KEY `hockey_score_id_fk` (`hockey_player_id`),
  ADD KEY `hockey_score_match_id` (`hockey_match_id`);

--
-- Indexes for table `injury_records`
--
ALTER TABLE `injury_records`
  ADD PRIMARY KEY (`injury_auto_id`),
  ADD KEY `player_auto_id_fk` (`player_auto_id`);

--
-- Indexes for table `match_players`
--
ALTER TABLE `match_players`
  ADD PRIMARY KEY (`auto_id`),
  ADD KEY `match_players_player_id` (`match_player_id`),
  ADD KEY `match_players_id_fk` (`match_id`);

--
-- Indexes for table `match_types`
--
ALTER TABLE `match_types`
  ADD PRIMARY KEY (`match_type_auto_id`);

--
-- Indexes for table `physio_therapists`
--
ALTER TABLE `physio_therapists`
  ADD PRIMARY KEY (`phyth_auto_id`),
  ADD UNIQUE KEY `phyth_phone` (`phyth_phone`),
  ADD UNIQUE KEY `phyth_email` (`phyth_email`),
  ADD UNIQUE KEY `phyth_username` (`phyth_username`),
  ADD UNIQUE KEY `phyth_staff_id` (`phyth_staff_id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`player_auto_id`),
  ADD UNIQUE KEY `player_nid` (`player_nid`),
  ADD UNIQUE KEY `player_phone` (`player_phone`),
  ADD UNIQUE KEY `player_email` (`player_email`),
  ADD UNIQUE KEY `stud_id` (`stud_id`),
  ADD KEY `player_course_id_fk` (`stud_course_id`),
  ADD KEY `player_team_id` (`player_team_id`);

--
-- Indexes for table `scoregroups`
--
ALTER TABLE `scoregroups`
  ADD PRIMARY KEY (`levelAutoId`);

--
-- Indexes for table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`sport_id`);

--
-- Indexes for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_auto_id`),
  ADD KEY `team_group_team_id_fk` (`team_sport_id`);

--
-- Indexes for table `training_attendance`
--
ALTER TABLE `training_attendance`
  ADD PRIMARY KEY (`ta_auto_id`),
  ADD KEY `ta_player_nid_fk` (`player_auto_id`),
  ADD KEY `ta_sport_id_fk` (`sport_id`);

--
-- Indexes for table `training_days`
--
ALTER TABLE `training_days`
  ADD PRIMARY KEY (`trd_auto_id`),
  ADD KEY `trd_team_id` (`trd_sport_id`);

--
-- Indexes for table `travel_documents`
--
ALTER TABLE `travel_documents`
  ADD PRIMARY KEY (`passport_auto_id`),
  ADD UNIQUE KEY `passport_number` (`passport_number`),
  ADD UNIQUE KEY `player_id` (`player_id`,`passport_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coach_reports`
--
ALTER TABLE `coach_reports`
  MODIFY `report_auto_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `dummy`
--
ALTER TABLE `dummy`
  MODIFY `dummy_auto_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `expenditures`
--
ALTER TABLE `expenditures`
  MODIFY `expense_auto_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `game_auto_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `game_matches`
--
ALTER TABLE `game_matches`
  MODIFY `match_auto_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `hockey_match_scores`
--
ALTER TABLE `hockey_match_scores`
  MODIFY `auto_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `hockey_scores`
--
ALTER TABLE `hockey_scores`
  MODIFY `hockey_score_auto_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `injury_records`
--
ALTER TABLE `injury_records`
  MODIFY `injury_auto_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `match_players`
--
ALTER TABLE `match_players`
  MODIFY `auto_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `match_types`
--
ALTER TABLE `match_types`
  MODIFY `match_type_auto_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `player_auto_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `scoregroups`
--
ALTER TABLE `scoregroups`
  MODIFY `levelAutoId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_auto_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `training_attendance`
--
ALTER TABLE `training_attendance`
  MODIFY `ta_auto_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `training_days`
--
ALTER TABLE `training_days`
  MODIFY `trd_auto_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `travel_documents`
--
ALTER TABLE `travel_documents`
  MODIFY `passport_auto_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `captains`
--
ALTER TABLE `captains`
  ADD CONSTRAINT `captain_auto_id_fk` FOREIGN KEY (`player_auto_id`) REFERENCES `players` (`player_auto_id`),
  ADD CONSTRAINT `player_team_id_fk` FOREIGN KEY (`player_team_id`) REFERENCES `sports` (`sport_id`);

--
-- Constraints for table `coaches`
--
ALTER TABLE `coaches`
  ADD CONSTRAINT `coach_sport_id_fk` FOREIGN KEY (`coach_sport_id`) REFERENCES `sports` (`sport_id`);

--
-- Constraints for table `coach_reports`
--
ALTER TABLE `coach_reports`
  ADD CONSTRAINT `report_sport_id` FOREIGN KEY (`report_sport_id`) REFERENCES `sports` (`sport_id`);

--
-- Constraints for table `expenditures`
--
ALTER TABLE `expenditures`
  ADD CONSTRAINT `expense_team_auto_id_fk` FOREIGN KEY (`expense_team_auto_id`) REFERENCES `sports` (`sport_id`);

--
-- Constraints for table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `game_match_type_fk` FOREIGN KEY (`game_match_type`) REFERENCES `match_types` (`match_type_auto_id`),
  ADD CONSTRAINT `game_sport_auto_id_fk` FOREIGN KEY (`game_sport_auto_id`) REFERENCES `sports` (`sport_id`),
  ADD CONSTRAINT `game_team_fk` FOREIGN KEY (`game_team`) REFERENCES `teams` (`team_auto_id`);

--
-- Constraints for table `game_matches`
--
ALTER TABLE `game_matches`
  ADD CONSTRAINT `match_id_fk` FOREIGN KEY (`match_game_id`) REFERENCES `games` (`game_auto_id`);

--
-- Constraints for table `hockey_scores`
--
ALTER TABLE `hockey_scores`
  ADD CONSTRAINT `hockey_score_id_fk` FOREIGN KEY (`hockey_player_id`) REFERENCES `players` (`player_auto_id`),
  ADD CONSTRAINT `hockey_score_match_id` FOREIGN KEY (`hockey_match_id`) REFERENCES `game_matches` (`match_auto_id`);

--
-- Constraints for table `injury_records`
--
ALTER TABLE `injury_records`
  ADD CONSTRAINT `injury_player_auto_id_fk` FOREIGN KEY (`player_auto_id`) REFERENCES `players` (`player_auto_id`);

--
-- Constraints for table `match_players`
--
ALTER TABLE `match_players`
  ADD CONSTRAINT `match_player_id_fk` FOREIGN KEY (`match_player_id`) REFERENCES `players` (`player_auto_id`),
  ADD CONSTRAINT `match_players_id_fk` FOREIGN KEY (`match_id`) REFERENCES `game_matches` (`match_auto_id`);

--
-- Constraints for table `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `player_course_id` FOREIGN KEY (`stud_course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `playerz_team_id_fk` FOREIGN KEY (`player_team_id`) REFERENCES `teams` (`team_auto_id`);

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `team_sport_id_fk` FOREIGN KEY (`team_sport_id`) REFERENCES `sports` (`sport_id`);

--
-- Constraints for table `training_attendance`
--
ALTER TABLE `training_attendance`
  ADD CONSTRAINT `ta_player_auto_id_fk` FOREIGN KEY (`player_auto_id`) REFERENCES `players` (`player_auto_id`),
  ADD CONSTRAINT `ta_sport_id_fk` FOREIGN KEY (`sport_id`) REFERENCES `sports` (`sport_id`);

--
-- Constraints for table `training_days`
--
ALTER TABLE `training_days`
  ADD CONSTRAINT `trd_sport_id_fk` FOREIGN KEY (`trd_sport_id`) REFERENCES `sports` (`sport_id`);

--
-- Constraints for table `travel_documents`
--
ALTER TABLE `travel_documents`
  ADD CONSTRAINT `td_player_id_fk` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_auto_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
