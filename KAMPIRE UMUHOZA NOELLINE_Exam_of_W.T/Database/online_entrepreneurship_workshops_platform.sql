-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2024 at 03:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_entrepreneurship_workshops_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE `attendees` (
  `attendee_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `workshop_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`attendee_id`, `user_id`, `workshop_id`) VALUES
(1, 4, 1),
(2, 2, 2),
(3, 1, 1),
(4, 3, 3),
(5, 1, 2),
(6, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `attendee_payments`
--

CREATE TABLE `attendee_payments` (
  `payment_id` int(11) NOT NULL,
  `attendee_id` int(11) DEFAULT NULL,
  `amount_paid` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendee_payments`
--

INSERT INTO `attendee_payments` (`payment_id`, `attendee_id`, `amount_paid`) VALUES
(1, 4, 100.00),
(2, 2, 150.00),
(3, 3, 200.00),
(4, 4, 180.00),
(5, 1, 120.00);

-- --------------------------------------------------------

--
-- Table structure for table `entrepreneurship_resources`
--

CREATE TABLE `entrepreneurship_resources` (
  `resource_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `entrepreneurship_resources`
--

INSERT INTO `entrepreneurship_resources` (`resource_id`, `title`, `description`) VALUES
(1, 'Business Plan Template', 'A template to guide you through creating a business plan.'),
(2, 'Marketing Strategies eBook', 'An eBook containing various marketing strategies for startups.'),
(3, 'Financial Management Guide', 'A comprehensive guide to managing finances for small businesses.'),
(4, 'Networking Tips', 'Tips and techniques for effective networking in the entrepreneurial community.'),
(5, 'Startup Funding Sources', 'An overview of different sources of funding available for startups.'),
(6, 'information technology', 'helps many  people to spread in technology');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `instructor_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `full_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`instructor_id`, `user_id`, `full_name`) VALUES
(1, 1, 'John Smith'),
(2, 3, 'Emily Johnson'),
(3, 2, 'Michael Davis'),
(4, 4, 'Sarah Brown'),
(5, 2, 'David Wilson');

-- --------------------------------------------------------

--
-- Table structure for table `instructor_specializations`
--

CREATE TABLE `instructor_specializations` (
  `specialization_id` int(11) NOT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `specialization` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor_specializations`
--

INSERT INTO `instructor_specializations` (`specialization_id`, `instructor_id`, `specialization`) VALUES
(1, 1, 'Business Strategy'),
(2, 2, 'Marketing'),
(3, 3, 'Finance'),
(4, 4, 'Networking'),
(5, 5, 'Startup Funding');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `PaymentID` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `PaymentDate` date DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`PaymentID`, `user_id`, `Amount`, `PaymentDate`, `Status`) VALUES
(1, 4, 10500.00, '2024-05-10', 'Completed'),
(2, 1, 155000.00, '2024-05-11', 'Completed'),
(3, 3, 20000.00, '0000-00-00', 'pending'),
(4, 2, 35000.00, '0000-00-00', 'completed'),
(5, 1, 15000.00, '2024-05-11', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'fiona', 'muragije', 'murafiona', 'muragijefiona@gmail.com', '0783222111', '$2y$10$Cej6lPEgIXB8Qnnxc8hafOkidkrpTNGPEocQr84BWZ08b3cloBkJ6', '2024-05-14 11:19:20', '888999', 0),
(2, 'Irarora', 'Fiacre', 'FIACRE', 'irarorafiacre4@gmail.com', '0788888888', '$2y$10$IVW2e5yoMVJCLo7BzgIXSOE3pUQJZ5W/mtdem1lRAuY2FoA.WJdeO', '2024-05-14 11:45:57', '55678', 0),
(3, 'IRADUKUNDA', 'NEPO', 'nepo69', 'iradukundajeannepomuscene5@gmail.com', '0729198022', '$2y$10$jrheScriK.1yUSDPbge9i.SO5BVjcobkJF54Dzz7Pv.ovvXLsPS3C', '2024-05-14 11:47:31', 'DCD32', 0),
(4, 'haburi', 'turikumana', 'haburi55', 'turikumanahari@gmail.com', '0734567890', '$2y$10$yBVa/vejKjHdyUrWEPye3.MKR4SyEsKNjrjOf57aTUiZ1WJG2aRla', '2024-05-14 11:49:41', '55678', 0),
(5, 'noeline', 'kampire', 'umuhozaka', 'umuhozanoeline@gmail.com', '07854443213', '$2y$10$CSlcUYDjkYhjOwda3fIO/.AAI8fpHWVGLwrvm2x.84vV5PVWactqW', '2024-05-20 06:12:14', '8765', 0);

-- --------------------------------------------------------

--
-- Table structure for table `workshops`
--

CREATE TABLE `workshops` (
  `workshop_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `instructor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workshops`
--

INSERT INTO `workshops` (`workshop_id`, `title`, `description`, `instructor_id`) VALUES
(1, 'Business Planning Workshop', 'Learn how to create a solid business plan for your startup.', 1),
(2, 'Marketing Strategies Workshop', 'Explore various marketing strategies to promote your business.', 2),
(3, 'Startup Funding Workshop', 'Discover different funding sources and strategies for startups.', 3),
(4, '8TRDFGHJKLKN', 'NJHYTYRZETDJGDFKGHL KSJDTFYIHK\r\nPOIUYTRTYUKKJJHVFVBBJHVGH\r\nPOIUYTFGHN\r\n[POIUYTXDGHJ\r\nOIUGVHJKJHUY', 2);

-- --------------------------------------------------------

--
-- Table structure for table `workshop_resources`
--

CREATE TABLE `workshop_resources` (
  `workshop_resource_id` int(11) NOT NULL,
  `workshop_id` int(11) DEFAULT NULL,
  `resource_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workshop_resources`
--

INSERT INTO `workshop_resources` (`workshop_resource_id`, `workshop_id`, `resource_id`) VALUES
(1, 1, 5),
(2, 1, 3),
(3, 2, 2),
(4, 2, 1),
(5, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `workshop_schedule`
--

CREATE TABLE `workshop_schedule` (
  `schedule_id` int(11) NOT NULL,
  `workshop_id` int(11) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workshop_schedule`
--

INSERT INTO `workshop_schedule` (`schedule_id`, `workshop_id`, `date_time`) VALUES
(1, 3, '2024-05-15 10:00:00'),
(2, 2, '2024-05-17 14:00:00'),
(3, 1, '2024-05-20 09:00:00'),
(4, 4, '2024-05-24 15:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `workshop_topics`
--

CREATE TABLE `workshop_topics` (
  `topic_id` int(11) NOT NULL,
  `workshop_id` int(11) DEFAULT NULL,
  `topic_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workshop_topics`
--

INSERT INTO `workshop_topics` (`topic_id`, `workshop_id`, `topic_name`) VALUES
(1, 3, 'Introduction to Business Planning'),
(2, 1, 'Market Analysis'),
(3, 2, 'Digital Marketing Strategies'),
(4, 2, 'Networking and Branding'),
(5, 3, 'Venture Capital and Angel Investors');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`attendee_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `workshop_id` (`workshop_id`);

--
-- Indexes for table `attendee_payments`
--
ALTER TABLE `attendee_payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `attendee_id` (`attendee_id`);

--
-- Indexes for table `entrepreneurship_resources`
--
ALTER TABLE `entrepreneurship_resources`
  ADD PRIMARY KEY (`resource_id`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`instructor_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `instructor_specializations`
--
ALTER TABLE `instructor_specializations`
  ADD PRIMARY KEY (`specialization_id`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `workshops`
--
ALTER TABLE `workshops`
  ADD PRIMARY KEY (`workshop_id`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- Indexes for table `workshop_resources`
--
ALTER TABLE `workshop_resources`
  ADD PRIMARY KEY (`workshop_resource_id`),
  ADD KEY `workshop_id` (`workshop_id`),
  ADD KEY `resource_id` (`resource_id`);

--
-- Indexes for table `workshop_schedule`
--
ALTER TABLE `workshop_schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `workshop_id` (`workshop_id`);

--
-- Indexes for table `workshop_topics`
--
ALTER TABLE `workshop_topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `workshop_id` (`workshop_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendees`
--
ALTER TABLE `attendees`
  MODIFY `attendee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attendee_payments`
--
ALTER TABLE `attendee_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `entrepreneurship_resources`
--
ALTER TABLE `entrepreneurship_resources`
  MODIFY `resource_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `instructor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `instructor_specializations`
--
ALTER TABLE `instructor_specializations`
  MODIFY `specialization_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `workshops`
--
ALTER TABLE `workshops`
  MODIFY `workshop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `workshop_resources`
--
ALTER TABLE `workshop_resources`
  MODIFY `workshop_resource_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `workshop_schedule`
--
ALTER TABLE `workshop_schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `workshop_topics`
--
ALTER TABLE `workshop_topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendees`
--
ALTER TABLE `attendees`
  ADD CONSTRAINT `attendees_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `attendees_ibfk_2` FOREIGN KEY (`workshop_id`) REFERENCES `workshops` (`workshop_id`);

--
-- Constraints for table `attendee_payments`
--
ALTER TABLE `attendee_payments`
  ADD CONSTRAINT `attendee_payments_ibfk_1` FOREIGN KEY (`attendee_id`) REFERENCES `attendees` (`attendee_id`);

--
-- Constraints for table `instructors`
--
ALTER TABLE `instructors`
  ADD CONSTRAINT `instructors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `instructor_specializations`
--
ALTER TABLE `instructor_specializations`
  ADD CONSTRAINT `instructor_specializations_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`instructor_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `workshops`
--
ALTER TABLE `workshops`
  ADD CONSTRAINT `workshops_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`instructor_id`);

--
-- Constraints for table `workshop_resources`
--
ALTER TABLE `workshop_resources`
  ADD CONSTRAINT `workshop_resources_ibfk_1` FOREIGN KEY (`workshop_id`) REFERENCES `workshops` (`workshop_id`),
  ADD CONSTRAINT `workshop_resources_ibfk_2` FOREIGN KEY (`resource_id`) REFERENCES `entrepreneurship_resources` (`resource_id`);

--
-- Constraints for table `workshop_schedule`
--
ALTER TABLE `workshop_schedule`
  ADD CONSTRAINT `workshop_schedule_ibfk_1` FOREIGN KEY (`workshop_id`) REFERENCES `workshops` (`workshop_id`);

--
-- Constraints for table `workshop_topics`
--
ALTER TABLE `workshop_topics`
  ADD CONSTRAINT `workshop_topics_ibfk_1` FOREIGN KEY (`workshop_id`) REFERENCES `workshops` (`workshop_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
