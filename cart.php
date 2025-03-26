<?php
// $host = "localhost";
// $user = "root";
// $database_name = "everlane";
// $password = "";
include("connection.php");

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$current_user = $_SESSION['id'];

// echo $current_user;
// echo $id;
$query = "SELECT * FROM cart INNER JOIN products ON cart.product = products.id WHERE cart.user = '$current_user'";

$result = mysqli_query($conn, $query);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
// print_r($data);
// print_r($data);
mysqli_close($conn);

?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/styles.css">
    <link rel="shortcut icon" href="Images/log.ico">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>
        EverLane | Fashion Forward, Sustainability Centric.
    </title>
    <style>
        .cart {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: cornsilk;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .cart h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .cart-items {
            margin-top: 20px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .cart-item img {
            width: 150px;
            height: auto;
            margin-right: 20px;
        }

        .item-details h3 {
            margin: 0;
            font-size: 18px;
        }

        .item-details p {
            margin: 5px 0;
            font-size: 14px;
            color: #777;
        }

        .remove-btn {
            background-color: #ff6347;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .remove-btn:hover {
            background-color: #ff4c36;
        }

        .cart-summary {
            /* margin-top: 20px; */
            padding: 50px;
            border-top: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-summary h3 {
            margin: 0;
            font-size: 18px;
        }

        .checkout-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .checkout-btn:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            .cart-item img {
                width: 80px;
            }

            .item-details h3 {
                font-size: 16px;
            }

            .item-details p {
                font-size: 12px;
            }

            .remove-btn,
            .checkout-btn {
                padding: 8px 15px;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="container">
            <div class="navbar">

                <div class="logo">
                    <a href=""><img id="logoimg" src="Images/Logo.png" alt="Insert logo here" width="200px" height="70px" onmouseout="imgmouseout(0)" onmouseover="imgmouseover(0)"></a>
                </div>
                <nav>
                    <ul id="MenuItems">
                        <li><a href="main.php">Home</a></li>
                        <li><a href="Explore.php?session=active">Explore</a></li>
                        <li><a href="about.php?session=active">About</a></li>
                        <li><a href="contact.php?session=active">Contact</a></li>

                    </ul>
                </nav>
                <a href="cart.php"><img id="cartimg" src="Images/cart.png" width="35px" height="35px" style="margin-right:20px" onmouseout="imgmouseout(1)" onmouseover="imgmouseover(1)"></a>
                <a href="profile.php"><img id="cartimg" src="Images/user.png" width="30px" height="30px" onmouseout="imgmouseout(1)" onmouseover="imgmouseover(1)"></a>
                <img src="Images/menu.png" class="menu-icon" onclick="menutoggle()" alt="">
            </div>
            <hr color="#fff">
        </div>


        <div class="cart">
            <h2>Your Shopping Cart</h2>
            <div class="cart-items">

                <?php
                $i = 0;
                foreach ($data as $data) {
                    $i++;
                    echo '<div class="cart-item">
            <img src="' . $data['image'] . '"/>
            <div class="item-details">
                <h4>' . $data['brand'] . " " . $data["name"] . '</h4>
                <p>&#8377; ' . $data["base"] . ' X  ' . $data['quantity'] . "= &#8377; " . $data['total'] . '</p>
                    <form method="post">    
                     <button  name="del" value="' . $data['product'] . '" class="remove-btn">Remove</button>
                      </form>
                </div>
                    </div>';
                }
                if (isset($_POST['del'])) {
                    include("connection.php");
                    $prodid = $_POST['del']; // Assuming del button has value set as the item id
                    // Query to delete item from cart
                    // echo $prodid;
                    $delete_query = "DELETE FROM `cart` WHERE `product` = '$prodid' AND `user` = $current_user";
                    if (mysqli_query($conn, $delete_query)) {
                        echo "<script>alert('Item removed from cart');
                        window.location.href=cart.php;</script>";
                        mysqli_close($conn);
                    } else {
                        echo "<script>alert('Error removing item from cart');</script>";
                    }
                }
                ?>
            </div>
            <!-- Add more cart items here -->
        </div>
        <div class="cart-summary">
            <?php
            include("connection.php");
            $total_query = "SELECT SUM(total) FROM `cart` WHERE `user`='$current_user';";
            $result = mysqli_query($conn, $total_query);
            $bill = mysqli_fetch_row($result);
            // print_r($bill);
            echo '<div class="cart-summary">';
            if ($bill[0] <= 0) {
                echo '<h4>Your cart is empty</h4>';
                echo '<button class="checkout-btn" onclick="window.location.href=\'Explore.php?session=active\'">Continue Shopping</button>';
            } else {
                echo '<h4>&#8377; ' . $bill[0] . '</h4>';
                echo '<button class="checkout-btn" onclick="window.location.href=\'payment.php\'">Checkout</button>';
            }
            echo '</div>';
            ?>
        </div>
    </div>


    <div class="footer" style="position:relative;top:30px;">
        <div class="container">
            <div class="row">
                <div class="footer-col-1">
                    <h3>Download Our App</h3>
                    <p>Download app for Android and IOS mobile phone.</p>
                    <div class="app-logo">
                        <img src="Images/play-store.png" id="playstore" onmouseout="imgmouseout(5)" onmouseover="imgmouseover(5)" alt="">
                        <img src="Images/app-store.png" id="appstore" onmouseout="imgmouseout(6)" onmouseover="imgmouseover(6)" alt="">
                    </div>
                </div>
                <div class="footer-col-2">
                    <img src="Images/LOGO.png" width="200px" height="50px" style="border-style: dashed;" alt="">
                    <p>Where everything you need to know <br> is only an arm's length away!</p>
                </div>
                <div class="footer-col-3">
                    <h3>Useful Links</h3>
                    <ul>
                        <a href="">
                            <li>Coupons</li>
                        </a>
                        <a href="">
                            <li>Blog Post</li>
                        </a>
                        <a href="">
                            <li>Return Policy</li>
                        </a>
                        <a href="">
                            <li>Join Affiliate</li>
                        </a>
                    </ul>
                </div>
                <div class="footer-col-4">
                    <h3>Follow Us</h3>
                    <ul>
                        <a href="">
                            <li>Facebook</li>
                        </a>
                        <a href="">
                            <li>Twitter</li>
                        </a>
                        <a href="">
                            <li>Instagram</li>
                        </a>
                        <a href="">
                            <li>Youtube</li>
                        </a>
                    </ul>
                </div>
            </div>
            <hr>
            <p class="copyright">Copyright 2020</p>
        </div>

    </div>
    <script>
        var MenuItems = document.getElementById("MenuItems");

        MenuItems.style.maxHeight = "0px";

        function menutoggle() {
            if (MenuItems.style.maxHeight == "0px") {
                MenuItems.style.maxHeight = "200px"
            } else {
                MenuItems.style.maxHeight = "0px"
            }
        }

        function opencategory() {
            window.open("categories.html", "_self");
        }

        function handleCheckout() {
            console.log('Checkout clicked');
            window.location.href = 'payment.php';
        }
    </script>

</body>

</html>