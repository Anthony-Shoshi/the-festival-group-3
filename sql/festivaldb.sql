-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jun 19, 2024 at 09:12 PM
-- Server version: 11.2.3-MariaDB-1:11.2.3+maria~ubu2204
-- PHP Version: 8.2.8

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
  `color` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_type`, `title`, `image_url`, `color`, `description`, `status`, `start_date`, `end_date`) VALUES
(3, 'Yummy', 'Yummy', 'test', '#f0f0f0', 'test', 1, '2024-07-23', '2024-07-30');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `feature_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`feature_id`, `image_url`, `name`) VALUES
(1, '/images/65f42bddddf8f7.02145869_vegan.png', 'Vegetarian dishes'),
(4, '/images/65f436c0d345e2.33313714_halal.png', 'Halal food'),
(5, '/images/65f43722e644a9.99057432_disabled-person.png', 'Accessibility features'),
(6, '/images/65f4374a1ad452.61250543_gluten-free.png', 'Gluten-free'),
(7, '/images/65f4379bd1ca23.12300065_pets-allowed.png', 'Pet allow');

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
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `title`, `active`, `slug`) VALUES
(1, 'Home', 1, 'home'),
(2, 'History', 1, 'history'),
(3, 'Yummy', 1, 'yummy');

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
  `name` varchar(255) NOT NULL,
  `reservation_date` date NOT NULL,
  `total_adult` int(11) NOT NULL,
  `total_children` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `remarks` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_cost` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','completed','failed') DEFAULT 'pending',
  `confirmation_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `name`, `reservation_date`, `total_adult`, `total_children`, `email`, `phone`, `user_id`, `session_id`, `restaurant_id`, `remarks`, `is_active`, `created_at`, `updated_at`, `total_cost`, `payment_status`, `confirmation_code`) VALUES
(1, 'Anthony Shoshi Gomes', '2024-06-28', 4, 2, 'gomesanthonyshoshi@gmail.com', '0685379763', NULL, 2, 10, '', 1, '2024-06-14 14:43:53', '2024-06-15 03:04:44', 60.00, 'pending', 'CONF-666C57298ADC4'),
(2, 'New', '2024-01-02', 2, 4, 'test@gnaul.cim', '435436', NULL, 2, 10, '', 1, '2024-06-15 02:56:10', '2024-06-15 03:04:49', 60.00, 'pending', 'CONF-666D02CAA5BA7');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `restaurant_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `ratings` float NOT NULL,
  `cuisines` varchar(255) NOT NULL,
  `event_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `number_of_seats` int(11) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_phone` varchar(255) NOT NULL,
  `gallery_images` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`restaurant_id`, `title`, `image_url`, `description`, `ratings`, `cuisines`, `event_id`, `location`, `number_of_seats`, `contact_email`, `contact_phone`, `gallery_images`) VALUES
(10, 'Test', '/images/666c3157695f63.28696757_marguerite-729510_640.jpg', '&lt;p&gt;&lt;b&gt;&lt;span style=&quot;font-size: 20px;&quot;&gt;Heading&lt;/span&gt;&lt;/b&gt;&lt;/p&gt;&lt;p&gt;Are you coming to the culinary event in Haarlem? It will take place from July 27 to July 31, 2024 on the Grote Markt in Haarlem. Make sure you&#039;re there! Enjoy various tastings and bands. Gather your company.&lt;/p&gt;', 4.5, 'French, Dutch', 3, 'Haarlem', 4, 'gomes@gmail.com', '35345345', '[\"\\/images\\/666c31576e6519.56904392_disabled-person.png\",\"\\/images\\/666c315773bc30.73477266_gluten-free.png\",\"\\/images\\/666c3157784440.45473320_halal.png\"]');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_features`
--

CREATE TABLE `restaurant_features` (
  `restaurant_features_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant_features`
--

INSERT INTO `restaurant_features` (`restaurant_features_id`, `restaurant_id`, `feature_id`) VALUES
(45, 10, 1),
(46, 10, 5),
(47, 10, 6);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `section_id` int(11) NOT NULL,
  `section_title` varchar(255) DEFAULT NULL,
  `section_sub_title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `map_url` varchar(255) DEFAULT NULL,
  `section_type` varchar(255) NOT NULL,
  `page_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `section_title`, `section_sub_title`, `content`, `image_url`, `map_url`, `section_type`, `page_id`) VALUES
