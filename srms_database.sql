-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2024 at 12:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `srms_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `attend_id` int(11) NOT NULL,
  `sem_reg_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `session_name` varchar(22) DEFAULT NULL,
  `semesterno` varchar(10) DEFAULT NULL,
  `section` varchar(22) NOT NULL,
  `present` int(11) NOT NULL,
  `attend_type` varchar(22) NOT NULL,
  `attend_date` varchar(22) NOT NULL,
  `attend_month` varchar(22) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dep_id` int(11) NOT NULL,
  `name` varchar(22) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dep_id`, `name`, `created_at`) VALUES
(1, 'CSE', '2024-03-20 03:19:52'),
(5, 'ECSE', '2024-05-15 08:27:34');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `grade_id` int(11) NOT NULL,
  `letter` varchar(10) NOT NULL,
  `point` varchar(10) NOT NULL,
  `scroes` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`grade_id`, `letter`, `point`, `scroes`) VALUES
(1, 'A+', '4.00', '80-100'),
(2, 'A', '3.75', '75-79'),
(3, 'A-', '3.50', '70-74'),
(4, 'B+', '3.25', '65-69'),
(5, 'B', '3.00', '60-64'),
(6, 'B-', '2.75', '55-59'),
(7, 'C+', '2.50', '50-54'),
(8, 'C', '2.25', '45-49'),
(9, 'D', '2.00', '40-44'),
(10, 'F', '0.00', '0-39');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `pg_id` int(11) NOT NULL,
  `name` varchar(22) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`pg_id`, `name`, `created_at`) VALUES
(1, 'Day', '2024-03-20 03:29:01'),
(2, 'Evening', '2024-03-20 03:29:01');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `result_id` int(11) NOT NULL,
  `sem_reg_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `department` varchar(22) NOT NULL,
  `session` varchar(22) NOT NULL,
  `program` varchar(22) NOT NULL,
  `semester` varchar(22) NOT NULL,
  `section` varchar(22) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `ct` int(100) NOT NULL,
  `mcq` int(100) NOT NULL,
  `cq` int(100) NOT NULL,
  `attend` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `letter` varchar(5) NOT NULL,
  `point` double(11,2) NOT NULL,
  `cgpa` double(11,2) NOT NULL DEFAULT 0.00,
  `result_type` varchar(22) NOT NULL,
  `result_date` varchar(22) NOT NULL,
  `result_month` varchar(22) NOT NULL,
  `published_by` int(11) NOT NULL,
  `approved_status` tinyint(1) NOT NULL DEFAULT 0,
  `approved_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role`, `created_at`) VALUES
(1, 'Admin', '2024-03-09 09:42:44'),
(2, 'Teacher', '2024-03-09 09:42:44'),
(3, 'Student', '2024-03-09 09:42:44');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `sec_id` int(11) NOT NULL,
  `name` varchar(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`sec_id`, `name`, `created_at`) VALUES
(1, 'A', '2024-03-20 04:10:38'),
(2, 'B', '2024-03-20 04:10:38'),
(3, 'C', '2024-03-20 04:10:38');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `sem_id` int(11) NOT NULL,
  `name` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`sem_id`, `name`) VALUES
(1, '1st'),
(2, '2nd'),
(3, '3rd'),
(4, '4th'),
(5, '5th'),
(6, '6th'),
(7, '7th'),
(8, '8th'),
(9, '9th'),
(10, '10th '),
(11, '11th'),
(13, '12th ');

-- --------------------------------------------------------

--
-- Table structure for table `semester_registrations`
--

CREATE TABLE `semester_registrations` (
  `sem_reg_id` int(11) NOT NULL,
  `reg_info_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `tsacd_id` int(11) NOT NULL,
  `department` varchar(10) NOT NULL,
  `session` varchar(22) NOT NULL,
  `program` varchar(22) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `section` varchar(5) NOT NULL,
  `letter_grade` varchar(10) DEFAULT NULL,
  `grade_point` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tgp` decimal(10,2) NOT NULL DEFAULT 0.00,
  `result_for` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semester_reg_info`
--

