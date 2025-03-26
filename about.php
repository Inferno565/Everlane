<?php
// session_start();
// include("connection.php");  //connecting to the server							
// $sql = "SELECT * from `user` where `id`=$_SESSION[id]";
// $result = mysqli_query($conn, $sql);
// $data = mysqli_fetch_assoc($result);
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
    <style>
        /* Profile container */
        .profile-container {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            margin: 20px;
            padding: 20px;
        }

        .profile-video video {
            max-width: 1000px;
            /* padding: 10px; */
        }

        /* User details */
        .about_detail {
            color: #333;
            display: flex;
            flex-direction: column;
            /* align-items: center; */
            justify-content: center;
        }

        .about_detail-group {
            padding: 10px;

        }

        .about_detail label {
            font-size: 16px;
            font-weight: bold;
            padding: 6px;
        }

        .about_detail input {
            padding: 7px;
            border: none;
            border-radius: 3px;
            /* box-shadow: 0 0 1px black; */
            background-color: transparent;
        }

        .about_detail span {
            font-size: 14px;
            color: #777;
        }

        @media screen and (max-width:1180px) {
            .profile-container {
                background-color: #f5f5f5;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                margin: 20px;
                padding: 20px;
            }

            .profile-video video {
                max-width: 100%;
                height: auto;
            }

            .about_detail {
                color: #333;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                margin-top: 20px;
            }

            .about_detail-group {
                padding: 10px;
                width: 100%;
            }

            .about_detail label {
                font-size: 16px;
                font-weight: bold;
                padding: 6px;
            }

            .about_detail input {
                padding: 7px;
                border: none;
                border-radius: 3px;
                background-color: transparent;
                width: 100%;
            }

            .about_detail span {
                font-size: 14px;
                color: #777;
            }


        }

        @media only screen and (max-width: 768px) {
            .profile-container {
                padding: 10px;
            }
        }

        @media only screen and (max-width: 600px) {
            .about_detail label {
                font-size: 14px;
            }

            .about_detail input {
                padding: 5px;
                font-size: 14px;
            }
        }
    </style>

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
                $GLOBALS['flag'] = 1;
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

            <div class="profile-container">
                <div class="profile-video">

                    <video src="Images/vid2.mp4" muted autoplay loop nocontrols>
                </div>
                <div class="about_detail">
                    <!-- About Us -->
                    <div class="about_detail-group" style="padding: 20px;">
                        <h2 style="text-align: center; color: #333;">About Us</h2>
                        <p style="font-size: 16px; line-height: 1.6;">EverLane is a sustainable marketplace designed to make
                            sustainable
                            fashion easily accessible to everyone. We believe in offering high-quality, ethically produced
                            clothing and
                            accessories that combine style with sustainability. Our mission is to promote environmental and
                            social
                            responsibility in the fashion industry while providing customers with fashionable and
                            eco-friendly options.</p>
                    </div>
                </div>
            </div>




            <div class=" footer">
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