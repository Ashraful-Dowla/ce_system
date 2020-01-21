-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2019 at 07:18 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ce_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_class`
--

CREATE TABLE `assign_class` (
  `id` bigint(20) NOT NULL,
  `assign_teacher_id` bigint(20) DEFAULT NULL COMMENT 'this id is from assign teacher table',
  `number_of_class` bigint(20) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assign_class`
--

INSERT INTO `assign_class` (`id`, `assign_teacher_id`, `number_of_class`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '2019-12-23 21:42:26', '2019-12-23 15:42:26');

-- --------------------------------------------------------

--
-- Table structure for table `assign_subject_student`
--

CREATE TABLE `assign_subject_student` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `student_id` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `request_status` tinyint(4) DEFAULT '0' COMMENT '0=pending, 1=accepted, 2=rejected, 3=Cancelled by student',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assign_subject_student`
--

INSERT INTO `assign_subject_student` (`id`, `subject_id`, `student_id`, `request_status`, `created_at`, `updated_at`) VALUES
(1, 2, '1502810200886', 1, '2019-12-23 21:44:04', '2019-12-23 15:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `assign_teacher`
--

CREATE TABLE `assign_teacher` (
  `id` int(11) NOT NULL,
  `teacher_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active,2=will take class, 0=will not take any class',
  `created_at` datetime DEFAULT NULL,
  `udpated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assign_teacher`
--

INSERT INTO `assign_teacher` (`id`, `teacher_id`, `session_id`, `subject_id`, `section_id`, `status`, `created_at`, `udpated_at`) VALUES
(1, 'Anik001', 1, 1, 1, 2, '2019-12-23 21:38:09', '2019-12-23 15:38:09'),
(2, 'Sanjid123', 1, 2, 1, 1, '2019-12-23 21:38:46', '2019-12-23 15:38:46'),
(3, 'Anik001', 3, 1, 1, 1, '2019-12-28 12:08:45', '2019-12-28 06:08:45');

-- --------------------------------------------------------

--
-- Table structure for table `class_review`
--

