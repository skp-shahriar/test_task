-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql103.infinityfree.com
-- Generation Time: Feb 04, 2025 at 02:32 PM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_38236614_event_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE `attendees` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `registration_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`id`, `event_id`, `user_id`, `registration_date`) VALUES
(25, 15, 5, '2025-02-04 18:18:48'),
(26, 15, 6, '2025-02-04 18:18:48'),
(27, 15, 7, '2025-02-04 18:18:48'),
(28, 15, 8, '2025-02-04 18:18:48'),
(29, 15, 9, '2025-02-04 18:18:48'),
(30, 15, 10, '2025-02-04 18:18:48'),
(31, 15, 11, '2025-02-04 18:18:48'),
(32, 15, 12, '2025-02-04 18:18:48'),
(33, 15, 13, '2025-02-04 18:18:48'),
(34, 15, 14, '2025-02-04 18:18:48'),
(35, 21, 5, '2025-02-04 18:18:48'),
(36, 21, 6, '2025-02-04 18:18:48'),
(37, 21, 7, '2025-02-04 18:18:48'),
(38, 21, 8, '2025-02-04 18:18:48'),
(39, 21, 9, '2025-02-04 18:18:48'),
(40, 21, 10, '2025-02-04 18:18:48'),
(41, 21, 11, '2025-02-04 18:18:48'),
(42, 21, 12, '2025-02-04 18:18:48'),
(43, 21, 13, '2025-02-04 18:18:48'),
(44, 21, 14, '2025-02-04 18:18:48'),
(45, 16, 5, '2025-02-04 18:18:48'),
(46, 16, 6, '2025-02-04 18:18:48'),
(47, 16, 7, '2025-02-04 18:18:48'),
(48, 17, 8, '2025-02-04 18:18:48'),
(49, 17, 9, '2025-02-04 18:18:48'),
(50, 18, 10, '2025-02-04 18:18:48'),
(51, 18, 11, '2025-02-04 18:18:48'),
(52, 18, 12, '2025-02-04 18:18:48'),
(53, 19, 13, '2025-02-04 18:18:48'),
(54, 19, 14, '2025-02-04 18:18:48'),
(55, 20, 5, '2025-02-04 18:18:48'),
(56, 20, 6, '2025-02-04 18:18:48'),
(57, 20, 7, '2025-02-04 18:18:48'),
(58, 20, 8, '2025-02-04 18:18:48'),
(59, 22, 9, '2025-02-04 18:18:48'),
(60, 22, 10, '2025-02-04 18:18:48'),
(61, 22, 11, '2025-02-04 18:18:48'),
(62, 23, 12, '2025-02-04 18:18:48'),
(63, 23, 13, '2025-02-04 18:18:48'),
(64, 23, 14, '2025-02-04 18:18:48'),
(65, 24, 5, '2025-02-04 18:18:48'),
(66, 24, 6, '2025-02-04 18:18:48');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `date` datetime NOT NULL,
  `location` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `date`, `location`, `capacity`, `created_by`, `created_at`) VALUES
(15, 'Tech Conference 2023', 'Annual technology summit', '2023-11-15 09:00:00', 'Convention Center, New York', 10, 1, '2025-02-04 18:18:29'),
(16, 'Startup Pitch Night', 'Early-stage startups pitch to investors', '2023-12-01 18:30:00', 'Innovation Hub, San Francisco', 5, 1, '2025-02-04 18:18:29'),
(17, 'Music Festival', 'Multi-genre live music festival', '2024-07-20 16:00:00', 'Central Park, NYC', 5, 1, '2025-02-04 18:18:29'),
(18, 'AI Workshop', 'Hands-on AI development workshop', '2023-10-10 10:00:00', 'Online', 2, 1, '2025-02-04 18:18:29'),
(19, 'Charity Marathon', '5K run for cancer research', '2024-05-05 07:00:00', 'City Stadium, Boston', 3, 1, '2025-02-04 18:18:29'),
(20, 'Book Launch', 'Launch of bestselling author\'s new book', '2023-09-25 19:00:00', 'Central Library, Chicago', 3, 1, '2025-02-04 18:18:29'),
(21, 'Cooking Masterclass', 'Learn from Michelin-star chefs', '2023-11-30 17:00:00', 'Culinary Institute, Paris', 2, 1, '2025-02-04 18:18:29'),
(22, 'Hackathon', '48-hour coding competition', '2024-01-20 12:00:00', 'Tech Campus, Berlin', 15, 1, '2025-02-04 18:18:29'),
(23, 'Art Exhibition', 'Modern art showcase', '2023-12-15 10:00:00', 'Gallery Museum, London', 12, 1, '2025-02-04 18:18:29'),
(24, 'Film Premiere', 'Exclusive movie premiere night', '2024-02-14 20:00:00', 'Royal Theater, Los Angeles', 2, 1, '2025-02-04 18:18:29'),
(26, 'Yoga Retreat', 'Weekend wellness retreat', '2024-03-10 08:00:00', 'Mountain Resort, Switzerland', 3, 1, '2025-02-04 18:18:29'),
(27, 'Science Fair', 'Interactive science exhibits', '2023-11-10 09:00:00', 'Science Museum, Tokyo', 9, 1, '2025-02-04 18:18:29'),
(28, 'Fashion Show', 'Spring/Summer collection launch', '2024-04-12 19:30:00', 'Fashion Arena, Milan', 2, 1, '2025-02-04 18:18:29'),
(29, 'Gaming Tournament', 'Esports championship finals', '2024-06-20 14:00:00', 'Esports Arena, Seoul', 4, 1, '2025-02-04 18:18:29'),
(30, 'Wine Tasting', 'Premium wine tasting event', '2023-12-10 18:00:00', 'Vineyard Estate, Napa Valley', 4, 1, '2025-02-04 18:18:29'),
(31, 'Photography Workshop', 'Advanced photography techniques', '2024-02-25 10:00:00', 'Art Studio, Sydney', 25, 1, '2025-02-04 18:18:29'),
(32, 'Cybersecurity Summit', 'Global cybersecurity conference', '2024-08-15 09:00:00', 'Conference Hall, Singapore', 18, 1, '2025-02-04 18:18:29'),
(33, 'Comedy Night', 'Stand-up comedy showcase', '2023-11-20 20:00:00', 'Comedy Club, Austin', 6, 1, '2025-02-04 18:18:29'),
(34, 'Robotics Expo', 'Latest innovations in robotics', '2024-09-05 10:00:00', 'Expo Center, Tokyo', 22, 1, '2025-02-04 18:18:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `role`, `created_at`) VALUES
(1, 'john_doe', 'john@example.com', '$2a$12$b4wO8zx1JdeQAJqVvVwAcuVM/3l7e1iuDye.1ys/0/d3ecKPWlZqy', 'user', '2025-02-04 18:17:46'),
(6, 'jane_smith', 'jane@example.com', '$2a$12$b4wO8zx1JdeQAJqVvVwAcuVM/3l7e1iuDye.1ys/0/d3ecKPWlZqy', 'user', '2025-02-04 18:17:46'),
(7, 'mike_jones', 'mike@example.com', '$2a$12$b4wO8zx1JdeQAJqVvVwAcuVM/3l7e1iuDye.1ys/0/d3ecKPWlZqy', 'user', '2025-02-04 18:17:46'),
(8, 'sarah_wilson', 'sarah@example.com', '$2a$12$b4wO8zx1JdeQAJqVvVwAcuVM/3l7e1iuDye.1ys/0/d3ecKPWlZqy', 'user', '2025-02-04 18:17:46'),
(9, 'alex_green', 'alex@example.com', '$2a$12$b4wO8zx1JdeQAJqVvVwAcuVM/3l7e1iuDye.1ys/0/d3ecKPWlZqy', 'user', '2025-02-04 18:17:46'),
(10, 'emma_brown', 'emma@example.com', '$2a$12$b4wO8zx1JdeQAJqVvVwAcuVM/3l7e1iuDye.1ys/0/d3ecKPWlZqy', 'user', '2025-02-04 18:17:46'),
(11, 'david_clark', 'david@example.com', '$2a$12$b4wO8zx1JdeQAJqVvVwAcuVM/3l7e1iuDye.1ys/0/d3ecKPWlZqy', 'user', '2025-02-04 18:17:46'),
(12, 'lisa_taylor', 'lisa@example.com', '$2a$12$b4wO8zx1JdeQAJqVvVwAcuVM/3l7e1iuDye.1ys/0/d3ecKPWlZqy', 'user', '2025-02-04 18:17:46'),
(13, 'ryan_lee', 'ryan@example.com', '$2a$12$b4wO8zx1JdeQAJqVvVwAcuVM/3l7e1iuDye.1ys/0/d3ecKPWlZqy', 'user', '2025-02-04 18:17:46'),
(14, 'olivia_white', 'olivia@example.com', '$2a$12$b4wO8zx1JdeQAJqVvVwAcuVM/3l7e1iuDye.1ys/0/d3ecKPWlZqy', 'user', '2025-02-04 18:17:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_registration` (`event_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `idx_date` (`date`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendees`
--
ALTER TABLE `attendees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
