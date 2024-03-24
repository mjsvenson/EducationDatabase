-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 10:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db2`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`email`, `password`, `type`) VALUES
('admin@uml.edu', '123456', 'admin'),
('bus@student.uml.edu', 'hater', 'student'),
('Charles_Wilkes@uml.edu', '123456', 'instructor'),
('dbadams@cs.uml.edu', '123456', 'instructor'),
('jhs@student.uml.edu', 'JACKHAMMER', 'student'),
('Johannes_Weis@uml.edu', '123456', 'instructor'),
('ksi@student.uml.edu', 'KyleInDenial', 'student'),
('lis@student.uml.edu', 'homeisgone', 'student'),
('msi@student.uml.edu', 'LILIESANDLOVE', 'student'),
('shl@student.uml.edu', 'doggos', 'student'),
('slin@cs.uml.edu', '123456', 'instructor'),
('wer@student.uml.edu', 'spells', 'student'),
('Yelena_Rykalova@uml.edu', '123456', 'instructor');

-- --------------------------------------------------------

--
-- Table structure for table `advise`
--

CREATE TABLE `advise` (
  `instructor_id` varchar(8) NOT NULL,
  `student_id` varchar(10) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `classroom_id` varchar(8) NOT NULL,
  `building` varchar(15) NOT NULL,
  `room_number` varchar(7) NOT NULL,
  `capacity` decimal(4,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` varchar(20) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `credits` decimal(2,0) DEFAULT NULL CHECK (`credits` > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `credits`) VALUES
('COMP1010', 'Computing I', 3),
('COMP1020', 'Computing II', 3),
('COMP2010', 'Computing III', 3),
('COMP2040', 'Computing IV', 3);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_name` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_name`, `location`) VALUES
('Miner School of Computer & Information Sciences', 'Dandeneau Hall, 1 University Avenue, Lowell, MA 01854');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `instructor_id` varchar(10) NOT NULL,
  `instructor_name` varchar(50) NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `dept_name` varchar(100) DEFAULT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`instructor_id`, `instructor_name`, `title`, `dept_name`, `email`) VALUES
('1', 'David Adams', 'Teaching Professor', 'Miner School of Computer & Information Sciences', 'dbadams@cs.uml.edu'),
('2', 'Sirong Lin', 'Associate Teaching Professor', 'Miner School of Computer & Information Sciences', 'slin@cs.uml.edu'),
('3', 'Yelena Rykalova', 'Associate Teaching Professor', 'Miner School of Computer & Information Sciences', 'Yelena_Rykalova@uml.edu'),
('4', 'Johannes Weis', 'Assistant Teaching Professor', 'Miner School of Computer & Information Sciences', 'Johannes_Weis@uml.edu'),
('5', 'Tom Wilkes', 'Assistant Teaching Professor', 'Miner School of Computer & Information Sciences', 'Charles_Wilkes@uml.edu');

-- --------------------------------------------------------

--
-- Table structure for table `master`
--