(1, 'HAARLEM FESTIVAL', '', '', '/images/65fc58f246e739.00975647_image9.png', '', 'header', 1),
(3, 'Yummy', 'July 27 - July 31', '', '', '', 'header', 2),
(6, 'The largest Haarlem summer events of 2024 at a glance!', 'New', 'HAARLEM - The moment that many are eagerly awaiting: spring and summer are starting again and so event organizations can also go wild again. Which major events can you expect in Haarlem in 2024? Here you will find an overview!', '/images/65fc59f345f026.18717116_section-2.png', '', 'tour_information', 1),
(9, 'Event Location', '', '<p><br></p>', '/images/65fc59f34961e1.85949711_map.png', '', 'location', 1),
(10, 'Yummy!', '27 July - 31 July', '<h2><b><span style=\"font-family: \" arial=\"\" black\";\"=\"\">Food Festival<br></span><span style=\"font-family: \" arial=\"\" black\";\"=\"\">Haarlem<br></span><span style=\"font-family: \" arial=\"\" black\";\"=\"\">Culinary 2024</span></b></h2><div><h5><span style=\"font-family: Arial; font-size: 26px;\"><font color=\"#efefef\" style=\"\">Are you coming to the culinary event in Haarlem? It will take place from July 27 to July 31, 2024 on the Grote Markt in Haarlem. Make sure you\'re there! Enjoy various tastings and bands. Gather your company.</font></span></h5><h5><br></h5></div>', '/images/66046411404a68.46658857_yummy-intro (1).png', '', 'header', 3);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `duration` decimal(4,2) NOT NULL,
  `sessions_per_day` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `restaurant_id`, `start_time`, `duration`, `sessions_per_day`) VALUES
(2, 10, '14:00:00', 1.50, 3);

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(250) DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('Visitor','Customer','Admin','Employee') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `profile_picture`, `registration_date`, `role`) VALUES
(2, 'Dawood Ikram Mian', 'dawoodikram@gmail.com', 'dawood123', '/images/default.jpg', '2024-02-19 15:51:52', 'Admin'),
(3, 'Anthony Gomes', 'anthony@gmail.com', '$2y$10$vgq8bp3qaHnggs.tTzGi8ujiUxX4SsMgPM.mXpW9uNFC1HBnL7Rce', '/images/default.jpg', '2024-02-19 15:51:52', 'Admin'),
(4, 'Andrii Kernitskyii ', 'andrii@chucknoris.com', 'andrii123', '/images/default.jpg', '2024-02-19 15:51:52', 'Admin'),
(5, 'Anthony Gomes', 'admin@demo.com', '$2y$10$vgq8bp3qaHnggs.tTzGi8ujiUxX4SsMgPM.mXpW9uNFC1HBnL7Rce', '/images/default.jpg', '2024-02-19 15:51:52', 'Admin'),
(6, 'Test', 'test@demo.com', '$2y$10$Gv4LQ4pa.72a7C8saKnum.ICIposE.uDejYH6yu.i4Xipbn3nDarG', '/images/666cdadf546ad9.69415859_disabled-person.png', '2024-02-25 03:26:27', 'Customer'),
(7, 'Anthony Shoshi Gomes', 'anthony@demo.com', '$2y$10$1tFgPUT9GH3R9TpZgSqzIu9IzJaz98y8APMMBXTFMTYKLo.BEziq.', '/images/default.jpg', '2024-02-27 13:06:05', 'Admin'),
(8, 'John', 'john@demo.com', '$2y$10$us7n/RbrHZhTWk5zWaH5LeqcfTNwdu6yf.rP5FkUdLHXSn02tUHvW', '/images/666cdb13c21482.61116294_gluten-free.png', '2024-06-15 00:06:43', 'Employee');

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
-- Indexes for table `pages`
--
ALTER TABLE `pages`
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
  ADD KEY `reservations_ibfk_1` (`user_id`),
  ADD KEY `reservations_ibfk_2` (`session_id`),
  ADD KEY `reservations_ibfk_3` (`restaurant_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`restaurant_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `restaurant_features`
--
ALTER TABLE `restaurant_features`
  ADD PRIMARY KEY (`restaurant_features_id`),
  ADD KEY `restaurant_to_restaurant_features` (`restaurant_id`),
  ADD KEY `feature_to_restaurant_feature` (`feature_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `page_id` (`page_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `sessions_ibfk_1` (`restaurant_id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
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
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `feature_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `price_list`
--
ALTER TABLE `price_list`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `restaurant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `restaurant_features`
--
ALTER TABLE `restaurant_features`
  MODIFY `restaurant_features_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  ADD CONSTRAINT `user_to_orders` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`session_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_3` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`restaurant_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `page_id` FOREIGN KEY (`page_id`) REFERENCES `pages` (`page_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`restaurant_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
