<?php
session_start();
include("connection.php");
require('razorpay-php\razorpay-php-master\Razorpay.php');

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];
$api_key = "rzp_test_mDis14cPBj50Oj";
$api_secret = "opSfpmrOPvD1sYlWMteKrUck";

// Get payment details from POST
$razorpay_payment_id = $_POST['razorpay_payment_id'];
$razorpay_order_id = $_POST['razorpay_order_id'];
$razorpay_signature = $_POST['razorpay_signature'];

$api = new Razorpay\Api\Api($api_key, $api_secret);

try {
    // Verify signature
    $attributes = array(
        'razorpay_order_id' => $razorpay_order_id,
        'razorpay_payment_id' => $razorpay_payment_id,
        'razorpay_signature' => $razorpay_signature
    );

    $api->utility->verifyPaymentSignature($attributes);

    // Payment successful, update database
    mysqli_begin_transaction($conn);

    try {
        if (isset($_SESSION['buy_now'])) {
            // Handle direct purchase
            $product_id = $_SESSION['buy_now']['product_id'];
            $quantity = $_SESSION['buy_now']['quantity'];
            $price = $_SESSION['buy_now']['price'];
            $total = $_SESSION['buy_now']['total'];

            // Update stock
            $update_stock = "UPDATE products 
                           SET stock = stock - $quantity 
                           WHERE id = $product_id";
            mysqli_query($conn, $update_stock);

            // Create order record
            $create_order = "INSERT INTO orders (user_id, total_amount, status, payment_id, order_reference, payment_status) 
                           VALUES ('$user_id', $total, 'completed', '$razorpay_payment_id', '$razorpay_order_id', 'completed')";
            mysqli_query($conn, $create_order);
            $order_id = mysqli_insert_id($conn);

            // Create order item record
            $create_order_item = "INSERT INTO order_items (order_id, product_id, quantity, price, total) 
                                VALUES ($order_id, $product_id, $quantity, $price, $total)";
            mysqli_query($conn, $create_order_item);

            // Clear buy now session
            unset($_SESSION['buy_now']);

        } else {
            // Handle cart purchase (your existing cart processing code)
            $cart_query = "SELECT cart.*, products.stock, products.price FROM cart 
                          INNER JOIN products ON cart.product = products.id 
                          WHERE cart.user = '$user_id'";
            $cart_result = mysqli_query($conn, $cart_query);
            $cart_items = [];
            
            while ($item = mysqli_fetch_assoc($cart_result)) {
                // Update stock
                $product_id = $item['product'];
                $quantity = $item['quantity'];
                
                $update_stock = "UPDATE products 
                                SET stock = stock - $quantity 
                                WHERE id = $product_id";
                mysqli_query($conn, $update_stock);
                
                $cart_items[] = $item;
            }

            // Create order record
            $total_amount = array_sum(array_column($cart_items, 'total'));
            $create_order = "INSERT INTO orders (user_id, total_amount, status, payment_id) 
                            VALUES ('$user_id', $total_amount, 'completed', '$razorpay_payment_id')";
            mysqli_query($conn, $create_order);

            // Clear cart
            $clear_cart = "DELETE FROM cart WHERE user = '$user_id'";
            mysqli_query($conn, $clear_cart);
        }

        mysqli_commit($conn);
        header("Location: order_success.php");

    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "Error processing order: " . $e->getMessage();
    }

} catch(Exception $e) {
    echo "Payment verification failed: " . $e->getMessage();
}

mysqli_close($conn);
?> 