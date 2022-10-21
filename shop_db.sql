-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 21, 2022 at 03:08 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.2

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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');

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
  `discount` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`, `discount`) VALUES
(10, 1, 2, 'Apple Macbook Pro 2021', 9000, 1, 'WhatsApp 1.jpg', 10),
(12, 1, 10, 'Sony ZV-E10', 3200, 1, 'sonyzv1.jpg', 10),
(13, 2, 9, 'Apple Magic Mouse 2', 300, 1, 'mouse1.jpg', 10);

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
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(2, 1, 'wwww eeee', '123456786', 'qweqwe@gmail.com', 'cash on delivery', 'flat no. 21, taman desa, jitra, kedah, malaysia - 06000', 'Sony ZV-E10 (3200 x 1) - ', 3200, '2022-10-15', 'pending');

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
  `discount` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image_01`, `image_02`, `image_03`, `category`, `discount`) VALUES
(1, 'Samsung S22ultra', 'The Samsung Galaxy S22 Ultra delivers a built-in S Pen, brighter display and lots of camera upgrades in a sleek design\r\nThis Galaxy S22 Ultra review proves that Samsung knows what power users want. This new beast adds the Galaxy Notes best feature while also offering a ton of other upgrades.\r\nYup, there is an S Pen built-in, but there is a lot more going on with this flagship as Samsung tries to top our best phone list.\r\n', 5000, 's221.JPG', 's222.JPG', 's223.JPG', 'smartphone', 50),
(2, 'Apple Macbook Pro 2021', 'Apple in October 2021 overhauled the high-end MacBook Pro, introducing an entirely new design, new chips, new capabilities, and more. As Apple says, the revamped MacBook Pro models offer up extraordinary performance and it is the world best notebook display.\r\n\r\nThe 2021 MacBook Pro models come in 14.2-inch and 16.2-inch size options and they are equipped with mini-LED displays, more ports, up to 64GB memory, and more powerful Apple silicon chips, the M1 Pro and M1 Max. ', 9000, 'WhatsApp 1.jpg', 'WhatsApp Image 2.jpg', 'WhatsApp Image 3.jpg', 'laptop', 10),
(8, 'Apple Watch Series 8', 'Apple Watch Series 8 uses the temperature sensor to provide women with retrospective ovulation estimates, which can be helpful for family planning purposes. The data also provides improved period predictions, and in watchOS 9, women can receive notifications if a logged cycle history shows a possible deviation like irregular, infrequent, or prolonged periods.', 4000, 'applewatch1.jpg', 'applewatch2.jpg', 'applewatch3.jpg', 'watch', 10),
(9, 'Apple Magic Mouse 2', 'Magic Mouse is wireless and rechargeable, with an optimized foot design that lets it glide smoothly across your desk. The Multi-Touch surface allows you to perform simple gestures such as swiping between web pages and scrolling through documents.\r\n\r\nThe rechargeable battery will power your Magic Mouse for about a month or more between charges. It’s ready to go right out of the box and pairs automatically with your Mac.', 300, 'mouse1.jpg', 'mouse2.jpg', '', 'mouse', 10),
(10, 'Sony ZV-E10', 'Designed for creative vloggers who aspire to an artistic look, the ZV-E10 takes care of the nuts and bolts of video production. Create a stunning vlog by taking advantage of interchangeable lenses, the large APS-C sensor, the built-in Directional 3-Capsule Mic and special features designed for vlogging – for a professional-looking vlog without the hassle.\r\n\r\nWith the new version software, Real-time Eye AF for animal is available when shooting movie. ', 3200, 'sonyzv1.jpg', 'songzy2.jpg', 'songzv3.jpg', 'camera', 10),
(11, 'Zenbook 14 UX425 (11th Gen Intel)', 'The beautiful new ZenBook 14 is more portable than ever. It’s thinner, lighter, and incredibly compact, yet includes HDMI, Thunderbolt™ 4 USB-C®, USB Type-A and MicroSD card reader for unrivaled versatility. Built to deliver powerful performance, ZenBook 14 is your perfect choice for an effortless on-the-go lifestyle.', 3699, 'Screen Shot 2022-10-18 at 11.57.59 AM.png', 'Screen Shot 2022-10-18 at 11.58.38 AM.png', 'Screen Shot 2022-10-18 at 11.58.23 AM.png', 'laptop', NULL),
(12, 'Huawei Watch 3', 'The smartwatch is built with a Glass front, ceramic back, and titanium frame. It is 5 ATM water-resistant (50m water resistant) while the dimension of the device is 48 x 49.2 x 12.2 mm and weighs 54 grams.\r\n\r\nIt also supports eSIM along while the display size is 1.43 inches AMOLED that provides 466 x 466 pixels and the PPI density is 326. It is fueled with a Li-Ion battery + Wireless charging 10W.', 2399, 'Screen Shot 2022-10-18 at 12.02.30 PM.png', 'Screen Shot 2022-10-18 at 12.02.46 PM.png', 'Screen Shot 2022-10-18 at 12.03.00 PM.png', 'watch', 10),
(13, 'Huawei MateBook Pro', 'Unprecedented Skin-Soothing\r\nMetallic Body,\r\nfor elegance from the inside out.\r\nStandout performance,\r\nsmart features,\r\nand super productivity.', 6789, 'Screen Shot 2022-10-18 at 12.19.45 PM.png', 'Screen Shot 2022-10-18 at 12.20.21 PM.png', 'Screen Shot 2022-10-18 at 12.21.11 PM.png', 'laptop', NULL),
(14, 'Microsoft Surface Laptop 4', 'Style and speed. Stand out on HD video calls backed by Studio Mics. Capture ideas on the vibrant touchscreen. Do it all with a perfect balance of sleek design, speed, immersive audio, and significantly longer battery life than before', 6699, 'Screen Shot 2022-10-18 at 12.24.16 PM.png', 'Screen Shot 2022-10-18 at 12.24.23 PM.png', 'Screen Shot 2022-10-18 at 12.24.34 PM.png', 'laptop', NULL),
(15, 'Sony ZV-1 Digital Camera', 'The ZV-1 is designed for casual videography with a selfie-friendly vari-angle LCD screen, body grip and a recording lamp. A directional 3-capsule mic with wind screen picks up your voice clearly with less wind noise; and the Bokeh switch and Product Showcase Setting make videos more interesting with less effort.', 3399, 'Screen Shot 2022-10-18 at 1.05.01 PM.png', 'Screen Shot 2022-10-18 at 1.05.11 PM.png', 'Screen Shot 2022-10-18 at 1.05.22 PM.png', 'camera', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'superman', 'qweqwe@gmail.com', 'f4542db9ba30f7958ae42c113dd87ad21fb2eddb'),
(2, 'lucas', 'xiuxiuuu@gmail.com', '601f1889667efaebb33b8c12572835da3f027f78');

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
  `discount` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`, `discount`) VALUES
(8, 1, 1, 'Samsung S22ultra', 5000, 's221.JPG', 50),
(10, 1, 9, 'Apple Magic Mouse 2', 300, 'mouse1.jpg', 10),
(11, 2, 2, 'Apple Macbook Pro 2021', 9000, 'WhatsApp 1.jpg', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
