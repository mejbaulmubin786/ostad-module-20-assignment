-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2024 at 10:13 AM
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
-- Database: `module20`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_id`, `name`, `description`, `price`, `stock`, `image`, `created_at`, `updated_at`) VALUES
(1, '0156', 'Bean Seed Germination Kit', 'Bean Seed Germination Kit, Micro-Green Plant Growing Tray, Drain Tray, Four-Tier Stackable Sprout Growing Kit Easy Install', 3500.00, 15, 'products/tGXbkpNOLMQ2CM2bn4suTPIoTSO2fpRYZybEPpQx.png', '2024-11-06 08:27:26', '2024-11-09 03:03:30'),
(2, '0157', 'Coco Peat 3 block', 'Coco Peat 3 block - Dry Coco Peat; Expandable Coco Pit', 350.00, 500, NULL, '2024-11-06 08:31:13', '2024-11-06 08:31:13'),
(3, '0158', 'Butterfly shaped home decorating', 'Butterfly shaped home decorating wall light | Color changing LED Wall Sticker | Single (1) Piece', 350.00, 50, NULL, '2024-11-06 08:52:20', '2024-11-06 08:52:20'),
(4, '0159', 'Outdoor Indoor Soilless', 'Outdoor Indoor Soilless Cultivation Hydroponic Tray Grow Nursery Pots Plant Box Seed Sprouter Tray Sprout Pot', 3200.00, 25, NULL, '2024-11-06 08:53:13', '2024-11-06 08:53:13'),
(5, '0160', 'Coco Peat 3 block -', 'Coco Peat 3 block - Dry Coco Peat; Expandable Coco Pit', 3200.00, 600, NULL, '2024-11-06 08:54:12', '2024-11-06 08:54:12'),
(6, '0161', 'Manual Hand Steel', 'Manual Hand Steel Travel Tools Outdoor Camping Hiking Rope Chain Saw Practical Portable Emergency Survival Gear Steel Wire Kits', 720.00, 55, NULL, '2024-11-06 08:54:57', '2024-11-06 08:54:57'),
(7, '0162', 'Mouse Killer Trap', 'Mouse Killer Trap', 150.00, 1000, NULL, '2024-11-06 08:56:07', '2024-11-06 08:56:07'),
(13, '0163', 'Love Soft', 'Love Soft Cushion Heart Shape Pillow Heart shape fluffy soft pillow or cushion for Valentine day love Gift', 132.00, 35, 'products/oIDIME8GmwAeAeQeHQeXI5Rq0YFZyf4sFEwEULfo.jpg', '2024-11-07 08:52:53', '2024-11-07 09:45:01'),
(14, '0164', 'Safety Goggle', 'Safety Goggle Anti Splash Dust Proof Work Lab Eyewear Eye Protection Industrial Research Safety Glasses Clear Lens', 320.00, 23, 'products/mhGc3V7XI7umXd4wWBDWAx5cH5iO6ZTtnWxG20dQ.jpg', '2024-11-09 03:07:06', '2024-11-09 03:07:06'),
(15, '0165', 'WIWU Screen Protector for MacBook', 'WIWU Screen Protector for MacBook Air 13.6 15.3 A2941 A2681 A2289 A2251 A2179 Air 13 M1 A2337 HD Clear Film Screen Protection', 1261.00, 50, 'products/GqDDjjrRDyGQBaZOTgTa8ePYZFoPbCeDfmcoilTh.png', '2024-11-09 03:08:36', '2024-11-09 03:08:36'),
(16, '0166', 'Asus TUF Gaming Gaming Laptop', 'Asus TUF Gaming A15 FA507NUR AMD Ryzen 7 7435HS RTX 4050 With 6GB Graphics 15.6\" FHD Gaming Laptop', 134000.00, 150, 'products/OS2Y8UoIJ8gOKMAxpfu6Y4LApHRoEi82DFz4xzMY.png', '2024-11-09 03:12:40', '2024-11-09 03:12:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_product_id_unique` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
