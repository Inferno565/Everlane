<?php
// $host = "localhost";
// $user = "root";
// $database_name = "everlane";
// $password = "";
include("connection.php");

$conn = mysqli_connect($host, $user, $password, $database_name);
$query = "SELECT * from products";
//fetching result
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
// print(json_encode($data));
// mysqli_close($conn); 
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
    <script>
    </script>
</head>

<body>

    <div class="header">
        <div class="container">
            <?php
            if ($_GET['session'] != 'active') {
                $GLOBALS['flag'] = 0;

                echo '
                 <div class="navbar">

                <div class="logo">
                    <a href=""><img id="logoimg" src="Images/Logo.png" alt="Insert logo here" width="200px" height="70px" onmouseout="imgmouseout(0)" onmouseover="imgmouseover(0)"></a>
                </div>


                <nav>
                    <ul id="MenuItems">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="Explore.php?session=inactive">Explore</a></li>
                        <li><a href="about.php?session=inactive">About</a></li>
                        <li><a href="contact.php?session=inactive"">Contact</a></li>

                    </ul>
                </nav>
                <a href="login.html">

                    <img id="cartimg" src="Images/user.png" width="30px" height="30px" onmouseout="imgmouseout(1)" onmouseover="imgmouseover(1)"></a>
                <img src="Images/menu.png" class="menu-icon" onclick="menutoggle()" alt="">
            </div>
            <hr color="#fff">
        </div>';
            } else {
                session_start();
                // echo $_SESSION['id'];
                $id = $_SESSION['id'];
                // $_SESSION['product'] =$data['id'];
                $query1 = "SELECT * from user where `id`='$id'";
                $result = mysqli_query($conn, $query1);
                $data1 = mysqli_fetch_all($result, MYSQLI_ASSOC);
                // print_r($data1);
                $GLOBALS['flag'] = 1;
                // $GLOBALS['status'] = 'active';
                // echo $GLOBALS['status'];
                echo '
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
                 <a href="profile.php">
                    <img id="cartimg" src="Images/user.png" width="30px" height="30px" onmouseout="imgmouseout(1)" onmouseover="imgmouseover(1)"></a>
                <img src="Images/menu.png" class="menu-icon" onclick="menutoggle()" alt="">
            </div>
            <hr color="#fff">
        </div>

                    ';
            }
            ?>


            <div class="teen">
                <div class="small-container">
                    <h2 class="title">Explore Various Trending Styles</h2>
                    <input class="title" type="text" placeholder="Try Jackets..">
                    <div class="row">
                        <?php
                        foreach ($data as $data) {
                            echo '<div class="col-3">';
                            if ($GLOBALS['flag'] == 1) {
                                echo '<a href="shop.php?session=active&product_id=' . $data['id'] . '">';
                                echo '<img id="img1" src="' . $data['image'] . '" onmouseout="imgmouseout(2)" onmouseover="imgmouseover(2)">';
                                echo '</a>';
                                echo '<h3>' . $data['name'] . '</h3>';
                                echo '</div>';
                            } else {
                                echo '<a href="shop.php?session=inactive&product_id=' . $data['id'] . '">';
                                echo '<img id="img1" src="' . $data['image'] . '" onmouseout="imgmouseout(2)" onmouseover="imgmouseover(2)">';
                                echo '</a>';
                                echo '<h3>' . $data['name'] . '</h3>';
                                echo '</div>';
                            }
                        }
                        ?>

                    </div>


                </div>
                <div class="footer">
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
                                <p>Where everything you need to know <br> is only an arm’s length away!</p>
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
                    document.addEventListener("DOMContentLoaded", function() {
                        var searchInput = document.querySelector('input[type="text"]');
                        searchInput.addEventListener("input", function() {
                            var searchText = this.value.toLowerCase();
                            var productItems = document.querySelectorAll('.col-3');
                            productItems.forEach(function(item) {
                                var productName = item.querySelector('h3').innerText.toLowerCase();
                                if (productName.includes(searchText)) {
                                    item.style.display = 'block';
                                } else {
                                    item.style.display = 'none';
                                }
                            });
                        });
                    });
                </script>
</body>

</html>