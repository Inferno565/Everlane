<?php
session_start();
include("connection.php");

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];
$product_id = intval($_GET['product_id']);
$quantity = intval($_GET['quantity'] ?? 1);

// Get product details
$product_query = "SELECT * FROM products WHERE id = $product_id";
$product_result = mysqli_query($conn, $product_query);
$product = mysqli_fetch_assoc($product_result);

if (!$product) {
    echo "Product not found";
    exit();
}

// Check stock
if ($product['stock'] < $quantity) {
    echo "Insufficient stock";
    exit();
}

// Calculate total
$total = $product['price'] * $quantity;

// Store purchase details in session
$_SESSION['buy_now'] = [
    'product_id' => $product_id,
    'quantity' => $quantity,
    'price' => $product['price'],
    'total' => $total
];

// Redirect to payment page
header("Location: payment.php?buy_now=true");
exit();
?> 