CREATE TABLE `master` (
  `student_id` varchar(10) NOT NULL,
  `total_credits` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master`
--

INSERT INTO `master` (`student_id`, `total_credits`) VALUES
('26303', 0),
('9271', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mastergrader`
--

CREATE TABLE `mastergrader` (
  `student_id` varchar(10) NOT NULL,
  `course_id` varchar(8) NOT NULL,
  `section_id` varchar(8) NOT NULL,
  `semester` varchar(6) NOT NULL,
  `year` decimal(4,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phd`
--

CREATE TABLE `phd` (
  `student_id` varchar(10) NOT NULL,
  `qualifier` varchar(30) DEFAULT NULL,
  `proposal_defence_date` date DEFAULT NULL,
  `dissertation_defence_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phd`
--

INSERT INTO `phd` (`student_id`, `qualifier`, `proposal_defence_date`, `dissertation_defence_date`) VALUES
('123456', '0', '0000-00-00', '0000-00-00'),
('201738', '0', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `prereq`
--

CREATE TABLE `prereq` (
  `course_id` varchar(20) NOT NULL,
  `prereq_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `course_id` varchar(20) NOT NULL,
  `section_id` varchar(10) NOT NULL,
  `semester` varchar(6) NOT NULL CHECK (`semester` in ('Fall','Winter','Spring','Summer')),
  `year` decimal(4,0) NOT NULL CHECK (`year` > 1990 and `year` < 2100),
  `instructor_id` varchar(10) DEFAULT NULL,
  `classroom_id` varchar(8) DEFAULT NULL,
  `time_slot_id` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`course_id`, `section_id`, `semester`, `year`, `instructor_id`, `classroom_id`, `time_slot_id`) VALUES
('COMP1010', 'Section101', 'Fall', 2023, NULL, NULL, NULL),
('COMP1010', 'Section102', 'Fall', 2023, NULL, NULL, NULL),
('COMP1010', 'Section103', 'Fall', 2023, NULL, NULL, NULL),
('COMP1010', 'Section104', 'Fall', 2023, NULL, NULL, NULL),
('COMP1020', 'Section101', 'Spring', 2024, NULL, NULL, NULL),
('COMP1020', 'Section102', 'Spring', 2024, NULL, NULL, NULL),
('COMP2010', 'Section101', 'Fall', 2023, NULL, NULL, NULL),
('COMP2010', 'Section102', 'Fall', 2023, NULL, NULL, NULL),
('COMP2040', 'Section201', 'Spring', 2024, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` varchar(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dept_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `name`, `email`, `dept_name`) VALUES
('123456', 'Wizard', 'wer@student.uml.edu', 'Miner School of Computer & Information Sciences'),
('201738', 'Brian', 'bus@student.uml.edu', 'Miner School of Computer & Information Sciences'),
('26303', 'Sean', 'shl@student.uml.edu', 'Miner School of Computer & Information Sciences'),
('4325', 'Jack', 'jhs@student.uml.edu', 'Miner School of Computer & Information Sciences'),
('87623', 'Matricia', 'msi@student.uml.edu', 'Miner School of Computer & Information Sciences'),
('9271', 'Leon', 'lis@student.uml.edu', 'Miner School of Computer & Information Sciences'),
('9782', 'Kyle', 'ksi@student.uml.edu', 'Miner School of Computer & Information Sciences');

-- --------------------------------------------------------

--
-- Table structure for table `studygroup`
--

CREATE TABLE `studygroup` (
  `course_id` text NOT NULL,
  `section_id` text NOT NULL,
  `classroom_id` text NOT NULL,
  `time_slot_id` text NOT NULL,
  `studygroup_id` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ta`
--

CREATE TABLE `ta` (
  `student_id` varchar(10) NOT NULL,
  `course_id` varchar(8) NOT NULL,
  `section_id` varchar(8) NOT NULL,
  `semester` varchar(6) NOT NULL,
  `year` decimal(4,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `take`
--

CREATE TABLE `take` (
  `student_id` varchar(10) NOT NULL,
  `course_id` varchar(8) NOT NULL,
  `section_id` varchar(8) NOT NULL,
  `semester` varchar(6) NOT NULL,
  `year` decimal(4,0) NOT NULL,
  `grade` varchar(2) DEFAULT NULL CHECK (`grade` in ('A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `time_slot`
--

CREATE TABLE `time_slot` (
  `time_slot_id` varchar(8) NOT NULL,
  `day` varchar(10) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_slot`
--

INSERT INTO `time_slot` (`time_slot_id`, `day`, `start_time`, `end_time`) VALUES
('TS1', 'MoWeFr', '11:00:00', '11:50:00'),
('TS2', 'MoWeFr', '12:00:00', '12:50:00'),
('TS3', 'MoWeFr', '13:00:00', '13:50:00'),
('TS4', 'TuTh', '11:00:00', '12:15:00'),
('TS5', 'TuTh', '12:30:00', '13:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `undergraduate`
--

CREATE TABLE `undergraduate` (
  `student_id` varchar(10) NOT NULL,
  `total_credits` int(11) DEFAULT NULL,
  `class_standing` varchar(10) DEFAULT NULL CHECK (`class_standing` in ('Freshman','Sophomore','Junior','Senior'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `undergraduate`
--

INSERT INTO `undergraduate` (`student_id`, `total_credits`, `class_standing`) VALUES
('4325', 0, 'freshman'),
('87623', 0, 'freshman'),
('9782', 0, 'freshman');

-- --------------------------------------------------------

--
-- Table structure for table `undergraduategrader`
--

CREATE TABLE `undergraduategrader` (
  `student_id` varchar(10) NOT NULL,
  `course_id` varchar(8) NOT NULL,
  `section_id` varchar(8) NOT NULL,
  `semester` varchar(6) NOT NULL,
  `year` decimal(4,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `advise`
--
ALTER TABLE `advise`
  ADD PRIMARY KEY (`instructor_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`classroom_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_name`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`instructor_id`);

--
-- Indexes for table `master`
--
ALTER TABLE `master`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `mastergrader`
--
ALTER TABLE `mastergrader`
  ADD PRIMARY KEY (`student_id`,`course_id`,`section_id`,`semester`,`year`),
  ADD KEY `course_id` (`course_id`,`section_id`,`semester`,`year`);

--
-- Indexes for table `phd`
--
ALTER TABLE `phd`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `prereq`
--
ALTER TABLE `prereq`
  ADD PRIMARY KEY (`course_id`,`prereq_id`),
  ADD KEY `prereq_id` (`prereq_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`course_id`,`section_id`,`semester`,`year`),
  ADD KEY `instructor_id` (`instructor_id`),
  ADD KEY `time_slot_id` (`time_slot_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `dept_name` (`dept_name`);

--
-- Indexes for table `ta`
--
ALTER TABLE `ta`
  ADD PRIMARY KEY (`student_id`,`course_id`,`section_id`,`semester`,`year`),
  ADD KEY `course_id` (`course_id`,`section_id`,`semester`,`year`);

--
-- Indexes for table `take`
--
ALTER TABLE `take`
  ADD PRIMARY KEY (`student_id`,`course_id`,`section_id`,`semester`,`year`),
  ADD KEY `course_id` (`course_id`,`section_id`,`semester`,`year`);

--
-- Indexes for table `time_slot`
--
ALTER TABLE `time_slot`
  ADD PRIMARY KEY (`time_slot_id`);

--
-- Indexes for table `undergraduate`
--
ALTER TABLE `undergraduate`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `undergraduategrader`
--
ALTER TABLE `undergraduategrader`
  ADD PRIMARY KEY (`student_id`,`course_id`,`section_id`,`semester`,`year`),
  ADD KEY `course_id` (`course_id`,`section_id`,`semester`,`year`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advise`
--
ALTER TABLE `advise`
  ADD CONSTRAINT `advise_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`instructor_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `advise_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `phd` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `master`
--
ALTER TABLE `master`
  ADD CONSTRAINT `master_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `mastergrader`
--
ALTER TABLE `mastergrader`
  ADD CONSTRAINT `mastergrader_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `master` (`student_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mastergrader_ibfk_2` FOREIGN KEY (`course_id`,`section_id`,`semester`,`year`) REFERENCES `section` (`course_id`, `section_id`, `semester`, `year`) ON DELETE CASCADE;

--
-- Constraints for table `phd`
--
ALTER TABLE `phd`
  ADD CONSTRAINT `phd_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `prereq`
--
ALTER TABLE `prereq`
  ADD CONSTRAINT `prereq_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prereq_ibfk_2` FOREIGN KEY (`prereq_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `section_ibfk_2` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`instructor_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `section_ibfk_3` FOREIGN KEY (`time_slot_id`) REFERENCES `time_slot` (`time_slot_id`) ON DELETE SET NULL;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`dept_name`) REFERENCES `department` (`dept_name`) ON DELETE SET NULL;

--
-- Constraints for table `ta`
--
ALTER TABLE `ta`
  ADD CONSTRAINT `ta_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `phd` (`student_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ta_ibfk_2` FOREIGN KEY (`course_id`,`section_id`,`semester`,`year`) REFERENCES `section` (`course_id`, `section_id`, `semester`, `year`) ON DELETE CASCADE;

--
-- Constraints for table `take`
--
ALTER TABLE `take`
  ADD CONSTRAINT `take_ibfk_1` FOREIGN KEY (`course_id`,`section_id`,`semester`,`year`) REFERENCES `section` (`course_id`, `section_id`, `semester`, `year`) ON DELETE CASCADE,
  ADD CONSTRAINT `take_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `undergraduate`
--
ALTER TABLE `undergraduate`
  ADD CONSTRAINT `undergraduate_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `undergraduategrader`
--
ALTER TABLE `undergraduategrader`
  ADD CONSTRAINT `undergraduategrader_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `undergraduate` (`student_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `undergraduategrader_ibfk_2` FOREIGN KEY (`course_id`,`section_id`,`semester`,`year`) REFERENCES `section` (`course_id`, `section_id`, `semester`, `year`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
