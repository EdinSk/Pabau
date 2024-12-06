-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 06:46 PM
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
-- Database: `voting_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(8, 'Collaboration Expert'),
(3, 'Culture Champion'),
(7, 'Customer Hero'),
(4, 'Difference Maker'),
(6, 'Innovation Star'),
(5, 'Leadership Excellence'),
(1, 'Makes Work Fun'),
(2, 'Team Player');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`) VALUES
(1, 'John Doe', 'john.doe@company.com'),
(2, 'Jane Smith', 'jane.smith@company.com'),
(3, 'Alice Johnson', 'alice.johnson@company.com'),
(4, 'Bob Brown', 'bob.brown@company.com'),
(5, 'Charlie Davis', 'charlie.davis@company.com'),
(6, 'David Lee', 'david.lee@company.com'),
(7, 'Eve White', 'eve.white@company.com'),
(8, 'Frank Harris', 'frank.harris@company.com'),
(9, 'Grace Turner', 'grace.turner@company.com'),
(10, 'Henry King', 'henry.king@company.com');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `voter_id` int(11) NOT NULL,
  `nominee_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `voter_id`, `nominee_id`, `category_id`, `comment`, `timestamp`) VALUES
(489, 3, 6, 1, 'Fire brother agent else onto none.', '2024-10-30 21:49:49'),
(491, 5, 2, 3, 'Worry important food notice green door front all.', '2024-03-08 14:37:16'),
(492, 6, 7, 5, 'Possible let wall among material.', '2024-09-28 18:57:21'),
(493, 7, 8, 2, 'Message create meet goal positive effort point.', '2024-02-04 10:18:16'),
(494, 8, 9, 1, 'Family expect attention blue suggest.', '2024-03-15 14:42:00'),
(495, 9, 7, 4, 'Develop security sport impact.', '2024-04-01 12:11:35'),
(496, 10, 6, 3, 'Black high world achieve.', '2024-04-10 17:23:22'),
(497, 3, 5, 2, 'Future effort industry create activity.', '2024-05-12 06:39:44'),
(498, 4, 3, 5, 'Sport country require gain factor future.', '2024-07-08 03:10:56'),
(499, 5, 6, 1, 'Light enjoy nothing ahead until step.', '2024-08-01 18:49:22'),
(500, 6, 1, 2, 'Difficult near school interest value.', '2024-09-12 15:06:28'),
(501, 7, 5, 4, 'Player require set position group.', '2024-10-22 12:29:10'),
(502, 8, 10, 3, 'Catch inside discover alone father summer.', '2024-11-11 16:47:44'),
(503, 9, 6, 1, 'Red remain avoid truth.', '2024-12-02 05:28:30'),
(504, 10, 3, 5, 'Age common government action study.', '2024-12-14 09:56:11'),
(505, 3, 7, 4, 'Force trial major game contest party.', '2024-12-15 13:44:03'),
(506, 4, 8, 1, 'Investment affect major effort view plan.', '2024-12-16 07:26:48'),
(507, 5, 9, 3, 'Amount government discuss train.', '2024-12-18 09:00:04'),
(508, 6, 10, 5, 'Recent policy home open school.', '2024-12-19 16:14:39'),
(509, 7, 4, 3, 'Significant effort answer plan risk.', '2024-12-21 11:55:03'),
(510, 8, 5, 2, 'Media trial wonder mother new plan.', '2024-12-23 08:33:10'),
(511, 9, 3, 1, 'Train cost high growth step early.', '2024-12-25 02:18:26'),
(512, 10, 6, 4, 'Land meet car event size outside.', '2024-12-26 13:09:39'),
(513, 3, 8, 3, 'Factor local process interest away spend.', '2024-12-28 17:24:19'),
(514, 4, 7, 5, 'Community better work ahead single job.', '2024-12-29 06:01:05'),
(515, 5, 10, 2, 'Service achieve garden good field.', '2024-12-31 10:45:00'),
(516, 6, 7, 4, 'Develop attend game idea approach lead.', '2025-01-02 14:32:15'),
(517, 7, 2, 3, 'Need cover improve result deal.', '2025-01-04 18:21:29'),
(518, 8, 3, 1, 'Health check effect plan meet question.', '2025-01-06 21:16:49'),
(519, 9, 4, 2, 'Hold impact meet trial possible.', '2025-01-08 08:37:33'),
(520, 10, 5, 5, 'Structure must hold action right approach.', '2025-01-10 12:22:47'),
(521, 3, 9, 4, 'Worker cover outside day next.', '2025-01-12 07:18:58'),
(522, 4, 6, 3, 'Cold act step size build discussion.', '2025-01-14 11:52:34'),
(523, 5, 7, 5, 'Shape pay enter lead family.', '2025-01-16 16:46:11'),
(524, 6, 10, 1, 'Art detail list clear ready.', '2025-01-18 13:21:57'),
(525, 7, 9, 2, 'Problem deal society same few.', '2025-01-20 09:42:01'),
(526, 8, 9, 4, 'Hope next thing city plan.', '2025-01-22 05:08:24'),
(527, 9, 6, 2, 'Control person away great opportunity.', '2025-01-24 12:55:43'),
(528, 3, 5, 4, 'Game decision might matter.', '2025-01-26 11:45:59'),
(529, 4, 3, 2, 'Investment study important next.', '2025-01-28 14:16:42'),
(530, 5, 6, 2, 'Teacher policy show behind work.', '2025-01-30 12:24:18'),
(531, 6, 7, 8, 'Adjustable media issue remain constant.', '2025-02-01 10:35:47'),
(532, 7, 4, 2, 'Government need raise health focus.', '2025-02-03 16:43:00'),
(533, 8, 10, 1, 'Student large cost industry area.', '2025-02-05 18:39:04'),
(534, 9, 7, 3, 'Study focus necessary nature approach.', '2025-02-07 10:52:49'),
(535, 10, 3, 8, 'Write maintain best hold final.', '2025-02-09 13:18:30'),
(536, 1, 5, 3, '123', '2024-12-05 18:44:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_vote` (`voter_id`,`nominee_id`,`category_id`),
  ADD KEY `nominee_id` (`nominee_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`voter_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`nominee_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `votes_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
