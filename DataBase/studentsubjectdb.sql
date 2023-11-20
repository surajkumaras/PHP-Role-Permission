-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 11:04 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentsubjectdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permission`
--

CREATE TABLE `tbl_permission` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_permission`
--

INSERT INTO `tbl_permission` (`id`, `name`) VALUES
(1, 'View Students'),
(2, 'View Subjects'),
(3, 'Edit Student'),
(4, 'Delete Student'),
(5, 'Add Student'),
(6, 'Add Subject');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`id`, `role_name`) VALUES
(1, 'Head Boy'),
(2, 'CR'),
(3, 'Normal user'),
(4, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role_permission`
--

CREATE TABLE `tbl_role_permission` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_role_permission`
--

INSERT INTO `tbl_role_permission` (`id`, `role_id`, `permission_id`) VALUES
(90, 2, 1),
(91, 2, 2),
(92, 2, 3),
(96, 3, 2),
(97, 1, 1),
(98, 1, 2),
(99, 1, 3),
(120, 4, 1),
(121, 4, 2),
(122, 4, 3),
(123, 4, 4),
(124, 4, 5),
(125, 4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_info`
--

CREATE TABLE `tbl_student_info` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `age` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `city` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `course` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  `last_updated_by` varchar(30) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_student_info`
--

INSERT INTO `tbl_student_info` (`id`, `name`, `age`, `gender`, `city`, `email`, `mobile`, `course`, `password`, `is_admin`, `last_updated_by`, `updated_at`) VALUES
(28, 'Admin', '26', 'male', 'Mohali', 'admin@gmail.com', '2345167823', 'btech', '0192023a7bbd73250516f069df18b500', 1, NULL, NULL),
(54, 'Sandeep Singh', '21', 'male', 'chandigarh', 'sandeep@gmail.com', '08360333189', 'bca', '0192023a7bbd73250516f069df18b500', 0, 'Admin(Admin)', '2023-11-20 14:49:23'),
(56, 'Sonam Kaur', '20', 'female', 'Mohali', 'sonam@gmail.com', '08976543216', 'mca', '0192023a7bbd73250516f069df18b500', 0, 'Admin(Admin)', '2023-11-20 15:19:16'),
(60, 'Japneet Singh', '31', 'male', 'chandigarh', 'japneet@gmail.com', '6734891908', 'mca', '0192023a7bbd73250516f069df18b500', 0, 'Admin(Admin)', '2023-11-20 14:57:18'),
(61, 'Salman Khan', '30', 'male', 'chandigarh', 'sk@gmail.com', '07888986935', 'mca', '0192023a7bbd73250516f069df18b500', 0, 'Admin(Admin)', '2023-11-20 14:41:19'),
(62, 'Tester User', '21', 'male', 'Chandigarh', 'tester@gmail.com', '01234567890', 'btech', '0192023a7bbd73250516f069df18b500', 0, 'Normal user(Tester User)', '2023-11-20 15:20:08'),
(63, 'Aman Kumar', '23', 'male', 'Pune', 'aman@gmail.com', '56478346788', 'mca', 'c93ccd78b2076528346216b3b2f701e6', 0, 'Admin', '2023-11-09 13:23:24'),
(64, 'Ranjeet Kumar', '122', 'male', '1233322', 'suraj.enact@gmail.com', '21332121331', 'bca', 'de5b5bf65ba66517f9b70b1443d2102d', 0, NULL, NULL),
(66, 'Salman Khan', '12', 'male', 'chandigarh', 'sk@gmail.com', '7888986935', 'mca', '8bf7a7bc89e958009b0ded89cb6ed103', 0, NULL, NULL),
(68, 'Arun', '34', 'male', 'chd', 'arun@gmail.com', '5634267189', 'bca', '0192023a7bbd73250516f069df18b500', 0, NULL, NULL),
(69, 'Ritik', '6', 'male', 'chd', 'test1@gmail.com', '6734562891', 'bca', '0192023a7bbd73250516f069df18b500', 0, NULL, NULL),
(70, 'juned', '22', 'male', 'MGG', 'juned@gmail.com', '8264886178', 'bca', '954fedb081717fa348d50f0e62e9725b', 0, 'Normal user(juned)', '2023-11-10 16:52:31'),
(71, 'Juned', '22', 'male', 'Mohali', 'juned@gmail.com', '8360666189', 'bca', '0192023a7bbd73250516f069df18b500', 0, NULL, NULL),
(72, 'Gourav', '21', 'male', 'Chandigarh', 'gourav@gmail.com', '8360666188', 'dca', '0192023a7bbd73250516f069df18b500', 0, NULL, NULL),
(73, 'ankita kumari', '12', 'male', 'chandigarh', 'ankita@gmail.com', '6207202218', 'bca', 'cdb5acc7f0087d46b8e231d83679d0eb', 0, 'Admin(Admin)', '2023-11-16 16:56:56'),
(74, 'Sangeeta', '34', 'female', 'Mohali', 'sangeeta@gmail.com', '4325673489', 'bca', '0192023a7bbd73250516f069df18b500', 0, NULL, NULL),
(75, 'Arpit', '18', 'male', 'Mohali', 'arpit@gmail.com', '8360666173', 'bca', '0192023a7bbd73250516f069df18b500', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_role`
--

CREATE TABLE `tbl_student_role` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_student_role`
--

INSERT INTO `tbl_student_role` (`id`, `student_id`, `role_id`) VALUES
(13, 60, 3),
(19, 62, 3),
(21, 56, 3),
(23, 28, 4),
(28, 63, 4),
(31, 64, 3),
(33, 66, 3),
(35, 68, 1),
(36, 69, 3),
(38, 61, 3),
(39, 70, 3),
(41, 54, 1),
(42, 71, 3),
(43, 72, 3),
(44, 73, 4),
(45, 74, 3),
(46, 75, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_subject`
--

CREATE TABLE `tbl_student_subject` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_student_subject`
--

INSERT INTO `tbl_student_subject` (`id`, `student_id`, `subject_id`) VALUES
(223, 63, 1),
(224, 63, 4),
(225, 63, 22),
(228, 64, 8),
(230, 66, 1),
(239, 68, 3),
(240, 68, 5),
(241, 69, 1),
(264, 70, 1),
(265, 70, 22),
(266, 70, 31),
(272, 71, 1),
(273, 71, 3),
(274, 72, 4),
(275, 72, 7),
(280, 73, 1),
(281, 73, 3),
(282, 73, 31),
(283, 74, 3),
(284, 74, 6),
(285, 75, 2),
(286, 75, 5),
(327, 61, 2),
(330, 54, 4),
(331, 54, 7),
(338, 60, 5),
(339, 60, 22),
(352, 56, 1),
(353, 56, 6),
(354, 56, 31),
(355, 62, 2),
(356, 62, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subjects`
--

CREATE TABLE `tbl_subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subjects`
--

INSERT INTO `tbl_subjects` (`id`, `name`) VALUES
(1, 'C++'),
(2, 'PHP'),
(3, 'JAVA'),
(4, 'PYTHON'),
(5, 'C'),
(6, 'RDBMS'),
(7, 'Linux'),
(8, 'ML'),
(22, 'OS'),
(31, 'DAA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_permission`
--
ALTER TABLE `tbl_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_role_permission`
--
ALTER TABLE `tbl_role_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Role_permission` (`role_id`),
  ADD KEY `FK_permission_id` (`permission_id`);

--
-- Indexes for table `tbl_student_info`
--
ALTER TABLE `tbl_student_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_student_role`
--
ALTER TABLE `tbl_student_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Role_id` (`role_id`),
  ADD KEY `fk_Student_Roles` (`student_id`);

--
-- Indexes for table `tbl_student_subject`
--
ALTER TABLE `tbl_student_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Student_id` (`student_id`),
  ADD KEY `FK_Subject_id` (`subject_id`);

--
-- Indexes for table `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_permission`
--
ALTER TABLE `tbl_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_role_permission`
--
ALTER TABLE `tbl_role_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `tbl_student_info`
--
ALTER TABLE `tbl_student_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `tbl_student_role`
--
ALTER TABLE `tbl_student_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_student_subject`
--
ALTER TABLE `tbl_student_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=357;

--
-- AUTO_INCREMENT for table `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_role_permission`
--
ALTER TABLE `tbl_role_permission`
  ADD CONSTRAINT `FK_Role_permission` FOREIGN KEY (`role_id`) REFERENCES `tbl_roles` (`id`),
  ADD CONSTRAINT `FK_permission_id` FOREIGN KEY (`permission_id`) REFERENCES `tbl_permission` (`id`);

--
-- Constraints for table `tbl_student_role`
--
ALTER TABLE `tbl_student_role`
  ADD CONSTRAINT `FK_Role_id` FOREIGN KEY (`role_id`) REFERENCES `tbl_roles` (`id`),
  ADD CONSTRAINT `fk_Student_Roles` FOREIGN KEY (`student_id`) REFERENCES `tbl_student_info` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_student_subject`
--
ALTER TABLE `tbl_student_subject`
  ADD CONSTRAINT `FK_Student_id` FOREIGN KEY (`student_id`) REFERENCES `tbl_student_info` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Subject_id` FOREIGN KEY (`subject_id`) REFERENCES `tbl_subjects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
