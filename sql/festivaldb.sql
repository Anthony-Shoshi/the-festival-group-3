-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Feb 21, 2024 at 11:58 PM
-- Server version: 11.1.2-MariaDB-1:11.1.2+maria~ubu2204
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `festivaldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `album_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `album_name` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `artist_id` int(11) NOT NULL,
  `artist_name` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `artist_musics`
--

CREATE TABLE `artist_musics` (
  `artist_music_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `music_title` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `music_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `award_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dance_venues`
--

CREATE TABLE `dance_venues` (
  `venue_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_type` enum('Yummy','Dance','History') NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `feature_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_event`
--

CREATE TABLE `history_event` (
  `history_event_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_event_date`
--

CREATE TABLE `history_event_date` (
  `event_date_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_ticket`
--

CREATE TABLE `history_ticket` (
  `history_ticket_id` int(11) NOT NULL,
  `history_event_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `ticket_type` enum('Regular','Family') NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `event_date_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `tour_location_id` int(11) NOT NULL,
  `timetable_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `music_events`
--

CREATE TABLE `music_events` (
  `music_event_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `event_start_time` time NOT NULL,
  `event_duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `music_event_tickets`
--

CREATE TABLE `music_event_tickets` (
  `music_ticket_id` int(11) DEFAULT NULL,
  `ticket_id` int(11) NOT NULL,
  `music_event_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `session_type` enum('Club','Back to Back') NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `payment_method` enum('Credit Card','Debit Card','Ideal','PayPal') NOT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `payment_date` date NOT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `page_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `price_list`
--

CREATE TABLE `price_list` (
  `list_id` int(11) NOT NULL,
  `ticket_type` enum('Regular','Family','Daily Pass','All Access Pass') NOT NULL,
  `price` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `restaurant_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `ratings` tinyint(4) NOT NULL,
  `cuisines` varchar(255) NOT NULL,
  `session_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `location` varchar(500) NOT NULL,
  `number_of_seats` int(11) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_features`
--

CREATE TABLE `restaurant_features` (
  `restaurant_features_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `section_id` int(11) NOT NULL,
  `section_title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `page_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` int(11) NOT NULL,
  `total_session` int(11) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `first_session` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tour_language`
--

CREATE TABLE `tour_language` (
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tour_location`
--

CREATE TABLE `tour_location` (
  `tour_location_id` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `address` text NOT NULL,
  `contact_info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tour_timetable`
--

CREATE TABLE `tour_timetable` (
  `timetable_id` int(11) NOT NULL,
  `event_date_id` int(11) NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(250) DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('Visitor','Customer','Admin','Employee') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `profile_picture`, `registration_date`, `role`) VALUES
(1, 'Muhammad Faizan', 'faizan@gmail.com', 'faizan123', NULL, '2024-02-19 15:51:52', 'Admin'),
(2, 'Dawood Ikram', 'dawoodikram@gmail.com', 'dawood123', NULL, '2024-02-19 15:51:52', 'Admin'),
(3, 'Anthony Gomes', 'anthonygomes@gmail.com', 'anthony123', NULL, '2024-02-19 15:51:52', 'Admin'),
(4, 'Andrii Kernitskyii ', 'andrii@chucknoris.com', 'andrii123', NULL, '2024-02-19 15:51:52', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`album_id`),
  ADD KEY `artist_to_album` (`artist_id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`artist_id`);

--
-- Indexes for table `artist_musics`
--
ALTER TABLE `artist_musics`
  ADD PRIMARY KEY (`artist_music_id`),
  ADD KEY `artist_to_music` (`artist_id`);

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`award_id`),
  ADD KEY `artist_to_awards` (`artist_id`);

--
-- Indexes for table `dance_venues`
--
ALTER TABLE `dance_venues`
  ADD PRIMARY KEY (`venue_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`feature_id`);

--
-- Indexes for table `history_event`
--
ALTER TABLE `history_event`
  ADD PRIMARY KEY (`history_event_id`),
  ADD KEY `history_to_events` (`event_id`);

--
-- Indexes for table `history_event_date`
--
ALTER TABLE `history_event_date`
  ADD PRIMARY KEY (`event_date_id`);

--
-- Indexes for table `history_ticket`
--
ALTER TABLE `history_ticket`
  ADD PRIMARY KEY (`history_ticket_id`),
  ADD KEY `history_to_tickets` (`ticket_id`),
  ADD KEY `history_to_language` (`language_id`),
  ADD KEY `tour_to_date` (`event_date_id`),
  ADD KEY `tour_to_time` (`timetable_id`),
  ADD KEY `tour_to_location` (`tour_location_id`),
  ADD KEY `history_ticket_to_history_event` (`history_event_id`);

--
-- Indexes for table `music_events`
--
ALTER TABLE `music_events`
  ADD PRIMARY KEY (`music_event_id`),
  ADD KEY `event_to_music_event` (`event_id`),
  ADD KEY `artist_to_music_event` (`artist_id`),
  ADD KEY `venue_to_music_event` (`venue_id`);

--
-- Indexes for table `music_event_tickets`
--
ALTER TABLE `music_event_tickets`
  ADD KEY `ticket_to_music_event` (`music_event_id`),
  ADD KEY `music_ticket_to_ticket` (`ticket_id`),
  ADD KEY `ticket_to_venue` (`venue_id`),
  ADD KEY `ticket_to_music_artists` (`artist_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_to_orders` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_to_items` (`order_id`),
  ADD KEY `event_to_items` (`event_id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`page_id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `price_list`
--
ALTER TABLE `price_list`
  ADD PRIMARY KEY (`list_id`),
  ADD KEY `events_id` (`event_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `user_to_reservation` (`user_id`),
  ADD KEY `session_to_reservation` (`session_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`restaurant_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `restaurant_features`
--
ALTER TABLE `restaurant_features`
  ADD PRIMARY KEY (`restaurant_features_id`),
  ADD KEY `restaurant_to_restaurant_features` (`restaurant_id`),
  ADD KEY `feature_to_restaurant_feature` (`feature_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `page_id` (`page_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `ticket_to_event` (`event_id`);

--
-- Indexes for table `tour_language`
--
ALTER TABLE `tour_language`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `tour_location`
--
ALTER TABLE `tour_location`
  ADD PRIMARY KEY (`tour_location_id`);

--
-- Indexes for table `tour_timetable`
--
ALTER TABLE `tour_timetable`
  ADD PRIMARY KEY (`timetable_id`),
  ADD KEY `timetable_to_event` (`event_date_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `artist_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `artist_musics`
--
ALTER TABLE `artist_musics`
  MODIFY `artist_music_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `award_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dance_venues`
--
ALTER TABLE `dance_venues`
  MODIFY `venue_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `feature_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_event_date`
--
ALTER TABLE `history_event_date`
  MODIFY `event_date_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_ticket`
--
ALTER TABLE `history_ticket`
  MODIFY `history_ticket_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `music_events`
--
ALTER TABLE `music_events`
  MODIFY `music_event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `price_list`
--
ALTER TABLE `price_list`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `restaurant_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurant_features`
--
ALTER TABLE `restaurant_features`
  MODIFY `restaurant_features_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tour_location`
--
ALTER TABLE `tour_location`
  MODIFY `tour_location_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tour_timetable`
--
ALTER TABLE `tour_timetable`
  MODIFY `timetable_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `artist_to_album` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `artist_musics`
--
ALTER TABLE `artist_musics`
  ADD CONSTRAINT `artist_to_music` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `awards`
--
ALTER TABLE `awards`
  ADD CONSTRAINT `artist_to_awards` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `history_event`
--
ALTER TABLE `history_event`
  ADD CONSTRAINT `history_to_events` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `history_ticket`
--
ALTER TABLE `history_ticket`
  ADD CONSTRAINT `history_ticket_to_history_event` FOREIGN KEY (`history_event_id`) REFERENCES `history_event` (`history_event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history_to_language` FOREIGN KEY (`language_id`) REFERENCES `tour_language` (`language_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history_to_tickets` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tour_to_date` FOREIGN KEY (`event_date_id`) REFERENCES `history_event_date` (`event_date_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tour_to_location` FOREIGN KEY (`tour_location_id`) REFERENCES `tour_location` (`tour_location_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tour_to_time` FOREIGN KEY (`timetable_id`) REFERENCES `tour_timetable` (`timetable_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `music_events`
--
ALTER TABLE `music_events`
  ADD CONSTRAINT `artist_to_music_event` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `event_to_music_event` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venue_to_music_event` FOREIGN KEY (`venue_id`) REFERENCES `dance_venues` (`venue_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `music_event_tickets`
--
ALTER TABLE `music_event_tickets`
  ADD CONSTRAINT `music_ticket_to_ticket` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_to_music_artists` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_to_music_event` FOREIGN KEY (`music_event_id`) REFERENCES `music_events` (`music_event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_to_venue` FOREIGN KEY (`venue_id`) REFERENCES `dance_venues` (`venue_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `user_to_orders` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `event_to_items` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_to_items` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `price_list`
--
ALTER TABLE `price_list`
  ADD CONSTRAINT `events_id` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `session_to_reservation` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`session_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_to_reservation` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD CONSTRAINT `event_id` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `restaurant_features`
--
ALTER TABLE `restaurant_features`
  ADD CONSTRAINT `feature_to_restaurant_feature` FOREIGN KEY (`feature_id`) REFERENCES `features` (`feature_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `restaurant_to_restaurant_features` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`restaurant_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `page_id` FOREIGN KEY (`page_id`) REFERENCES `page` (`page_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `ticket_to_event` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tour_timetable`
--
ALTER TABLE `tour_timetable`
  ADD CONSTRAINT `timetable_to_event` FOREIGN KEY (`event_date_id`) REFERENCES `history_event_date` (`event_date_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
