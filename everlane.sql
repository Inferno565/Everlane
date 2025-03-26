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
  `image` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 100
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand`, `name`, `type`, `color`, `desc`, `price`, `image`, `stock`) VALUES
(12121, 'KOTN', 'Flannel Jacket', 'jackets', 'black', 'This heavyweight, retro plaid was made for your next outdoor adventure. And thanks to its breathable organic cotton fibers, it will break in and soften with each wear.', 1782, 'Images/trend3.webp', 100),
(18728, 'Everlane', 'Printed Hoodie', 'hoodies', 'black', 'Luke Swinson is an illustrator, muralist and a member of the Mississaugas of Scugog Island First Nation. Sales from this collection help to plant cedar, a tree that holds significance for many Indigenous nations across Canada.', 1782, 'Images/trend3.avif', 100),
(21131, 'TenTree', 'Tencel Trench', 'Coat', 'Khakhi', 'This trench-style jacket goes with your flow, thanks to its relaxed fit and TENCEL™ twill that creates a flattering, casual silhouette. Wear it as a jacket or a mid layer when the temps drop; this jacket can do it all.', 1984, 'Images/ladycoat.webp', 100),
(24312, 'TenTree', 'Turtle Neck Sweater', 'Sweaters', 'Blue', 'Always feeling cold? Slip into this sustainable, organic cotton turtleneck; it\'s a timeless wardrobe staple designed to provide warmth and comfort year after year.', 1873, 'Images/ladybluesweat.webp', 100),
(24313, 'TenTree', 'Turtle Neck Sweater', 'Sweaters', 'Grey', 'Always feeling cold? Slip into this sustainable, organic cotton turtleneck; it\'s a timeless wardrobe staple designed to provide warmth and comfort year after year.', 1873, 'Images/ladygreysweat.webp', 100),
(24335, 'KOTN', 'Drop Shoulder Crew', 'Pullovers', 'Brown', 'The next most sustainable option after having your grandma knit you a sweater. This sustainably made crewneck is great for chilly spring walks or nights at the cabin.', 1623, 'Images/Trend2.avif', 100),
(42382, 'TenTree', 'Sasquatch hoodie', 'hoodies', 'black', 'The Sasquatch Classic Hoodie is a daily reminder to step outside your comfort zone and into the outdoors. Who knows, maybe you\'ll even see bigfoot out there.', 1568, 'Images/tenhoodblack.webp', 100),
(42383, 'TenTree', 'Sasquatch hoodie', 'hoodies', 'blue', 'The Sasquatch Classic Hoodie is a daily reminder to step outside your comfort zone and into the outdoors. Who knows, maybe you\'ll even see bigfoot out there.', 1568, 'Images/tenhoodblue.webp', 100),
(66578, 'H&M', 'Bomber Jacket', 'jackets', 'green', '\nThis timeless, organic jacket is a great addition to any wardrobe. Wear it to work, wear it on weekdays... Wear it wherever.', 1694, 'Images/Trend1.avif', 100);

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

-- --------------------------------------------------------

-- First, drop any existing foreign key constraints
SET FOREIGN_KEY_CHECKS = 0;

-- Drop existing tables if they exist
DROP TABLE IF EXISTS `payment_transactions`;
DROP TABLE IF EXISTS `order_items`;
DROP TABLE IF EXISTS `orders`;

-- Re-enable foreign key checks
SET FOREIGN_KEY_CHECKS = 1;

-- Create new orders table with payment details
CREATE TABLE `orders` (
    `order_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `total_amount` DECIMAL(10,2) NOT NULL,
    `status` VARCHAR(20) NOT NULL,
    `payment_id` VARCHAR(255) NOT NULL COMMENT 'Razorpay Payment ID',
    `order_reference` VARCHAR(255) NOT NULL COMMENT 'Razorpay Order ID',
    `payment_status` VARCHAR(50) DEFAULT 'pending',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create order items table
CREATE TABLE `order_items` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `order_id` INT NOT NULL,
    `product_id` INT NOT NULL,
    `quantity` INT NOT NULL,
    `price` DECIMAL(10,2) NOT NULL,
    `total` DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (`order_id`) REFERENCES `orders`(`order_id`),
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create payment transactions table
CREATE TABLE `payment_transactions` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `order_id` INT NOT NULL,
    `payment_id` VARCHAR(255) NOT NULL,
    `amount` DECIMAL(10,2) NOT NULL,
    `status` VARCHAR(50) NOT NULL,
    `payment_method` VARCHAR(50),
    `transaction_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `response_data` TEXT COMMENT 'JSON response from Razorpay',
    FOREIGN KEY (`order_id`) REFERENCES `orders`(`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Add indexes for better performance
