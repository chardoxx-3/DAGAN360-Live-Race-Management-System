-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2026 at 02:29 AM
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
-- Database: `dagan360`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkpoints`
--

CREATE TABLE `checkpoints` (
  `id` int(11) NOT NULL,
  `location_name` varchar(100) NOT NULL,
  `sequence_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkpoints`
--

INSERT INTO `checkpoints` (`id`, `location_name`, `sequence_order`) VALUES
(1, 'Starting Line', 1),
(2, 'North Bridge', 2),
(3, 'City Park', 3),
(4, 'Finish Line', 4);

-- --------------------------------------------------------

--
-- Table structure for table `race_logs`
--

CREATE TABLE `race_logs` (
  `id` int(11) NOT NULL,
  `runner_id` int(11) NOT NULL,
  `watcher_id` int(11) DEFAULT NULL,
  `checkpoint_id` int(11) NOT NULL,
  `recorded_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `race_logs`
--

INSERT INTO `race_logs` (`id`, `runner_id`, `watcher_id`, `checkpoint_id`, `recorded_at`) VALUES
(135, 1, 12, 1, '2026-03-23 15:31:10'),
(136, 3, 12, 1, '2026-03-23 15:31:15'),
(137, 4, 12, 1, '2026-03-23 15:31:24'),
(138, 5, 12, 1, '2026-03-23 15:31:27'),
(139, 6, 12, 1, '2026-03-23 15:31:40');

-- --------------------------------------------------------

--
-- Table structure for table `runners`
--

CREATE TABLE `runners` (
  `id` int(11) NOT NULL,
  `bib_number` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `runners`
--

INSERT INTO `runners` (`id`, `bib_number`, `name`, `created_at`, `updated_at`) VALUES
(1, '001', 'richard miculob', '2026-03-18 22:35:27', '2026-03-18 22:35:27'),
(3, '002', 'c j', '2026-03-19 01:44:10', '2026-03-19 01:44:10'),
(4, '003', 'godwin', '2026-03-19 01:44:26', '2026-03-19 01:44:26'),
(5, '004', 'wer', '2026-03-19 01:44:46', '2026-03-19 01:44:46'),
(6, '005', 'rwagr', '2026-03-20 04:35:57', '2026-03-20 04:35:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','watcher') NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `checkpoint_name` varchar(255) DEFAULT NULL,
  `checkpoint_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `first_name`, `middle_name`, `last_name`, `phone_number`, `address`, `latitude`, `longitude`, `profile_image`, `checkpoint_name`, `checkpoint_id`, `created_at`, `updated_at`, `last_login`) VALUES
(7, 'admin', 'miculobrichardvictor@gmail.com', '$2y$10$ZUee9uOTmmlPXrOyZAATguNmZTkvP7AuHx3vMIpQnfiTyB3f3Pd06', 'admin', 'Richard Victor', 'M.', 'Miculob', '09273532291', NULL, NULL, NULL, '1773909155_f9d13adcb02ba17ff3df.jpg', NULL, NULL, '2026-03-19 06:21:23', '2026-08-09 00:18:40', '2026-08-09 08:18:40'),
(12, 'chardoxx', 'richlob8@gmail.com', '$2y$10$Pisj.beJOYtdsxm6VpRQFudjHOGO8CXiAYLwOuYBLV9aCHsiFsXxa', 'watcher', 'Richard', 'Victor', 'Miculob', '09273532291', 'Catibac, Catarman, Camiguin, Northern Mindanao, 9104, Philippines', 9.18365731, 124.64496580, '1774148102_12d7a6b9536bc469a004.jpg', 'Checkpoint 1', 1, '2026-03-22 02:55:02', '2026-08-09 00:19:02', '2026-08-09 08:19:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkpoints`
--
ALTER TABLE `checkpoints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `race_logs`
--
ALTER TABLE `race_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `runner_id` (`runner_id`),
  ADD KEY `checkpoint_id` (`checkpoint_id`),
  ADD KEY `watcher_id` (`watcher_id`);

--
-- Indexes for table `runners`
--
ALTER TABLE `runners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bib_number` (`bib_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `checkpoint_id` (`checkpoint_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkpoints`
--
ALTER TABLE `checkpoints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `race_logs`
--
ALTER TABLE `race_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `runners`
--
ALTER TABLE `runners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `race_logs`
--
ALTER TABLE `race_logs`
  ADD CONSTRAINT `race_logs_ibfk_1` FOREIGN KEY (`runner_id`) REFERENCES `runners` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `race_logs_ibfk_2` FOREIGN KEY (`checkpoint_id`) REFERENCES `checkpoints` (`id`),
  ADD CONSTRAINT `race_logs_ibfk_3` FOREIGN KEY (`watcher_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`checkpoint_id`) REFERENCES `checkpoints` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
