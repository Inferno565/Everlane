-- phpMyAdmin SQL Dump
-- version 5.2.1
-- Host: 127.0.0.1
-- Server version: 10.4.32-MariaDB

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

SET FOREIGN_KEY_CHECKS = 0;

-- Create `user` table
CREATE TABLE IF NOT EXISTS `user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_name` VARCHAR(200) NOT NULL,
  `user_email` VARCHAR(200) NOT NULL,
  `password` VARCHAR(200) NOT NULL,
  `address` VARCHAR(400) NOT NULL,
  `phone` INT(10) NOT NULL,
  `dob` DATE DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create `products` table
CREATE TABLE IF NOT EXISTS `products` (
  `id` INT(11) NOT NULL,
  `brand` VARCHAR(50) NOT NULL,
  `name` VARCHAR(50) NOT NULL,
  `type` VARCHAR(50) NOT NULL,
  `color` VARCHAR(10) NOT NULL,
  `desc` VARCHAR(500) NOT NULL,
  `price` INT(11) NOT NULL,
  `image` VARCHAR(100) NOT NULL,
  `stock` INT(11) NOT NULL DEFAULT 100,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create `cart` table
CREATE TABLE IF NOT EXISTS `cart` (
  `product` INT(11) NOT NULL,
  `user` VARCHAR(50) NOT NULL,
  `quantity` INT(11) NOT NULL,
  `base` INT(11) NOT NULL,
  `total` INT(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create `feedback` table
CREATE TABLE IF NOT EXISTS `feedback` (
  `user_name` VARCHAR(50) NOT NULL,
  `feed` TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create `review` table
CREATE TABLE IF NOT EXISTS `review` (
  `review_no` INT(11) NOT NULL,
  `for_product` INT(11) NOT NULL,
  `user` VARCHAR(50) NOT NULL,
  `rev` LONGTEXT NOT NULL,
  `image` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`review_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create `orders` table
CREATE TABLE IF NOT EXISTS `orders` (
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

-- Create `order_items` table
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `order_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `quantity` INT NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `total` DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (`order_id`) REFERENCES `orders`(`order_id`),
  FOREIGN KEY (`product_id`) REFERENCES `products`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create `payment_transactions` table
CREATE TABLE IF NOT EXISTS `payment_transactions` (
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

-- Create `stock_notifications` table
CREATE TABLE IF NOT EXISTS `stock_notifications` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `product_id` INT NOT NULL,
  `message` TEXT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `is_read` BOOLEAN DEFAULT FALSE,
  FOREIGN KEY (`product_id`) REFERENCES `products`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

SET FOREIGN_KEY_CHECKS = 1;

-- Views
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
    COUNT(oi.id) AS total_items,
    pt.payment_method
FROM orders o
LEFT JOIN user u ON o.user_id = u.id
LEFT JOIN order_items oi ON o.order_id = oi.order_id
LEFT JOIN payment_transactions pt ON o.order_id = pt.order_id
GROUP BY o.order_id;

CREATE OR REPLACE VIEW `low_stock_products` AS
SELECT 
    id,
    name,
    brand,
    stock,
    price
FROM products
WHERE stock < 10;

-- Stored Procedures
DELIMITER //

CREATE PROCEDURE create_order(
    IN p_user_id INT,
    IN p_total_amount DECIMAL(10,2),
    IN p_payment_id VARCHAR(255),
    IN p_order_reference VARCHAR(255)
)
BEGIN
    INSERT INTO orders (user_id, total_amount, status, payment_id, order_reference, payment_status)
    VALUES (p_user_id, p_total_amount, 'pending', p_payment_id, p_order_reference, 'pending');
    SELECT LAST_INSERT_ID() AS order_id;
END //

CREATE PROCEDURE update_stock_after_payment(
    IN p_order_id INT
)
BEGIN
    UPDATE products p
    INNER JOIN order_items oi ON p.id = oi.product_id
    SET p.stock = p.stock - oi.quantity
    WHERE oi.order_id = p_order_id;
END //

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

    UPDATE orders 
    SET payment_status = p_status,
        status = CASE 
            WHEN p_status = 'completed' THEN 'processing'
            ELSE 'pending'
        END
    WHERE order_id = p_order_id;
END //

-- Triggers
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

COMMIT;
