<?php
session_start();
include("connection.php");
require('razorpay-php\razorpay-php-master\Razorpay.php'); // Download Razorpay PHP SDK
require_once 'config.php'; // Load environment variables

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];

// Check if it's a direct purchase or cart purchase
if (isset($_GET['buy_now']) && isset($_SESSION['buy_now'])) {
    $total = $_SESSION['buy_now']['total'];
} else {
    // Get cart total
    $total_query = "SELECT SUM(total) as cart_total FROM cart WHERE user='$user_id'";
    $result = mysqli_query($conn, $total_query);
    $total = mysqli_fetch_assoc($result)['cart_total'];
}

// Razorpay Integration using environment variables
$api = new Razorpay\Api\Api(RAZORPAY_KEY_ID, RAZORPAY_KEY_SECRET);

// Create Razorpay Order
try {
    $orderData = [
        'receipt'         => 'rcpt_' . time(),
        'amount'          => $total * 100, // rupees in paise
        'currency'        => 'INR'
    ];

    $razorpayOrder = $api->order->create($orderData);
    $razorpayOrderId = $razorpayOrder['id'];
    $_SESSION['razorpay_order_id'] = $razorpayOrderId;

} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Payment - EverLane</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    <div class="payment-container">
        <h1>Complete Your Payment</h1>
        <p>Total Amount: ₹<?php echo $total; ?></p>
        <button id="pay-button" class="checkout-btn">Pay Now</button>
    </div>

    <script>
        var options = {
            "key": "<?php echo RAZORPAY_KEY_ID; ?>",
            "amount": "<?php echo $total * 100; ?>",
            "currency": "INR",
            "name": "EverLane",
            "description": "Fashion Purchase",
            "order_id": "<?php echo $razorpayOrderId; ?>",
            "handler": function (response){
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                document.getElementById('razorpay_signature').value = response.razorpay_signature;
                document.getElementById('razorpay-form').submit();
            },
            "prefill": {
                "name": "<?php echo $_SESSION['user_name'] ?? ''; ?>",
                "email": "<?php echo $_SESSION['user_email'] ?? ''; ?>"
            },
            "theme": {
                "color": "#9f3b29"
            }
        };
        var rzp = new Razorpay(options);
        document.getElementById('pay-button').onclick = function(e){
            rzp.open();
            e.preventDefault();
        }
    </script>

    <!-- Hidden form to submit payment details -->
    <form action="verify_payment.php" method="POST" id="razorpay-form" style="display: none;">
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
        <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
        <input type="hidden" name="razorpay_signature" id="razorpay_signature">
    </form>
</body>
</html> 