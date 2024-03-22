-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2024 at 01:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crop_recommendation_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `crops`
--

CREATE TABLE `crops` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `soil_type` varchar(255) NOT NULL,
  `soil_ph_min` float NOT NULL,
  `soil_ph_max` float NOT NULL,
  `temp_min` int(11) NOT NULL,
  `temp_max` int(11) NOT NULL,
  `rainfall_min` int(11) NOT NULL,
  `rainfall_max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crops`
--

INSERT INTO `crops` (`id`, `name`, `soil_type`, `soil_ph_min`, `soil_ph_max`, `temp_min`, `temp_max`, `rainfall_min`, `rainfall_max`) VALUES
(1, 'Carrots', 'Sandy', 6, 7, 15, 25, 450, 700),
(2, 'Maize', 'Sandy', 5, 7, 18, 32, 450, 700),
(3, 'Cabbage', 'Sandy', 5.8, 6.5, 15, 25, 450, 800),
(4, 'Potatoes', 'Sandy', 5.5, 6.5, 15, 20, 50, 100),
(5, 'Peppers', 'Sandy', 6, 7.5, 21, 29, 25, 50),
(6, 'Tomatoes', 'Sandy', 5.8, 6.5, 21, 27, 50, 75),
(7, 'Wheat', 'Silty', 6, 7.5, 15, 24, 300, 500),
(8, 'Barley', 'Silty', 6, 7.5, 15, 25, 400, 600),
(9, 'Spinach', 'Silty', 6, 7, 15, 25, 500, 750),
(10, 'Lettuce', 'Silty', 6, 7, 15, 20, 500, 750),
(11, 'Rice', 'Alluvial', 5, 7, 20, 35, 1000, 2500),
(12, 'Soybeans', 'Alluvial', 6, 7, 20, 30, 500, 1000),
(13, 'Barley', 'Sandy Loam', 6, 7, 15, 25, 300, 600),
(14, 'Sorghum', 'Loamy Sand', 5.5, 7, 25, 35, 300, 700),
(15, 'Sunflower', 'Sandy Loam', 6, 7.5, 20, 30, 500, 750),
(16, 'Cotton', 'Sandy Clay Loam', 6, 7, 25, 35, 500, 1000),
(17, 'Millet', 'Sandy Loam', 5.5, 7, 25, 35, 300, 600),
(18, 'Oats', 'Loamy Sand', 5.5, 6.5, 15, 25, 400, 700),
(19, 'Rye', 'Sandy Loam', 5.5, 7, 15, 25, 300, 600),
(20, 'Cassava', 'Sandy Clay Loam', 5.5, 6.5, 25, 35, 800, 1500),
(21, 'Lentils', 'Loamy Sand', 6, 7.5, 15, 25, 300, 600),
(22, 'Peanuts', 'Sandy Loam', 5.8, 7.2, 20, 32, 500, 800),
(23, 'Chickpeas', 'Loamy Sand', 6, 7.5, 20, 30, 400, 700),
(24, 'Alfalfa', 'Loamy Sand', 6.5, 8, 20, 30, 250, 500),
(25, 'Canola', 'Loamy Sand', 5.5, 7.5, 15, 25, 400, 700);

-- --------------------------------------------------------

--
-- Table structure for table `recommendations`
--

CREATE TABLE `recommendations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recommended_crop` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recommendations`
--

INSERT INTO `recommendations` (`id`, `user_id`, `recommended_crop`, `created_at`) VALUES
(1, 1, 'Maize', '2024-03-03 13:14:37'),
(2, 2, 'Wheat', '2024-03-03 13:14:37'),
(3, 1, 'Soybeans', '2024-03-03 13:14:37'),
(4, 2, 'Tomatoes', '2024-03-03 13:14:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `tbl_user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`) VALUES
(19, 'steve', 'wonder', 'odhiambolavender2@gmail.com', '1234'),
(20, 'steve', 'wonder', 'odhiambolavender2@gmail.com', 'asd'),
(21, 'steve', 'wonder', 'odhiambolavender2@gmail.com', 'wers'),
(22, 'steve', 'wonder', 'lavenderlavvy@gmail.com', '123'),
(23, 'steve', 'wonder', 'kahuriamukono@gmail.com', '123'),
(24, 'steve', 'wonder', 'oauma@kabarak.ac', '1234'),
(25, 'lavender', 'Auma', 'lavender@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Odhiambo_Lavender', '123', '2024-03-03 13:14:38', '2024-03-03 13:14:38'),
(2, 'Alice', '@123', '2024-03-03 13:14:38', '2024-03-03 13:14:38'),
(3, 'Smith', 'abc123', '2024-03-03 13:14:38', '2024-03-03 13:14:38');

-- --------------------------------------------------------

--
-- Table structure for table `user_input`
--

CREATE TABLE `user_input` (
  `id` int(11) NOT NULL,
  `rainfall` int(11) NOT NULL,
  `soil_type` varchar(255) NOT NULL,
  `temperature` int(11) NOT NULL,
  `soil_ph` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `soil_ph_max` decimal(5,2) NOT NULL,
  `soil_ph_min` decimal(5,2) NOT NULL,
  `temperature_min` int(11) NOT NULL,
  `temperature_max` int(11) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_input`
--

INSERT INTO `user_input` (`id`, `rainfall`, `soil_type`, `temperature`, `soil_ph`, `created_at`, `soil_ph_max`, `soil_ph_min`, `temperature_min`, `temperature_max`, `location`) VALUES
(1, 800, 'Silty', 25, 6.5, '2024-03-03 13:14:36', 0.00, 0.00, 0, 0, ''),
(2, 600, 'Sandy', 20, 6, '2024-03-03 13:14:36', 0.00, 0.00, 0, 0, ''),
(3, 1000, 'Alluvial', 30, 7, '2024-03-03 13:14:36', 0.00, 0.00, 0, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crops`
--
ALTER TABLE `crops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_input`
--
ALTER TABLE `user_input`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crops`
--
ALTER TABLE `crops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `recommendations`
--
ALTER TABLE `recommendations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_input`
--
ALTER TABLE `user_input`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD CONSTRAINT `recommendations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_input` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
