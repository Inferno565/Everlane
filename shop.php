<?php
            $host = "localhost";
            $user = "root";
            $database_name = "everlane";
            $password = "";
            $conn = mysqli_connect($host, $user, $password, $database_name);
            // if (!$conn) {
            //     die("Connection failed: " . mysqli_connect_error());
            // }
$conn = mysqli_connect($host, $user, $password, $database_name);
$prodid = intval($_GET["product_id"]);
// echo $id;
$query = "SELECT * from products where `id`='$prodid'";
//fetching result
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
$price = $data['price'];
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
</head>

<body>

    <div class="header">
        <div class="container">
            <?php
            if ($_GET['session'] != 'active') {
                echo ' <div class="navbar">

                <div class="logo">
                    <a href=""><img id="logoimg" src="Images/Logo.png" alt="Insert logo here" width="200px" height="70px" onmouseout="imgmouseout(0)" onmouseover="imgmouseover(0)"></a>
                </div>
                <nav>
                    <ul id="MenuItems">
                        <li><a href="main.html">Home</a></li>
                        <li><a href="Explore.php?session=inactive">Explore</a></li>
                        <li><a href="about.php?session=inactive">About</a></li>
                        <li><a href="contact.php?session=inactive">Contact</a></li>

                    </ul>
                </nav>
                <a href="login.php"><img id="cartimg" src="Images/user.png" width="30px" height="30px" onmouseout="imgmouseout(1)" onmouseover="imgmouseover(1)"></a>
                <img src="Images/menu.png" class="menu-icon" onclick="menutoggle()" alt="">
                
            </div>
            <hr color="#fff">
        </div>
';
            } else {
                session_start();
                echo ' <div class="navbar">

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
                <a href="cart.php?user_id=' . $_SESSION['id'] . '"><img id="cartimg" src="Images/cart.png" width="35px" height="35px" style="margin-right:20px" onmouseout="imgmouseout(1)" onmouseover="imgmouseover(1)"></a>
                <a href="profile.php?session=active"><img id="cartimg" src="Images/user.png" width="30px" height="30px" onmouseout="imgmouseout(1)" onmouseover="imgmouseover(1)"></a>
                <img src="Images/menu.png" class="menu-icon" onclick="menutoggle()" alt="">
            </div>
            <hr color="#fff">
        </div>
';
                // $_SESSION['product'] = $id;
                $buyer = $_SESSION['id'];
                echo $_SESSION['id'];
                echo $prodid;
            }
            ?>





            <div class="section">
                <?php
                echo '<img src="' . $data['image'] . '"/>';

                ?>
                <!-- <img src="Images/Trend1.avif" alt=""> -->
                <div class="desc">
                    <?php echo ' <h1>' . $data["brand"] . " " . $data["name"] . '</h1>'; ?> </h1>
                    <?php echo '<p>' . $data["desc"] . '</p>'; ?>

                    <br>
                    <h4>Price</h4>
                    <?php
                    echo ' <h2>&#8377; ' . $data["price"] . '</h2>';
                    ?>
                    <?php
                    if ($_GET['session'] != 'active') {
                        echo ' <button onclick=window.location.href="login.php">Buy Now</button>
                    <button onclick=window.location.href="login.php">Add to Cart</button>
';
                    } else {

                        echo '
                            <a href="buy.php?session=active">  <button name"buy">Buy Now</button></a>
                           <form method="post">
                           <label for="add">Quantity</label>
                           <input type="number" name="quan">
                           <button name="add">Add to Cart</button>
                            </form>

                        ';
                        if (isset($_POST['add'])) {
                            include("connection.php");
                            $quantity = $_POST['quan'];
                            $base = $data['price'];
                            $total = $quantity * $base;
                            $cartquery = "INSERT INTO `cart`(`product`, `user`, `quantity`, `base`, `total`) VALUES ('$prodid','$buyer','$quantity','$base','$total')";
                            $result_cart = mysqli_query($conn, $cartquery);
                            echo "working";
                        }
                    }
                    ?>

                </div>
            </div>
            <?php
            include("connection.php");
            $query = "SELECT * FROM `review` WHERE `for_product`='$prodid'";
            $review_result = mysqli_query($conn, $query);
            if ($review_result) {
                $review_data = mysqli_fetch_all($review_result, MYSQLI_ASSOC);
                $no_of_reviews = count($review_data);
            }
            ?>
            <div class="review">
                <button id="rev" onclick="toggle()">Reviews (<?php echo $no_of_reviews; ?>) </button>
                <div class="review-group">
                    <?php
                    if ($no_of_reviews == 0) {
                        echo "<h4>No Reviews Yet<h4>";
                    } else {
                        foreach ($review_data as $review_data) {
                            echo ' <h4 style="padding:10px;margin:5px;">' . $review_data['user'] . '</h4>';
                            echo ' <p style="padding:10px;text-align:justify;" >' . $review_data['rev'] . '</p>';
                            echo '<img src=" Uploads/' . $review_data['image'] . '" style="width: 200px;height:200px;padding: 20px;"/>';
                            echo '<hr>';
                        }
                    }
                    ?>

                </div>
            </div>
            <div class="review-container">
                <div class="reviewform">
                    <form action="" method="post" enctype="multipart/form-data">
                        <h2>Enter your Review</h2>
                        <div class="input-group">
                            <input type="text" name="username" required>
                            <label>Email or username </label>
                            <span class="line"></span>
                        </div>
                        <div class="input-group">
                            <label>Your Say..</label>
                            <textarea type="textarea" name="feed" required></textarea>
                            <span style="top: 100px;" class="line"></span>
                        </div>
                        <div class="input-group">
                            <label style="top: 30px;">Insert Image..</label>
                            <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
                        </div>
                        <button type="submit" name="submit" style="margin-top: 40px;">Submit</button>
                    </form>
                </div>
            </div>

            <div class="teen">
                <div class="small-container">
                    <h2>View Similar Products</h2>
                    <div class="row">
                        <div class="col-3"><a href="It.php"><img id="img1" src="Images/Trend1.avif" onmouseout="imgmouseout(2)" onmouseover="imgmouseover(2)"></a>
                            <h3>Jackets</h3>
                        </div>

                        <div class="col-3"><a href=""><img id="img2" src="Images/Trend2.avif" onmouseout="imgmouseout(3)" onmouseover="imgmouseover(3)"></a>
                            <h3>Pullovers</h3>
                        </div>

                        <div class="col-3"><a href=""><img id="img3" src="Images/trend3.avif" onmouseout="imgmouseout(4)" onmouseover="imgmouseover(4)"></a>
                            <h3>Hoodies</h3>
                        </div>

                    </div>

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

                function toggle() {
                    var reviewGroup = document.querySelector(".review-group");
                    var rev = document.getElementById("rev")
                    if (reviewGroup.style.display === "none") {
                        reviewGroup.style.display = "block";
                    } else {
                        reviewGroup.style.display = "none";
                    }
                }
            </script>
            <?php
            include("connection.php");
            if (isset($_POST['submit'])) {
                $user_name = $_POST["username"];

                $review = $_POST["feed"];
                $image = $_FILES['image'];
                echo $review;
                $query1 = "SELECT * from `user`WHERE `user_email`='$user_name'";
                $result1 = mysqli_query($conn, $query1);
                // $data1=mysqli_fetch_all($result1,)
                if (!$result1) {
                    echo "<script>
                alert('Provided username does not exist please register to provide reviews')
            </script>";
                } else {

                    //print_r($_FILES);
                    if ($_FILES["image"]["error"] == 4) {
                        echo
                        "<script>
                alert('Image Does Not Exist');
            </script>";
                    } else {
                        $fileName = $_FILES["image"]["name"];
                        $fileSize = $_FILES["image"]["size"];
                        $tmpName = $_FILES["image"]["tmp_name"];
                        $validImageExtension = ['jpg', 'jpeg', 'png'];
                        $imageExtension = explode('.', $fileName);
                        $imageExtension = strtolower(end($imageExtension));
                        if (!in_array($imageExtension, $validImageExtension)) {
                            echo
                            "
            <script>
                alert('Invalid Image Extension');
            </script>
            ";
                        } else if ($fileSize > 1000000) {
                            echo
                            "
            <script>
                alert('Image Size Is Too Large');
            </script>
            ";
                            # code...
                        } else {
                            $newImageName = uniqid();
                            $newImageName .= '.' . $imageExtension;
                            echo $newImageName;
                            move_uploaded_file($tmpName, 'Uploads/' . $newImageName);
                            $escaped_string = mysqli_escape_string($conn, $review);
                            include("connection.php");


                            // Prepare and execute the SQL query
                            $query = "INSERT INTO `review` (`for_product`, `user`, `rev`, `image`) VALUES ('$prodid', '$user_name', '$escaped_string', '$newImageName')";
                            if (mysqli_query($conn, $query)) {
                                echo "<script>alert('Successfully Added');</script>";
                            } else {
                                echo "Error: " . $query . "<br>" . mysqli_error($conn);
                            }
                            echo
                            "
            <script>
                alert('Successfully Added');
            </script>
            ";
                        }
                    }
                }
            }
            ?>
</body>

</html>