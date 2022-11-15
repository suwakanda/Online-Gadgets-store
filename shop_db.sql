-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2022 at 06:51 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL,
  `discount` int(10) NOT NULL,
  `stock` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(1, 1, 'super', 'qweqwe@gmail.com', '0123456789', 'thanks ');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `reference_number` varchar(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT '2',
  `s_status` int(15) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `reference_number`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `status`, `s_status`) VALUES
(2, '201406231415', 1, 'superman', '123456786', 'qweqwe@gmail.com', 'cash on delivery', '21, taman desa, jitra, kedah, malaysia,     06000', 'Sony ZV-E10 (3200 x 1) - ', 3200, '2022-10-15 04:12:45', '2', 7),
(4, '983186540795', 1, 'qin', '1234567800', 'qweqwe@gmail.com', 'cash on delivery', '21, taman desa, jitra, kedah, Malaysia,     06000', 'Samsung S22ultra (5000 x 1) - Huawei Watch 3 (2399 x 1) - Huawei MateBook Pro (6789 x 1) - ', 13448, '2022-10-15 03:12:45', '1', 3),
(7, '485873672352', 1, 'superman', '0123456789', 'qweqwe@gmail.com', 'cash on delivery', '21, taman desa, jitra, kedah, malaysia ， 06000', 'Huawei Watch 3 (2399 x 1) - ', 2159, '2022-11-06 16:43:13', '2', 0),
(10, '087347487141', 1, 'superman', '0123456789', 'qweqwe@gmail.com', 'cash on delivery', '21, taman desa, jitra, kedah, malaysia ， 06000', 'Apple Macbook Pro 2021 (9000 x 1) - Apple Watch Series 8 (4000 x 1) - ', 10800, '2022-11-06 17:04:29', '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `parcels`
--

CREATE TABLE `parcels` (
  `id` int(30) NOT NULL,
  `reference_number` varchar(100) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parcels`
--

INSERT INTO `parcels` (`id`, `reference_number`, `status`, `date_created`) VALUES
(3, '983186540795', 3, '2020-11-26 16:46:03'),
(4, '201406231415', 7, '2020-11-26 16:15:46'),
(8, '485873672352', 0, '2022-11-07 00:43:13'),
(11, '087347487141', 1, '2022-11-07 01:04:29');

-- --------------------------------------------------------

--
-- Table structure for table `parcel_tracks`
--

CREATE TABLE `parcel_tracks` (
  `id` int(30) NOT NULL,
  `parcel_id` int(30) NOT NULL,
  `status` int(2) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parcel_tracks`
--

INSERT INTO `parcel_tracks` (`id`, `parcel_id`, `status`, `date_created`) VALUES
(2, 3, 1, '2020-11-27 09:55:17'),
(3, 4, 1, '2020-11-27 10:28:01'),
(4, 4, 2, '2020-11-27 10:28:10'),
(5, 4, 3, '2020-11-27 10:28:16'),
(6, 4, 4, '2020-11-27 11:05:03'),
(7, 4, 5, '2020-11-27 11:05:17'),
(8, 4, 7, '2020-11-27 11:05:26'),
(9, 3, 2, '2020-11-27 11:05:41'),
(11, 4, 0, '2020-11-26 16:15:46'),
(13, 3, 3, '2022-11-05 16:48:28'),
(14, 3, 0, '2022-11-05 17:19:10'),
(15, 8, 0, '2022-11-07 00:43:13'),
(18, 11, 0, '2022-11-07 01:04:29'),
(19, 11, 1, '2022-11-07 23:55:38');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `discount` int(10) DEFAULT NULL,
  `stock` int(100) NOT NULL,
  `isActive` tinyint(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image_01`, `image_02`, `image_03`, `category`, `discount`, `stock`, `isActive`) VALUES
(1, 'Samsung S22ultra', 'The Samsung Galaxy S22 Ultra delivers a built-in S Pen, brighter display and lots of camera upgrades in a sleek design\r\nThis Galaxy S22 Ultra review proves that Samsung knows what power users want. This new beast adds the Galaxy Notes best feature while also offering a ton of other upgrades.\r\nYup, there is an S Pen built-in, but there is a lot more going on with this flagship as Samsung tries to top our best phone list.\r\n', 5000, 's221.JPG', 's222.JPG', 's223.JPG', 'smartphone', 10, 3, 0),
(2, 'Apple Macbook Pro 2021', 'Apple in October 2021 overhauled the high-end MacBook Pro, introducing an entirely new design, new chips, new capabilities, and more. As Apple says, the revamped MacBook Pro models offer up extraordinary performance and it is the world best notebook display.\r\n\r\nThe 2021 MacBook Pro models come in 14.2-inch and 16.2-inch size options and they are equipped with mini-LED displays, more ports, up to 64GB memory, and more powerful Apple silicon chips, the M1 Pro and M1 Max. ', 9000, 'WhatsApp 1.jpg', 'WhatsApp Image 2.jpg', 'WhatsApp Image 3.jpg', 'laptop', 20, 9, 0),
(3, 'Apple Watch Series 8', 'Apple Watch Series 8 uses the temperature sensor to provide women with retrospective ovulation estimates, which can be helpful for family planning purposes. The data also provides improved period predictions, and in watchOS 9, women can receive notifications if a logged cycle history shows a possible deviation like irregular, infrequent, or prolonged periods.', 4000, 'applewatch1.jpg', 'applewatch2.jpg', 'applewatch3.jpg', 'watch', 10, 10, 0),
(4, 'Apple Magic Mouse 2', 'Magic Mouse is wireless and rechargeable, with an optimized foot design that lets it glide smoothly across your desk. The Multi-Touch surface allows you to perform simple gestures such as swiping between web pages and scrolling through documents.\r\n\r\nThe rechargeable battery will power your Magic Mouse for about a month or more between charges. It’s ready to go right out of the box and pairs automatically with your Mac.', 300, 'mouse1.jpg', 'mouse2.jpg', '', 'mouse', 10, 7, 0),
(5, 'Sony ZV-E10', 'Designed for creative vloggers who aspire to an artistic look, the ZV-E10 takes care of the nuts and bolts of video production. Create a stunning vlog by taking advantage of interchangeable lenses, the large APS-C sensor, the built-in Directional 3-Capsule Mic and special features designed for vlogging – for a professional-looking vlog without the hassle.\r\n\r\nWith the new version software, Real-time Eye AF for animal is available when shooting movie. ', 3200, 'sonyzv1.jpg', 'songzy2.jpg', 'songzv3.jpg', 'camera', NULL, 8, 0),
(6, 'Zenbook 14 UX425 (11th Gen Intel)', 'The beautiful new ZenBook 14 is more portable than ever. It’s thinner, lighter, and incredibly compact, yet includes HDMI, Thunderbolt™ 4 USB-C®, USB Type-A and MicroSD card reader for unrivaled versatility. Built to deliver powerful performance, ZenBook 14 is your perfect choice for an effortless on-the-go lifestyle.', 3699, 'Screen Shot 2022-10-18 at 11.57.59 AM.png', 'Screen Shot 2022-10-18 at 11.58.38 AM.png', 'Screen Shot 2022-10-18 at 11.58.23 AM.png', 'laptop', NULL, 6, 0),
(7, 'Huawei Watch 3', 'The smartwatch is built with a Glass front, ceramic back, and titanium frame. It is 5 ATM water-resistant (50m water resistant) while the dimension of the device is 48 x 49.2 x 12.2 mm and weighs 54 grams.\r\n\r\nIt also supports eSIM along while the display size is 1.43 inches AMOLED that provides 466 x 466 pixels and the PPI density is 326. It is fueled with a Li-Ion battery + Wireless charging 10W.', 2399, 'Screen Shot 2022-10-18 at 12.02.30 PM.png', 'Screen Shot 2022-10-18 at 12.02.46 PM.png', 'Screen Shot 2022-10-18 at 12.03.00 PM.png', 'watch', 10, 4, 0),
(8, 'Huawei MateBook Pro', 'Unprecedented Skin-Soothing\r\nMetallic Body,\r\nfor elegance from the inside out.\r\nStandout performance,\r\nsmart features,\r\nand super productivity.', 6789, 'Screen Shot 2022-10-18 at 12.19.45 PM.png', 'Screen Shot 2022-10-18 at 12.20.21 PM.png', 'Screen Shot 2022-10-18 at 12.21.11 PM.png', 'laptop', NULL, 7, 0),
(9, 'Microsoft Surface Laptop 4', 'Style and speed. Stand out on HD video calls backed by Studio Mics. Capture ideas on the vibrant touchscreen. Do it all with a perfect balance of sleek design, speed, immersive audio, and significantly longer battery life than before', 6699, 'Screen Shot 2022-10-18 at 12.24.16 PM.png', 'Screen Shot 2022-10-18 at 12.24.23 PM.png', 'Screen Shot 2022-10-18 at 12.24.34 PM.png', 'laptop', NULL, 3, 0),
(10, 'Sony ZV-1 Digital Camera', 'The ZV-1 is designed for casual videography with a selfie-friendly vari-angle LCD screen, body grip and a recording lamp. A directional 3-capsule mic with wind screen picks up your voice clearly with less wind noise; and the Bokeh switch and Product Showcase Setting make videos more interesting with less effort.', 3399, 'Screen Shot 2022-10-18 at 1.05.01 PM.png', 'Screen Shot 2022-10-18 at 1.05.11 PM.png', 'Screen Shot 2022-10-18 at 1.05.22 PM.png', 'camera', NULL, 13, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `role_id` int(10) NOT NULL DEFAULT 3 COMMENT '1=admin,2=sender,3=user',
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `password`, `phone`, `address`) VALUES
(1, 3, 'superman', 'qweqwe@gmail.com', 'f4542db9ba30f7958ae42c113dd87ad21fb2eddb', '0123456789', '88, taman inti, gelugor, pinang, malaysia, 06000'),
(2, 1, 'admin', 'admin@gmail.com', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', '0123456789', ''),
(3, 2, 'sender', 'sender@gmail.com', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', '0123456789', '');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `discount` int(100) NOT NULL,
  `stock` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parcels`
--
ALTER TABLE `parcels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parcel_tracks`
--
ALTER TABLE `parcel_tracks`
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
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `parcels`
--
ALTER TABLE `parcels`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `parcel_tracks`
--
ALTER TABLE `parcel_tracks`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
