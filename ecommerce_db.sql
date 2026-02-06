-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2026 at 11:18 AM
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
-- Database: `ecommerce_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `user_id`, `rating`, `message`, `created_at`) VALUES
(1, 11, 1, 'nice', '2026-01-08 09:41:27'),
(2, 11, 1, 'nice', '2026-01-08 09:42:08'),
(3, 11, 1, 'nice', '2026-01-08 09:42:43'),
(4, 11, 5, 'nice', '2026-01-08 10:07:57'),
(5, 11, 4, 'Masha Allah', '2026-01-08 12:03:05'),
(6, 11, 4, 'Masha Allah', '2026-01-08 12:03:10'),
(7, 11, 5, 'yaa Salaam!!!!', '2026-01-08 15:23:45'),
(8, 11, 5, 'waxkale', '2026-01-08 15:23:55'),
(9, 11, 5, 'Masha Allah it is Nice', '2026-01-08 15:50:39'),
(10, 13, 5, 'Yaa Salaam! it\'s functioning Masha Allah', '2026-01-08 15:55:10'),
(11, 13, 5, 'ay', '2026-01-08 15:56:29'),
(12, 11, 5, 'okok', '2026-01-08 16:25:44'),
(13, 16, 3, 'awesome', '2026-01-09 03:59:37'),
(14, 17, 5, 'awesome', '2026-01-09 04:11:06');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_method` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_price`, `order_date`, `payment_method`) VALUES
(1, 1, 24.04, '2025-12-22 17:45:59', 'Cash on Delivery'),
(2, 1, 10.02, '2025-12-22 18:57:41', 'Cash on Delivery'),
(3, 1, 10.02, '2025-12-22 18:58:38', 'Cash on Delivery'),
(4, 1, 10.02, '2025-12-22 18:59:36', 'Cash on Delivery'),
(5, 1, 10.02, '2025-12-23 11:16:42', 'Cash on Delivery'),
(6, 1, 2.05, '2025-12-23 12:03:06', 'Cash on Delivery'),
(7, 8, 10.02, '2025-12-23 13:26:45', 'Credit / Debit Card'),
(8, 8, 10.02, '2025-12-23 13:30:46', 'Credit / Debit Card'),
(9, 8, 10.02, '2025-12-23 13:34:15', 'Credit / Debit Card'),
(10, 8, 10.02, '2025-12-23 13:37:29', 'Credit / Debit Card'),
(11, 8, 10.02, '2025-12-23 13:40:42', 'Cash on Delivery'),
(12, 8, 10.00, '2025-12-23 13:41:28', 'Cash on Delivery'),
(13, 8, 10.02, '2025-12-23 13:45:15', 'Cash on Delivery'),
(14, 8, 10.02, '2025-12-23 13:50:39', 'Cash on Delivery'),
(15, 8, 42.06, '2025-12-24 12:07:30', 'Cash on Delivery'),
(16, 1, 8.00, '2025-12-24 13:03:47', 'Cash on Delivery'),
(18, 11, 4.00, '2026-01-08 10:35:37', 'Cash on Delivery'),
(19, 11, 5.06, '2026-01-08 10:36:13', 'Cash on Delivery'),
(20, 11, 4.00, '2026-01-08 10:37:31', 'Cash on Delivery'),
(21, 11, 10.00, '2026-01-08 10:43:13', 'Cash on Delivery'),
(22, 11, 4.00, '2026-01-08 10:47:20', 'Cash on Delivery'),
(23, 11, 7.11, '2026-01-08 10:52:36', 'Cash on Delivery'),
(24, 11, 4.00, '2026-01-08 10:53:46', 'Cash on Delivery'),
(25, 11, 10.00, '2026-01-08 10:58:16', 'Cash on Delivery'),
(26, 11, 6.00, '2026-01-08 11:06:23', 'Online Banking'),
(27, 11, 4.00, '2026-01-08 11:07:10', 'Credit / Debit Card'),
(28, 11, 4.00, '2026-01-08 14:39:12', 'Online Banking'),
(29, 11, 150.00, '2026-01-08 14:47:53', 'Credit / Debit Card'),
(30, 11, 120.00, '2026-01-08 15:23:15', 'Cash on Delivery'),
(31, 11, 124.00, '2026-01-08 15:49:49', 'Credit / Debit Card'),
(32, 13, 9.50, '2026-01-08 15:54:36', 'Cash on Delivery'),
(33, 11, 4.00, '2026-01-08 16:25:13', 'Online Banking'),
(34, 16, 178.07, '2026-01-09 03:58:46', 'Credit / Debit Card'),
(35, 17, 16.05, '2026-01-09 04:10:37', 'Credit / Debit Card'),
(36, 11, 14.00, '2026-01-09 04:45:19', 'Credit / Debit Card');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 28, 4, 1, 4.00),
(2, 29, 25, 1, 150.00),
(3, 30, 29, 1, 120.00),
(4, 31, 19, 1, 100.00),
(5, 31, 3, 1, 4.00),
(6, 31, 8, 1, 6.00),
(7, 31, 17, 1, 12.50),
(8, 31, 22, 1, 1.50),
(9, 32, 7, 1, 4.00),
(10, 32, 13, 1, 4.00),
(11, 32, 22, 1, 1.50),
(12, 33, 4, 1, 4.00),
(13, 34, 2, 1, 10.02),
(14, 34, 12, 1, 10.00),
(15, 34, 15, 1, 6.00),
(16, 34, 16, 1, 2.05),
(17, 34, 25, 1, 150.00),
(18, 35, 12, 1, 10.00),
(19, 35, 10, 1, 4.00),
(20, 35, 16, 1, 2.05),
(21, 36, 4, 2, 4.00),
(22, 36, 8, 1, 6.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `description`, `category`, `image`, `stock`) VALUES
(2, 'Milk', 10.02, 'low fat milk', 'Groceries', 'OIP.webp', 6),
(3, 'coca', 4.00, '0', 'Drinks', '1766424080_69497e103ba33.webp', 10),
(4, 'pepsi', 4.00, '0', 'Drinks', '1766490372_694a8104a2b19.webp', 9),
(6, 'Maggi', 5.06, '0', 'Snacks', '1766490533_694a81a503645.webp', 10),
(7, '7UP', 4.00, '7', 'Drinks', '1766490585_694a81d9bb245.webp', 1),
(8, 'Red Bull', 6.00, '0', 'Drinks', '1766490643_694a82131a62b.webp', 10),
(9, 'Soya Souce', 8.00, '0', '', '1766490677_694a8235cc717.webp', 10),
(10, 'Milo', 4.00, '0', 'Drinks', '1766490722_694a8262c99e8.webp', 9),
(11, 'Twix', 4.00, '0', 'Snacks', '1766491070_694a83be35f4c.webp', 10),
(12, 'Nutella', 10.00, '0', 'Groceries', '1766491122_694a83f26722d.webp', 8),
(13, 'snickers', 4.00, '0', 'Snacks', '1766491169_694a8421991b9.webp', 9),
(14, 'Mars', 4.00, '0', 'Snacks', '1766491220_694a8454f06c6.webp', 4),
(15, 'KitKat', 6.00, '0', 'Snacks', '1766491255_694a847746999.webp', 11),
(16, 'Bread', 2.05, '0', 'Groceries', '1766491297_694a84a10ea32.webp', 10),
(17, 'Mop', 12.50, '0', 'Household', '1767875039_695fa1dfcb053.jpg', 3),
(18, 'Vacuum Cleaner', 90.00, 'for house cleaning', 'Household', '1767879248_695fb2500e63d.jpeg', 8),
(19, 'Shoes for Men', 100.00, 'shoes', 'Shoes', '1767879367_695fb2c7b2d75.jpg', 2),
(20, 'Slippers for Men', 15.00, 'Slippers', 'Shoes', '1767879457_695fb32157ea0.webp', 5),
(21, 'Mineral Water', 1.00, 'water', 'Drinks', '1767879496_695fb3487fa0e.jpg', 11),
(22, 'Water', 1.50, 'water', 'Drinks', '1767879547_695fb37be911a.jpg', 22),
(23, 'Hoodie for Men', 55.00, 'Hoodie', 'Clothes', '1767879596_695fb3ac93127.png', 2),
(24, 'Men Jacket', 35.00, 'jacket', 'Clothes', '1767879638_695fb3d699998.webp', 5),
(25, 'Men Running Shoes', 150.00, 'Casual shoes', 'Shoes', '1767879696_695fb4106ab2f.webp', 8),
(26, 'Mango Juice', 2.00, 'mango juice', 'Drinks', '1767879771_695fb45b661f6.jpg', 20),
(27, 'Fan', 50.00, 'quality fan', 'Household', '1767879824_695fb49006ab7.webp', 4),
(29, 'Thobe Saudi For Men', 120.00, 'best', 'Clothes', '1767880213_695fb6157e986.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`, `phone`) VALUES
(1, 'Abdikhaliq mohamed', 'abdikhaliq@gmail.com', '$2y$10$si1SmlpAE2MNnPxNKIt5KuG3UlqCtvIYeeLAicpxS2DWjRsVcb1BW', 'user', NULL),
(6, 'Abdikadir', 'Abdikadir@gmail.com', '$2y$10$SRPLvt2HFZfD7gbKHCzIJuKwtsZ6MUv.Bs6uJzg08evK8Xb.eM/dS', 'user', NULL),
(8, 'Omar', 'omar@gmail.com', '$2y$10$XsfMoRHTuoY7vfHAAhO0e.qKB//Z1M5p7n8vMzFhPZ6awDfjzXi9S', 'user', NULL),
(10, 'abdi', 'abdukadir1614@gmail.com', '$2y$10$ATJrdOx2DS93KY/DcltsTeCbrjtLzfoUGCNpGCJe6ZjGe93Lbb3VO', 'user', NULL),
(11, 'Abdulkadir', 'test@gmail.com', '$2y$10$r/fQkVlif7.UeWELzD2HiOTSRGggJ8D/yPV3X/9/thXZv4m2MLovS', 'user', '0118292892'),
(12, 'Admin', 'admin@smartmart.com', '$2y$10$vbhxWCC9L9L9rCtTj3wPEe5hw1Nvkcr.Xc/c9DexQc9gPtcdr/UyK', 'admin', NULL),
(13, 'Group9', 'testing@gmail.com', '$2y$10$Li1uI.ostOUkikewnue9muQCZj77p4cpUhtVNuNjxzXwM6AqmpBn6', 'user', '1111111'),
(14, 'Abdulkadir', 'abdi10@gmail.com', '$2y$10$Jv8VJRoY2EAxjffEN9gkSunb4hrD8VYuuMyFHcqW68KGUkKdpyleO', 'user', NULL),
(15, 'Abdulkadir', 'abdukadir100@gmail.com', '$2y$10$I9C5UYa3L.TllIj1y.6vGunnNt/cUu/DxsRe1O94reP6Xbb6Cbxmi', 'user', NULL),
(16, 'abdi', 'abdi@gmail.com', '$2y$10$zuMnvkn59519gYQgfmc3N.bE74QERSxMxCGims0fjWP8xKnaLkuYa', 'user', '1111111'),
(17, 'ahmed', 'ahmed@gmail.com', '$2y$10$Ls7UaPFrjm2VRnRvdgHK2OK9y/kpCLhtp2XMxMTbwcUuF/3it8OB2', 'user', '1111111'),
(18, 'Abdulkadir', 'abdiqadir10@gmail.com', '$2y$10$HVTp87e.4TlNvnlghEoNWeRryNdRyIunnaoJNcxbUE6NDCDyvckVu', 'user', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

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
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
