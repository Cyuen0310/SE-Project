-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2023 年 12 月 09 日 11:50
-- 伺服器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `ARS`
--

-- --------------------------------------------------------

--
-- 資料表結構 `Course`
--

CREATE TABLE `Course` (
  `course_id` varchar(255) NOT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `course_type` varchar(255) DEFAULT NULL,
  `credit` int(1) DEFAULT NULL,
  `lecturer` varchar(255) NOT NULL,
  `department` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `Course`
--

INSERT INTO `Course` (`course_id`, `course_name`, `course_type`, `credit`, `lecturer`, `department`) VALUES
('1020SEF', 'Computing Fundamentals', 'Core', 5, 't1000002', 'IT'),
('1080SEF', 'Introduction to Computer Programming', 'Core', 5, 't1000003', 'COMP'),
('2020SEF', 'Java Programming Fundamentals', 'Core', 5, 't1000003', 'COMP'),
('2030SEF', 'Intermediate Java Programming & User Interface Design', 'Core', 5, 't1000003', 'COMP'),
('2090SEF', 'Data Structures, Algorithms & Problem Solving', 'Core', 5, 't1000009', 'COMP'),
('2640SEF', 'Discrete Mathematics', 'Core', 5, 't1000002', 'COMP'),
('2660SEF', 'Computer Architecture', 'Core', 5, 't1000002', 'COMP'),
('2900SEF', 'Human Computer Interaction & User Experience Design', 'Core', 5, 't1000008', 'IT'),
('S265F', 'Design and Analysis of Algorithms', 'Core', 5, 't1000000', 'COMP'),
('S312F', 'Java Application Development', 'Core', 5, 't1000000', 'COMP'),
('S313F', 'Mobile Application Programming', 'Core', 5, 't1000000', 'COMP'),
('S320F', 'Database Management', 'Core', 5, 't1000000', 'COMP'),
('S350F', 'Software Engineering', 'Core', 5, 't1000000', 'COMP'),
('S380F', 'Web Applications: Design and Development', 'Core', 5, 't1000000', 'COMP'),
('S381F', 'Server-side Technologies and Cloud Computing', 'Core', 5, 't1000000', 'COMP');

-- --------------------------------------------------------

--
-- 資料表結構 `Department`
--

CREATE TABLE `Department` (
  `Department` varchar(10) NOT NULL,
  `DepartmentName` varchar(30) NOT NULL,
  `DepartmentHead` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `Department`
--

INSERT INTO `Department` (`Department`, `DepartmentName`, `DepartmentHead`) VALUES
('COMP', 'Computing', 't1000009'),
('IT', 'Internet Technology', 't1000000');

-- --------------------------------------------------------

--
-- 資料表結構 `EnrolledCourse`
--

CREATE TABLE `EnrolledCourse` (
  `student_id` varchar(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `grade` varchar(3) DEFAULT 'N/A',
  `Semester` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `EnrolledCourse`
--

INSERT INTO `EnrolledCourse` (`student_id`, `course_id`, `grade`, `Semester`) VALUES
('s1000000', '1020SEF', 'A', '2022/23 Sem 1'),
('s1000000', '1080SEF', 'B', '2022/23 Sem 2'),
('s1000000', '2020SEF', 'A', '2022/23 Sem 1'),
('s1000000', '2030SEF', 'A-', '2022/23 Sem 2'),
('s1000000', '2090SEF', 'B+', '2022/23 Sem 2'),
('s1000000', '2640SEF', 'A', '2022/23 Sem 2'),
('s1000000', '2660SEF', 'A', '2022/23 Sem 1'),
('s1000000', '2900SEF', 'A', '2022/23 Sem 1'),
('s1000000', 'S312F', NULL, '2023/24 Sem 1'),
('s1000000', 'S320F', 'A', '2023/24 Sem 1'),
('s1000000', 'S350F', NULL, '2023/24 Sem 1'),
('s1000000', 'S381F', NULL, '2023/24 Sem 1');

-- --------------------------------------------------------

--
-- 資料表結構 `GradeDescription`
--

CREATE TABLE `GradeDescription` (
  `grade` varchar(5) NOT NULL,
  `GPA` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `GradeDescription`
--

INSERT INTO `GradeDescription` (`grade`, `GPA`) VALUES
('A', '4.0'),
('A-', '3.7'),
('B', '3.0'),
('B+', '3.3'),
('B-', '2.7'),
('C', '2.0'),
('C+', '2.3'),
('F', '0');

-- --------------------------------------------------------

--
-- 資料表結構 `Staff`
--

CREATE TABLE `Staff` (
  `userid` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phoneNum` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `Staff`
--

INSERT INTO `Staff` (`userid`, `name`, `password`, `email`, `phoneNum`) VALUES
('admin', 'Chan Siu man', '1234', NULL, NULL),
('t1000000', 'Chan Tai Man', '1234', 'chan@email.com', '96912345'),
('t1000001', 'Lee Man Kiu', '1234', 'lee@email.com', '66923456'),
('t1000002', 'Ng Kit Fong', '1234', 'ng@email.com', '96923456'),
('t1000003', 'Tan Ah Kow', '1234', 'tan@email.com', '66923456'),
('t1000004', 'Wong Yuk Ling', '1234', 'wong@email.com', '96923456'),
('t1000005', 'Chang Wai Man', '1234', 'chang@email.com', '66923456'),
('t1000006', 'Chu Hoi Yan', '1234', 'chu@email.com', '96923456'),
('t1000007', 'Tam Siu Fan', '1234', 'tam@email.com', '66923456'),
('t1000008', 'Lo Sze Yan', '1234', 'lo@email.com', '96923456'),
('t1000009', 'Fong Lai Ping', '1234', 'fong@email.com', '66923456');

-- --------------------------------------------------------

--
-- 資料表結構 `Student`
--

CREATE TABLE `Student` (
  `userid` varchar(255) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phoneNum` varchar(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `Admission_Date` date DEFAULT NULL,
  `nationality` text DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `Expire_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `Student`
--

INSERT INTO `Student` (`userid`, `password`, `name`, `address`, `phoneNum`, `email`, `Admission_Date`, `nationality`, `gender`, `birth`, `Expire_Date`) VALUES
('admin', '1234', 'Chan Siu man', NULL, NULL, 'admin@email.com', NULL, NULL, NULL, NULL, NULL),
('s1000000', '1234', 'CHAN TAI MAN', 'hkmu', '98693524', 'CTM@gmail.com', '2022-08-31', 'Hong Kong', 'M', '2002-01-31', '2026-08-31'),
('s1000001', '1234', 'chan tai man', 'hkmu', '98693522', 'dd@gmail.com', '2023-08-31', 'Hong Kong', 'M', '2003-01-30', '2025-08-31'),
('s1000002', '1234', 'Chan Tai men', 'HKMU', '66666666', 'C@email.com', '2023-08-31', 'Hong Kong', 'M', '2003-10-31', '2025-08-31'),
('s1000003', '1234', 'Chan Siu man', 'hkmu', '64668851', 'hkmu@email.com', '2019-08-31', 'Hong Kong', 'M', '2001-01-03', '2023-08-31');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `Course`
--
ALTER TABLE `Course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `dep` (`department`),
  ADD KEY `lecturer` (`lecturer`);

--
-- 資料表索引 `Department`
--
ALTER TABLE `Department`
  ADD PRIMARY KEY (`Department`),
  ADD KEY `DepHead` (`DepartmentHead`);

--
-- 資料表索引 `EnrolledCourse`
--
ALTER TABLE `EnrolledCourse`
  ADD PRIMARY KEY (`student_id`,`course_id`),
  ADD KEY `grade` (`grade`),
  ADD KEY `cid` (`course_id`);

--
-- 資料表索引 `GradeDescription`
--
ALTER TABLE `GradeDescription`
  ADD PRIMARY KEY (`grade`) USING BTREE;

--
-- 資料表索引 `Staff`
--
ALTER TABLE `Staff`
  ADD PRIMARY KEY (`userid`);

--
-- 資料表索引 `Student`
--
ALTER TABLE `Student`
  ADD PRIMARY KEY (`userid`);

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `Course`
--
ALTER TABLE `Course`
  ADD CONSTRAINT `dep` FOREIGN KEY (`department`) REFERENCES `department` (`Department`),
  ADD CONSTRAINT `lecturer` FOREIGN KEY (`lecturer`) REFERENCES `Staff` (`userid`);

--
-- 資料表的限制式 `Department`
--
ALTER TABLE `Department`
  ADD CONSTRAINT `DepHead` FOREIGN KEY (`DepartmentHead`) REFERENCES `Staff` (`userid`);

--
-- 資料表的限制式 `EnrolledCourse`
--
ALTER TABLE `EnrolledCourse`
  ADD CONSTRAINT `cid` FOREIGN KEY (`course_id`) REFERENCES `Course` (`course_id`),
  ADD CONSTRAINT `grade` FOREIGN KEY (`grade`) REFERENCES `GradeDescription` (`grade`),
  ADD CONSTRAINT `sid` FOREIGN KEY (`student_id`) REFERENCES `Student` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
