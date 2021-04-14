-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 14, 2021 at 08:50 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fruit_delivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  `admin_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_password`, `admin_date`) VALUES
(1, 'nashon', 'fed902e919d87d800df647a04324c534', '2021-03-21 08:05:36');

-- --------------------------------------------------------

--
-- Table structure for table `assigned_deliveries`
--

CREATE TABLE `assigned_deliveries` (
  `ad_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `worker_name` varchar(30) NOT NULL,
  `b_name` varchar(30) NOT NULL,
  `p_name` varchar(30) NOT NULL,
  `q_purchased` varchar(10) NOT NULL,
  `t_amount` varchar(10) NOT NULL,
  `pickup` varchar(30) NOT NULL,
  `p_method` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'uncompleted',
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assigned_deliveries`
--

INSERT INTO `assigned_deliveries` (`ad_id`, `worker_id`, `worker_name`, `b_name`, `p_name`, `q_purchased`, `t_amount`, `pickup`, `p_method`, `status`, `date_added`) VALUES
(34, 1, 'henry', 'SHON', 'Bananas', '10', '50', 'Nairobi Archives', 'Mpesa', 'Completed', '2021-04-13 21:44:26'),
(35, 1, 'henry', 'SHON', 'Bananas', '10', '50', 'Nairobi Archives', 'Mpesa', 'Completed', '2021-04-13 21:50:25'),
(36, 1, 'henry', 'SHON', 'Strawberries', '8', '160', 'Nairobi Archives', 'Mpesa', 'Completed', '2021-04-13 22:30:09'),
(37, 1, 'henry', 'SHON', 'Bananas', '12', '60', 'Nairobi Archives', 'Mpesa', 'Completed', '2021-04-13 22:33:26'),
(38, 1, 'henry', 'SHON', 'Bananas', '12', '60', 'Nairobi Archives', 'Mpesa', 'Completed', '2021-04-13 22:33:28'),
(39, 3, 'Aron James', 'SHON', 'Mangos', '10', '50', 'Nairobi Archives', 'Mpesa', 'Completed', '2021-04-14 09:22:50');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_workers`
--

CREATE TABLE `delivery_workers` (
  `w_id` int(11) NOT NULL,
  `w_name` varchar(50) NOT NULL,
  `w_mobile` varchar(15) NOT NULL,
  `w_location` varchar(30) NOT NULL,
  `w_password` varchar(50) NOT NULL,
  `w_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_workers`
--

INSERT INTO `delivery_workers` (`w_id`, `w_name`, `w_mobile`, `w_location`, `w_password`, `w_date`) VALUES
(3, 'Aron James', '0732767365', 'Nairobi cbd', '827ccb0eea8a706c4c34a16891f84e7b', '2021-04-14 08:53:15'),
(4, 'Vicky', '0776432431', 'Westlands', '827ccb0eea8a706c4c34a16891f84e7b', '2021-04-14 09:12:28');

-- --------------------------------------------------------

--
-- Table structure for table `online_users`
--

CREATE TABLE `online_users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_online` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `online_users`
--

INSERT INTO `online_users` (`user_id`, `first_name`, `last_name`, `username`, `email`, `date_online`) VALUES
(3, 'NASHON', 'OKUMU', 'SHON', 'omondinahshon@gmail.com', '2021-04-14 09:47:23');

-- --------------------------------------------------------

--
-- Table structure for table `pending_deliveries`
--

CREATE TABLE `pending_deliveries` (
  `delivery_id` int(11) NOT NULL,
  `buyers_id` int(11) NOT NULL,
  `buyers_name` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `quantity_purchased` varchar(10) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `location` varchar(50) NOT NULL,
  `payment_method` varchar(30) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pending_deliveries`
--

INSERT INTO `pending_deliveries` (`delivery_id`, `buyers_id`, `buyers_name`, `product_name`, `quantity_purchased`, `amount`, `location`, `payment_method`, `date_created`) VALUES
(86, 3, 'SHON', 'Strawberries', '4', '80', 'Nairobi Archives', 'Mpesa', '2021-04-14 09:47:59');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `sc_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` varchar(11) NOT NULL,
  `total_price` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_image` varchar(50) NOT NULL,
  `product_desc` text NOT NULL,
  `product_amount` varchar(10) NOT NULL,
  `product_innitial_price` varchar(10) NOT NULL,
  `product_final_amount` varchar(10) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`product_id`, `product_name`, `product_image`, `product_desc`, `product_amount`, `product_innitial_price`, `product_final_amount`, `date_added`) VALUES
(3, 'Mangos', '../assets/products/mangos.jpg', 'Rippen', '30', '2', '5', '2021-03-25 21:23:44'),
(4, 'Strawberries', '../assets/products/strawberries.jpeg', 'Sweet', '200', '10', '20', '2021-03-25 21:43:16'),
(8, 'Bananas', '../assets/products/bananas.png', 'Imported', '1000', '3', '5', '2021-03-26 09:35:55'),
(10, 'guavas', '../assets/products/guavas.jpeg', 'Rippen', '700', '6', '10', '2021-04-14 08:34:44'),
(11, 'Pineapple', '../assets/products/pineapple.jpeg', 'sweet', '700', '50', '100', '2021-04-14 08:35:42'),
(12, 'Apples', '../assets/products/apples.jpg', 'Imported', '100', '17', '25', '2021-04-14 08:51:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `first_name`, `last_name`, `password`, `email`, `date_created`) VALUES
(1, 'joseochi', 'Joseph', 'Ochieng', 'mbXfcMNwb6jnzmH', 'joseochi@gmail.com', '2021-03-27 21:43:38'),
(3, 'SHON', 'NASHON', 'OKUMU', 'f94430a3bd81689eec691874fd1aefbe', 'omondinahshon@gmail.com', '2021-04-14 09:17:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `assigned_deliveries`
--
ALTER TABLE `assigned_deliveries`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `delivery_workers`
--
ALTER TABLE `delivery_workers`
  ADD PRIMARY KEY (`w_id`);

--
-- Indexes for table `online_users`
--
ALTER TABLE `online_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `pending_deliveries`
--
ALTER TABLE `pending_deliveries`
  ADD PRIMARY KEY (`delivery_id`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`sc_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assigned_deliveries`
--
ALTER TABLE `assigned_deliveries`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `delivery_workers`
--
ALTER TABLE `delivery_workers`
  MODIFY `w_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `online_users`
--
ALTER TABLE `online_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pending_deliveries`
--
ALTER TABLE `pending_deliveries`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `sc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
