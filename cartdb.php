<?php
session_start();
include("connection.php");

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    // Retrieve product ID from AJAX request
    $productId = intval($_GET["product_id"]);

    // Retrieve user ID from session
    $userId = $_SESSION['user_id'];

    // Query to insert product into cart table
    $query = "INSERT INTO cart (product, user,base_price, quantity) VALUES ('$productId','$userId',1000, 1)";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        echo "Product added to cart successfully";
    } else {
        echo "Error adding product to cart: " . mysqli_error($conn);
    }
} else {
    echo "Please login to add products to cart";
}