CREATE TABLE `class_review` (
  `id` bigint(20) NOT NULL,
  `teacher_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `daily_class_lecture_id` int(11) DEFAULT NULL COMMENT 'this id from daily class lecture',
  `rating` float DEFAULT NULL,
  `comment` longtext COLLATE utf8_unicode_ci,
  `student_id` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `class_review`
--

INSERT INTO `class_review` (`id`, `teacher_id`, `daily_class_lecture_id`, `rating`, `comment`, `student_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Anik001', 1, 4, '<p>good</p>\r\n', '1502810200886', 1, '2019-12-23 21:44:38', '2019-12-23 15:44:38');

-- --------------------------------------------------------

--
-- Table structure for table `course_outline`
--

CREATE TABLE `course_outline` (
  `id` int(11) NOT NULL,
  `assign_class_id` int(11) DEFAULT NULL COMMENT 'from assign class',
  `course_outline` text COLLATE utf8_unicode_ci,
  `class_no` int(11) DEFAULT NULL COMMENT 'from assign class',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `course_outline`
--

INSERT INTO `course_outline` (`id`, `assign_class_id`, `course_outline`, `class_no`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '<p>introduction with student.</p>\r\n', 1, 1, '2019-12-23 21:42:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `daily_class_lecture`
--

CREATE TABLE `daily_class_lecture` (
  `id` int(11) NOT NULL,
  `assign_class_id` int(11) DEFAULT NULL COMMENT 'this id from assign class table',
  `course_outline` longtext COLLATE utf8_unicode_ci,
  `class_no` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `daily_class_lecture`
--

INSERT INTO `daily_class_lecture` (`id`, `assign_class_id`, `course_outline`, `class_no`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '<p>Introduction with student.</p>\r\n', 1, 1, '2019-12-23 21:43:14', '2019-12-23 15:43:14');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `department_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0=inactive,1=active',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'CSE', 1, '2019-12-21 20:19:34', '2019-12-21 14:19:34'),
(2, 'EEE', 1, '2019-12-21 20:19:55', '2019-12-21 14:19:55');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `user_type` tinyint(4) NOT NULL COMMENT '1=admin,2=teacher,3=student',
  `username` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `user_type`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '2019-09-03 00:15:16', '2019-09-02 18:15:16'),
(63, 2, 'Anik', '25d55ad283aa400af464c76d713c07ad', '2019-12-21 20:24:59', '2019-12-21 14:24:59'),
(64, 2, 'Sanjid', '25d55ad283aa400af464c76d713c07ad', '2019-12-21 20:25:47', '2019-12-21 14:25:47'),
(65, 3, 'Tajbin', '25d55ad283aa400af464c76d713c07ad', '2019-12-21 20:26:34', '2019-12-21 14:26:34'),
(66, 3, 'farjana', '25d55ad283aa400af464c76d713c07ad', '2019-12-21 20:27:19', '2019-12-21 14:27:19'),
(67, 3, 'dvbnm,./', '25d55ad283aa400af464c76d713c07ad', '2019-12-23 11:56:38', '2019-12-23 05:56:38'),
(68, 2, 'ruman123', '25d55ad283aa400af464c76d713c07ad', '2019-12-23 18:40:35', '2019-12-23 12:40:35');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `member_id` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_id` int(11) DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `section` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `authentication` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=inactive/pending,1=active,2=rejected',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `member_id`, `login_id`, `email`, `name`, `department`, `section`, `semester`, `authentication`, `created_at`, `updated_at`) VALUES
(1, 'Anik001', 63, 'anik@gmail.com', 'Anik Sen', 1, NULL, NULL, 1, '2019-12-21 20:24:59', '2019-12-21 14:24:59'),
(2, 'Sanjid123', 64, 'sanjid@gmail.com', 'Sanjid hasan', 1, NULL, NULL, 1, '2019-12-21 20:25:47', '2019-12-21 14:25:47'),
(3, '1502810200884', 65, 'tajbin@gmail.com', 'TAJBIN', 1, 1, 2, 1, '2019-12-21 20:26:35', '2019-12-21 14:26:35'),
(4, '1502810200886', 66, 'farjana@gmail.com', 'Farjana Habib', 1, 1, 21, 1, '2019-12-21 20:27:20', '2019-12-21 14:27:20'),
(5, 'ertfgyujhikl;', 67, 'ghjkl@gmail.com', 'vbnm,./', 1, 1, 21, 2, '2019-12-23 11:56:38', '2019-12-23 05:56:38'),
(6, 'Ruman123', 68, 'Ruman@gmail.com', 'Ruman Ahmed', 1, NULL, NULL, 1, '2019-12-23 18:40:35', '2019-12-23 12:40:35');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `section_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=active,0=inactive',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `section_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'A', 1, '2019-12-21 20:22:31', NULL),
(2, ' B', 1, '2019-12-21 20:22:42', NULL),
(3, 'B', 0, '2019-12-22 11:54:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `semester_no` int(11) DEFAULT NULL,
  `semester_name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `semester_no`, `semester_name`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, '2nd Semester', 1, '2019-10-10 22:54:13', '2019-10-10 16:54:13'),
(3, 3, '3rd Semester', 1, '2019-10-10 23:18:56', '2019-10-10 17:18:56'),
(4, 4, '4th Semester', 1, '2019-10-10 23:19:04', '2019-10-10 17:19:04'),
(5, 5, '5th Semester', 1, '2019-10-10 23:19:15', '2019-10-10 17:19:15'),
(6, 6, '6th Semester', 1, '2019-10-10 23:19:23', '2019-10-10 17:19:23'),
(7, 7, '7th Semester', 1, '2019-10-10 23:19:34', '2019-10-10 17:19:34'),
(8, 8, '8th Semester', 1, '2019-10-10 23:19:42', '2019-11-19 17:48:50'),
(21, 1, '1st Semester', 1, '2019-12-21 15:36:35', '2019-12-21 09:36:35');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `session_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` year(4) NOT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `session_name`, `year`, `status`, `created_at`, `updated_at`) VALUES
(1, 'jan-jun', 2019, 1, '2019-12-21 20:22:56', '2019-12-21 14:22:56'),
(2, 'july-dec', 2019, 1, '2019-12-21 20:23:09', '2019-12-21 14:23:09'),
(3, 'Feb 2020', 2020, 1, '2019-12-28 12:08:15', '2019-12-28 06:08:15');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `student_id` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'same as member id',
  `name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active,0=inactive',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `student_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, '1502810200884', 'TAJBIN', 1, '2019-12-21 20:26:35', '2019-12-21 14:26:35'),
(2, '1502810200886', 'Farjana Habib', 1, '2019-12-21 20:27:20', '2019-12-21 14:27:20');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `subject_id` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `semester` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active,0=inactive',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `subject_id`, `subject_name`, `semester`, `status`, `created_at`, `updated_at`) VALUES
(1, 'CSE-101', 'Introduction of Computer Science', 21, 1, '2019-12-21 20:23:47', '2019-12-21 14:23:47'),
(2, 'CSE 201', 'Math 2', 2, 1, '2019-12-21 20:24:09', '2019-12-21 14:24:09');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `teacher_id` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'same as member id',
  `name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `teacher_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Anik001', 'Anik Sen', 1, '2019-12-21 20:24:59', '2019-12-21 14:24:59'),
(2, 'Sanjid123', 'Sanjid hasan', 1, '2019-12-21 20:25:47', '2019-12-21 14:25:47'),
(3, 'Ruman123', 'Ruman Ahmed', 1, '2019-12-23 18:40:35', '2019-12-23 12:40:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_class`
--
ALTER TABLE `assign_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_subject_student`
--
ALTER TABLE `assign_subject_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_teacher`
--
ALTER TABLE `assign_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_review`
--
ALTER TABLE `class_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_outline`
--
ALTER TABLE `course_outline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_class_lecture`
--
ALTER TABLE `daily_class_lecture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_class`
--
ALTER TABLE `assign_class`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assign_subject_student`
--
ALTER TABLE `assign_subject_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assign_teacher`
--
ALTER TABLE `assign_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `class_review`
--
ALTER TABLE `class_review`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_outline`
--
ALTER TABLE `course_outline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `daily_class_lecture`
--
ALTER TABLE `daily_class_lecture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
