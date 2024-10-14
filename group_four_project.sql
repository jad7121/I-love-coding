-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2024 at 11:54 PM
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
-- Database: `group_four_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `first_name` varchar(225) NOT NULL,
  `middle_name` varchar(225) DEFAULT NULL,
  `last_name` varchar(225) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT current_timestamp(),
  `region_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `middle_name`, `last_name`, `username`, `password`, `role`, `date_registered`, `region_id`) VALUES
(1, 'Togbe', '', 'Maxwell', 'admin', '$2y$10$i2xqv9/O/uRsL6bQnNDt0Oz5C/61pzQ1JQtf9BS7Q6Ag95.fqW2Vq', 'management', '2024-08-04 17:19:56', 16),
(2, 'Atiah', 'Adongo', 'Owen', 'kitchen', '$2y$10$jLS4dS68SiLRHh1A0cH66OYIZRTdBlyCS65ftZrWjux7R4KDKvlEe', 'kitchen', '2024-08-04 17:20:09', 1),
(4, 'Abaah', '', 'Abraham', 'rider', '$2y$10$.j71Ud57nwLIQlSwME.KSuD/IIG9320MgFaSLCtJ0vVW.AYboOKee', 'rider', '2024-08-04 22:02:56', 1),
(5, 'Ndaa', '', 'Bright', 'IT', '$2y$10$pLZRnI0HKc2LSHUykPBK1OnifE41YdfDbeAD4cppjXt8guC6EV.re', 'management', '2024-08-18 11:44:44', 16),
(6, 'Baba', '', 'Isaac', 'rider2', '$2y$10$5E1lnVpIMWYsHXW0153hs.17QZC4MmC0KWmTg4DY6DuL33F6QcsfK', 'rider', '2024-08-18 11:47:00', 16),
(8, 'Adogbila', '', 'Gideon', 'kitchen-ue', '$2y$10$mdkTWGZcTkiJn4v182rTGuINyk8wrDFjiUDZxthKZHVDsoLFZJk12', 'kitchen', '2024-08-18 15:51:58', 1),
(9, 'Asaah', '', 'Gilbert', 'rider-ue', '$2y$10$nD585DrTMFWDWeLHqICPxe1IAV67tt0kTBiR8wu174PQTz7vbav.i', 'rider', '2024-08-18 15:52:51', 1),
(10, 'Muash', '', 'Joseph', 'rider-ga', '$2y$10$tbRn679R6HX2Qyy/S9z3Ou8mz.4T5ZrJMJQ1l5053S2hSV6NglMvC', 'rider', '2024-08-18 15:53:13', 16),
(11, 'Dagogi', '', 'Eyonam', 'kitchen-ga', '$2y$10$bRdGPtkcy5ffZSpSnitkcuIx0/kcNIqXkNZtF6YIE7Vp1ED.ExyQW', 'kitchen', '2024-08-18 15:53:44', 16),
(12, 'Suwaiba', '', 'Iddrisu', 'kitchen-nr', '$2y$10$H7YANNaNu0cAMSsBknrUqOFoe2o3ZRwd7VmAduFicBDfBQZ8luUju', 'kitchen', '2024-08-18 15:55:17', 3),
(13, 'Alhassan', 'Adama', 'Fred', 'rider-nr', '$2y$10$X6HuOKcdXouvYSOD9fFfoOdzR8FO2PayTBZiM.DAKgPq3bagbHCzG', 'rider', '2024-08-18 16:06:09', 3);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `region_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `phone`, `email`, `sex`, `username`, `password`, `date_registered`) VALUES
(1, 'Nsoh Abraham', 'UE', '0547205401', 'test@test.com', 'Male', 'test-ue', '$2y$10$QmTtMLTk9Nxt2jUNbrnbwOliOCvoTj6jseU3Ju7GArBf3Q6.dCdWu', '2024-08-18 15:31:05'),
(2, 'Adongo Ishmael', 'UE', '090080880', 'test2@test.com', 'Female', 'test2-ue', '$2y$10$HaYpIBFFx3NFgcJSwHlGHebo/pJ.YMxaGIl1LbITyNQE/BEb8OHtm', '2024-08-18 15:33:39'),
(3, 'Adagbwe Steve', 'GA', '8934985439', 'test3@test.com', 'Male', 'test-ga', '$2y$10$gYoPoBFlYTtgt248ld.IZeRQYNp12S46ixX/B943muLZxPpyUtuOm', '2024-08-18 15:36:01'),
(4, 'Alhassan Paul', 'NR', '878766767', 'test4@test.com', 'Male', 'test-nr', '$2y$10$pKonta/xWlEcLXKbkWzQ3uOpGNues01Me37GbU0PK5IHWoblOhekW', '2024-08-18 15:37:21');

-- --------------------------------------------------------

--
-- Table structure for table `customer_addresses`
--

CREATE TABLE `customer_addresses` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `digital_code` varchar(20) NOT NULL,
  `region_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer_addresses`
--

INSERT INTO `customer_addresses` (`id`, `customer_id`, `address`, `city`, `digital_code`, `region_id`) VALUES
(2, 1, 'H47, Bukere', 'Bolgatanga', 'UB-76655-0099', 1),
(3, 2, 'Zaare Preparatory Park', 'Bolgatanga', 'UE-4566-0000-9099', 1),
(4, 3, 'Accra Mall', 'Accra', 'GA-78787-878-22', 16),
(5, 4, 'Lamashegu', 'Tamale', 'NR-3434-323-343', 3);

-- --------------------------------------------------------

--
-- Table structure for table `food_items`
--

CREATE TABLE `food_items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `food_items`
--

