<?php
session_start();
include("connection.php");  //connecting to the server							
$sql = "SELECT * from `user` where `id`=$_SESSION[id]";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_all($result);
// print_r($data);
// echo $_SESSION['id'];
// $_SESSION['redirecter']="main.php"
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
        //var img = ["Images/logoimg", "Images/cartimg", "Images/teenimg1", "Images/teenimg2", "Images/teenimg3", "Images/playstore", "Images/appstore"]

        function imgmouseover(imgnum) {
            document.getElementById(img[imgnum]).style.transform = "scale(1.1)"
            document.getElementById(img[imgnum]).style.transition = "0.2s"

        }

        function imgmouseout(imgnum) {
            document.getElementById(img[imgnum]).style.transform = "scale(1)"

        }

        function carousel() {
            let i = 0
            const images = ["Images/hero_image.jpg", "Images/hero_image1.webp", "Images/hero_image2.jpg", "Images/hero_image3.jpg"]
            const id = document.getElementById("carous")
            id.src = `${images[i]}`
            setInterval(() => {
                if (i == images.length - 1) {
                    i = 0
                } else {

                    i = i + 1
                }
                id.src = `${images[i]}`
                console.log(i)
            }, 5000)
        }
    </script>
</head>

<body onload="carousel(); locate()">

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
                <a href="cart.php?session=active"><img id="cartimg" src="Images/cart.png" width="35px" height="35px" style="margin-right:20px" onmouseout="imgmouseout(1)" onmouseover="imgmouseover(1)"></a>
                <a href="profile.php?session=active"><img id="cartimg" src="Images/user.png" width="30px" height="30px" onmouseout="imgmouseout(1)" onmouseover="imgmouseover(1)"></a>
                <img src="Images/menu.png" class="menu-icon" onclick="menutoggle()" alt="">

            </div>
            <hr color="#fff">
        </div>

        <div class="row">
            <div class="col-2">
                <h1>Where Fashion<br> Meets Sustainability.</h1>
                <p>At EverLane we embark on a mission to connect
                    fashion with sustainability <br> Explore a variety of eco-friendly clothing brands
                </p>
                <button class="btn" onclick="opencategory()">Explore &#8594;</button>
            </div>
            <div class="col-2">

                <img id="carous" src="Images/hero_image.jpg" alt="">

            </div>
        </div>
    </div>
    <div class="teen">
        <div class="small-container">
            <h2 class="title">Trending Styles</h2>
            <div class="row">
                <div class="col-3"><a><img id="img1" src="Images/Trend1.avif" onmouseout="imgmouseout(2)" onmouseover="imgmouseover(2)"></a>
                    <h3>Jackets</h3>
                </div>

                <div class="col-3"><a href=""><img id="img2" src="Images/Trend2.avif" onmouseout="imgmouseout(3)" onmouseover="imgmouseover(3)"></a>
                    <h3>Pullovers</h3>
                </div>

                <div class="col-3"><a href=""><img id="img3" src="Images/trend3.avif" onmouseout="imgmouseout(4)" onmouseover="imgmouseover(4)"></a>
                    <h3>Hoodies</h3>
                </div>
                <div class="vid">
                    <video src="Images/Vid.mp4" autoplay muted loop></video>
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
                window.open("explore.php", "_self");
            }

            function locate() {
                const successCallback = (position) => {
                    console.log(position);
                };

                const errorCallback = (error) => {
                    console.log(error);
                };

                navigator.geolocation.getCurrentPosition(successCallback, errorCallback);

            }
        </script>
</body>

</html>