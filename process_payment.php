<?php
session_start();
include("connection.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get cart items
$cart_query = "SELECT cart.*, products.stock FROM cart 
               INNER JOIN products ON cart.product = products.id 
               WHERE cart.user = '$user_id'";
$cart_result = mysqli_query($conn, $cart_query);

if (!$cart_result || mysqli_num_rows($cart_result) == 0) {
    echo "No items in cart";
    exit();
}

// Check stock availability
$stock_error = false;
$cart_items = [];
while ($item = mysqli_fetch_assoc($cart_result)) {
    if ($item['quantity'] > $item['stock']) {
        $stock_error = true;
        break;
    }
    $cart_items[] = $item;
}

if ($stock_error) {
    echo "Some items are out of stock";
    exit();
}

// Process payment (integrate your payment gateway here)
// For demo, we'll assume payment is successful

// Begin transaction
mysqli_begin_transaction($conn);

try {
    // Update stock for each item
    foreach ($cart_items as $item) {
        $product_id = $item['product'];
        $quantity = $item['quantity'];
        
        $update_stock = "UPDATE products 
                        SET stock = stock - $quantity 
                        WHERE id = $product_id";
        mysqli_query($conn, $update_stock);
    }

    // Clear user's cart
    $clear_cart = "DELETE FROM cart WHERE user = '$user_id'";
    mysqli_query($conn, $clear_cart);

    // Create order record (optional)
    $total_amount = array_sum(array_column($cart_items, 'total'));
    $create_order = "INSERT INTO orders (user_id, total_amount, status) 
                    VALUES ('$user_id', $total_amount, 'completed')";
    mysqli_query($conn, $create_order);

    mysqli_commit($conn);
    echo "Payment successful! Order completed.";
    header("Location: order_success.php");

} catch (Exception $e) {
    mysqli_rollback($conn);
    echo "Error processing payment: " . $e->getMessage();
}

mysqli_close($conn);
?> 