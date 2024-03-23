-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 03, 2022 at 11:59 PM
-- Server version: 8.0.28
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prjCRUD`
--

-- --------------------------------------------------------

--
-- Table structure for table `clocation`
--

CREATE TABLE `clocation` (
  `clocation_ID` int NOT NULL,
  `clocationHall` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `clocationRoom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clocation`
--

INSERT INTO `clocation` (`clocation_ID`, `clocationHall`, `clocationRoom`) VALUES
(1, 'Elm Hall', '342'),
(2, 'Pine Hall', '112'),
(3, 'Oak Hall', '132');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_ID` int NOT NULL,
  `courseName` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `courseDay` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `courseStartTime` time DEFAULT NULL,
  `courseEndTime` time DEFAULT NULL,
  `clocation_ID` int DEFAULT NULL,
  `instructor_ID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_ID`, `courseName`, `courseDay`, `courseStartTime`, `courseEndTime`, `clocation_ID`, `instructor_ID`) VALUES
(1, 'Server Side Development', 'M', '10:00:00', '12:00:00', 1, 1),
(2, 'Discrete Math', 'T', '08:00:00', '10:00:00', 2, 2),
(3, 'Self Defense', 'F', '08:00:00', '10:00:00', 2, 2),
(4, 'Database Design', 'MW', '13:00:00', '14:00:00', 3, 3),
(5, 'Python', 'W', '10:00:00', '12:00:00', 2, NULL),
(6, 'Arts and Crafts', 'Th', '10:00:00', '12:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `instructor_ID` int NOT NULL,
  `instructorFNAME` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `instructorLNAME` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`instructor_ID`, `instructorFNAME`, `instructorLNAME`) VALUES
(1, 'Susan', 'Furtney'),
(2, 'Octavia', 'Spencer'),
(3, 'Mark', 'Walker'),
(4, 'David', 'Larson');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `registration_ID` int NOT NULL,
  `student_ID` int DEFAULT NULL,
  `course_ID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`registration_ID`, `student_ID`, `course_ID`) VALUES
(1, 1, 1),
(2, 2, 3),
(3, 2, 1),
(4, 4, 1),
(5, 4, 2),
(6, 4, 3),
(7, 1, 5),
(8, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_ID` int NOT NULL,
  `studentFNAME` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `studentLNAME` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_ID`, `studentFNAME`, `studentLNAME`) VALUES
(1, 'Lindsay', 'Haller'),
(2, 'Mikayla', 'Miller'),
(3, 'Bob', 'Johnson'),
(4, 'Brittany', 'Schaefer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clocation`
--
ALTER TABLE `clocation`
  ADD PRIMARY KEY (`clocation_ID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_ID`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`instructor_ID`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`registration_ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clocation`
--
ALTER TABLE `clocation`
  MODIFY `clocation_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `instructor_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `registration_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
