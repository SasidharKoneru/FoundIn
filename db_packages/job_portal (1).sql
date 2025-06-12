-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2025 at 11:45 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobseekers`
--

CREATE TABLE `jobseekers` (
  `jobseeker_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(30) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `education` varchar(200) DEFAULT NULL,
  `skills` text,
  `experience` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobseekers`
--

INSERT INTO `jobseekers` (`jobseeker_id`, `full_name`, `email`, `password`, `phone_number`, `date_of_birth`, `gender`, `education`, `skills`, `experience`, `created_at`, `updated_at`) VALUES
(2, 'Koneru Sasidhar', 'sasi123435@gmail.com', 'abcd1234', '0123456780', '2025-01-10', 'Male', 'B.Tech', 'Java, Python', NULL, '2025-01-02 07:02:18', '2025-01-02 07:02:18'),
(3, 'Sasidhar', 'sasi123@gmail.com', '12343', '9876543201', '2001-12-30', 'Male', 'B.Tech', 'HTML, CSS, JavaScript.', NULL, '2025-01-06 10:15:35', '2025-01-06 10:15:35'),
(4, 'sasi', 'sasi12345@gmail.com', '12343', '0234567890', '2025-01-08', 'Male', 'Bachelor\'s Degree', 'java, python , sql\r\n', NULL, '2025-01-07 06:10:04', '2025-01-07 06:10:04'),
(5, 'sasi', 'sasi1.2345@gmail.com', '12343', '0234567890', '2025-01-08', 'Male', 'Bachelor\'s Degree', 'java, python, sql', NULL, '2025-01-07 06:10:46', '2025-01-07 06:10:46'),
(6, 'sasi', 'sasi12.345@gmail.com', '12343', '0234567890', '2025-01-08', 'Male', 'Bachelor\'s Degree', 'java, python, sql', NULL, '2025-01-07 06:12:16', '2025-01-07 06:12:16'),
(7, 'sasi', 'sasi123.45@gmail.com', '12343', '0234567890', '2024-12-29', 'Male', 'Bachelor\'s Degree', 'java, python, sql', NULL, '2025-01-07 06:13:25', '2025-01-07 06:13:25'),
(8, 'sasi', 'sasi.12345@gmail.com', '12343', '0234567890', '2024-12-29', 'Male', 'Diploma', 'java, python , sql', NULL, '2025-01-07 06:14:39', '2025-01-07 06:14:39'),
(9, 'sasi', 'sasi1.345@gmail.com', '12343', '0234567890', '2025-01-09', 'Male', 'Bachelor\'s Degree', 'java, python , sql', NULL, '2025-01-07 13:32:22', '2025-01-07 13:32:22'),
(10, 'sasi', 'sasi1235@gmail.com', '12343', '0234567890', '2025-01-09', 'Male', 'Bachelor\'s Degree', 'java, python , sql', NULL, '2025-01-07 13:35:08', '2025-01-07 13:35:08'),
(11, 'sasi', 'sasidhar12345@gmail.com', '12343', '0123456789', '2025-01-09', 'Male', 'Bachelor\'s Degree', 'java', NULL, '2025-01-08 04:42:17', '2025-01-08 04:42:17');

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `application_id` int(11) NOT NULL,
  `jobseeker_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `recruiter_id` int(11) NOT NULL,
  `applied_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Pending','Reviewed','Interviewed','Accepted','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`application_id`, `jobseeker_id`, `job_id`, `recruiter_id`, `applied_at`, `status`) VALUES
(12, 2, 8, 1, '2025-01-03 12:14:39', 'Interviewed'),
(14, 2, 13, 1, '2025-01-04 07:04:00', 'Reviewed'),
(15, 2, 6, 1, '2025-01-04 07:04:11', 'Pending'),
(19, 2, 15, 1, '2025-01-04 09:35:59', 'Accepted'),
(20, 2, 16, 1, '2025-01-06 12:17:54', 'Pending'),
(22, 3, 8, 1, '2025-01-06 14:04:26', 'Reviewed'),
(23, 3, 86, 1, '2025-01-06 14:04:51', 'Pending'),
(24, 4, 6, 1, '2025-01-07 11:13:05', 'Reviewed'),
(25, 4, 176, 1, '2025-01-07 11:13:10', 'Reviewed'),
(27, 4, 221, 1, '2025-01-07 12:42:48', 'Pending'),
(29, 4, 8, 1, '2025-01-07 13:35:23', 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `job_posts`
--

CREATE TABLE `job_posts` (
  `job_id` int(11) NOT NULL,
  `recruiter_id` int(11) DEFAULT '1',
  `job_title` varchar(255) NOT NULL,
  `job_description` text NOT NULL,
  `salary_range` varchar(100) DEFAULT NULL,
  `company_location` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_website` varchar(255) DEFAULT NULL,
  `job_type` enum('Full-time','Part-time','Contract','Internship') NOT NULL,
  `job_category` varchar(100) DEFAULT NULL,
  `required_experience` int(11) DEFAULT NULL,
  `education_level` enum('None','High School','Associate','Bachelor','Master','PhD') NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiration_date` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('Active','Expired','Closed') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_posts`
