-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10 مايو 2025 الساعة 21:07
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simple_store`
--

-- --------------------------------------------------------

--
-- بنية الجدول `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`) VALUES
(2, 'منتجات العناية بالبشرة', 'منتج عالي الجودة', 20.00, 'images/product2.jpg'),
(3, 'مسحوق تجميل ', 'منتج اقتصادي', 19.00, 'images/product3.jpg'),
(4, 'غاز كهربائي', 'الأفضل على الاطلاق', 200.00, 'images/تنزيل.jpeg'),
(5, 'مروحة', 'مكيف صحراوي', 250.00, 'images/تنزيل (1).jpeg'),
(6, 'ماتور', 'خارق ممتاز جدا', 2500.00, 'images/images.jpeg'),
(8, 'ايفون 13', 'اخو الجديد بطارية 87', 3000.00, 'images/ايفون 1.jpeg'),
(9, 'ابواب خشبية', 'اجود انواع الخش مكفول 30 سنة', 175.00, 'images/ابواب.jpeg'),
(10, 'منشار حطب', 'اشتري وادعيلي', 275.00, 'images/منشار.jpeg'),
(11, 'غسالة ملابس اوتوماتيك', 'أفضل مافي السوق', 1850.00, 'images/غسالة.jpeg');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$YOUR_HASHED_PASSWORD', 'admin', '2025-05-09 06:33:22'),
(2, 'user1', 'user1@example.com', '$2y$10$YOUR_HASHED_PASSWORD', 'user', '2025-05-09 06:34:03'),
(3, 'ابرهيم', 'abazaid1995@gmail.com', '$2y$10$kKcE/MeTDIcdvHIXjP4q9e7toN8b97cbXCwZFT4rmpHPv9u1kURBW', 'user', '2025-05-09 06:52:21'),
(4, 'ابرهيم', 'abazaid95@gmail.com', '$2y$10$ZKR7to26ZTucTY3Mg068pusYKGY4QUAm6ScPo3o0.uC87Q4n0XFVG', 'user', '2025-05-09 06:52:36'),
(5, 'ebrahem', 'ebrahem2002hh@gmail.com', '$2y$10$wG/Uqh/pm/EtQ2HIHcbi/OKTsXSH7xjGTO04uilG4m9kNuX24qHnG', 'user', '2025-05-09 07:49:51'),
(6, 'admin', 'eb@gmail.com', '$2y$10$Rnkp2pKT3PcTxrKQ4gcfZeDwltvhzf0OPNyYRBgYsxt53HtVwYEmu', 'admin', '2025-05-09 08:01:34'),
(7, 'احمد', 'eb11@gmail.com', '$2y$10$6U1VA4B6FuHsDTQDT80pHOl1jy7CH5ZuyKJJFiSpqhknqEiarOQiC', 'user', '2025-05-09 08:41:56'),
(8, 'ابراهيم', '', '$2y$10$BIfKeggQpMcP1NLek1mjWuAXEi3OyHfXA3SoEYSBmxcGfnD3pVpYi', 'user', '2025-05-09 14:53:26'),
(9, 'ابراهيم حاج احمد', 'er@gmail.com', '$2y$10$3INMMdMDYQmpXJUVzUdtneFDvqX/qlG4BMMXV6BGkQmsLcYzeciNi', 'admin', '2025-05-09 15:02:11'),
(10, '11', 'ss@gmail.com', '$2y$10$.btD0RQBPsVCe5/0oQZkJuC8Yh4ZisZkhPLGxl.WR9Q1vb2zGo5E2', 'user', '2025-05-09 20:48:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
