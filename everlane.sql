-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2024 at 09:15 PM
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
-- Database: `everlane`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `product` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `base` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`product`, `user`, `quantity`, `base`, `total`) VALUES
(18728, '1', 2, 1223, 0),
(18728, '1', 2, 2, 4),
(18728, '1', 3, 2, 6),
(18728, '12', 1, 20, 20);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `user_name` varchar(50) NOT NULL,
  `feed` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`user_name`, `feed`) VALUES
('Test1@gmail.com', 'jhh'),
('Test1@gmail.com', 'jhh');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `color` varchar(10) NOT NULL,
  `desc` varchar(500) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand`, `name`, `type`, `color`, `desc`, `price`, `image`) VALUES
(12121, 'KOTN', 'Flannel Jacket', 'jackets', 'black', 'This heavyweight, retro plaid was made for your next outdoor adventure. And thanks to its breathable organic cotton fibers, it will break in and soften with each wear.', 1782, 'Images/trend3.webp'),
(18728, 'Everlane', 'Printed Hoodie', 'hoodies', 'black', 'Luke Swinson is an illustrator, muralist and a member of the Mississaugas of Scugog Island First Nation. Sales from this collection help to plant cedar, a tree that holds significance for many Indigenous nations across Canada.', 1782, 'Images/trend3.avif'),
(21131, 'TenTree', 'Tencel Trench', 'Coat', 'Khakhi', 'This trench-style jacket goes with your flow, thanks to its relaxed fit and TENCEL™ twill that creates a flattering, casual silhouette. Wear it as a jacket or a mid layer when the temps drop; this jacket can do it all.', 1984, 'Images/ladycoat.webp'),
(24312, 'TenTree', 'Turtle Neck Sweater', 'Sweaters', 'Blue', 'Always feeling cold? Slip into this sustainable, organic cotton turtleneck; it\'s a timeless wardrobe staple designed to provide warmth and comfort year after year.', 1873, 'Images/ladybluesweat.webp'),
(24313, 'TenTree', 'Turtle Neck Sweater', 'Sweaters', 'Grey', 'Always feeling cold? Slip into this sustainable, organic cotton turtleneck; it\'s a timeless wardrobe staple designed to provide warmth and comfort year after year.', 1873, 'Images/ladygreysweat.webp'),
(24335, 'KOTN', 'Drop Shoulder Crew', 'Pullovers', 'Brown', 'The next most sustainable option after having your grandma knit you a sweater. This sustainably made crewneck is great for chilly spring walks or nights at the cabin.', 1623, 'Images/Trend2.avif'),
(42382, 'TenTree', 'Sasquatch hoodie', 'hoodies', 'black', 'The Sasquatch Classic Hoodie is a daily reminder to step outside your comfort zone and into the outdoors. Who knows, maybe you\'ll even see bigfoot out there.', 1568, 'Images/tenhoodblack.webp'),
(42383, 'TenTree', 'Sasquatch hoodie', 'hoodies', 'blue', 'The Sasquatch Classic Hoodie is a daily reminder to step outside your comfort zone and into the outdoors. Who knows, maybe you\'ll even see bigfoot out there.', 1568, 'Images/tenhoodblue.webp'),
(66578, 'H&M', 'Bomber Jacket', 'jackets', 'green', '\nThis timeless, organic jacket is a great addition to any wardrobe. Wear it to work, wear it on weekdays... Wear it wherever.', 1694, 'Images/Trend1.avif');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_no` int(11) NOT NULL,
  `for_product` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `rev` longtext NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_no`, `for_product`, `user`, `rev`, `image`) VALUES
(14, 12121, 'testing123', 'I recently purchased this jacket, and I\'m absolutely in love with it! The fit is perfect, and the quality is exceptional. The material is soft and comfortable, yet durable enough to withstand colder weather. I\'ve received numerous compliments every time I wear it. The design is versatile, allowing me to dress it up or down depending on the occasion. Overall, I highly recommend this jacket to anyone looking for style and functionality.', '66011278243f8.jpg'),
(21, 12121, 'Test1@gmail.com', 'testing forms', '66016be8325d7.jpg'),
(22, 18728, 'Test@test.com', 'Nice', '660180cdb03c4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `address` varchar(400) NOT NULL,
  `phone` int(10) NOT NULL,
  `dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `user_email`, `password`, `address`, `phone`, `dob`) VALUES
(18, 'Hash test', 'Hash@test.com', '$2y$10$.JDQ/b.v8WjVnadgUXDIY.kgwj/XqS1STl5xEEBPF.4zzmtfoUj0i', '', 0, NULL),
(19, 'Testing hash', 'Hashtest@test.com', '$2y$10$rkAKpvYlsjQVOsVHcPYPietLnPudnP3yjoOCE2PuhwCqKcasfAhQa', '', 0, NULL),
(20, 'Finalhashtest', 'final@hash.com', '$2y$10$a0gG9gEzTVat4fk0lyO4fOi/nQcwdBU/LYUxl7a.CRrY.rf7JpbyC', 'Bleecker street', 1234567890, '1997-04-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_no`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