INSERT INTO `food_items` (`id`, `name`, `price`, `description`, `image`) VALUES
(1, 'Ghanaian Burger', 80.00, 'Locally made Burger right here in Ghana by the members of group four', 'burger.jpg'),
(2, 'Fufu', 50.00, 'A delicious delicacy prepared by the very own Ghanaian people', 'fufu.jpg'),
(3, 'T.Z', 30.00, 'A meal from the Northern Ghana so delicious that you cant resist', 'tz.jpg'),
(4, 'Kenkey', 35.00, 'Ga Kenkey served with okro and Tilapia', 'kenkey.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `kitchen_status` varchar(20) DEFAULT 'pending',
  `kitchen_confirmation_time` datetime DEFAULT NULL,
  `delivery_status` varchar(20) DEFAULT 'pending',
  `delivered_by` int(11) DEFAULT NULL,
  `delivery_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `total_price`, `order_date`, `kitchen_status`, `kitchen_confirmation_time`, `delivery_status`, `delivered_by`, `delivery_time`) VALUES
(1, 1, 125.00, '2024-08-18 15:37:53', 'confirmed', '2024-08-18 17:42:50', 'delivered', 9, '2024-08-18 17:43:11'),
(2, 1, 230.00, '2024-08-18 15:55:43', 'confirmed', '2024-08-18 17:17:33', 'delivered', 9, '2024-08-18 17:21:29'),
(3, 2, 225.00, '2024-08-18 15:56:12', 'confirmed', '2024-08-18 16:10:07', 'delivered', NULL, '2024-08-18 16:10:19'),
(4, 4, 235.00, '2024-08-18 15:56:39', 'confirmed', '2024-08-18 21:28:39', 'delivered', 13, '2024-08-18 21:37:16'),
(5, 4, 80.00, '2024-08-18 15:56:43', 'confirmed', '2024-08-18 16:07:48', 'delivered', 13, '2024-08-18 21:28:31'),
(6, 1, 160.00, '2024-08-18 17:51:33', 'confirmed', '2024-08-18 17:52:26', 'pending', NULL, NULL),
(7, 3, 430.00, '2024-08-18 18:13:42', 'pending', NULL, 'pending', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `food_item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `food_item_id`, `quantity`, `price`) VALUES
(0, 1, 3, 3, 30.00),
(0, 1, 4, 1, 35.00),
(0, 2, 1, 2, 80.00),
(0, 2, 4, 2, 35.00),
(0, 3, 3, 1, 30.00),
(0, 3, 4, 1, 35.00),
(0, 3, 1, 2, 80.00),
(0, 4, 2, 4, 50.00),
(0, 4, 4, 1, 35.00),
(0, 5, 1, 1, 80.00),
(0, 6, 1, 2, 80.00),
(0, 7, 1, 1, 80.00),
(0, 7, 4, 10, 35.00);

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`) VALUES
(1, 'UPPER EAST'),
(2, 'UPPER WEST'),
(3, 'NORTHERN'),
(4, 'NORTH-EAST'),
(5, 'SAVANNAH'),
(6, 'BONO'),
(7, 'BONO-EAST'),
(8, 'ANAFO'),
(9, 'WESTERN-NORTH'),
(10, 'WESTERN'),
(11, 'EASTERN'),
(12, 'CENTRAL'),
(13, 'OTI'),
(14, 'VOLTA'),
(15, 'ASHANTI'),
(16, 'GREATER ACCRA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_admin_region_id` (`region_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_region_id` (`region_id`),
  ADD KEY `fk_customers_id` (`customer_id`);

--
-- Indexes for table `food_items`
--
ALTER TABLE `food_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_customers_id` (`customer_id`),
  ADD KEY `fk_delivered_by_id` (`delivered_by`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD KEY `fk_order_items_order_id` (`order_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `food_items`
--
ALTER TABLE `food_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `fk_admin_region_id` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`);

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`);

--
-- Constraints for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD CONSTRAINT `customer_addresses_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `fk_customers_id` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_delivered_by_id` FOREIGN KEY (`delivered_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `fk_order_customers_id` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_order_items_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
