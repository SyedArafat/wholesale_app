-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 27, 2021 at 09:51 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wholesale_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `buyer_id`, `product_id`, `price`, `created_at`) VALUES
(1, 1, 13, 0, '2021-11-28 02:27:30'),
(2, 1, 13, 88.2, '2021-11-28 02:54:42'),
(3, 1, 12, 40.5, '2021-11-28 02:56:13'),
(8, 1, 2, 11250, '2021-11-28 03:24:21'),
(9, 1, 2, 11250, '2021-11-28 03:24:25'),
(10, 1, 2, 11250, '2021-11-28 03:46:02'),
(11, 1, 2, 11250, '2021-11-28 03:46:05'),
(12, 1, 2, 11250, '2021-11-28 03:46:52'),
(13, 1, 2, 11250, '2021-11-28 03:46:54'),
(14, 7, 22, 12500, '2021-11-28 04:07:42');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `product_title` varchar(250) NOT NULL,
  `price` float NOT NULL,
  `feature_image` varchar(255) NOT NULL,
  `secondary_image` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `seller_id`, `product_title`, `price`, `feature_image`, `secondary_image`, `updated_at`, `created_at`) VALUES
(1, 1, 'Laptop', 44000, '/resource/storage/products/feature_image/82747_photo-1505740420928-5e560c06d30e.jpeg', '/resource/storage/products/secondary_image/80797_gettyimages-1201202312.jpg', '2021-11-28 00:29:18', '2021-11-23 15:53:38'),
(2, 6, 'Phone', 12500, '/resource/storage/products/feature_image/64564_photo-1505740420928-5e560c06d30e.jpeg', '/resource/storage/products/secondary_image/498208_logo.jpg', '2021-11-28 03:23:29', '2021-11-23 16:14:16'),
(9, 1, 'iphone 6', 40000, '/resource/storage/products/feature_image/365778_apple-iphone-11-1.jpg', '', '2021-11-27 20:01:29', '2021-11-27 01:28:13'),
(10, 1, 'iphone 6', 40000, '/resource/storage/products/feature_image/511081_images.jpeg', '/Applications/XAMPP/xamppfiles/htdocs/wholesale_app/config/../resource/storage/products/secondary_image/429959_images.jpeg', '2021-11-27 19:59:44', '2021-11-27 01:30:20'),
(11, 1, 'asdasd', 21, '/resource/storage/products/feature_image/302306_apple-iphone-11-1.jpg', '/resource/storage/products/secondary_image/651923_apple-iphone-11-1.jpg', '2021-11-27 01:45:46', '2021-11-27 01:45:46'),
(12, 1, 'asdasd@FAF', 45, '/resource/storage/products/feature_image/568931_apple-iphone-11-1.jpg', '', '2021-11-28 00:07:08', '2021-11-27 01:55:10'),
(13, 1, 'Good Thing', 98, '/resource/storage/products/feature_image/505840_logo.jpg', '/resource/storage/products/secondary_image/845266_photo-1505740420928-5e560c06d30e.jpeg', '2021-11-28 00:53:46', '2021-11-27 01:59:47'),
(14, 1, 'Phone', 12500, '/resource/storage/products/feature_image/273476_apple-iphone-11-1.jpg', '/resource/storage/products/secondary_image/354892_logo.jpg', '2021-11-28 03:08:07', '2021-11-28 03:05:11'),
(15, 1, 'Phone', 12500, '/resource/storage/products/feature_image/925747_images.jpeg', '/resource/storage/products/secondary_image/312167_images.jpeg', '2021-11-28 03:07:44', '2021-11-28 03:06:59'),
(16, 1, 'Phone', 12500, '/resource/storage/products/feature_image/64564_photo-1505740420928-5e560c06d30e.jpeg', '/resource/storage/products/secondary_image/498208_logo.jpg', '2021-11-28 03:24:16', '2021-11-28 03:24:16'),
(17, 1, 'Phone', 12500, '/resource/storage/products/feature_image/64564_photo-1505740420928-5e560c06d30e.jpeg', '/resource/storage/products/secondary_image/498208_logo.jpg', '2021-11-28 03:24:21', '2021-11-28 03:24:21'),
(18, 1, 'Phone', 12500, '/resource/storage/products/feature_image/64564_photo-1505740420928-5e560c06d30e.jpeg', '/resource/storage/products/secondary_image/498208_logo.jpg', '2021-11-28 03:24:25', '2021-11-28 03:24:25'),
(19, 1, 'Phone', 12500, '/resource/storage/products/feature_image/64564_photo-1505740420928-5e560c06d30e.jpeg', '/resource/storage/products/secondary_image/498208_logo.jpg', '2021-11-28 03:46:02', '2021-11-28 03:46:02'),
(20, 1, 'Phone', 12500, '/resource/storage/products/feature_image/64564_photo-1505740420928-5e560c06d30e.jpeg', '/resource/storage/products/secondary_image/498208_logo.jpg', '2021-11-28 03:46:05', '2021-11-28 03:46:05'),
(21, 1, 'Phone', 12500, '/resource/storage/products/feature_image/64564_photo-1505740420928-5e560c06d30e.jpeg', '/resource/storage/products/secondary_image/498208_logo.jpg', '2021-11-28 03:46:52', '2021-11-28 03:46:52'),
(22, 1, 'Phone', 12500, '/resource/storage/products/feature_image/64564_photo-1505740420928-5e560c06d30e.jpeg', '/resource/storage/products/secondary_image/498208_logo.jpg', '2021-11-28 03:46:54', '2021-11-28 03:46:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('Seller','Customer') NOT NULL,
  `address` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `contact_number`, `email`, `password`, `user_type`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Arafat', '01774379189', 'arafat@email.com', '$2y$10$7Pmrhop3KeIAGuaVO3v5RewfTpfRBDbxeEIb5mY0xtEsgxCVUHfj2', 'Seller', NULL, '2021-11-19 17:43:15', '2021-11-19 17:43:15'),
(6, 'Sayed Yeamin Arafat', '01626885196', 'sayedyeaminarafat@gmail.com', '$2y$10$hVo8x.CgWOn9yrZS3OQNdOdyhktj4ijaxiLmYSWQ5Z.soNrRpPY9u', 'Seller', 'Nikunja-2\r\nRoad No-14', '2021-11-23 00:03:41', '2021-11-23 00:03:41'),
(7, 'Customer', '0198232342', 'customer@email.com', '$2y$10$b.Fkq5gNgbAK0ipAQszWu.DAGLubyxybNlAdAvj6UkbJ.vD9oCSSG', 'Customer', 'sdfsf sdf sdf sf', '2021-11-28 03:55:19', '2021-11-28 03:55:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