CREATE TABLE `semester_reg_info` (
  `sem_reg_info_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `session` varchar(22) NOT NULL,
  `semester_no` varchar(5) NOT NULL,
  `total_credit` double(11,2) NOT NULL DEFAULT 0.00,
  `reg_date` varchar(22) NOT NULL,
  `reg_month` varchar(22) NOT NULL,
  `is_approve` tinyint(1) DEFAULT 0 COMMENT '1=Yes,0=No',
  `is_midd` tinyint(1) NOT NULL DEFAULT 0,
  `is_final` tinyint(1) NOT NULL DEFAULT 0,
  `is_complete` tinyint(1) NOT NULL DEFAULT 0,
  `approved_by` int(11) DEFAULT NULL,
  `approved_date` varchar(22) DEFAULT NULL,
  `adviser_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semester_subjects`
--

CREATE TABLE `semester_subjects` (
  `sem_sub_id` int(11) NOT NULL,
  `department` varchar(22) NOT NULL,
  `program` varchar(22) NOT NULL,
  `session` varchar(22) NOT NULL,
  `semester` varchar(22) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semester_subject_list`
--

CREATE TABLE `semester_subject_list` (
  `data_id` int(11) NOT NULL,
  `sem_sbject_id` int(11) NOT NULL,
  `sub_department` varchar(22) NOT NULL,
  `sub_program` varchar(22) NOT NULL,
  `sub_session` varchar(22) NOT NULL,
  `sub_semester` varchar(22) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `section` varchar(22) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `name` varchar(22) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `name`, `created_at`) VALUES
(1, 'Spring', '2024-03-20 03:28:20'),
(2, 'Summer', '2024-03-20 03:28:20'),
(3, 'Fall', '2024-03-20 03:28:20');

-- --------------------------------------------------------

--
-- Table structure for table `student_results`
--

CREATE TABLE `student_results` (
  `id` int(11) NOT NULL,
  `sem_reg_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `department` varchar(22) NOT NULL,
  `session` varchar(22) NOT NULL,
  `program` varchar(22) NOT NULL,
  `semester` varchar(22) NOT NULL,
  `section` varchar(22) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `mid_ct` int(100) NOT NULL,
  `mid_mcq` int(100) NOT NULL,
  `mid_cq` int(100) NOT NULL,
  `mid_attend` int(11) DEFAULT NULL,
  `mid_total` int(11) NOT NULL,
  `mid_letter` varchar(5) NOT NULL,
  `mid_point` double(11,2) NOT NULL,
  `mid_cgpa` double(11,2) NOT NULL,
  `mid_date` varchar(22) NOT NULL,
  `mid_month` varchar(22) NOT NULL,
  `final_ct` int(100) DEFAULT NULL,
  `final_mcq` int(100) DEFAULT NULL,
  `final_cq` int(100) DEFAULT NULL,
  `final_attend` int(11) DEFAULT NULL,
  `final_total` int(11) DEFAULT NULL,
  `final_letter` varchar(10) DEFAULT NULL,
  `final_point` double(11,2) DEFAULT NULL,
  `final_cgpa` double DEFAULT NULL,
  `grand_total_mark` int(11) DEFAULT NULL,
  `final_date` varchar(22) DEFAULT NULL,
  `final_month` varchar(22) DEFAULT NULL,
  `published_by` int(11) NOT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `result_type` varchar(5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_result_info`
--

CREATE TABLE `student_result_info` (
  `stu_result_id` int(11) NOT NULL,
  `sem_reg_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `session_name` varchar(22) NOT NULL,
  `midavg_score` int(11) NOT NULL,
  `midletter` varchar(5) NOT NULL,
  `midpoint` double NOT NULL DEFAULT 0,
  `finalavg_score` int(11) DEFAULT NULL,
  `finalletter` varchar(5) DEFAULT NULL,
  `finalpoint` double(11,2) DEFAULT NULL,
  `cgpa` double(11,2) DEFAULT NULL,
  `passing_year` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `sub_id` int(11) NOT NULL,
  `course_code` varchar(50) NOT NULL,
  `course_title` varchar(200) NOT NULL,
  `credit_hour` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`sub_id`, `course_code`, `course_title`, `credit_hour`, `created_at`) VALUES
(1, 'ENG 1203 ', 'Reading and Writing ', '3.00', '2024-03-20 04:12:05'),
(2, 'CSE 1101 ', 'Introduction to Computers', '2.00', '2024-03-20 04:12:05'),
(3, 'GED 1202', 'Emergency of Bangladesh ', '3.00', '2024-03-20 04:12:05'),
(4, 'CSE 4278', 'Computer graphics', '3.00', '2024-03-20 04:12:05'),
(5, 'CSE 1102', 'Structured Programming', '3.00', '2024-03-20 04:12:05'),
(6, 'CSE 1213', 'Object Oriented Programming', '3.00', '2024-03-20 04:12:05'),
(7, 'CSE 1214', 'Data Structures and Algorithms', '3.00', '2024-03-20 04:12:05'),
(8, 'CSE 1319', 'Theory of Computation', '2.00', '2024-03-20 04:12:05'),
(9, 'CSE 2314', 'VLSI', '3.00', '2024-03-20 04:12:05');

-- --------------------------------------------------------

--
-- Table structure for table `subject_teachers`
--

CREATE TABLE `subject_teachers` (
  `subt_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `department` varchar(22) NOT NULL,
  `session` varchar(22) NOT NULL,
  `program` varchar(22) NOT NULL,
  `semester` varchar(22) NOT NULL,
  `section` varchar(22) NOT NULL,
  `assign_from` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_students`
--

CREATE TABLE `teacher_students` (
  `ts_id` int(11) NOT NULL,
  `id_no` varchar(22) NOT NULL,
  `uniq_id` varchar(100) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `name` varchar(55) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `father` varchar(55) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `department` varchar(22) NOT NULL,
  `program` varchar(22) NOT NULL,
  `first_reg_date` varchar(22) NOT NULL,
  `type` varchar(22) NOT NULL DEFAULT 'teacher',
  `role` tinyint(1) NOT NULL COMMENT '1=Admin, 2=Teacher,3=Student',
  `password` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=Active,0=Inactive',
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_students`
--

INSERT INTO `teacher_students` (`ts_id`, `id_no`, `uniq_id`, `photo`, `name`, `contact`, `email`, `father`, `address`, `department`, `program`, `first_reg_date`, `type`, `role`, `password`, `status`, `is_delete`, `created_at`) VALUES
(10, 'NUBA01', '', NULL, 'Muhammed Samsuddoha Alam', '01676453189', 'samsuddoha@gmail.com', NULL, NULL, 'ALL', 'ALL', '2024-03-22', 'admin', 1, '47c46c18cb8f9c1d1c6ba5145feaa699a33b315b', 1, 0, '2024-03-22 10:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_student_acads`
--

CREATE TABLE `teacher_student_acads` (
  `tsacd_id` int(11) NOT NULL,
  `ts_id` int(11) NOT NULL,
  `id_no` varchar(22) NOT NULL,
  `uniq_id` varchar(100) NOT NULL,
  `session` varchar(22) NOT NULL,
  `year` int(11) NOT NULL,
  `semester` varchar(22) NOT NULL,
  `section` varchar(5) NOT NULL,
  `reg_date` varchar(22) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1=Running,2=Closed',
  `result_published` tinyint(1) NOT NULL DEFAULT 0,
  `data_type` varchar(22) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`attend_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dep_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`pg_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`sec_id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`sem_id`);

--
-- Indexes for table `semester_registrations`
--
ALTER TABLE `semester_registrations`
  ADD PRIMARY KEY (`sem_reg_id`);

--
-- Indexes for table `semester_reg_info`
--
ALTER TABLE `semester_reg_info`
  ADD PRIMARY KEY (`sem_reg_info_id`);

--
-- Indexes for table `semester_subjects`
--
ALTER TABLE `semester_subjects`
  ADD PRIMARY KEY (`sem_sub_id`);

--
-- Indexes for table `semester_subject_list`
--
ALTER TABLE `semester_subject_list`
  ADD PRIMARY KEY (`data_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_results`
--
ALTER TABLE `student_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_result_info`
--
ALTER TABLE `student_result_info`
  ADD PRIMARY KEY (`stu_result_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `subject_teachers`
--
ALTER TABLE `subject_teachers`
  ADD PRIMARY KEY (`subt_id`);

--
-- Indexes for table `teacher_students`
--
ALTER TABLE `teacher_students`
  ADD PRIMARY KEY (`ts_id`);

--
-- Indexes for table `teacher_student_acads`
--
ALTER TABLE `teacher_student_acads`
  ADD PRIMARY KEY (`tsacd_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `attend_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `pg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `sec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `sem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `semester_registrations`
--
ALTER TABLE `semester_registrations`
  MODIFY `sem_reg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semester_reg_info`
--
ALTER TABLE `semester_reg_info`
  MODIFY `sem_reg_info_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semester_subjects`
--
ALTER TABLE `semester_subjects`
  MODIFY `sem_sub_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semester_subject_list`
--
ALTER TABLE `semester_subject_list`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_results`
--
ALTER TABLE `student_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_result_info`
--
ALTER TABLE `student_result_info`
  MODIFY `stu_result_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subject_teachers`
--
ALTER TABLE `subject_teachers`
  MODIFY `subt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher_students`
--
ALTER TABLE `teacher_students`
  MODIFY `ts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `teacher_student_acads`
--
ALTER TABLE `teacher_student_acads`
  MODIFY `tsacd_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