--

INSERT INTO `job_posts` (`job_id`, `recruiter_id`, `job_title`, `job_description`, `salary_range`, `company_location`, `company_name`, `company_website`, `job_type`, `job_category`, `required_experience`, `education_level`, `post_date`, `expiration_date`, `status`) VALUES
(6, 1, 'Java Developer', 'Who has good hands on experience in Java programming can apply for this position.', '600000', 'Bengaluru', 'ABD TECH', 'www.abdtech.in', 'Full-time', 'Engineering', 0, 'PhD', '2025-01-02 13:54:41', '2025-01-14 18:30:00', 'Active'),
(8, 1, 'Java Back-End Developer Trainee', 'Person having hands on experience in java can apply', '60000 - 70000', 'Hyderabad', 'ABD TECH', 'www.abc.in', 'Full-time', 'Engineering', 1, '', '2025-01-03 04:30:46', '2025-01-07 18:30:00', 'Active'),
(13, 2, 'MERN Stack Developer ', 'Who has good hands on experience in Java programming can apply for this position.', '60000 - 70000', 'Hyderabad', 'ABD TECH', 'www.vibhotech.in', 'Full-time', 'Engineering', 0, '', '2025-01-03 10:35:32', '2025-01-22 18:30:00', 'Active'),
(15, 1, 'Data Analyst trainee', 'Passionate person in content creating feild can apply.', '35000 - 45000', 'Hyderabad', 'ABD TECH', 'www.abc.in', 'Full-time', 'Engineering', 0, '', '2025-01-04 09:34:46', '2025-01-12 18:30:00', 'Active'),
(16, 2, 'AI Engineer', 'Should have strong knowledge on AI Models and python.', '55000 - 60000', 'Bengaluru', 'ABD TECH', 'www.abdtech.in', 'Full-time', 'Engineering', 0, '', '2025-01-06 04:33:00', '2025-01-07 18:30:00', 'Active'),
(84, 2, 'Data Analyst', 'Join our data team and help us analyze and visualize key business metrics. We are seeking someone with a strong background in data analysis and statistical modeling.', '45,000 - 65,000', 'San Francisco, CA', 'Data Solutions', 'https://www.datasolutions.com', 'Full-time', 'Data Science', 2, '', '2025-01-06 12:21:38', '2025-01-13 12:21:38', 'Active'),
(85, 2, 'Graphic Designer', 'We are seeking a creative and talented graphic designer to help create visual content for our marketing team. Strong skills in Adobe Creative Suite required.', '40,000 - 55,000', 'Los Angeles, CA', 'Creative Studio', 'https://www.creativestudio.com', 'Full-time', 'Design', 1, '', '2025-01-06 12:21:38', '2025-01-13 12:21:38', 'Active'),
(86, 2, 'Project Manager', 'We are looking for an experienced project manager to oversee our ongoing software development projects. The candidate should have experience managing a team and meeting deadlines.', '60,000 - 85,000', 'Chicago, IL', 'Global Projects Inc.', 'https://www.globalprojects.com', 'Full-time', 'Management', 5, '', '2025-01-06 12:21:38', '2025-01-13 12:21:38', 'Active'),
(87, 2, 'Marketing Specialist', 'Looking for a marketing specialist to help develop and implement strategies to promote our products and services. Experience with digital marketing and SEO is a must.', '40,000 - 60,000', 'Boston, MA', 'MarketX', 'https://www.marketx.com', 'Full-time', 'Marketing', 2, '', '2025-01-06 12:21:38', '2025-01-13 12:21:38', 'Active'),
(90, 2, 'Java Back-End Developer Trainee', 'Person having hands on experience in java can apply', '60000 - 70000', 'Hyderabad', 'ABD TECH', 'www.abc.in', 'Full-time', 'Engineering', 0, '', '2025-01-06 12:21:38', '2025-01-13 12:21:38', 'Active'),
(93, 2, 'Data Analyst trainee', 'Passionate person in content creating feild can apply.', '35000 - 45000', 'Hyderabad', 'ABD TECH', 'www.abc.in', 'Full-time', 'Engineering', 0, '', '2025-01-06 12:21:39', '2025-01-13 12:21:39', 'Active'),
(95, 2, 'AI Engineer', 'Having good knowledge of AI models and python.', '55000 - 60000', 'Bengaluru', 'abc', 'www.abdtech.in', 'Full-time', 'Engineering', 0, '', '2025-01-06 12:21:39', '2025-01-13 12:21:39', 'Active'),
(155, 1, 'AI Engineer', 'Having good knowledge of AI models and python.', '55000 - 60000', 'Bengaluru', 'abc', 'www.abdtech.in', 'Full-time', 'Engineering', 0, '', '2025-01-07 08:59:25', '2025-01-13 18:30:00', 'Active'),
(160, 1, 'Java Developer', 'Who has good hands on experience in Java programming can apply for this position.', '600000', 'Bengaluru', 'ABD TECH', 'www.abdtech.in', 'Full-time', 'Engineering', 0, '', '2025-01-07 09:13:10', '2025-01-26 18:30:00', 'Active'),
(162, 1, 'Java Back-End Developer Trainee', 'Person having hands on experience in java can apply', '60000 - 70000', 'Hyderabad', 'ABD TECH', 'www.abc.in', 'Full-time', 'Engineering', 0, '', '2025-01-07 09:13:10', '2025-01-07 18:30:00', 'Active'),
(168, 1, 'Software Engineer', 'Develop and maintain software applications using Java and Python.', '50000-70000', 'New York, NY', 'TechCorp', 'https://www.techcorp.com', 'Full-time', 'Engineering', 3, '', '2025-01-07 11:11:04', '2025-02-28 18:30:00', 'Active'),
(169, 1, 'Marketing Manager', 'Lead the marketing team in executing campaigns, analyzing market trends, and increasing brand visibility.', '60000-90000', 'San Francisco, CA', 'MarketMinds', 'https://www.marketminds.com', 'Part-time', 'Marketing', 5, '', '2025-01-07 11:11:04', '2025-02-14 18:30:00', 'Active'),
(170, 1, 'Product Designer', 'Work on designing new products and improving existing products based on user feedback and market needs.', '45000-65000', 'Los Angeles, CA', 'DesignWorks', 'https://www.designworks.com', 'Contract', 'Design', 4, 'PhD', '2025-01-07 11:11:04', '2025-03-31 18:30:00', 'Active'),
(171, 1, 'Software Engineer', 'Develop and maintain software applications using Java and Python.', '50000-70000', 'New York, NY', 'TechCorp', 'https://www.techcorp.com', 'Full-time', 'Engineering', 3, '', '2025-01-07 11:11:20', '2025-02-28 18:30:00', 'Active'),
(172, 1, 'Marketing Manager', 'Lead the marketing team in executing campaigns, analyzing market trends, and increasing brand visibility.', '60000-90000', 'San Francisco, CA', 'MarketMinds', 'https://www.marketminds.com', 'Part-time', 'Marketing', 5, '', '2025-01-07 11:11:20', '2025-02-14 18:30:00', 'Active'),
(173, 1, 'Product Designer', 'Work on designing new products and improving existing products based on user feedback and market needs.', '45000-65000', 'Los Angeles, CA', 'DesignWorks', 'https://www.designworks.com', 'Contract', 'Design', 4, 'PhD', '2025-01-07 11:11:20', '2025-03-31 18:30:00', 'Active'),
(174, 1, 'Software Engineer', 'Develop and maintain software applications using Java and Python.', '50000-70000', 'New York, NY', 'TechCorp', 'https://www.techcorp.com', 'Full-time', 'Engineering', 3, '', '2025-01-07 11:12:22', '2025-02-28 18:30:00', 'Active'),
(175, 1, 'Marketing Manager', 'Lead the marketing team in executing campaigns, analyzing market trends, and increasing brand visibility.', '60000-90000', 'San Francisco, CA', 'MarketMinds', 'https://www.marketminds.com', 'Part-time', 'Marketing', 5, '', '2025-01-07 11:12:22', '2025-02-14 18:30:00', 'Active'),
(176, 1, 'Product Designer', 'Work on designing new products and improving existing products based on user feedback and market needs.', '45000-65000', 'Los Angeles, CA', 'DesignWorks', 'https://www.designworks.com', 'Contract', 'Design', 4, 'PhD', '2025-01-07 11:12:22', '2025-03-31 18:30:00', 'Active'),
(177, 1, 'Software Engineer', 'Develop and maintain software applications using Java and Python.', '50000-70000', 'New York, NY', 'TechCorp', 'https://www.techcorp.com', 'Full-time', 'Engineering', 3, '', '2025-01-07 11:21:50', '2025-02-28 18:30:00', 'Active'),
(178, 1, 'Marketing Manager', 'Lead the marketing team in executing campaigns, analyzing market trends, and increasing brand visibility.', '60000-90000', 'San Francisco, CA', 'MarketMinds', 'https://www.marketminds.com', 'Part-time', 'Marketing', 5, '', '2025-01-07 11:21:50', '2025-02-14 18:30:00', 'Active'),
(179, 1, 'Product Designer', 'Work on designing new products and improving existing products based on user feedback and market needs.', '45000-65000', 'Los Angeles, CA', 'DesignWorks', 'https://www.designworks.com', 'Contract', 'Design', 4, 'PhD', '2025-01-07 11:21:50', '2025-03-31 18:30:00', 'Active'),
(221, 1, 'Java Developer', 'fghfdgh', '600000', 'Hyderabad', 'abc', 'www.abc.in', 'Full-time', 'Engineering', 3, '', '2025-01-07 12:26:23', '2025-01-07 18:30:00', 'Active'),
(222, 1, 'Data Analyst', 'dfsdf', '60000 - 70000', 'Hyderabad', 'abc', 'www.abc.in', 'Full-time', 'Engineering', 2, '', '2025-01-07 13:22:44', '2025-01-07 18:30:00', 'Active'),
(248, 1, 'Software Engineer', 'Develop and maintain software applications using Java and Python.', '50000-70000', 'New York, NY', 'TechCorp', 'https://www.techcorp.com', 'Full-time', 'Engineering', 3, '', '2025-01-08 05:17:54', '2025-02-28 18:30:00', 'Active'),
(249, 1, 'Marketing Manager', 'Lead the marketing team in executing campaigns, analyzing market trends, and increasing brand visibility.', '60000-90000', 'San Francisco, CA', 'MarketMinds', 'https://www.marketminds.com', 'Part-time', 'Marketing', 5, '', '2025-01-08 05:17:54', '2025-02-14 18:30:00', 'Active'),
(250, 1, 'Product Designer', 'Work on designing new products and improving existing products based on user feedback and market needs.', '45000-65000', 'Los Angeles, CA', 'DesignWorks', 'https://www.designworks.com', 'Contract', 'Design', 4, 'PhD', '2025-01-08 05:17:54', '2025-03-31 18:30:00', 'Active'),
(251, 1, 'Java Developer', 'fghfdgh', '45000', 'Hyderabad', 'abc', 'https://www.abc.in', 'Full-time', 'Engineering', 3, '', '2025-01-08 06:41:00', '2025-01-08 18:30:00', 'Active'),
(256, 2, 'Java Developer', 'Who has good hands on experience in Java programming can apply for this position.', '600000', 'Bengaluru', 'ABD TECH', 'www.abdtech.in', 'Full-time', 'Engineering', 0, '', '2025-01-08 09:51:47', '0000-00-00 00:00:00', 'Active'),
(257, 2, 'Java Developer', 'Who has good hands on experience in Java programming can apply for this position.', '600000', 'Bengaluru', 'ABD TECH', 'www.abdtech.in', 'Full-time', 'Engineering', 0, '', '2025-01-08 09:51:47', '0000-00-00 00:00:00', 'Active'),
(260, 2, 'MERN Stack Developer ', 'Who has good hands on experience in Java programming can apply for this position.', '60000 - 70000', 'Hyderabad', 'ABD TECH', 'www.vibhotech.in', 'Full-time', 'Engineering', 0, '', '2025-01-08 09:51:47', '0000-00-00 00:00:00', 'Active'),
(261, 2, 'Data Analyst trainee', 'Passionate person in content creating feild can apply.', '35000 - 45000', 'Hyderabad', 'ABD TECH', 'www.abc.in', 'Full-time', 'Engineering', 0, '', '2025-01-08 09:51:47', '0000-00-00 00:00:00', 'Active'),
(262, 2, 'AI Engineer', 'Should have strong knowledge on AI Models and python.', '55000 - 60000', 'Bengaluru', 'ABD TECH', 'www.abdtech.in', 'Full-time', 'Engineering', 0, '', '2025-01-08 09:51:47', '0000-00-00 00:00:00', 'Active'),
(263, 2, 'AI Engineer', 'Having good knowledge of AI models and python.', '55000 - 60000', 'Bengaluru', 'abc', 'www.abdtech.in', 'Full-time', 'Engineering', 0, '', '2025-01-08 09:51:47', '0000-00-00 00:00:00', 'Active'),
(264, 2, 'Software Engineer', 'Develop and maintain software applications using Java and Python.', '50000-70000', 'New York, NY', 'TechCorp', 'https://www.techcorp.com', 'Full-time', 'Engineering', 3, '', '2025-01-08 09:52:02', '2025-02-28 18:30:00', 'Active'),
(265, 2, 'Marketing Manager', 'Lead the marketing team in executing campaigns, analyzing market trends, and increasing brand visibility.', '60000-90000', 'San Francisco, CA', 'MarketMinds', 'https://www.marketminds.com', 'Part-time', 'Marketing', 5, '', '2025-01-08 09:52:02', '2025-02-14 18:30:00', 'Active'),
(266, 2, 'Product Designer', 'Work on designing new products and improving existing products based on user feedback and market needs.', '45000-65000', 'Los Angeles, CA', 'DesignWorks', 'https://www.designworks.com', 'Contract', 'Design', 4, 'PhD', '2025-01-08 09:52:02', '2025-03-31 18:30:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `recruiters`
--

CREATE TABLE `recruiters` (
  `recruiter_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recruiters`
--

INSERT INTO `recruiters` (`recruiter_id`, `company_name`, `email`, `password`, `created_at`) VALUES
(1, 'abc', 'sasi12345@gmail.com', '12343', '2025-01-02 06:36:10'),
(2, 'ABD TECH', 'sasi123435@gmail.com', 'abcd1234', '2025-01-03 04:45:07'),
(3, 'ABD TECH', 'sasi1234315@gmail.com', 'abcd1234', '2025-01-03 04:47:48'),
(4, 'ABC Tech', 'sasi1234@gmail.com', '1234', '2025-01-06 10:18:42'),
(5, 'Prolem', 'sasi123456@gmail.com', '12343', '2025-01-07 05:06:08'),
(6, 'Prolem', 'sasi123457@gmail.com', '12343', '2025-01-07 05:11:31'),
(7, 'Prolem', 'sasi1234.5@gmail.com', '12343', '2025-01-07 05:13:15'),
(8, 'abc', 'sasi1345@gmail.com', '12343', '2025-01-07 13:32:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobseekers`
--
ALTER TABLE `jobseekers`
  ADD PRIMARY KEY (`jobseeker_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `jobseeker_id` (`jobseeker_id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `recruiter_id` (`recruiter_id`);

--
-- Indexes for table `job_posts`
--
ALTER TABLE `job_posts`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `fk_recruiter_id` (`recruiter_id`);

--
-- Indexes for table `recruiters`
--
ALTER TABLE `recruiters`
  ADD PRIMARY KEY (`recruiter_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobseekers`
--
ALTER TABLE `jobseekers`
  MODIFY `jobseeker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `job_posts`
--
ALTER TABLE `job_posts`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;
--
-- AUTO_INCREMENT for table `recruiters`
--
ALTER TABLE `recruiters`
  MODIFY `recruiter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_ibfk_1` FOREIGN KEY (`jobseeker_id`) REFERENCES `jobseekers` (`jobseeker_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_applications_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `job_posts` (`job_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_applications_ibfk_3` FOREIGN KEY (`recruiter_id`) REFERENCES `recruiters` (`recruiter_id`) ON DELETE CASCADE;

--
-- Constraints for table `job_posts`
--
ALTER TABLE `job_posts`
  ADD CONSTRAINT `fk_recruiter_id` FOREIGN KEY (`recruiter_id`) REFERENCES `recruiters` (`recruiter_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