ALTER TABLE `orders` ADD INDEX `idx_payment_id` (`payment_id`);
ALTER TABLE `orders` ADD INDEX `idx_order_reference` (`order_reference`);
ALTER TABLE `orders` ADD INDEX `idx_user_orders` (`user_id`);
ALTER TABLE `order_items` ADD INDEX `idx_order_items` (`order_id`);

-- Create view for order summary with payment status
CREATE OR REPLACE VIEW `order_summary` AS
SELECT 
    o.order_id,
    o.user_id,
    u.user_name,
    u.user_email,
    o.total_amount,
    o.status,
    o.payment_id,
    o.payment_status,
    o.created_at,
    COUNT(oi.id) as total_items,
    pt.payment_method
FROM orders o
LEFT JOIN user u ON o.user_id = u.id
LEFT JOIN order_items oi ON o.order_id = oi.order_id
LEFT JOIN payment_transactions pt ON o.order_id = pt.order_id
GROUP BY o.order_id;

-- Create view for low stock products
CREATE OR REPLACE VIEW `low_stock_products` AS
SELECT 
    id,
    name,
    brand,
    stock,
    price
FROM products
WHERE stock < 10;

DELIMITER //

-- Procedure to create new order
CREATE PROCEDURE create_order(
    IN p_user_id INT,
    IN p_total_amount DECIMAL(10,2),
    IN p_payment_id VARCHAR(255),
    IN p_order_reference VARCHAR(255)
)
BEGIN
    INSERT INTO orders (user_id, total_amount, status, payment_id, order_reference, payment_status)
    VALUES (p_user_id, p_total_amount, 'pending', p_payment_id, p_order_reference, 'pending');
    SELECT LAST_INSERT_ID() as order_id;
END //

-- Procedure to update stock after successful payment
CREATE PROCEDURE update_stock_after_payment(
    IN p_order_id INT
)
BEGIN
    UPDATE products p
    INNER JOIN order_items oi ON p.id = oi.product_id
    SET p.stock = p.stock - oi.quantity
    WHERE oi.order_id = p_order_id;
END //

-- Procedure to record payment transaction
CREATE PROCEDURE record_payment(
    IN p_order_id INT,
    IN p_payment_id VARCHAR(255),
    IN p_amount DECIMAL(10,2),
    IN p_status VARCHAR(50),
    IN p_payment_method VARCHAR(50),
    IN p_response_data TEXT
)
BEGIN
    INSERT INTO payment_transactions (
        order_id, payment_id, amount, status, 
        payment_method, response_data
    )
    VALUES (
        p_order_id, p_payment_id, p_amount, p_status, 
        p_payment_method, p_response_data
    );
    
    -- Update order status
    UPDATE orders 
    SET payment_status = p_status,
        status = CASE 
            WHEN p_status = 'completed' THEN 'processing'
            ELSE 'pending'
        END
    WHERE order_id = p_order_id;
END //

-- Trigger to check stock before order
CREATE TRIGGER check_stock_before_order
BEFORE INSERT ON order_items
FOR EACH ROW
BEGIN
    DECLARE available_stock INT;
    
    SELECT stock INTO available_stock
    FROM products
    WHERE id = NEW.product_id;
    
    IF available_stock < NEW.quantity THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Insufficient stock available';
    END IF;
END //

-- Trigger to update stock status
CREATE TRIGGER update_stock_status
AFTER UPDATE ON products
FOR EACH ROW
BEGIN
    IF NEW.stock < 10 AND NEW.stock > 0 THEN
        INSERT INTO stock_notifications (product_id, message)
        VALUES (NEW.id, CONCAT('Low stock alert for product: ', NEW.name));
    ELSEIF NEW.stock = 0 THEN
        INSERT INTO stock_notifications (product_id, message)
        VALUES (NEW.id, CONCAT('Out of stock: ', NEW.name));
    END IF;
END //

DELIMITER ;

CREATE TABLE `stock_notifications` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `product_id` INT NOT NULL,
    `message` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `is_read` BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`)
);